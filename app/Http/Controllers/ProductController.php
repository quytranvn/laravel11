<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 

use App\Attribute;

use App\Value;

use App\ProductImage;

use App\Size; 

use DB;

use App\Vendor; 

use App\prducedAt; 

use App\DeTailProduct;

use App\Product;

use App\Productvendor;

use App\Http\Requests\StoreProductRequest;

use App\Http\Requests\UpdateProductRequest;

use  Yajra\Datatables\Datatables;

class ProductController extends Controller
{
	
	public function index(){

		$atts = Attribute::select('id','column','type')->get();

		$abc= Size::select('id','name')->get();

       return view('admin.products.listProduct',[
          'atts' => $atts,
          'sizes'=>$abc,
      ]);
   }

   public function dataTableListProduct(){

       $products = Product::orderBy('id','desc');

       return datatables()->of($products)

       ->addColumn('action', function ($product) {
        return '
        <button class="btn btn-sm btn-default btn-showdetail" 
        data-id="'.$product->id.'" dataId="'.$product->id.'"><i class="fa fa-pencil" aria-hidden="true"></i>
        </button>

        <button class="btn btn-sm btn-info"
        data-id="'.$product->id.'"
        data-toggle="modal"
        data-target="#show"><i class="fa fa-eye" aria-hidden="true"></i>
        </button>

        <button 
        data-toggle="modal"
        data-target="#edit-product"
        class="btn btn-sm btn-warning" 
        data-id="'.$product->id.'"><i class="fa fa-wrench" aria-hidden="true"></i>
        </button>

        <button
        data-toggle="modal"
        data-target="#modal-add-image"
        class="btn btn-sm btn-primary btn-upload-image "  data-id="'.$product->id.'"><i class="fa fa-cloud-upload" aria-hidden="true"></i></button>

        <button class="btn btn-sm btn-danger"  data-id="'.$product->id.'"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
        ';})

       ->rawColumns(['action','description','vendor'])

       ->toJson();
   }

   public function store(StoreProductRequest $request) {
      $data = $request->all();

      $data['slug']=str_slug($data['name']).'_'.time();

      unset($data['_token']);

      $product = Product::create($data);

      $vendor = Vendor::create($data);


      // them vao  vao bang product_vendor
      $pro = Productvendor::create([
        'product_id' => $product->id,
        'vendor_id' => $vendor->id,
    ]);


      foreach($data as $key =>$value) {
         $att = Attribute::where('column',$key)->first();

         if(isset($att)){
            Value::create([
               'product_id' => $product->id,
               'attribute_id' => $att->id ,
               'value' => $value	
           ]);
        }
    }

    return redirect()->route('product.index');
}



public function destroy($id){

   Product::find($id)->delete();
   Value::where( 'product_id', $id )->delete();
   DeTailProduct::where( 'product_id', $id )->delete();

   return response()->json(['message' => 'Xóa Thành Công']);
}


public function show(Request $request,$id){

    $product = Product::find($id);
    
    $product['price'] = number_format( $product['price']);

    $DP = DeTailProduct::where('product_id',$id)->paginate();

    $images = ProductImage::where('product_id',$id)->paginate();

    $arr=[];
    
    foreach ($images as $key =>$image){
        $arr[$key] = $image->link;
    }
    return response()->json([
        'data'=>$product,
        'dataDetail' =>$DP->all(),
        'image'=> $arr,
    ]);
}

public function edit(Request $request,$id){

    $product = Product::find($id);

    return $product;
}


public function update(UpdateProductRequest $request,$id){

    $product = Product::find($id)->update($request->all());

    return response()->json(['data'=>$product]);
}


public function upload(Request $request){

    $path=$request->file->storeAs('images','image_'.time().'.png');

    $proImg = ProductImage::create([
        'product_id'=>$request->product_id,
        'link'=>$path,
    ]);
    return response()->json([
        'data' => $proImg
    ]);
}

}
