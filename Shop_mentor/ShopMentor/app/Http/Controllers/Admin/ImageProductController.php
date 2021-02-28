<?php

namespace App\Http\Controllers\Admin;

use App\BaseImageProduct;
use App\BaseProduct;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ImageProductController extends Controller
{

    public function index($id, $slug, Request $request)
    {
        $product = BaseImageProduct::where('product_id', $id)->paginate(5);
        $nameProduct = BaseProduct::where('id', $id)->first();
        return view('back-end.ImageProduct.list', compact('product', 'nameProduct'));
    }

    public function add($slug, Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'image' => 'required'
            ], [
                'image.required' => 'Bạn không được để trống'
            ]);
            $product = DB::table('product')->where('slug', $slug)->first();
            if ($request->hasFile('image')) {
                $image_arr = $request->file('image');
                $arr_len = count($image_arr);
                for ($i = 0; $i < $arr_len; $i++) {
                    $image_ext = $image_arr[$i]->getClientOriginalExtension();
                    $new_name = rand(123456, 999999) . '.' . $image_ext;
                    $des_path = public_path('/images/imageProduct');
                    $image_arr[$i]->move($des_path, $new_name);
                    $imagePro = new BaseImageProduct();
                    $imagePro->product_id = $product->id;
                    $imagePro->image = $new_name;
                    $imagePro->save();
                }
            }
            return redirect()->route('product.list');
        }
        return view('back-end.ImageProduct.add');
    }

    public function edit($id, Request $request)
    {
        $imagePro = BaseImageProduct::where('id', $id)->first();
        $product = BaseProduct::all();
        if (!isset($imagePro)) {
            return redirect()->route('imageProduct.list');
        }
        if ($request->isMethod('post')) {
            $data = [];
            $getImage = $request->file('image');
            if ($getImage) {
                $image_ext = $getImage->getClientOriginalExtension();
                $new_name = rand(123456, 999999) . '.' . $image_ext;
                $des_path = public_path('/images/ImageProduct');
                $getImage->move($des_path, $new_name);
                $data['image'] = $new_name;
                $data['product_id'] = $request->get('product_id');
                DB::table('imageproduct')->where('id', $id)->update($data);
                $success = 'Bạn đã cập nhật thành công';
                return redirect()->back()->with('success', $success);
            } else {
                $data['product_id'] = $request->get('product_id');
                DB::table('imageproduct')->where('id', $id)->update($data);
                $success = 'Bạn đã cập nhật thành công';
                return redirect()->back()->with('success', $success);
            }
        }
        return view('back-end.ImageProduct.update', compact('imagePro', 'product'));
    }
}
