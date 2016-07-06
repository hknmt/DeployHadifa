<!-- <!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8"> 
		<meta name="viewport" content="width=device-width, initial-scale=1">
		Latest compiled and minified CSS
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

		jQuery library
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

		Latest compiled JavaScript
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	</head>

	<body>
		
		<button class="btn btn-primary" data-toggle="modal" data-target="#upload">Chon</button> -->

		<div id="upload" class="modal fade" role="dialog">
			<div class="modal-dialog modal-md">
				<div class="modal-content">

					<div class="modal-header">
						<p class="pull-left">Thư viện</p>
						<p class="pull-right btn-upload">
							<span>Upload</span>
							<input type="file" id="upload-file" multiple>
						<div class="clearfix"></div>
					</div>

					<div class="modal-body">
							<ul class="attachments">
							
							</ul>			
					</div>

					<div class="modal-footer">
						
					</div>
				</div>
			</div>
		</div>

		<script type="text/javascript">

			images = new Array;

			$(document).ready(function(){

				loadList();

				$("#upload-file").change(function(){

					files = $(this)[0].files;
					formData = new FormData();
					$.each(files, function(key, value){
						formData.append('image[]', value);
					});
					formData.append('_token', '{{ csrf_token() }}');
					console.log(files);		
					$.ajax({
						method: 'POST',
						url: '{{ route('upload.store') }}',
						dataType: 'json',
						data: formData,
						processData: false,
						contentType: false,
						success: function(data) {
							loadList();
							console.log(data);
							alert(data['messenger']);
						},
						error: function(data) {
							loadList();
							console.log(data);
						}
					});

				});
			});
			
			function getData(element)
			{

				link = $(element).find("img").attr("src");
				value = $(element).find("img").attr("value");
				getImage(value_element);
				$("#upload").modal('hide');				

			}

			function loadList()
			{

				$.ajax({
					method: 'POST',
					url: '{{ route('upload.files') }}',
					data: {
						'_token': '{{ csrf_token() }}'
					},
					dataType: 'json',
					success: function(data){
						console.log(data);
						images = data;
						dataHtml(images);
					},
					error: function(data){
						console.log(data);
					}
				});

			}

			function Remove(element)
			{

				var name = $(element).attr("rel-name");
				var mime = $(element).attr("rel-mime");
				$.ajax({
					method: 'POST',
					url: '{{ route('upload.destroy') }}',
					dataType: 'json',
					data: {
						'_token': '{{ csrf_token() }}',
						'name': name,
						'mime': mime
					},
					success: function(data){
						console.log(data);
						loadList();
					},
					error: function(data){
						console.log(data);
						loadList();
					}
				});

			}

			function dataHtml(object)
			{

				html  = "";
				$.each(object['images'], function(key, value){

					html += "<li class=\"attachment\">";
					html +=	"	<div class=\"attachment-preview\" onclick=\"getData(this);\">";
					html +=	"		<div class=\"image-thumbnail\">";
					html +=	"			<div class=\"centered\">";
					html +=	"				<img src=\""+ value['link'] +"\" value=\""+ value['link'] +"\">";
					html +=	"			</div>";
					html +=	"		</div>"	;
					html +=	"		<div class=\"attachment-name\">";
					html +=	"			<p>"+ value['name'].substr(0, 15) +"</p>";
					html +=	"		</div>"		;
					html +=	"	</div>"	;	
					html +=	"	<div class=\"remove-image\" onclick=\"Remove(this);\" rel-name=\""+ value['name'] +"\" rel-mime=\""+ value['mime_type'] +"\">";
					html +=		"	<span class=\"glyphicon glyphicon-trash\"></span>";
					html +=	"	</div>";
					html +="</li>";

				});

				$(".attachments").html(html);

			}


		</script>

<!-- 	</body>

    		
</html> -->