<?php


namespace App\Http\Controllers\Main;

use App\BaseCategory;
use App\BaseImageProduct;
use App\BaseProduct;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PostController extends Controller
{
    public function index(Request $request)
    {

        if (isset($_GET['sort_by'])) {
            $sort_by = $_GET['sort_by'];
            if ($sort_by == 'ten_a_z') {
                $allProduct = DB::table('news')
                    ->where('status', '=', 0)
                    ->orderBy('title', 'ASC')
                    ->get();
            } elseif ($sort_by == 'ten_z_a') {
                $allProduct = DB::table('news')
                    ->where('status', '=', 0)
                    ->orderBy('title', 'DESC')
                    ->get();
            }
        } else {
            $allProduct = DB::table('news')
                ->where('status', '=', 0)
                ->get();
        }
        return view('front-end.Post.list', compact('allProduct'));
    }

    public function detailPost($slug, Request $request)
    {
        $product = DB::table('news')
            ->where('slug',$slug)
            ->first();
        $allProduct = DB::table('news')->get();
        return view('front-end.Post.detail', compact('product', 'allProduct'));
    }

}
