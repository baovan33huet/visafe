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
            <h2>{{$pageTitle}}</h2>
        </div>
    </div>
@endsection
