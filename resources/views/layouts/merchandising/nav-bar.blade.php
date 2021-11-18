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
                                <li class="{{ (request()->is('merchandising/home')) ? 'active' : '' }}"><a href="{{route('merchandising.home')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
                                <li class="{{ (request()->is('merchandising/purchase/order*')) ? 'active open' : '' }}">
                                    <a role="button" tabindex="0"><i class="fa fa-cart-plus"></i> <span>Purchase Order</span></a>
                                    <ul>
                                        <li class="{{ (request()->is('merchandising/purchase/order/search')) ? 'active' : '' }}" ><a href="{{route('merchandising.purchase.order.search')}}"><i class="fa fa-caret-right"></i>Purchase Order Search</a></li>
                                    </ul>
                                </li>
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
