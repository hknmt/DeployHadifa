@extends('admin.layouts.master')

@section('content')

<div id="heading">
	<ol class="breadcrumb">
		<li><a href="#">Dasboard</a></li>
		<li><a href="#">Service</a></li>
		<li><a href="{{ route('admin.service.index', $service['id']) }}">{{ $service['name'] }}</a></li>
	</ol>
</div>

<div class="panel">
	<div class="panel-body">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<button class="btn btn-primary" onclick="window.location.assign('{{ route('admin.service.category.index', $service['id']) }}')">Chuyên mục</button>
				<button class="btn btn-info" onclick="window.location.assign('{{ route('admin.service.post.index', ['id' => $service['id'], 'view' => "all"]) }}')">Bài viết</button>
			</div>
		</div>
	</div>
</div>

@endsection