<div class="container" id="head">
	<div class="row">
		<div class="col-md-4">
			<img class="img-responsive" src="{{ URL::asset('img/logo.png') }}" alt="logo">
		</div>
		<div class="col-md-6 col-md-offset-2">
			<div id="search">
				<form action="#">
					<input type="text" placeholder="Tìm kiếm">
					<button type="submit">Tìm kiếm</button>
				</form>
			</div>
			<div class="clearfix"></div>
			<div id="nav">
				<ul>
					@if(array_key_exists(0, $nav))
						<li><a class="{{ ($nav[0] == '' || $nav[0] == 'home') ? 'nav_active' : '' }}" href="{{ route('home') }}">Trang chủ</a></li>
						<li><a class="{{ ($nav[0] == 'about') ? 'nav_active' : '' }}" href="{{ route('about') }}">Giới thiệu</a></li>
						<li class="main-menu {{ ($nav[0] == 'service') ? 'nav_active' : '' }}">
							<a class="{{ ($nav[0] == 'service') ? 'nav_active' : '' }}" href="{{ route('service.index') }}">Dịch vụ</a>
							<ul class="child-menu">
								@if(array_key_exists(1, $nav))
									<li><a id="{{ ($nav[1] == 'trade-fair-exhibition') ? 'child-active' : '' }}" href="{{ route('service.trade.index') }}">Trade Fair Exbihition</a></li>
									@foreach ($list as $valuel)
										<li><a id="{{ ($nav[1] == $valuel['slug']) ? 'child-active' : '' }}" href="{{ route('service.service', ['service' => $valuel['slug']]) }}">{{ $valuel['name'] }}</a></li>
									@endforeach
								@else
									<li><a href="{{ route('service.trade.index') }}">Trade Fair Exbihition</a></li>
									@foreach ($list as $valuel)
										<li><a href="{{ route('service.service', ['service' => $valuel['slug']]) }}">{{ $valuel['name'] }}</a></li>
									@endforeach
								@endif
							</ul>
						</li>
						<li><a href="#">Liên hệ</a></li>
					@else
						<li><a class="nav_active" href="#">Trang chủ</a></li>
						<li><a href="{{ route('about') }}">Giới thiệu</a></li>
						<li class="main-menu">
							<a href="{{ route('service.index') }}">Dịch vụ</a>
							<ul class="child-menu">
								<li><a href="{{ route('service.trade.index') }}">Trade Fair Exbihition</a></li>
								@foreach ($list as $valuel)
									<li><a href="{{ route('service.service', ['service' => $valuel['slug']]) }}">{{ $valuel['name'] }}</a></li>
								@endforeach
							</ul>
						</li>
						<li><a href="#">Liên hệ</a></li>
					@endif
				</ul>
			</div>
			<div class="clearfix"></div>
			<div id="lang">
				<span><a href="#"><img src="{{ URL::asset('img/vi.png') }}" alt="Tiếng Việt"></a></span>
				<span><a href="#"><img src="{{ URL::asset('img/en.png') }}" alt="Tiếng Anh"></a></span>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>