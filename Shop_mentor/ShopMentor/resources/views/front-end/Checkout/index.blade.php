@extends('layouts.Admin-main')
@section('title','Giỏ hàng')
@section('content')
    @php
        session_start();
    @endphp
    <section class="breadcrumbs_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content text-center">
                        <h3>Payment</h3>
                        <ul>
                            <li>
                                Home
                            </li>
                            <li>/</li>
                            <li>Shopping Cart</li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <section class="shopping_cart_area ">
        <div class="container">

            <div class="row">
                <div class="col-12">
                    <br>
                    <h2 class="mt-2">Thông tin nhận hàng</h2>

                    <form action="{{route('checkout.add')}}" method="post">
                        @csrf
                        <div class="mb-3 mt-5">
                            <label for="exampleInputEmail1" class="form-label">Tên người nhận</label>
                            <input type="text" class="form-control" id="exampleInputEmail1"
                                   aria-describedby="emailHelp" name="name">
                            @error('name')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        @if($_SESSION['priceSale'])
                            <input type="hidden" name="priceSale" value="{{$_SESSION['priceSale']}}">
                        @endif
                        @if($_SESSION['code'])
                            <input type="hidden" name="code" value="{{$_SESSION['code']}}">
                        @endif
                        @if($_SESSION['price_ship'])
                            <input type="hidden" name="price_ship" value="{{$_SESSION['price_ship']}}">
                        @endif
                        @if($_SESSION['fee_matp'] && $_SESSION['fee_maqh'] && $_SESSION['fee_xaid'])
                            <input type="hidden" name="fee_matp" value="{{$_SESSION['fee_matp']}}">
                            <input type="hidden" name="fee_maqh" value="{{$_SESSION['fee_maqh']}}">
                            <input type="hidden" name="fee_xaid" value="{{$_SESSION['fee_xaid']}}">
                        @endif
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Số điện thoại</label>
                            <input type="text" class="form-control" id="exampleInputPassword1" name="phone">
                            @error('phone')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Địa chỉ</label>
                            <input type="text" class="form-control" id="exampleInputPassword1" name="address">
                            @error('address')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <textarea class="form-control" placeholder="Ghi chú đơn hàng" id="floatingTextarea2"
                                      style="height: 100px" name="note"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Chọn phương thức thanh toán</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment_method" id="flexRadioDefault1"
                                   value="0">
                            <label class="form-check-label" for="flexRadioDefault1">
                                Chuyển khoản
                            </label>
                        </div>
                        <div class="form-check mt-2">
                            <input class="form-check-input" type="radio" name="payment_method" id="flexRadioDefault2"
                                   checked value="1">
                            <label class="form-check-label" for="flexRadioDefault2">
                                Trả tiền khi nhận hàng
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Gửi</button>
                    </form>
                    <br>

                </div>
            </div>
        </div>
    </section>
@endsection

