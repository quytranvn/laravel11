<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeTailProduct extends Model
{
    protected $table = 'product_detail';

    protected $fillable = ['product_id','code','name','size','color','quantity'];
}
