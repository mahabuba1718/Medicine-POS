<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Medicine;
use App\Models\Pos;
use App\Models\Subpos;
use App\Models\Purchase;
use App\Models\Setting;
use App\Models\Stock;
use App\Models\Subpurchase;
use App\Models\Supplier;
use App\Models\Type;
use App\Models\Unit;
use App\Models\User;
use App\Models\Expiredmedicine;
use Faker\Provider\Medical;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Gloudemans\Shoppingcart\Facades\Cart;
use File;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use JetBrains\PhpStorm\Pure;

class AdminController extends Controller
{
    public function master()
    {
        // 
        $expireds = Subpurchase::where('expire_date','<',Carbon::today()->format('Y-m-d'))->where('status',0)->get();
        if($expireds != null){
            foreach ($expireds as $expired){
                $expired->update([
                    'status' => 1
                ]);
                $check_expired = Expiredmedicine::where('subpurchase_id',$expired->id)->first();
                if($check_expired == null){
                    Expiredmedicine::create([
                        'subpurchase_id' => $expired->id,
                        'expire_date' => $expired->expire_date,
                        'quantity' => $expired->medicine->stock->stock,
                    ]);
                }

                Stock::where('madicine_id',$expired->madicine_id)->update([
                    'status' => 0,
                    'stock' => 0
                ]);
                Medicine::find($expired->madicine_id)->update([
                    'show_at_purchase' => 0,
                ]);

            }
        }
        // view
        return view('backend.layout.home');
    }

    // registration
    public function registration()
    {
        return view('backend.layout.registration');
    }

