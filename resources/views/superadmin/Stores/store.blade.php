@extends('superadmin.layouts.master')

@section('content')
 <div class="content-page">
<!-- Start content -->
<div class="content">
   <div class="container-fluid">
      <!-- Page-Title -->
      <div class="row">
         <div class="col-sm-12">

           
            <!-- <h4 class="page-title">Store Detail</h4> -->
            <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Stores</a></li>
                  <li class="breadcrumb-item"><a href="#">Store Profile</a></li>
               </ol>
         </div>
      </div>
      <div class="row">
         <div class="col-12">
            <div class="card-box product-detail-box">
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
               <!-- end row -->
               <div class="row m-t-30">
                  <div class="col-12">
                     <h4 class="font-18"><b>Store Detail:</b></h4>
                     <div class="table-responsive m-t-20">
                        <table class="table">
                           <tbody>
                              <tr>
                                 <td width="400">Store Name</td>
                                 <td>
                                    {{$store->store_name}}
                                 </td>
                              </tr>
                              <tr>
                                 <td>Owner Name</td>
                                 <td>
                                     {{$store->store_name}}
                                 </td>
                              </tr>
                              <tr>
                                 <td>Owner Email</td>
                                 <td>
                                     {{$store->email}}
                                 </td>
                              </tr>
                              <tr>
                                 <td> Phone No</td>
                                 <td>
                                     {{$store->phone}}
                                 </td>
                              </tr>
                              
                              <tr>
                                 <td>Rating</td>
                                 <td>
                                     {{$store->rating}}
                                 </td>
                              </tr>
                              
                              <tr>
                                 <td>Description</td>
                                 <td>
                                    {{$store->description}}
                                 </td>
                              </tr>
                              <tr>
                                 <td>Open Time</td>
                                 <td>
                                   {{$store->store_open_time}}
                                 </td>
                              </tr>
                              <tr>
                                 <td>Close Time</td>
                                 <td>
                                   {{$store->store_close_time}}
                                 </td>
                              </tr>
                              <tr>
                                 <td>Max Delivery Time</td>
                                 <td>
                                   {{$store->max_delivery_time}}
                                 </td>
                              </tr>
                              
                              <tr>
                                 <td>Address</td>
                                 <td>
                                    {{$store->address}}
                                 </td>
                              </tr>
                              <tr>
                                 <td>Status</td>
                                 <td>
                                     @if($store->status==1)
                                        <p style="color:green">Active</p>
                                     @else
                                         <p style="color:red">De-active</p>
                                    @endif
                                 </td>
                              </tr>
                              <tr>
                                 <td>Approval</td>
                                 <td>
                                     @if($store->approved==1)
                                        <p style="color:green">Approved</p>
                                     @else
                                         <p style="color:red">Pending</p>
                                    @endif
                                 </td>
                              </tr>
                              
                              
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
            <!-- end card-box/Product detai box -->
         </div>
         <!-- end col -->
      </div>
      <!-- end row -->
   </div>
   <!-- container -->
</div>
<!-- content -->

                

 </div>
	

@endsection