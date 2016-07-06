@extends('admin.layouts.master')

@section('content')

	<ol class="breadcrumb">
		<li><a href="#">Dasboard</a></li>
		<li><a href="#">Service</a></li>
		<li><a href="{{ route('admin.service.index', $service['id']) }}">{{ $service['name'] }}</a></li>
	</ol>

	<div class="panel panel-default">
		<div class="panel-heading">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#home" data-toggle="tab">Nội dung</a></li>
				<li><a href="#slideshow" data-toggle="tab">Ảnh</a></li>
			</ul>
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
		<form action="{{ route('admin.service.post.store') }}" method="post">
			<div class="tab-content">
				<div id="home" class="tab-pane fade in active">
					<div class="panel-body">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="id" value="{{ $post['id'] }}">
						<input type="hidden" name="service" value="{{ $service['id'] }}">
						<div class="form-group">
							<label for="name">Tên tiêu đề bài viết: </label>
							<input type="text" id="name" name="name" class="form-control" value="{{ $post['name'] }}">
						</div>
						<div class="form-group">
							<label for="category">Chuyên mục cha: </label>
							<select class="form-control" name="category" id="category">
							@foreach($subcategory as $value)
								@if($post['subcategory_id'] == $value['id'])
								<option selected="selected" value="{{ $value['id'] }}">{{ $value['name'] }}</option>
								@else
								<option value="{{ $value['id'] }}">{{ $value['name'] }}</option>
								@endif
							@endforeach
							</select>
						</div>
						<div class="form-group" id="imgAvatar">
							<label for="image">Ảnh đại diện: </label>
							<input name="image" type="text" id="image" class="form-control" value="{{ URL::asset($post['image']) }}" onblur="$(this).parents('#imgAvatar').find('img').attr('src', $(this).val());">
							<p style="margin-top:10px">
								<button type="button" class="btn btn-info" onclick="$('#upload').modal('show'); value_element = '#imgAvatar'">Chọn ảnh</button>
								<img src="{{ URL::asset($post['image']) }}" class="img-thumbnail" style="height:95px;margin-left:20px">
							</p>
						</div>
						<div class="form-group">
							<label for="information">Thông tin: </label>
							<textarea name="information" id="information" class="form-control" cols="30" rows="10">{{ $post['information'] }}</textarea>
						</div>
					</div>
				</div>
				<div id="slideshow" class="tab-pane fade">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>Ảnh</th>
								<th>URL</th>
								<th>Chức năng</th>
							</tr>
						</thead>
						<tbody>
						<input type="hidden" value="{{ $count = 1 }}">
						@foreach($slideshow as $value)
							<tr id="slideshow{{ $count }}">
								<td><img src="{{ URL::asset($value['image']) }}" class="img-thumbnail" style="height:95px"></td>
								<td>
									<input name="slide[]" type="text" class="form-control slide" value="{{ URL::asset($value['image']) }}" onblur="$(this).parents('tr').find('img').attr('src', $(this).val());">
								</td>
								<td>
									<button type="button" class="btn btn-info" onclick="$('#upload').modal('show'); value_element = '#slideshow{{ $count++ }}'">Sửa</button>
									<button type="button" class="btn btn-danger" onclick="$(this).parents('tr').remove();">Xóa</button>
								</td>
							</tr>
						@endforeach
						</tbody>
						<tfoot>
							<tr>
								<td></td>
								<td></td>
								<td>
									<button type="button" class="btn btn-primary" onclick="addImage();">Thêm ảnh</button>
								</td>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
			<div class="panel-footer">
				<p class="pull-right">
					<button type="button" class="btn btn-danger" onclick="window.location.assign('{{ route('admin.service.post.index', ['id' => $service['id'], 'view' => "all"]) }}');">Hủy</button>
					<button type="submit" class="btn btn-success">Lưu</button>
					<div class="clearfix"></div>
				</p>
			</div>
		</form>
	</div>

	<div id="upload-area">
		
	</div>

	<script type="text/javascript">
		$(document).ready(function(){

    		number = {{ $count }};
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

			CKEDITOR.replace( 'information' );

    	});  

		function getImage(element)
    	{

    		$(element).find("img").attr("src", link);
    		$(element).find("img").attr("value", value);
    		$(element).find("input").val(value);
    		
    	}

    	function addImage()
    	{

    		html  = "";
    		html += "<tr id=\"slideshow" + number + "\">";
			html +=	"<td>";
			html +=		"<img class=\"img-thumbnail\" src=\"{{ URL::asset('img/no-image.jpg') }}\" style=\"height:95px\" value=\"\">";
			html +=	"<\/td>";
			html += "<td>";
			html +=	"	<input name=\"slide[]\" type=\"text\" class=\"form-control\" value=\"{{ URL::asset('img/no-image.jpg') }}\" onblur=\"$(this).parents('tr').find('img').attr('src', $(this).val());\">";
			html += "</td>";
			html +=	"<td>";
			html +=	"	<button type=\"button\" class=\"btn btn-info\" onclick=\"$('#upload').modal('show'); element = '#slideshow" + number + "'\">Sửa<\/button>";
			html +=	"	<button type=\"button\" class=\"btn btn-danger\" onclick=\"$(this).parents('tr').remove();\">Xóa<\/button>";
			html +=	"<\/td>";
			html += "<\/tr>";
			$("tbody").append(html);
			number++;

    	}

	</script>

	<script src="{{ URL::asset('js/ckeditor/ckeditor.js') }}"></script>	

@endsection