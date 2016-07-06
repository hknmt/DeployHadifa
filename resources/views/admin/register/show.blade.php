@extends('admin.layouts.master')

@section('head.title')
	{{ $post['category'] }}
@endsection

@section('content')

	<ol class="breadcrumb">
		<li><a href="#">Dasboard</a></li>
		<li><a href="{{ route('admin.register.index') }}">Đăng ký</a></li>
	</ol>

	<div class="panel panel-primary">
		<div class="panel-heading">
			<h4>Yêu cầu - Khách - {{ $post['name'] }}</h4>
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-md-2"><code>Họ và tên khách:</code></div>
				<div class="col-md-4">{{ $post['name'] }}</div>
			</div>
			<div class="row">
				<div class="col-md-2"><code>Loại yêu cầu:</code></div>
				<div class="col-md-4">{{ $post['category'] }}</div>
			</div>
			<div class="row">
				<div class="col-md-2"><code>Liên kết gian hàng:</code></div>
				<div class="col-md-4"><a href="{{ route('service.trade.show' ,$post['post']) }}" target="_blank">{{ route('service.trade.show' ,$post['post']) }}</a></div>
			</div>
			<div class="row">
				<div class="col-md-2"><code>Email:</code></div>
				<div class="col-md-4">{{ $post['email'] }}</div>
			</div>
			<div class="row">
				<div class="col-md-2"><code>Điện thoại:</code></div>
				<div class="col-md-4">{{ $post['phone'] }}</div>
			</div>
			<div class="row">
				<div class="col-md-2"><code>Địa chỉ:</code></div>
				<div class="col-md-4">{{ $post['address'] }}</div>
			</div>
			<div class="row">
				<div class="col-md-2"><code>Công ty:</code></div>
				<div class="col-md-4">{{ $post['company'] }}</div>
			</div>
		</div>
		<div class="panel-footer"></div>
	</div>

@endsection