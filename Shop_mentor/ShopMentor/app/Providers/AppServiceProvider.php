<?php

namespace App\Providers;

use App\BaseCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Request $request)
    {
        $allCate = BaseCategory::where('status',0)->limit(5)->get();
        $meta_desc = "Chuyên bán sản phẩm sạch và chất lượng";
        $meta_keywords ="Rau , củ cải quả";
        $url_canonical = "http://127.0.0.1:8000/";
        $meta_title ="Rau , củ cải quả";
        $image_og = "LÊ ANh Tiến";
        $text = $request->get('keywords_submit');
        if (empty($text)){
            $text=null;
        }
        View::share(compact('allCate','meta_desc','meta_keywords','url_canonical','meta_title','image_og','text'));
    }
}
