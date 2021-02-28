@extends('layouts.Admin-home2')
@section('title','Danh sách danh mục')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Bảng mã giảm giá</h1>
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
                        </div>
                        <div class="card-body">
                            <table id="myTable" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên mã</th>
                                    <th>Giá tiền</th>
                                    <th>Code</th>
                                    <th>Số lần dùng</th>
                                    <th>Trạng thái</th>
                                    <th>
                                        <a href="{{route('coupon.add')}}" class="btn btn-success">Tạo mới</a>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($coupon as $k => $row)
                                    <tr>
                                        <td>{{$k+1}}</td>
                                        <td>{{$row->name}}</td>
                                        <td>{{number_format($row->price,'0',',','.')}} <sup>VNĐ</sup></td>
                                        <td>{{$row->code}}</td>
                                        <td>{{$row->time}}</td>
                                        <td>
                                            @if($row->status==0)
                                                <a href="{{route('coupon.updateStatus',['id'=>$row->id])}}">Đăng</a>
                                            @else
                                                <a href="{{route('coupon.updateTrue',['id'=>$row->id])}}">Không đăng</a>
                                            @endif
                                        </td>
                                        <td>
                                            <a href=""
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
