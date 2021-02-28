@extends('layouts.Admin-home2')
@section('title','Danh sách danh mục')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Bảng sản phẩm</h1>
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
                            <h3 class="card-title">Danh sách sản phẩm</h3>
                        </div>

                        <div class="card-body">
                            <table id="myTable" class="table table-bordered ">
                                <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên bài viết</th>
                                    <th>Ảnh danh mục</th>
                                    <th>Slug</th>
                                    <th>Trạng thái</th>
                                    <th>
                                        <a href="{{route('news.add')}}" class="btn btn-success">Tạo mới</a>
                                    </th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($allNews as $k => $row)
                                    <tr>
                                        <td>{{$k+1}}</td>
                                        <td>
                                            {{$row->title}}
                                        </td>
                                        <td><img src="../images/News/{{$row->image}}" alt="" width="150px"
                                                 height="150px"></td>
                                        <td>{{$row->slug}}</td>

                                        <td>
                                            @if($row->status==0)
                                                Đăng
                                            @else
                                                Không đăng
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('news.update',['slug'=>$row->slug])}}"
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
