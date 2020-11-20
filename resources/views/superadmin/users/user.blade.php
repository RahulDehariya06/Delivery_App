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
                  <li class="breadcrumb-item"><a href="#">Users</a></li>
                  <li class="breadcrumb-item"><a href="#">User Profile</a></li>
               </ol>
         </div>
      </div>
      <div class="row">
         <div class="col-12">
            <div class="card-box product-detail-box">
              <div class="row">
               @if($user->photo)
                    <img style="width: 200px" src="{{imgUrl($user->photo)}}" alt="">
                  @else
                     <img style="width: 200px;border-radius: 50%;" src="{{imgUrl('/app/file/default.png')}}" alt="">
                  @endif
              </div>
               <!-- end row -->
               <div class="row m-t-30">
                  <div class="col-12">
                     <h4 class="font-18"><b>User Detail:</b></h4>
                     <div class="table-responsive m-t-20">
                        <table class="table">
                           <tbody>
                              <tr>
                                 <td width="400">Store Name</td>
                                 <td>
                                    {{$user->name}}
                                 </td>
                              </tr>
                              
                              <tr>
                                 <td>Owner Email</td>
                                 <td>
                                     {{$user->email}}
                                 </td>
                              </tr>
                              <tr>
                                 <td> Phone No</td>
                                 <td>
                                     {{$user->phone}}
                                 </td>
                              </tr>
                               <tr>
                                 <td> DOB</td>
                                 <td>
                                     {{$user->dob}}
                                 </td>
                              </tr>
                              
                              <tr>
                                 <td>Address</td>
                                 <td>
                                     {{$user->address}}
                                 </td>
                              </tr>
                              
                              <tr>
                                 <td>Status</td>
                                 <td>
                                     @if($user->status==1)
                                        <p style="color:green">Active</p>
                                     @else
                                         <p style="color:red">De-active</p>
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