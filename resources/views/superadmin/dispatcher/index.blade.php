@extends('superadmin.layouts.master')

@section('content')
<div class="content-page">
   <!-- Start content -->
   <div class="content">
      <div class="container-fluid">
         <!-- Page-Title -->
         <div class="row">
            <div class="col-sm-12">
               <div class="btn-group pull-right m-t-15 m-b-10">
                  
               </div>
               <!-- <h4 class="page-title">Stores</h4> -->
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                  <li class="breadcrumb-item active">Dispatcher</li>
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
               <div class="card-box table-responsive">
                  <div class="tab">
                   <button type="button"  class="tabbutton active">PENDING ORDER</button>
                   <button type="button" class="tab-button">ACCEPTED ORDER</button>
                   <button type="button" class="tab-button">ONGOING ORDER</button>
                   <button type="button" class="tab-button">CANCELLED ORDER</button>
                 </div>
                  <table id="datatable" class="table table-bordered">
                     <thead>
                        <tr>
                           <th>ID</th>
                           <th>STORE NAME</th>
                           <th>CONDITION</th>
                           <th>LOCATION</th>
                           <th>TIME</th> 
                           <th>DATE</th>
                           <th>STATUS</th>
                           <th>ACTION</th>
                        </tr>
                     </thead>
                     <tbody>
                        
                     </tbody>
                  </table>
                     <table id="deliveryBoy" class="table table-bordered">
                     <thead>
                        <tr>
                           <th>ID</th>
                           <th>NAME</th>
                           <th>EMAIL</th>
                           <th>LOCATION</th>
                           <th>TIME</th> 
                           <th>DATE</th>
                           <th>STATUS</th>
                           <th>ACTION</th>
                        </tr>
                     </thead>
                     <tbody>
                        
                     </tbody>
                  </table>


               </div>
            </div>
         </div>
         <div class="row">
              <div class="col-12 d-flex justify-content-center pt-4" class="li: { list-style: none; }">
                
              </div>
            </div>
         
         <!-- end row -->
      </div>
      <!-- container -->
   </div>
   <!-- content -->
</div>

@endsection