<?php

namespace App\Http\Controllers\Admin;

use App\BaseCategory;
use App\BaseProduct;
use App\Http\Controllers\Controller;
use App\View;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class ProductController extends Controller
{

    public function index(Request $request)
    {
        if ($request->keyword) {
            $data = BaseProduct::where('name', 'like', '%' . $request->keyword . '%')->paginate(5);
            $data->withPath('?keyword' . $request->keyword);
            $cate = DB::table('category')->get();
        } else {
            $data = BaseProduct::all();
            $cate = DB::table('category')->get();
        }


        return view('back-end.Product.list', compact('data', 'cate'));
    }

    public function add(Request $request)
    {
        $dataCate = BaseCategory::all();
        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required|unique:App\BaseProduct',
                'image' => 'required|mimes:jpg,png,gif',
                'quantity' => 'required',
                'content' => 'required',
                'detail' => 'required',
                'price' => 'required',
                'product_sold' => 'required',

            ], [
                'name.required' => 'Bạn không được để trống',
                'name.unique' => 'Tên đã tồn tại',
                'image.required' => 'Bạn không được để trống',
                'image.mimes' => 'Bạn chọn sai định dạng ảnh',
                'quantity.required' => 'Bạn không được để trống',
                'content.required' => 'Bạn không được để trống',
                'detail.required' => 'Bạn không được để trống',
                'product_sold.required' => 'Bạn không được để trống',
            ]);
            $product = new BaseProduct();

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $image_ext = $image->getClientOriginalExtension();
                $new_image = rand(123456, 999999) . $image_ext;
                $des_path = public_path('images/product');
                $image->move($des_path, $new_image);
                $product->image = $new_image;
            }
            $name = $request->get('name');
            $product->name = $name;
            $product->content = $request->get('content');
            $product->detail = $request->get('detail');
            $product->price = $request->get('price');
            $product->slug = Str::slug($name, '-');
            $product->status = 0;
            $product->quantity = $request->get('quantity');
            $product->category_id = $request->get('category_id');
            $product->product_sold = $request->get('product_sold');
            $product->created_at = Carbon::now('Asia/Ho_Chi_Minh');
            $product->save();

            //view
            $product_id = $product->id;
            $view = new View();
            $view->product_id = $product_id;
            $view->view = 0;
            $view->created_at = Carbon::now('Asia/Ho_Chi_Minh');
            $view->save();
            return redirect()->route('product.list');
        }
        return view('back-end.Product.add', compact('dataCate'));
    }

    public function update($id, Request $request)
    {
        $dataPro = DB::table('product')->where('id', '=', $id)->first();
        $dataCate = DB::table('category')->get();
        if (!isset($dataPro)) {
            return redirect()->route('product.list');
        }
        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required|unique:App\BaseProduct',
                'image' => 'mimes:jpg,png,gif',
                'quantity' => 'required',
                'content' => 'required',
                'detail' => 'required',
                'price' => 'required',
                'product_sold' => 'required',
            ], [
                'name.required' => 'Bạn không được để trống',
                'name.unique' => 'Tên đã tồn tại',
                'image.mimes' => 'Bạn chọn sai định dạng ảnh',
                'quantity.required' => 'Bạn không được để trống',
                'content.required' => 'Bạn không được để trống',
                'detail.required' => 'Bạn không được để trống',
                'product_sold.required' => 'Bạn không được để trống',
            ]);
            $data = [];
            $name = $request->get('name');
            $data['name'] = $name;
            $data['quantity'] = $request->get('quantity');
            $data['slug'] = Str::slug($name, '-');
            $data['content'] = $request->get('content');
            $data['detail'] = $request->get('detail');
            $data['price'] = $request->get('price');
            $data['category_id'] = $request->get('category_id');
            $data['product_sold'] = $request->get('product_sold');
            $get_image = $request->file('image');
            if ($get_image) {
                $image_ext = $get_image->getClientOriginalExtension();
                $image_new = rand(123456, 999999) . $image_ext;
                $image_puth = public_path('images/product');
                $get_image->move($image_puth, $image_new);
                $data['image'] = $image_new;
                DB::table('product')->where('id', $id)->update($data);
                return redirect()->route('product.list');
            }
            DB::table('product')->where('id', $id)->update($data);
            return redirect()->route('product.list');
        }
        return view('back-end.Product.update', compact('dataPro', 'dataCate'));
    }

    public function updateStatus($id , Request  $request){
        $data=[];
        $data['status'] = 1;
        DB::table('product')->where('id', $id)->update($data);
        return redirect()->route('product.list');
    }
    public function updateTrue($id , Request  $request){
        $data=[];
        $data['status'] = 0;
        DB::table('product')->where('id', $id)->update($data);
        return redirect()->route('product.list');
    }
}
