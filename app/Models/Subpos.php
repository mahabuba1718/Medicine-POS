<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subpos extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function pos()
    {
        return $this->belongsTo(Pos::class, 'pos_id','id');
    }
    public function med()
    {
        return $this->belongsTo(Medicine::class, 'madicine_id','id');
    }
}
