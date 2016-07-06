@extends('admin.layouts.master')

@section('head.js')
	<script src="{{ URL::asset('js/ckeditor/ckeditor.js') }}"></script>
@endsection

@section('content')
	<div class="row">
		<div class="col-md-10">
			<ol class="breadcrumb">
				<li>Dasboard</li>
				<li><a href="{{ route('admin.service.tfe') }}">Trade Fair Exhibition</a></li>
			</ol>
		</div>
		<div class="col-md-2">
			<p class="pull-right"><button onclick="window.location.assign('{{ route('admin.service.tfe') }}')" class="btn btn-info">Quay lại</button></p>
			<div class="clearfix"></div>
		</div>
	</div>
	
	<ul class="nav nav-tabs">
		<li class="active"><a href="#post" data-toggle="tab">Chỉnh sửa bài viết</a></li>
		<li><a href="#slideshow" data-toggle="tab">Chỉnh sửa Slideshow</a></li>
	</ul>
	<div class="tab-content">
		<div id="post" class="tab-pane fade in active">
			<div class="panel-body">
				<div class="form-group">
					<label for="name">Tên bài viết:</label>
					<input class="form-control" type="text" id="name" name="name" value="{{ $result['name'] }}">
				</div>
				<div class="form-group">
					<label for="description">Tóm tắt:</label>
					<textarea class="form-control" type="text" id="description" name="descriptions">{{ $result['description'] }}</textarea>
				</div>
				<div class="form-group avatar">
					<label for="avatar">Ảnh đại diện:</label>
					<input name="image" type="text" id="image" class="form-control" value="{{ URL::asset($result['image']) }}" onblur="$(this).parents('.avatar').find('img').attr('src', $(this).val());$(this).parents('.avatar').find('img').attr('value', $(this).val())">
					<p style="margin-top:10px">
						<button class="btn btn-info" onclick="$('#upload').modal('show'); value_element = '.avatar'">Chọn ảnh </button>
						<img class="img-thumbnail" src="{{ URL::asset($result['image']) }}" value="{{ $result['image'] }}" style="width: 120px;">
					</p>
				</div>
				<div class="form-group">
					<label for="start">Ngày bắt đầu:</label>
					<input type="date" class="form-control" id="start" name="start" value="{{ $result['start'] }}">
				</div>
				<div class="form-group">
					<label for="end">Ngày kết thúc:</label>
					<input type="date" class="form-control" id="end" name="end" value="{{ $result['end'] }}">
				</div>
				<div class="form-group">
					<label for="information">Thông tin:</label>
					<textarea name="information" id="information" cols="30" rows="10">{{ $result['post']['information'] }}</textarea>
				</div>
				<div class="form-group">
					<label for="content_">Nội dung:</label>
					<textarea name="content_" id="content_" cols="30" rows="10">{{ $result['post']['content'] }}</textarea>
				</div>
			</div>
			<div class="panel-footer">
				<p class="pull-right">
					<button onclick="window.location.assign('{{ route('admin.service.tfe') }}')" class="btn btn-danger">Hủy</button>
					<button type="button" onclick="sendForm()" class="btn btn-primary">Lưu</button>
				</p>
				<div class="clearfix"></div>
			</div>
		</div>
		<div id="slideshow" class="tab-pane fade">
			<div class="panel panel-default">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Hình ảnh</th>
							<th>Chức năng</th>
						</tr>
					</thead>
					<tbody>
					<input type="hidden" value="{{ $count = 1 }}">
					@foreach($result['slide'] as $value)
						<tr id="slideshow{{ $count }}">
							<th>
								<img class="img-thumbnail" src="{{ URL::asset($value['image']) }}" style="height:95px" value="{{ $value['image'] }}">
							</th>
							<th>
								<button class="btn btn-info" onclick="$('#upload').modal('show'); value_element = '#slideshow{{ $count++ }}'">Sửa</button>
								<button class="btn btn-danger" onclick="$(this).parents('tr').remove();">Xóa</button>
							</th>
						</tr>
					@endforeach
					</tbody>
				</table>
				<div class="panel-footer">
					<div class="pull-left">
						<button class="btn btn-info" onclick="addImage()">Thêm</button>
					</div>
					<div class="pull-right">
						<button class="btn btn-danger" onclick="window.location.assign('{{ route('admin.service.tfe') }}')">Hủy</button>
						<button class="btn btn-primary" onclick="sendForm()">Lưu</button>						
					</div>	
					<div class="clearfix"></div>				
				</div>
			</div>
		</div>
	</div>
	<div id="upload-area">
		
	</div>
	
	<script type="text/javascript">
            CKEDITOR.replace( 'information' );
            CKEDITOR.replace('description');
            CKEDITOR.replace('content_');
    </script>

    <script type="text/javascript">
    	number = {{ $count }};
    	$(document).ready(function(){
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
    	});       

    	function sendForm() 
    	{

    		/*Get image to slideshow*/
    		var image_slide = new Array;
    		var tmp = $("tbody img");

    		$.each(tmp, function(key, value){
    			image_slide[key] = $(value).attr("value");
    		});

    		$.ajax({
    			type: 'post',
    			dataType: 'json',
    			url: '{{ route('admin.service.tfe.update', $result['id']) }}',
    			data: {
					'_token' : '{{ csrf_token() }}',
					'name' : $("input#name").val(),
					'description' : CKEDITOR.instances.description.getData(),
					'image' : $(".avatar img").attr("value"),
					'start' : $("input#start").val(),
					'end' : $("input#end").val(),
					'information' : CKEDITOR.instances.information.getData(),
					'content' : CKEDITOR.instances.content_.getData(),
					'slide' : image_slide,
    			},
    			success: function(data) {
    				console.log(data);
    				$success = data['messenger'];
    				$(".alert").remove();
    				html  = "";
					html += "<div class=\"alert alert-success\">";
					html += "<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;<\/a>"
					html += "<strong>Thành công! <\/strong>" + $success;
					html += "<\/div>"
					$(".tab-content > .active").prepend(html);
					$("html, body").animate({
						scrollTop: $(".alert").offset().top
					}, "slow");
    			},
    			error: function(data) {
    				console.log(data);
    				$errors = data.responseJSON;
    				$(".alert").remove();
    				$.each($errors, function(key, value){
    					html  = "";
    					html += "<div class=\"alert alert-danger\">";
    					html += "<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;<\/a>"
    					html += "<strong>Lỗi! <\/strong>" + value;
    					html += "<\/div>"
    					$(".tab-content > .active").prepend(html);
    					$("html, body").animate({
    						scrollTop: $(".alert").offset().top
    					}, "slow");
    				});
    			}
    		});

    	}

    	function addImage()
    	{

    		html  = "";
    		html += "<tr id=\"slideshow" + number + "\">";
			html +=	"<th>";
			html +=		"<img class=\"img-thumbnail\" src=\"{{ URL::asset('img/no-image.jpg') }}\" style=\"height:95px\" value=\"\">";
			html +=	"<\/th>";
			html +=	"<th>";
			html +=	"	<button class=\"btn btn-info\" onclick=\"$('#upload').modal('show'); value_element = '#slideshow" + number + "'\">Sửa<\/button>";
			html +=	"	<button class=\"btn btn-danger\" onclick=\"$(this).parents('tr').remove();\">Xóa<\/button>";
			html +=	"<\/th>";
			html += "<\/tr>";
			$("tbody").append(html);
			number++;

    	}

    	function getImage(element)
    	{

    		$(element).find("img").attr("src", link);
    		$(element).find("img").attr("value", value);
    		$(element).find("input").val(value);
    		
    	}

	</script>

@endsection