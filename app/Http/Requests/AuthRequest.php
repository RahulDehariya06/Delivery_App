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

class AuthRequest extends Request
{
	/**
	 * Prepare the data for validation.
	 *
	 * @return void
	 */
	protected function prepareForValidation()
	{
		
		$input = $this->all();
		
		// login (phone)
		if ($this->filled('login')) {
			$loginField = getLoginField($this->input('login'));
	
		}
		
		request()->merge($input); // Required!
		$this->merge($input);
	}
	
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'login' => ['required','email'],
        ];
    
        // reCAPTCHA
		$rules = $this->recaptchaRules($rules);
        
        return $rules;
    }
}
