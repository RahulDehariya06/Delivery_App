<?php

namespace App\Http\Controllers\SuperAdmin\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Address;
use App\Models\Promocode;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\SuperAdmin\Traits\CommonTrait;



class PromoCodeController extends Controller
{
     protected $cacheExpiration=25;
     /**
	 *  List of Promocode
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */

     public function index(){
     	//Get Promocode list 

     	$data['codes']=Promocode::get();
      	return view('superadmin.promocode.index',$data);
     }

     /**
      * Show the form to create a new promocode
      *
      * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
      */

     public function AddPromocodeForm(Request $request){
         
          return view('superadmin.promocode.add');
     }
     /**
      * Add new promocode
      *
      * @param Request $request
      * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
      */

     public function AddPromocode(Request $request){
     
         
         //Validate data
          $validator=Validator::make($request->all(),[
               'title'=>'required',
               'usage_per_coupon'=>'required',
               'valid_from'=>'required|date',
               'usage_per_user'=>'required',
               'expiration'=>'required|date',
               'type'=>'required',
               'discount'=>'required',
               'description'=>'required'

          ]);

            if ($validator->fails()) {
               return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
           }  
            print_r($request->all());die;

           //Get values
           $promocode=new Promocode;

           $promocode->title=$request->input('title');
           //Generate promocode
           $promocode->code=$request->input('title');

           $promocode->description=$request->input('description');
           $promocode->discount=$request->input('discount');
           $promocode->title=$request->input('title');
           $promocode->expiration=$request->input('expiration');
           $promocode->usages_limit_per_coupen=$request->input('usage_per_coupon');
           $promocode->limit_per_user=$request->input('usage_per_user');
           $promocode->type=$request->input('type');
           $promocode->status=1;

          //Save Data
          $res= $promocode->save();

          //Send Response
          if($res){
            return redirect()->back()->with('success', 'Added successfully!.');
          }
         return redirect()->back()->with('error', 'Problem in  adding data!.');

     }

     /**
      * Show edit form for promocode
      *
      * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
      */

     public function EditPromocodeForm(Request $request,$code_id){
          //Get Promocode Details

          $data['promocode']=$this->PromocodeDetails($code_id);

         return view('superadmin.promocode.edit',$data);
     }
     /**
      *  edit promocode
         @promocodeid
      *
      *  @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
      */

     public function EditPromocode(Request $request){

     }
     /**
      *  Reemove promocode
         @promocodeid
      *
      *  @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
      */

     public function RemovePromocode(Request $request,$code_id=""){

     }


}
