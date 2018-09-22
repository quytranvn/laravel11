@extends('layouts.master-Shop') 
@section('shop-content') 

<div class="container">

	<div class="p-b-10">
		<h3 class="ltext-103 cl5"> 
			Product Overview
		</h3>
	</div>

	<div class="row isotope-grid">
		@foreach($products as $product)

		<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
			<!-- Block2 -->
			<div class="block2">
				<div class="block2-pic hov-img0">
					@if($product->product_thumbnails->first())
						<img src="{{asset('storage/')}}/{{$product->product_thumbnails->first()->link}}" alt="IMG-PRODUCT">
					@endif

					<a href="{{asset('')}}index/detail/{{$product->id}}" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1 btn-modal-detail"
						data-id="{{ $product->id }}">
						Quick View
					</a>
				</div>

				<div class="block2-txt flex-w flex-t p-t-14">
					<div class="block2-txt-child1 flex-col-l ">

						<a href="product-detail.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
							{{ $product->name}}
						</a>


						<span class="stext-105 cl3">
							{{ $product->price }}
						</span>

					</div>

					<div class="block2-txt-child2 flex-r p-t-3">
						<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
							<img class="icon-heart1 dis-block trans-04" src="{{asset('shop/images/icons/icon-heart-01.png')}}" alt="ICON">
							<img class="icon-heart2 dis-block trans-04 ab-t-l" src="{{asset('shop/images/icons/icon-heart-02.png')}}" alt="ICON">
						</a>
					</div>
				</div>
			</div>
		</div>
		@endforeach
	</div>
	<!-- Modal1 -->
		<div class="wrap-modal1 js-modal1 p-t-60 p-b-20">
		<div class="overlay-modal1 js-hide-modal1"></div>

		<div class="container">
			<div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">
				<button class="how-pos3 hov3 trans-04 js-hide-modal1">
					<img src="{{asset('shop/images/icons/icon-close.png')}}" alt="CLOSE">
				</button>

				<div class="row">
					<div class="col-md-6 col-lg-7 p-b-30">
						<div class="p-l-25 p-r-30 p-lr-0-lg">
							<div class="wrap-slick3 flex-sb flex-w">
								<div class="wrap-slick3-dots">
									
								</div>
								<div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

								<div class="slick3 gallery-lb">
									{{-- <div class="item-slick3" data-thumb="{{asset('shop/images/product-detail-01.jpg')}}">
										<div class="wrap-pic-w pos-relative">
											<img src="{{asset('shop/images/product-detail-01.jpg')}}" alt="IMG-PRODUCT">

											<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="{{asset('shop/images/product-detail-01.jpg')}}">
												<i class="fa fa-expand"></i>
											</a>
										</div>
									</div>

									<div class="item-slick3" data-thumb="{{asset('shop/images/product-detail-02.jpg')}}">
										<div class="wrap-pic-w pos-relative">
											<img src="{{asset('shop/images/product-detail-02.jpg')}}" alt="IMG-PRODUCT">

											<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="{{asset('shop/images/product-detail-02.jpg')}}">
												<i class="fa fa-expand"></i>
											</a>
										</div>
									</div>

									<div class="item-slick3" data-thumb="{{asset('shop/images/product-detail-03.jpg')}}">
										<div class="wrap-pic-w pos-relative">
											<img src="{{asset('shop/images/product-detail-03.jpg')}}" alt="IMG-PRODUCT">

											<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="{{asset('shop/images/product-detail-03.jpg')}}">
												<i class="fa fa-expand"></i>
											</a>
										</div>
									</div> --}}
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-md-6 col-lg-5 p-b-30">
						<div class="p-r-50 p-t-5 p-lr-0-lg">
							<h4 class="mtext-105 cl2 js-name-detail p-b-14">
								{{ $product->name}}
							</h4>

							<span class="mtext-106 cl2 detail-price">
								{{ $product->price}}
							</span>

							<p class="stext-102 btn-description cl3 p-t-23">
							</p>
							
							<!--  -->
							<div class="p-t-33">
								<div class="flex-w flex-r-m p-b-10">
									<div class="size-203 flex-c-m respon6">
										Size
									</div>

									<div class="size-204 respon6-next size-detail">
										
									</div>
								</div>
								<div class="p-t-33">
									<div class="flex-w flex-r-m p-b-10">
										<div class="size-203 flex-c-m respon6">
											Quantity
										</div>

										<div class="size-204 respon6-next quantity-detail">
											
										</div>
									</div>

								<div class="flex-w flex-r-m p-b-10">
									<div class="size-203 flex-c-m respon6">
										Color
									</div>

									<div class="size-204 respon6-next ">
												<div class="color-detail" style="height:50px;width:100px; border-radius: 50%;"></div>
										</div>
									</div>
								</div>

								<div class="flex-w flex-r-m p-b-10">
									<div class="size-204 flex-w flex-m respon6-next">
										<div class="wrap-num-product flex-w m-r-20 m-tb-10">
											<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-minus"></i>
											</div>

											<input class="mtext-104 cl3 txt-center num-product num-product-quantity" type="number" name="num-product" value="1">

											<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-plus"></i>
											</div>
										</div>
							
										<button class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail add-cart">
											Add to cart
										</button>

									</div>
								</div>	
							</div>

							<!--  -->
							<div class="flex-w flex-m p-l-100 p-t-40 respon7">
								<div class="flex-m bor9 p-r-10 m-r-11">
									<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 js-addwish-detail tooltip100" data-tooltip="Add to Wishlist">
										<i class="zmdi zmdi-favorite"></i>
									</a>
								</div>

								<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Facebook">
									<i class="fa fa-facebook"></i>
								</a>

								<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Twitter">
									<i class="fa fa-twitter"></i>
								</a>

								<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Google Plus">
									<i class="fa fa-google-plus"></i>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Load more -->
	<div class="flex-c-m flex-w w-full p-t-45">
		<a href="#" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
			Load More
		</a>
	</div>
	@section('ajaxmodal')
	<script >
		$(document).on('click','.btn-modal-detail',function(e){
			e.preventDefault();
			var id = $(this).attr('data-id');
			$('.add-cart').attr('data-id', id);
			$.ajax({
				type: 'get',
				url: '{{asset('')}}index/detail/'+id,
				success: function(response) {
					$('.js-name-detail').text(response.name)
					$('.mtext-106').text(response.price)
					$('.btn-description').html(response.description)
					$('.size-detail').text(response.product_detail.size)
					$('.quantity-detail').text(response.product_detail.quantity)
					$('.color-detail').css('background',response.product_detail.color)
					$('.gallery-lb').html('');
					$.each(response.product_thumbnails, function( index, value ) {
					  	$('.gallery-lb').append(`<div class="item-slick3" data-thumb="http://fukushop.vn:1080/storage/`+ value.link +`">
										<div class="wrap-pic-w pos-relative">
											<img src="http://fukushop.vn:1080/storage/`+ value.link +`" alt="IMG-PRODUCT">

											<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="http://fukushop.vn:1080/storage/`+ value.link +`">
												<i class="fa fa-expand"></i>
											</a>
										</div>
									</div>`)
					});
					
				}
			})
		});

		$(document).on('click','.add-cart',function(e){
			e.preventDefault();
			var id =$(this).attr('data-id');
			alert(id);
			$.ajax({
				type: 'get',
				url: '{{asset('')}}index/detail/cart/'+id,
				success: function(response) {
					console.log(response)
					$('.num-product-quantity').val(response.product_detail.quantity)
					$('.size-detail').val(response.product_detail.size)
					$('.js-name-detail').val(response.name)
					$('.detail-price').val(response.price)

					
				}
			})
		})
	</script>
	@endsection('ajaxmodal')
	@endsection('shop-content')	