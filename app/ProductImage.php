<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = 'product_thumbnail';

    protected $fillable = ['product_id','link'];

}
