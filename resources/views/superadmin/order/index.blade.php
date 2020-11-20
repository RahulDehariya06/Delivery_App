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
                  <!-- <a href="{{url('superAdmin/promocode/add')}}" class="btn btn-default  waves-light" >Add Promocode</a> -->
               </div>
               <!-- <h4 class="page-title">Stores</h4> -->
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                  <li class="breadcrumb-item active">Orders</li>
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
                   <h4 class="m-t-0 header-title">Order List</h4>
                  <table id="datatable" class="table table-bordered">
                     <thead>
                        <tr>
                           <th>S.NO</th>
                           <th>ORDER NAME</th>
                           <th>CUSTOMER NAME</th>
                           <th>STORE NAME</th>
                           <th>LOCATION</th> 
                           <th>DELIVERY TIME</th>
                           <th>QUANTITY</th>
                           <th>PRICE</th>
                           <th>STATUS</th>
                           <th>ACTION</th>
                        </tr>
                     </thead>
                     <tbody>
                        @if(count($orders)>0)
                        @php $p=1 @endphp
                          @foreach($orders as $list)
                            <tr>
                              <td>
                                  {{ $p }}
                                  {{ $list->name }}
                                  {{ $list->name }}
                                  {{ $list->store_name }}
                                  {{ $list->address }}
                                  {{ $list->delivery_time }}
                                
                              </td>
                            </tr>
                            @php $p++ @endphp
                          @endforeach
                        @else
                          <tr>
                            <td>No Orders Found</td>
                          </tr>
                        @endif
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