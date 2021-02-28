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
                        <li class="breadcrumb-item active">Form cập nhật sản phẩm</li>
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
                            <h3 class="card-title">Form cập nhật sản phẩm</h3>
                        </div>
                        <form action="" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên sản phẩm</label>
                                    <input type="text" class="form-control"
                                           placeholder="Nhập tên ..." name="name" value="{{$dataPro->name}}">
                                    @error('name')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá tiền</label>
                                    <input type="text" class="form-control"
                                           placeholder="Nhập giá tiền ..." name="price" value="{{$dataPro->price}}">
                                    @error('price')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số lượng</label>
                                    <input type="text" class="form-control"
                                           placeholder="Nhập số lượng ..." name="quantity"
                                           value="{{$dataPro->quantity}}">
                                    @error('price')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">product_sold</label>
                                    <input type="text" class="form-control"
                                           placeholder="Nhập product_sold ..." name="product_sold"
                                           value="{{$dataPro->product_sold}}">
                                    @error('slug')
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
                                    <img src="../images/product/{{$dataPro->image}}" alt="" width="150px" height="150px"
                                         class="mt-3">
                                    @error('image')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Danh mục</label>
                                    <select class="form-control select2" style="width: 100%;" name="category_id">
                                        @foreach($dataCate as $cate)
                                            <option @if($cate->id == $dataPro->category_id ) selected
                                                    @endif  value="{{$cate->id}}">{{$cate->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="radioPrimary1" name="status" value="0"
                                               @if($dataPro->status ==0) checked @endif >
                                        <label for="radioPrimary1">
                                            Đăng
                                        </label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-5">
                                        <input type="radio" id="radioPrimary2" name="status" value="1"
                                               @if($dataPro->status ==1) checked @endif >
                                        <label for="radioPrimary2">
                                            Không đăng
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Thông tin ngắn</label>
                                    <textarea class="form-control " id="content" name="content" rows="4">
                                        {{$dataPro->content}}
                                    </textarea>
                                    @error('detail')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Thông tin </label>
                                    <textarea class="form-control " id="detail" name="detail" rows="4">
                                        {{$dataPro->detail}}
                                    </textarea>
                                    @error('detail')
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
