@extends('layouts.master')

@section('head.title')
Giới Thiệu
@endsection

@section('body.sidebar')
	@include('partials.sidebar')
@endsection

@section('body.content')
<div class="title-box">
	<span class="dot"></span>
	<h3>Giới thiệu</h3>
	<div class="clearfix"></div>
</div>

<div class="box" id="about">
	<img src="{{ URL::asset($about->image) }}" alt="about" class="img-responsive">
	<div id="about-description">
		<p>{{ $about->intro }}</p>
	</div>
	<div class="clearfix"></div>
	<div id="about-content">
		<p>{{ $about->content }}</p>
	</div>					
</div>

<div class="box" id="about-benefit">
	<h4>chúng tôi mang lại cho bạn</h4>
	<div class="row">
		<div class="col-md-4">
			<p><img src="{{ URL::asset('img/idea.png') }}" alt="ý tưởng"></p>
			<p>giải pháp</p>
			<p>tốt nhất</p>
		</div>
		<div class="col-md-4">
			<p><img src="{{ URL::asset('img/briefcase.png') }}" alt="ý tưởng"></p>
			<p>kết quả</p>
			<p>cao nhất</p>
		</div>
		<div class="col-md-4">
			<p><img src="{{ URL::asset('img/good.png') }}" alt="ý tưởng"></p>
			<p>chất lượng</p>
			<p>tốt nhất</p>
		</div>
	</div>
</div>
<div class="clearfix"></div>
@endsection