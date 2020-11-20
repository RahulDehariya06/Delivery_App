<?php
/**
 * LaraClassified - Classified Ads Web Application
 * Copyright (c) BedigitCom. All Rights Reserved
 *
 * Website: http://www.bedigit.com
 *
 * LICENSE
 * -------
 * This software is furnished under a license and may be used and copied
 * only in accordance with the terms of such license and with the inclusion
 * of the above copyright notice. If you Purchased from Codecanyon,
 * Please read the full License from here - http://codecanyon.net/licenses/standard
 */

namespace App\Http\Requests;


use App\Rules\BetweenRule;
use App\Rules\BlacklistDomainRule;
use App\Rules\BlacklistEmailRule;
use App\Rules\EmailRule;
use App\Rules\UsernameIsAllowedRule;
use App\Rules\UsernameIsValidRule;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Routing\Router;
use Illuminate\Config\Repository;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class UserRequest extends Request
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		if (in_array($this->method(), ['POST', 'CREATE'])) {
			return true;
		} else {
			return auth()->check();
		}
	}
	
	/**
	 * Prepare the data for validation.
	 *
	 * @return void
	 */
	protected function prepareForValidation()
	{
		// Don't apply this to the Admin Panel
		// if (isFromAdminPanel()) {
		// 	return;
		// }
		
		
	}
	
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @param \Illuminate\Routing\Router $router
	 * @param \Illuminate\Filesystem\Filesystem $files
	 * @param \Illuminate\Config\Repository $config
	 * @return array
	 */
	public function rules(Router $router, Filesystem $files, Repository $config)
	{
		$rules = [];
		
		// CREATE
		if (in_array($this->method(), ['POST', 'CREATE'])) {
			$rules = $this->storeRules($router, $files, $config);
		}
		
		// UPDATE
		if (in_array($this->method(), ['PUT', 'PATCH', 'UPDATE'])) {
			$rules = $this->updateRules($router, $files, $config);
		}
		
		return $rules;
	}
	
	/**
	 * @param $router
	 * @param $files
	 * @param $config
	 * @return array
	 */
	private function storeRules($router, $files, $config)
	{
		$rules = [
				
				'name'      => 'required|max:100',
				'email'     => 'required|max:100|email|unique:users,email',
				'phone'     => 'required|max:20|unique:users,phone',
				'password'	=> 'required|dumbpwd',
				'password_confirmation'=>'required|same:password',
				'dob' 		=> 'required|date',
				'country'  => 'required',
				'state'  => 'required',
				'city'  => 'required',
				'pincode'  => 'required',
				'address'  => 'required'
			];
		
		return $rules;
	}
	
	/**
	 * @param $router
	 * @param $files
	 * @param $config
	 * @return array
	 */
	
}
