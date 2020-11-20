<?php

namespace App\Http\Controllers\SuperAdmin\Account;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Address;
use App\Models\Picture;
use App\Models\Delivery_boy;
use App\Helpers\Fileupload;
use Illuminate\Http\Request;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\SuperAdmin\Traits\InsertCommonData;
use App\Http\Controllers\SuperAdmin\Traits\CommonTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class DeliveryBoyController extends Controller
{
	use InsertCommonData,CommonTrait;
    protected $cacheExpiration=25;

    /**
	 * CreateController constructor.
	 */
    public function __construct(){
    	$this->middleware('auth');
    }

     /**
     * Delivery boy List
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
    	$perpage=10;
    	//Fetch all delivery boy list
    	
               // ->get();
              
               $data['details']= $this->DeliveryBoyList()->paginate($perpage);



    	return view('superadmin.delivery_boy.list',$data);
    }
     /**
	 * Get Add form
	 *
	 * @return \Illuminate\Http\RedirectResponse|mixed
	 */

    public function ShowdeliveryBoyAddForm(){
    	return view('superadmin.delivery_boy.add');
    }

    /**
	 *  Add Delivery boy
	 *	@form data
	 * @return \Illuminate\Http\RedirectResponse|mixed
	 */

    public function AddDeliveryBoy(Request $request){
    	//Validate fields

    	$validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|unique:users,phone',
            'dob' => 'required|date',
            'bike_no' => 'required',
            'licence_no' => 'required',
            'front_licence' => 'required|mimes:jpeg,png,jpg',
            'back_licence' =>  'required|mimes:jpeg,png,jpg',
            'address' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
        	 return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        //Insert details in user table
         $user_type=5;
         $user_id= $this->InsertUser($request,$user_type);

         $address_id=$this->InsertAddress($request,$user_id,$user_type);

        //Upload Driver licence Images
        $licence_front_img=LicenceFront($request);
        $licence_back_img=LicenceBack($request);

      
        //Get Delivery boy data
        $driver=new Delivery_boy;

        $driver->user_id=$user_id;
        $driver->address_id=$address_id;
        $driver->bike_no=$request->input('bike_no');
        $driver->licence_no=$request->input('licence_no');
        $driver->licence_front_img=$licence_front_img;
        $driver->licence_back_img=$licence_back_img;
        $driver->status=$request->input('status');
        $driver->approved=1;
        //Save driver details
        $res=$driver->save();

        if($res){
        	 return redirect()->back()->with('success', 'Added successfully!.');
        }

         return redirect()->back()->with('error', 'Problem in  adding data!.');

    }
     /**
	 *   Delivery boy profile
	 *	@id
	 * @return \Illuminate\Http\RedirectResponse|mixed
	 */

    public function DeliveryBoyDetail(Request $request,$id=null){

    	$cacheId='deliveryboy'.$id.'delivery_boy.details';

    	//Get Delivery boy profile

    	$data['profile']=Cache::remember($cacheId,$this->cacheExpiration,function()use($id){
    		 $query=DB::table('delivery_boy')
		               ->select('delivery_boy.*','address.*','users.name','users.dob','users.photo','users.phone','users.email')
		               ->Join('address',function($join)
                        {
                            $join->on( 'delivery_boy.address_id', '=', 'address.id');
                            $join->on('address.type', '=', DB::raw("5"));
                        });
		              $query->Join('users', 'users.id', '=', 'delivery_boy.user_id')
		                  ->where('delivery_boy.id', $id);

		     return $data['profile'] = $query->first();
    	});
    	return view('superadmin.delivery_boy.details',$data);
    }

     /**
     *  Edit Delivery boy profile form
     *  @id
     * @return \Illuminate\Http\RedirectResponse|mixed
     */

    public function EditDeliveryBoyForm(Request $request,$id=NULL){
        //Get delivery boy profile
         $query=DB::table('delivery_boy')
                   ->select('delivery_boy.*','delivery_boy.id as delivery_boy_id','address.*','users.name','users.photo','users.phone','users.email','users.dob','users.id as user_id')
                   ->Join('address',function($join)
                    {
                        $join->on( 'delivery_boy.address_id', '=', 'address.id');
                        $join->on('address.type', '=', DB::raw("5"));
                    });
                    $query->Join('users', 'users.id', '=', 'delivery_boy.user_id')
                           ->where('delivery_boy.id', $id);

                 $data['profile'] = $query->first();

        return  view('superadmin.delivery_boy.edit',$data);
    }

     /**
     *  Update Delivery boy profile
     *  @id
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    public function UpdateDeliveryBoy(Request $request){
        //Validate fields

        $user_id=$request->input('user_id');
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user_id.',id',
            'phone' => 'required|unique:users,phone,'.$user_id.',id',
           
            'bike_no' => 'required',
            'licence_no' => 'required',  
            'address' => 'required',
        ]);

        if ($validator->fails()) {
             return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
     

        $delivery_boy_id=$request->input('delivery_boy_id');
        $address_id=$request->input('address_id');

        
        //Update user details
        $res_user=$this->UpdateUser($request,$user_id);

        //Update address
        $res_address=$this->UpdateAddressDetails($request,$address_id);

        //Get Delivery boy data
       
        $driverArr=[
            'bike_no'=>$request->input('bike_no'),
            'licence_no'=>$request->input('licence_no'),
            'status'=>$request->input('status')
        ];

        $frontArr=[];
        $backArr=[];

        //Upload Driver licence Images
         if($request->hasFile('front_licence')){

            $licence_front_img=LicenceFront($request);

            $frontArr=[
                'licence_front_img'=>$licence_front_img
            ];
         }

         if($request->hasFile('back_licence')){

           $licence_back_img=LicenceBack($request);

           $backArr=[
            'licence_back_img'=>$licence_back_img
           ];
         }
         //merge array with front and back licence images
         $dataArr=array_merge($driverArr,$frontArr,$backArr);
        //Update Delivery Boy Details
         $res=Delivery_boy::where('id',$delivery_boy_id)->update($dataArr);

         //Send response
          if($res){
             return redirect()->back()->with('success', 'Updated successfully!.');
         }

         return redirect()->back()->with('error', 'Problem in  Updating data!.');
    }
    /**
     * Update Delivery boy photo
     *
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */


    public function UpdateDeliveryBoyPhoto(Request $request){
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
     * Change Delivery boy status
     *
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */

    public function ChangeDriverStatus(Request $request,$id=""){
        if(empty($id))
        {
            return redirect()->back()->with('error', 'Invalid Request.');
        }

        $delivery_boy=Delivery_boy::find($id);

        if($delivery_boy->status==1){
            $delivery_boy->status=0;
        }
        else{
            $delivery_boy->status=1;
        }
        $res=$delivery_boy->save();
        if($res){
             return redirect()->back()->with('success', 'Status updated successfully!.');
        }

    }
    /**
     * Delete Delivery boy
     *
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */

    public function DeleteDeliveryBoy(Request $request,$id="",$address_id=""){
        if(empty($id)){
            return redirect()->back()->with('error', 'Invalid Request!'); 
        }
        //Delete adddress of delivery boy

        $address=Address::where('id',$address_id)->where('type',5)->delete();

        //Delete details of delivery boy
        $driver=Delivery_boy::where('user_id',$id)->delete();

        //Delete from User table
        $user = User::where('id',$id)->where('user_type',5)->delete();

        //Send response
          if($user){
             return redirect()->back()->with('success', 'Removed successfully!.');
         }

         return redirect()->back()->with('error', 'Problem in  Removing data!.');
       

    }
}
