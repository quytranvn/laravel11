<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\StoreRequestUser;

use App\Http\Requests\UpdateRequestUser;

use App\User;

// use Datatables;

use Yajra\Datatables\Datatables;

class UserController extends Controller
{
    
    public function index(){
    	
    	return view('admin.user.list');
    }

    public function dataTableListUser(){

    	$user = User::orderBy('id','desc');

    	return datatables()->of($user)

    	->addColumn('action', function ($users) {
                return '<button class="btn btn-sm btn-info"
                 	data-id="'.$users->id.'"
                	data-toggle="modal"
        			data-target="#show"><i class="fa fa-user-secret" aria-hidden="true"></i></button>
                <button class="btn btn-sm btn-warning" data-id="'.$users->id.'"
					data-toggle="modal"
        			data-target="#update"
                 ><i class="fa fa-user-md" aria-hidden="true"></i></button>
                <button class="btn btn-sm btn-danger"  data-id="'.$users->id.'"><i class="fa fa-user-times" aria-hidden="true"></i></button>';
            })
        ->editColumn('email', function($user1) {
                    return '<a href="mailto:'. $user1->email .'">'.$user1->email.'</a>';
                })
        ->rawColumns(['email','action'])	
    	->toJson();
    }


    public function destroy($id){

    	User::find($id)->delete();

    	return response()->json(['message' => 'Xóa Thành Công']);
    }


    public function show(Request $request,$id){

    	$users= User::find($id);
    	return response()->json(['data'=>$users]);
    }

    public function edit(Request $request,$id){
        $users = User::find($id);
        return response()->json(['data'=>$users]);
    }


    public function update(UpdateRequestUser $request,$id){

     $users = User::find($id)->update($request->all());
	
      return response()->json(['data'=>$users]);

  
    }


    public function store(StoreRequestUser $request){
    	$data = $request->all();
        // dd($data);
    	$data['password'] = bcrypt($data['password']);

        $users = User::create($data);

        return response()->json([
            'data'=>$users,
        ],200);
    }
}
