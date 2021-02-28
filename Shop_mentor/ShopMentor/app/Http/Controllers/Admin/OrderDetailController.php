<?php


namespace App\Http\Controllers\Admin;

use App\BaseOrder;
use App\Http\Controllers\Controller;
use App\OrderDetail;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;


class OrderDetailController extends Controller
{
    public function index($id){
        $allOrder = OrderDetail::where('order_id',$id)->get();

        return view('back-end.OrderDetail.list',compact('allOrder'));
    }

}

