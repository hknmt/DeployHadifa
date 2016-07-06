@extends('admin.layouts.master')

@section('head.css')
	<link rel="stylesheet" href="{{ URL::asset('css/jquery-ui.min.css') }}">
@endsection

@section('content')

	<ol class="breadcrumb">
		<li><a href="#">Dasboard</a></li>
		<li><a href="#">Service</a></li>
		<li><a href="{{ route('admin.service.index', $service['id']) }}">{{ $service['name'] }}</a></li>
	</ol>
	<p class="pull-right">
		<button class="btn btn-info" onclick="window.location.assign('{{ route('admin.service.post.create', $service['id']) }}')">Thêm bài viết mới</button>
		<div class="clearfix"></div>
	</p>
	<div class="panel panel-primary">
		<div class="panel-heading">
			<div class="row">
				<div class="col-md-4">
					<h4>Bài viết - {{ $service['name'] }}</h4>
				</div>
				<div class="col-md-4 col-md-offset-4">
					<div class="form-group">
						<select name="view" id="select-category" class="form-control" onchange="directUrl(this);">
							<option value="all" rel="{{ route('admin.service.post.index', ['id' => $service['id'], 'view' => "all"]) }}">Xem tất cả</option>
							@if(isset($list))
								@foreach($list as $value)
									<option value="{{ $value['id'] }}" rel="{{ route('admin.service.post.index', ['id' => $service['id'], 'view' => $value['id']]) }}">{{ $value['name'] }}</option>
								@endforeach
							@else
								@foreach($listCategory as $k => $v)
									<option value="{{ $k }}" rel="{{ route('admin.service.post.index', ['id' => $service['id'], 'view' => $k]) }}">{{ $v }}</option>
								@endforeach
							@endif
						</select>
					</div>
				</div>
			</div>
		</div>
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Tiêu đề bài viết</th>
					<th>Chuyên mục</th>
					<th>Lượt xem</th>
					<th>Chức năng</th>
				</tr>
			</thead>
			<tbody>
			@foreach($post as $value)
				<tr>
					<td>{{ $value['name'] }}</td>
					<td>
					@if(isset($listCategory))
						<a href="{{ route('admin.service.post.index', ['id' => $service['id'], 'view' => $value['subcategory_id']]) }}">{{ $listCategory[$value['subcategory_id']] }}</a>
					@else
						<a href="{{ route('admin.service.post.index', ['id' => $service['id'], 'view' => $value['subcategory_id']]) }}">{{ $category['name'] }}</a>
					@endif
					</td>
					<td>{{ $value['view'] }}</td>
					<td>
						<button class="btn btn-danger" rel="{{ $value['id'] }}" onclick="Destroy(this);">Xóa</button>
						<button class="btn btn-success" onclick="window.location.assign('{{ route('admin.service.post.edit', ['id' => $value['id'], 'service' => $service['id']]) }}')">Sửa</button>
					</td>
				</tr>
			@endforeach
			</tbody>
		</table>
		<div class="panel-footer text-center">
		@if(!empty($post))
			{!! $post->links() !!}
		@endif
		</div>
	</div>

	<div style="display:none">
		<div id="dialog-confirm" title="Xóa bài viết">
			<p><span class="glyphicon glyphicon-question-sign" style="margin-right: 20px"></span>Bạn có muốn xóa bài viết này không ?</p>
		</div>

		<div id="dialog-error" title="Thông báo">
			222222222
		</div>
	</div>

	<script type="text/javascript">

	/*Dat gia tri selected cho category duoc chon*/
		@if($view == "all")
		category = 'all';
		@else
		category = {{ $view }};
		@endif
		select = $("#select-category").children("option");
		$.each(select, function(key,value){
			var tmp = $(value).val();
			if(category == tmp)
				$(value).attr("selected", "selected");
		});
	/*---------------------------------------------*/

	function directUrl(element)
	{

		listSelect = $("#select-category").children("option");
		var tmp = $(element).val();
		$.each(listSelect, function(key, value){
			if(tmp == $(value).val())
				window.location.assign($(value).attr("rel"));
		});

	}

	function Destroy(element)
	{

		var id = $(element).attr("rel");

		$("#dialog-confirm").dialog({
			resizable: false,
			modal: true,
			buttons: {
				"Đồng ý": function() {
					$.ajax({
						url: '{{ route('admin.service.post.destroy') }}',
						dataType: 'json',
						method: 'POST',
						data: {
							'_token': '{{ csrf_token() }}',
							'id': id
						},
						success: function(data){
							console.log(data);
							$(element).parents("tr").remove();
							$("#dialog-confirm").dialog("close");
						},
						error: function(data){
							console.log(data);
							$("#dialog-confirm").dialog("close");
							$("#dialog-error").html("<p>" + data.responseJSON['messenger'] + "</p>");
							$("#dialog-error").dialog();
						}
					});
				},
				"Không": function() {
					$(this).dialog("close");
				}
			}
		});		

	}

	</script>

	<script src="{{ URL::asset('js/jquery-ui.min.js') }}"></script>

@endsection