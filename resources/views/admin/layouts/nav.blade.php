<div class="controll">
	<div class="logo">
		<img src="{{ URL::asset('img/logo.png') }}" alt="Trang chủ" class="img-responsive">
	</div>
	<a href="{{ route('home') }}" class="btn btn-primary btn-block" title="Home">
		<span class="glyphicon glyphicon-home" style="margin-right: 20px"></span>Trang chủ
	</a>
	<a href="{{ route('admin.logout') }}" class="btn btn-danger btn-block" title="Logout">
		<span class="glyphicon glyphicon-log-out" style="margin-right: 20px"></span>Đăng xuất
	</a>
	<div class="row">
		<ul>
			<li id="dasboard">
				<a href="" title="Dashboard">
					<span class="glyphicon glyphicon-dashboard"></span>
					Dashboard
				</a>
			</li>
			<li id="service">
				<a href="#" title="Dịch vụ">
					<span class="glyphicon glyphicon-dashboard"></span>
					Dịch vụ
				</a>
				<div class="children">
					<ul>
						<li id="tfe"><a href="{{ route('admin.service.tfe') }}">Trade Fair Exbihition</a></li>
					@foreach($nav['service'] as $value)
						<li id="category{{ $value['id'] }}"><a href="{{ route('admin.service.index',$value['id']) }}">{{ $value['name'] }}</a></li>
					@endforeach
					</ul>
				</div>
			</li>
			<li id="support">
				<a href="{{ route('admin.support') }}" title="Yêu cầu">
					<span class="glyphicon glyphicon-comment"></span>
					Yêu cầu
				</a>
				<span class="badge pull-right">{{ ($nav['customer'] == 0) ? '' : $nav['customer'] }}</span>
			</li>
			<li id="register">
				<a href="{{ route('admin.register.index') }}" title="Đăng ký">
					<span class="glyphicon glyphicon-comment"></span>
					Đăng ký
				</a>
				<span class="badge pull-right">{{ ($nav['register'] == 0) ? '' : $nav['register'] }}</span>
			</li>
			<li id="banner">
				<a href="#" title="Bannner">
					<span class="glyphicon glyphicon-picture"></span>
					Banner
				</a>
			</li>
			<li id="partner">
				<a href="{{ route('admin.partner.index') }}">
					<span class="glyphicon glyphicon-link"></span>Đối tác
				</a>
			</li>		
		</ul>
	</div>
</div>

<script>
	@if(isset($active[1]))
	var serviceActive = "#{{ $active[1] }}";
	$(document).ready(function(){
		$(serviceActive).attr("class", "active_nav");
	});
	@endif

	@if(isset($active[2]))
	var categoryActive = "#{{ $active[2] }}";
	if(categoryActive != "#tfe")
		categoryActive = "#category" + categoryActive.slice(7);
	$(document).ready(function(){
		$(categoryActive).css({"background": "#202c46", "border-left": "7px solid #f26101"});
	});
	@endif

</script>

