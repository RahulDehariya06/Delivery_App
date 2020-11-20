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
                  <li class="breadcrumb-item active">Request</li>
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
                   <button type="button"  class="tabbutton active">STORE REQUEST</button>
                   <button type="button" class="tab-button">DELIVERY BOY REQUEST</button>
                 </div>
                  <table id="datatable" class="table table-bordered">
                     <thead>
                        <tr>
                           <th>S.NO</th>
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
                        @if(count($stores)>0)
                           @php $p=1 @endphp
                           @foreach($stores as $list)
                            <tr>
                               <td>{{$p}}</td>
                               <td>{{$list->store_name}}</td>
                               <td>{{$list->store_name}}</td>
                               <td>{{$list->address}}</td>
                               <td>{{date("H:i", strtotime($list->created_at))}}</td>
                               <td>{{date("d-m-Y", strtotime($list->created_at))}}</td>
                               <td>
                                 @if($list->approved==1)
                                <p style="color:green">Approved</p>
                                 @else
                                <p  style="color:red">Pending</p>
                                 @endif
                               </td>
                               <td>
                                  <a href="{{url('superAdmin/request/edit/'.$list->id)}}"><i class="fa fa-pencil"></i></a>&nbsp 
                                  <a href="{{url('superAdmin/request/delete/'.$list->id)}}" class="delete-driver" ><i class="fa fa-trash-o"></i></a>
                               </td>
                            </tr>
                            @php $p++ @endphp
                           @endforeach
                        @else
                           <tr>
                              <td>No Data Found</td>
                           </tr>
                        @endif                        
                     </tbody>
                  </table>
                     <table id="deliveryBoy" class="table table-bordered">
                     <thead>
                        <tr>
                           <th>S.NO</th>
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
                        @if(count($delivery_boy)>0)
                          @php $p=1 @endphp
                           @foreach($delivery_boy as $data)
                              <tr>
                                 <td>{{$p}}</td>
                                 <td>{{$data->name}}</td>
                                 <td>{{$data->email}}</td>
                                 <td>{{$data->address}}</td>
                                 <td>{{date("H:i", strtotime($data->created_at))}}</td>
                                 <td>{{date("d-m-Y", strtotime($data->created_at))}}</td>
                                 <td>
                                 @if($data->approved==1)
                                <p style="color:green">Approved</p>
                                 @else
                                <p  style="color:red">Pending</p>
                                 @endif
                               </td>
                               <td>
                                  <a href="{{url('superAdmin/request/edit/'.$data->id)}}"><i class="fa fa-pencil"></i></a>&nbsp 
                                  <a href="{{url('superAdmin/request/delete/'.$data->id)}}" class="delete-driver" ><i class="fa fa-trash-o"></i></a>
                               </td>
                              </tr>
                            @php $p++ @endphp
                           @endforeach
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

@endsection