@extends('layouts.login-home')
@section('title','Đăng nhập')
@section('content')
    <div class="d-lg-flex half">
        <div class="bg order-1 order-md-2" style="background-image: url('{{asset('theme/login/images/bg_1.jpg')}}');"></div>
        <div class="contents order-2 order-md-1">

            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-7">
                        <h3>Lấy lại mật khẩu</h3>
                        <p class="mb-4">Chào mừng bạn đã đến với website của chúng tôi.</p>
                        @if(session('message'))
                            <section class="alert alert-success">{{session('message')}}</section>
                        @endif
                        @php
                            $token = $_GET['token'];
                            $email = $_GET['email'];
                        @endphp
                        <form class="form_full" method="post" action="{{route('resetPass')}}">
                            @csrf
                            <input type="hidden" value="{{$token}}" name="token">
                            <input type="hidden" value="{{$email}}" name="email_acount">
                            <input type="password" name="pass_new" placeholder="Nhập password mới" class="name form-control">
                            <input type="submit" value="Đăng nhập" class="btn btn-block btn-primary mt-4">
                            <span>
                            <a class="btn-green" title="Đăng ký" href="{{route('users.registration')}}">Đăng ký</a> nếu chưa có tài khoản !
                        </span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
