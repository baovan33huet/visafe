@extends('layouts.client')
@section('content')
    @include('parts.client.page_title')
    <section class="all-course py-2">
        <div class="container">
            <div class="row">
                <div class="col-3">
                    @include('students::clients.menu')
                </div>
                <div class="col-9 account-page">
                    <h2 class="py-2">Thông tin cá nhân</h2>
{{--                    <button class="btn btn-warning my-3 js-profile-btn">Cập nhật thông tin</button>--}}
                    <div class="js-profile profile-item active">
                        <table class="table table-bordered ">
                            <tr>
                                <td width="25%">Tên</td>
                                <td>
                                    {{$student->name}}
                                </td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>
                                    {{$student->email}}
                                </td>
                            </tr>
                            <tr>
                                <td>Điện thoại</td>
                                <td>
                                    {{$student->phone ?? "Chưa cập nhật"}}
                                </td>
                            </tr>
                            <tr>
                                <td>Địa chỉ</td>
                                <td>
                                    {{$student->address ?? "Chưa cập nhật"}}
                                </td>
                            </tr>
                            <tr>
                                <td>Trạng thái</td>
                                <td>
                                     {{$student->status == 1 ? 'Đang hoạt động' : 'Bị khoá' }}
                                </td>
                            </tr>
                            <tr>
                                <td>Thời gian đăng ký</td>
                                <td>
                                    {{Carbon\Carbon::parse($student->created_at)->format('d/m/Y H:i:s')}}
                                </td>
                            </tr>
                            <tr>
                                <td>Thời gian kích hoạt</td>
                                <td>
                                    {{Carbon\Carbon::parse($student->email_verified_at)->format('d/m/Y H:i:s')}}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script src="{{asset('clients/js/test.js')}}"></script>

@endsection
