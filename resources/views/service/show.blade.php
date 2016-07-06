@extends('layouts.master')

@section('head.title')
	{{ $result->name }}
@endsection

@section('head.css')
	<link rel="stylesheet" href="{{ URL::asset('js/FlexSlider/flexslider.css') }}">
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

@section('body.sidebar')
	@include('partials.sidebarService')
@endsection

@section('body.content')
	<div class="title-box">
		<span class="dot"></span>
		<ul id="breadcrumb">
			<li><a href="{{ route('service.index') }}">Dịch vụ</a></li>
			<li><a href="{{ route('service.service', ['service' => $name->slug]) }}">{{ $name->name }}</a></li>
			<li><a href="{{ route('service.category', ['service' => $name->slug, 'category' => $name->category->slug]) }}">{{ $name->category->name }}</a></li>
			<li><a href="{{ route('service.subcategory', ['service' => $name->slug, 'category' => $name->category->slug, 'subcategory' => $name->category->subcategory->slug]) }}">{{ $name->category->subcategory->name }}</a></li>
		</ul>
		<div class="clearfix"></div>
	</div>
	<div class="box" id="service-trade">
		<h4><b>{{ $name->category->subcategory->name }}</b></h4>
		<h4>{{ $result->name }}</h4>
		<div class="row">
			<div class="col-md-8">
				<div id="slider" class="flexslider">
					<ul class="slides">
						@foreach($slideshow as $slide)
							<li><img src="{{ URL::asset($slide['image']) }}" alt="{{ $slide['name'] }}"></li>
						@endforeach
					</ul>
				</div>
				<hr></hr>
				<div id="carousel" class="flexslider">
					<ul class="slides">
					@foreach($slideshow as $slide)
						<li><img src="{{ URL::asset($slide['image']) }}" alt="{{ $slide['name'] }}"></li>
					@endforeach
					</ul>
				</div>
				<hr></hr>
				<div class="form" id="sendAjax">
					<p>Để được tư vấn và yêu cầu thiết kế {{ strtoupper($name->category->subcategory->name) }}, quý khách có thể liên hệ trực tiếp với chúng tôi hoặc yêu cầu qua form thông tin dưới đây:</p>
					<form id="Post" action="{{ route('service.store') }}" method="POST">
						{{ csrf_field() }}
						<input type="hidden" name="category" value="{{ $name->name }}/{{ $name->category->name }}/{{ $name->category->subcategory->name }}/{{ $result->name }}">
						<div class="form-group">							
							<label for="name">Họ tên:</label>
							<input id="name" name="name" type="text" required value="">
						</div>
						<div class="form-group">
							<label for="email">Email:</label>
							<input id="email" name="email" type="text" required value="">
						</div>
						<div class="form-group">
							<label for="phone">Điện thoại:</label>
							<input id="phone" name="phone" type="text" value="">
						</div>
						<div class="form-group">
							<label for="company">Đơn vị:</label>
							<input id="company" name="company" type="text" value="">
						</div>
						<div class="form-group">
							<label for="address">Địa chỉ:</label>
							<input id="address" name="address" type="text" value="">
						</div>
						<div class="form-group">
							<label for="title">Tiêu đề:</label>
							<input id="title" name="title" type="text" required value="">
						</div>
						<p>Nội dung yêu cầu dịch vụ:</p>
						<textarea name="content" required></textarea>
						<p class="clearfix"><button type="button" onclick="sendForm()" >Gửi yêu cầu</button></p>
					</form>								
				</div>
			</div>
			<script language="javascript">

				function sendForm(){
					$.ajax({
						url: "{{ route('service.store') }}",
						type: "post",
						data: {
							'_token' 	: "{{ csrf_token() }}",
							'category'	: $("input[name='category']").val(),
							'name'		: $("input[name='name']").val(),
							'email'		: $("input[name='email']").val(),
							'phone'		: $("input[name='phone']").val(),
							'company'	: $("input[name='company']").val(),
							'address'	: $("input[name='address']").val(),
							'title'		: $("input[name='title']").val(),
							'content'	: $("textarea[name='content']").val()
						},
						dataType: "json",
						success : function(data){
							console.log(data);
							$('#errors-ajax').remove();
							$("#Post").slideUp(1000).slideDown(1000);
							setTimeout(function(){
								$('#Post').html(data.messenger);
							}, 1000);
						},
						error : function(data){
							console.log(data);
							var errors = data.responseJSON;
							var html = "";
							html += "<div id=\"errors-ajax\" class=\"alert alert-danger\">";
							html += "<ul>";
							$.each(errors, function(key, value){
								html += "	<li>" + value + "</li>"
							});							
							html += "</ul>";
							html += "</div>";
							$('#errors-ajax').remove();
							$("#sendAjax").prepend(html);
						}
					});
				}
				
			</script>

			<script src="{{ URL::asset('js/FlexSlider/jquery.flexslider-min.js') }}"></script>

			<div id="result"></div>				
			<div class="col-md-4">
				<div id="trade-information">
					<h4>thông tin</h4>
					<div class="information-content">
						{!! $result->information !!}
					</div>
				</div>
				<div id="trade-related">
					<h4>Sản phẩm liên quan</h4>
					@foreach($related as $value)
						<div>
							<a href="{{ route('service.post',['service' => $name->slug, 'category' => $name->category->slug, 'subcategory' => $name->category->subcategory->slug, 'post' => $value->slug]) }}/"><img class="img-thumbnail img-responsive" src="{{ URL::asset($value->image) }}" alt="{{ $value->name }}"></a>
							<p>{{ $value->name }}</p>
						</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
@endsection