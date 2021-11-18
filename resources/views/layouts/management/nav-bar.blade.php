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
                                <li class="{{ (request()->is('management/home')) ? 'active' : '' }}"><a href="{{route('management.home')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
                                <li class="{{ (request()->is('management/sales*')) ? 'active open' : '' }}">
                                    <a role="button" tabindex="0"><i class="fa fa-cart-plus"></i> <span>Sales</span></a>
                                    <ul>
                                        <li class="{{ (request()->is('management/sales/report/generate')) ? 'active' : '' }}" ><a href="{{route('management.sales.report.generate')}}"><i class="fa fa-caret-right"></i>Sales Report</a></li>
                                    </ul>
                                </li>
                                <li class="{{ (request()->is('management/delivery*')) ? 'active open' : '' }}">
                                    <a role="button" tabindex="0"><i class="fa fa-truck"></i> <span>Delivery</span></a>
                                    <ul>
                                        <li class="{{ (request()->is('management/delivery/report/generate')) ? 'active' : '' }}" ><a href="{{route('management.delivery.report.generate')}}"><i class="fa fa-caret-right"></i>Delivery Report</a></li>
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
