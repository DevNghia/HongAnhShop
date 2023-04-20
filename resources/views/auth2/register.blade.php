<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Đăng nhập</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="{{asset('frontend/css/registerStyle.css')}}" rel="stylesheet">
      <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
	<div class="box-form">
         <form method="POST" action="{{ route('register') }}">
                   @csrf
		<div class="main">
			<div class="overlay">
                <h5>Đăng ký</h5>
                {{-- <div class="other_signup">
                    <p>Đăng ký bằng</p>
                    <div class="icon_osp">
                        <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i> Facebook</a> <br>
                        <a href="#"><i class="fa fa-google" aria-hidden="true"></i> Google</a>
                    </div>
                </div> --}}
            
                <div class="inputs">
                    
                      <!-- Name -->
        <div>
            
            <x-text-input id="name" class="block mt-1 w-full" type="text"  placeholder="Họ và tên" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
                 <!-- Email Address -->
        <div class="mt-4">
            
            <x-text-input id="email" class="block mt-1 w-full" type="email" placeholder="Email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
                   <!-- Password -->
        <div class="mt-4">
     

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            placeholder="Mật khẩu"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
                     <!-- Confirm Password -->
        <div class="mt-4">
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            placeholder="Xác nhận mật khẩu"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>
                </div>
           
                        
                <div class="already-have-account">
                    <a href="/login2">Đã có tài khoản? Đăng nhập</a>
                </div>
                <br>
                <x-primary-button class="ml-4">
                {{ __('Đăng ký') }}
            </x-primary-button>
            </div>
		</div>
          </form>
	</div>
</body>
</html>
