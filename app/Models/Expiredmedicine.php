<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expiredmedicine extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function subpurchase()
    {
        return $this->belongsTo(Subpurchase::class,'subpurchase_id','id');
    }
}
