<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pos extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function subpos()
    {
        return $this->hasMany(Subpos::class, 'pos_id','id');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id','id');
    }
    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id','id');
    }
}
