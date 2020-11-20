<?php

namespace App\Http\Controllers\SuperAdmin\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Address;
use App\Models\Picture;
use App\Models\Orders;
use App\Helpers\Fileupload;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PasswordReset;
use App\Events\UserWasLogged;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\LoginRequest;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Event;
use App\Notifications\EmailVerification;
use App\Notifications\UserActivated;
use App\Helpers\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use App\Notifications\PasswordResetSuccess;
use App\Http\Requests\ForgotPasswordRequest;
use App\Notifications\ResetPasswordNotification;
use App\Http\Controllers\SuperAdmin\Traits\CommonTrait;

class UserController extends Controller
{

	use AuthenticatesUsers;

	protected $maxAttempts = 5;
	// The number of minutes to throttle for
	protected $decayMinutes = 5;


	/**
	 * @param LoginRequest $request
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|void
	 * @throws \Illuminate\Validation\ValidationException
	 */
    //
    public function login(LoginRequest $request){

    	// If the class is using the ThrottlesLogins trait, we can automatically throttle
		// the login attempts for this application. We'll key this by the username and
		// the IP address of the client making these requests into this application.
		if ($this->hasTooManyLoginAttempts($request)) {
			$this->fireLockoutEvent($request);
			
			return response()->json(['status'=>'404','msg'=>'Max time login attempts please wait some time']);
		}

		// Get the right login field
		$loginField = getLoginField($request->input('login'));

		// Get the right login field
		$user=User::where($loginField,$request->input('login') )->first();

		if($user){
			 // Check DB password with input password
			if(Hash::check($request->input('password'),$user->password)){
				 // Get credentials values
				if($user->user_type==4){

				if($user->verified_email!=0){

				
					$credentials = [
						$loginField => $request->input('login'),
						'password'  => $request->input('password'),
					];

					if(auth::attempt($credentials)){

					// Update last user logged Date
				    	Event::dispatch(new UserWasLogged($user));

				    	$user->photo=imgUrl($user->photo);

				    	// Send  normal users response
					  $token = $user->createToken('authToken')->accessToken;

		               return response()->json(['status'=>'200','message'=>'Logged in successfully','record'=>$user,'token'=>$token]);
					}
				 }
				 //Verification account error response
				 return response()->json(['status'=>'404','message'=>'Please Activate Your account']);
				}

				return response()->json(['status'=>'404','message'=>'These credentials do not match our records']);
			}
			return response()->json(['status'=>'404','message'=>'These credentials do not match our records']);
		 
	}
	  return response()->json(['status'=>'404','message'=>'These credentials do not match our records ']);

    }

	 /**
	 * Register a new user account.
	 *
	 * @param UserRequest $request
	 * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */

    public function register(UserRequest $request){

    	//Get user model
    	$user = new User();

    	//Fetching fields fields for User
    	$user->name=$request->input('name');
        $user->email=$request->input('email');
        $user->password=  Hash::make($request->input('password'));
        $user->phone=$request->input('phone');
        $user->dob=$request->input('dob');
        $user->user_type=4;
        $user->status=0;
        //create token
        $email_token=Str::random(64);
        $phone_token=Str::random(64);

        // Email verification key generation
        $user->email_token=$email_token;
        // Mobile verification key generation
        $user->phone_token=$phone_token;

        //Upload file
        $photo=file_upload($request);

        $user->photo=$photo;

        // Save
		$res=$user->save();

		// Get Inserted Id
		$user->id;

		//Address Data

		$address=new Address;
		//Fetching fields fields for Address
		$street_number=$request->input('street_number');
		$route=$request->input('route');

		$address->country=$request->input('country');
        $address->state=$request->input('state');
        $address->city=$request->input('city');
        $address->pincode=$request->input('pincode');
        $address->landmark=$request->input('landmark');
        $address->lat=$request->input('lat');
        $address->lon=$request->input('long');
        $address->address=$request->input('address');
        $address->default=1;
        $address->status=1;
        $address->type=4;
        $address->user_id=$user->id;
       
        //Add store address
        $address->save();

		if($user->verified_email==0){

		  // Send Verification Link by Email
			$user->notify(new EmailVerification($user));

		}

		//AccessToken
         $token = $user->createToken('authToken')->accessToken;
         $user->photo=imgUrl($user->photo);

         if($res){
         	 // Send response
			return response()->json(['status'=>'200','message'=>'Your account has been created','record'=>$user,'token'=>$token]);
         }
    }

    /**
     * Send a reset link to the given user.
     *
     * @param ForgotPasswordRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function forgotPassword(ForgotPasswordRequest $request){

    	//Get login field
    	$field=getLoginField($request->input('login'));
    	//Find User
    	$user=User::where($field,$request->input('login'))->first();
    	 //create token
        $token=Str::random(64);

    	if($user){

    		$passwordReset = PasswordReset::updateOrCreate(
	            ['email' => $user->email],
	            [
	                'email' => $user->email,
	                'token' => $token
	             ]
	        );

	         try{
        	 	  $user->notify(new ResetPasswordNotification($user,$token,$field));

        	 	 //Send success Message
        	 	 return  response()->json(['status'=>'200','message'=>'We have e-mailed your password reset link!.Please check your email']);

	        	 }
	        	 catch (\Exception $e) {
	                            // flash($e->getMessage())->error();
	                        return false;
	              }


    	}
    	else{
    		//Send error response
    	 return $res=response()->json(['status'=>'404','message'=>'We can not find a user with that '.$field.'  address']);

    	}
    }

     /**
     * Logout user.
     *
     
     */
     
    public function logoutUser(){
       
        $user = Auth::user()->token();
        $user->revoke();
        return response()->json(['status'=>'200','message'=>'You have been logged out. See you soon.']);
    }


}
