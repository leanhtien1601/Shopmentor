<?php


namespace App\Http\Controllers\Main;

use App\BaseNews;
use App\Http\Controllers\Controller;
use App\WishList;
use Carbon\Carbon;
use Illuminate\Http\Request;


class WishListController extends Controller
{
    public function add(Request $request)
    {
        $data = $request->all();
        $wishList = new WishList();
        $wishList->users_id = $data['users_id'];
        $wishList->product_id = $data['id'];
        $wishList->quantity=1;
        $wishList->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $wishList->save();
    }

    public function show(){
        $allWish = WishList::all();

        return view('front-end.WishList.index',compact('allWish'));
    }

    public function delete($id){
        WishList::destroy($id);
        return redirect(route('wishlist.show'));
    }

}

