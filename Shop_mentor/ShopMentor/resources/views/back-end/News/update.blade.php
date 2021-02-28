@extends('layouts.Admin-home2')
@section('title','Cập nhật sản phẩm')
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
                        <li class="breadcrumb-item active">Form cập nhật bài viết</li>
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
                            <h3 class="card-title">Form cập nhật bài viết</h3>
                        </div>
                        <form action="" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên bài viết</label>
                                    <input type="text" class="form-control"
                                           placeholder="Nhập tên ..." name="title" value="{{$new->title}}">
                                    @error('title')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">File ảnh</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="image">
                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        </div>
                                    </div>
                                    <img src="../images/News/{{$new->image}}" alt="" width="150px" height="150px"
                                         class="mt-3">
                                    @error('image')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="radioPrimary1" name="status" value="0"
                                               @if($new->status ==0) checked @endif >
                                        <label for="radioPrimary1">
                                            Đăng
                                        </label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-5">
                                        <input type="radio" id="radioPrimary2" name="status" value="1"
                                               @if($new->status ==1) checked @endif >
                                        <label for="radioPrimary2">
                                            Không đăng
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Thông tin ngắn</label>
                                    <textarea class="form-control " id="content" name="short_des" rows="4">
                                        {{$new->short_des}}
                                    </textarea>
                                    @error('short_des')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Thông tin </label>
                                    <textarea class="form-control " id="detail" name="content" rows="4">
                                        {{$new->content}}
                                    </textarea>
                                    @error('content')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
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
