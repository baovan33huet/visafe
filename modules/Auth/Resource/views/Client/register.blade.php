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
        <div class="sign-up">
            <h3>Đăng kí</h3>
            <form action="" method="post">
                @csrf
                <input type="text" class="{{$errors->has('name') ? ' is-invalid':false}}" value="{{old('name')}}" name="name" placeholder="Tên" />
                @error('name')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
                <input type="email" class="{{$errors->has('email') ? ' is-invalid':false}}" value="{{old('email')}}" name="email" placeholder="Email" />
                @error('email')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
                <input type="text" class="{{$errors->has('phone') ? ' is-invalid':false}}" value="{{old('phone')}}"  name="phone" placeholder="Số điện thoại" />
                @error('phone')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
                <input type="password" class="{{$errors->has('password') ? ' is-invalid':false}}" name="password" placeholder="Mật khẩu" />
                @error('password')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
                <input type="password" class="{{$errors->has('confirm_password') ? ' is-invalid':false}}" name="confirm_password" placeholder="Lặp lại mật khẩu" />
                @error('confirm_password')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
                <button type="submit">
                    <i class="fa-solid fa-user"></i>
                    Đăng kí
                </button>
            </form>
            <p class="sign-in">
                Bạn đã có tài khoản?
                <a href="{{route('clients.login')}}">Đăng nhập ngay</a>
            </p>
        </div>
    </div>

@endsection
