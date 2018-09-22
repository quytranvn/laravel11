<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
 	/**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$imageName = request()->file->getClientOriginalName();
        dd($imageName);
        request()->file->move(public_path('upload'), $imageName);


    	return response()->json(['uploaded' => '/upload/'.$imageName]);
    	
    	// $path = $request->file-store('image');

    	\DB::table('product_thumbnail')
    			->create([
    				'product_id' => $request->product_id,
    				'link'=>$path,
    			]);
    	//  return response()->json(['uploaded' => '/upload/'.$path]);
    }
}
