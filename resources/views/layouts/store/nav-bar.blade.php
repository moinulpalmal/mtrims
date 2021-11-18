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
                            <ul id="navigation">
                                <!-- NAVIGATION Content -->
                                <li class="{{ (request()->is('store/home')) ? 'active' : '' }}"><a href="{{route('store.home')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
                                <li class="{{ (request()->is('store/transport')) ? 'active' : '' }}"><a href="{{route('store.transport')}}"><i class="fa fa-truck"></i> <span>Transport</span></a></li>

                                <li class="{{ (request()->is('store/receive*')) ? 'active open' : '' }}">
                                    <a role="button" tabindex="0"><i class="fa fa-shopping-cart"></i> <span>Receive</span></a>
                                    <ul>
                                        <li class="{{ (request()->is('store/receive/trims*')) ? 'active open' : '' }}">
                                            <a role="button" tabindex="0"><i class="fa fa-caret-right"></i> Trims</a>
                                            <ul>
                                                @if(Auth::user()->hasTaskPermission('receivefinishedtrims', Auth::user()->id))
                                                    <li class="{{ (request()->is('store/receive/trims/finished-in-house')) ? 'active' : '' }}" ><a href="{{route('store.receive.trims.finished-in-house')}}"><i class="fa fa-caret-right"></i>In-House</a></li>
                                                    <li class="{{ (request()->is('store/receive/trims/received')) ? 'active' : '' }}" ><a href="{{route('store.receive.trims.received')}}"><i class="fa fa-caret-right"></i>Transactions</a></li>
                                                    <li class="{{ (request()->is('store/receive/trims/finished-left-over')) ? 'active' : '' }}" ><a href="{{route('store.receive.trims.finished-left-over')}}"><i class="fa fa-caret-right"></i>Left Over In-House</a></li>
                                                    <li class="{{ (request()->is('store/receive/trims/received-left-over')) ? 'active' : '' }}" ><a href="{{route('store.receive.trims.received-left-over')}}"><i class="fa fa-caret-right"></i>Left Over Transactions</a></li>
                                                    <li class="{{ (request()->is('store/receive/trims/finished-non-production')) ? 'active' : '' }}" ><a href="{{route('store.receive.trims.finished-non-production')}}"><i class="fa fa-caret-right"></i>Non Production</a></li>
                                                    <li class="{{ (request()->is('store/receive/trims/received-non-production')) ? 'active' : '' }}" ><a href="{{route('store.receive.trims.received-non-production')}}"><i class="fa fa-caret-right"></i>Non Production Transactions</a></li>

                                                @endif
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li class="{{ (request()->is('store/stock*')) ? 'active open' : '' }}">
                                    <a role="button" tabindex="0"><i class="fa fa-institution"></i> <span>Stock</span></a>
                                    <ul>
                                        <li class="{{ (request()->is('store/stock/trims*')) ? 'active open' : '' }}">
                                            <a role="button" tabindex="0"><i class="fa fa-caret-right"></i> Trims</a>
                                            <ul>
                                                <li class="{{ (request()->is('store/stock/trims')) ? 'active' : '' }}" ><a href="{{route('store.stock.trims')}}"><i class="fa fa-caret-right"></i> Current Stocks</a></li>
                                                <li class="{{ (request()->is('store/stock/free-trims*')) ? 'active open' : '' }}">
                                                    <a role="button" tabindex="0"><i class="fa fa-caret-right"></i> <span> Free Stocks</span></a>
                                                    <ul>
                                                        <li class="{{ (request()->is('store/stock/free-trims/current')) ? 'active' : '' }}" ><a href="{{route('store.stock.free-trims.current')}}"><i class="fa fa-caret-right"></i> Free Current Stocks</a></li>
                                                        <li class="{{ (request()->is('store/stock/free-trims/requested-left-over')) ? 'active' : '' }}" ><a href="{{route('store.stock.free-trims.requested-left-over')}}"><i class="fa fa-caret-right"></i> Left Over Requested</a></li>
                                                    </ul>
                                                </li>
                                                <li class="{{ (request()->is('store/stock/blocked-trims')) ? 'active' : '' }}" ><a href="{{route('store.stock.blocked-trims')}}"><i class="fa fa-caret-right"></i> Blocked Stocks</a></li>
                                                <li class="{{ (request()->is('store/stock/left-over-trims')) ? 'active' : '' }}" ><a href="{{route('store.stock.left-over-trims')}}"><i class="fa fa-caret-right"></i> Left Over Stocks</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li class="{{ (request()->is('store/delivery*')) ? 'active open' : '' }}">
                                    <a role="button" tabindex="0"><i class="fa fa-truck"></i> <span>Delivery</span></a>
                                    <ul>
                                        <li class="{{ (request()->is('store/delivery/trims*')) ? 'active open' : '' }}">
                                            <a role="button" tabindex="0"><i class="fa fa-caret-right"></i> Trims</a>
                                            <ul>
                                                <li class="{{ (request()->is('store/delivery/trims/po-list')) ? 'active' : '' }}" ><a href="{{route('store.delivery.trims.po-list')}}"><i class="fa fa-caret-right"></i> Delivery PO List</a></li>
                                                <li class="{{ (request()->is('store/delivery/trims')) ? 'active' : '' }}" ><a href="{{route('store.delivery.trims')}}"><i class="fa fa-caret-right"></i> Delivery Challan List</a></li>
                                                {{--                                                <li class="{{ (request()->is('store/stock/trims/finished-sub-contact')) ? 'active' : '' }}" ><a href="{{route('store.receive.trims.finished-sub-contact')}}"><i class="fa fa-caret-right"></i> Sub-Contact</a></li>--}}

                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li class="{{ (request()->is('store/report*')) ? 'active open' : '' }}">
                                    <a role="button" tabindex="0"><i class="fa fa-file-pdf-o"></i> <span>Report</span></a>
                                    <ul>
                                        <li class="{{ (request()->is('store/report/trims*')) ? 'active open' : '' }}">
                                            <a role="button" tabindex="0"><i class="fa fa-caret-right"></i> Trims</a>
                                            <ul>
                                                <li class="{{ (request()->is('store/report/trims/delivery')) ? 'active' : '' }}" ><a href="{{route('store.report.trims.delivery')}}"><i class="fa fa-caret-right"></i> Delivery Report</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                            <!-- NAVIGATION Content -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </aside>
    <!--/ SIDEBAR Content -->
</div>
