<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class Product extends Model
{
    use HasFactory,Translatable;
    protected $guarded = [];
    public $translatedAttributes = ['name','description'];
    public $appends = ['profit_percent'];

    public function getProfitPercentAttribute(){
        $profit = $this->sale_price - $this->purchase_price;
        $profit_percent = $profit * 100 / $this->purchase_price;
        return number_format($profit_percent,2);
    }
    public function category()
    {
        return $this->belongsTo('App\Models\category');
    }
}
