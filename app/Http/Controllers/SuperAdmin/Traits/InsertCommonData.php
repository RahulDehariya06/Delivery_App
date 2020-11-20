<?php
namespace App\Http\Controllers\SuperAdmin\Traits;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

trait InsertCommonData
{
	//Insert data in user table

	public function InsertUser($request,$type){

		
		//upload users profile pic
       
        $file=file_upload($request);

         //Get User Detils
        $user=new User;

        $user->name=$request->input('name');
        $user->email=$request->input('email');
        $user->phone=$request->input('phone');
        $user->dob=$request->input('dob');
        $user->user_type=$type;
        $user->status=$request->input('status');
        //create token
        $email_token=Str::random(64);
        $phone_token=Str::random(64);

        // Email verification key generation
        $user->email_token=$email_token;
        // Mobile verification key generation
        $user->phone_token=$phone_token;


        $user->photo=$file;

        //save User
        $user->save();

        return $user->id;

	}

    public function UpdateUser($request,$user_id){

        $user=User::find($user_id);

        $user->name=$request->input('name');
        $user->email=$request->input('email');
        $user->phone=$request->input('phone');
        $user->name=$request->input('name');
        $user->dob=$request->input('dob');
        $user->status=$request->input('status');

         
        // //Update user Details
         $res=$user->save();

        return $res;

    }

    
	//Insert data in Address table

	public function InsertAddress($request,$id,$type){

		//Get address

		$address=new Address;
        $address->country=$request->input('country');
        $address->state=$request->input('state');
        $address->city=$request->input('city');
        $address->pincode=$request->input('zip');
        $address->landmark=$request->input('landmark');
        $address->address=$request->input('address');
        $address->default=1;
        $address->status=$request->input('status');
        $address->type=$type;
        $address->store_id=0;
        $address->user_id=$id;
        $address->lat=$request->input('lat');
        $address->lon=$request->input('long');
       
        //Add store address
        $address->save();

        return $address->id;

	}
   public function UpdateAddressDetails($request,$address_id){
        //Get address
        //Array for update address

        $addressArr=[
            'country'=>$request->input('country'),
            'state'=>$request->input('state'),
            'city'=>$request->input('city'),
            'pincode'=>$request->input('zip'),
            'landmark'=>$request->input('landmark'),
            'address'=>$request->input('address'),
            'default'=>1,
            'status'=>$request->input('status'),
            'store_id'=>0,
            'lat'=>$request->input('lat'),
            'lon'=>$request->input('long')
        ];
       
        //Update user Address
         $res=Address::where('id',$address_id)->update($addressArr);

        return $res;

    }


}

