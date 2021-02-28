@extends('layouts.login-home')
@section('title','Đăng nhập')
@section('content')
<div class="d-lg-flex half">
    <div class="bg order-1 order-md-2" style="background-image: url('{{asset('theme/login/images/bg_1.jpg')}}');"></div>
    <div class="contents order-2 order-md-1">

        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-7">
                    <h3>Đăng nhập</h3>
                    <p class="mb-4">Chào mừng bạn đã đến với website của chúng tôi.</p>
                    @if ($message = Session::get('error'))
                        <div class="alert alert-danger alert-block">
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    <form action="{{route('users.login')}}" method="post">
                        @csrf
                        <div class="form-group first">
                            <label for="username">Tên đăng nhập</label>
                            <input type="text" class="form-control" placeholder="Mời bạn nhập tên đăng nhập" id="username" name="username">
                            @error('username')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group last mb-3">
                            <label for="password">Mật khẩu</label>
                            <input type="password" class="form-control" placeholder="Mật khẩu ..." id="password" name="password">
                            @error('password')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="d-flex mb-5 align-items-center">
                            <span class="mr-auto"><a href="{{route('Home')}}" class="forgot-pass">Quay lại Home</a></span>
                            <span class="ml-auto"><a href="{{route('forget.pass')}}" class="forgot-pass">Quên mật khẩu</a></span>
                        </div>
                        <input type="submit" value="Đăng nhập" class="btn btn-block btn-primary">
                        <div class="d-flex mb-5 align-items-center">
                            <span class="mr-auto"><a href="{{route('facebook')}}" class="forgot-pass">
                                    <img src="{{asset('images/setting/fb.png')}}" alt="" style="width: 30px;height: 30px">
                                </a></span>
                            <span class="ml-auto"><a href="#" class="forgot-pass">
                                    <img src="{{asset(('images/setting/gg.png'))}}" alt="" style="width: 70px;height: 50px">
                                </a></span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
