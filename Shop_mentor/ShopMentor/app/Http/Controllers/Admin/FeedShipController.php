<?php

namespace App\Http\Controllers\Admin;

use App\City;
use App\District;
use App\FeedShip;
use App\Http\Controllers\Controller;
use App\Ward;
use Illuminate\Http\Request;


class FeedShipController extends Controller
{
    public function add()
    {
        $allCity = City::orderby('matp', 'ASC')->get();
        return view('back-end.FeedShip.add', compact('allCity'));
    }

    public function list(){
        $allShip = FeedShip::all();
        $allCity = City::all();
        $allDe = District::all();
        $allWard =Ward::all();
        return view('back-end.FeedShip.list',compact('allShip','allCity','allDe','allWard'));
    }
    public function selectCity(Request $request)
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

    public function insert(Request $request)
    {
        if($request->isMethod('post')){
            $fee_ship = new FeedShip();
            $fee_ship->fee_matp = $request->get('city');
            $fee_ship->fee_maqh = $request->get('district');
            $fee_ship->fee_xaid = $request->get('ward');
            $fee_ship->fee_feeship = $request->get('fee_feeship');
            $fee_ship->save();
        }

    }
}
