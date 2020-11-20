@extends('storeowner.layouts.master')

@section('content')
 <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="btn-group pull-right m-t-15">
                                    <a href="{{url('StoreOwner/products/add')}}" class="btn btn-default waves-effect waves-light" >Add Product</a>
                                    
                                </div>

                                <h4 class="page-title">Products</h4>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="#">Products</a></li>
                                  
                                </ol>

                            </div>
                        </div>




                    </div> <!-- container -->

                </div> <!-- content -->

                <footer class="footer text-right">
                    &copy; 2016 - 2018. All rights reserved.
                </footer>

            </div>

@endsection