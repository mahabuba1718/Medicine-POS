<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function subpurchase()
    {
        return $this->hasMany(Subpurchase::class,'purchase_id','id');
    }
    public function medicine()
    {
        return $this->belongsTo(Medicine::class,'madicine_id','id');
    }
    public function supplier_info()
    {
        return $this->belongsTo(Supplier::class,'supplier','id');
    }
}

