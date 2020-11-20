<?php

namespace App\Http\Controllers\StoreOwner;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Stores;
use App\Models\Address;
use App\Models\Orders;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;


class StoreHomeController extends Controller
{
    //
    /**
	 * Dashboard data
	 *
	 * @return \Illuminate\Http\RedirectResponse|mixed
	 */
    public function index(){
    	
    	return view('storeowner.home.dashboard');
    }
}
