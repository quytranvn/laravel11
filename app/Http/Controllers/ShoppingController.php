<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;

use DB;

use App\DeTailProduct;

use App\ProductImage;

class ShoppingController extends Controller
{
    public function index(){
	
  	
	 	$products = Product::get();

	     foreach($products as $product){

	     	$product->price = number_format($product->price);
	     }
	     $image=array(
	     	'size'=>null,
	     	'color' => null,
	     	'code' => null,
	     	'link' => null,	     
	    );
    	return view('shop.home')->with([
    		'products' => $products, 
    		'images'=>$image,
    	]);

	}

	public function detail ( Request $request,$id)
	{
		$product = Product::with('product_detail', 'product_thumbnails')->find($id);

		$product['price'] = number_format($product['price']);
	
		return $product;
	}

	public function cart(Request $request,$id){


   //  $product = $request->all()
    
  	// dd($product)

    // return $product;
	}
}
