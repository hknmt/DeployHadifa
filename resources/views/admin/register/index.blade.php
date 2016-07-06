@extends('admin.layouts.master')

@section('head.title')
	Thông tin khách hàng đăng ký dịch vụ
@endsection

@section('content')

	<ol class="breadcrumb">
		<li><a href="#">Dasboard</a></li>
		<li><a href="{{ route('admin.register.index') }}">Đăng ký</a></li>
	</ol>

	<div class="panel panel-primary">
		<div class="panel-heading">
			<h4>Thông tin khách hàng đăng ký dịch vụ</h4>
		</div>
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Tên người đăng ký</th>
					<th>Loại</th>
					<th>Ngày yêu cầu</th>
					<th>Trạng thái</th>
					<th>Chức năng</th>
				</tr>
			</thead>
			<tbody>
			@foreach($posts as $post)
				<tr>
					<td>{{ $post['name'] }}</td>
					<td>{{ $post['category'] }}</td>
					<td>{{ $post->created_at }}</td>
					<td>
					@if($post['read'])
						<p class="bg-success">Đã đọc
					@else
						<p class="bg-danger">Chưa đọc
					@endif
						</p>
					</td>
					<td>
						<button class="btn btn-info" onclick="window.location.assign('{{ route('admin.register.show', $post['id']) }}')">Đọc</button>
						<button class="btn btn-danger">Xóa</button>
					</td>
				</tr>
			@endforeach
			</tbody>
		</table>
		<div class="panel-footer text-center">
			{!! $posts->links() !!}
		</div>
	</div>

@endsection