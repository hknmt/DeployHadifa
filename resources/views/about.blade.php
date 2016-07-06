<!DOCTYPE html>
<html lang="vi">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Giới thiệu</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,400,300,600,700&subset=latin,vietnamese' rel='stylesheet' type='text/css'>
</head>
<body>
	<!--Header-->
	<div class="container">
		<div id="logo">
			<a href="#">
				<img src="img/logo.png" alt="Logo" title="logo">
			</a>
		</div>
		<div id="header-right">
			<div id="search-box">
				<form action="#" name="" role="search">
					<input type="text" id="form-search" placeholder="Tìm kiếm">
					<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
					<button type="submit">Tìm kiếm</button>
				</form>
			</div>
			<div class="clear"></div>
			<nav id="navbar">
				<ul>
					<li><a href="#">trang chủ</a></li>
					<li><a href="#">giới thiệu</a></li>
					<li><a href="#">dịch vụ</a></li>
					<li><a href="#">gallery</a></li>
					<li><a href="#">liên hệ</a></li>
				</ul>
			</nav>
			<div id="lang">
				<span><a href="#"><img src="img/vi-flag.jpg"></a></span>
				<span><a href="#"><img src="img/uk-flag.jpg"></a></span>
			</div>
		</div>
	</div>
	<!--Banner-->
	<div class="clear"></div>
	<div class="container">
		<p><img src="img/banner1.png" title="banner1" alt="banner1"></p>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-lg-8">
				<div class="title">
					<div class="block"></div>
					<h4>Giới thiệu</h4>
				</div>
				<div class="clear"></div>
				<div class="box" id="about">
					@foreach ($about as $a)
					<img src="{{ $a->img_url }}" alt="logo">
					<p id="description">{{ $a->description }}</p>
					<div class="clear"></div>
					<div id="content-about">
						{{ $a->content }}
					</div>
					@endforeach
				</div>
				<div class="box" id="value">
					<h4>chúng tôi mang lại cho bạn</h4>
					<div class="row">
						<div class="col-lg-4">
							<div class="img-value">
								<img src="img/good-idea.png" alt="">
							</div>
							<p>Giải pháp</p>
							<h3>tốt nhất</h3>
						</div>
						<div class="col-lg-4">
							<div class="img-value">
								<img src="img/briefcase.png" alt="">
							</div>
							<p>kết quả</p>
							<h3>cao nhất</h3>
						</div>
						<div class="col-lg-4">
							<div class="img-value">
								<img src="img/good.png" alt="">
							</div>
							<p>chất lượng</p>
							<h3>tốt nhất</h3>
						</div>
					</div>
				</div>
				<div class="clear"></div>
			</div>
			<div class="col-lg-4" id="sidebar">
				<h4>Dịch Vụ</h4>
				<ul>
					<li><span class="glyphicon glyphicon-plus"></span>trade fair exhibition</li>
					<li><span class="glyphicon glyphicon-plus"></span>design and contruction</li>
					<li><span class="glyphicon glyphicon-plus"></span>billboard advertising</li>
					<li><span class="glyphicon glyphicon-plus"></span>event managerment</li>
				</ul>
				<h4>trade fair exhibition</h4>
				<p><a href="#"><img src="img/fair.png" alt=""></a></p>
				<p><a href="#"><img src="img/fair.png" alt=""></a></p>
				<p><a href="#"><img src="img/fair.png" alt=""></a></p>
				<p><a href="#"><img src="img/fair.png" alt=""></a></p>
				<p><a href="#"><img src="img/fair.png" alt=""></a></p>
				<p><a href="#"><img src="img/fair.png" alt=""></a></p>
				<p><a href="#"><img src="img/fair.png" alt=""></a></p>
				<p><a href="#"><img src="img/fair.png" alt=""></a></p>
				<p><a href="#"><img src="img/fair.png" alt=""></a></p>
				<p><a href="#"><img src="img/fair.png" alt=""></a></p>
				<div class="clear"></div>
				<h4>trade fair exhibition</h4>
				<p><a href="#"><img src="img/fair.png" alt=""></a></p>
				<p><a href="#"><img src="img/fair.png" alt=""></a></p>
				<p><a href="#"><img src="img/fair.png" alt=""></a></p>
				<p><a href="#"><img src="img/fair.png" alt=""></a></p>
				<p><a href="#"><img src="img/fair.png" alt=""></a></p>
				<p><a href="#"><img src="img/fair.png" alt=""></a></p>
				<p><a href="#"><img src="img/fair.png" alt=""></a></p>
				<p><a href="#"><img src="img/fair.png" alt=""></a></p>
				<p><a href="#"><img src="img/fair.png" alt=""></a></p>
				<p><a href="#"><img src="img/fair.png" alt=""></a></p>
				<div class="clear"></div>
			</div>
		</div>
	</div>
	<script src="js/jquery-1.11.3.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!--footer-->
	<div class="container-fluid" id="footer">
		<div class="container">
			<div class="row">
				<div class="col-lg-4" id="menu">
					<h5>danh mục</h5>
					<ul>
						<li><a href="">trang chủ</a></li>
						<li><a href="">giới thiệu</a></li>
						<li><a href="">sản phẩm</a></li>
						<li><a href="">gallery</a></li>
						<li><a href="">liên hệ</a></li>
					</ul>
				</div>
				<div class="col-lg-4" id="contact">
					<h5>contact</h5>
					<ul>
						<li><img src="img/phone.png" alt="Điện thoại"><p>Tel: (+84.4) 62752588</p></li>
						<li><img src="img/fax.png" alt="Fax"><p>Fax: (+84.4) 62752588</p></li>
						<li><img src="img/email.png" alt="Email"><p>Email: info@hadifa.com</p></li>
						<li><img src="img/home.png" alt="Địa chỉ"><p>Add: Phòng 1001, tầng 10, 71<br>Nguyễn Chí Thanh, Hà Nội, Việt Nam</p></li>
					</ul>
				</div>
				<div class="col-lg-4">
					<h5>liên kết</h5>
					<ul>
						<li><a href="#"><img src="img/facebook.png" alt="Điện thoại"></a></li>
						<li><a href="#"><img src="img/google.png" alt="Điện thoại"></a></li>
						<li><a href="#"><img src="img/twitter.png" alt="Điện thoại"></a></li>
					</ul>
				</div>
			</div>
			<p><span>Hadifa</span> &#169 2015 | All rights reserved</p>
		</div>
	</div>
</body>
</html>