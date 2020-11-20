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
                  <li class="breadcrumb-item"><a href="#">Delivery Boy</a></li>
                  <li class="breadcrumb-item"><a href="#">Delivery Boy Profile</a></li>
               </ol>
         </div>
      </div>
      <div class="row">
         <div class="col-12">
            <div class="card-box product-detail-box">
              <div class="row">
             
              </div>
               <!-- end row -->
                <h4 class="font-18"><b>Delivery Boy  Detail:</b></h4>
               <div class="row m-t-30">
                  <div class="col-12">
                    <div class="row">

                       <div class="col-sm-4">
                          <div class="sp-wrap">
                            @if($profile->photo)
                              <img style="width: 200px" src="{{imgUrl($profile->photo)}}" alt="">
                            @else
                               <img style="width: 200px;border-radius: 50%;" src="{{imgUrl('/app/file/default.png')}}" alt="">
                            @endif
                          </div>
                    </div>
              </div>
                    
                     <div class="table-responsive m-t-20">
                        <table class="table">
                           <tbody>
                              <tr>
                                 <td width="400"> Name</td>
                                 <td>
                                   {{$profile->name}}
                                 </td>
                              </tr>
                              
                              <tr>
                                 <td> Email</td>
                                 <td>
                                     {{$profile->email}} 
                                 </td>
                              </tr>
                              <tr>
                                 <td> Phone No</td>
                                 <td>
                                     {{$profile->phone}}
                                 </td>
                              </tr>
                              
                              <tr>
                                 <td>Rating</td>
                                 <td>
                                     {{$profile->rating}}
                                 </td>
                              </tr>
                              
                              <tr>
                                 <td>Address</td>
                                 <td>
                                    {{$profile->address}}
                                 </td>
                              </tr>
                              <tr>
                                 <td>Status</td>
                                 <td>
                                      @if($profile->status==1)
                                     <a href="{{url('/status/'.$profile->id)}}" style="color:green">Active</button>
                                      @else
                                     <a href="{{url('/status/'.$profile->id)}}" style="color:red">In-active</button>
                                      @endif
                                 </td>
                              </tr>
                              <tr>
                                 <td>Approval</td>
                                 <td>
                                   @if($profile->approved==1)
                                        <p style="color:green">Approved</p>
                                     @else
                                         <p style="color:red">Pending</p>
                                    @endif
                                    
                                 </td>
                              </tr>
                              <tr>
                                 <td>Licence Front</td>
                                 <td>
                                   <img src="{{url('storage/'.$profile->licence_front_img)}}">
                                    
                                 </td>
                              </tr>
                              <tr>
                                 <td>Licence back</td>
                                 <td>
                                  
                                    <img src="{{url('storage/'.$profile->licence_back_img)}}"> 
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