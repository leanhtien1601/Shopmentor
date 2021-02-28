<?php


namespace App\Http\Controllers\Main;

use App\BaseCategory;
use App\BaseNews;
use App\BaseProduct;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    public function index(Request $request)
    {
        $allProduct = BaseProduct::where('status', 0)
            ->where('quantity', '>', 0)
            ->orderBy('created_at', 'desc')
            ->limit(8)
            ->get();

        $allCate = BaseCategory::where('status', 0)->get();

        $text = $request->get('keywords_submit');
        if (empty($text)){
            $text=null;
        }

        $allNews = BaseNews::where('status', 0)->limit(3)->get();

        $allView = DB::table('view')
            ->orderBy('view','ASC')
            ->limit(4)
            ->get();

        return view('front-end.Home.index', compact('allProduct', 'allCate', 'allNews','allView' ,'text'));
    }

    public function search(Request $request){
        $data = $request->all();
        if ($data['query']) {
            $kind = BaseProduct::where('status', 0)
                ->where('name', 'LIKE', '%' . $data['query'] . '%')
                ->get();
            $output = '<ul class="dropdown-menu" style="display: block;position: absolute;z-index: 99999">';
            foreach ($kind as $row) {
                $output .= '<li class="li_search_ajax" style="padding: 10px"> <a >' . $row->name . '</a></li>';
            }
            $output .= '</ul>';
            echo $output;
        }
    }

    public function searchProduct(Request  $request){
        $text = $request->get('keywords_submit');
        if (empty($text)){
            $text=null;
        }
        $allProduct = DB::table('product')
            ->where('status',0)
            ->where('quantity','>',0)
            ->where('name', $request->keywords_submit)
            ->get();
        return view('front-end.Search.index',compact('allProduct','text'));
    }

}

