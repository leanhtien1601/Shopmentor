@extends('layouts.Admin-main')
@section('title','Danh sách sản phẩm')
@section('content')
    <section class="breadcrumbs_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content text-center">
                        <h3>Shop</h3>
                        <ul>
                            <li>
                                home
                            </li>
                            <li>/</li>
                            <li>Shopping</li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <section class="list_product">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-12">
                    <div class="sidebar_widget mb-4">
                        <div class="widget_list widget_categories">
                            <h3>Danh mục</h3>
                            <ul>
                                @foreach($allCate as $cate)
                                    @if($categories->id!=$cate->id)
                                        <li>
                                            <a href="{{route('list.product',['id'=>$cate->id,'slug'=>$cate->slug])}}">{{$cate->name}}</a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="widget_list widget_filter mb-4">
                        <h3>Lọc sản phẩm</h3>
                        @isset($kindSearch)
                        @else
                            @if(isset($_GET['sort_by']))
                                @php
                                    $sort_by = $_GET['sort_by'];
                            if($sort_by == 'tang_dan'){
                               $tangdan = 'Giá tăng dần';
                            }
                            elseif($sort_by == 'giam_dan'){
                                 $giam_dan = 'Giá giảm dần' ;
                               }
                            elseif($sort_by == 'ten_a_z'){
                                 $ten_a_z = 'Tên từ a -> z' ;
                               }
                            elseif($sort_by == 'ten_z_a'){
                                 $ten_z_a = 'Tên từ z -> a' ;
                               }
                                @endphp
                            @endif
                            <form action="">
                                @csrf
                                <select class="form-select" aria-label="Default select example" id="sort"
                                        name="sort" style="padding: 5px">
    >
                                    <option value="{{Request::url()}}">Lọc theo</option>
                                    <option value="{{Request::url()}}?sort_by=tang_dan"
                                            @isset($tangdan) selected @endisset>Giá
                                        tăng dần
                                    </option>
                                    <option value="{{Request::url()}}?sort_by=giam_dan"
                                            @isset($giam_dan) selected @endisset>Giá
                                        giảm dần
                                    </option>
                                    <option value="{{Request::url()}}?sort_by=ten_a_z"
                                            @isset($ten_a_z) selected @endisset>Tên
                                        từ a => z
                                    </option>
                                    <option value="{{Request::url()}}?sort_by=ten_z_a"
                                            @isset($ten_z_a) selected @endisset>Tên
                                        từ z => a
                                    </option>
                                </select>
                            </form>

                        @endisset
                    </div>
                    <div class="sidebar_widget  widget_color mb-4">
                        <div class="widget_list widget_categories">
                            <h3>Color</h3>
                            <ul>
                                <li>
                                    <a href="">Shoes <span class="text-right count_bnumber">( 6 )</span></a>
                                </li>
                                <li>
                                    <a href="">Shoes</a>
                                </li>
                                <li>
                                    <a href="">Shoes</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="sidebar_widget mb-4">
                        <div class="widget_list widget_categories">
                            <h3>Tag</h3>
                            <div class="tag_cloud">
                                <a href="http://">Men</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-12">
                    <div class="product_ara">
                        <div class="row">
                            @foreach($allProduct as $row)
                                <div class="col-xl-4 col-6">
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
                                                        <input type="hidden" name="product_image"
                                                               value="{{$row->image}}"
                                                               class="image _{{$row->id}}">
                                                        <input type="hidden" name="product_price"
                                                               value="{{$row->price}}"
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
                            @endforeach
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
            $('#sort').on('change', function () {
                var url = $(this).val();
                if (url) {
                    window.location = url;
                }
                return false;
            })
        });
    </script>
@endsection
