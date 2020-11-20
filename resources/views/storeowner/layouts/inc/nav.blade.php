<div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">
                    <!--- Divider -->
                    <div id="sidebar-menu">
                        <ul>

                            <li class="text-muted menu-title">Navigation</li>

                            <li class="has_sub">
                               
                                    <li>
                                        <a href="{{url('StoreOwner/dashboard')}}" class="{{ request()->is('StoreOwner/dashboard') ? 'active' : '' }}"><i class="ti-home"></i> Dashboard </a>
                                    </li>

                                    <li>
                                        <a href="{{url('StoreOwner/products')}}" class="{{ request()->is('StoreOwner/products') ? 'active' : '' }}"><i class="fa fa-product-hunt"></i>Products</a>
                                    </li>
                                    <li>
                                        <a href="{{url('StoreOwner/orders')}}" class="{{ request()->is('StoreOwner/orders') ? 'active' : '' }}"><i class="fa fa-shopping-bag" aria-hidden="true"></i>Orders </a>
                                    </li>
                                    <li>
                                        <a href="{{url('StoreOwner/sales')}}" class="{{ request()->is('StoreOwner/sales') ? 'active' : '' }}"><i class="fa fa-address-card-o" aria-hidden="true"></i> Sales</a>
                                    </li>
                                    <li>
                                     <a href="{{url('StoreOwner/dispatcher')}}" class="{{ request()->is('StoreOwner/dispatcher') ? 'active' : '' }}"><i class="ti-files"></i> Dispatcher </a>
                                    </li>
                                    <li>
                                        <a href="{{url('StoreOwner/dispute')}}" class="{{ request()->is('StoreOwner/dispute') ? 'active' : '' }}"><i class="ti-files"></i> Dispute </a>
                                    </li>
                                    
                                    <li>
                                        <a href="{{url('StoreOwner/payment')}}" class="{{ request()->is('StoreOwner/payment') ? 'active' : '' }}"><i class="md md-payment"></i>Payment </a>
                                    </li>
                               
                            </li>

                            

                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>