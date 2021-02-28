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

                    </div>
                    <div class="widget_list widget_filter mb-4">
                        <h3>Lọc tên bài viết</h3>
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
                                        <img src="images/News/{{$row->image}}" class="card-img-top" alt="..."
                                             style="height: 200px">
                                        <div class="card-body">
                                            <h5 class="card-title" id="card-title">
                                                <a href="{{route('detail.post',['slug'=>$row->slug])}}"
                                                   class="name_sp">{{$row->title}}</a>
                                            </h5>
                                            <p style="font-size: 14px">
                                                Ngày đăng :  {{date('d - m - Y',strtotime($row->created_at))}}
                                            </p>
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
