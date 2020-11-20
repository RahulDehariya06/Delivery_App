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
                  <a href="{{url('superAdmin/users/add')}}" class="btn btn-default  waves-light" >Add user</a>
               </div>
               <!-- <h4 class="page-title">Stores</h4> -->
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                  <li class="breadcrumb-item active"> User List</li>
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
                   <h4 class="m-t-0 header-title">User List</h4>
                  <table id="datatable" class="table table-bordered">
                     <thead>
                        <tr>
                           <th>ID</th>
                           <th>Image</th>
                           <th>USER NAME</th>
                           <th>EMAIL ADDRESS</th>
                           <th>PHONE NUMBER</th> 
                           <th>STATUS</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        @if(count($users)>0)
                            @foreach($users as $list)
                                <tr>
                                    <td>{{$list->id}}</td>
                                    <td>
                                      @if($list->photo)
                                         <img style="width: 40px" src="{{imgUrl($list->photo)}}" alt="">
                                      @else
                                      <img style="width: 40px" src="{{url('storage/app/file/default.png')}}">
                                      @endif
                                    </td>
                                    
                                    <td>{{$list->name}}</td>
                                    <td>{{$list->email}}</td>
                                    <td>{{$list->phone}}</td>
                                    <td>
                                     @if($list->status==1)
                                     <a href="{{url('superAdmin/users/status/'.$list->id)}}" style="color:green">Active</button>
                                      @else
                                     <a href="{{url('superAdmin/users/status/'.$list->id)}}" style="color:red">In-active</button>
                                      @endif
                                    </td>
                                    <td>
                                      <a href="{{url('superAdmin/users/edit/'.$list->id)}}"><i class="fa fa-pencil"></i></a>&nbsp
                                      <a href="{{url('superAdmin/users/profile/'.$list->id)}}"><i class="md md-remove-red-eye"></i></a>&nbsp
                                      <a href="{{url('superAdmin/users/delete/'.$list->id)}}" class="delete-store" data-store="{{$list->id}}"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td>No users found</td>
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