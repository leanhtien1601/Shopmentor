@extends('layouts.login-home')
@section('title','Đăng nhập')
@section('content')
    <div class="d-lg-flex half">
        <div class="bg order-1 order-md-2" style="background-image: url('{{asset('theme/login/images/bg_1.jpg')}}');"></div>
        <div class="contents order-2 order-md-1">

            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-7">
                        <h3>Quên mật khẩu</h3>
                        <p class="mb-4">Chào mừng bạn đã đến với website của chúng tôi.</p>
                        @if(session('message'))
                            <section class="alert alert-success">{{session('message')}}</section>
                        @endif
                        @if(session('passnew'))
                            <section class="alert-danger">{{session('passnew')}}</section>
                        @endif

                        <form class="form_full" method="post" action="{{route('recover.pass')}}">
                            @csrf
                            <p>Điền email để lấy lại mật khẩu</p>
                            <input type="email" name="email_acount" aria-required="true" aria-invalid="false" placeholder="Nhập email ..." class="name form-control">
                            @if(session('erorMail'))
                                <section class="alert alert-danger">{{session('erorMail')}}</section>
                            @endif
                            <input type="submit" value="Đăng nhập" class="btn btn-block btn-primary mt-4">
                            <span>
                                <br>
                            <a class="btn-green" title="Đăng ký" href="{{route('users.registration')}}">Đăng ký</a> nếu chưa có tài khoản !
                        </span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
