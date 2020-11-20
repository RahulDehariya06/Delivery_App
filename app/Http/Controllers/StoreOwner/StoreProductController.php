<?php

namespace App\Http\Controllers\StoreOwner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Picture;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Routing\UrlGenerator;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Fileupload;

class StoreProductController extends Controller
{
    //

    /**
	 * Dashboard data
	 *
	 * @return \Illuminate\Http\RedirectResponse|mixed
	 */
    public function index(){
    	
    	return view('storeowner.products.index');
    }

     /**
      * Show the form to create a new product
      *
      * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
      */

    public function AddproductForm(Request $request){

    	return view('storeowner.products.add');
    }

    /**
      * Add new Product
      *
      * @param Request $request
      * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
      */

    public function Addproduct(Request $request){

    	
    	//Apply validation on fields
    	$validator=Validator::make($request->all(),[
    		    'name'         => 'required|max:100',
                'category'     => 'required|integer',
                'price'     => 'required',
                'description'  => 'required',
                'status'       =>'required',
                'discount_active'       =>'required'

    	]);

    	if($validator->fails()){
             return redirect()->back()
             			->withErrors($validator)
             			->withInput();
    	}
	    $product_img=[];

	   if($request->hasFile('store')) {
         
           $product_img=multifileUploder($request);

       }



    	//Get Product Model

    	$product=new Product;

    	$product->category=$request->input('category');
    	$product->store_id=session('store_id');
    	$product->product_name=$request->input('name');
    	$product->description=$request->input('description');
    	$product->price=$request->input('price');
    	$product->discount_active=$request->input('discount_active');
    	$product->status=$request->input('status');

    	$res=$product->save();

    	$product_id=$product->id;

    
    	if(count($product_img)>0){
            foreach ($product_img as  $images) {
                
                $picture=new Picture;
                $picture->key_id=$product_id;
                $picture->type=2;
                $picture->filename=$images;
                $picture->save();
            }

        }
         if($res){
             return redirect()->back()->with('success', 'Product added successfully!.');
        }

        return redirect()->back()->with('error', 'Problem in  added Product!.');


    	
    }
}
