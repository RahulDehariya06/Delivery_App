@extends('superadmin.layouts.master')

@section('content')
<div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                              
                                <!-- <h4 class="page-title">Add Store</h4> -->
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Delivery Boy</a></li>
                                    <li class="breadcrumb-item"><a href="#">Edit </a></li>
                                </ol>

                            </div>
                        </div>
                        @if (session('error'))       
                          <div class="alert alert-danger">
                                 {{ session('error') }}      
                          </div>
                        @endif

                        @if (session('success'))
                          <div class="alert alert-success">
                                 {{ session('success') }}
                          </div>
                        @endif
                        <div class="row">
                            <div class="col-12">
                                <div class="card-box">
                                    <div class="col-sm-4">
                                        
                                        <div class="sp-wrap">
                                            
                                        </div>
                                      </div>
                                    <div class="row">
                                       <div class="col-sm-4">
                                          <div class="sp-wrap">
                                             <form class="form-horizontal" method="post" action="{{url('superAdmin/deliveryboy/updateimage')}}" enctype="multipart/form-data" id="profilepic">
                                                @csrf
                                                <input type="hidden" name="id" value="{{$profile->user_id}}">
                                                @if($profile->photo)
                                                  <img style="width: 200px;border-radius: 50%;" src="{{imgUrl($profile->photo)}}" alt="">
                                                @else
                                                   <img style="width: 200px;border-radius: 50%;" src="{{imgUrl('/app/file/default.png')}}" alt="">
                                                @endif
                                                <input class="profile-photo" type="file" name="file" id="fileupdate" data-id="{{$profile->user_id}}">
                                               </div>
                                           </form>
                                       </div>
                                        <div class="col-12">
                                            <div class="p-20">
                                                <form class="form-horizontal" method="post" action="{{url('superAdmin/deliveryboy/update')}}" enctype="multipart/form-data">
                                                	@csrf
                                                	<input type="hidden" name="country" id="country" value="{{$profile->country}}">
						                            <input type="hidden" name="city" id="locality" value="{{$profile->city}}">
						                            <input type="hidden" name="state" id="administrative_area_level_1" value="{{$profile->state}}">
						                            <input type="hidden" name="zip" id="postal_code" value="{{$profile->pincode}}">
						                            <input type="hidden" name="lat" id="hidden_lat" value="{{$profile->lat}}">
						                            <input type="hidden" name="long" id="hidden_long" value="{{$profile->lon}}">
						                            <input type="hidden" name="street_number" id="street_number" value="">
						                            <input type="hidden" name="route" id="route" value="">
						                            <input type="hidden" name="user_id" id="user_id" value="{{$profile->user_id}}">
                                                    <input type="hidden" name="delivery_boy_id" id="user_id" value="{{$profile->delivery_boy_id}}">
                                                    
                                                    
                                                    
                                                    <div class="form-group row">
                                                        <label class="col-2 col-form-label"> Name</label>
                                                        <div class="col-10">
                                                            <input type="text" class="form-control" name="name" placeholder="Enter  name" value="{{$profile->name}}">
                                                            @error('name')
                                                            <p class="error">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                     <div class="form-group row">
                                                        <label class="col-2 col-form-label"> Email</label>
                                                        <div class="col-10">
                                                            <input type="text" class="form-control" name="email" placeholder="Enter store name" value="{{$profile->email}}">
                                                            @error('email')
                                                            <p class="error">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                     <div class="form-group row">
                                                        <label class="col-2 col-form-label"> Phone No</label>
                                                        <div class="col-10">
                                                            <input type="text" class="form-control" name="phone" placeholder="Enter store name" value="{{$profile->phone}}">
                                                            @error('phone')
                                                            <p class="error">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-2 col-form-label">Dob</label>
                                                        <div class="col-10">
                                                            <input type="text" class="form-control" name="dob" placeholder="" value="{{$profile->dob}}">
                                                            @error('dob')
                                                            <p class="error">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-2 col-form-label"> Bike No</label>
                                                        <div class="col-10">
                                                            <input type="text" class="form-control" name="bike_no" placeholder="Enter store name" value="{{$profile->bike_no}}">
                                                            @error('bike_no')
                                                            <p class="error">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-2 col-form-label"> Licence No</label>
                                                        <div class="col-10">
                                                            <input type="text" class="form-control" name="licence_no" placeholder="Enter store name" value="{{$profile->licence_no}}">
                                                            @error('licence_no')
                                                            <p class="error">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    

                                                   <div class="form-group row">
                                                        <label class="col-2 col-form-label">Address</label>
                                                        <div class="col-10">
                                                            <input type="text" name="address" id="address" class="form-control" placeholder="Enter Address" onFocus="geolocate()" autocomplete="on" value="{{$profile->address}}">
                                                             @error('address')
															<p class="error">{{ $message }}</p>
														    @enderror
                                                        </div>
                                                    </div>
                                                      <div class="form-group row">
                                                         <label class="col-2 col-form-label">Status</label>
                                                         <div class="col-10">
                                                             <select class="custom-select " name="status">
                                                               <option  value="" hidden="">Select Status</option>
                                                               <option  value="1" {{ $profile->status == 1  ? 'selected' : ''}} >Active</option>
                                                               <option  value="0" {{ $profile->status == 0  ? 'selected' : ''}} >In-active</option>
                                                            </select>
                                                            @error('file')
                                                            <p class="error">{{ $message }}</p>
                                                            @enderror
                                                         </div>
                                                      </div>
                                                    <div class="form-group row">
                                                        <label class="col-2 col-form-label">Licence Front Image</label>
                                                        <div class="col-10">
                                                           <img style="width: 200px" src="{{url('storage/'.$profile->licence_front_img)}}" alt="">
                                                           <input  type="file"  name="front_licence" >
                                                        </div>
                                                    </div>
                                                     <div class="form-group row">
                                                        <label class="col-2 col-form-label">Licence Back Image</label>
                                                        <div class="col-10">
                                                           <img style="width: 200px" src="{{url('storage/'.$profile->licence_back_img)}}" alt="">

                                                           <input  type="file" name="back_licence" >

                                                        </div>
                                                    </div>
                                                    
                                                    
                                                     <button type="submit" class="btn btn-primary">Submit</button>
                                                </form>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- end row -->

                                </div> <!-- end card-box -->
                            </div><!-- end col -->
                        </div>
                        <!-- end row -->

                        <!-- end row -->    

                    </div> <!-- container -->

                </div> <!-- content -->

 </div>

@endsection