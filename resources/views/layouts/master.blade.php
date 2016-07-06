<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('head.title')</title>

    @yield('head.css')
    <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/style.css') }}" rel="stylesheet">

    <script src="{{ URL::asset('js/jquery-1.11.3.min.js') }}"></script>
    <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
    @yield('head.js')

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  @yield('body.js')

  @include('partials.head')

	@include('partials.banner')

	<div class="container" id="content">
		<div class="row">
			<div class="col-md-9">
				@yield('body.content')
			</div>
			@yield('body.sidebar')
		</div>
	</div>
	@include('partials.footer')

    
  </body>
</html>