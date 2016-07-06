@extends('layouts.master')

@section('head.title')
	Dịch vụ
@endsection

@section('body.content')	
	<div class="title-box">
		<span class="dot"></span>
		<h3>Dịch vụ</h3>
		<div class="clearfix"></div>
	</div>
	<div class="box" id="service-design">		
		<div class="gallery-content">
			<div class="gallery-content-title clearfix">
				<p class="pull-left"><h4>trade fair exhibition</h4></p>
				<p class="pull-right" style="padding-bottom:20px"><a href="{{ route('service.trade.index') }}">Xem tất cả</a></p>
				<div class="clearfix"></div>
			</div>
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
		</div>	
	@foreach($service as $service_value)
		<div class="gallery-content">
			<div class="gallery-content-title clearfix">
				<p class="pull-right"><a href="{{ route('service.service', ['service' => $service_value['slug']]) }}">Xem tất cả</a></p>
				<div class="clearfix"></div>
				<h4>{{ $service_value['name'] }}</h4>				
			</div>			
			<div class="row">
			@foreach($service_value['category'] as $v)
				<div class="col-md-4">
					<div class="img-thumb">
						<a href="{{ route('service.subcategory', ['service' => $service_value['slug'], 'category' => $v['slug'], 'subcategory' => $v['subcategory']['slug']]) }}">
							<img class="img-responsive center-block" src="{{ URL::asset($v['subcategory']['image']) }}" alt="{{ $v['subcategory']['name'] }}">
						</a>
					</div>
					<div class="caption">
						<p>{{ $v['subcategory']['name'] }}</p>
						<p><a href="{{ route('service.subcategory', ['service' => $service_value['slug'], 'category' => $v['slug'], 'subcategory' => $v['subcategory']['slug']]) }}">Chi tiết ...</a></p>
					</div>
				</div>		
			@endforeach		
			</div>
		</div>	
	@endforeach	
	</div>
@endsection

@section('body.sidebar')
	@include('partials.sidebar')
@endsection


