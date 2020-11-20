<?php
namespace App\Http\Controllers\SuperAdmin\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Address;
use App\Models\Picture;
use App\Models\Promocode;
use App\Models\Banner;
use App\Models\Delivery_boy;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;


trait CommonTrait
{

	//Get User Details
	public function GetUsers($type,$user_id=""){
		
		 $query=User::where('user_type',$type);
				if($user_id){
					$query->where('id',$user_id);	
				}
				$query->orderBy('id', 'DESC');
			return	$query->get();
	}

	public function UserProfileData($type,$user_id=""){

		 $query=DB::table('users')
                  ->select('users.*','address.*','users.status as user_status','users.id as user_id','address.id as address_id')
                  ->Join('address',function($join)use($type)
	                {
	                    $join->on( 'users.id', '=', 'address.user_id');
	                    $join->on('address.type', '=', DB::raw("'".$type."'"));
	                });
                  $query ->where('users.id',$user_id);
          return $query->first();
	}

	//Get prmocode details

	public function PromocodeDetails($code_id,$type=""){
		//get Details
		return Promocode::where('id',$code_id)->get();
	}

	//Get banner details

	public function BannerDetails($banner_id="",$type=""){
		//get Details
		$query=DB::table('banner')
				 ->select('banner.*','stores.store_name')
				 ->Join('stores','stores.id','banner.shop');
				 if($banner_id){
				 	$query->where('banner.id',$banner_id);
				 return $query->first();	
				 }
				return $query->get();
	}

	//Get Store list

	public function StoreList($where=""){
		 $query= DB::table('stores')
               ->select('stores.*','address.address','users.name' )
               ->Join('address', 'stores.id', '=', 'address.store_id')
               ->Join('users', 'users.id', '=', 'stores.user_id')
               ->orderBy('stores.id', 'DESC');

               if($where){
               	 $query->where($where,0);
               }

         return $query;
	}

	//Delivery boy data

	public function DeliveryBoyList($where=NULL){
		$query=DB::table('delivery_boy')
               ->select('delivery_boy.*','users.id as user_id','address.address','users.name','users.photo','users.phone','users.email')
               ->Join('address',function($join)
                {
                    $join->on( 'delivery_boy.address_id', '=', 'address.id');
                    $join->on('address.type', '=', DB::raw("5"));
                });
             $query->Join('users', 'users.id', '=', 'delivery_boy.user_id')
                   ->orderBy('delivery_boy.id', 'DESC');

              if($where){
              		$query->where($where,0);
                  }

                 return $query;

	}

	//Get Order List
	public function OrderList($where=NULL){
		$query=DB::table('order')
		          ->select('order.*','users.name','stores.store_name','address.address')
		          ->Join('address',function($join)
	                {
	                    $join->on( 'order.address_id', '=', 'address.id');
	                    $join->on('address.type', '=', DB::raw("4"));
	                });
		    $query->Join('users', 'users.id', '=', 'order.user_id')
		          ->Join('stores', 'stores.id', '=', 'order.store_id');
		     if($where){
		     	 $query->where($where,0);
		     }
		    return $query;

	}

}