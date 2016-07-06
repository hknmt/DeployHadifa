@extends('admin.layouts.master')
@section('content')
<div class="content">
	<table class="table table-striped">
		<thead>
			<tr>
				<th>ID</th>
				<th>Vị trí</th>
				<th>Chức năng</th>
			</tr>
		</thead>
		<tbody>
			@foreach($contents as $content)
			<tr>
				<td>{{ $content->id }}</td>
				<td>{{ $content->name }}</td>
				<td>
					<a href="{{ route('admin.banner.edit', $content->id) }}" title="Chỉnh sửa"><span class="glyphicon glyphicon-edit"></span></a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
@endsection