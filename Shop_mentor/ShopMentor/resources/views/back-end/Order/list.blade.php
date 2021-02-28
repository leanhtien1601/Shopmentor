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
                                    <th>Tên khách hàng</th>
                                    <th>Tên người nhận</th>
                                    <th>Số điện thoại nhận</th>
                                    <th>Thanh toán</th>
                                    <th>Tổng tiền</th>
                                    <th>
                                        Trạng thái
                                    </th>
                                    <th> Ngày đặt</th>
                                    <th>Ghi chú</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($allOrder as $k => $row)
                                    <tr>
                                        <td>{{$k+1}}</td>
                                        <td>{{$row->users->name}}</td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                    data-target="#name_{{$row->id}}">
                                                {{$row->shipping->name}}
                                            </button>
                                        </td>
                                        <td>0{{$row->shipping->phone}}</td>
                                        <td>
                                            @if($row->payment->payment_method==0)
                                                Chuyển khoản
                                            @elseif($row->payment->payment_method==1)
                                                Tiền mặt
                                            @endif
                                        </td>
                                        <td>{{number_format($row->order_total,'0',',','.')}}<sup>đ</sup></td>
                                        <td>
                                            @if($row->status==0)
                                                <a href="{{route('order.statusVery',['id'=>$row->id])}}"> Đang xử lí</a>
                                            @elseif($row->status==2)
                                                <a href="{{route('order.statusFalse',['id'=>$row->id])}}">Đã hoàn
                                                    tất</a>
                                            @elseif($row->status==3)
                                                Huỷ đơn
                                            @endif
                                        </td>
                                        <td> {{date('d - m - Y',strtotime($row->created_at))}}</td>
                                        <td>{{$row->shipping->note}}</td>
                                        <td>
                                            <a href="{{route('order_detail.list',['id'=>$row->id])}}"
                                               class="btn btn-success">Chi tiết</a>
                                            <a href="{{route('invoice',['id'=>$row->id])}}"
                                               class="btn btn-outline-info">Hoá đơn</a>
                                        </td>
                                        <td>
                                            @if($row->status==0)
                                                <a href="{{route('sendMail.index',['id'=>$row->users_id])}}"
                                                   class="btn btn-danger">Gửi Mail</a>
                                            @elseif($row->status==1)
                                                Đã gửi Mail
                                            @endif

                                        </td>

                                    </tr>
                                    <div class="modal fade" id="name_{{$row->id}}" role="dialog">
                                        <div class="modal-dialog">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Địa chỉ khách hàng</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Tỉnh thành phố:
                                                        @foreach($allCity as $city)
                                                            @if($city->matp == $row->shipping->city_id)
                                                                {{$city->name_city}}
                                                            @endif
                                                        @endforeach
                                                    </p>
                                                    <p>Quận huyện:
                                                        @foreach($allDis as $di)
                                                            @if($di->maqh == $row->shipping->district_id)
                                                                {{$di->name_quanhuyen}}
                                                            @endif
                                                        @endforeach
                                                    </p>
                                                    <p>Xã phường:
                                                        @foreach($allWard as $ward)
                                                            @if($ward->xaid == $row->shipping->ward_id)
                                                                {{$ward->name_xaphuong}}
                                                            @endif
                                                        @endforeach
                                                    </p>
                                                    <p>Số nhà :
                                                        {{$row->shipping->address}}
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">
                                                        Close
                                                    </button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
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
