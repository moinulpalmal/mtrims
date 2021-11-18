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
                                <li class="{{ (request()->is('lpd1/home')) ? 'active' : '' }}"><a href="{{route('lpd1.home')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
                                <li class="{{ (request()->is('lpd1/purchase/order*')) ? 'active open' : '' }}">
                                    <a role="button" tabindex="0"><i class="fa fa-cart-plus"></i> <span>Purchase Order</span></a>
                                    <ul>
                                        @if(Auth::user()->hasTaskPermission('lpdonecreatepo', Auth::user()->id))
                                            <li class="{{ (request()->is('lpd1/purchase/order/new')) ? 'active' : '' }}" ><a href="{{route('lpd1.purchase.order.new')}}"><i class="fa fa-caret-right"></i> New Purchase Order</a></li>
                                        @endif
                                        <li class="{{ (request()->is('lpd1/purchase/order/active')) ? 'active' : '' }}" ><a href="{{route('lpd1.purchase.order.active')}}"><i class="fa fa-caret-right"></i> Active Purchase Orders</a></li>
                                            <li class="{{ (request()->is('lpd1/purchase/order/closed')) ? 'active' : '' }}" ><a href="{{route('lpd1.purchase.order.closed')}}"><i class="fa fa-caret-right"></i> Closed Purchase Orders</a></li>
{{--                                        <li class="{{ (request()->is('admin/yarn/setup')) ? 'active' : '' }}" ><a href="{{route('admin.yarn.setup')}}"><i class="fa fa-caret-right"></i> Yarn Setup</a></li>--}}
                                    </ul>
                                </li>
                                @if(Auth::user()->hasTaskPermission('lpdonepi', Auth::user()->id))
                                    <li class="{{ (request()->is('lpd1/proforma-invoice*')) ? 'active open' : '' }}">
                                        <a role="button" tabindex="0"><i class="fa fa-file-pdf-o"></i> <span>Proforma Invoice</span></a>
                                        <ul>
                                            <li class="{{ (request()->is('lpd1/proforma-invoice/po-list')) ? 'active' : '' }}" ><a href="{{route('lpd1.proforma-invoice.po-list')}}"><i class="fa fa-caret-right"></i> Purchase Order List</a></li>
                                            {{--                                        <li class="{{ (request()->is('lpd2/proforma-invoice/pi-po-list')) ? 'active' : '' }}" ><a href="{{route('lpd2.proforma-invoice.pi-po-lost')}}"><i class="fa fa-caret-right"></i> Active PI PO List</a></li>--}}
                                            {{--                                        <li class="{{ (request()->is('lpd2/proforma-invoice')) ? 'active' : '' }}" ><a href="{{route('lpd2.proforma-invoice')}}"><i class="fa fa-caret-right"></i> Proforma Invoice</a></li>--}}
                                            {{--                                        <li class="{{ (request()->is('admin/yarn/setup')) ? 'active' : '' }}" ><a href="{{route('admin.yarn.setup')}}"><i class="fa fa-caret-right"></i> Yarn Setup</a></li>--}}
                                        </ul>
                                    </li>
                                @endif

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
