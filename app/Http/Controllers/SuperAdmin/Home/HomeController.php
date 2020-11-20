<?php

namespace App\Http\Controllers\SuperAdmin\Home;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Stores;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
	/**
	 * Dashboard data
	 *
	 * @return \Illuminate\Http\RedirectResponse|mixed
	 */

	public function Dashboard(Request $request){

	}
  
}
