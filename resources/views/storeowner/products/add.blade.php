@extends('storeowner.layouts.master')

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
                 <li class="breadcrumb-item"><a href="#">Products</a></li>
                  <li class="breadcrumb-item"><a href="#">Add Product</a></li>
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
                           <form class="form-horizontal" method="post" action="{{url('StoreOwner/products/add')}}" enctype="multipart/form-data">
                              @csrf
                              
                              <div class="form-group row">
                                 <label class="col-2 col-form-label">Product Name</label>
                                 <div class="col-10">
                                    <input type="text" class="form-control" name="name" placeholder="Enter  name" value="{{old('name')}}">
                                    @error('name')
                                    <p class="error">{{ $message }}</p>
                                    @enderror
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label class="col-2 col-form-label">Select Category</label>
                                 <div class="col-10">
                                     <select class="custom-select " name="category">
                                       <option  value="" hidden="">Select Category</option>
                                       <option  value="1" >Active</option>
                                       <option  value="0" >In-active</option>
                                    </select>

                                    @error('category')
                                    <p class="error">{{ $message }}</p>
                                    @enderror
                                 </div>
                              </div>
                             <!--  <div class="form-group row">
                                 <label class="col-2 col-form-label">Quantity</label>
                                 <div class="col-10">
                                    <input type="number" class="form-control" name="quantity" placeholder="Enter quantity" value="{{old('quantity')}}">
                                    @error('quantity')
                                    <p class="error">{{ $message }}</p>
                                    @enderror
                                 </div>
                              </div>
                               -->
                              <div class="form-group row">
                                 <label class="col-2 col-form-label">Price</label>
                                 <div class="col-10">
                                    <input type="number" class="form-control" name="price" placeholder="Enter Price" value="{{old('price')}}">
                                    @error('price')
                                    <p class="error">{{ $message }}</p>
                                    @enderror
                                 </div>
                              </div>
                              
                              <div class="form-group row">
                                 <label class="col-2 col-form-label">Description</label>
                                 <div class="col-10">
                                  	<textarea class="form-control" name="description">{{old('description')}}</textarea>
                                    @error('description')
                                    <p class="error">{{ $message }}</p>
                                    @enderror
                                 </div>
                              </div>     
                              <div class="form-group row">
                                 <label class="col-2 col-form-label">Product picture</label>
                                 <div class="col-10">
                                    <label class="file">
            								  <input type="file" name="store[]" class="form-control" multiple="">
            								  <span class="file-custom"></span>
         							     </label>
								@error('file')
									 <p class="error">{{ $message }}</p>
								@enderror
                                 </div>
                              </div>
                               <div class="form-group row">
                                 <label class="col-2 col-form-label">Status Available</label>
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
                               <div class="form-group row">
                                 <label class="col-2 col-form-label">Discount Active</label>
                                 <div class="col-10">
                                    
                                   <select class="custom-select " name="discount_active">
                                       <option  value="" hidden="">Select Discount Active</option>
                                       <option  value="1" >Active</option>
                                       <option  value="0" >In-active</option>
                                    </select>
                                     @error('discount_active')
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