@extends('layouts.Admin-home2')
@section('title','Cập nhật danh mục')
@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>From</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Form</li>
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
                            <h3 class="card-title">Cập nhật danh mục</h3>
                        </div>
                        <form action="" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên danh mục</label>
                                    <input type="text" class="form-control"
                                           placeholder="Nhập tên ..." name="name" value="{{$dataCate->name}}">
                                    @error('name')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Từ khoá</label>
                                    <input type="text" class="form-control"
                                           placeholder="Nhập tên từ khoá ..." name="meta_keyword" value="{{$dataCate->meta_keyword}}">
                                    @error('meta_keyword')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">File input</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="image">
                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        </div>
                                    </div>
                                    <img src="../images/category/{{$dataCate->image}}" alt="" class="mt-2" width="150px" height="150px">
                                    @error('image')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="radioPrimary1" name="status" value="0"
                                     @if($dataCate->status ==0) checked  @endif   >
                                        <label for="radioPrimary1">
                                            Đăng
                                        </label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-5">
                                        <input type="radio" id="radioPrimary2" name="status" value="1"
                                               @if($dataCate->status ==1) checked  @endif  >
                                        <label for="radioPrimary2">
                                            Không đăng
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Thông tin ngắn</label>
                                    <textarea class="form-control " id="short_des" name="detail" rows="4">
                                        {!! $dataCate->detail !!}
                                    </textarea>
                                    @error('detail')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>

                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Tải lên</button>
                                <a href="{{route('category.list')}}" class="btn btn-dark">Huỷ</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
