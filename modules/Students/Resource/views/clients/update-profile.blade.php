@extends('layouts.client')
@section('content')
    @include('parts.client.page_title')
    <section class="all-course py-2">
        <div class="container">
            @if (session('msg'))
                <div class="alert alert-success text-center">{{session('msg')}}</div>
            @endif
            <div class="row">
                <div class="col-3">
                    @include('students::clients.menu')
                </div>
                <div class="col-9 account-page">
                    <h2 class="py-2">Thông tin cá nhân</h2>
                    {{--                    <button class="btn btn-warning my-3 js-profile-btn">Cập nhật thông tin</button>--}}
                    <div class="js-profile profile-item active">
                        <form action="{{route('students.account.update-profile')}}" class="js-profile profile-item" method="POST">
                        @csrf
                        <table class="table table-bordered">
                            <tr>
                                <td width="25%">Tên</td>
                                <td>
                                    <input type="text" name="name" class="form-control {{$errors->has('name') ? ' is-invalid':false}}" placeholder="Tên..." value="{{$student->name ?? old('name')}}">
                                    <span class="error error-name text-danger"></span>
                                    @error('name')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>
                                    <input type="text" name="email" class="form-control {{$errors->has('email') ? ' is-invalid':false}}" placeholder="Email..." value="{{$student->email ?? old('email')}}">
                                    <span class="error error-email text-danger"></span>
                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <td>Mật khẩu</td>
                                <td>
                                    <input type="password" name="password" class="form-control {{$errors->has('password') ? ' is-invalid':false}}" placeholder="Không nhập nếu không muốn đổi" value="">
                                    <span class="error error-email text-danger"></span>
                                    @error('password')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <td>Nhập lại mật khẩu</td>
                                <td>
                                    <input type="password" name="confirm_password" class="form-control {{$errors->has('confirm_password') ? ' is-invalid':false}}" placeholder="Nhập lại mật khẩu cũ" value="">
                                    <span class="error error-email text-danger"></span>
                                    @error('confirm_password')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <td>Điện thoại</td>
                                <td>
                                    <input type="text" name="phone" class="form-control {{$errors->has('phone') ? ' is-invalid':false}}" placeholder="Điện thoại..." value="{{$student->phone ?? old('phone')}}">
                                    <span class="error error-phone text-danger"></span>
                                    @error('phone')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <td>Địa chỉ</td>
                                <td>
                                    <input type="text" name="address" class="form-control" placeholder="Địa chỉ..." value="{{$student->address ?? old('address')}}">
                                    <span class="error error-address text-danger"></span>

                                </td>
                            </tr>
                        </table>
                            <button type="submit" class="js-btn-update btn btn-primary">Cập nhật thông tin</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

