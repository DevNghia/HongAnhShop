<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Đăng nhập</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="{{asset('frontend/css/registerStyle.css')}}" rel="stylesheet">
</head>
<body>
	<div class="box-form">
		<div class="main">
			<div class="overlay">
                <h5>Đăng ký</h5>
                <div class="other_signup">
                    <p>Đăng ký bằng</p>
                    <div class="icon_osp">
                        <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i> Facebook</a> <br>
                        <a href="#"><i class="fa fa-google" aria-hidden="true"></i> Google</a>
                    </div>
                </div>
                <div class="inputs">
                    
                    <input type="text" placeholder="Họ tên">
                    <br>
                    <input type="text" placeholder="SĐT/ Email">
                    <br>
                    <input type="password" placeholder="Mật khẩu">
                    <br>
                    <input type="text" placeholder="Xác nhận mật khẩu">
                </div>
                
                        
                <div class="already-have-account">
                    <a href="#">Đã có tài khoản? Đăng nhập</a>
                </div>
                <br>
                <button>Đăng ký</button>
            </div>
		</div>
	</div>
</body>
</html>
