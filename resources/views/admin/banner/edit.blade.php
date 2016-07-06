@extends('admin.layouts.master')
@section('content')
	<div class="content">
		<form action="{{ route('admin.banner.store') }}" method="POST" enctype="multipart/form-data">
			<div class="panel panel-primary">
				<div class="panel-heading">Edit Banner</div>
				<div class="panel-body">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>ID</th>
								<th>Tiêu đề</th>
								<th>Liên kết</th>
								<th>Image</th>
								<th>Chức năng</th>
							</tr>
						</thead>
						<div style="display:none;">{{ $i=1 }}</div>
						<tbody>
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="hidden" name="id" value="{{ $id }}">						
							@foreach($contents as $content)
							<tr id="image-{{ $i }}">
								<td>{{ $i }}</td>
								<td>
									<div class="form-group">
										<input type="text" class="form-control" name="image[{{ $i }}][title]" value="{{ $content->title }}">
									</div>
								</td>
								<td>
									<div class="form-group">
										<input type="text" class="form-control" name="image[{{ $i }}][link]" value="{{ $content->link }}">
									</div>
								</td>
								<td>
									<img class="image-change" style="width:100px;height:100px;" src="{{ URL::asset($content->url) }}" alt="{{ $content->title }}">
									<input type="hidden" name="image[{{ $i }}][url]" value="{{ $content->url }}">
								</td>
								<td>
									<button onclick="$(this).closest('tr').remove();num--;" class="btn btn-danger" type="button"><span class="glyphicon glyphicon-trash"></span></button>
								</td>
							</tr>	
							{{ $i++ }}
							@endforeach				
						</tbody>
					</table>
				</div>
				<div class="panel-footer">
					<button id="new-form" class="btn btn-info" type="button"><span class="glyphicon glyphicon-plus"></span></button>
					<button class="btn btn-info pull-right" type="submit"><span class="glyphicon glyphicon-floppy-saved"></span></button>
				</div>
			</div>
		</form>
	</div>
	<script>
		var num = {{ $num }}+1;

		$('#new-form').click(function() {
			var html = '';
			html += '<tr id="image-'+num+'">';
			html += '<td>'+num+'</td>';
			html += '<td><div class="form-group"><input type="text" class="form-control" name="image['+num+'][title]" value=""></div></td>';
			html += '<td><div class="form-group"><input type="text" class="form-control" name="image['+num+'][link]" value=""></div></td>';
			html += '<td><a class="image-change" data="image-'+num+'" href="#"><img src="{{ URL::asset('img/example.jpg') }}" alt="img"></a><input type="hidden" name="image['+num+'][url]" value=""></td>';
			html += '<td><button id="image-'+num+'" class="btn btn-danger" type="button" onclick="$(this).closest(\'tr\').remove();num--"><span class="glyphicon glyphicon-trash"></span></button></td>';
			html += '</tr>';
			$('tbody').append(html);
			num++;
		});

		$(document).delegate('.image-change', 'click', function(e) {
			var id = $(this).closest('tr').attr('id');
			$('#modal-image').remove();
			$.ajax({
				url: '{{ route('upload.test') }}',
				dataType: 'html',
				success: function(html) {
					$('.modal-content').append('<div id="modal-image" rel="'+id+'">'+ html +'</div>');
					$('#Modal').modal('show');
				}
			});
		});
	</script>

	<div id="Modal" class="modal fade" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				
			</div>
		</div>
	</div>
@endsection