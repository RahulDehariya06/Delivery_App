<?php

namespace App\Http\Controllers\SuperAdmin\Account;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Address;
use App\Models\Picture;
use App\Models\Stores;
use App\Models\Banner;
use Illuminate\Support\Str;
use App\Helpers\Fileupload;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\SuperAdmin\Traits\CommonTrait;
use App\Http\Controllers\SuperAdmin\Traits\InsertCommonData;

class BannerController extends Controller
{
	use CommonTrait;

	protected $cacheExpiration=25;
     /**
	 *  List of Banner
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function index(){
		//Get banner list
		$data['banner']=$this->BannerDetails();

		return view('superadmin.banner.index',$data);
	}

	public function AddBannerForm(){
		
		$data['stores']=Stores::with('stores')->get();
		return view('superadmin.banner.add',$data);
	}
	/**
	 *  Add Banner 
	 *	@form data
	 * @return \Illuminate\Http\RedirectResponse|mixed
	 */

	public function AddBanner(Request $request){
		
		// Validate data
		$validator = Validator::make($request->all(), [
			'shop'=>'required',
			'status'=>'required',
			'file'=>'required|mimes:jpeg,png,jpg'
		]);

		if($validator->fails()){
			return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
		}
		//Get banner

		$banner=new Banner;

		$banner->shop=$request->input('shop');
		$banner->position=$request->input('position');

		//Upload banner image
		$bannerFile=file_upload($request);
		$banner->banner=$bannerFile;
		$banner->status=$request->input('status');

		$res=$banner->save();
		if($res){
        	 return redirect()->back()->with('success', 'Added successfully!.');
        }

         return redirect()->back()->with('error', 'Problem in  adding Banner!.');

	}

     /**
     *  Edit Banner form
     *  @banner_id
     * @return \Illuminate\Http\RedirectResponse|mixed
     */

	public function EditbannerForm(Request $request,$banner_id=NULL){
		//get Banner details
		$data['banner']=$this->BannerDetails($banner_id);
		$data['stores']=Stores::with('stores')->get();
		
		return view('superadmin.banner.edit',$data);
	}


     /**
     *  Update banner details
     *  @id
     * @return \Illuminate\Http\RedirectResponse|mixed
     */

     public function Updatebanner(Request $request){

     	$validator = Validator::make($request->all(), [
			'shop'=>'required',
		]);

		if($validator->fails()){
			return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
		}

		//Get banner details
		$bannerArr=[];

		$banner_id=$request->input('banner_id');
		//Upload banner image
		
		$bannerArr=[
			'shop'=>$request->input('shop'),
		    'position'=>$request->input('position'),
		    'status'=>$request->input('status')
		];

		if($request->hasFile('file')){

		   $bannerFile=file_upload($request);

		   $bannerArr=[
                'banner'=>$bannerFile
             ];
	  }

	   $dataArr=array_merge($bannerArr,$bannerArr);

		$res=Banner::where('id',$banner_id)->update($bannerArr);

		if($res){
        	 return redirect()->back()->with('success', 'Updated successfully!.');
        }

         return redirect()->back()->with('error', 'Problem in  updating Banner!.');
     }

     /**
     *  Remove banner 
     *  @banner_id
     * @return \Illuminate\Http\RedirectResponse|mixed
     */

     public function Removebanner(Request $request,$banner_id=""){
     	if(empty($banner_id)){
     		 return redirect()->back()->with('error', 'Invalid Request.');
     	}
     	//
     	 $banner = Banner::where('id',$banner_id)->delete();

     	 //Send response
          if($banner){
             return redirect()->back()->with('success', 'Removed successfully!.');
         }

         return redirect()->back()->with('error', 'Problem in  Removing data!.');

     }


}
