<?php


namespace App\Http\Controllers\Admin;

use App\BaseCategory;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class CategoryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->keyword) {
            $dataCate = BaseCategory::where('name', 'like', '%' . $request->keyword . '%')
                ->orwhere('meta_keyword', $request->keyword)->paginate(5);
            $dataCate->withPath('?keyword' . $request->keyword);
        } else {
            $dataCate = BaseCategory::all();
        }
        return view('back-end.Category.list', compact('dataCate'));
    }

    public function add(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required|max:255|unique:category',
                'meta_keyword' => 'required',
                'image' => 'required|mimes:jpeg,jpg,png,gif',
                'detail' => 'required'
            ], [
                'name.required' => 'Bạn không được để trống',
                'name.unique' => 'Tên đã tồn tại',
                'meta_keyword.required' => 'Bạn không được để trống',
                'image.required' => 'Bạn không được để trống',
                'detail.required' => 'Bạn không được để trống',
                'image.mimes' => 'Bạn nhập sai định dạng ảnh',

            ]);
            $category = new BaseCategory();
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $image_ext = $image->getClientOriginalExtension();
                $new_name = rand(123456, 999999) . "." . $image_ext;
                $des_path = public_path('/images/category');
                $image->move($des_path, $new_name);
                $category->image = $new_name;
            }
            $name = $request->get('name');
            $category->name = $name;
            $category->slug = Str::slug($name, '-');
            $category->meta_keyword = $request->get('meta_keyword');
            $category->detail = $request->get('detail');
            $category->status = 0;
            $category->created_at = Carbon::now('Asia/Ho_Chi_Minh');
            $category->save();
            return redirect()->route('category.list');
        }

        return view('back-end.Category.add');
    }

    public function update($id, Request $request)
    {
        $dataCate = DB::table('category')->where('id', '=', $id)->first();
        if (!isset($dataCate)) {
            return redirect()->route('category.list');
        }
        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required|max:255|unique:category',
                'meta_keyword' => 'required',
                'image' => 'mimes:jpeg,jpg,png,gif',
                'detail' => 'required'
            ], [
                'name.required' => 'Bạn không được để trống',
                'name.unique' => 'Tên đã tồn tại',
                'meta_keyword.required' => 'Bạn không được để trống',
                'image.mimes' => 'Bạn nhập sai định dạng ảnh',
                'detail.required' => 'Bạn không được để trống',

            ]);

            $data = [];
            $name = $request->get('name');
            $data['name'] = $name;
            $data['slug'] = Str::slug($name, '-');
            $data['meta_keyword'] = $request->get('meta_keyword');
            $data['detail'] = $request->get('detail');
            $data['status'] = $request->get('status');
            $get_image = $request->file('image');
            if ($get_image) {
                $image_ext = $get_image->getClientOriginalExtension();
                $new_name = rand(123456, 999999) . $image_ext;
                $des_path = public_path('images/category');
                $get_image->move($des_path, $new_name);
                $data['image'] = $new_name;
                DB::table('category')->where('id', '=', $id)->update($data);
                return redirect()->route('category.list');
            }
            DB::table('category')->where('id', '=', $id)->update($data);
            return redirect()->route('category.list');
        }
        return view('back-end.Category.update', compact('dataCate'));
    }

    public function updateStatus($id , Request  $request){
        $data=[];
        $data['status'] = 1;
        DB::table('category')->where('id', '=', $id)->update($data);
        $product =[];
        $product['status'] =1;
        DB::table('product')->where('category_id','=',$id)->update($product);
        return redirect()->route('category.list');
    }
    public function updateTrue($id , Request  $request){
        $data=[];
        $data['status'] = 0;
        DB::table('category')->where('id', '=', $id)->update($data);
        $product =[];
        $product['status'] =0;
        DB::table('product')->where('category_id','=',$id)->update($product);
        return redirect()->route('category.list');
    }

}

