<div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">
                    <!--- Divider -->
                    <div id="sidebar-menu">
                        <ul>

                            <li class="text-muted menu-title">Navigation</li>

                            <li class="has_sub">
                               
                                    <li>
                                        <a href="{{url('superAdmin/dashboard')}}" class="{{ request()->is('superAdmin/dashboard') ? 'active' : '' }}"><i class="ti-home"></i> Dashboard </a>
                                    </li>

                                    <li>
                                        <a href="{{url('superAdmin/users')}}" class="{{ request()->is('superAdmin/users') ? 'active' : '' }}"><i class="ti-user"></i>Users</a>
                                    </li>
                                    <li>
                                        <a href="{{url('superAdmin/stores')}}" class="{{ request()->is('superAdmin/stores') ? 'active' : '' }}"><i class="fa fa-shopping-bag" aria-hidden="true"></i> Stores </a>
                                    </li>
                                    <li>
                                        <a href="{{url('superAdmin/deliveryboy')}}" class="{{ request()->is('superAdmin/deliveryboy') ? 'active' : '' }}"><i class="fa fa-address-card-o" aria-hidden="true"></i> Delivery Boy </a>
                                    </li>
                                    <li>
                                        <a href="{{url('superAdmin/orders')}}" class="{{ request()->is('superAdmin/orders') ? 'active' : '' }}"><i class="fa fa-shopping-bag" aria-hidden="true"></i> Orders </a>
                                    </li>
                                    <li>
                                        <a href="{{url('superAdmin/promocode')}}" class="{{ request()->is('superAdmin/promocode') ? 'active' : '' }}"> <i class="fa fa-gift" aria-hidden="true"></i> Promocode </a>
                                    </li>
                                    <li>
                                        <a href="{{url('superAdmin/banner')}}" class="{{ request()->is('superAdmin/banner') ? 'active' : '' }}"><i class="fa fa-flag" aria-hidden="true"></i> Banner </a>
                                    </li>
                                    <li>
                                        <a href="{{url('superAdmin/requests')}}" class="{{ request()->is('superAdmin/requests') ? 'active' : '' }}"><i class="ti-files"></i> Request </a>
                                    </li>
                                    <li>
                                        <a href="{{url('superAdmin/dispatcher')}}" class="{{ request()->is('superAdmin/dispatcher') ? 'active' : '' }}"><i class="ti-files"></i> Dispatcher </a>
                                    </li>
                                    <li>
                                        <a href="{{url('superAdmin/dispute')}}" class="{{ request()->is('superAdmin/dispute') ? 'active' : '' }}"><i class="ti-files"></i> Dispute </a>
                                    </li>
                                    <li>
                                        <a href="{{url('superAdmin/notification')}}" class="{{ request()->is('superAdmin/notification') ? 'active' : '' }}"><i class="fa fa-bell" aria-hidden="true"></i> Notification </a>
                                    </li>
                                    <li>
                                        <a href="{{url('superAdmin/payment')}}" class="{{ request()->is('superAdmin/payment') ? 'active' : '' }}"><i class="md md-payment"></i>Payment </a>
                                    </li>
                               
                            </li>

                            

                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>