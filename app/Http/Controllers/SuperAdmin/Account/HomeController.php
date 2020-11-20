<?php

namespace App\Http\Controllers\SuperAdmin\Account;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Stores;
use App\Models\Address;
use App\Models\Picture;
use App\Models\Orders;
use App\Helpers\Fileupload;
use Illuminate\Http\Request;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use App\Http\Controllers\SuperAdmin\Traits\CommonTrait;

class HomeController extends Controller
{
    use CommonTrait;
    protected $cacheExpiration=15;

    public function __construct(){
    	$this->middleware('auth');
    }

    /**
	 * Dashboard data
	 *
	 * @return \Illuminate\Http\RedirectResponse|mixed
	 */


    public function index(Request $request){
      //get count of stores
      $data['stores']=Stores::with('stores')->get()->count();

      //Count of app user
       $data['users']=User::with('users')->where('user_type',4)->get()->count();

       $data['orders']=Orders::with('orders')->get()->count();
      

       // print_r($data);die;
    	return view('superadmin.admin.dashboard',$data);
    }

    /**
	 * Get All Users
	 *
	 * @return \Illuminate\Http\RedirectResponse|mixed
	 */

    public function Stores(Request $request){

        $perpage=8;
        $page_no = (isset($input['page']))?$input['page']:1;
        //Fetch all stores 
        $data['stores'] =$this->StoreList()->paginate($perpage);

    	return view('superadmin.Stores.stores',$data);
    }

    /**
	 * Add Stores Form
	 *
	 * @return \Illuminate\Http\RedirectResponse|mixed
	 */
    public function AddStoreForm(Request $request){

    	return view('superadmin.Stores.addstore');
    }


    /**
	 * Add Stores
	 *
	 * @return \Illuminate\Http\RedirectResponse|mixed
	 */

