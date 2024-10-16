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
            @if (session('msg'))
                <div class="alert alert-success">{{session('msg')}}</div>
            @endif
            <h2>{{$pageTitle}}</h2>
            <h3>Kiểm tra email để kích hoạt</h3>
            <form action="{{route('verification.send')}}" method="post">
                @csrf

                    <button type="submit" class="btn btn-primary">Gửi lại email</button>

            </form>
        </div>
    </div>
@endsection
