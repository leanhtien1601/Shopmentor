<header>
    <div class="container">
        <div class="row">
            <div class="col-xl-2 col-12">
                <a href="{{route('Home')}}">
                    <img src="theme/frontend/images/logo.png" alt="logo" class="c-img">
                </a>
            </div>
            <div class="col-xl-10 col-12">
                <div class="header_right_info d-flex align-items-center">
                    <form action="{{route('product.searchProduct')}}" method="get">
                        @csrf
                        <div class="search">
                            <input type="text"  id="keywords" name="keywords_submit" value="{{$text}}" placeholder="Tìm kiếm sản phẩm theo tên">
                            <div id="search_ajax"></div>
                            <button type="submit">
                                <span class="lnr lnr-magnifier"></span>
                            </button>
                        </div>
                    </form>
                    <div class="header_account_area d-flex align-items-center">
                        <ul>
                            @if(Auth::check())
                                <li>
                                    <a style="font-size: 14px">Hi bạn, {{Auth::user()->name}}</a>
                                </li>
                                <li>
                                    <a href="{{route('users.logout')}}" style="font-size: 14px">Đăng xuất</a>
                                </li>
                            @else
                                <li>
                                    <a href="{{route('users.registration')}}">Đăng kí</a>
                                </li>
                                <li>/</li>
                                <li>
                                    <a href="{{route('users.login')}}">Đăng nhập</a>
                                </li>
                            @endif
                        </ul>
                        <a href="{{route('cart.show')}}" target="_blank" rel="noopener noreferrer">
                            <span class="lnr lnr-cart"></span>
                            <span class="item_count">{{Cart::count()}}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

