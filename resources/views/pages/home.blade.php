@extends('layouts.master')

@section('head.title')
	Trang chủ
@endsection

@section('body.content')
	<div class="title-box">
		<span class="dot"></span>
		<h3>Giới thiệu</h3>
		<div class="clearfix"></div>
	</div>
	<div class="box" id="about">
		<img src="{{ URL::asset('img/about.png') }}" alt="about" class="img-responsive">
		{{ str_limit($about['content'], 950) }}
		<button class="readmore"><a href="{!! route('about') !!}">Xem thêm ...</a></button>
	</div>
	<div class="clearfix"></div>
	<hr></hr>
	<div class="title-box">
		<span class="dot"></span>
		<h3>Các dịch vụ</h3>
		<button class="view-all"><a href="{{ route('service.index') }}">View All</a></button>
		<div class="clearfix"></div>
	</div>
	<div class="box" id="gallery">
		<div class="gallery-content">
			<h4>trade fair exhibition</h4>
			<div class="row">
			@foreach($tfe as $tfe_value)
				<div class="col-md-4">
					<div class="img-thumb">
						<a href="{{ route('service.trade.show', ['post' => $tfe_value['slug']]) }}">
							<img src="{{ URL::asset($tfe_value['image']) }}" alt="{{ $tfe_value['name'] }}">
						</a>
					</div>
					<div class="caption">
						<p>{{ $tfe_value['name'] }}</p>
						<p><a href="{{ route('service.trade.show', ['post' => $tfe_value['slug']]) }}">Chi tiết ...</a></p>
					</div>
				</div>
			@endforeach
			</div>
			<div class="clearfix"></div>
		</div>	
	@foreach($service as $service_value)
		<div class="gallery-content">
			<h4>{{ $service_value['name'] }}</h4>
			<div class="row">
			@foreach($service_value['category'] as $v)
				<div class="col-md-4">
					<div class="img-thumb">
						<a href="{{ route('service.subcategory', ['service' => $service_value['slug'], 'category' => $v['slug'], 'subcategory' => $v['subcategory']['slug']]) }}">
							<img src="{{ URL::asset($v['subcategory']['image']) }}" alt="{{ $v['subcategory']['name'] }}">
						</a>
					</div>
					<div class="caption">
						<p>{{ $v['subcategory']['name'] }}</p>
						<p><a href="{{ route('service.subcategory', ['service' => $service_value['slug'], 'category' => $v['slug'], 'subcategory' => $v['subcategory']['slug']]) }}">Chi tiết ...</a></p>
					</div>
				</div>		
			@endforeach		
			</div>
			<div class="clearfix"></div>
		</div>	
	@endforeach	
	</div>
@endsection

@section('body.sidebar')
	@include('partials.sidebar')
@endsection


