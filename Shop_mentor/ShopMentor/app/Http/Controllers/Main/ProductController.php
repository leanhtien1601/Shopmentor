<?php


namespace App\Http\Controllers\Main;

use App\BaseCategory;
use App\BaseImageProduct;
use App\BaseProduct;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{
    public function index($id, $slug, Request $request)
    {
        $categories = DB::table('category')
            ->where('id', $id)
            ->first();
        if (isset($_GET['sort_by'])) {
            $sort_by = $_GET['sort_by'];
            if ($sort_by == 'tang_dan') {
                $allProduct = DB::table('product')
                    ->where('category_id', '=', $id)
                    ->orderBy('price', 'ASC')
                    ->get();
            } elseif ($sort_by == 'giam_dan') {
                $allProduct = DB::table('product')
                    ->where('category_id', '=', $id)
                    ->orderBy('price', 'DESC')
                    ->get();
            } elseif ($sort_by == 'ten_a_z') {
                $allProduct = DB::table('product')
                    ->where('category_id', '=', $id)
                    ->orderBy('name', 'ASC')
                    ->get();
            } elseif ($sort_by == 'ten_z_a') {
                $allProduct = DB::table('product')
                    ->where('category_id', '=', $id)
                    ->orderBy('name', 'DESC')
                    ->get();
            }

        } else {
            $allProduct = DB::table('product')
                ->where('category_id', '=', $id)
                ->get();
        }
        return view('front-end.Product.index', compact('allProduct', 'categories'));
    }

    public function detailproduct($id, $slug, Request $request)
    {
        $product = BaseProduct::where('slug', $slug)->first();
        $allImage = BaseImageProduct::where('product_id', $id)->get();
        $allProduct = DB::table('product')->get();
        return view('front-end.Product.detail', compact('product', 'allImage', 'allProduct'));
    }

}
