@extends('layouts.Admin-main')
@section('title','Giỏ hàng')
@section('content')
    @php

        @endphp
    <section class="breadcrumbs_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content text-center">
                        <h3>Cart</h3>
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
                    <div class="table_desc">
                        <div class="cart_page">
                            @php
                                $content = Cart::content();
                            @endphp
                            <table style="width:100%" class="text-center pd_10">
                                <thead>
                                <tr class="cl_green">
                                    <th>Delete</th>
                                    <th>Ảnh sản phẩm</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Giá tiền</th>
                                    <th>Số lượng</th>
                                    <th>Tổng tiền</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $tongTien = 0;
                                @endphp
                                @foreach($content as $row)
                                    @php
                                        $subtotal = $row->price*$row->qty;
                                        $tongTien+=$subtotal;
                                    @endphp
                                    <tr>
                                        <td>
                                            <a href="{{route('cart.delete',['id'=>$row->rowId])}}" onclick="return confirm('Bạn muốn xóa chứ')">
                                                <i class="fa fa-trash-o"></i>
                                            </a>
                                        </td>
                                        <td class="pd_10 image_cart">
                                            <img src="images/product/{{$row->options->image}}" alt="">
                                        </td>
                                        <td>{{$row->name}}</td>
                                        <td>{{number_format($row->price,0,",",".")}} <sup>đ</sup></td>
                                        <td>
                                            <form action="{{route('cart.update')}}" method="POST">
                                                {{ csrf_field() }}

                                                <label for="">Số lượng</label>
                                                <input type="hidden" name="rowId_cart" value="{{$row->rowId}}">
                                                <input type="number" min=1 max=100 value="{{$row->qty}}"
                                                       name="quantity">
                                                <button type="submit" name="update_qty" class="btn btn-success">
                                                    Cập nhật
                                                </button>
                                            </form>
                                        </td>
                                        <td>
                                            <?php
                                            echo number_format($subtotal) . ' ' . 'vnđ';
                                            ?>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="cart_submit">
                            <form action="{{route('cart.huy')}}" method="post">
                                @csrf
                                <button type="submit">Huỷ giỏ hàng</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <form class="mb-4">
                @csrf
                <div class="">
                    <div class="form-group">
                        <label>Tỉnh thành phố</label>
                        <select class="form-control select2 choose city" style="width: 100%;" name="city"
                                id="city">
                            <option value="">-- Chọn tỉnh thành phố --</option>
                            @foreach($allCity as $city)
                                <option value="{{$city->matp}}">{{$city->name_city}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Quận huyện</label>
                        <select class="form-control select2 choose district" style="width: 100%;"
                                name="district"
                                id="district">

                            <option value="">-- Chọn quận huyện --</option>

                        </select>
                    </div>
                    <div class="form-group">
                        <label>Xã phường</label>
                        <select class="form-control select2  ward" style="width: 100%;" name="ward"
                                id="ward">

                            <option value="">-- Chọn xã phường --</option>

                        </select>
                    </div>

                </div>
                <div class="">
                    <button type="button" class="btn btn btn-outline-success add-insert">Tính phí ship</button>
                </div>
            </form>

            <div class="coupon_area">
                <div class="row">
                    <div class="col-xl-6 col-12">
                        @if(session('message'))
                            <session class="alert alert-success">{{session('message')}}</session>
                        @endif
                        <div class="coupon_code left">
                            <h3>Code</h3>
                            <div class="coupon_inner">
                                <p>Chỉ áp dụng 1 mã duy nhất và sử dụng 1 lần.</p>
                                <form action="{{route('checkCode')}}" method="post">
                                    @csrf
                                    <input type="text" placeholder="Nhập mã" name="code">
                                    @if(session('price_coupon'))

                                    @else
                                        <button type="submit">Áp dụng</button>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-12">
                        <div class="coupon_code left">
                            <h3>Cart Totals</h3>
                            <div class="coupon_inner">
                                <div class="cart_subtotal">
                                    <p>Tổng</p>

                                    <p class="cart_amount">{{Cart::subtotal(0)}}<sup>đ</sup></p>
                                </div>
                                <div class="cart_subtotal">
                                    <p>Ship</p>
                                    <p class="cart_amount">
                                        @if(session('fee'))
                                            {{number_format(session('fee'),'0',',','.')}}<sup>đ</sup>
                                        @endif</p>
                                </div>
                                <div class="cart_subtotal">
                                    <p>Tiền sau khi giảm</p>
                                    @if(session('price_coupon')&&session('fee'))
                                        @php
                                            session_start();
                                                $priceCode = session('price_coupon');
                                                $price = session('fee');
                                                $sale =$tongTien + $price - $priceCode;
                                                $_SESSION['priceSale'] = $sale;
                                                 $_SESSION['price_ship'] = $price;
                                                 $_SESSION['code'] = session('code');
                                        @endphp
                                        <p class="cart_amount">{{number_format($sale,0,",",",")}}<sup>đ</sup></p>
                                    @elseif(session('fee'))
                                        @php
                                            session_start();
                                                $price = session('fee');
                                                $sale=0;
                                                $tongtien = $tongTien+$price;
                                                $_SESSION['priceSale'] = $tongtien;
                                                $_SESSION['price_ship'] = $price;
                                                 $_SESSION['code'] = session('code');
                                        @endphp
                                        <p class="cart_amount">{{number_format($tongtien,0,",",",")}}<sup>đ</sup></p>
                                    @else
                                        @php
                                            $price =0;
                                        @endphp
                                    @endif

                                </div>
                                @if(session('fee_matp') && session('fee_maqh') && session('fee_xaid'))
                                    @php

                                        $_SESSION['fee_matp'] = session('fee_matp');
                                        $_SESSION['fee_maqh'] = session('fee_maqh');
                                        $_SESSION['fee_xaid'] = session('fee_xaid');
                                    @endphp
                                @endif
                                @if(Auth::check())
                                    <div class="checkout_btn text-right">
                                        @if(Cart::subtotal(0)==0 )
                                            <p>Bạn cần có sản phẩm thanh toán</p>
                                        @elseif($price!=0)
                                            <a href="{{route('checkout.add')}}">Thanh toán</a>
                                        @else
                                            <p>Bạn cần tính tiền ship</p>
                                        @endif
                                    </div>
                                @else
                                    <div class="checkout_btn text-right">
                                        <a href="{{route('users.login')}}">Đăng nhập để thanh toán</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
@section('script_view')
    <script type="text/javascript">

        $(document).ready(function () {
            $('.choose').on('change', function () {
                var action = $(this).attr('id');
                var matp = $(this).val();
                var _token = $('input[name="_token"]').val();
                var result = "";
                if (action == 'city') {
                    result = 'district';
                } else {
                    result = 'ward';
                }
                $.ajax({
                    url: '{{route('checkout.select')}}',
                    method: 'POST',
                    data: {
                        action: action,
                        _token: _token,
                        matp: matp
                    },
                    success: function (data) {
                        $('#' + result).html(data);
                    }
                })
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.add-insert').click(function () {
                var matp = $('.city').val();
                var maqh = $('.district').val();
                var xaid = $('.ward').val();
                var _token = $('input[name="_token"]').val();
                if (matp == '' && maqh == '' && xaid == '') {
                    alert('Chọn địa điểm đi bạn');
                } else {
                    $.ajax({
                        url: '{{route('checkout.count_fee')}}',
                        method: 'POST',
                        data: {
                            matp: matp,
                            maqh: maqh,
                            xaid: xaid,
                            _token: _token
                        },
                        success: function () {
                            location.reload();
                        }
                    });
                }

            });
        });
    </script>
@endsection
