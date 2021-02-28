@extends('layouts.login-home')
@section('title','ĐỔi mật khẩu')
@section('content')
    <div class="d-lg-flex half">
        <div class="bg order-1 order-md-2" style="background-image: url('{{asset('theme/login/images/bg_1.jpg')}}');"></div>
        <div class="contents order-2 order-md-1">

            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-7">
                        <h3>Đổi mật khẩu</h3>
                        <p class="mb-4">Chào mừng bạn đã đến với website của chúng tôi.</p>
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-block">
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif
                        @if ($mess = Session::get('eror'))
                            <div class="alert alert-danger alert-block">
                                <strong>{{ $mess }}</strong>
                            </div>
                        @endif
                        <form  method="post" action="">
                            @csrf
                            <div class="form-group first">
                                <label for="username">Username</label>
                                <input type="text" name="username"  placeholder="Tên đăng nhập" class="form-control">
                                @error('username')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group last mb-3">
                                <label for="password">Password</label>
                                <input type="password" name="password"  placeholder="Nhập lại mạt khẩu" class="form-control">
                                @error('password')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group first">
                                <label for="username">Mật khẩu mới</label>
                                <input type="password" name="password_new"  placeholder="Mật khẩu mới" class="form-control">
                                @error('password_new')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group first">
                                <label for="username">Email</label>
                                <input type="email" name="email" placeholder="Nhập email" class="form-control">
                                @error('email')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <input type="submit" value="Xác nhận đổi" class="btn btn-block btn-primary">
                            <span>
                        </span>
                        </form>
                        <br>
                        <a href="{{route('Home')}}" class="mt-3">Trang chủ</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
