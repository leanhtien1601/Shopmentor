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
                    <img src="images/News/{{$product->image}}" alt="" width="100%" height="auto">
                </div>
                <div class="col-xl-6 col-12">
                    <div class="product_d_right">
                        <h1>{{$product->title}}</h1>
                        <div class="s-content mt-5" style="line-height: 1.5">
                            <p class="fs_16">Tin ngắn :{!!$product->short_des!!}</p>
                        </div>
                        <div class="s-content mt-5" style="line-height: 1.5">
                            <p class="fs_16">Ngày đăng:  {{date('d - m - Y',strtotime($product->created_at))}}</p>
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
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                               aria-controls="contact" aria-selected="false">Ngày đăng </a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent" style="line-height: 1.5">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            {!!$product->content!!}</div>
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
                <p class="text_product fs_14">Xem thêm bài viết khác</p>
                <h4 class="title_product">Bài viết có thể bạn sẽ thích</h4>
            </div>
            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane container active" id="home">
                    <div class="row">
                        @foreach($allProduct as $row)
                            @if($row->id != $product->id)
                            <div class="col-xl-3 col-6">
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
                            @endif
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

