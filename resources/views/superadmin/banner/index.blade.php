@extends('superadmin.layouts.master')

@section('content')
<div class="content-page">
   <!-- Start content  -->
   <div class="content">
      <div class="container-fluid">
         <!-- Page-Title -->
         <div class="row">
            <div class="col-sm-12">
               <div class="btn-group pull-right m-t-15 m-b-10">
                  <a href="{{url('superAdmin/banner/add')}}" class="btn btn-default  waves-light" >Add Banner</a>
               </div>
               <!-- <h4 class="page-title">Stores</h4> -->
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                  <li class="breadcrumb-item active">Banner Ads</li>
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
                    <h4 class="m-t-0 header-title">Banner Ads</h4>
                  <table id="datatable" class="table table-bordered">
                     <thead>
                        <tr>
                           <th>ID</th>
                           <th>SHOP NAME</th>
                           <th>IMAGE</th>
                           <th>STATUS</th>
                           <th>ACTION</th>
                           
                        </tr>
                     </thead>
                     <tbody>
                        @if(count($banner)>0)
                          @foreach($banner as $value)
                            <tr>
                              <td>{{$value->id}}</td>
                              <td>{{$value->store_name}}</td>
                              <td>
                              @if($value->banner)
                                     <img style="width: 60px" src="{{imgUrl($value->banner)}}" alt="">
                                  @else
                                  <img style="width: 60px" src="{{imgUrl('/app/file/default.png')}}">
                                  @endif
                              </td>
                              <td>
                               @if($value->status==1)
                             <a href="{{url('superAdmin/banner/status/'.$value->id)}}" style="color:green">Active</a>
                              @else
                             <a href="{{url('superAdmin/banner/status/'.$value->id)}}" style="color:red">In-active</a>
                              @endif
                              </td>
                              <td>
                                <a href="{{url('superAdmin/banner/edit/'.$value->id)}}"><i class="fa fa-pencil"></i></a>&nbsp 
                              <a href="{{url('superAdmin/banner/delete/'.$value->id)}}" class="delete-driver" data-store="{{$value->id}}"><i class="fa fa-trash-o"></i></a>
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