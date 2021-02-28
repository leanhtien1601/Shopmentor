<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Information;
use Carbon\Carbon;
use App\BaseNews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class InformationController extends Controller
{
    public function index()
    {
        $allNews = BaseNews::all();
        return view('back-end.News.list', compact('allNews'));
    }

    public function add(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'email' => 'required|email',
                'phone' => 'required|regex:/(0)[0-9]{9}/|size:10',
                'short_des' => 'required',
                'address' => 'required',
                'special_offers' => 'required',
                'image' => 'required|mimes:jpg,png,jpeg,gif'
            ], [
                'phone.required' => 'Bạn không được để trống',
                'short_des.required' => 'Bạn không được để trống',
                'address.required' => 'Bạn không được để trống',
                'special_offers.required' => 'Bạn không được để trống',
                'email.required' => 'Bạn không được để trống',
                'image.required' => 'Bạn không được để trống',
                'image.mimes' => 'Đây không phải là ảnh'
            ]);
            $newpost = new Information();
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $image_ext = $image->getClientOriginalExtension();
                $new_name = rand(123456, 999999) . "." . $image_ext;
                $des_path = public_path('/images/logo');
                $image->move($des_path, $new_name);
                $newpost->image = $new_name;
            }

            $newpost->phone = $request->get('phone');
            $newpost->email = $request->get('email');
            $newpost->utilities = $request->get('utilities');
            $newpost->short_des = $request->get('short_des');
            $newpost->special_offers = $request->get('special_offers');
            $newpost->address = $request->get('address');
            $newpost->save();
            return redirect()->route('news.list');
        }

        return view('back-end.Information.add');
    }

    public function update($slug, Request $request)
    {
        $new = BaseNews::where('slug', $slug)->first();
        if ($request->isMethod('post')) {
            $request->validate([
                'title' => 'required|unique:news',
                'short_des' => 'required',
                'content' => 'required',
            ], [
                'title.required' => 'Bạn không được để trống',
                'title.unique' => 'Tên đã tồn tại',
                'short_des.required' => 'Bạn không được để trống',
                'content.required' => 'Bạn không được để trống',
            ]);
            $data = [];
            $name = $request->get('title');
            $data['title'] = $name;
            $data['slug'] = Str::slug($name, '-');
            $data['content'] = $request->get('content');
            $data['status'] = $request->get('status');
            $data['updated_at'] = Carbon::now('Asia/Ho_Chi_Minh');
            $data['short_des'] = $request->get('short_des');
            $image = $request->file('image');
            if ($image) {
                $image_ext = $image->getClientOriginalExtension();
                $new_name = rand(123456, 999999) . '.' . $image_ext;
                $image_path = public_path('images/News');
                $image->move($image_path, $new_name);
                DB::table('news')->where('slug', $slug)->update($data);
                return redirect()->route('news.list');
            } else {
                DB::table('news')->where('slug', $slug)->update($data);
                return redirect()->route('news.list');
            }
        }
        return view('back-end.News.update', compact('new'));
    }
}

