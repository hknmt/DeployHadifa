@extends('admin.layouts.master')
@section('content')
	<div class="content">
		<div class="media">
			<div class="media-left">
				<img src="{{ URL::asset('img/admin/user.png') }}" alt="Guest" class="media-object">
			</div>
			<div class="media-body">
				<h4 class="media-heading">Họ và tên: {{ $content['name'] }}</h4>
				<p class="support-p">Số điện thoại: {{ $content['phone'] }}</p>
				<p class="support-p">Địa chỉ email: {{ $content['email'] }}</p>
				<p class="support-p">Tên công ty: {{ $content['company'] }}</p>
				<p class="support-p">Địa chỉ: {{ $content['address'] }}</p>
				<p class="support-p">Gian hàng: {{ str_replace('/', ' --> ', $content['location']) }}</p>
			</div>
			<div class="media-right">
				<a href="{{ route('admin.support') }}" class="btn btn-primary" title="Quay lại">
					<span class="glyphicon glyphicon-arrow-left"></span>
				</a>
			</div>
		</div>
		<hr></hr>
		<h3>{{ $content['title'] }}</h3>
		<div class="support-content">
			{{ $content['content'] }}
		</div>
	</div>
@endsection