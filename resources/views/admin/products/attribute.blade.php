@extends('layouts.maste-Admin') 
@section('admin-content') 
	<div class="container">
		<form action="{{route('product.store')}}" method="POST" role="form">
			@csrf
		
			@foreach($atts as $att)
			<div class="form-group">
				<label for="">{{$att->column}}</label>
				@if($att-> type == 2)
						<textarea class="form-control" id="{{$att->column}}" name="{{$att->column}}" placeholder="{{$att->column}}"></textarea>
				@else
						<input type="text" class="form-control" id="{{$att->column}}" name="{{$att->column}}" placeholder="{{$att->column}}">
				@endif
				
			</div>
			@endforeach
			<button type="submit" class="btn btn-primary">Submit</button>
		</form>
	</div>
@endsection('admin-content')