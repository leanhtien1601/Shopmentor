@extends('layouts.Admin-main')
@section('title','Trang chủ')
@section('content')
    <div class="swiper-container slide_banner">
        <div class="swiper-wrapper">
            <?php for($i = 0;$i < 3;$i++){?>
            <div class="swiper-slide slide_items"
                 style="background-image:url({{asset('theme/frontend/images/slider1.jpg')}})">
                <div class="container">
                    <div class="items">
                        <h1>
                            Vegetables Big Sale
                        </h1>
                        <h2>Fresh Farm Products</h2>
                        <p class="text_slide">
                            10% certifled-organic mix of fruit and veggies. Perfect for weekly cooking and snacking!
                        </p>
                        <a href="#" class="btn_link">Xem thêm</a>
                    </div>
                </div>
            </div>
            <?php }?>
        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>
    </div>
    <section class="support_main">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-6">
                    <div class="card mb-3 ">
                        <div class="row g-0 align-items-center">
                            <div class="col-md-3 text-center">
                                <img src="theme/frontend/images/shipping1.jpg" alt="..." class="c-img">
                            </div>
                            <div class="col-md-9">
                                <div class="card-body">
                                    <h5 class="card-title">Free Shipping</h5>
                                    <p class="card-text  fs_14">Free shipping on all US order or order above $200
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-6">
                    <div class="card mb-3 ">
                        <div class="row g-0 align-items-center">
                            <div class="col-md-3 text-center">
                                <img src="theme/frontend/images/shipping2.jpg" alt="..." class="c-img">
                            </div>
                            <div class="col-md-9">
                                <div class="card-body">
                                    <h5 class="card-title">Free Shipping</h5>
                                    <p class="card-text  fs_14">Free shipping on all US order or order above $200
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-6">
                    <div class="card mb-3 ">
                        <div class="row g-0 align-items-center">
                            <div class="col-md-3 text-center">
                                <img src="theme/frontend/images/shipping3.jpg" alt="..." class="c-img">
                            </div>
                            <div class="col-md-9">
                                <div class="card-body">
                                    <h5 class="card-title">Free Shipping</h5>
                                    <p class="card-text  fs_14">Free shipping on all US order or order above $200
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-6">
                    <div class="card mb-3 ">
                        <div class="row g-0 align-items-center">
                            <div class="col-md-3 text-center">
                                <img src="theme/frontend/images/shipping4.jpg" alt="..." class="c-img">
                            </div>
                            <div class="col-md-9">
                                <div class="card-body">
                                    <h5 class="card-title">Free Shipping</h5>
                                    <p class="card-text  fs_14">Free shipping on all US order or order above $200
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="product_ara">
        <div class="container">
            <div class="section_title text-center">
                <p class="text_product fs_14">Mới thêm vào của hàng</p>
                <h4 class="title_product">Sản phẩm mới nhất</h4>
            </div>
            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane container active" id="home">
                    <div class="row">
                        @foreach($allProduct as $row)
                            <div class="col-xl-3 col-6">
                                <div class="card mt-5" style="height: 320px">
                                    <img src="images/product/{{$row->image}}" class="card-img-top" alt="..."
                                         style="height: 200px">
                                    <div class="label_product">
                                        <span class="label_new">New</span>
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
                                                        <input type="hidden" name="users_id"
                                                               value="{{Auth::user()->id}}" class="users_id">
                                                        <input type="hidden" name="product_id" value="{{$row->id}}"
                                                               class="product_id">
                                                        <input type="hidden" name="product_image"
                                                               value="{{$row->image}}"
                                                               class="product_image _{{$row->id}}">
                                                        <input type="hidden" name="product_price"
                                                               value="{{$row->price}}"
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
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </section>
    <section class="cate_list">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-12">
                    <div class="banner_thumb ">
                        <a href="http://">
                            <img src="theme/frontend/images/banner1.jpg" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-xl-6 col-12">
                    <div class="banner_thumb ">
                        <a href="http://">
                            <img src="theme/frontend/images/banner2.jpg" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="product_ara">
        <div class="container">
            <div class="section_title text-center">
                <p class="text_product fs_14">Sản phẩm có lượt xem cao</p>
                <h4 class="title_product">Sản phẩm xem nhiều nhất</h4>
            </div>
            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane container active" id="home">
                    <div class="row">
                        @foreach($allProduct as $row)
                            @foreach($allView as $view)
                                @if($view->product_id == $row->id)
                                    <div class="col-xl-3 col-6">
                                        <div class="card mt-5" style="height: 320px">
                                            <img src="images/product/{{$row->image}}" class="card-img-top" alt="..."
                                                 style="height: 200px">
                                            <div class="label_product d-flex align-items-center">
                                                <span class="label_new">Hot</span>
                                                <span class="label_sale">{{$view->view}} View</span>
                                            </div>
                                            <div class="action_links hide text-center" id="action_links">
                                                <ul>
                                                    <li>
                                                        <form method="post">
                                                            @csrf
                                                            <input type="hidden" name="product_id" value="{{$row->id}}"
                                                                   class="id">
                                                            <input type="hidden" name="product_image"
                                                                   value="{{$row->image}}"
                                                                   class="image _{{$row->id}}">
                                                            <input type="hidden" name="product_price"
                                                                   value="{{$row->price}}"
                                                                   class="price_{{$row->id}}">
                                                            <input type="hidden" name="product_name"
                                                                   value="{{$row->name}}"
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
                                                                <input type="hidden" name="users_id"
                                                                       value="{{Auth::user()->id}}" class="users_id">
                                                                <input type="hidden" name="product_id"
                                                                       value="{{$row->id}}"
                                                                       class="product_id">
                                                                <input type="hidden" name="product_image"
                                                                       value="{{$row->image}}"
                                                                       class="product_image _{{$row->id}}">
                                                                <input type="hidden" name="product_price"
                                                                       value="{{$row->price}}"
                                                                       class="product_price_{{$row->id}}">
                                                                <input type="hidden" name="product_name"
                                                                       value="{{$row->name}}"
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
                            @endforeach
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </section>
    <section class="banner_full">
        <div class="container">
            <p class="text_banner">Black Fridays !</p>
            <h2>Sale 50% OFf </h2>
            <a href="http://" class="btn_banner">discover now</a>
        </div>
    </section>
    <section class="blog_section">
        <div class="container">
            <div class="section_title text-center">
                <p class="text_product fs_14">Recently added our store</p>
                <h4 class="title_product">Bài viết tiêu biểu</h4>
            </div>
            <br>
            <!-- Swiper -->
            <div class="swiper-container blog_slide">
                <div class="swiper-wrapper">
                    @foreach($allNews as $new)
                        <div class="swiper-slide">
                            <a href="http://" class="c-img">
                                <img src="images/News/{{$new->image}}" alt="" height="350px" width="100%">
                            </a>
                            <div class="blog_content">
                                <div class="articles_date">
                                    <p>Ngày đăng : {{date('d - m - Y',strtotime($new->created_at))}}</p>
                                </div>
                                <h4 class="post_title">
                                    <a href="{{route('detail.post',['slug'=>$new->slug])}}" > {{$new->title}}</a>
                                </h4>
                                <div class="blog_footer">
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#name_{{$new->id}}">Xem nhanh
                                    </button>
                                </div>
                            </div>
                        </div>

                    @endforeach
                </div>
                <!-- Add Pagination -->
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>
@endsection

