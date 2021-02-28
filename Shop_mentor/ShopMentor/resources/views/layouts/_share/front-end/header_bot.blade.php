<section class="header_bottom sticky-header">
    <div class="container">
        <div class="row">
            <div class="col-xl-9 col-12">
                <nav class="navbar navbar-expand-xl navbar-light">

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link active pd_15" aria-current="page" href="{{route('Home')}}">Trang
                                        chủ</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle active pd_15" href="#" id="navbarDropdown"
                                       role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Danh mục sản phẩm
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        @foreach($allCate as $cate)
                                            <li>
                                                <a href="{{route('list.product',['id'=>$cate->id,'slug'=>$cate->slug])}}"
                                                   class="dropdown-item pd_15">{{$cate->name}}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('list.post')}}" class="nav-link active pd_15">Bài viết</a>
                                </li>
                                @if(Auth::check())
                                    <li class="nav-item">
                                        <a href="{{route('wishlist.show')}}" class="nav-link active pd_15">Yêu thích</a>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle active pd_15" href="#" id="navbarDropdown"
                                           role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            Tài khoản
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <li><a class="dropdown-item" href="{{route('users.changepass',['id'=>Auth::user()->id])}}">Đổi mật khẩu</a></li>
                                            <li><a class="dropdown-item" href="{{route('users.changeUser',['id'=>Auth::user()->id])}}">Đổi thông tin</a></li>
                                        </ul>
                                    </li>
                                @endif
                            </ul>
                        </div>

                </nav>
            </div>
            <div class="col-xl-3 col-12">
                <div class="call-support">
                    <p>
                        <a href="tel:+">0123456789</a>
                        <br>
                        Customer Support
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
