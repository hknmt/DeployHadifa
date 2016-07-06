@extends('layouts.master')

@section('head.title')
	{{ $namecategory['name'] }}
@endsection

@section('body.sidebar')
	@include('partials.sidebarService')
@endsection

@section('body.content')
	<div class="title-box">
		<span class="dot"></span>
		<ul id="breadcrumb">
			<li><a href="{{ route('service.index') }}">Dịch vụ</a></li>
			<li><a href="{{ route('service.service', ['service' => $namecategory['slug']]) }}">{{ $namecategory['name'] }}</a></li>
		</ul>
		<div class="clearfix"></div>
	</div>
	<div class="box" id="service-design">
		@foreach($categorys as $value)
			<div class="gallery-content">
				<div class="gallery-content-title clearfix">
					<p class="pull-right"><a href="{{ route('service.category',['service' => $namecategory['slug'],'category' => $value['slug']]) }}">Xem tất cả</a></p>
					<div class="clearfix"></div>
					<h4>{{ $value['name'] }}</h4>
				</div>
				<div class="row">
					@foreach($value['subcategory'] as $sub)
						<div class="col-md-4">
							<div class="img-thumb">
								<a href="{{ route('service.subcategory',['service' => $namecategory['slug'] ,'category' => $value['slug'], 'subcategory' => $sub['slug']]) }}">
									<img class="img-responsive" src="{{ URL::asset($sub['image']) }}" alt="{{ $sub['name'] }}">
								</a>
							</div>
							<div class="caption">
								<p>{{ str_limit($sub['name'], 20) }}</p>
								<p><a href="{{ route('service.subcategory',['service' => $namecategory['slug'] ,'category' => $value['slug'], 'subcategory' => $sub['slug']]) }}">Chi tiết ...</a></p>
							</div>
						</div>
					@endforeach
				</div>
			</div>
		@endforeach
		<div class="row">
			<div class="col-sm-6 col-sm-offset-3 text-center">
				{!! $categorys->links() !!}
			</div>
		</div>
	</div>
@endsection