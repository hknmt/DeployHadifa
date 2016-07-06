@extends('admin.layouts.master')

@section('content')

	<div class="panel panel-primary">
		<div class="panel-heading">Chỉnh sửa</div>
		<form action="{{ route('admin.partner.store') }}" method="POST">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="panel-body">
			@if(count($errors))
			<div class="alert alert-danger">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Lỗi!</strong>
				<ul>
				@foreach($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
				</ul>				
			</div>
			@endif
			<div class="form-group">
				<label for="description">Thông tin đối tác</label>
				<input type="text" class="form-control" id="description" name="description" value="{{ old('description') }}">
			</div>
			<div class="form-group">
				<label for="link">Liên kết</label>
				<input type="text" class="form-control" id="link" name="link" value="{{ old('link') }}">
			</div>
			<div class="form-group" id="avatar">
				<label for="image">Ảnh đại diện</label>
				<input type="text" class="form-control" id="image" name="image" value="{{ URL::asset(old('image') ) }}">
				<p style="margin-top:20px">
					<img src="{{ URL::asset(old('image') ) }}" class="img-thumbnail" style="margin-right:20px; height:95px">
					<button type="button" class="btn btn-info" id="changeImg">Sửa ảnh</button>
				</p>
			</div>
		</div>
		<div class="panel-footer">
			<p class="pull-right">
				<button type="submit" class="btn btn-success">Lưu</button>
				<button type="button" class="btn btn-danger" onclick="window.location.assign('{{ route('admin.partner.index') }}')">Bỏ qua</button>
			</p>
			<div class="clearfix"></div>
		</div>
		</form>
	</div>

	@section('upload')
	<div id="upload-area">
		
	</div>
	@endsection

	<script>

		$(document).ready(function(){

			$.ajax({
				type: 'get',
				dataType: 'html',
				url: '{{ route('upload.index') }}',
				success: function(data){				
					$("#upload-area").html(data);
				},
				error: function(data){
				}
			});

			$("#image").blur(function(){
				var parent = $(this).parent();
				$(parent).find("img").attr("src", $(this).val());
			});

			$("#changeImg").click(function(){
				$('#upload').modal('show'); 
				value_element = "#avatar";
			});

		});

		function getImage(element)
    	{

    		$(element).find("img").attr("src", link);
    		$(element).find("input").val(value);
    		
    	}

	</script>

@endsection