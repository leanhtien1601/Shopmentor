@extends('layouts.Admin-home2')
@section('title','Danh sách danh mục')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Bảng category</h1>
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
                            <h3 class="card-title">Danh sách danh mục</h3>
                        </div>
                        <div class="navbar-search-block mt-3 ml-4">
                            @php
                                if(isset( $_GET['keyword'])){
                                    $dataSearch = $_GET['keyword'];
                                }else{
                                    $dataSearch=null;
                                }
                            @endphp
                        </div>
                        <div class="card-body">
                            <table id="myTable" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên danh mục</th>
                                    <th>Ảnh danh mục</th>
                                    <th>Từ khoá</th>
                                    <th>Slug</th>
                                    <th>Trạng thái</th>
                                    <th>
                                        <a href="{{route('category.add')}}" class="btn btn-success">Tạo mới</a>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($dataCate as $k => $row)
                                    <tr>
                                        <td>{{$k+1}}</td>
                                        <td>{{$row->name}}</td>
                                        <td><img src="../images/category/{{$row->image}}" alt="" width="150px"
                                                 height="150px"></td>
                                        <td>{{$row->meta_keyword}}</td>
                                        <td>{{$row->slug}}</td>
                                        <td>
                                            @if($row->status==0)
                                                <a href="{{route('category.updateStatus',['id'=>$row->id])}}">Đăng</a>
                                            @else
                                                <a href="{{route('category.updateTrue',['id'=>$row->id])}}">Không đăng</a>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('category.update',['id'=>$row->id,'slug'=>$row->slug])}}"
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
