<?php


namespace App\Http\Controllers\Admin;

use App\BaseOrder;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class SendMailController extends Controller
{
    public function send($id ,Request $request){
        $allUser = DB::table('users')
            ->where('id',$id)
            ->first();
        return view('back-end.SendMail.index',compact('allUser'));
    }

    public function index(Request $request){
        if($request->isMethod('post')){
            $request->validate([
                'image' => 'required|mimes:jpg,png,gif,jpeg,pdf'
            ],[
                'image.required' => 'Thiếu ảnh',
                'image.mimes' => 'Sai định dạng ảnh'
            ]);
            $data['users_id'] = $request->get('users_id');
            $users_id=$data['users_id'];
            $data['status'] = 1;
            DB::table('order')->where('users_id','=',$users_id)->update($data);
            $data = array(
                'name' => $request->name,
                'email' => $request->email,
                'image' => $request->file('image'),
                'phone' => $request->phone
            );

            Mail::to($data['email'])->send(new SendMail($data));

        }
        return redirect()->route('order.list');
    }

}

