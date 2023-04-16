<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Đăng nhập</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="{{asset('frontend/css/loginStyle.css')}}" rel="stylesheet">
</head>
<body>
	<div class="box-form">
		<div class="left">
			<div class="overlay">
			<h1>Your satisfaction,<br>my happiness</h1>
			<p>Sự hài lòng của bạn là niềm hạnh phúc của chúng tôi</p>
			<span>
				<p>Đăng nhập bằng</p>
				<a href="#"><i class="fa fa-facebook" aria-hidden="true"></i> Facebook</a> <br>
				<a href="#"><i class="fa fa-google" aria-hidden="true"></i> Google</a>
			</span>
			</div>
		</div>

		<div class="right">
			<h5>Đăng nhập</h5>
			<p>Bạn không có tài khoản? <a href="#">Tạo tài khoản</a> nhanh chóng, đơn giản.</p>
			<div class="inputs">
				<input type="text" placeholder="Tên người dùng/ Sdt/ Email">
				<br>
				<input type="password" placeholder="Mật khẩu">
			</div>
			
			<br><br>
					
			<div class="remember-me--forget-password">
				<label>
					<input type="checkbox" name="item" checked/>
					<span class="text-checkbox"></span>
					<span class="ghinho">Ghi nhớ</span>
				</label>
				<a href="#">Quên mật khẩu?</a>
			</div>
			<br>
			<button>Đăng nhập</button>
		</div>
		
	</div>
</body>
</html>
