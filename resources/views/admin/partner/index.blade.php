@extends('admin.layouts.master')

@section('head.css')
	<link href="{{ URL::asset('css/jquery-ui.min.css') }}" rel="stylesheet">
@endsection

@section('content')
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h4 class="pull-left">Đối tác</h4>
			<button class="btn btn-default pull-right" onclick="window.location.assign('{{ route('admin.partner.create') }}')">Thêm mới</button>
			<div class="clearfix"></div>
		</div>
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Thông tin đối tác</th>
					<th>Ảnh đại diện</th>
					<th>Chức năng</th>
				</tr>
			</thead>
			<tbody>
			@foreach($result as $value)
				<tr>
					<td><strong>{{ $value->description }}</strong></td>
					<td><img src="{{ URL::asset($value->image) }}" class="img-thumbnail" style="height:95px"></td>
					<td>
						<button class="btn btn-info" onclick="window.location.assign('{{ route('admin.partner.edit', $value->id) }}')">Sửa</button>
						<button class="btn btn-danger" rel="{{ $value->id }}">Xóa</button>
					</td>
				</tr>
			@endforeach
			</tbody>
		</table>
		<div class="panel-footer text-center">
			{!! $result->links() !!}
		</div>
	</div>

	<script src="{{ URL::asset('js/jquery-ui.min.js') }}"></script>

	<script>
		$(".btn-danger").click(function(){
			var id = $(this).attr("rel");
			var parent = $(this).parents("tr");
			$("#dialog-confirm").dialog({
				modal: true,
				buttons: {
					"Xóa" : function(){
						$.ajax({
							url: '{{ route('admin.partner.destroy') }}',
							method: 'post',
							dataType: 'json',
							data: {
								'_token' : '{{ csrf_token() }}',
								'id' : id
							},
							success: function(data){
								$("#dialog-confirm").dialog("close");
								$(parent).remove();
							},
							error: function(data){
								$("#dialog-confirm").dialog("close");
								$("#dialog-alert").html("<p>" +data.responseJSON.messenger + "</p>");
								$("#dialog-alert").dialog();
							}
						});
					},
					"Bỏ qua" : function(){
						$(this).dialog("close");						
					}
				}
			});
		});		
	</script>

@endsection

@section('upload')
	<div id="dialog-confirm" title="Xác nhận xóa?">
		<span class="glyphicon glyphicon-exclamation-sign" style="margin-right:10px"></span>Bạn có muốn xóa nội dung này hay không ?
	</div>

	<div id="dialog-alert" title="Có lỗi xảy ra!">
		
	</div>
@endsection