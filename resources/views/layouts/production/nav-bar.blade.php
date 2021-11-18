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
                                <li class="{{ (request()->is('production/home')) ? 'active' : '' }}"><a href="{{route('production.home')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
                                @if(Auth::user()->hasTaskPermission('sectionsetup', Auth::user()->id))
                                    <li class="{{ (request()->is('production/section')) ? 'active' : '' }}"><a href="{{route('production.section')}}"><i class="fa fa-cogs"></i> <span>Section Setup</span></a></li>
                                @endif
                                @if(Auth::user()->hasTaskPermission('machinesetup', Auth::user()->id))
                                    <li class="{{ (request()->is('production/machine')) ? 'active' : '' }}"><a href="{{route('production.machine')}}"><i class="fa fa-cogs"></i> <span>Machine Setup</span></a></li>
                                @endif
                                <li class="{{ (request()->is('production/plan*')) ? 'active open' : '' }}">
                                    <a role="button" tabindex="0"><i class="fa fa-bar-chart"></i> <span>Production Plan</span></a>
                                    <ul>
                                        <li class="{{ (request()->is('production/plan/daily*')) ? 'active open' : '' }}">
                                            <a role="button" tabindex="0"><i class="fa fa-caret-right"></i> Daily Production Plan</a>
                                            <ul>
                                                <li class="{{ (request()->is('production/plan/daily/master')) ? 'active' : '' }}" ><a href="{{route('production.plan.daily.master')}}"><i class="fa fa-caret-right"></i> Production Plan Master</a></li>
                                                <li class="{{ (request()->is('production/plan/daily/generate')) ? 'active' : '' }}" ><a href="{{route('production.plan.daily.generate')}}"><i class="fa fa-caret-right"></i> Daily Plan Generate</a></li>
                                                <li class="{{ (request()->is('production/plan/daily/active')) ? 'active' : '' }}" ><a href="{{route('production.plan.daily.active')}}"><i class="fa fa-caret-right"></i> Daily Active Plans</a></li>
                                                <li class="{{ (request()->is('production/plan/daily/achievement*')) ? 'active' : '' }}" ><a href="{{route('production.plan.daily.achievement')}}"><i class="fa fa-caret-right"></i> Daily Achievement</a></li>
                                                <li class="{{ (request()->is('production/plan/daily/search')) ? 'active' : '' }}" ><a href="{{route('production.plan.daily.search')}}"><i class="fa fa-caret-right"></i> Plan Search</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li class="{{ (request()->is('production/report*')) ? 'active open' : '' }}">
                                    <a role="button" tabindex="0"><i class="fa fa-file-pdf-o"></i> <span>Report</span></a>
                                    <ul>
                                        <li class="{{ (request()->is('production/report/profit')) ? 'active' : '' }}" ><a href="{{route('production.report.profit')}}"><i class="fa fa-caret-right"></i> Profit/Loss Report</a></li>
                                        <li class="{{ (request()->is('production/report/order-status')) ? 'active' : '' }}" ><a href="{{route('production.report.order-status')}}"><i class="fa fa-caret-right"></i> Order Status Report</a></li>
                                        {{--
                                        {{--                                        <li class="{{ (request()->is('production/search/buyer')) ? 'active' : '' }}" ><a href="{{route('production.search.buyer')}}"><i class="fa fa-caret-right"></i> Buyer</a></li>--}}
                                        {{--                                        <li class="{{ (request()->is('admin/yarn/setup')) ? 'active' : '' }}" ><a href="{{route('admin.yarn.setup')}}"><i class="fa fa-caret-right"></i> Yarn Setup</a></li>--}}
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
