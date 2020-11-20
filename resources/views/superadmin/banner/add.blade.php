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
                  <li class="breadcrumb-item"><a href="#">Banner </a></li>
                  <li class="breadcrumb-item"><a href="#">Add Banner</a></li>
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
                           <form class="form-horizontal" method="post" action="{{url('superAdmin/banner/add')}}" enctype="multipart/form-data">
                              @csrf
                             
                              <div class="form-group row">
                                 <label class="col-2 col-form-label">Choose Shop</label>
                                 <div class="col-10">
                                    <select class="custom-select " name="shop">
                                       <option  value="" hidden="">Select Shop</option>
                                       @if(count($stores)>0)
                                          @foreach($stores as $option)
                                             
                                              <option value="{{$option->id}}">{{$option->store_name}}</option>
                                          @endforeach
                                       @else
                                           <option value="">No stores found</option>
                                       @endif
                                      
                                   </select>
                                    @error('shop')
                                    <p class="error">{{ $message }}</p>
                                    @enderror
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label class="col-2 col-form-label">Position</label>
                                 <div class="col-10">
                                    <input type="number" class="form-control" name="position" placeholder="Enter  position" value="{{old('email')}}">
                                    @error('email')
                                    <p class="error">{{ $message }}</p>
                                    @enderror
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label class="col-2 col-form-label">Select  file</label>
                                 <div class="col-10">
                                    <input type="file" class="form-control" name="file" >
                                    @error('file')
                                    <p class="error">{{ $message }}</p>
                                    @enderror
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
                              
                               
                               
                              <button type="submit" class="btn btn-primary">Create</button>
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