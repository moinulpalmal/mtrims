<div id="controls">
    <!-- ================================================
    ================= SIDEBAR Content ===================
    ================================================= -->
    <aside id="sidebar">
        <div id="sidebar-wrap" class="">
            <div class="panel-group slim-scroll" role="tablist">
                <div class="panel panel-default">
                    <div id="sidebarNav" class="panel-collapse collapse in" role="tabpanel">
                        <div class="panel-body">
                            <!-- ===================================================
                            ================= NAVIGATION Content ===================
                            ==================================================== -->
                            <ul id="navigation">
                                <li class="{{ (request()->is('admin/home')) ? 'active' : '' }}"><a href="{{route('admin.home')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
                                <li class="{{ (request()->is('admin/factory')) ? 'active' : '' }}"><a href="{{route('admin.factory')}}"><i class="fa fa-building"></i> <span>Factory</span></a></li>
                                <li class="{{ (request()->is('admin/department')) ? 'active' : '' }}"><a href="{{route('admin.department')}}"><i class="fa fa-university"></i> <span>Department</span></a></li>
                                <li class="{{ (request()->is('admin/store')) ? 'active' : '' }}"><a href="{{route('admin.store')}}"><i class="fa fa-building"></i> <span>Store</span></a></li>
                                <li class="{{ (request()->is('admin/buyer')) ? 'active' : '' }}"><a href="{{route('admin.buyer')}}"><i class="fa fa-train"></i> <span>Buyer</span></a></li>
                                <li class="{{ (request()->is('admin/supplier')) ? 'active' : '' }}"><a href="{{route('admin.supplier')}}"><i class="fa fa-truck"></i> <span>Supplier</span></a></li>
                                <li class="{{ (request()->is('admin/sub-contractor')) ? 'active' : '' }}"><a href="{{route('admin.sub-contractor')}}"><i class="fa fa-file"></i> <span>Sub-Contractor</span></a></li>
                                <li class="{{ (request()->is('admin/unit')) ? 'active' : '' }}"><a href="{{route('admin.unit')}}"><i class="fa fa-database"></i> <span>Unit</span></a></li>
                                <li class="{{ (request()->is('admin/trims-type')) ? 'active' : '' }}"><a href="{{route('admin.trims-type')}}"><i class="fa fa-database"></i> <span>Trims Type</span></a></li>
                                <li class="{{ (request()->is('admin/yarn*')) ? 'active open' : '' }}">
                                    <a role="button" tabindex="0"><i class="fa fa-database"></i> <span>Yarn</span></a>
                                    <ul>
                                        <li class="{{ (request()->is('admin/yarn/type')) ? 'active' : '' }}" ><a href="{{route('admin.yarn.type')}}"><i class="fa fa-caret-right"></i> Yarn Type</a></li>
                                        <li class="{{ (request()->is('admin/yarn/count')) ? 'active' : '' }}" ><a href="{{route('admin.yarn.count')}}"><i class="fa fa-caret-right"></i> Yarn Count</a></li>
                                        <li class="{{ (request()->is('admin/yarn/setup')) ? 'active' : '' }}" ><a href="{{route('admin.yarn.setup')}}"><i class="fa fa-caret-right"></i> Yarn Setup</a></li>
                                    </ul>
                                </li>
                                <li class="{{ (request()->is('admin/bank*')) ? 'active open' : '' }}">
                                    <a role="button" tabindex="0"><i class="fa fa-bank"></i> <span>Bank</span></a>
                                    <ul>
                                        <li class="{{ (request()->is('admin/bank/setup')) ? 'active' : '' }}" ><a href="{{route('admin.bank.setup')}}"><i class="fa fa-caret-right"></i> Bank Setup</a></li>
                                        {{-- <li class="{{ (request()->is('admin/yarn/count')) ? 'active' : '' }}" ><a href="{{route('admin.yarn.count')}}"><i class="fa fa-caret-right"></i> Yarn Count</a></li>
                                        <li class="{{ (request()->is('admin/yarn/setup')) ? 'active' : '' }}" ><a href="{{route('admin.yarn.setup')}}"><i class="fa fa-caret-right"></i> Yarn Setup</a></li> --}}
                                    </ul>
                                </li>
                                <li class="{{ (request()->is('admin/user*')) ? 'active open' : '' }}">
                                    <a role="button" tabindex="0"><i class="fa fa-users"></i> <span>Users</span></a>
                                    <ul>
                                        <li class="{{ (request()->is('admin/user')) ? 'active' : '' }}" ><a href="{{route('admin.user')}}"><i class="fa fa-caret-right"></i> Current User List</a></li>
                                        @if(Auth::user()->hasTaskPermission('restoreuser', Auth::user()->id))
                                            <li class="{{ (request()->is('admin/historical-user')) ? 'active' : '' }}" ><a href="{{route('admin.historical-user')}}"><i class="fa fa-caret-right"></i> Historical User List</a></li>
                                        @endif

                                        <li class="{{ (request()->is('admin/user/role')) ? 'active' : '' }}" ><a href="{{route('admin.user.role')}}"><i class="fa fa-caret-right"></i> User Roles</a></li>
                                        <li class="{{ (request()->is('admin/user/task')) ? 'active' : '' }}" ><a href="{{route('admin.user.task')}}"><i class="fa fa-caret-right"></i> User Tasks</a></li>
                                    </ul>
                                </li>
                               {{-- @if((Auth::user()->hasRole('Administrator')) || (Auth::user()->hasRole('Manager')) || (Auth::user()->hasRole('User')) || (Auth::user()->hasRole('Subscriber')))
                                    <li class="{{ (request()->is('lc*')) ? 'active open' : '' }}">
                                        <a role="button" tabindex="0"><i class="fa fa-file-pdf-o"></i> <span>LC</span></a>
                                        <ul>
                                            <li class="{{ (request()->is('lc/document*')) ? 'active open' : '' }}">
                                                <a role="button" tabindex="0"><i class="fa fa-caret-right"></i> Documents</a>
                                                <ul>
                                                    <li class="{{ (request()->is('lc/document*')) ? 'active' : '' }}" ><a href="{{asset('/lc/document')}}"><i class="fa fa-caret-right"></i> Document List</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                @endif--}}
                                {{--@if((Auth::user()->hasRole('Administrator')) )
                                    <li class="{{ (request()->is('admin*')) ? 'active open' : '' }}">
                                        <a role="button" tabindex="0"><i class="fa fa-cogs"></i> <span>Administration</span></a>
                                        <ul>
                                            <li class="{{ (request()->is('admin/user*')) ? 'active open' : '' }}">
                                                <a role="button" tabindex="0"><i class="fa fa-caret-right"></i> Users</a>
                                                <ul>
                                                    <li class="{{ (request()->is('admin/user')) ? 'active' : '' }}" ><a href="{{asset('/admin/user')}}"><i class="fa fa-caret-right"></i> Current User List</a></li>
                                                    <li class="{{ (request()->is('admin/user/historical-user*')) ? 'active' : '' }}" ><a href="{{asset('/admin/user/historical-user')}}"><i class="fa fa-caret-right"></i> Historical User List</a></li>
                                                </ul>
                                            </li>

                                            --}}{{--<li><a href="ui-buttons-icons.html"><i class="fa fa-caret-right"></i> Buttons & Icons</a></li>
                                            <li><a href="ui-typography.html"><i class="fa fa-caret-right"></i> Typography</a></li>
                                            <li><a href="ui-navs.html"><i class="fa fa-caret-right"></i> Navigation & Accordions</a></li>
                                            <li><a href="ui-modals.html"><i class="fa fa-caret-right"></i> Modals</a></li>
                                            <li><a href="ui-tiles.html"><i class="fa fa-caret-right"></i> Tiles</a></li>
                                            <li><a href="ui-portlets.html"><i class="fa fa-caret-right"></i> Portlets</a></li>
                                            <li><a href="ui-grid.html"><i class="fa fa-caret-right"></i> Grid</a></li>
                                            <li><a href="ui-widgets.html"><i class="fa fa-caret-right"></i> Widgets</a></li>
                                            <li><a href="ui-tree.html"><i class="fa fa-caret-right"></i> Tree </a></li>
                                            <li><a href="ui-lists.html"><i class="fa fa-caret-right"></i> Lists</a></li>
                                            <li><a href="ui-alerts.html"><i class="fa fa-caret-right"></i> Alerts & Notifications</a></li>--}}{{--
                                        </ul>
                                    </li>
                                @endif--}}
                                {{--<li class="{{ (request()->is('shop*')) ? 'active open' : '' }}">
                                    <a role="button" tabindex="0"><i class="fa fa-shopping-cart"></i> <span>Shop</span></a>
                                    <ul>
                                        @if((Auth::user()->hasRole('admin')))
                                            <li class="{{ (request()->is('shop/product-class*')) ? 'active open' : '' }}">
                                                <a role="button" tabindex="0"><i class="fa fa-caret-right"></i> Product Class</a>
                                                <ul>
                                                    <li class="{{ (request()->is('shop/product-class/add*')) ? 'active' : '' }}"><a href="{{asset('/shop/product-class/add')}}"><i class="fa fa-caret-right"></i> Add Class</a></li>
                                                    <li class="{{ (request()->is('shop/product-class/manage*')) ? 'active' : '' }}"><a href="{{asset('/shop/product-class/manage')}}"><i class="fa fa-caret-right"></i> Manage Class</a></li>
                                                </ul>
                                            </li>
                                            @endif

                                        @if((Auth::user()->hasRole('admin')))
                                                <li class="{{ (request()->is('shop/product-category*')) ? 'active open' : '' }}">
                                                    <a role="button" tabindex="0"><i class="fa fa-caret-right"></i> Product Category</a>
                                                    <ul>
                                                        <li class="{{ (request()->is('shop/product-category/add*')) ? 'active' : '' }}"><a href="{{asset('/shop/product-category/add')}}"><i class="fa fa-caret-right"></i> Add Category</a></li>
                                                        <li class="{{ (request()->is('shop/product-category/manage*')) ? 'active' : '' }}"><a href="{{asset('/shop/product-category/manage')}}"><i class="fa fa-caret-right"></i> Manage Category</a></li>
                                                    </ul>
                                                </li>
                                            @endif

                                        --}}{{--<li class="{{ (request()->is('shop/product*')) ? 'active open' : '' }}">
                                            <a role="button" tabindex="0"><i class="fa fa-caret-right"></i> Product</a>
                                            <ul>
--}}{{----}}{{--                                                <li class="{{ (request()->is('shop/product/add*')) ? 'active' : '' }}"><a href="{{asset('/shop/product-category/add')}}"><i class="fa fa-caret-right"></i> Add Category</a></li>--}}{{----}}{{--
                                                <li class="{{ (request()->is('shop/product/manage*')) ? 'active' : '' }}"><a href="{{asset('/shop/product/manage')}}"><i class="fa fa-caret-right"></i> Manage Product</a></li>
                                            </ul>
                                        </li>--}}{{--
                                        <li class="{{ (request()->is('shop/product*')) ? 'active open' : '' }}"><a href="{{asset('/shop/product/manage')}}"><i class="fa fa-caret-right"></i> Products</a></li>
                                        <li><a href="shop-single-product.html"><i class="fa fa-caret-right"></i> Single Product</a></li>
                                        <li><a href="shop-invoices.html"><i class="fa fa-caret-right"></i> Invoices</a></li>
                                        <li><a href="shop-single-invoice.html"><i class="fa fa-caret-right"></i> Single Invoice</a></li>

                                    </ul>
                                </li>--}}


                            </ul>
                            <!--/ NAVIGATION Content -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </aside>
    <!--/ SIDEBAR Content -->
</div>
