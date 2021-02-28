<?php


namespace App\Http\Controllers\Main;


use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Social;

//sử dụng model Social


use Laravel\Socialite\Facades\Socialite;

//sử dụng model Login


class UsersController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::check()) {
            return redirect()->route('Home');
        }
        if ($request->isMethod('post')) {
            $request->validate([
                'username' => 'required',
                'password' => 'required'
            ],
                [
                    'username.required' => 'Bạn chưa nhập tên đăng nhập',
                    'password.required' => 'Bạn chưa nhập mật khẩu'
                ]);
            $dataLogin = [
                'username' => $request->get('username'),
                'password' => $request->get('password')
            ];

            if (Auth::attempt($dataLogin)) {
                if (Auth::user()->id_role == 1) {
                    return redirect()->route('Dashboard');
                } else {
                    return redirect()->route('Home');
                }

            } else {
                $error = 'Sai tên tài khoản hoặc mật khẩu';
                return back()->with('error', $error);
            }
        }
        return view('front-end.Users.login');
    }

    //đăng kí
    public function registration(Request $request)
    {
        if (Auth::check()) {
            return redirect()->route('Home');
        }
        if ($request->isMethod('post')) {
            $request->validate([
                'username' => 'required|min:6|max:16|unique:users',
                'name' => 'required',
                'password' => 'required|min:6',
                'email' => 'required|email|unique:users',
                'phone' => 'required|regex:/(0)[0-9]{9}/|size:10',
                'avatar' => 'required|mimes:jpg,jpeg,png,gif'
            ],
                [
                    'username.required' => 'Hãy nhập tên đăng nhập',
                    'username.min' => 'Nhập ít nhất 6 kí tự',
                    'username.max' => 'Nhập nhiều nhất 16 kí tự',
                    'username.unique' => 'Tên đăng nhập đã tồn tại',
                    'name.required' => 'Hãy nhập họ tên',
                    'email.unique' => 'Email đã được đăng kí',
                    'email.required' => 'Hãy nhập email',
                    'email.email' => 'Không phải là 1 email',
                    'phone.required' => 'Hãy nhập số điện thoại',
                    'phone.regex' => 'Hãy nhập đúng số điện thoại',
                    'phone.size' => 'Nhập tối đa 10 số',
                    'avatar.required' => 'Hãy upload ảnh',
                    'avatar.mimes' => 'Đây không phải là ảnh'
                ]);

            $register = new User();
            if ($request->hasFile('avatar')) {
                $file = $request->avatar;
                $folder_image = 'images/users';
                $file->move($folder_image, $file->getClientOriginalName());
                $register->avatar = $file->getClientOriginalName();
                $register->username = $request->get('username');
                $register->password = Hash::make($request->get('password'));
                $register->name = $request->get('name');
                $register->phone = $request->get('phone');
                $register->email = $request->get('email');
                $register->id_role = 2;
                $register->created_at = Carbon::now('Asia/Ho_Chi_Minh');
                $register->save();
                return redirect()->route('users.login');

            }

        }
        return view('front-end.Users.registration');
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect()->route('users.login');
    }


// Đổi mật khẩu
    public function changepass($id, Request $request)
    {
        $dataUser = User::where('id', $id)->first();

        if ($request->isMethod('post')) {
            $request->validate([
                'username' => 'required|min:6',
                'email' => 'required',
                'password' => 'required',
                'password_new' => 'required',
            ], [
                'username.required' => 'Bạn không được để trống',
                'email.required' => 'Bạn không được để trống',
                'password.required' => 'Bạn không được để trống',
                'password_new' => 'Bạn không được để trống'
            ]);
            $dataEditPass = [
                'username' => $request->get('username'),
                'email' => $request->get('email'),
                'password' => $request->get('password')

            ];

            if (Auth::attempt($dataEditPass)) {
                // login thanh cong
                $dataSave = [
                    'password' => Hash::make($request->get('password_new'))

                ];
                $dataUser->SaveUpdate($id, $dataSave);
                $success = 'Bạn đã đổi mật khẩu thành công';
                return redirect()->back()->with('success', $success);
            } else {
                $eror = 'Bạn cần nhập chính xác các thông tin';
                return redirect()->back()->with('eror', $eror);
            }


        }
        return view('front-end.Users.changepass');
    }

