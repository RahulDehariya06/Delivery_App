<?php

namespace App\Http\Controllers\SuperAdmin\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DispatcherController extends Controller
{
    //

    public function index(){
    	return view('superadmin.dispatcher.index');
    }
}
