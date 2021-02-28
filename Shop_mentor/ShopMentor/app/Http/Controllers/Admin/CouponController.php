<?php


namespace App\Http\Controllers\Admin;

use App\BaseCategory;
use App\Coupon;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class CouponController extends Controller
{
    public function index(Request $request)
    {
        $coupon = Coupon::all();
        return view('back-end.Coupon.list',compact('coupon'));
    }

    public function add(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required|max:255',
                'price' => 'required|max:255',
                'time' => 'required|max:255',
                'code' => 'required|max:6|min:4',
            ], [
                'name.required' => 'Bạn không được để trống',
                'price.required' => 'Bạn không được để trống',
                'time.required' => 'Bạn không được để trống',
            ]);
           $coupon = new Coupon();
            $coupon->name = $request->get('name');
            $coupon->time = $request->get('time');
            $coupon->price = $request->get('price');
            $coupon->code = $request->get('code');
            $coupon->status = 0;
            $coupon->created_at = Carbon::now('Asia/Ho_Chi_Minh');
            $coupon->save();
            return redirect()->route('coupon.list');
        }

        return view('back-end.Coupon.add');
    }

//    public function update($id, Request $request)
//    {
//        $dataCate = DB::table('category')->where('id', '=', $id)->first();
//        if (!isset($dataCate)) {
//            return redirect()->route('category.list');
//        }
//        if ($request->isMethod('post')) {
//            $request->validate([
//                'name' => 'required|max:255|unique:category',
//                'meta_keyword' => 'required',
//                'image' => 'mimes:jpeg,jpg,png,gif',
//                'detail' => 'required'
//            ], [
//                'name.required' => 'Bạn không được để trống',
//                'name.unique' => 'Tên đã tồn tại',
//                'meta_keyword.required' => 'Bạn không được để trống',
//                'image.mimes' => 'Bạn nhập sai định dạng ảnh',
//                'detail.required' => 'Bạn không được để trống',
//
//            ]);
//
//            $data = [];
//            $name = $request->get('name');
//            $data['name'] = $name;
//            $data['slug'] = Str::slug($name, '-');
//            $data['meta_keyword'] = $request->get('meta_keyword');
//            $data['detail'] = $request->get('detail');
//            $data['status'] = $request->get('status');
//            $get_image = $request->file('image');
//            if ($get_image) {
//                $image_ext = $get_image->getClientOriginalExtension();
//                $new_name = rand(123456, 999999) . $image_ext;
//                $des_path = public_path('images/category');
//                $get_image->move($des_path, $new_name);
//                $data['image'] = $new_name;
//                DB::table('category')->where('id', '=', $id)->update($data);
//                return redirect()->route('category.list');
//            }
//            DB::table('category')->where('id', '=', $id)->update($data);
//            return redirect()->route('category.list');
//        }
//        return view('back-end.Category.update', compact('dataCate'));
//    }

    public function updateStatus($id , Request  $request){
        $data=[];
        $data['status'] = 1;
        DB::table('coupon')->where('id', '=', $id)->update($data);
        return redirect()->route('coupon.list');
    }
    public function updateTrue($id , Request  $request){
        $data=[];
        $data['status'] = 0;
        DB::table('coupon')->where('id', '=', $id)->update($data);
        return redirect()->route('coupon.list');
    }

}

