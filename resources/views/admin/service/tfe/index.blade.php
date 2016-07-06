@extends('admin.layouts.master')

@section('head.css')
	<link rel="stylesheet" href="{{ URL::asset('css/jquery-ui.min.css') }}">
@endsection

@section('head.js')
	<script src="{{ URL::asset('js/jquery-ui.min.js') }}"></script>
@endsection

@section('content')

	<h3>Trade Fair Exhibition</h3>
	<div class="add">
		<a href="{{ route('admin.service.tfe.create') }}" class="btn btn-primary">Thêm bài viết</a>
	</div>
	<div class="content">
		<table class="table table-striped">
			<thead>
				<tr>
					<th>ID</th>
					<th>Tên</th>
					<th>Ảnh đại diện</th>
					<th>Thời gian bắt đầu</th>
					<th>Thời gian kết thúc</th>
					<th>Chức năng</th>
				</tr>
			</thead>
			<tbody>
				<input type="hidden" name="count" value="{{ $i = 1 }}">
				@foreach($result as $value)
				<tr>
					<th scope="row">{{ $i++ }}</th>
					<input type="hidden" name="id" value="{{$value->id}}">
					<td>{{$value->name}}</td>
					<td><img src="{{ URL::asset($value->image) }}" style="width: 90px; height: 90px"></td>
					<td>{{$value->start}}</td>
					<td>{{$value->end}}</td>
					<td>
						<a href="{{ route('admin.service.tfe.edit', $value->id) }}" title="Chỉnh sửa"><span class="glyphicon glyphicon-pencil"></span></a>
						<a href="#" title="Xóa"><span onclick="removePost(this);" value="{{ $value->id }}" class="glyphicon glyphicon-trash"></span></a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	<div class="row">
		<div class="col-sm-4 col-sm-offset-4">
			{!! $result->links() !!}
		</div>
	</div>

	<div style="display:none">
		<div id="dialog-confirm" title="Xác nhận!">
			<p><span class="glyphicon glyphicon-question-sign" style="float:left; margin:0 7px 20px 0;"></span>Bạn chắc chắn muốn XÓA chứ ?</p>
		</div>

		<div id="dialog-notice" title="Thông báo!">
			<p>Có lỗi xảy ra.</p>
		</div>
	</div>

	<script type="text/javascript">
		function removePost(e)
		{

			$("#dialog-confirm").dialog({
				resizable: false,
				modal: true,
				buttons: {
					"Xóa": function(){
						$.ajax({
							url: '{{ route('admin.service.tfe.destroy') }}',
							type: 'post',
							dataType: 'json',
							data: {
								'_token' : '{{ csrf_token() }}',
								'id': $(e).attr("value")
							},
							success: function(data){
								console.log(data);
								$(e).parents("tr").remove();								
							},
							error: function(data){
								console.log(data);
								$("#dialog-notice").dialog();
							}

						});						
						$(this).dialog("close");
					},
					"Bỏ qua": function(){
						$(this).dialog("close");
					}
				}
			});

		}
	</script>



@endsection