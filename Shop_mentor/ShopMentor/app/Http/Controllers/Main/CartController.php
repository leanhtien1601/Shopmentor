<?php


namespace App\Http\Controllers\Main;

use App\City;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class CartController extends Controller
{
    public function index(Request $request)
    {
        $product_id = $request->get('product_id');
        $quantity = $request->get('quantity');

        $product = DB::table('product')
            ->where('id', $product_id)
            ->first();
        $data['id'] = $product_id;
        $data['qty'] = $quantity;
        $data['name'] = $product->name;
        $data['price'] = $product->price;
        $data['weight'] = $product->price;
        $data['options']['image'] = $product->image;
        Cart::add($data);
        return redirect()->route('cart.show');

    }
    public function addCart(Request $request){
        $product_id =$request->get('id');
        $product = DB::table('product')
            ->where('id', $product_id)
            ->first();
        $data['id'] = $product_id;
        $data['qty'] = $request->get('qty');
        $data['name'] = $request->get('name');
        $data['price'] = $request->get('price');
        $data['weight'] = $request->get('price');
        $data['options']['image'] = $product->image;
        Cart::add($data);
    }

    public function showCart()
    {
        $allCity = City::orderby('matp', 'ASC')->get();
        return view('front-end.Cart.index',compact('allCity'));
    }

    public function deleteCart($id, Request $request)
    {
        Cart::update($id, 0);
        return redirect()->route('cart.show');
    }

    public function update(Request $request)
    {
        $rowId = $request->rowId_cart;
        $qty = $request->quantity;
        Cart::update($rowId, $qty);
        return redirect()->route('cart.show');
    }

    public function delete()
    {
        Cart::destroy();
        return redirect()->route('cart.show');
    }
    public function checkCode(Request $request){
        if ($request->isMethod('post')){
            $data=$request->get('code');
            $alCode = DB::table('coupon')
                ->where('code',$data)
                ->where('status',0)
                ->first();
            if($alCode){
                $dataCode['time'] = $alCode->time - 1;
                DB::table('coupon')->where('code','=',$data)->update($dataCode);
                $price_coupon = $alCode->price;
                $code = $alCode->code;
                Session::put('price_coupon',$price_coupon);
                Session::put('code',$code);
                $message = 'Nhập mã thành công';
                return redirect()->back()->with('message', $message);
            }else{
                $price_coupon = 0;
                Session::put('price_coupon',$price_coupon);
                $message = 'Nhập mã thất bại';
                return redirect()->back()->with('message', $message);
            }

        }

        return view('front-end.Cart.index');
    }

}

