@extends('admin.layouts.master')

@section('head.css')
	<link rel="stylesheet" href="{{ URL::asset('css/jquery-ui.min.css') }}">
@endsection

@section('content')

	<ol class="breadcrumb">
		<li><a href="#">Dasboard</a></li>
		<li><a href="#">Dịch vụ</a></li>
		<li><a href="{{ route('admin.service.index', $service['id']) }}">{{ $service['name'] }}</a></li>
	</ol>

	<div class="panel panel-primary">
		<div class="panel-heading">
			<h4 class="pull-left">Chuyên mục - {{ $service['name'] }}</h4>
			<p class="pull-right">
				<button class="btn btn-default" onclick="window.location.assign('{{ route('admin.service.category.create', $service['id']) }}')">Tạo chuyên mục cha</button>
				<button class="btn btn-default" onclick="window.location.assign('{{ route('admin.service.subcategory.create', $service['id']) }}')">Tạo chuyên mục con</button>
			</p>
			<div class="clearfix"></div>
		</div>
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Tên chuyên mục</th>
					<th>Chức năng</th>
				</tr>
			</thead>
			<tbody>
			@foreach($category as $category_v)	
				<tr>
					<th>{{ $category_v['name'] }}</th>
					<td>
						<button class="btn btn-danger" onclick="destroyCategory(this);" rel="{{ $category_v['id'] }}" sub=".subcategory-{{ $category_v['id'] }}">Xóa</button>
						<button class="btn btn-success" onclick="window.location.assign('{{ route('admin.service.category.edit', ['id' => $category_v['id'], 'c_id' => $service['id']]) }}')">Sửa</button>
					</td>
				</tr>
				@foreach($category_v['sub'] as $sub)
					<tr class="subcategory-{{ $category_v['id'] }}">
						<td>----> {{ $sub['name'] }}</td>
						<td>
							<button class="btn btn-danger" onclick="destroySubcategory(this);" rel="{{ $sub['id'] }}">Xóa</button>
							<button class="btn btn-success" onclick="window.location.assign('{{ route('admin.service.subcategory.edit', ['id' => $sub['id'], 's_id' => $service['id']]) }}')">Sửa</button>
						</td>
					</tr>
				@endforeach
			@endforeach
			</tbody>
		</table>
		<div class="panel-footer"></div>
	</div>

	<div style="display: none">
		<div id="dialog-confirm" title="Xác nhận">
			<p class="text-justify"><b>Lưu ý:</b>Các chuyên mục con, bài viết liên quan sẽ bị xóa. Bạn có chắc muốn xóa ?</p>
		</div>
		<div id="dialog-error" title="Lỗi">
			
		</div>
	</div>

	<script type="text/javascript">
		
		function destroySubcategory(element)
		{

			var id = $(element).attr("rel");

			$("#dialog-confirm").dialog({
				modal: true,
				buttons: {
					"Có": function(){
						$.ajax({
							method: 'POST',
							url : '{{ route('admin.service.category.destroy') }}',
							dataType: 'json',
							data: {
								'_token' : '{{ csrf_token() }}',
								'subcategory' : id
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
					"Không": function(){
						$(this).dialog("close");
					}
				}
			});

		}

		function destroyCategory(element)
		{

			var id = $(element).attr("rel");
			var sub = $(element).attr("sub");

			$("#dialog-confirm").dialog({
				modal: true,
				buttons: {
					"Có": function(){
						$.ajax({
							method: 'POST',
							url : '{{ route('admin.service.category.destroy') }}',
							dataType: 'json',
							data: {
								'_token' : '{{ csrf_token() }}',
								'category' : id
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
					"Không": function(){
						$(this).dialog("close");
					}
				}
			});

		}

	</script>

	<script src="{{ URL::asset('js/jquery-ui.min.js') }}"></script>

@endsection