<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Productvendor extends Model
{
     protected $table="product_vendor";

    protected $fillable = ['product_id','vendor_id'];

    public static function store($data){

		$product_vendor = Productvendor::create($data);
		return $product_vendor;
	}
}
