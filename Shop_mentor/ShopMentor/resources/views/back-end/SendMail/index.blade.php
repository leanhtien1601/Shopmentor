@extends('layouts.Admin-home2')
@section('title','Gửi mail cho khách hàng')
@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>General Form</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">General Form</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Form gửi Mail</h3>
                        </div>
                        <form action="{{route('sendMail')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên khách hàng</label>
                                    <input type="text" class="form-control" disabled
                                           value="{{$allUser->name}}">
                                    <input type="hidden"
                                           name="name" value="{{$allUser->name}}">
                                    <input type="hidden" name="users_id" value="{{$allUser->id}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số điện thoại</label>
                                    <input type="text" class="form-control" disabled
                                           value="0{{$allUser->phone}}">
                                    <input type="hidden" class="form-control"
                                           name="phone" value="0{{$allUser->phone}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="text" class="form-control" disabled
                                           value="{{$allUser->email}}">
                                    <input type="hidden" class="form-control"
                                           name="email" value="{{$allUser->email}}">

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ảnh or hoá đơn</label>
                                    <input type="file" class="form-control"
                                           placeholder="Nhập tên ..." name="image">
                                    @error('image')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>


                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Tải lên</button>
                                    <button class="btn btn-primary">Huỷ</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
