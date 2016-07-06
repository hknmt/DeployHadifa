@extends('admin.layouts.master')
@section('content')
	<h3>Yêu cầu</h3>
	<div class="content">
		<table class="table table-striped">
			<thead>
				<tr>
					<th>ID</th>
					<th>Họ và tên</th>
					<th>Email</th>
					<th>Tiêu đề</th>
					<th>Chức năng</th>
				</tr>
			</thead>
			<tbody>
				<input type="hidden" name="count" value="{{ $i = 1 }}">
				@foreach($contents as $content)
				<tr class="{{ ($content['read']) ? 'active' : 'danger' }}">
					<th scope="row">{{ $i++ }}</th>
					<input type="hidden" name="id" value="{{$content->id}}">
					<td>{{$content->name}}</td>
					<td>{{$content->email}}</td>
					<td>{{$content->title}}</td>
					<td><a class="view" href="{{ route('admin.support.show',$content->id) }}" title="Xem nội dung"><span class="glyphicon glyphicon-eye-open"></span></a></td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	<div class="row">
		<div class="col-sm-4 col-sm-offset-4">
			{!! $contents->render() !!}
		</div>
	</div>
@endsection