    public function register(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name'=> ['required'],
            'email'=> ['required','unique:users'],
            'phone'=> ['required'],
            'image'=> ['required','image','mimes:jpeg,png,jpg'],
            'password'=> ['required'],
        ]);
        $filename = '';
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            if($file->isValid())
            {
                $filename = date('Ymdhms').'.'.$file->getClientOriginalExtension();
                $file->storeAs('pharmacist',$filename);
            }
        }
        // generate contact_id
        $count = User::where('role_id',2)->count();
        $contact_id = $count;
        $contact_id++;

        User::create(
            [
                'name'=> $request -> name,
                'contact_id'=> $contact_id,
                'email'=> $request -> email,
                'phone'=> $request -> phone,
                'image'=>$filename,
                'password'=> Hash::make($request ->password),
            ]
        );
        return redirect('/')->with('success','Register Successfully');
    }

    // login
    public function login_post(Request $request)
    {
        $credentials = $request->validate(
            [
            'email' => ['required', 'email'],
            'password' => ['required'],
            ]);

        if (Auth::attempt($credentials))
        {
            $request->session()->regenerate();
            if (Auth::user()->role_id == 1)
            {
                return redirect()->route('dashboard')->with('message', 'Admin Login Successful');
            }
            if (Auth::user()->role_id == 2 && Auth::user()->status == 1)
            {
                return redirect()->route('dashboard')->with('message', 'Pharmacist Login Successful');
            }
        }
        return back()->onlyInput('email')->with('fail','The provided credentials do not match with records.');
    }


    // settings
    public function setting()
    {
        $change=Setting::find(1);
        return view('backend.layout.setting', compact('change'));
    }

    public function change(Request $request,$id)
    {
        $request->validate(
            [
                'sitename' => ['required'],
                'pharmacyname' => ['required'],
                'email' => ['required','email'],
                'phone' => ['required'],
                'address' => ['required'],
               'logo' => ['image','mimes:jpeg,png,jpg'],
               'favicon' => ['image','mimes:jpeg,png,jpg']
            ],
            [
                'sitename.required' => 'The Site Name field must be required.',
                'pharmacyname.required' => 'The Pharmacy Name field must be required.',
                'email.required' => 'The Email field must be required.',
                'phone.required' => 'The Phone field must be required.',
                'address.required' => 'The Address field must be required.',
                'email.email' => 'The Email must be email format.'
            ]
        );
        // dd($request->all());

        $setting = Setting::find($id);
        $logo = $setting->logo;
        if($request->hasFile('logo'))
        {
            $destination = 'uploads/setting/'.$setting->logo;
            if(File::exists($destination))
            {
                File::delete($destination);
            }
            $file = $request->file('logo');
            if($file->isValid())
            {
                $logo = date('Ymdhms').'.'.$file->getClientOriginalExtension();
                $file->storeAs('setting',$logo);
            }
        }

        $favicon = $setting->favicon;
        if($request->hasFile('favicon'))
        {
            $destination = 'uploads/setting/'.$setting->favicon;
            if(File::exists($destination))
            {
                File::delete($destination);
            }
            $file = $request->file('favicon');
            if($file->isValid())
            {
                $favicon = date('Ymdhms').'.'.$file->getClientOriginalExtension();
                $file->storeAs('setting',$favicon);
            }
        }
        Setting::find($id)->update(
            [
                'sitename'=>$request->sitename,
                'pharmacyname'=>$request->pharmacyname,
                'email'=>$request->email,
                'phone'=>$request->phone,
                'address'=>$request->address,
                'logo'=>$logo,
                'favicon'=>$favicon,
            ]
        );
        return redirect()->back()->with('message','Setting Information Updated Successfully!');
    }

    // profile
    public function profile()
    {
        return view('backend.layout.profile');
    }

    public function update_profile(Request $request)
    {
//       dd($request->all());
        $validator = Validator::make($request->all(),
        [
            'name' => ['required'],
            'email' => ['required','email'],
            'phone' => ['required'],
            'image' => ['image','mimes:jpeg,png,jpg'],
        ]);

        if($validator->fails())
        {
            return back()->withErrors($validator->errors())->withInput()->with('invalidUpdate','Invalid Update');
        }
        else
        {
            $pharm = User::find($request->u_id);
            $filename = $pharm -> image;
            if ($request->hasFile('image'))
            {
                $destination = 'uploads/pharmacist/'.$pharm->image;
                if(File :: exists($destination))
                {
                    File::delete($destination);
                }
                $file = $request->file('image');
                if($file->isValid())
                {
                    $filename = date('Ymdhms').'.'.$file->getClientOriginalExtension();
                    $file-> storeAs('pharmacist',$filename);
                }
            }
            $pharm->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'phone'=>$request->phone,
                'image'=>$filename,
            ]);
            return redirect()->back()->with('message','Profile Updated Successfully!');
        }
    }

    public function change_password(Request $request){

        $validator = Validator::make($request->all(),[
            'current_password' => ['required'],
            'new_password' => ['required','confirmed'],
        ]);

        if($validator->fails())
        {
            return back()->withErrors($validator->errors())->withInput()->with('invalidPassword','Invalid Update');
        }
        else
        {
            $pass = User::find($request->id);
            if(!Hash::check($request->current_password, $pass->password))
            {
                return back()->with("error", "Old Password Doesn't match!");
            }
            User::find($request->id)->update([
               'password' =>  Hash::make($request->new_password)
            ]);
            return back()->with('message','Password Updated Successfully!');
        }
    }

    // dashboard
    public function dashboard()
    {
        $purchase = Purchase::count();
        $expense = Purchase::sum('paid_amount');
        $sales = Pos::count();
        $income = Pos::sum('paid_amount');
        $profit = $income - $expense;
        $med_stock = Stock::Join('medicines','stocks.madicine_id','medicines.id')->where('medicines.status',1)->where('stocks.status',1)->count();
        $add_med = Medicine::count();
        $expired = Subpurchase::where('expire_date','<',Carbon::today()->format('Y-m-d'))->count();
        $pharmacist = User::where('role_id',2)->count();
        $customer = Customer::count();
        $supplier = Supplier::count();
        // dd($purchase,$expense,$sales,$income,$profit,$med_stock,$expired,$pharmacist,$customer,$supplier);
        return view('backend.layout.dashboard',compact('purchase','expense','sales','income','profit','med_stock','expired','pharmacist','customer','supplier','add_med'));
    }


    // contact= pharmacist
    public function contact_pharmacist(Request $request)
    {
        if($request->search_pha != null){
            $pharma=User::where('role_id','2')->where('name','LIKE','%'.$request->search_pha.'%')->orderBy('id','desc')->paginate(5);
        }else{
            $pharma=User::where('role_id','2')->orderBy('id','desc')->paginate(5);
        }

        $customer=Customer::orderBy('id','desc')->paginate(5);
        $supplier=Supplier::orderBy('id','desc')->paginate(5);
        return view('backend.layout.contact', compact('pharma','supplier', 'customer'));
    }

    public function status($id)
    {
        $pharm = User::find($id);
        if($pharm->status == 1)
        {
            $update_status = 0;
        }
        else
        {
            $update_status = 1;
        }
        $pharm->update(
            [
            'status' => $update_status
            ]
        );
        return response(
            [
            'status' => 200
            ]
        );
    }

    public function pharma(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(),
            [
            'name' => ['required'],
            'email' => ['required','email','unique:users'],
            'password' => ['required'],
            'phone' => ['required'],
            'image' => ['required','image','mimes:jpeg,png,jpg'],
            ]
        );
        if($validator->fails())
        {
            return back()->withErrors($validator->errors())->withInput()->with('invalidPharmacistAdd','Invalid Add');
        }
        else
        {
            $filename = '';
            if ($request->hasFile('image'))
            {
                $file = $request->file('image');
                if($file ->isValid())
                {
                    $filename = date('Ymdhms'). '.'.$file->getClientOriginalExtension();
                    $file -> storeAs('pharmacist',$filename);
                }
            }
            // generate contact_id
            $count = User::where('role_id',2)->count();
            $contact_id = $count;
            $contact_id++;

            User::create([
                'name'=>$request->name,
                'contact_id'=>$contact_id,
                'email'=>$request->email,
                'password'=> Hash::make($request ->password),
                'phone'=>$request->phone,
                'image'=>$filename,
            ]);
            return redirect()->back()->with('message','Pharmacist Added Successfully!');
        }
    }

    public function editpharma($pharm_id)
    {
        $pharm = User::find($pharm_id);
        // dd($pharm);
        return view('backend.layout.editpharma', compact('pharm'));
    }
    public function updatepharm(Request $request)
    {
        // dd($request->all());
         $request->validate(
             [
                 'name' => ['required'],
                 'email' => ['required','email'],
                 'contact_id' => ['required'],
                 'phone' => ['required'],
                 'image' => ['image','mimes:jpeg,png,jpg'],
             ]
         );
        $pharm = User::find($request->id);
        $filename = $pharm -> image;
        if ($request->hasFile('image'))
        {
            $destination = 'uploads/pharmacist/'.$pharm->image;
            if(File :: exists($destination))
            {
                File::delete($destination);
            }
            $file = $request->file('image');
            if($file->isValid())
            {
                $filename = date('Ymdhms').'.'.$file->getClientOriginalExtension();
                $file-> storeAs('pharmacist',$filename);
            }
        }
        User::find($request->id)->update(
            [
                'name'=>$request->name,
                'contact_id'=>$request->contact_id,
                'email'=>$request->email,
                'phone'=>$request->phone,
                'image'=>$filename,
            ]
        );
        return redirect()->route('contact_pharmacist')->with('message','Pharmacist Update Successfully!');
    }
    public function deletepharma(Request $request)
    {
        // dd($request->all());
        $pharm = User::find($request->del_id);
        $destination = 'uploads/pharmacist/'.$pharm->image;
        if(File :: exists($destination))
        {
            File :: delete($destination);
        }
        $pharm ->delete();
        return redirect()-> back()->with('message','Pharmacist Delete Successfully!');
    }

    // contact = customer
    public function contact_customer(Request $request)
    {
        $pharma=User::where('role_id','2')->paginate(5);
        
        if($request->search_cus != null){
            $customer=Customer::where('customer_name','LIKE','%'.$request->search_cus.'%')->orderBy('id','desc')->paginate(5);
        }else{
            $customer=Customer::orderBy('id','desc')->paginate(5);
        }
        $supplier=Supplier::orderBy('id','desc')->paginate(5);
        return view('backend.layout.contact', compact('pharma','supplier','customer'));
    }
    public function cus_status($id)
    {
        $cus = Customer::find($id);
        if($cus->status == 1)
        {
            $update_status = 0;
        }
        else
        {
            $update_status = 1;
        }
        $cus->update(
            [
            'status' => $update_status
            ]
        );
        return response(
            [
            'status' => 200
            ]
        );
    }

    public function cus(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'customer_name' => ['required'],
                'email' => ['required','email'],
                'phone' => ['required'],
                'image1' => ['required','image','mimes:jpeg,png,jpg'],
            ]
            );
        // dd($request->all());
        if($validator->fails())
        {
            return back()->withErrors($validator->errors())->withInput()->with('invalidCusAdd','invalid');
        }
        else
        {
            $filename = '';
            if ($request->hasFile('image1'))
            {
                $file = $request->file('image1');
                if($file ->isValid())
                {
                    $filename = date('Ymdhms'). '.'.$file->getClientOriginalExtension();
                    $file -> storeAs('customer',$filename);
                }
            }
            // generate customer_id
            $count = Customer::count();
            $cutomer_id = $count;
            $cutomer_id++;

            Customer::create(
                [
                    'customer_name'=>$request->customer_name,
                    'customer_id'=>$cutomer_id,
                    'email'=>$request->email,
                    'phone'=>$request->phone,
                    'image'=>$filename,
                ]
            );
            return redirect()->back()->with('message','Customer Added Successfully!');
        }
    }

    public function editcus($cus_id)
    {
        $cus = Customer::find($cus_id);
        // dd($cus);
        return view('backend.layout.edit_cus', compact('cus'));
    }

    public function updatecus(Request $request)
    {
        // dd($request->all());
         $request->validate(
             [
                'name' => ['required'],
                'customer_id' => ['required'],
                'email' => ['required','email'],
                'phone' => ['required'],
                'image' => ['image','mimes:jpeg,png,jpg'],
             ]
         );
        $cus = Customer::find($request->id);
        $filename = $cus -> image;
        if ($request->hasFile('image'))
        {
            $destination = 'uploads/customer/'.$cus->image;
            if(File :: exists($destination))
            {
                File::delete($destination);
            }
            $file = $request->file('image');
            if($file->isValid())
            {
                $filename = date('Ymdhms').'.'.$file->getClientOriginalExtension();
                $file-> storeAs('customer',$filename);
            }
        }
        Customer::find($request->id)->update(
            [
                'customer_name'=>$request->name,
                'customer_id'=>$request->customer_id,
                'email'=>$request->email,
                'phone'=>$request->phone,
                'image'=>$filename,
            ]
        );

        return redirect()->route('contact_customer')->with('message','Customer Update Successfully!');
    }
    public function deletecus(Request $request)
    {
        // dd($request->all());
        $cus = User::find($request->del_id);
        $destination = 'uploads/customer/'.$cus->image;
        if(File :: exists($destination))
        {
            File :: delete($destination);
        }
        $cus ->delete();
        return redirect()-> back()->with('message','Customer Delete Successfully!');
    }

    // contact = supplier
    public function contact_supplier(Request $request)
    {
        $pharma=User::where('role_id','2')->orderBy('id','desc')->paginate(5);
        $customer=Customer::orderBy('id','desc')->paginate(5);
        if($request->search_sup != null){
            $supplier=Supplier::where('name','LIKE','%'.$request->search_sup.'%')->orderBy('id','desc')->paginate(5);
        }else{
            $supplier=Supplier::orderBy('id','desc')->paginate(5);
        }
        return view('backend.layout.contact', compact('supplier','pharma', 'customer'));
    }
    public function supplier(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(),
            [
            'name' => ['required'],
            'email' => ['required','email'],
            'phone' => ['required'],
//            'image3' => ['required','image','mimes:jpeg,png,jpg'],
            ]
        );
        if($validator->fails())
        {
            return back()->withErrors($validator->errors())->withInput()->with('invalidSupplierAdd','invalid');
        }
        else
        {
            $filename = '';
            if ($request->hasFile('image3'))
            {
                $file = $request ->file('image3');
                if($file-> isValid())
                {
                    $filename = date('Ymdhms'). '.' .$file->getClientOriginalExtension();
                    $file -> storeAs('supplier',$filename);
                }
            }
            // generate supplier_id
            $count = Supplier::count();
            $supplier_id = $count;
            $supplier_id++;

            Supplier::create(
                [
                    'name'=>$request->name,
                    'supplier_id'=>$supplier_id,
                    'email'=>$request->email,
                    'phone'=>$request->phone,
                    'image'=>$filename,
                ]
            );
            return redirect()-> back()->with('message','Supplier Added Successfully!');
        }
    }
    public function sup_status($id)
    {
        $sup = Supplier::find($id);
        if($sup->status == 1)
        {
            $update_status = 0;
        }
        else
        {
            $update_status = 1;
        }
        $sup->update(
            [
            'status' => $update_status
            ]
        );
        return response(
            [
            'status' => 200
            ]
        );
    }
    // public function deltsupe($sup_id)
    // {
    //     $supe = User::find($sup_id);
    //     return response([
    //        'supe' => $supe,
    //     ]);
    // }
    public function editsup($sup_id)
    {
        $sup = Supplier::find($sup_id);
        // dd($pharm);
        return view('backend.layout.editsup', compact('sup'));
    }

    public function updatesup(Request $request)
    {
        // dd($request->all());
        $request->validate(
            [
                'name' => ['required'],
                'supplier_id' => ['required'],
                'email' => ['required','email'],
                'phone' => ['required'],
                'image' => ['image','mimes:jpeg,png,jpg'],
            ]
        );
        $sup = Supplier::find($request->id);
        $filename = $sup -> image;
        if ($request->hasFile('image'))
        {
            $destination = 'uploads/supplier/'.$sup->image;
            if(File :: exists($destination))
            {
                File::delete($destination);
            }
            $file = $request->file('image');
            if($file->isValid())
            {
                $filename = date('Ymdhms').'.'.$file->getClientOriginalExtension();
                $file-> storeAs('supplier',$filename);
            }
        }
        Supplier::find($request->id)->update(
            [
                'name'=>$request->name,
                'supplier_id'=>$request->supplier_id,
                'email'=>$request->email,
                'phone'=>$request->phone,
                'image'=>$filename,
            ]
        );
        return redirect()-> route('contact_supplier')->with('message','Supplier Update Successfully!');
    }
    public function deletesup(Request $request)
    {
        $sup = Supplier::find($request->del_id);
        $destination = 'uploads/supplier/'.$sup->image;
        if(File :: exists($destination))
        {
            File :: delete($destination);
        }
        $sup ->delete();
        return redirect()-> back()->with('message','Supplier Delete Successfully!');
    }


     // category
     public function category()
     {
         $categories=Category::orderBy('id','desc')->paginate(2);
         $units=Unit::orderBy('id','desc')->paginate(2);
         $types=Type::orderBy('id','desc')->paginate(2);
         return view('backend.layout.category',compact('categories','units','types'));
     }
     public function categories(Request $request)
     {
         $request->validate(
             [
             'name' => ['required','unique:categories'],
             ]
         );
         Category::create(
             [
                 'name'=>$request->name,
                 'description'=>$request->description,
             ]
         );
         return redirect()-> back()->with('message','Category Added Successfully!');
     }

    public function cat_status($id)
    {
        $cat = Category::find($id);
        if($cat->status == 1)
        {
            $update_status = 0;
        }
        else
        {
            $update_status = 1;
        }
        $cat->update(
            [
            'status' => $update_status
            ]
        );
        return response(
            [
            'status' => 200
            ]
        );
    }

    public function editcat($cat_id)
     {
         $cat = Category::find($cat_id);
         return response([
            'cat' => $cat,
         ]);
    }

     public function updatecat(Request $request)
     {
        //  dd($request->all());
         Category::find($request->cat_id)->update(
             [
                 'name'=>$request->name,
                 'description'=>$request->description,
             ]
         );
         return redirect()-> route('category')->with('message','Category Update Successfully!');
     }
     public function deletecat(Request $request)
     {
        // dd($request->all());
        Category::find($request->DelCatId)->delete();
         return redirect()-> back()->with('message','Category Delete Successfully!');
     }


    //  unit
     public function unit()
     {
        $units=Unit::orderBy('id','desc')->paginate(2);
        $categories=Category::orderBy('id','desc')->paginate(2);
        $types=Type::orderBy('id','desc')->paginate(2);
        return view('backend.layout.category',compact('units','categories','types'));
     }
     public function units(Request $request)
     {
         $request->validate(
             [
             'name' => ['required','unique:units'],
             ]
         );
         Unit::create(
             [
                 'name'=>$request->name,
                 'description'=>$request->description,
             ]
         );
         return redirect()->back()->with('message','Unit Added Successfully!');
     }
     public function unit_status($id)
     {
         $unit = Unit::find($id);
         if($unit->status == 1)
         {
             $update_status = 0;
         }
         else
         {
             $update_status = 1;
         }
         $unit->update(
             [
             'status' => $update_status
             ]
         );
         return response(
             [
             'status' => 200
             ]
         );
     }
     public function editunit($unit_id)
     {
         $unit = Unit::find($unit_id);
         return response([
            'unit' => $unit,
         ]);
     }

     public function updateunit(Request $request)
     {
        //  dd($request->all());
         Unit::find($request->unit_id)->update(
             [
                 'name'=>$request->name,
                 'description'=>$request->description,
             ]
         );
         return redirect()-> route('unit')->with('message','Unit Update Successfully!');
     }
     public function deleteunit(Request $request)
     {
        // dd($request->all());
        Unit::find($request->DelUnitId)->delete();
         return redirect()-> back()->with('message','Unit Delete Successfully!');
     }


    //  type
     public function type()
     {
         $categories=Category::orderBy('id','desc')->paginate(2);
         $units=Unit::orderBy('id','desc')->paginate(2);
         $types=Type::orderBy('id','desc')->paginate(2);
         return view('backend.layout.category',compact('types','categories','units'));
     }
     public function types(Request $request)
     {
         $request->validate(
             [
             'type' => ['required','unique:types'],
             ]
         );
         Type::create(
             [
                 'name'=>$request->type,
                 'description'=>$request->description,
             ]
         );
         return redirect()-> back()->with('message','Type Added Successfully!');
     }
     public function type_status($id)
    {
        $type = Type::find($id);
        if($type->status == 1)
        {
            $update_status = 0;
        }
        else
        {
            $update_status = 1;
        }
        $type->update(
            [
            'status' => $update_status
            ]
        );
        return response(
            [
            'status' => 200
            ]
        );
    }
     public function edittype($type_id)
     {
         $type = Type::find($type_id);
         return response([
            'type' => $type,
         ]);
     }

     public function updatetype(Request $request)
     {
        //  dd($request->all());
         Type::find($request->type_id)->update(
             [
                 'name'=>$request->name,
                 'description'=>$request->description,
             ]
         );
         return redirect()-> route('type')->with('message','Type Update Successfully!');
     }
     public function deletetype(Request $request)
     {
        // dd($request->all());
        Type::find($request->DelTypeId)->delete();
         return redirect()-> back()->with('message','Type Delete Successfully!');
     }

    // medicine
    public function medicine()
    {
        $admedicine=Medicine::all();
        $categories=Category::all();
        $units=Unit::all();
        $types=Type::all();
        return view('backend.layout.medicine', compact('admedicine','categories','units','types'));
    }

    public function med_status($id)
    {
        $med = Medicine::find($id);
        if($med->status == 1)
        {
            $update_status = 0;
        }
        else
        {
            $update_status = 1;
        }
        $med->update(
            [
            'status' => $update_status
            ]
        );
        return response(
            [
            'status' => 200
            ]
        );
    }

    public function admedicine(Request $request)
        {
            // dd($request->all());
            $validator = Validator::make($request->all(),
                [
                'name' => ['required','unique:medicines'],
                'genericname' => ['required'],
                'category_id' => ['required','integer'],
                'unit_id' => ['required','integer'],
                'type_id' => ['required','integer'],
                'price' => ['required'],
                'purchaseprice' => ['required'],
                'image' => ['required','image','mimes:jpeg,png,jpg'],
                ]
            );
            if($validator->fails())
            {
                return back()->withErrors($validator->errors())->withInput()->with('invalidMedAdd','Some Required Field is not Filled Up!');
            }
            $filename = '';
            if($request->hasFile('image'))
            {
                $file = $request->file('image');
                if($file->isValid())
                {
                    $filename = date('Ymdhms').'.'.$file->getClientOriginalExtension();
                    $file->storeAs('medicine',$filename);
                }
            }

            $med = Medicine::create(
                [
                    'image'=>$filename,
                    'name'=>$request->name,
                    'genericname'=>$request->genericname,
                    'category_id'=>$request->category_id,
                    'unit_id'=>$request->unit_id,
                    'type_id'=>$request->type_id,
                    'price'=>$request->price,
                    'purchaseprice'=>$request->purchaseprice,
                    'description'=>$request->description,
                ]
            );
            // to create a stock when a medicine is added 
            Stock::create([
                'madicine_id' => $med->id,
            ]);

            return redirect()-> back()->with('message','Medicine Added Successfully!');
        }

    // public function deletemed($med_id)
    //  {
    //      $med = Medicine::find($med_id);
    //      return response([
    //         'med' => $med,
    //      ]);
    //  }
    public function viewmed($med_id)
     {
         $med = Medicine::find($med_id);
         $c = Category::find($med->category_id);
         $u = Unit::find($med->unit_id);
         $t = Type::find($med->type_id);
         return response([
            'med' => $med,
            'c'=>$c,
            'u'=>$u,
            't'=>$t,
            
         ]);
     }
    public function editmedicine($med_id)
    {
        $med = Medicine::find($med_id);
        $categories=Category::all();
        $units=Unit::all();
        $types=Type::all();
        // dd($med);
        return view('backend.layout.editmedicine',compact('med','categories','units','types'));
    }

    public function updatemedicine(Request $request)
    {
        // dd($request->all());

         $request->validate(
             [
                 'name' => ['required'],
                 'genericname' => ['required'],
                 'category' => ['required','integer'],
                 'type' => ['required','integer'],
                 'unit' => ['required','integer'],
                 'price' => ['required'],
                 'purchaseprice' => ['required'],
                 'image' => ['image','mimes:jpeg,png,jpg'],
             ]
         );
        $med = Medicine::find($request->medicine_id);
        $filename = $med->image;
        if($request->hasFile('image'))
        {
            $destination = 'uploads/medicine/'.$med->image;
            if(File::exists($destination))
            {
                File::delete($destination);
            }
            $file = $request->file('image');
            if($file->isValid())
            {
                $filename = date('Ymdhms').'.'.$file->getClientOriginalExtension();
                $file->storeAs('medicine',$filename);
            }
        }

        Medicine::find($request->medicine_id)->update(
            [
                'image'=>$filename,
                'name'=>$request->name,
                'genericname'=>$request->genericname,
                'category_id'=>$request->category,
                'unit_id'=>$request->unit,
                'type_id'=>$request->type,
                'price'=>$request->price,
                'purchaseprice'=>$request->purchaseprice,
                'description'=>$request->description,
            ]
        );
        return redirect()->route('medicine')->with('message','Medicine Update Successfully!');
    }

    public function deletemedicine(Request $request)
    {
        $med = Medicine::find($request->DeletingId);

        $destination = 'uploads/medicine/'.$med->image;
        if(File::exists($destination))
        {
            File::delete($destination);
        }
        $stock = Stock::where('madicine_id',$med->id)->delete();
        $med->delete();
        return redirect()-> back()->with('message','Medicine Delete Successfully!');
    }

    // purchase List
    public function purchase()
    {
        $adpurchase=Purchase::all();
        $subpurchase= Subpurchase::all();
        // dd($subpurchase);
//        $admedicine=Medicine::all();

        // dd($adpurchase);
        return view('backend.layout.purchase',compact('adpurchase','subpurchase'));
    }

    public function viewpurch($purch_id)
    {
        $purch = Purchase::find($purch_id);
        return response([
            'purch' => $purch,
        ]);
    }

    public function approve(Request $request)
    {
        $purchase_info = Purchase::find($request->ApporvePurchId);
        $subpurchase_infos = Subpurchase::where('purchase_id',$purchase_info->id)->get();
        // dd($purchase_info,$subpurchase_infos); 
        foreach ($subpurchase_infos as $subpurchase_info)
        {
            $med_info = Stock::where('madicine_id',$subpurchase_info->madicine_id)->first();
            if($med_info->stock == null)
            {
                $med_info->update([
                    'stock' => $subpurchase_info->quantity,
                    'stock_alert' => $subpurchase_info->alert,
                    'status' => '1'
                ]);
            }
            else
            {
                $update_stock = $med_info->stock + $subpurchase_info->quantity;
                $med_info->update([
                    'stock' => $update_stock,
                    'stock_alert' => $subpurchase_info->alert,
                    'status' => '1'
                ]);
            }
        }
        $purchase_info->update([
            'status' => 1
        ]);
        return back()->with('message','Purchase Approved And Stock Updated Successfully!');
    }

    public function due_purchase(Request $request){
        $purchase = Purchase::find($request->PurchId);

        if($request->due_up_amount > $purchase->due_amount){
            $change = $request->due_up_amount - $purchase->due_amount;
            $total = $purchase->paid_amount + $request->due_up_amount;
            $purchase->update([
                'paid_amount' => $total,
                'due_amount' => 0,
                'change_amount' => $change
            ]);
        }else{
            $due = $purchase->due_amount - $request->due_up_amount;
            $total = $purchase->paid_amount + $request->due_up_amount;
            $purchase->update([
                'paid_amount' => $total,
                'due_amount' => $due,
                'change_amount' => 0
            ]);
        }

        return back()->with('message','Purchase Due Updated Successfully!');

    }

    public function deletepurch(Request $request)
    {
        // dd($request->all());
        Purchase::find($request->DelPurchId)->delete();
        Subpurchase::where('purchase_id',$request->DelPurchId)->delete();
        return redirect()-> back();
    }

    // add purchase view= addpurchase
    public function addpurchase()
    {
//        $date =Carbon::today()->format("m/d/Y");
//        dd($date);
        $adpurchase=Purchase::all();
        // $admedicine=Medicine::where('status','1')->get();
        $admedicine=Stock::Join('medicines','stocks.madicine_id','=','medicines.id')
                        ->where('medicines.status','1')
                        ->where('medicines.show_at_purchase','0')
                        ->get(['stocks.*']);
//                        ->where('stocks.status','0')
        $supplier=Supplier::where('status','1')->get();

        $purchase = Purchase::latest('id')->first();
        if($purchase == null){
            $purchase_code = "PO-1";
        }else{
            $purchase_code= "PO-".$purchase->id;
            $purchase_code++;
        }
        return view('backend.layout.add_purchase', compact('adpurchase','admedicine','supplier','purchase_code'));
    }

    public function purchase_find_med($id){
        $find_med = Medicine::find($id);
        return response([
            'status' => '200',
            'med' => $find_med,
        ]);
    }

    public function adpurchase(Request $request)
    {
        $request->validate(
            [
            'date' => ['required'],
            // 'time' => ['required'],
            'supplier' => ['required','integer'],
            // 'purchase_no' => ['required'],
            // 'madicine_name' => ['required'],
            // 'expire_date' => ['required'],
            // 'batch_id' => ['required'],
            // 'price' => ['required'],
            // 'total_amount' => ['required'],
            // 'paid_amount' => ['required'],
            ]
        );
        $count = count($request->medicine);
        // dd($request->all(),$count);
        $purchase = Purchase::create(
            [
                'purchase_no'=>$request->purchase_no,
                'date'=>$request->date,
                'time'=>$request->time,
                'supplier'=>$request->supplier,
                'vat'=>$request->vat,
                'discount_amount'=>$request->discount_amount,
                'total_amount'=>$request->total_amount,
                'paid_amount'=>$request->paid_amount,
                'due_amount'=>$request->due_amount,
                'change_amount'=>$request->change_amount,
                'description'=>$request->description,
            ]
        );
        for($i=0; $i<$count; $i++){
            $med = Medicine::find($request->medicine[$i]);
            $med -> update([
                'show_at_purchase' => '1',
            ]);
        }

        for ($i=0; $i<$count; $i++)
        {
            Subpurchase::create(
                [
                'purchase_id' => $purchase->id,
//                'purchase_no'=>$request->purchase_no,
                'madicine_id'=>$request->medicine[$i],
//                'date'=>$request->date,
                'expire_date'=>$request->expire_date[$i],
                // 'batch_id'=>$request->batch_id[$i],
                'quantity'=>$request->quantity[$i],
                'alert'=>$request->alert_id[$i],
                'price'=>$request->price[$i],
                // 'image'=>$med->image[$i],
                'sub_total'=>$request->sub_total[$i],
                ]
            );

//            $med_info = Stock::where('madicine_id',$request->medicine[$i])->first();
//            if($med_info->stock == null){
//                $med_info->update([
//                    'stock' => $request->quantity[$i],
//                    'stock_alert' => $request->alert_id[$i],
//                    'status' => '1'
//                ]);
//            }else{
//                $update_stock = $med_info->stock + $request->quantity[$i];
//                $med_info->update([
//                    'stock' => $update_stock,
//                    'stock_alert' => $request->alert_id[$i],
//                    'status' => '1'
//                ]);
//            }
        }

        return redirect()-> route('purchase_invoice',$purchase->id)->with('message','Purchase Added Successfully!');
    }

    // pos
    public function pos(Request $request)
    {
        // search
        if($request->search == null){
            $adpurchase = Stock::where('status',1)->get();
        }else{
            $adpurchase = Stock::Join('medicines','stocks.madicine_id','=','medicines.id')->where('medicines.name','LIKE', '%'.$request->search.'%')->where('stocks.status',1)->get(['stocks.*']);
        }
        // cart
        $pos = Cart::content();
        $customers = Customer::where('status',1)->get();
        return view('backend.layout.pos',compact('pos','adpurchase','customers'))->withInput('search');
    }

    public function addtocart($id)
    {
        $med = Medicine::find($id);
        Cart::add(
        [
            'id' => $med -> id,
            'name' => $med->name,
            'qty' => 1,
            'price' => $med ->price,
            'weight' => 1,
            'options' => ['image' => $med->image],
        ]);
        return back();
    }

    public function cart_increment(Request $request){

        $cart = Cart::get($request->row_id);
        
        $stock = Stock::where('madicine_id',$cart->id)->first();
        $newStock = $stock->stock - $request->quantity;
        if($newStock < 0){
            return back()->with('message','Medicine Is Out Of Stock! Please check.');
        }else{
            cart::update($request->row_id, $request->quantity);
            return back();
        }

    }

    public function deletecart($id)
    {
        Cart::remove($id);
        return back();
    }

    public function pos_clear(){
        Cart::destroy();
        return back();
    }

    // pos-sale
    public function pos_sale(Request $request)
    {
//        dd($request->all());
        $request->validate(
            [
                'customer_id' => ['required','integer'],
            ]
        );

        $carts = Cart::content();
        $check = $carts->count();
        if($check != 0){

            foreach($carts as $cart){
                $stock = Stock::where('madicine_id',$cart->id)->first();
                $newStock = $stock->stock - $cart->qty;
                if($newStock < 0){
                    return back()->with('message','Medicine Is Out Of Stock! Please check.');
                }
            }

            $cart_count = $carts->count();
            $date = Carbon::now()->format('Y-m-d');

            $invoice = Pos::latest('id')->first();
            if($invoice == null){
                $invoice_code = "INV-1";
            }else{
                $invoice_code= "INV-".$invoice->id;
                $invoice_code++;
            }

            $pos = Pos::create(
                [
                    'date'=>$date,
                    'invoice_no'=>$invoice_code,
                    'seller_id'=> auth()->user()->id,
                    'customer_id'=>$request->customer_id,
                    'total_quantity'=>$cart_count,
                    'net_total'=>$request->net_total,
                    'total_amount'=>$request->total_amount,
                    'vat'=>$request->vat_amount,
                    'discount_amount'=>$request->discount_amount,
                    'paid_amount'=>$request->paid_amount,
                    'change_amount'=>$request->change_amount,
                    'due_amount'=>$request->due_amount,
                ]
            );

            foreach($carts as $cart){
                Subpos::create([
                    'pos_id' => $pos->id,
                    'madicine_id' => $cart->id,
                    'quantity' => $cart->qty,
                    'per_price' => $cart->price,
                    'subtotal_price' => $cart->subtotal,
                ]);

                $stock = Stock::where('madicine_id',$cart->id)->first();
                $med = Medicine::find($cart->id);

                $newStock = $stock->stock - $cart->qty;

                if($newStock > 0){
                    $stock->update([
                        'stock' => $newStock
                    ]);
                    if($newStock <= $stock->stock_alert && $med->show_at_purchase == 1){
                        $med->update([
                            'show_at_purchase' => 0
                        ]);
                    }
                }else{
                    $stock->update([
                        'stock' => 0,
                        'status' => 0
                    ]);
                    $med->update([
                        'show_at_purchase' => 0
                    ]);
                }

            }

            Cart::destroy();

            return redirect()->route('invoice',$pos->id)->with('Order Placed Successfully!');
        }
        else{
            return back()->with('error','Please Add Medicine And Recipient First!');
        }

    }

    public function due_pos(Request $request){
        $pos_item = Pos::find($request->PosId);

        if($request->due_up_amount > $pos_item->due_amount){
            $change = $request->due_up_amount - $pos_item->due_amount;
            $total = $pos_item->paid_amount + $request->due_up_amount;
            $pos_item->update([
                'paid_amount' => $total,
                'due_amount' => 0,
                'change_amount' => $change
            ]);
        }else{
            $due = $pos_item->due_amount - $request->due_up_amount;
            $total = $pos_item->paid_amount + $request->due_up_amount;
            $pos_item->update([
                'paid_amount' => $total,
                'due_amount' => $due,
                'change_amount' => 0
            ]);
        }

        return back()->with('message','Pos Due Updated Successfully!');

    }

    public function deletepos(Request $request)
    {
        // dd($request->all());
        Pos::find($request->DelPosId)->delete();
        return redirect()-> back();
    }

    //invoice
    public function invoice($id)
    {
        $order = Pos::find($id);
        $word = $this->numberToWord($order->paid_amount);

        return view('backend.layout.sale_invoice',compact('order','word'));
    }
    public function purchase_invoice($id)
    {
        $purchase = Purchase::find($id);
        $word = $this->numberToWord($purchase->paid_amount);

//        dd($purchase->subpurchase->sum('sub_total'));
        return view('backend.layout.purchase_invoice',compact('purchase','word'));
    }
    // public function invoice()
    // {

    //     return view('backend.layout.invoice');
    // }

    // pos sale list
    public function possale()
    {
        $pos = Pos::all();
        return view('backend.layout.possale',compact('pos'));
    }






    // account= expense
    public function account_expense(Request $request)
    {
        if($request->start == null && $request->ended == null)
        {
        $expenses=Purchase::orderBy('id','desc')->where('status',1)->paginate(5);
        }else{
            $expenses = Purchase::where('date', '>=', $request->start)->where('date', '<=', $request->ended)->paginate(5);
            // dd($sale_date);
        }
        $expenseYearTotal = Purchase::whereYear('date', Carbon::now()->year)->sum('paid_amount');
        $expenseMonthTotal = Purchase::whereYear('date', Carbon::now()->year)->whereMonth('date', Carbon::now()->month)->sum('paid_amount');
        $expenseDailyTotal = Purchase::whereYear('date', Carbon::now()->year)->whereMonth('date', Carbon::now()->month)->whereDay('date', Carbon::now()->day)->sum('paid_amount');
        
        // dd($expenseYearTotal,$expenseMonthTotal,$expenseDailyTotal);
        $incomes=Pos::orderBy('id','desc')->paginate(5);
        $incomeYearTotal = Pos::whereYear('date', Carbon::now()->year)-> sum('paid_amount');
        $incomeMonthTotal = Pos::whereYear('date', Carbon::now()->year)->whereMonth('date', Carbon::now()->month)->sum('paid_amount');
        $incomeDailyTotal = Pos::whereYear('date', Carbon::now()->year)->whereMonth('date', Carbon::now()->month)-> whereDay('date', Carbon::now()->day)->sum('paid_amount');
        // dd($total);
        return view('backend.layout.account', compact('expenses','incomes','expenseYearTotal','expenseMonthTotal','expenseDailyTotal','incomeYearTotal','incomeDailyTotal','incomeMonthTotal'));
    }
    public function expense(Request $request)
    {
        $request->validate(
            [
            'title' => ['required'],
            'amount' => ['required'],
            ]
        );
        Account::create(
            [
                'title'=>$request->title,
                'amount'=>$request->amount,
            ]
        );
        return redirect()-> back();
    }

    // account =income
    public function account_income(Request $request)
    {
        if($request->begin == null && $request->end == null){
            $incomes=Pos::orderBy('id','desc')->paginate(5);
            // dd($expired);
        }else{
            $incomes = Pos::where('date', '>=', $request->begin)->where('date', '<=', $request->end)->paginate(5);
            // dd($sale_date);
        }
        $incomeYearTotal = Pos::whereYear('date', Carbon::now()->year)-> sum('paid_amount');
        $incomeMonthTotal = Pos::whereYear('date', Carbon::now()->year)->whereMonth('date', Carbon::now()->month)->sum('paid_amount');
        $incomeDailyTotal = Pos::whereYear('date', Carbon::now()->year)->whereMonth('date', Carbon::now()->month)-> whereDay('date', Carbon::now()->day)->sum('paid_amount');
        $expenses=Purchase::orderBy('id','desc')->paginate(5);
        $expenseYearTotal = Purchase::whereYear('date', Carbon::now()->year)->sum('paid_amount');
        $expenseMonthTotal = Purchase::whereYear('date', Carbon::now()->year)->whereMonth('date', Carbon::now()->month)->sum('paid_amount');
        $expenseDailyTotal = Purchase::whereYear('date', Carbon::now()->year)->whereMonth('date', Carbon::now()->month)->whereDay('date', Carbon::now()->day)->sum('paid_amount');
        return view('backend.layout.account', compact('expenses','incomes','expenseYearTotal','expenseMonthTotal','expenseDailyTotal','incomeYearTotal','incomeMonthTotal','incomeDailyTotal'));
    }

    // stock
    public function stock_report(Request $request)
    {
        // $adpurchase=Subpurchase::Join('purchases','purchases.id','=','subpurchases.purchase_id')->Join('medicines','medicines.id','=','subpurchases.madicine_id')->get(['subpurchases.*','purchases.*','medicines.name']);
        if($request->search == null){
            $stock=Stock::Join('medicines','medicines.id','=','stocks.madicine_id')
                        ->where('stocks.status','=',1)
                        ->get(['stocks.*','medicines.name']);
        }else{
            $stock=Stock::Join('medicines','medicines.id','=','stocks.madicine_id')
                        ->where('medicines.name','Like',$request->search.'%')
                        ->where('stocks.status','=',1)
                        ->get(['stocks.*','medicines.name']);
        }
        $expired = Expiredmedicine::all();
        return view('backend.layout.stock',compact('stock','expired'));
    }
    public function expiry_report(Request $request)
    {
        $stock=Stock::all();
        if($request->begin == null && $request->q == null){
            $expired = Expiredmedicine::all();
            // dd($expired);
        }else{
            $expired = Expiredmedicine::where('expire_date', '>=', $request->begin)->where('expire_date', '<=', $request->q)->get();
        }
        return view('backend.layout.stock',compact('expired','stock'));
    }

    // logout
    public function logout(Request $request)
    {

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/')->with('message','Successfully Logout!');
    }

    public function numberToWord($num = '')
    {
        $num    = ( string ) ( ( int ) $num );

        if( ( int ) ( $num ) && ctype_digit( $num ) )
        {
            $words  = array( );

            $num    = str_replace( array( ',' , ' ' ) , '' , trim( $num ) );

            $list1  = array('','one','two','three','four','five','six','seven',
                'eight','nine','ten','eleven','twelve','thirteen','fourteen',
                'fifteen','sixteen','seventeen','eighteen','nineteen');

            $list2  = array('','ten','twenty','thirty','forty','fifty','sixty',
                'seventy','eighty','ninety','hundred');

            $list3  = array('','thousand','million','billion','trillion',
                'quadrillion','quintillion','sextillion','septillion',
                'octillion','nonillion','decillion','undecillion',
                'duodecillion','tredecillion','quattuordecillion',
                'quindecillion','sexdecillion','septendecillion',
                'octodecillion','novemdecillion','vigintillion');

            $num_length = strlen( $num );
            $levels = ( int ) ( ( $num_length + 2 ) / 3 );
            $max_length = $levels * 3;
            $num    = substr( '00'.$num , -$max_length );
            $num_levels = str_split( $num , 3 );

            foreach( $num_levels as $num_part )
            {
                $levels--;
                $hundreds   = ( int ) ( $num_part / 100 );
                $hundreds   = ( $hundreds ? ' ' . $list1[$hundreds] . ' Hundred' . ( $hundreds == 1 ? '' : 's' ) . '' : '' );
                $tens       = ( int ) ( $num_part % 100 );
                $singles    = '';

                if( $tens < 20 ) { $tens = ( $tens ? '' . $list1[$tens] . '' : '' ); } else { $tens = ( int ) ( $tens / 10 ); $tens = ' ' . $list2[$tens] . ' '; $singles = ( int ) ( $num_part % 10 ); $singles = ' ' . $list1[$singles] . ' '; } $words[] = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_part ) ) ? ' ' . $list3[$levels] . ' ' : '' ); } $commas = count( $words ); if( $commas > 1 )
        {
            $commas = $commas - 1;
        }

            $words  = implode( ',' , $words );

            $words  = trim( str_replace( ',' , ',' , ucwords( $words ) )  , ',' );
            if( $commas )
            {
                $words  = str_replace( ',' , 'and' , $words );
            }

            return $words;
        }
        else if( ! ( ( int ) $num ) )
        {
            return 'Zero';
        }
        return '';
    }


}
