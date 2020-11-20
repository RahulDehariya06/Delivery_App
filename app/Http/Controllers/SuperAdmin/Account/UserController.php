<?php

namespace App\Http\Controllers\SuperAdmin\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Address;
use App\Models\Picture;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\SuperAdmin\Traits\CommonTrait;
use App\Http\Controllers\SuperAdmin\Traits\InsertCommonData;

class UserController extends Controller
{
	use CommonTrait,InsertCommonData;
    protected $cacheExpiration=25;

    /**
	 * CreateController constructor.
	 */

    public function __construct(){
    	$this->middleware('auth');
    }
    /**
	 * Users List
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */

    public function index(Request $request){
    	//Get all users
    	$type=4;
    	$data['users']=$this->GetUsers($type);
    	return view('superadmin.users.index',$data);
    }

    public function UserProfile(Request $request,$user_id=""){
    	
    	if(empty($user_id)){
    		 return redirect()->back()->with('error', 'Invalid Request!'); 
    	}

 		 $type=4;
          $data['user']= $this->UserProfileData($type,$user_id);

    	//Return view
    	return view('superadmin.users.user',$data);
    }


	/**
	 * Register a new user account form.
	 *
	 * @param UserRequest $request
	 * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
     public function UserAddForm(){
     	return view('superadmin.users.add');
     }


	/**
	 * Register a new user account.
	 *
	 * @param UserRequest $request
	 * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */

	public function AddUser(Request $request){
		//Validate fields
    	$validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|unique:users,phone',
            'dob' => 'required|date',
            'address' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
        	 return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        //Proceed to core process
        //Insert details in user table
         $user_type=4;
         $user_id= $this->InsertUser($request,$user_type);

         $address_id=$this->InsertAddress($request,$user_id,$user_type);

         //Send Response
         if($user_id && $address_id){

          return redirect()->back()->with('success', 'Added successfully!.');
        }

         return redirect()->back()->with('error', 'Problem in  adding data!.');


	}
     /**
	 * Change User Status
	 *
	 * @return \Illuminate\Http\RedirectResponse|mixed
	 */

    public function ChangeUserStatus(Request $request,$user_id=""){
    	if(empty($user_id)){
    		 return redirect()->back()->with('error', 'Invalid Request!'); 
    	}


        $user=User::find($user_id);

        if($user->status==1){
            $user->status=0;
        }
        else{
            $user->status=1;
        }
        $res=$user->save();
        if($res){
             return redirect()->back()->with('success', 'User status updated successfully!.');
        }

    }
    /**
   * User Edit Form
   *
   * @param UserRequest $request
   * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
   */

    public function ShowUserEditForm(Request $request,$user_id=""){

      //Get User Details
      $type=4;
      $data['profile']=$this->UserProfileData($type,$user_id);

      

      // return view
      return view('superadmin.users.edit',$data); 

    }

    /**
     * Delete User Profile 
     *@param $user_id
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    public function UpdateUserDetails(Request $request){

      //Validate field
      $user_id=$request->input('user_id');
      $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user_id.',id',
            'phone' => 'required|unique:users,phone,'.$user_id.',id',
            'address' => 'required',
            'status' => 'required'
        ]);

        if ($validator->fails()) {
           return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $address_id=$request->input('address_id');
      
        // //Update user details
         $res_user=$this->UpdateUser($request,$user_id);

        // //Update address
        $res_address=$this->UpdateAddressDetails($request,$address_id);

          return redirect()->back()->with('success', 'Updated successfully!.');
  



    }

    /**
     * Update User Profile photo
     *@param $user_id
     * @return \Illuminate\Http\RedirectResponse|mixed
     */

    public function UpdateUserPhoto(Request $request){

      if($request->hasFile('file'))
       {
        //Upload file through helper
        $file=file_upload($request);

        //Get User id
        $user_id=$request->input('id');

        //Get User
        $user=User::find($user_id);
        if($user){
            $old_file=$user->photo;

            // $file_path=url('storage'.$old_file);

            $user->photo=$file;

            // unlink($file_path);
           $user->save();
            return redirect()->back()->with('success', 'Profile Updated successfully!.');
        }
       }
    }

    /**
     * Delete User Profile 
     *@param $user_id
     * @return \Illuminate\Http\RedirectResponse|mixed
     */

    public function RemoveUser(Request $request,$user_id=""){

    	if(empty($user_id)){
    		 return redirect()->back()->with('error', 'Invalid Request!'); 
    	}

    	$address=Address::where('user_id',$user_id)->where('type',4)->delete();

        $user = User::find($user_id);
        if($user){
          $user->delete();
           return redirect()->back()->with('success', 'User Romoved successfully!.');
        }

  
        return redirect()->back()->with('error', 'Please try again later!.'); 

    }

}
