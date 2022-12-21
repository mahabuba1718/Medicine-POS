<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Builder\Function_;

class Medicine extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }
    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id','id');
    }
    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id','id');
    }
    public function stock()
    {
        return $this->hasOne(Stock::class, 'madicine_id','id');
    }
}
