<?php

namespace App\Http\Controllers\SuperAdmin\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\SuperAdmin\Traits\CommonTrait;

class RequestController extends Controller
{
	use CommonTrait;
    //
     protected $cacheExpiration=25;
     /**
	 *  List of Promocode
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */

	 public function index(){
	 		$where='approved';
	 		//Get requested stores list
	 		$data['stores']=$this->StoreList($where)->get();
	 		$data['delivery_boy']=$this->DeliveryBoyList($where)->get();
	 		return view('superadmin.request.index',$data);
	 }
}
