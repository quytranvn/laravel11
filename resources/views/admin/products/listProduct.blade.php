@extends('layouts.maste-Admin') 
@section('admin-content') 
<a class="btn btn-primary" data-toggle="modal" href='#modal-id' style="background-color:#7FFF00;"><i class="fa fa-plus-circle" aria-hidden="true"></i></a><br><br>  
<div class="box">
	<div class="box-header with-border">
		<h3 class="box-title">Products Tables</h3>
	</div>

	<div class="box-body">
		<table class="table table-bordered" id="products-table">
			<thead>
				<tr>
					<th>Id</th>
					<th>Name</th>
					<th>Description</th>
					<th>Vendor</th>
					<th>Action</th>
				</tr>
			</thead>
		</table>
	</div>
	<!-- /.box-body -->
</div>



<!-- Modal add -->
<div class="modal fade" id="modal-id">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Add new product</h4>
			</div>
			<div class="modal-body">
				<form action="" method="POST" role="form" id="add">
					@csrf

					<div class="form-group">
						<label for="">Name</label>
						<input type="text" class="form-control"  id="name" name="name"  placeholder="name" value="{{old('name')}}">
						@if($errors->has('name'))
						<div class="alert alert-danger">
							{{$errors->first('name')}};
						</div>
						@endif
					</div>

					<div class="form-group">
						<label for="">Price</label>
						<input type="text" class="form-control"  id="price" name="price"  placeholder="price" value="{{old('price')}}">
						@if($errors->has('price'))
						<div class="alert alert-danger">
							{{$errors->first('price')}};
						</div>
						@endif
					</div>
					<div class="form-group">
						<label for="">Description</label>
						<textarea type="text" class="form-control"  id="description" name="description"  rows="10" cols="80"  value="{{old('description')}}"></textarea>
						@if($errors->has('description'))
						<div class="alert alert-danger">
							{{$errors->first('description')}};
						</div>
						@endif
					</div>
					<div class="form-group">
						<label for="">Vendor</label>
						<input type="text" class="form-control"  id="vendor" name="vendor"  placeholder="vendor" value="{{old('vendor')}}">
					</div>

					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" data-id="$products->id" class="btn btn-success">Add Product</button>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- Modal add chi tiết -->
<div class="modal fade" id="modal-add-detail">
	<div class="modal-dialog">
		<div class="modal-content" style="width: 150%;height: 80%;">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Add detail product</h4>
			</div>
			<div class="modal-body">
				<form action="" method="POST" role="form" id="add-detail">
					@csrf
					<input type="hidden" id="idup" value="">
					<div class="col-md-8">
						<table class="table table-bordered" id="detail-table">
							<thead>
								<tr>
									<th>#</th>
									<th>Code</th>
									<th>Size</th>
									<th>color</th>
									<th>quantity </th>
									<th>Action</th>
								</tr>
							</thead>
						</table>
					</div>
					<div class="col-md-4">
						@foreach($atts as $att)
						<div class="form-group">

							<label for="">{{$att->column}}</label>

							@if($att-> type == 2)
							<textarea class="form-control" id="{{$att->column}}" name="{{$att->column}}" placeholder="{{$att->column}}"></textarea>

							@elseif ($att-> type == 3)
							<input type="color"style="width: 150px;" class="form-control" id="{{$att->column}}" name="{{$att->column}}" placeholder="{{$att->column}}">

							@elseif($att-> type == 4) 
							<select name="{{$att->column}}" class="form-control" id="{{$att->column}}" name="{{$att->column}}">
								@if(count($sizes)>0)
								@foreach ($sizes as $size)
								<option value="{{$size->name}}">{{$size->name}}</option>
								@endforeach
								@endif
							</select>
							@else 
							<input type="text" class="form-control" id="{{$att->column}}" name="{{$att->column}}" placeholder="{{$att->column}}">	

							@endif

						</div>
						@endforeach
						
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" id="btn-add-detail" class="btn btn-success btn-success-add">Add</button>
			</div>
		</div>
	</div>
</div>

