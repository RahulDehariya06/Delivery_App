<?php
namespace App\Http\Controllers\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

trait FormValidation
{

	public function ValidLogin(Request $request){

		$validator = Validator::make($request->all(), [
            'login' => 'required|',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
        	 return redirect('/login')
                        ->withErrors($validator)
                        ->withInput();
        }
       

	}

}
