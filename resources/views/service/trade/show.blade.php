@extends('layouts.master')

@section('head.title')
	{{ $result['name'] }}
@endsection

@section('head.css')
	<link rel="stylesheet" href="{{ URL::asset('js/FlexSlider/flexslider.css') }}">
@endsection

@section('body.sidebar')
	@include('partials.sidebar')
@endsection

@section('body.js')

	<script>
		$(window).load(function() {
		  // The slider being synced must be initialized first
		  $('#carousel').flexslider({
		    animation: "slide",
		    controlNav: false,
		    animationLoop: false,
		    slideshow: false,
		    itemWidth: 95,
		    itemMargin: 10,
		    maxItems: 4,
		    asNavFor: '#slider'
		  });
		 
		  $('#slider').flexslider({
		    animation: "slide",
		    controlNav: false,
		    animationLoop: false,
		    slideshow: false,
		    sync: "#carousel"
		  });
		});
	</script>
	
@endsection
@section('body.content')
	<div class="title-box">
		<span class="dot"></span>
		<ul id="breadcrumb">
			<li><a href="{{ route('service.index') }}">Dịch vụ</a></li>
			<li><a href="{{ route('service.trade.index') }}">Trade Fair Exbihition</a></li>
			<li><a href="{{ route('service.trade.show',$result['slug']) }}">{{ $result['name'] }}</a></li>
		</ul>	
		<div class="clearfix"></div>
	</div>
	<div class="box" id="service-trade">
		<h4>{{ $result['name'] }}</h4>
		<div class="row">
			<div class="col-md-8">
				<div id="slider" class="flexslider">
					<ul class="slides">
					@foreach($result['slide'] as $value)
						<li><img src="{{ URL::asset($value['image']) }}" alt="{{ $result['name'] }}"></li>
					@endforeach
					</ul>
				</div>
				<hr></hr>
				<div id="carousel" class="flexslider">
					<ul class="slides">
					@foreach($result['slide'] as $value)
						<li><img src="{{ URL::asset($value['image']) }}" alt="{{ $result['name'] }}"></li>
					@endforeach
					</ul>
				</div>
				<hr></hr>
				<div id="trade-news">
					{!! $result['post']['content']  !!}
				</div>				
			</div>
			<div class="col-md-4">
				<div id="trade-information">
					@if($active)
						<h4>sự kiện đã diễn ra</h4>
						<p id="information-logo">
						<img src="{{ URL::asset($result['image'])}}" alt="{{ $result['name'] }}">
						</p>
						<div class="information-content">
							{!! $result['post']['information'] !!}
						</div>
					@else
						<h4 class="trade-active">sự kiện sắp diễn ra</h4>
						<p id="information-logo">
						<img src="{{ URL::asset($result['image'])}}" alt="{{ $result['name'] }}">
						</p>
						<div class="information-content">
							{!! $result['post']['information'] !!}
						</div>
						<div class="trade-register" data-toggle="modal" data-target="#modal-thamgia">
								<p>Đăng ký tham gia</p>
								<p>Click here >></p>
						</div>
						<div class="trade-register" data-toggle="modal" data-target="#modal-thamquan">
								<p>Đăng ký tham quan</p>
								<p>Click here >></p>
						</div>
					@endif
				</div>
				<div id="trade-related">
					<h4>Sản phẩm liên quan</h4>
					@foreach($related as $value)
					<div>
						<a href="{{ route('service.trade.show',$value['slug']) }}"><img src="{{ URL::asset($value['image']) }}" alt="{{ $value['name'] }}"></a>
						<p>{{ $value['name'] }}</p>
					</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>

	<!-- Modal Tham gia -->
	<div id="modal-thamgia" class="modal fade" role="dialog">
		<div class="modal-dialog">

		<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Đăng ký tham gia</h4>
				</div>				
				<div class="modal-body" id="thamgia-body">
					<div class="form-group">
						<label for="name">Họ và tên: </label>
						<input type="text" class="form-control" name="name">
					</div>
					<div class="form-group">
						<label for="phone">Số điện thoại: </label>
						<input type="text" class="form-control" name="phone">
					</div>
					<div class="form-group">
						<label for="email">Email: </label>
						<input type="email" class="form-control" name="email">
					</div>
					<div class="form-group">
						<label for="address">Địa chỉ: </label>
						<input type="text" class="form-control" name="address">
					</div>
					<div class="form-group">
						<label for="company">Công ty: </label>
						<input type="text" class="form-control" name="company">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
					<button class="btn btn-warning" id="sendFormThamgia" type="button">Gửi đăng ký</button>
				</div>
			</div>
		</div>
	</div>
	
	<!-- Modal Tham quan -->
	<div id="modal-thamquan" class="modal fade" role="dialog">
		<div class="modal-dialog">

		<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Đăng ký tham quan</h4>
				</div>
				<div class="modal-body" id="thamquan-body">
					<div class="form-group">
						<label for="name_thamquan">Họ và tên: </label>
						<input type="text" class="form-control" name="name_thamquan">
					</div>
					<div class="form-group">
						<label for="phone_thamquan">Số điện thoại: </label>
						<input type="text" class="form-control" name="phone_thamquan">
					</div>
					<div class="form-group">
						<label for="email_thamquan">Email: </label>
						<input type="email" class="form-control" name="email_thamquan">
					</div>
					<div class="form-group">
						<label for="address_thamquan">Địa chỉ: </label>
						<input type="text" class="form-control" name="address_thamquan">
					</div>
					<div class="form-group">
						<label for="company_thamquan">Công ty: </label>
						<input type="text" class="form-control" name="company_thamquan">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
					<button class="btn btn-warning" id="sendFormThamquan" type="button">Gửi đăng ký</button>
				</div>
			</div>

		</div>
	</div>

	<!-- Modal Thank you -->
	<div id="modal-thankyou" class="modal fade in">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Thông báo!!!</h4>
				</div>
				<div class="modal-body">
					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
				</div>
			</div>
		</div>
	</div>

	

	<script language="javascript">
		$(document).ready(function(){
			$("#sendFormThamgia").click(function(){
				$.ajax({
					method: "post",
					url: "{{ route('service.register') }}",
					data: {
						'_token': "{{ csrf_token() }}",
						'category' : "Tham gia",
						'post': "{{ $result['slug'] }}",
						'name': $("input[name='name']").val(),
						'phone': $("input[name='phone']").val(),
						'email': $("input[name='email']").val(),
						'address': $("input[name='address']").val(),
						'company': $("input[name='company']").val()
					},
					dataType: 'json',
					success: function(data){
						console.log(data);
						$("#modal-thamgia").modal('hide');
						$("#modal-thankyou").find("div.modal-body").html("<p class=\"text-justify\">" + data['messenger'] + "</p>");
						$("#modal-thankyou").find(".modal-header").css({"background":"#ffc20f"});
						$("#modal-thankyou").modal('show');
					},
					error: function(data){
						console.log(data.responseJSON);
						errors = data.responseJSON;
						html = '';
						$.each(errors, function(key, value){							
							$.each(value, function(key_v, value_v){
								html += '<div class=\"alert alert-danger\">';
								html += '<strong>Lỗi! </strong>';
								html += value_v;
								html += '</div>';
							});							
						});
						$(".alert").remove();
						$("#thamgia-body").prepend(html);
					}
				});
			});

			$("#sendFormThamquan").click(function(){
				$.ajax({
					method: "post",
					url: "{{ route('service.register') }}",
					data: {
						'_token': "{{ csrf_token() }}",
						'category': "Tham quan",
						'post': "{{ $result['slug'] }}",
						'name': $("input[name='name_thamquan']").val(),
						'phone': $("input[name='phone_thamquan']").val(),
						'email': $("input[name='email_thamquan']").val(),
						'address': $("input[name='address_thamquan']").val(),
						'company': $("input[name='company_thamquan']").val()
					},
					dataType: 'json',
					success: function(data){
						console.log(data);
						$("#modal-thamquan").modal('hide');
						$("#modal-thankyou").find("div.modal-body").html("<p class=\"text-justify\">" + data['messenger'] + "</p>");
						$("#modal-thankyou").find(".modal-header").css({"background":"#ffc20f"});
						$("#modal-thankyou").modal('show');
					},
					error: function(data){
						console.log(data.responseJSON);
						errors = data.responseJSON;
						html = '';
						$.each(errors, function(key, value){							
							$.each(value, function(key_v, value_v){
								html += '<div class=\"alert alert-danger\">';
								html += '<strong>Lỗi! </strong>';
								html += value_v;
								html += '</div>';
							});							
						});
						$(".alert").remove();
						$("#thamquan-body").prepend(html);
					}
				});
			});

			$("#trade-news img").attr("class", "img-thumbnail");

		});
	</script>
	
	<script src="{{ URL::asset('js/FlexSlider/jquery.flexslider-min.js') }}"></script>

@endsection