<?php

namespace App\Http\Controllers\SuperAdmin\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Stores;
use App\Models\PasswordReset;
use Illuminate\Http\Request;
use App\Rules\EmailRule;
use App\Http\Requests\LoginRequest;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Notifications\ResetPasswordNotification;
use App\Notifications\PasswordResetSuccess;
use App\Notifications\UserActivated;
use App\Events\UserWasLogged;
use Illuminate\Support\Facades\Event;
use Carbon;



class LoginController extends Controller
{
	use AuthenticatesUsers;

    /**
	 * Show the application login form.
	 *
	 * @return \Illuminate\Http\RedirectResponse|mixed
	 */
    protected $maxAttempts = 5;
    // The number of minutes to throttle for
	protected $decayMinutes = 15;

     public function showLoginForm(Request $request){
     	// Remembering Login
		

		if(Auth::user() ){
				return redirect('superAdmin/dashboard');
		}

     	return view('superadmin.auth.login');
     }

     /**
	 * @param LoginRequest $request
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|void
	 * @throws \Illuminate\Validation\ValidationException
	 */

	 public function login(Request $request){
       
 	    
		$validator = Validator::make($request->all(), [
            'login' => 'required|',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
        	 return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }


        // echo  Hash::make($request->input('password'));die;


        // If the class is using the ThrottlesLogins trait, we can automatically throttle
		// the login attempts for this application. We'll key this by the username and
		// the IP address of the client making these requests into this application.

        if ($this->hasTooManyLoginAttempts($request)) {
			$this->fireLockoutEvent($request);
			
			return $this->sendLockoutResponse($request);
		}

       //Get Right login field
		$loginField=$this->getLoginField($request->input('login'));

       // Get credentials values
			$credentials = [
				$loginField => $request->input('login'),
				'password'  => $request->input('password'),
			];


			// Auth the User
		if (auth()->attempt($credentials)) {
			 $user=User::where('email',$request->input('login') )->first();
            
			  if($user){

             
           // Check DB password with input password
    		 if(Hash::check($request->input('password'), $user->password)){

                // Update last user logged Date
                Event::dispatch(new UserWasLogged($user));
                
                if($user->is_admin==1){

    		 	  return redirect('superAdmin/dashboard');
                }
                elseif($user->user_type==2) {

                     $store=Stores::where('user_id',$user->id)->first();

                    
                    session(['store_id'=>$store->id]);
                     return redirect('StoreOwner/dashboard');
                }
                else
                {
                     return redirect()->back()->with('error', 'Inavalid email and password')->withInput();
                }

    		 }
    		 return redirect()->back()->with('error', 'Password not matched')->withInput();;
    		}
            else{
                return redirect()->back()->with('error', 'Inavalid email and password')->withInput();
            }

		}
		

		// If the login attempt was unsuccessful we will increment the number of attempts
		// to login and redirect the user back to the login form. Of course, when this
		// user surpasses their maximum number of attempts they will get locked out.
		 // $this->incrementLoginAttempts($request);

		return redirect()->back()->with('error', 'Inavalid email and password');


	 }

    /**
     * Show forgot password form.
     *
     * @param ForgotPasswordRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */

	 public function showLinkRequestForm(){

	 	return view('superadmin.auth.password.email');
	 }
	 

    /**
     * Send a reset link to the given user.
     *
     * @param ForgotPasswordRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */

	 public function sendResetPasswordEmail(Request $request){

	 	$validator = Validator::make($request->all(), [
            'login' => 'required|',
           
        ]);

        if ($validator->fails()) {
        	 return redirect('/email')
                        ->withErrors($validator)
                        ->withInput();
        }

        $field=$this->getLoginField($request->input('login'));
        $token=$request->input('_token');


        if($field=='email'){

        	$email=$request->input('login');
        	
        	// return redirect('/forgotPassword')->with('error', 'Please enter valid email address');
        }


        $user=User::where($field,$request->input('login'))->first();


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
        	 	 return redirect('/forgotPassword')->with('success', 'We have e-mailed your password reset link!.');

        	 }
        	 catch (\Exception $e) {
                            // flash($e->getMessage())->error();
                        return false;
               }


        }

        return redirect('/forgotPassword')->with('error', 'We cant find a user with that e-mail address.');

	 }
	/**
     * Display the password reset view for the given token.
     *
     * If no token is present, display the link request form.
     *
	 * @param \Illuminate\Http\Request $request
	 * @param null $token
	 * @return mixed
	 */
    public function showResetForm(Request $request, $token = null)
    {
        
        $passwordReset = PasswordReset::where('token', $token)->first();
        if (!$passwordReset){

             return view('superadmin.errors.400');
        }

       $data['token']=$token;
       return view('superadmin.auth.password.reset',$data);
    }


	  /**
     * Find token password reset
     *
     * @param  [string] $token
     * @return [string] message
     * @return [json] passwordReset object
     */

	 public function find($token)
    {
        $res=0;
        
        $passwordReset = PasswordReset::where('token', $token)
            ->first();
        if (!$passwordReset){
           
            if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()) {
                $passwordReset->delete();
               
            }
       }
       else{
        $res=1;
       }
        return $res;
    }

     /**
     * Reset password
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @param  [string] token
     * @return [string] message
     * @return [json] user object
     */
    public function reset(Request $request)
    {

    

    	
        $validator = Validator::make($request->all(), [ 
            'login' => 'required|string|email',
            'password' => 'required|string',
            'cpassword' => 'required|string|same:password'
        ]);

	    if ($validator->fails()) { 
	        return redirect()->back()->withInput()
                        ->withErrors($validator)
                        ->withInput();           
	    }

	    $token=$request->input('token');
	    $email=$request->input('login');



        $passwordReset = PasswordReset::where([
            ['token', $token],
            ['email', $email]
        ])->first();

        //Check Reset password token
        
        if (!$passwordReset)
           
         return redirect()->back()->with('error', 'This password reset token is invalid.');
         
        //find valid user           
        $user = User::where('email', $passwordReset->email)->first();
        if (!$user)  
        return redirect()->back()->with('error', 'We cant find a user with that e-mail address.');

    	//Update new password
        $user->password = Hash::make($request->input('password'));
        $user->save();

        //Delete entry from reset password
        $passwordReset->delete();

        $user->notify(new PasswordResetSuccess($passwordReset));
     	
     	 return redirect()->back()->with('success', 'Password Reset Success.');  
    }


	 public function getLoginField($field=""){
		if(!empty($field)){
			 if(is_numeric($field)){
			 	$field='phone';
			 }
			 else{
			 	$field='email';
			 }

			 return $field;
		}
	}

	/**
     * Logout user.
     *
     
     */

	public function logout(Request $request){
     
		Auth::logout();
		return view('superadmin.auth.login');

	}
    /**
     * Verify user with email token
     *
     
     */

     public function verification($token=NULL){


        if(empty($token)){
            return redirect()->back()->with('error', 'Invalid Request');  
        }

        $user=User::where('email_token', $token)->first();

        if($user){
            if($user->verified_email!=1){
               $user->email_token="";
               $user->verified_email=1;
               $user->save();

               $user->notify(new UserActivated($user));
               $data['response']='Welcome to '.config('app.name').' '.$user->name.'!';
            }
        }
        else{
             $data['response']='Invalid Request';
        }
         return view('superadmin.auth.verify',$data);
    }



}