<!-- Modal show -->
<div class="modal fade" id="show">
	<div class="modal-dialog">
		<div class="modal-content" >
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Detail product</h4>
			</div>
			<div id="modal-body-show" >
				
				<form action="" method="POST" role="form" id="showww">
					<div class="col-md-8">
						<label>Image</label>
						<h4><img id="post_thumbnail" class="post_thumbnail" src='' name="post_thumbnail" width="350px" height="450px"></h4>
						<label>Color</label>( <span class="attk" > * </span> )
						<h4><div class="Pcolor" style="height:50px;width:100px; border-radius: 50%;"></div></h4><hr>
					</div>
					<div class="col-md-4">
						<label>Name</label>  <span class="attk">:</span> 
						<h4 class="Pname"></h4><hr>
						<label>Description</label> <span class="attk">:</span> 
						<h4 class="Pdescription"></h4><hr>
						<label>Price</label> <span class="attk">:</span> 
						<h4 class="Pprice"></h4><hr>
						<label>Vendor</label> <span class="attk">:</span> 
						<h4 class="Pvendor"></h4><hr>
						<label>Quantity</label> <span class="attk">:</span> 
						<h4 class="Pquantity"></h4><hr>
						<label>Code</label> <span class="attk">:</span> 
						<h4 class="Pcode"></h4><hr>
						<label>Size</label> <span class="attk">:</span> 
						<h4 class="Psize"></h4><hr>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>


<!-- Modal add-image -->
<div class="modal fade" id="modal-add-image">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Upload Your picture</h4>
			</div>
			<div class="modal-body">

				{{-- <div class="main-section">   --}}

					{!! csrf_field() !!}
					<div class="form-group">
						<div class="file-loading">
							<input id="file-1" type="file" name="file" multiple class="file" data-overwrite-initial="false" data-min-file-count="2">
						</div>
					</div>
				{{-- </div> --}}	
			</div>
			<div class="modal-footer">
				<input type="hidden" name="" id="product_id">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

</div>
</div>
<!-- Modal edit -->
<div class="modal fade" id="edit-product">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Cập Nhật Sản Phẩm</h4>
			</div>
			<div class="modal-body">
				<form action="" method="POST" role="form" id="edit">
					@csrf
					<input type="hidden" id="idup" value="">

					<div class="form-group">
						<label for="">Name</label>
						<input type="text" class="form-control p-name"  id="name1" name="name"  placeholder="name">	
					</div>

					<div class="form-group">
						<label for="">description</label>
						<textarea type="text" class="form-control"  id="description1" name="description1"  rows="10" cols="80"  value="{{old('description1')}}"></textarea>
					</div>
					<div class="form-group">
						<label for="">Vendor</label>
						<input type="text" class="form-control p-ven" id="vendor1" name="Vendor"  placeholder="Vendor" >
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-success btn-update-product" >update</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- Modal edit  detail-->
<div class="modal fade" id="edit-detail-product">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">update detail product</h4>
			</div>
			<div class="modal-body">
				<form action="" method="POST" role="form" id="edit">
					@csrf
					<input type="hidden" id="idup" value="">

					<div class="form-group">
						<label for="">Code</label>
						<input type="text" class="form-control p-name"  id="code" readonly name="code"  placeholder="code">	
					</div>

					<div class="form-group">
						<label for="">Size</label>
						<select name="{{$att->column}}" class="form-control size1P" id="{{$att->column}}" name="{{$att->column}}">
							@if(count($sizes)>0)
							@foreach ($sizes as $size)
							<option value="{{$size->name}}">{{$size->name}}</option>
							@endforeach
							@endif
						</select>	
					</div>
					<div class="form-group">
						<label for="">Quantity</label>
						<input type="text"  class="form-control p-name"  id="quantity1" name="quantity"  placeholder="quantity">	
					</div>
					<div class="form-group">
						<label for="">Color</label>
						<input type="color" style="width: 100px; height: 50px;border-radius: 50%;" class="form-control p-name"  id="color1" name="color"  placeholder="color">	
					</div>
					
					

				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-success btn-update-detail-product" >update</button>
			</div>
		</div>
	</div>
</div>
@endsection('admin-content') 




