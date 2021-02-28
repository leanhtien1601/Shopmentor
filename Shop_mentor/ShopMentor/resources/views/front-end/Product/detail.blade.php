@extends('layouts.Admin-main')
@section('title','Chi tiết sản phẩm')
@section('content')
    <section class="breadcrumbs_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content text-center">
                        <ul>
                            <li>
                                Home
                            </li>
                            <li>/</li>
                            <li>Product detail</li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <section class="product_details">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-12">
                    <div class="swiper-container gallery-top">
                        <div class="swiper-wrapper">
                            @foreach($allImage as $row)
                                <div class="swiper-slide" style="height: 450px">
                                    <img src="images/imageProduct/{{$row->image}}" alt="" width="100%" height="100%">
                                </div>
                            @endforeach
                        </div>
                        <!-- Add Arrows -->
                        <div class="swiper-button-next swiper-button-white"></div>
                        <div class="swiper-button-prev swiper-button-white"></div>
                    </div>
                    <div class="swiper-container gallery-thumbs">
                        <div class="swiper-wrapper">
                            @foreach($allImage as $row)
                                <div class="swiper-slide mt-2" style="height: 100px">
                                    <img src="images/imageProduct/{{$row->image}}" alt="" id="ex1" height="100%"
                                         width="100%">
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-12">
                    <div class="product_d_right">
                        <h1>{{$product->name}}</h1>
                        <div class="price_box mb_4">
                                <span
                                    class="current_price">{{number_format($product->price,0,",",".")}} <sup>đ</sup></span>
                            <span class="old_price">£70</span>
                        </div>
                        <div class="s-content mt-5" style="line-height: 1.5">
                            <p class="fs_16">{!!$product->content!!}</p>
                        </div>
                        <div class="product_variant ">
                            <h3>Available Options</h3>
                            <label for="">Color</label>
                            <ul>
                                <li></li>
                            </ul>
                        </div>
                        <div class="quantity d-flex align-items-center mt-4 mb-4">
                            <label for="">Số lượng</label>
                            <form action="{{route('cart.product')}}" method="post">
                                @csrf
                                <input type="number" min=1 name="quantity" value=1>
                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                <button type="submit">add to cart</button>
                            </form>

                        </div>
                        <div class=" product_d_action mb-4">

                        </div>
                        <div class="product_meta">
                            <span>Danh mục: </span>
                            <a>{{$product->category->name}}</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12 col-12 mt-5">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                               aria-controls="home" aria-selected="true">Chi tiết</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                               aria-controls="profile" aria-selected="false">Số lượng sản phẩm</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                               aria-controls="contact" aria-selected="false">Ngày đăng bán </a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent" style="line-height: 1.5">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            {!!$product->detail!!}</div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                          Hiện tại còn  {{$product->quantity}} sản phẩm
                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            {{date('d - m - Y',strtotime($product->created_at))}}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="product_ara">
        <div class="container">
            <div class="section_title text-center">
                <p class="text_product fs_14">Sản phẩm cùng thuộc danh mục</p>
                <h4 class="title_product">Sản phẩm liên quan</h4>
            </div>
            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane container active" id="home">
                    <div class="row">
                        @foreach($allProduct as $row)
                            @if($row->category_id==$product->category_id)
                                @if($product->id !=$row->id)
                            <div class="col-xl-3 col-6">
                                <div class="card mt-5" style="height: 320px">
                                    <img src="images/product/{{$row->image}}" class="card-img-top" alt="..."
                                         style="height: 200px">
                                    <div class="label_product">
                                        <span class="label_new">{{$row->quantity}} SP</span>
                                    </div>
                                    <div class="action_links hide text-center" id="action_links">
                                        <ul>
                                            <li>
                                                <form method="post">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{$row->id}}"
                                                           class="id">
                                                    <input type="hidden" name="product_image" value="{{$row->image}}"
                                                           class="image _{{$row->id}}">
                                                    <input type="hidden" name="product_price" value="{{$row->price}}"
                                                           class="price_{{$row->id}}">
                                                    <input type="hidden" name="product_name" value="{{$row->name}}"
                                                           class="name_{{$row->id}}">
                                                    <input type="hidden" name="product_qty" value=1
                                                           class="qty_{{$row->id}}">
                                                    <input type="button" value="Thêm giỏ hàng"
                                                           class="btn btn-outline-success btn-sm add-to-cart"
                                                           data-id="{{$row->id}}">
                                                </form>
                                            </li>
                                            <li>
                                                @if(Auth::check())
                                                    <form method="get">
                                                        @csrf
                                                        <input type="hidden" name="users_id" value="{{Auth::user()->id}}" class="users_id">
                                                        <input type="hidden" name="product_id" value="{{$row->id}}"
                                                               class="product_id">
                                                        <input type="hidden" name="product_image" value="{{$row->image}}"
                                                               class="product_image _{{$row->id}}">
                                                        <input type="hidden" name="product_price" value="{{$row->price}}"
                                                               class="product_price_{{$row->id}}">
                                                        <input type="hidden" name="product_name" value="{{$row->name}}"
                                                               class="product_name_{{$row->id}}">
                                                        <input type="hidden" name="product_qty" value=1
                                                               class="product_qty_{{$row->id}}">
                                                        <input type="button" value="Yêu thích"
                                                               class="btn btn-outline-danger btn-sm add-to-wish"
                                                               data-id_product="{{$row->id}}">
                                                    </form>
                                                @endif
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title" id="card-title">
                                            <a href="{{route('detail.product',['id'=>$row->id,'slug'=>$row->slug])}}"
                                               class="name_sp">{{$row->name}}</a>
                                        </h5>
                                        <div class="d-flex align-items-center span_price">
                                            <span
                                                class="price">{{number_format($row->price,0,",",".")}} <sup>đ</sup></span>
                                            {{--                                        <span class="price_sale">$234</span>--}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                                @endif
                                @endif
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
@section('script_view')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.add-to-wish').click(function () {
                var id = $(this).data('id_product');
                var cart_name = $('.product_name_' +id).val();
                var cart_image = $('.product_image_'+id).val();
                var cart_price = $('.product_price_'+id).val();
                var cart_qty = $('.product_qty_'+id).val();
                var _token = $('input[name="_token"]').val();
                var users_id = $('.users_id').val();

                $.ajax({
                    url:'{{route('wishlist.add')}}',
                    method:'get',
                    data:{
                        cart_name:cart_name,
                        cart_image:cart_image,
                        cart_price:cart_price,
                        cart_qty:cart_qty,
                        id:id,
                        users_id:users_id,
                        _token:_token
                    },
                    success:function (data){

                        swal({
                                title: "Thêm thành công",
                                text: "Xem tiếp hoặc chuyển trang",
                                showCancelButton: true,
                                cancelButtonText: "Xem tiếp",
                                confirmButtonClass: "btn-success btn-sm",
                                confirmButtonText: "Đến WishList",
                                closeOnConfirm: false
                            },
                            function() {
                                window.location.href = "{{route('wishlist.show')}}";
                            });

                    }
                })
            });
            $('.add-to-cart').click(function () {
                var id = $(this).data('id');
                var name = $('.name_' +id).val();
                var image = $('.image_'+id).val();
                var price = $('.price_'+id).val();
                var qty = $('.qty_'+id).val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:'{{route('cart.add')}}',
                    method:'POST',
                    data:{
                        name:name,
                        image:image,
                        price:price,
                        qty:qty,
                        id:id,
                        _token:_token
                    },
                    success:function (data){

                        swal({
                                title: "Thêm thành công",
                                text: "Xem tiếp hoặc chuyển trang",
                                showCancelButton: true,
                                cancelButtonText: "Xem tiếp",
                                confirmButtonClass: "btn-success btn-sm",
                                confirmButtonText: "Đến giỏ hàng",
                                closeOnConfirm: false
                            },
                            function() {
                                window.location.href = "{{route('cart.show')}}";
                            });

                    }
                })
            });

            function saveAuto(){
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:"{{route('product.view',['id'=>$product->id])}}",
                    method:"POST",
                    data:{_token:_token},
                    success:function (data){
                    }
                });
            }
            setTimeout(function (){
                saveAuto();
            },3000);
        });

    </script>
@endsection
