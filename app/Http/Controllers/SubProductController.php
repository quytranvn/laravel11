<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Value;

use App\Product;

use App\Size;

use App\Attribute;

use App\DeTailProduct;

use  Yajra\Datatables\Datatables;

use App\Http\Requests\StoreRequestDetailPro;

use App\Http\Requests\UpdateRequestDetailPro;

class SubProductController extends Controller
{
    public function index(){

    	return view('admin.products.listProduct/detail');
    }

    public function subDataTableProduct($id){

    	$details = DeTailProduct::where('product_id',$id)->orderBy('id','desc')->get();

    	return datatables()->of($details)

    	->addColumn('action', function ($detail) {
            return '
            <button 
            data-toggle="modal"
            data-target="#edit-detail-product"
            class="btn btn-sm btn-info btn-edit-detail" 
            data-id="'.$detail->id.'"><i class="fa fa-wrench" aria-hidden="true"></i>
            </button>

            <button class="btn btn-sm  btn-danger btn-delete-sub"  data-id="'.$detail->id.'"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
            ';})
       ->editColumn('color',function($detail1){
        return '<div style="height:10px;width:100px;background:'.$detail1->color.'"></div>';
        })
       ->rawColumns(['action','color']) 
       ->toJson();
   }



    public function storeDetail(StoreRequestDetailPro $request,$id) {
        $data = $request->all();

        unset($data['_token']);

        $product= Product::find($id);

        $datadetail=DeTailProduct::where('code',$data['code'])->where('size',$data['size'])->where('color',$data['color'])->first();
    
        if($datadetail != null){

            $abc=DeTailProduct::where('product_id', $id)->first();
            DeTailProduct::where('product_id', $id)->update([
                'quantity' => $data['quantity']+$abc['quantity'],    
 
            ]);

        }else{
            DeTailProduct::create([
            'product_id' => $id,
            'code' => $data['code'],
            'quantity' => $data['quantity'],
            'size' => $data['size'],
            'color' => $data['color'],
            ]);
        }
        

 
        return response()->json([
                'error' => false,
            ]);
        
    }


    public function edit(Request $request,$id){

        $detailProduct = DeTailProduct::find($id);

        return $detailProduct;
    }


    public function update(UpdateRequestDetailPro $request,$id){

        $detailProduct = DeTailProduct::find($id)->update($request->all());
        return response()->json([
            'data'=>$detailProduct,
        ]);
    }

    public function destroy($id){
       $abc= DeTailProduct::find($id)->delete();
        return response()->json(['message' => 'Xóa Thành Công']);
    }

}
