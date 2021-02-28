<?php


namespace App\Http\Controllers\Main;

use App\BaseOrder;
use App\BaseShiping;
use App\City;
use App\District;
use App\FeedShip;
use App\Http\Controllers\Controller;
use App\OrderDetail;
use App\Payment;
use App\Ward;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class CheckoutController extends Controller
{
    public function index(Request $request)
    {


        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required|min:3',
                'phone' => 'required|regex:/(0)[0-9]{9}/|size:10',
                'address' => 'required'
            ], [
                'name.required' => 'Bạn không được để trống',
                'name.min' => 'Bạn nhập ít hơn 3 kí tự',
                'phone.required' => 'Bạn không được để trống',
                'phone.regex' => 'Bạn nhập sai số điện thoại',
                'address.required' => 'Bạn không được để trống',
            ]);
            //payment
            $payment = new Payment();
            $payment->payment_method = $request->get('payment_method');
            //0 đang xử lý
            $payment->status = 0;
            $payment->created_at = Carbon::now('Asia/Ho_Chi_minh');
            $payment->save();
            $payment_id = $payment->id;

            //sipping

            $data = array();
            $data['name'] = $request->get('name');
            $data['address'] = $request->get('address');
            $data['phone'] = $request->get('phone');
            $data['note'] = $request->get('note');
            $data['city_id'] = $request->get('fee_matp');
            $data['district_id'] = $request->get('fee_maqh');
            $data['ward_id'] = $request->get('fee_xaid');
            $shipping_id = DB::table('shipping')->insertGetId($data);

            //order
            $dataOrder = array();
            $dataOrder['users_id'] = Auth::user()->id;
            $dataOrder['shipping_id'] = $shipping_id;
            $dataOrder['payment_id'] = $payment_id;
            $priceSale = $request->get('priceSale');
            if ($priceSale) {
                $dataOrder['order_total'] = $priceSale;
            } else {
                $dataOrder['order_total'] = Cart::subtotal();
            }
            $dataOrder['status'] = 0;
            $dataOrder['created_at'] = Carbon::now('Asia/Ho_Chi_Minh');
            $order_id = DB::table('order')->insertGetId($dataOrder);

            //order_detail
            $code = $request->get('code');
            $content = Cart::content();

            foreach ($content as $row) {
                $data_detail['order_id'] = $order_id;
                $data_detail['product_id'] = $row->id;
                $data_detail['product_name'] = $row->name;
                $data_detail['product_price'] = $row->price;
                $data_detail['product_quantity'] = $row->qty;
                $data_detail['price_ship'] = $request->get('price_ship');
                if ($code) {
                    $data_detail['product_code'] = $code;
                }
                $data_detail['created_at'] = Carbon::now('Asia/Ho_Chi_Minh');
                DB::table('order_detail')->insert($data_detail);
            }
            if ($payment->payment_method == 1) {
                Cart::destroy();
                return redirect()->route('thankyou');
            }
            return redirect()->route('Home');

        }
        return view('front-end.Checkout.index');
    }

    public function thankYou()
    {
        Session::remove('fee');
        Session::remove('priceSale');
        Session::remove('fee_matp');
        Session::remove('fee_maqh');
        Session::remove('fee_xaid');
        return view('front-end.Checkout.paymentPrice');
    }

    public function select(Request $request)
    {
        $data = $request->all();
        if ($data['action']) {

            if ($data['action'] == 'city') {
                $output = '';
                $allDistrict = District::where('matp', $data['matp'])->orderby('maqh', 'ASC')->get();
                $output .= '<option>---Chọn quận huyện---</option>';
                foreach ($allDistrict as $key => $province) {
                    $output .= '<option value="' . $province->maqh . '">' . $province->name_quanhuyen . '</option>';
                }
            } else {
                $output = '';
                $select_wards = Ward::where('maqh', $data['matp'])->orderby('xaid', 'ASC')->get();
                $output .= '<option>---Chọn xã phường---</option>';
                foreach ($select_wards as $key => $ward) {
                    $output .= '<option value="' . $ward->xaid . '">' . $ward->name_xaphuong . '</option>';
                }
            }
            echo $output;
        }
    }

    public function count_fee(Request $request)
    {
        $data = $request->all();
        if ($data['matp']) {
            $feeship = FeedShip::where('fee_matp', $data['matp'])->where('fee_maqh', $data['maqh'])->where('fee_xaid', $data['xaid'])->get();
            Session::put('fee_matp', $data['matp']);
            Session::put('fee_maqh', $data['maqh']);
            Session::put('fee_xaid', $data['xaid']);
            if ($feeship) {
                $count_feeship = $feeship->count();
                if ($count_feeship > 0) {
                    foreach ($feeship as $key => $fee) {
                        Session::put('fee', $fee->fee_feeship);
                        Session::save();
                    }
                } else {
                    Session::put('fee', 25000);
                    Session::save();
                }
            }

        }
    }

}

