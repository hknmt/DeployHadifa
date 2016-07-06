<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8">
	<title>Login</title>
	<link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/style.css') }}" rel="stylesheet">
    <script src="{{ URL::asset('js/jquery-1.11.3.min.js') }}"></script>
    <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
</head>
<body>
	
	<div class="container" style="margin-top: 100px">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h4>Login</h4>
					</div>
					<form action="{{ route('admin.login.post') }}"" method="POST" ">
					<div class="panel-body">
						@if(count($errors) > 0)
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
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="form-group">
							<label for="username">Tên đăng nhập:</label>
							<input class="form-control" type="username" name="username" id="username" placeholder="Nhập tên đăng nhập...">
						</div>
						<div class="form-group">
							<label for="password">Mật khẩu:</label>
							<input class="form-control" type="password" name="password" id="password" placeholder="Nhập mật khẩu...">
						</div>
						<div class="form-group">
							<p class="pull-left" style="margin-right:20px; padding-top:10px"><strong>Ghi nhớ </strong></p>
							<input type="checkbox" name="remember" id="remember" class="form-control pull-left" style="width: 10px">
							<div class="clearfix"></div>
						</div>
					</div>
					<div class="panel-footer">
						<button type="submit" class="btn btn-success pull-right">Sign In</button>
						<div class="clearfix"></div>
					</div>
					</form>
				</div>
			</div>
		</div>
	</div>

</body>
</html>