    public function AddStore(Request $request){

    	// Apply validation on fields

    	$validator = Validator::make($request->all(), [
            'user_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|unique:users,phone',
            'dob' => 'required|date',
            'store_name' => 'required',
            'started_on' => 'required|date',
            'open_time' => 'required',
            'close_time' => 'required',
            'description' => 'required',
            'address' => 'required',
            'status' => 'required',
            'max_delivery_time' => 'required',
        ]);

        if ($validator->fails()) {
        	 return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        
        //upload users profile pic
       
          $file=file_upload($request);

      
          $store_images=[];
        //Add store images

        if($request->hasFile('store')) {
         
            $store_images=multifileUploder($request);

        }

        //Get User Detils

        $user=new User;

        $user->name=$request->input('user_name');
        $user->email=$request->input('email');
        $user->phone=$request->input('phone');
        $user->dob=$request->input('dob');
        $user->user_type=2;
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

        //Get user inserted id
        $user_id=$user->id;
       
        //
        $store= new Stores;

        $store->store_name=$request->input('store_name');
        $store->phone=$request->input('phone');
        $store->parent_id=0;
        $store->user_id=$user_id;
        $store->description=$request->input('description');
        
        $store->started_at=$request->input('started_on');
        $store->store_open_time=$request->input('open_time');
        $store->store_close_time=$request->input('close_time');
        $store->max_delivery_time=$request->input('max_delivery_time');
        $store->approved=1;
        $store->status=$request->input('status');

        //Save store data
        $store->save();

        //Get Inserted Id
        $store_id=$store->id;
       

        $address=new Address;

        $address->country=$request->input('country');
        $address->state=$request->input('state');
        $address->city=$request->input('city');
        $address->pincode=$request->input('zip');
        $address->landmark=$request->input('landmark');
        $address->address=$request->input('address');
        $address->default=1;
        $address->status=$request->input('status');
        $address->type=1;
        $address->store_id=$store_id;
        $address->lat=$request->input('lat');
        $address->lon=$request->input('long');
       
        //Add store address
        $address->save();

        //Insert store Image
        if(count($store_images)>0){
            foreach ($store_images as  $images) {
                
                $picture=new Picture;
                $picture->key_id=$store_id;
                $picture->type=1;
                $picture->filename=$images;
                $picture->save();
            }

        }

        if($store){
             return redirect()->back()->with('success', 'Store added successfully!.');
        }

        return redirect()->back()->with('error', 'Problem in  added store!.');

    }


    /**
     * Edit Stores
     *
     * @return \Illuminate\Http\RedirectResponse|mixed
     */

    public function ShowEditstoreForm(Request $request,$storeId=NULL){

        if(empty($storeId)){
             return redirect()->back()->with('error', 'Invalid request.');
        }

        $cacheId='store'.$storeId;

        $data['store']=Cache::remember($cacheId,$this->cacheExpiration,function()use($storeId){
            
            return $data['store']=Stores::with('address')->find($storeId);

            
        });

        foreach ($data['store'] as  $value) {
              $picture=Picture::where('key_id',$storeId)->where('type','1')->get();
           }
        
          $data['picture']=$picture;




        return view('superadmin.Stores.editstore',$data);
    }
    /**
     * Edit Store
     *
     * @return \Illuminate\Http\RedirectResponse|mixed
     */

    public function EditStore(Request $request){
        //Apply validation on fields

        $validator = Validator::make($request->all(), [
            
            'store_name' => 'required',
            'started_on' => 'required|date',
            'open_time' => 'required',
            'close_time' => 'required',
            'description' => 'required',
            'address' => 'required',
        ]);

        if ($validator->fails()) {
             return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $storeId=$request->input('storeId');

        //Check image update
        $store_images=[];
        if($request->hasFile('store')) {
            $store_images=multifileUploder($request);
        }

        $store = Stores::find($storeId);

        $store->store_name=$request->input('store_name');
        $store->description=$request->input('description');
        $store->started_at=$request->input('started_on');
        $store->store_open_time=$request->input('open_time');
        $store->store_close_time=$request->input('close_time');
        $store->max_delivery_time=$request->input('max_delivery_time');
        $store->approved=1;
        $store->status=$request->input('status');

        $address=$request->input('address');
        
        if($address){
        
        $addressArr=[
                'country'=>$request->input('country'),
                'state'=>$request->input('state'),
                'city'=>$request->input('city'),
                'pincode'=>$request->input('zip'),
                'landmark'=>$request->input('landmark'),
                'address'=>$request->input('address'),
                'default'=>1,
                'status'=>$request->input('status'),
                'lat'=>$request->input('lat'),
                'lon'=>$request->input('long')
            ];

          $res=Address::where('store_id',$storeId)->update($addressArr);

          //Update Images

          if(count($store_images)>0){
                $deltePicture=Picture::where('key_id', $storeId)->where('type','1')->delete();

             foreach ($store_images as  $images) {  
                $picture=new Picture;
                $picture->key_id=$storeId;
                $picture->type=1;
                $picture->filename=$images;
                $picture->save();
            }

        }


        }

      
        $res=$store->save();

        if($res){
             return redirect()->back()->with('success', 'Store updated successfully!.');
        }

        return redirect()->back()->with('error', 'Unable to update please try again!.');

    }

    /**
     * Get Store Details
     *@param $storeId
     * @return \Illuminate\Http\RedirectResponse|mixed
     */

    public function GetStoreDetails(Request $request,$storeId){
        if(empty($storeId)){
            return redirect()->back()->with('error', 'Invalid Request!.');
        }   
        //Get store details
        $cacheId='store'.$storeId.'GetStoreDetails.details';

        $data['store']=Cache::remember($cacheId,$this->cacheExpiration,function()use($storeId){
            
      return  $data['store']=  DB::table('stores')
                   ->select('stores.*','address.address','users.name' ,'users.email' ,'users.phone','picture.filename as store_image')
                   ->Join('address', 'stores.id', '=', 'address.store_id')
                   ->Join('users', 'users.id', '=', 'stores.user_id')
                   ->leftJoin('picture', 'stores.id', '=', 'picture.key_id')
                   ->where('stores.id',$storeId )
                   ->first();

        });

       
           foreach ($data['store'] as  $value) {
              $picture=Picture::where('key_id',$storeId)->where('type','1')->get();
           }
        
          $data['picture']=$picture;

          // echo "<pre>";
          // print_r($data);die;


    
        return view('superadmin.Stores.store',$data);

    }
     /**
     * Delete Store 
     *@param $storeId
     * @return \Illuminate\Http\RedirectResponse|mixed
     */

    public function DeleteStore(Request $request,$storeId=""){
        if(empty($storeId)){
            return redirect()->back()->with('error', ' Please try again later!.');
        }

        $address=Address::where('store_id',$storeId)->delete();

        $store = Stores::find($storeId);
         $store->delete();

     
        if($store){
             return redirect()->back()->with('success', 'Store updated successfully!.');
        } 
        return redirect()->back()->with('error', 'Unable to update please try again!.');          
    }
     /**
     * Change store status 
     *@param $storeId
     * @return \Illuminate\Http\RedirectResponse|mixed
     */

    public function ChangeStoreStatus(Request $request,$storeId=NULL){
        if(empty($storeId))
        {
            return redirect()->back()->with('error', 'Invalid Request.');
        }

        $store=Stores::find($storeId);

        if($store->status==1){
            $store->status=0;
        }
        else{
            $store->status=1;
        }
        $res=$store->save();
        if($res){
             return redirect()->back()->with('success', 'Store status updated successfully!.');
        }

    }


}
