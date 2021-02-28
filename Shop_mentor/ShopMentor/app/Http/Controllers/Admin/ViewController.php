<?php


namespace App\Http\Controllers\Admin;


use App\View;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ViewController extends Controller
{

    public function updateView($id , Request $request){
        $view =View::where('product_id', $id)->first();
        $view->view +=1;
        $view->save();
    }
}
