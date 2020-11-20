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
                  <li class="breadcrumb-item"><a href="#">Promocode</a></li>
                  <li class="breadcrumb-item"><a href="#">Add Promocode</a></li>
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
                           <form class="form-horizontal" method="post" action="{{url('superAdmin/deliveryboy/add')}}" enctype="multipart/form-data">
                              @csrf
                              
                             
                              
                              <div class="form-group row">
                                 <label class="col-2 col-form-label">Promocode Title</label>
                                 <div class="col-10">
                                    <input type="text" class="form-control" name="title" placeholder="Enter  Promocode title" value="{{old('title')}}">
                                    @error('title')
                                    <p class="error">{{ $message }}</p>
                                    @enderror
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label class="col-2 col-form-label">Valid From</label>
                                 <div class="col-10">
                                    <input type="date" class="form-control" name="valid_from" value="{{old('valid_from')}}">
                                    @error('valid_from')
                                    <p class="error">{{ $message }}</p>
                                    @enderror
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label class="col-2 col-form-label">Expiration Date</label>
                                 <div class="col-10">
                                    <input type="date" class="form-control" name="expiration" value="{{old('phone')}}">
                                    @error('expiration')
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