@extends('admin.layouts.master')

@section('content')
	
	<ol class="breadcrumb">
		<li>Dasboard</li>
		<li><a href="{{ route('admin.service.index', ['id' => $service['id']]) }}">{{ $service['name'] }}</a></li>
	</ol>

	<div class="panel panel-primary">
		<div class="panel-heading">
			<h4>Tạo chuyên mục con</h4>
		</div>
		@if (count($errors) > 0)
		    <div class="alert alert-danger">
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
		@endif
		<form action="{{ route('admin.service.subcategory.store') }}" method="POST">
		<div class="panel-body">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="hidden" name="c_id" value="{{ $service['id'] }}">
			<div class="form-group">
				<label for="name">Tên chuyên mục con: </label>
				@if(old('name'))
					<input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
				@else
					<input type="text" class="form-control" id="name" name="name" value="">
				@endif
			</div>
			<div class="form-group">
				<label for="category">Chuyên mục cha: </label>
				<select name="category" id="category" class="form-control">
				@foreach($category as $value)
					<option value="{{ $value['id'] }}">{{ $value['name'] }}</option>
				@endforeach
				</select>
			</div>
			<div class="form-group" id="imageSub">
				<label for="image">Ảnh đại diện</label>
				<input type="text" id="image" class="form-control" name="image" value="">
				<p style="margin-top:10px">
					<button type="button" class="btn btn-info" onclick="$('#upload').modal('show'); value_element = '#imageSub'">Chọn ảnh</button>
					<img src="{{ URL::asset('uploads/images/no-image.jpg') }}" class="img-thumbnail" style="height:95px;margin-left:20px">
				</p>
			</div>
		</div>
		<div class="panel-footer">
			<p class="pull-right">
				<button type="button" class="btn btn-danger" onclick="window.location.assign('{{ route('admin.service.category.index', ['id' => $service['id']]) }}')">Hủy</button>
				<button class="btn btn-success" type="submit">Lưu</button>
				<div class="clearfix"></div>
			</p>
		</div>
		</form>
	</div>

	<div id="upload-area">
		
	</div>

	<script type="text/javascript">
		$(document).ready(function(){

    		number = 0;
			$.ajax({
				type: 'get',
				dataType: 'html',
				url: '{{ route('upload.index') }}',
				success: function(data){
					console.log(data);					
					$("#upload-area").html(data);
				},
				error: function(data){
					console.log(data.responseText);
					$("#upload-area").empty();
					$("#upload-area").html(data.responseTEXT);
				}
			});

			$("#imageSub input").blur(function(){
				$(this).attr("value", $(this).val());
				$("#imageSub img").attr("src", $(this).val());
				$("#imageSub img").attr("value", $(this).val());
			});

    	});  

		function getImage(element)
    	{

    		$(element).find("img").attr("src", link);
    		$(element).find("img").attr("value", value);
    		$(element).find("input").val(value);
    		
    	}

	</script>

@endsection