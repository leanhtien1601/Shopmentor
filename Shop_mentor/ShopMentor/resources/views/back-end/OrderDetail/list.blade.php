@extends('layouts.Admin-home2')
@section('title','Danh sách danh mục')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Bảng đơn hàng</h1>
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
                            <h3 class="card-title">Danh sách đơn đặt</h3>
                        </div>

                        <div class="card-body">
                            <table id="myTable" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Giá tiền</th>
                                    <th>Số lượng</th>
                                    <th>Mã giảm giá</th>
                                    <th>Phí ship</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($allOrder as $k => $row)
                                        <tr>
                                            <td>{{$k+1}}</td>
                                            <td>{{$row->product_name}}</td>
                                            <td> {{number_format($row->product_price,'0',',','.')}} <sup>đ</sup></td>
                                            <td>{{$row->product_quantity}}</td>
                                            <td>{{$row->product_code}}</td>
                                            <td>{{number_format($row->price_ship,'0',',','.')}}<sup>đ</sup></td>
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
