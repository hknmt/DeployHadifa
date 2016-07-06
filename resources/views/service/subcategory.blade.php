@extends('layouts.master')

@section('head.title')
	{{ $result->name }}
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
			<li><a href="{{ route('service.subcategory', ['service' => $name->slug, 'category' => $name->category->slug, 'subcategory' => $result->slug]) }}">{{ $result->name }}</a></li>
		</ul>
		<div class="clearfix"></div>
	</div>
	<div class="box">
		<div class="gallery-content">
			<div class="gallery-content-title clearfix">
				<h4>{{ $result->name }}</h4>			
			</div>
			<div class="row">
				@foreach($result->post as $value)
					<div class="col-md-4">
						<div class="img-thumb">
							<a href="{{ route('service.post',[ 'service' => $name->slug, 'category' => $name->category->slug, 'subcategory' => $result->slug, 'post' => $value->slug]) }}">
								<img class="img-responsive" src="{{ URL::asset($value->image) }}" alt="{{ $value->name }}">
							</a>
						</div>
						<div class="caption">
							<p>{{ str_limit($value->name, 20) }}</p>
							<p><a href="{{ route('service.post',[ 'service' => $name->slug, 'category' => $name->category->slug, 'subcategory' => $result->slug, 'post' => $value->slug]) }}">Chi tiết...</a></p>
						</div>
					</div>			
				@endforeach
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 col-sm-offset-3 text-center">
				{!! $result->post->links() !!}
			</div>
		</div>
	</div>
@endsection