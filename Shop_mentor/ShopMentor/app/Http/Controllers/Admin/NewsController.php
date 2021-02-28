<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\BaseNews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class NewsController extends Controller
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
                'title' => 'required|unique:news',
                'short_des' => 'required',
                'content' => 'required',
                'image' => 'required|mimes:jpg,png,jpeg,gif'
            ], [
                'title.required' => 'Bạn không được để trống',
                'title.unique' => 'Tên đã tồn tại',
                'short_des.required' => 'Bạn không được để trống',
                'content.required' => 'Bạn không được để trống',
                'image.required' => 'Bạn không được để trống',
                'image.mimes' => 'Đây không phải là ảnh'
            ]);
            $newpost = new BaseNews();
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $image_ext = $image->getClientOriginalExtension();
                $new_name = rand(123456, 999999) . "." . $image_ext;
                $des_path = public_path('/images/News');
                $image->move($des_path, $new_name);
                $newpost->image = $new_name;
            }
            $name = $request->get('title');
            $newpost->title = $name;
            $newpost->status = 0;
            $newpost->slug = Str::slug($name, '-');
            $newpost->short_des = $request->get('short_des');
            $newpost->content = $request->get('content');
            $newpost->created_at = Carbon::now('Asia/Ho_Chi_Minh');
            $newpost->save();
            return redirect()->route('news.list');
        }

        return view('back-end.News.add');
    }

    public function update($slug , Request  $request){
        $new = BaseNews::where('slug',$slug)->first();
        if($request->isMethod('post')){
            $request->validate([
                'title' => 'required|unique:news',
                'short_des' => 'required',
                'content' => 'required',
            ],[
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
            if($image){
                $image_ext = $image->getClientOriginalExtension();
                $new_name = rand(123456,999999).'.'.$image_ext;
                $image_path = public_path('images/News');
                $image->move($image_path,$new_name);
                DB::table('news')->where('slug',$slug)->update($data);
                return redirect()->route('news.list');
            }else{
                DB::table('news')->where('slug',$slug)->update($data);
                return redirect()->route('news.list');
            }
        }
        return view('back-end.News.update',compact('new'));
    }
}

