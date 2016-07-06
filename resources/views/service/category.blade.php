@extends('layouts.master')

@section('head.title')
	{{ $name->name }}
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
			<li><a href="{{ route('service.category', ['service' => $name->slug, 'category' => $result->slug]) }}">{{ $result->name }}</a></li>
		</ul>
		<div class="clearfix"></div>
	</div>
	<div class="box" id="service-design">
		@foreach($result->subcategory as $value)
			<div class="gallery-content">
				<div class="gallery-content-title clearfix">
					<p class="pull-right"><a href="{{ route('service.subcategory',['service' => $name->slug, 'category' => $result->slug, 'subcategory' => $value->slug]) }}">Xem tất cả</a></p>
					<div class="clearfix"></div>
					<h4>{{ $value->name }}</h4>
				</div>
				<div class="row">
					@foreach($value->post as $post)
						<div class="col-md-4">
							<div class="img-thumb">
								<a href="{{ route('service.post',['service' => $name->slug ,'category' => $result->slug, 'subcategory' => $result->slug, 'post' => $post->slug]) }}/">
									<img class="img-responsive" src="{{ URL::asset($post->image) }}" alt="{{ $post->name }}">
								</a>
							</div>
							<div class="caption">
								<p>{{ str_limit($post->name, 20) }}</p>
								<p><a href="{{ route('service.post',['service' => $name->slug ,'category' => $result->slug, 'subcategory' => $value->slug, 'post' => $post->slug]) }}/">Chi tiết ...</a></p>
							</div>
						</div>
					@endforeach
				</div>
			</div>
		@endforeach
		<div class="row">
			<div class="col-sm-6 col-sm-offset-3">
				{!! $result->subcategory->links() !!}
			</div>
		</div>
	</div>
@endsection