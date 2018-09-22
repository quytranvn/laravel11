@extends('layouts.maste-Admin') 
@section('admin-content') 
     
   <div class="box"> <br>
          
            <div class="box-header with-border">
              <h3 class="box-title">Users Table</h3>
            </div>
            <br>
            <a style="margin-left: 10px; background-color: green;" class="btn btn-sm btn-primary" data-toggle="modal" href='#modal-id'><i class="fa fa-user-plus" aria-hidden="true"></i></a>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-hover" id="users-table">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>NAME</th>
                    <th>EMAIL</th>
                    <th>ACTION</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
   
      <!-- Modal add -->
    <div class="modal fade" id="modal-id">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Thêm Mới user</h4>
          </div>
          <div class="modal-body">
            <form action="" method="POST" role="form" id="add">
              @csrf
              <div class="form-group">
                <label for="">Name</label>
                <input type="text" class="form-control" id="name" name="name"  placeholder="name" value="{{old('name')}}">
                @if($errors->has('name'))
                <div class="alert alert-danger">
                  {{$errors->first('name')}};
                </div>
                @endif
              </div>

              <div class="form-group">
                <label for="">Email</label>
                <input type="text" class="form-control"  id="email" email="email"  placeholder="email" value="{{old('email')}}">
                @if($errors->has('email'))
                <div class="alert alert-danger">
                  {{$errors->first('email')}};
                </div>
                @endif
              </div>
              <div class="form-group">
                <label for="">password</label>
                <input type="password" class="form-control"  id="password" email="password"  placeholder="password" value="{{old('password')}}">
                @if($errors->has('password'))
                <div class="alert alert-danger">
                  {{$errors->first('password')}};
                </div>
                @endif
              </div>


              
              <hr>
              <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-sm btn-success btn-user-add">Add Product</button>
            </form>
          </div>
        </div>
      </div>
    </div>
      <!-- Modal show -->
    <div class="modal fade" id="show">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Chi tiết user</h4>
          </div>
          <div id="modal-body-show" >
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>id</th>
                  <th>name</th>
                  <th>email</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><h4 id="user_id"></h4><br></td>
                  <td><h4 id="user_name"></h4><br></td>
                  <td> <h4 id="user_email"></h4><br></td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

      <!-- Modal edit -->
    <div id="update" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Chỉnh sửa User</h4>
          </div>
          <div class="modal-body">
            <form action="" method="POST" role="form" id="edit" enctype="multipart/form-data">
              @csrf
              <input type="hidden" id="idup" value="">

              <div class="form-group">
                <label for="">name</label>
                <input type="text" class="form-control post1t"  id="p-name" name="name"> 
              </div>
             
              <div class="form-group">
                <label for="">email</label>
                <input type="text" class="form-control post3d"  id="p-email" name="email"> 
              </div>
              <div class="form-group">
                <label for="">password</label>
                <input type="text" class="form-control post4d"  id="p-password" name="password"> 
              </div>
              
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" style="background:#33ff33;" class="btn btn-success-update">update</button>
              </div>
            </form>
          </div> 
        </div>
      </div>
    </div>
@endsection('admin-content')

@section('ajax-user')
  <script >
    $(function(){
        $('#users-table').DataTable({
              processing: true,
              serverSide: true,
              ajax: '{!! route('user.list') !!}',
              columns: [
                  { data: 'id', name: 'id' },
                  { data: 'name', name: 'name' },
                  { data: 'email', name: 'email' },
                  { data: 'action', name: 'action' }
              ]
          });

          // xóa user  bằng ajax
          $(document).on('click','.btn-danger',function(){
            var id =  $(this).data('id');
            if(confirm(' Bạn Chắc Chắc muốn xóa chứ ?')) {
                $.ajax({
                  type: 'delete',
                  url : '{{asset('')}}admin/user/delete/' +id,
                  success: function(response) {
                
                    toastr.success('Bạn đã xóa thành công !');
                    $('#users-table').DataTable().ajax.reload(null,false);
                  } 
                })

            }
          })
          // them mơi user
          $(document).on('click','.btn-user-add',function(e){
            e.preventDefault();

            $.ajax({
              type: 'post',
              url : '{{route('user.store')}}',
               data:{
                  name: $('#name').val(),
                  email: $('#email').val(),
                  password: $('#password').val(),
               },

              success: function(response) {

                toastr.success('Thêm mới user thành công !');
                setTimeout(function(){
                  window.location.href = "{{route('user.index')}}"
                },800);

                // $('#users-table').DataTable().ajax.reload(null,false);
              },
              error:function(jqXHR,testStatus,errorThrown){
                toastr.error(jqXHR.responseJSON.errors.name[0])
                toastr.error(jqXHR.responseJSON.errors.email[0])
                toastr.error(jqXHR.responseJSON.errors.password[0])
              }
            })
          })
         // xem chi tiết user bằng ajax
         $(document).on('click','.btn-info',function(){
           var id=$(this).data('id');
            $.ajax({
              type: 'get',
              url: '{{asset('')}}admin/user/show/'+id,

              success: function(response) {
                $('#user_id').html(response.data.id);
                $('#user_name').html(response.data.name);
                $('#user_email').html(response.data.email);

              }
            })
          })

          // edit user bằng ajax
          $(document).on('click','.btn-warning',function(){
            var id =$(this).data('id');
            $.ajax({
              type : 'get',
              url  : '{{ asset('') }}admin/user/edit/'+ id,
              success: function(response) {
                console.log(response);
                $('#idup').val(response.data.id);
                $('.post1t').val(response.data.name);
                $('.post3d').val(response.data.email);
                $('.post4d').val(response.data.password);
              }
            })
          })

          // update user bằng ajax()
         $(document).on('click','.btn-success-update',function(e){
            e.preventDefault();
            var id =$('#idup').val();
            $.ajax({
              type: 'put',
              url:  "{{asset('')}}admin/user/update/" + id,
              data: {
                name:$('#p-name').val(),
                email:$('#p-email').val(),
                password:$('#p-password').val(),
              },
              success:function(reponse){
                toastr.success('update post Thành công!');
                setTimeout(function(){
                  window.location.href = "{{route('user.index')}}"
                },800);
              },
              error:function(jqXHR,testStatus,errorThrown){
                toastr.error(jqXHR.responseJSON.errors.name[0])
                toastr.error(jqXHR.responseJSON.errors.email[0])
                toastr.error(jqXHR.responseJSON.errors.password[0])
              }
            })
          })
    });
  </script>
@endsection