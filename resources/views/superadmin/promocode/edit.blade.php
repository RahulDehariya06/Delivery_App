@extends('superadmin.layouts.master')

@section('content')
<div class="content-page">
   <!-- Start content -->
   <div class="content">
      <div class="container-fluid">
         <!-- Form row -->
         <div class="row">
              <div class="row">
            <div class="col-sm-12">
               <!-- <h4 class="page-title">Add Store</h4> -->
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Promocode</a></li>
                  <li class="breadcrumb-item"><a href="#">Add Promocode </a></li>
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
            <div class="col-md-12">
               <div class="card-box">
                  <form  method="post" action="{{url('superAdmin/promocode/add')}}" enctype="multipart/form-data">
                     @csrf
                  
                     <div class="form-row">
                        <div class="form-group col-md-6">
                           <label for="inputEmail4" class="col-form-label">Prmocode</label>
                           <input type="text" name="code" class="form-control"  placeholder="Enter Promocode title" value="{{$promocode->code}}">
                            @error('code')
                             <p class="error">{{ $message }}</p>
                            @enderror
                        </div>
                         <div class="form-row">
                        <div class="form-group col-md-6">
                           <label for="inputEmail4" class="col-form-label">Prmocode Title</label>
                           <input type="text" name="title" class="form-control"  placeholder="Enter Promocode title" value="{{$promocode->title}}">
                            @error('title')
                             <p class="error">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="form-group col-md-6">
                           <label  class="col-form-label">Usage Limit Per Coupon</label>
                           <input type="text" name="usage_per_coupon" class="form-control" value="{{$promocode->usages_limit_per_coupen}}">
                           @error('usage_per_coupon')
                             <p class="error">{{ $message }}</p>
                            @enderror
                        </div>
                     </div>
                      <div class="form-row">
                        <div class="form-group col-md-6">
                           <label for="inputEmail4" class="col-form-label">Valid From</label>
                           <input type="date" name="valid_from" class="form-control" value="{{$promocode->valid_from}}">
                            @error('valid_from')
                             <p class="error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                           <label  class="col-form-label">Usage Limit Per User</label>
                           <input type="text" name="usage_per_user" class="form-control" value="{{$promocode->limit_per_user}}">
                           @error('usage_per_user')
                             <p class="error">{{ $message }}</p>
                            @enderror
                        </div>
                     </div>
                      <div class="form-row">
                        <div class="form-group col-md-6">
                           <label for="inputEmail4" class="col-form-label">Expiration Date</label>
                           <input type="date" name="expiration" class="form-control" value="{{$promocode->expiration}}">
                           @error('expiration')
                             <p class="error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                           <label  class="col-form-label">Promocode Type</label>
                           <input type="type" name="usage_per_user" class="form-control" value="{{$promocode->type}}">
                           @error('usage_per_user')
                             <p class="error">{{ $message }}</p>
                            @enderror
                        </div>
                     </div>
                     
                     <div class="form-group">
                        <label for="inputAddress" class="col-form-label">Description</label>
                        <textarea name="description" class="form-control">{{$promocode->description}}</textarea>
                        @error('description')
                             <p class="error">{{ $message }}</p>
                            @enderror
                     </div>
                     
                    
                     <button type="submit" class="btn btn-primary">Submit </button>
                  </form>
               </div>
            </div>
         </div>
         <!-- end row -->    
      </div>
      <!-- container -->
   </div>
   <!-- content -->
   
</div>
@endsection