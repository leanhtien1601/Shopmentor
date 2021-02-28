@extends('layouts.login-home')
@section('title','Đăng kí')
@section('content')
    <div class="d-lg-flex half">
        <div class="bg order-1 order-md-2" style="background-image: url('{{asset('theme/login/images/bg_1.jpg')}}');"></div>
        <div class="contents order-2 order-md-1">

            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-7">
                        <h3>Đăng kí</h3>
                        <p class="mb-4">Chào mừng bạn đã đến với website của chúng tôi.</p>
                        <form action="{{route('users.registration')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group first">
                                <label for="username">Tên của bạn</label>
                                <input type="text" class="form-control" placeholder="Mời bạn nhập tên"  name="name">
                                @error('name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group first">
                                <label for="username">Tên đăng nhập</label>
                                <input type="text" class="form-control" placeholder="Mời bạn nhập tên đăng nhập"  name="username">
                                @error('username')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group last mb-3">
                                <label for="password">Mật khẩu</label>
                                <input type="password" class="form-control" placeholder="Mật khẩu ..."  name="password">
                                @error('password')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group first">
                                <label for="username">Email</label>
                                <input type="email" class="form-control" placeholder="Mời bạn nhập tên đăng nhập"  name="email">
                                @error('email')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group first">
                                <label for="username">Số điện thoại</label>
                                <input type="text" class="form-control" placeholder="Mời bạn nhập tên đăng nhập"  name="phone">
                                @error('phone')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group first">
                                <label for="username">Ảnh của bạn</label>
                                <input type="file" class="form-control"  name="avatar">
                                @error('avatar')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="d-flex mb-5 align-items-center">
                                <span class="ml-auto"><a href="#" class="forgot-pass">Quên mật khẩu</a></span>
                            </div>

                            <input type="submit" value="Đăng kí" class="btn btn-block btn-primary">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
