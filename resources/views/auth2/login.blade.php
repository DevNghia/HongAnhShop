<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Đăng nhập</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="{{asset('frontend/css/loginStyle.css')}}" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
	  <form method="POST" action="{{ route('login') }}">
        @csrf
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
			<p>Bạn không có tài khoản? <a href="/register2">Tạo tài khoản</a> nhanh chóng, đơn giản.</p>
			<div class="inputs">

				{{-- <input type="text" placeholder="Tên người dùng/ Sdt/ Email"> --}}
				<x-input-label for="email" :value="__('Email')" />
				  <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
				  <x-input-error :messages="$errors->get('email')" class="mt-2" />
				<br>
				{{-- <input type="password" placeholder="Mật khẩu"> --}}
				<x-input-label for="password" :value="__('Password')" />
				 <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
{{-- >>>>>>> nghia --}}
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
				   <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ml-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
		</div>
		
	</div>
	   </form>
{{-- >>>>>>> nghia --}}
</body>
</html>
