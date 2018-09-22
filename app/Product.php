<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
     protected $table = 'products';

    protected $fillable = ['quantity','vendor','name','description','slug','price'];

    public function vendor(){

    	return $this->belongsTo('App\vendor','product_vendor','product_id','vendor_id');
    }

    public function product_detail() {
    	return $this->hasOne('App\DeTailProduct', 'product_id');
    }

    public function product_thumbnails() {
    	return $this->hasMany('App\ProductImage', 'product_id');
    }
}
