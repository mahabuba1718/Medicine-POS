<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function medicine()
    {
        return $this->belongsTo(Medicine::class,'madicine_id','id');
    }
}
