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
                  <li class="breadcrumb-item"><a href="#">Stores</a></li>
                  <li class="breadcrumb-item"><a href="#">Add Store</a></li>
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
                  <div class="row">
                     <div class="col-12">
                        <div class="p-20">
                           <form class="form-horizontal" method="post" action="{{url('superAdmin/addStore')}}" enctype="multipart/form-data">
                              @csrf
                              <input type="hidden" name="country" id="country" value="{{old('country')}}">
                              <input type="hidden" name="city" id="locality" value="{{old('city')}}">
                              <input type="hidden" name="state" id="administrative_area_level_1" value="{{old('state')}}">
                              <input type="hidden" name="zip" id="postal_code" value="{{old('zip')}}">
                              <input type="hidden" name="lat" id="hidden_lat" value="">
                              <input type="hidden" name="long" id="hidden_long" value="">
                              <input type="hidden" name="street_number" id="street_number" value="">
                              <input type="hidden" name="route" id="route" value="">
                              <div class="form-group row">
                                 <label class="col-2 col-form-label">Owner Name</label>
                                 <div class="col-10">
                                    <input type="text" class="form-control" name="user_name" placeholder="Enter store owner name" value="{{old('user_name')}}">
                                    @error('user_name')
                                    <p class="error">{{ $message }}</p>
                                    @enderror
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label class="col-2 col-form-label">Email</label>
                                 <div class="col-10">
                                    <input type="email" class="form-control" name="email" placeholder="Enter  email" value="{{old('email')}}">
                                    @error('email')
                                    <p class="error">{{ $message }}</p>
                                    @enderror
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label class="col-2 col-form-label">Phone No</label>
                                 <div class="col-10">
                                    <input type="number" class="form-control" name="phone" placeholder="Enter phone no" value="{{old('phone')}}">
                                    @error('phone')
                                    <p class="error">{{ $message }}</p>
                                    @enderror
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label class="col-2 col-form-label">DOB</label>
                                 <div class="col-10">
                                    <input type="date" class="form-control" name="dob" placeholder="Enter  DOB" value="{{old('dob')}}">
                                    @error('dob')
                                    <p class="error">{{ $message }}</p>
                                    @enderror
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label class="col-2 col-form-label">Profile picture</label>
                                 <div class="col-10">
                                    <input type="file" class="form-control" name="file" >
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label class="col-2 col-form-label">Store Name</label>
                                 <div class="col-10">
                                    <input type="text" class="form-control" name="store_name" placeholder="Enter store name" value="{{old('store_name')}}">
                                    @error('store_name')
                                    <p class="error">{{ $message }}</p>
                                    @enderror
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label class="col-2 col-form-label" for="example-email">Started on</label>
                                 <div class="col-10">
                                    <input type="date"  name="started_on" class="form-control" placeholder="Enter started date" value="{{old('started_on')}}">
                                    @error('started_on')
                                    <p class="error">{{ $message }}</p>
                                    @enderror
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label class="col-2 col-form-label">Store open time</label>
                                 <div class="col-10">
                                    <input type="text" name="open_time" class="form-control" placeholder="Open time" value="{{old('open_time')}}">
                                    @error('open_time')
                                    <p class="error">{{ $message }}</p>
                                    @enderror
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label class="col-2 col-form-label">Store close time</label>
                                 <div class="col-10">
                                    <input type="text" name="close_time"  class="form-control" placeholder="Close time" value="{{old('close_time')}}">
                                    @error('close_time')
                                    <p class="error">{{ $message }}</p>
                                    @enderror
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label class="col-2 col-form-label">Max Delivery time</label>
                                 <div class="col-10">
                                    <input type="text" name="max_delivery_time"  class="form-control" placeholder="Max Delivery time" value="{{old('close_time')}}">
                                    @error('max_delivery_time')
                                    <p class="error">{{ $message }}</p>
                                    @enderror
                                 </div>
                              </div>
                              
                              <div class="form-group row">
                                 <label class="col-2 col-form-label">Store Description</label>
                                 <div class="col-10">
                                    <textarea name="description" class="form-control" rows="5" placeholder="Enter description" value="{{old('description')}}"></textarea>
                                    @error('description')
                                    <p class="error">{{ $message }}</p>
                                    @enderror
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label class="col-2 col-form-label">Store Images</label>
                                 <div class="col-10">
                                    <input type="file" class="form-control" name="store[]" multiple="">
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label class="col-2 col-form-label">Address</label>
                                 <div class="col-10">
                                    <input type="text" name="address" id="address" class="form-control" placeholder="Enter Address" onFocus="geolocate()" value="{{old('address')}}">
                                    @error('address')
                                    <p class="error">{{ $message }}</p>
                                    @enderror
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label class="col-2 col-form-label">Landmark</label>
                                 <div class="col-10">
                                    <input type="text" name="landmark" class="form-control" placeholder="Enter landmark" value="{{old('landmark')}}">
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label class="col-2 col-form-label">Status</label>
                                 <div class="col-10">
                                     <select class="custom-select " name="status">
                                       <option  value="" hidden="">Select Status</option>
                                       <option  value="1" >Active</option>
                                       <option  value="0" >In-active</option>
                                    </select>
                                    @error('status')
                                    <p class="error">{{ $message }}</p>
                                    @enderror
                                 </div>
                              </div>
                              <button type="submit" class="btn btn-primary">Submit</button>
                           </form>
                        </div>
                     </div>
                  </div>
                  <!-- end row -->
               </div>
               <!-- end card-box -->
            </div>
            <!-- end col -->
         </div>
         <!-- end row -->
         <!-- end row -->    
      </div>
      <!-- container -->
   </div>
   <!-- content -->
</div>


@endsection