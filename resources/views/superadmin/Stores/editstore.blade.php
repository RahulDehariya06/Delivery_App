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
                  <li class="breadcrumb-item"><a href="#">Edit Store</a></li>
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
                     @if(count($picture)>0)
                     @foreach($picture as $file)
                     <div class="col-sm-4">
                        <div class="sp-wrap">
                           <img style="width: 400px" src="{{imgUrl($file->filename)}}" alt="">
                        </div>
                     </div>
                     @endforeach
                     @endif
                  </div>
                  <div class="row">
                     <div class="col-12">
                        <div class="p-20">
                           <form class="form-horizontal" method="post" action="{{url('superAdmin/editstore')}}" enctype="multipart/form-data">
                              @csrf
                              <input type="hidden" name="country" id="country" value="{{$store->address->country}}">
                              <input type="hidden" name="city" id="locality" value="{{$store->address->city}}">
                              <input type="hidden" name="state" id="administrative_area_level_1" value="{{$store->address->state}}">
                              <input type="hidden" name="zip" id="postal_code" value="{{$store->address->pincode}}">
                              <input type="hidden" name="lat" id="hidden_lat" value="{{$store->address->lat}}">
                              <input type="hidden" name="long" id="hidden_long" value="{{$store->address->lon}}">
                              <input type="hidden" name="street_number" id="street_number" value="">
                              <input type="hidden" name="route" id="route" value="">
                              <input type="hidden" name="storeId" id="storeId" value="{{$store->id}}">
                              <div class="form-group row">
                                 <label class="col-2 col-form-label">Store Name</label>
                                 <div class="col-10">
                                    <input type="text" class="form-control" name="store_name" placeholder="Enter store name" value="{{$store->store_name}}">
                                    @error('store_name')
                                    <p class="error">{{ $message }}</p>
                                    @enderror
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label class="col-2 col-form-label" for="example-email">Started on</label>
                                 <div class="col-10">
                                    <input type="date"  name="started_on" class="form-control" placeholder="Enter started date" value="{{$store->started_at}}">
                                    @error('started_on')
                                    <p class="error">{{ $message }}</p>
                                    @enderror
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label class="col-2 col-form-label">Store open time</label>
                                 <div class="col-10">
                                    <input type="text" name="open_time" class="form-control" placeholder="Open time" value="{{$store->store_open_time}}">
                                    @error('open_time')
                                    <p class="error">{{ $message }}</p>
                                    @enderror
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label class="col-2 col-form-label">Store close time</label>
                                 <div class="col-10">
                                    <input type="text" name="close_time"  class="form-control" placeholder="Close time" value="{{$store->store_close_time}}">
                                    @error('close_time')
                                    <p class="error">{{ $message }}</p>
                                    @enderror
                                 </div>
                              </div>
                               <div class="form-group row">
                                 <label class="col-2 col-form-label">Max Delivery time</label>
                                 <div class="col-10">
                                    <input type="text" name="max_delivery_time"  class="form-control" placeholder="Max Delivery time" value="{{$store->max_delivery_time}}">
                                    @error('max_delivery_time')
                                    <p class="error">{{ $message }}</p>
                                    @enderror
                                 </div>
                              </div>
                              
                              <div class="form-group row">
                                 <label class="col-2 col-form-label">Store Description</label>
                                 <div class="col-10">
                                    <textarea name="description" class="form-control"  placeholder="Enter description" >{{$store->description}}</textarea>
                                    @error('description')
                                    <p class="error">{{ $message }}</p>
                                    @enderror
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label class="col-2 col-form-label">Address</label>
                                 <div class="col-10">
                                    <input type="text" name="address" id="address" class="form-control" placeholder="Enter Address" onFocus="geolocate()" autocomplete="on" value="{{$store->address->address}}">
                                    @error('address')
                                    <p class="error">{{ $message }}</p>
                                    @enderror
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label class="col-2 col-form-label">Landmark</label>
                                 <div class="col-10">
                                    <input type="text" name="landmark" class="form-control" placeholder="Enter landmark" value="{{$store->address->landmark}}">
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label class="col-2 col-form-label">Update Store Images</label>
                                 <div class="col-10">
                                    <input type="file" class="form-control" name="store[]" multiple="">
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label class="col-2 col-form-label">Status</label>
                                 <div class="col-10">
                                    <select class="custom-select " name="status">
                                       <option  value="" hidden="">Select Status</option>
                                       <option  value="1" {{ $store->status == 1  ? 'selected' : ''}} >Active</option>
                                       <option  value="0" {{ $store->status == 0  ? 'selected' : ''}} >In-active</option>
                                    </select>
                                    @error('file')
                                    <p class="error">{{ $message }}</p>
                                    @enderror
                                 </div>
                              </div>
                              <button type="submit" class="btn btn-primary">Update</button>
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