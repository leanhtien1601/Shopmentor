@extends('layouts.Admin-main')
@section('title','Yêu thích')
@section('content')
    <section class="breadcrumbs_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content text-center">
                        <h3>Yêu thích</h3>
                        <ul>
                            <li>
                                Home
                            </li>
                            <li>/</li>
                            <li>Danh sách yêu thích</li>
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
                            <table style="width:100%" class="text-center pd_10">
                                <thead>
                                <tr class="cl_green">
                                    <th>Delete</th>
                                    <th>Ảnh sản phẩm</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Giá tiền</th>
                                    <th>Số lượng</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(Auth::check())
                                    @foreach($allWish as $row)
                                        @if(Auth::user()->id == $row->users_id)
                                            <tr>
                                                <td>
                                                    <a href="{{route('wishlist.delete',['id'=>$row->id])}}" onclick="return confirm('Bạn muốn xóa chứ')">
                                                        <i class="fa fa-trash-o"></i>
                                                    </a>
                                                </td>
                                                <td class="pd_10 image_cart">
                                                    <img src="images/product/{{$row->product->image}}" alt="">
                                                </td>
                                                <td>
                                                    <a href="{{route('detail.product',['id'=>$row->product->id,'slug'=>$row->product->slug])}}">
                                                        {{$row->product->name}}
                                                    </a>

                                                </td>
                                                <td>{{number_format($row->product->price,0,",",".")}} <sup>đ</sup></td>
                                                <td>
                                                    {{$row->quantity}}
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="coupon_area">
                <div class="row">
                    <div class="col-xl-6 col-12">

                    </div>

                </div>
            </div>

        </div>
    </section>
@endsection
