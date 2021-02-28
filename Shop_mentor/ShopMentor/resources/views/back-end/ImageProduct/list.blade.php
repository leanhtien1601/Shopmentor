@extends('layouts.Admin-home2')
@section('title','Danh sách danh mục')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Bảng ảnh sản phẩm</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Danh sách ảnh sản phẩm</h3>
                        </div>
                        <div class="card-body">
                            <p>Sản phẩm : {{$nameProduct->name}}</p>
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Ảnh sản phẩm</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($product as $k => $row)
                                    <tr>
                                        <td>{{$k+1}}</td>
                                        <td><img src="../images/ImageProduct/{{$row->image}}" alt="" width="150px"
                                                 height="150px"></td>
                                        <td>
                                            <a href="{{route('imageProduct.edit',['id'=>$row->id])}}"
                                               class="btn btn-danger">Cập nhật</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
