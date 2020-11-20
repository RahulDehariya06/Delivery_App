<?php

namespace App\Http\Controllers\SuperAdmin\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\SuperAdmin\Traits\CommonTrait;

class OrderController extends Controller
{
	use CommonTrait;
    //
	 /**
	 *  List of Promocode
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
    public function index(){
    	//Get Order List
    	$data['orders']=$this->OrderList()->get();
    	return view('superadmin.order.index',$data);
    }
}