@section('ajax-product')
<script >

	CKEDITOR.replace( 'description' );

	CKEDITOR.replace( 'description1' );


	$(function() {
		$('#products-table').DataTable({
			processing: true,
			serverSide: true,
			ajax: '{!! route('product.list') !!}',
			columns: [
			{ data: 'id', name: 'id' },
			{ data: 'name', name: 'name' },
			{ data: 'description', name: 'description'},
			{ data: 'vendor', name: 'vendor' },
			{ data: 'action', name: 'action' },
			]
		}); 


	    //data-table -add-chi tiet
	    $('#products-table').on('click', '.btn-showdetail', function(e) {
	    	e.preventDefault();
	    	
	    	var id = $(this).attr('data-id');
	    	detailTaable = $('#detail-table').DataTable();
	    	detailTaable.destroy();
	    	// $('#detail-table').DataTable().ajax.reload(null, false)
	    	$('#modal-add-detail').modal('show');
	    	$('#btn-add-detail').attr('data-iddetail', id);

	    	var detailTaable = $('#detail-table').DataTable({

	    		processing: true,
	    		serverSide: true,
	    		ajax: '/admin/product/listProducts/detail/'+id,
	    		columns: [
		    		{ data: 'product_id', name: 'product_id' },
		    		{ data: 'code', name: 'code' },
		    		{ data: 'size', name: 'size'},
		    		{ data: 'color', name: 'color' },
		    		{ data: 'quantity', name: 'quantity' },
		    		{ data: 'action', name: 'action' }
	    		]
	    	}); 
	    	detailTaable.destroy();   
	    		// $('#detail-table').DataTable().ajax.reload(null, false);
	    });

	     // lay id
	    $(document).on('click','.btn-default',function(){
	     	var id=$(this).data('id');
	     	$('#idup').attr('data-id',id);
	    })

		// // xem chi tiết product bằng ajax
		$(document).on('click','.btn-info',function(){
			var id=$(this).data('id');
			$('.Pname').html('')
			$('.Pdescription').html('')
			$('.Pprice').html('')
			$('.Pvendor').html('')
			$('.Pquantity').html('')
			$('.Pcode').html('')
			$('.Psize').html('')
			$('.Pcolor').css('background','white')
			$('.post_thumbnail').attr('src','')
			$.ajax({
				type: 'get',
				url: '{{asset('')}}admin/product/show/'+id,
				success: function(response) {
					$('.Pname').html(response.data.name);
					$('.Pdescription').html(response.data.description);
					$('.Pvendor').html(response.data.vendor);
					$('.Pprice').html(response.data.price);
					$('.Pquantity').html(response.dataDetail[0].quantity);
					$('.Pcode').html(response.dataDetail[0].code);
					$('.Psize').html(response.dataDetail[0].size);
					$('.Pcolor').css('background',response.dataDetail[0].color);
					$('.post_thumbnail').attr('src','{{asset("storage/")}}/'+response.image[0]);
				}
			})
		})


		// thêm mới sp = ajax
		$('#add').submit(function(e) {
			e.preventDefault();
			$.ajax({
				type: 'post',
				url: "{{route('product.store')}}",

				data: {

					name: $('#name').val(),
					price: $('#price').val(),
					description:CKEDITOR.instances['description'].getData(),
					vendor: $('#vendor').val(),	
				},
				success:function(response){
					
					toastr.success('Thêm Mới Sản Phẩm Thành công!');

					setTimeout(function(){
						window.location.href = "{{route('product.index')}}"
					},800);
				},
				error:function(jqXHR,testStatus,errorThrown){
					
					toastr.error(jqXHR.responseJSON.errors.name[0])
					toastr.error(jqXHR.responseJSON.errors.description[0])
					toastr.error(jqXHR.responseJSON.errors.vendor[0])
				}
			})
		})
		
		//edit sản phẩm bằng ajax
		$(document).on('click','.btn-warning',function(){
			var id =$(this).data('id');
			$('#idup').attr('data-id',id);
			$.ajax({
				type : 'get',
				url  : "{{asset('')}}admin/product/"+ id+"/edit",

				success: function(response) {
					
					$('.p-name').val(response.name);
					CKEDITOR.instances['description1'].setData(response.description);
					$('.p-ven').val(response.vendor);

				}
			})
		});

		// update sản phẩm bằng ajax()
		$(document).on('click','.btn-update-product',function(e){
			e.preventDefault();
			var id =$('#idup').data('id');

			var fd = new FormData();
			fd.append('name', $('#name1').val());
			fd.append('description', CKEDITOR.instances['description1'].getData());
			fd.append('vendor',$('#vendor1').val());
			fd.append('_token',$('input[name="_token"]').val());

			$.ajax({
				type: 'post',
				url:  "{{asset('')}}admin/product/"+ id,
				processData: false,
				contentType: false,
				data: fd,
				success:function(response){
					toastr.success('update Sản Phẩm Thành công!');
					setTimeout(function(){
						window.location.href = "{{route('product.index')}}"
					},800);
				},
				error:function(jqXHR,testStatus,errorThrown){
					toastr.error(jqXHR.responseJSON.errors.name[0])
					toastr.error(jqXHR.responseJSON.errors.description[0])
					toastr.error(jqXHR.responseJSON.errors.vendor[0])
				}
			});
		});

	    // xóa product  bằng ajax
	    $(document).on('click','.btn-danger',function(){
	    	var id =  $(this).data('id');
	    	swal({
	    		title: "Bạn có muốn xóa không?",
	    		text: "Sau khi xóa bạn sẽ không thể khôi phục được tệp!",
	    		icon: "warning",
	    		buttons: true,
	    		dangerMode: true,
	    	})
	    	.then((willDelete) => {
	    		if (willDelete) {
	    			$.ajax({
	    				type: 'delete',
	    				url: '{{ asset('') }}admin/product/'+id,
	    				success: function(response){
	    					$('#products-table').DataTable().ajax.reload(null, false);
	    				}
	    			}); 
	    			swal("Tệp của bạn đã được xóa!", {
	    				icon: "success",
	    			});
	    		} else {
	    			swal("Hủy xóa thành công!!");
	    		}
	    	});
	    });

	    // ajax xu li san pham
	    //  thêm chi tiết product bằng ajax
	    $(document).on('click','.btn-success-add',function(e){
	    	var id=$('#idup').data('id');
	    	var idDetail = $('#btn-add-detail').attr('data-iddetail');
	    	e.preventDefault();
	    	$.ajax({
	    		type: 'post',
	    		url: "{{asset('')}}admin/product/listProducts/store/"+idDetail,
	    		data: {

	    			size: $('#size').val(),
	    			quantity: $('#quantity').val(),
	    			color: $('#color').val(),
	    			code: $('#Code').val(),
	    		},
	    		success: function(response) {

	    			toastr.success('Bạn đã thêm chi tiết thành công !');
	    			var detailTaable = $('#detail-table').DataTable({

	    				processing: true,
	    				serverSide: true,
	    				ajax: '/admin/product/listProducts/detail/'+id,
	    				columns: [
	    				{ data: 'product_id', name: 'product_id' },
	    				{ data: 'code', name: 'code' },
	    				{ data: 'size', name: 'size'},
	    				{ data: 'color', name: 'color' },
	    				{ data: 'quantity', name: 'quantity' },
	    				{ data: 'action', name: 'action' }
	    				]
	    			}); 
	    			detailTaable.destroy();
	    		},
	    		error:function(jqXHR,testStatus,errorThrown){
	    			if(typeof jqXHR.responseJSON.errors.code != 'undefined'){
	    				toastr.error(jqXHR.responseJSON.errors.code[0])
	    			}
	    			if(typeof jqXHR.responseJSON.errors.size!= 'undefined'){
	    				toastr.error(jqXHR.responseJSON.errors.size[0])
	    			}
	    		}
	    	})
	    })

	  	// xoa detail sp
	  	$(document).on('click','.btn-delete-sub',function(e){
	  		e.preventDefault();
	  		var id =  $(this).data('id');
	  		swal({
	  			title: "Bạn có muốn xóa không?",
	  			text: "Sau khi xóa bạn sẽ không thể khôi phục được tệp!",
	  			icon: "warning",
	  			buttons: true,
	  			dangerMode: true,
	  		})
	  		.then((willDelete) => {
	  			if (willDelete) {
	  				$.ajax({
	  					type: 'delete',
	  					url: '{{asset('')}}admin/product/listProducts/'+id+'/delete',
	  					success: function(response){
	  						console.log(response);

	  						var detailTaable = $('#detail-table').DataTable();
	  						detailTaable.DataTable().ajax.reload(null, false);
	  						
	  		
	  						// $('#detail-table').DataTable().ajax.reload(null, false);
	  						 detailTaable.destroy();
	  						var detailTaable = $('#detail-table').DataTable({

			    				processing: true,
			    				serverSide: true,
			    				ajax: '/admin/product/listProducts/detail/'+id,
			    				columns: [
			    				{ data: 'product_id', name: 'product_id' },
			    				{ data: 'code', name: 'code' },
			    				{ data: 'size', name: 'size'},
			    				{ data: 'color', name: 'color' },
			    				{ data: 'quantity', name: 'quantity' },
			    				{ data: 'action', name: 'action' }
			    				]
			    			}); 
			    			// detailTaable.destroy();

							// detailTaable.DataTable().ajax.reload(null, false);
	  					}
	  				}); 
	  				swal("Tệp của bạn đã được xóa!", {
	  					icon: "success",
	  				});
	  			} else {
	  				swal("Hủy xóa thành công!!");
	  			}
	  		});
	  	});

	  	//edit chi tiet product
	  	$(document).on('click','.btn-edit-detail',function(e){
	  		var id =$(this).data('id');
	  		// alert(id);
	  		e.preventDefault();
	  		$('#idup').attr('data-id',id);
	  		$.ajax({
	  			type : 'get',
	  			url  : "{{asset('')}}admin/product/listProducts/" + id + "/edit",

	  			success: function(response) {
	  				console.log(response);
	  				$('#code').val(response.code);
	  				$('#quantity1').val(response.quantity);
	  			}
	  		})
	  	});

		// update detail product
		$(document).on('click','.btn-update-detail-product',function(e){
			e.preventDefault();
			var id =$('#idup').data('id');

			var fd = new FormData();
			fd.append('code', $('#code').val());
			fd.append('size',  $('.size1P').val());
			fd.append('color',$('#color1').val());
			fd.append('quantity',$('#quantity1').val());
			fd.append('_token',$('input[name="_token"]').val());

			$.ajax({
				type: 'post',
				url:  "{{asset('')}}admin/product/listProducts/"+ id,
				processData: false,
				contentType: false,
				data: fd,

				success:function(response){
					
					toastr.success('update chi tiết Sản Phẩm Thành công!');
					$('#edit-detail-product').modal('hide');
					$('#detail-table').DataTable().ajax.reload(null, false);
					detailTaable = $('#detail-table').DataTable();
					detailTaable.destroy();
					$('#detail-table').DataTable({

						processing: true,
						serverSide: true,
						ajax: '/admin/product/listProducts/detail/'+id,
						columns: [
						{ data: 'product_id', name: 'product_id' },
						{ data: 'code', name: 'code' },
						{ data: 'size', name: 'size'},
						{ data: 'color', name: 'color' },
						{ data: 'quantity', name: 'quantity' },
						{ data: 'action', name: 'action' }
						]
					}); 
					
				},
				error:function(jqXHR,testStatus,errorThrown){
					toastr.error(jqXHR.responseJSON.errors.size[0])
				}
			});
		});
		
		$(document).on('click','.btn-upload-image',function(e){
			e.preventDefault();
			var id =$(this).data('id');
			
			$('#product_id').val(id)
		});
	});
$("#file-1").fileinput({
	theme: 'fa',
	uploadUrl: "/admin/upLoadImage",
	uploadExtraData: function() {
		return {
			product_id :$('#product_id').val(),
			_token: $("input[name='_token']").val(),
		};
	},
	allowedFileExtensions: ['jpg', 'png', 'gif'],
	overwriteInitial: false,
	maxFileSize:2000,
	maxFilesNum: 10,
	slugCallback: function (filename) {
		return filename.replace('(', '_').replace(']', '_');
	}
});
</script>

@endsection('ajax-product')





