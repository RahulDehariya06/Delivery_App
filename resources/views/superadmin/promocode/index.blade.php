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
                  <a href="{{url('superAdmin/promocode/add')}}" class="btn btn-default  waves-light" >Add Promocode</a>
               </div>
               <!-- <h4 class="page-title">Stores</h4> -->
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                  <li class="breadcrumb-item active">Promocodes</li>
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
                  
                  <table id="datatable" class="table table-bordered">
                     <thead>
                        <tr>
                           <th>ID</th>
                           <th>CODE</th>
                           <th>CODE TYPE</th>
                           <th>DISCOUNT</th>
                           <th>AVAILABLE</th> 
                           <th>EXPIRATION</th>
                           <th>STATUS</th>
                           <th>ACTION</th>
                        </tr>
                     </thead>
                     <tbody>
                        @if(count($codes)>0)
                          @foreach($codes as $promocode)
                            <tr>
                              <td>{{$promocode->id}}</td>
                              <td>{{$promocode->code}}</td>
                              <td>{{$promocode->discount}}</td>
                              <td>{{$promocode->valid_from}}</td>
                              <td>{{$promocode->expiration}}</td>
                              <td>
                                 @if($promocode->status==1)
                             <a href="{{url('superAdmin/deliveryboy/status/'.$list->id)}}" style="color:green">Active</button>
                              @else
                             <a href="{{url('superAdmin/deliveryboy/status/'.$list->id)}}" style="color:red">In-active</button>
                              @endif
                              </td>
                              <td>
                                <a href="{{url('superAdmin/promocode/edit/'.$list->id)}}"><i class="fa fa-pencil"></i></a>&nbsp 
                              <a href="{{url('superAdmin/promocode/delete/'.$list->user_id.'/'.$list->address_id)}}" class="delete-driver" data-store="{{$list->id}}"><i class="fa fa-trash-o"></i></a>
                              </td>
                            </tr>
                          @endforeach
                       @else
                          <tr>
                            <td>No Data found</td>
                          </tr>
                       @endif
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

 <script type="text/javascript">
            $(document).ready(function() {

                // Default Datatable
                $('#datatable').DataTable();

                
            } );
        </script>
@endsection