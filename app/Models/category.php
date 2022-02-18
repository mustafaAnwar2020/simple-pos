<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;


class category extends Model
{
    use HasFactory,Translatable;
    protected $guarded = [];
    public $translatedAttributes = ['name'];


public function products()
{
    return $this->hasMany('App\Models\Product', 'category_id');
}
}


