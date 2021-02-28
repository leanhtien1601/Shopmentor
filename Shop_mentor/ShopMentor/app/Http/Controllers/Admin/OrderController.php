<?php


namespace App\Http\Controllers\Admin;

use App\BaseOrder;
use App\BaseProduct;
use App\City;
use App\District;
use App\Http\Controllers\Controller;
use App\OrderDetail;
use App\Ward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;


class OrderController extends Controller
{
    public function index()
    {
        $allOrder = BaseOrder::all();
        $allCity = City::all();
        $allDis = District::all();
        $allWard = Ward::all();

        return view('back-end.Order.list', compact('allOrder', 'allCity', 'allWard', 'allDis'));
    }

    public function invoice($id)
    {
        $allOrder = OrderDetail::where('order_id', $id)->get();
        $product = DB::table('order')->where('id', $id)->first();
        return view('back-end.Invoice.invoice', compact('allOrder', 'id', 'product'));
    }

    public function print_invoice($id)
    {
        $allOrder = OrderDetail::where('order_id', $id)->get();
        $product = DB::table('order')->where('id', $id)->first();
        $pdf = PDF::loadView('back-end.Invoice.invoice_pdf', compact('allOrder', 'id', 'product'));
        set_time_limit (0);
        return $pdf->download('invoice.pdf');
//        return view('back-end.Invoice.invoice_pdf',compact('allOrder','id','product'));
    }

    public function statusVery($id, Request $request)
    {
        $data['status'] = 2;
        DB::table('order')->where('id', '=', $id)->update($data);

        $orderDetail = DB::table('order_detail')->where('order_id', $id)
            ->get();
        $product = BaseProduct::all();

        foreach ($orderDetail as $row) {
            foreach ($product as $k) {
                if ($row->product_id == $k->id) {
                    $dt['quantity'] = $k->quantity - $row->product_quantity;
                    DB::table('product')->where('id', '=', $row->product_id)->update($dt);
                }
            }

        }

        return redirect()->route('order.list');
    }

    public function statusFalse($id, Request $request)
    {
        $data['status'] = 3;
        DB::table('order')->where('id', '=', $id)->update($data);

        $orderDetail = DB::table('order_detail')->where('order_id', $id)
            ->get();
        $product = BaseProduct::all();

        foreach ($orderDetail as $row) {
            foreach ($product as $k) {
                if ($row->product_id == $k->id) {
                    $dt['quantity'] = $k->quantity + $row->product_quantity;
                    DB::table('product')->where('id', '=', $row->product_id)->update($dt);
                }
            }

        }

        return redirect()->route('order.list');
    }
}