@section('script_view')

    <script type="text/javascript">
        $(document).ready(function () {
            $('.add-to-wish').click(function () {
                var id = $(this).data('id_product');
                var cart_name = $('.product_name_' + id).val();
                var cart_image = $('.product_image_' + id).val();
                var cart_price = $('.product_price_' + id).val();
                var cart_qty = $('.product_qty_' + id).val();
                var _token = $('input[name="_token"]').val();
                var users_id = $('.users_id').val();

                $.ajax({
                    url: '{{route('wishlist.add')}}',
                    method: 'get',
                    data: {
                        cart_name: cart_name,
                        cart_image: cart_image,
                        cart_price: cart_price,
                        cart_qty: cart_qty,
                        id: id,
                        users_id: users_id,
                        _token: _token
                    },
                    success: function (data) {

                        swal({
                                title: "Thêm thành công",
                                text: "Xem tiếp hoặc chuyển trang",
                                showCancelButton: true,
                                cancelButtonText: "Xem tiếp",
                                confirmButtonClass: "btn-success btn-sm",
                                confirmButtonText: "Đến WishList",
                                closeOnConfirm: false
                            },
                            function () {
                                window.location.href = "{{route('wishlist.show')}}";
                            });

                    }
                })
            });
            $('.add-to-cart').click(function () {
                var id = $(this).data('id');
                var name = $('.name_' + id).val();
                var image = $('.image_' + id).val();
                var price = $('.price_' + id).val();
                var qty = $('.qty_' + id).val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: '{{route('cart.add')}}',
                    method: 'POST',
                    data: {
                        name: name,
                        image: image,
                        price: price,
                        qty: qty,
                        id: id,
                        _token: _token
                    },
                    success: function (data) {

                        swal({
                                title: "Thêm thành công",
                                text: "Xem tiếp hoặc chuyển trang",
                                showCancelButton: true,
                                cancelButtonText: "Xem tiếp",
                                confirmButtonClass: "btn-success btn-sm",
                                confirmButtonText: "Đến giỏ hàng",
                                closeOnConfirm: false
                            },
                            function () {
                                window.location.href = "{{route('cart.show')}}";
                            });

                    }
                })
            });

        });
    </script>
@endsection