// đổi thông tin người dùng
    public function changeUser($id, Request $request)
    {
        $dataUser = User::where('id', $id)->first();
        if ($request->isMethod('post')) {
            $request->validate([
                'username' => 'required|min:6|max:16|unique:users',
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'phone' => 'required|regex:/(0)[0-9]{9}/|size:10',
                'avatar' => 'mimes:jpg,jpeg,png,gif'
            ],
                [
                    'username.required' => 'Hãy nhập tên đăng nhập',
                    'username.min' => 'Nhập ít nhất 6 kí tự',
                    'username.max' => 'Nhập nhiều nhất 16 kí tự',
                    'username.unique' => 'Tên đăng nhập đã tồn tại',
                    'name.required' => 'Hãy nhập họ tên',
                    'email.unique' => 'Email đã được đăng kí',
                    'email.required' => 'Hãy nhập email',
                    'email.email' => 'Không phải là 1 email',
                    'phone.required' => 'Hãy nhập số điện thoại',
                    'phone.regex' => 'Hãy nhập đúng số điện thoại',
                    'phone.size' => 'Nhập tối đa 10 số',
                    'avatar.mimes' => 'Đây không phải là ảnh'
                ]);
            $data = [];
            $data['name'] = $request->get('name');
            $data['username'] = $request->get('username');
            $data['email'] = $request->get('email');
            $data['phone'] = $request->get('phone');
            $get_image = $request->file('avatar');
            if ($get_image) {
                $image_ext = $get_image->getClientOriginalExtension();
                $new_name = rand(123456, 999999) . $image_ext;
                $des_path = public_path('images/users');
                $get_image->move($des_path, $new_name);
                $data['avatar'] = $new_name;
                DB::table('users')->where('id', '=', $id)->update($data);
                $success = 'Bạn đã đổi thông tin thành công';
                return redirect()->back()->with('success', $success);
            } else {
                DB::table('users')->where('id', '=', $id)->update($data);
                $success = 'Bạn đã đổi thông tin thành công';
                return redirect()->back()->with('success', $success);
            }

        }
        return view('front-end.Users.changeUser');
    }


    public function loginFace()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callback()
    {
        $provider = Socialite::driver('facebook')->user();
        $account = Social::where('provider', 'facebook')->where('provider_user_id', $provider->getId())->first();

        $userName = new Social([
            'provider_user_id' => $provider->getId(),
            'provider' => 'facebook'
        ]);

        $orang = User::where('email', $provider->getEmail())->first();

        if (!$orang) {
            $orang = User::create([
                'username' => $provider->getName(),
                'name' => '',
                'phone' => '',
                'avatar' => '',
                'id_role' => 2,
                'email' => $provider->getEmail(),
                'password' => '',
            ]);
        }
        $userName->login()->associate($orang);
        $userName->save();

        $account_name = User::where('id', $userName->user)->first();

        return redirect('/admin/dashboard')->with('message', 'Đăng nhập Admin thành công');

    }

// quên mật khẩu
    public function forgetPass()
    {


        return view('front-end.Users.forgetpass');
    }

    public function recoverPass(Request $request)
    {
        $data = $request->all();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y');
        $title_email = 'Mail quên mật khẩu' . ' : ' . $now;
        $user = User::where('email', '=', $data['email_acount'])->get();

        foreach ($user as $value) {
            $user_id = $value->id;
        }
        if ($user) {
            $count_user = $user->count();
            if ($count_user == 0) {
                $erorMail = 'Email bạn chưa đăng kí tài khoản';
                return redirect()->back()->with('erorMail', $erorMail);
            } else {
                $token_random = Str::random(20);
                $user = User::find($user_id);
                $user->token_pass = $token_random;
                $user->save();

                //send mail
                $to_mail = $data['email_acount'];
                $link_reset_pass = url('/update-new-pass?email=' . $to_mail . '&token=' . $token_random);

                $data = array('name' => $title_email, 'body' => $link_reset_pass, 'email' => $data['email_acount']);

                Mail::send('front-end.Users.mailForgetPass', ['data' => $data], function ($message) use ($title_email, $data) {
                    $message->to($data['email'])->subject($title_email);
                    $message->from($data['email'], $title_email);
                });
                $message = 'Gửi mail thành công';
                return redirect()->back()->with('message', $message);
            }
        }
        return view('front-end.Users.forgetpass');

    }

    public function updatePass(Request $request)
    {

        return view('front-end.Users.update_pass');
    }

    public function resetPass(Request $request)
    {

        $data = $request->all();
        $token_random = Str::random(20);
        $user = User::where('email', '=', $data['email_acount'])
            ->where('token_pass', '=', $data['token'])
            ->get();
        if(isset($user)){
            return redirect()->route('users.login');
        }

        $count = $user->count();
        if ($count > 0) {
            foreach ($user as $row) {
                $user_id = $row->id;
            }
            $reset = User::find($user_id);
            $reset->password = Hash::make($data['pass_new']);
            $reset->token_pass = $token_random;
            $reset->save();
//            $pass= 'Cập nhật mật khẩu thành công ';
            return redirect()->route('users.login');
        } else {
            $passnew = 'Vui lòng nhập lại email vì link hết hạn ';
            return redirect('forget.pass')->back()->with('passnew', $passnew);
        }

    }
}
