@extends('layouts.Admin-home2')
@section('title','Xác nhận hóa đơn')
@section('content')
    <div class="content-wrapper">
        <div class="container container-smaller">
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1" style="margin-top:20px; text-align: right">
                    <div class="btn-group mb-4">
                        <a href="{{route('invoice.print',['id'=>$id])}}" class="btn btn-success">Save as
                            PDF</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1">
                    <div class="invoice" style="padding: 20px">
                        <div class="row">
                            <div class="col-sm-6">
                                <h4>From:</h4>
                                <address>
                                    <strong>Shop Mentor</strong><br>
                                    Thái Bình - Hà Nội<br>
                                    P: (012) 345 - 6789<br>
                                    E: shopmentor@gmail.com
                                </address>
                            </div>

                            <div class="col-sm-6 text-right">
                                <img
                                    src="{{asset('theme/frontend/images/logo.png')}}"
                                    alt="logo">
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-sm-7">
                                <h4>To:</h4>
                                <address>

                                </address>
                            </div>

                            <div class="col-sm-5 text-right">
                                <table class="w-full">
                                    <tbody>
                                    <tr>
                                        <th>Số hóa đơn:</th>
                                        <td>{{$id}}</td>
                                    </tr>
                                    <tr>
                                        <th>Ngày tạo hóa đơn:</th>
                                        <td></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="table-responsive mt-3">
                            <table class="table invoice-table">
                                <thead style="background: #F5F5F5;">
                                <tr>
                                    <th>Tên sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Mã giảm giá</th>
                                    <th>Giá tiền</th>
                                    <th>Phí ship</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($allOrder as $order)
                                    <tr>
                                        <td>{{$order->product_name}}</td>
                                        <td>{{$order->product_quantity}}</td>
                                        <td>
                                            @if($order->product_code==null)
                                                0
                                            @else
                                                {{$order->product_code}}
                                            @endif
                                        </td>
                                        <td>{{number_format($order->product_price,'0',',','.')}}<sup>đ</sup></td>
                                        <td>{{number_format($order->price_ship,'0',',','.')}}<sup>đ</sup></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <table class="table invoice-total">
                            <tbody>

                            <tr>
                                <td class="text-right"><strong>Tổng tiền : </strong>{{number_format($product->order_total,'0',',','.')}}<sup>đ</sup></td>
                            </tr>
                            </tbody>
                        </table>

                        <hr>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="invbody-terms">
                                    Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi!<br>
                                    <br>
                                    <h4 style="margin-left:50px">Khách hàng</h4>
                                    <p style="margin-left:50px">(Ký, họ tên)</p>
                                </div>
                            </div>
                            <div class="col-lg-6" style="text-align: right;padding-top: 30px">
                                <h4 style="margin-right: 50px">Người xác nhận</h4>
                                <p style="margin-right: 100px">Tiến</p>
                                <img src="../../public/assets/images/dau.png" style="width: 200px;margin-right: 20px"
                                     alt="">
                                <p style="margin-right: 70px">Lê Anh Tiến</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
