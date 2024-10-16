@extends('layouts.auth_client')
@section('content')
<div class="container">

    <div class="home-back">
        <a href="{{route('home.index')}}">
					<span>
						<i class="fa-solid fa-arrow-left"></i>
					</span>
            Về trang chủ
        </a>
    </div>
    <div class="sign-in">
        <h3>Đăng nhập</h3>
        @if (session('msg'))
            <div class="alert alert-danger">{{session('msg')}}</div>
        @endif
        <form action="" method="POST">
            @csrf
            <input type="text" name="email" class="{{$errors->has('email') ? ' is-invalid':false}}" value="{{old('email')}}" placeholder="Email/Username" style="{{$errors->has('email') ? 'margin-bottom:0;' : ''}}" />
            @error('email')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
            <input type="password" name="password" class="{{$errors->has('password') ? ' is-invalid':false}}" value="{{old('password')}}" placeholder="Mật khẩu" style="{{$errors->has('password') ? 'margin-bottom:0;' : ''}}"/>
            @error('password')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
            <div class="checker">
                <input type="checkbox" name="remember" value="1" />
                <span>Tự động đăng nhập</span>
            </div>
            <p class="forgot-password">Quên mật khẩu đăng nhập</p>
            <button type="submit">Đăng nhập</button>
        </form>
        <p class="sign-up">
            Bạn chưa có tài khoản?
            <a href="{{route('clients.register')}}">Đăng kí ngay</a>
        </p>
    </div>
</div>
@endsection
