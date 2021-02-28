@extends('layouts.login-home')
@section('title','Thông tin tài khoản')
@section('content')
    <div class="d-lg-flex half">
        <div class="bg order-1 order-md-2" style="background-image: url('{{asset('theme/login/images/bg_1.jpg')}}');"></div>
        <div class="contents order-2 order-md-1">

            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-7">
                        <h3>Tuỳ chọn  tài khoản của bạn</h3>
                        @if(Auth::check())
                        <p class="mb-4">Chào mừng bạn
                            {{Auth::user()->name}}
                            đã đến với website của chúng tôi.</p>

                            <div class="mt-5">
                                <a href="{{route('users.changepass',['id'=>Auth::user()->id])}}" style="text-decoration: none">Đổi mật khẩu</a>
                                <br>
                                <br>
                                <a href="{{route('users.changeUser',['id'=>Auth::user()->id])}}" style="text-decoration: none">Thay đổi thông tin</a>
                            </div>
                        @else
                            Bạn cần đăng nhập
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
