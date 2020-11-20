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
                  <a href="{{url('superAdmin/deliveryboy/add')}}" class="btn btn-default  waves-light" >Add Delivery Boy</a>
               </div>
               <ol class="breadcrumb">
                
                  <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                  <li class="breadcrumb-item active">Delivery Boy</li>
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
                  <h4 class="m-t-0 header-title">Delivery Boy List</h4>
                  <table id="datatable" class="table table-bordered">
                     <thead>
                        <tr>
                           <th>ID</th>
                           <th>Image</th>
                           <th>Name</th>
                           <th>Email Address</th>
                           <th>Phone Number</th>
                           <th>Rating</th>
                           <th>Status</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        @if(count($details)>0)
                        @foreach($details as $list)
                        <tr>
                           <td>{{$list->id}}</td>
                           <td>
                              @if($list->photo)
                                 <img style="width: 40px" src="{{imgUrl($list->photo)}}" alt="">
                              @else
                              <img style="width: 40px" src="{{imgUrl('/app/file/default.png')}}">
                              @endif

                              

                           </td>
                           <td>{{$list->name}}</td>
                           <td>{{$list->address}}</td>
                           <td>{{$list->phone}}</td>
                           <td>{{$list->rating}}</td>
                           <td>
                              @if($list->status==1)
                             <a href="{{url('superAdmin/deliveryboy/status/'.$list->id)}}" style="color:green">Active</button>
                              @else
                             <a href="{{url('superAdmin/deliveryboy/status/'.$list->id)}}" style="color:red">In-active</button>
                              @endif
                           </td>
                           <td>
                              <a href="{{url('superAdmin/deliveryboy/profile/'.$list->id)}}"><i class="md md-remove-red-eye"></i></a>&nbsp
                              <a href="{{url('superAdmin/deliveryboy/edit/'.$list->id)}}"><i class="fa fa-pencil"></i></a>&nbsp 
                              <a href="{{url('superAdmin/deliveryboy/delete/'.$list->user_id.'/'.$list->address_id)}}" class="delete-driver" data-store="{{$list->id}}"><i class="fa fa-trash-o"></i></a>
                           </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                           <td>No stores Found</td>
                        </tr>
                        @endif
                     </tbody>
                  </table>
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