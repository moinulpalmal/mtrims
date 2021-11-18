@extends('layouts.production.production-master')

@section('title')
    Order Status Report
@endsection
@section('content')
    <style type="text/css">
        th{
            background-color: #0689bd;
            color: white;
        }

        .tile-body{
            background-color: white;
        }
        .tile-header{
            color: white;
        }
        .tile-header{
            background-color:#105e7d;
        }
    </style>
    <div class="page page-dashboard">
        <div class="pageheader ">
            <h2>Production Plan <span>Report</span></h2>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{route('production.home')}}"><i class="fa fa-home"></i> Production</a>
                    </li>
                    <li>
                        <a href="{{route('production.report.order-status')}}"> Order Status Report</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- row -->
        <div class="row">
            <!-- col -->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <!-- tile -->
                <section class="tile">
                    <!-- tile header -->
                    <div class="tile-header dvd dvd-btm">
                        <h1 class="custom-font"><strong>Purchase Order Status</strong> <span>// Report Section</span></h1>
                        <ul class="controls">
                            <li class="dropdown">
                                <a role="button" tabindex="0" class="dropdown-toggle settings" data-toggle="dropdown">
                                    <i class="fa fa-cog"></i>
                                    <i class="fa fa-spinner fa-spin"></i>
                                </a>
                                <ul class="dropdown-menu pull-right with-arrow animated littleFadeInUp">
                                    <li>
                                        <a role="button" tabindex="0" class="tile-toggle">
                                            <span class="minimize"><i class="fa fa-angle-down"></i>&nbsp;&nbsp;&nbsp;Minimize</span>
                                            <span class="expand"><i class="fa fa-angle-up"></i>&nbsp;&nbsp;&nbsp;Expand</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a onclick="refresh()" role="button" tabindex="0" class="tile-refresh">
                                            <i class="fa fa-refresh"></i> Refresh
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            {{--                            <li class="remove"><a role="button" tabindex="0" class="tile-close"><i class="fa fa-times"></i></a></li>--}}
                        </ul>
                    </div>
                    <!-- /tile header -->
                    <!-- tile body -->
                    <div class="tile-body">
                        <!-- col -->
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <!-- tile -->
                            <form method="post" id="FactoryAdd" action="{{route('production.report.order-status.generate')}}" name="MachineForm" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <section class="tile">
                                    <!-- tile header -->
                                    <div class="tile-header dvd dvd-btm">
                                        <h1 class="custom-font"><strong>Report Setup</strong> Generate Form</h1>
                                        <a><button title="Generate Report" id="iconChange" class="pull-right btn-info btn-xs" type="submit"><i class="fa fa-check"></i></button></a>
                                    </div>
                                    <!-- /tile header -->
                                    <!-- tile body -->
                                    <div class="tile-body">
                                        <div class="row" style="padding: 0px 15px;">
                                            <div class="col-md-2 no-padding">
                                                <div class="form-group">
                                                    <label for="TrimsType" class="control-label">Select Trims Type</label>
                                                    <select id="TrimsType" class="form-control chosen-select" name="trims_type" style="width: 100%;">
                                                        <option value="A" selected ="selected">All</option>
                                                        {{--                                                        <option value="A">All</option>--}}
                                                        @if(!empty($trimsTypes))
                                                            @foreach($trimsTypes as $item)
                                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2 no-padding">
                                                <div class="form-group">
                                                    <label for="Buyer" class="control-label">Select Buyer</label>
                                                    <select id="Buyer" class="form-control chosen-select" name="buyer" style="width: 100%;">
                                                        <option value="" selected ="selected">- - Select - -</option>
                                                        {{--                                                        <option value="A">All</option>--}}
                                                        @if(!empty($buyers))
                                                            @foreach($buyers as $item)
                                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2 no-padding">
                                                <div class="form-group">
                                                    <label for="LPD" class="control-label">Select LPD</label>
                                                    <select id="LPD" class="form-control chosen-select" name="lpd" style="width: 100%;">
                                                        <option value="" selected ="selected">- - Select - -</option>
                                                        <option value="1" >LPD-1</option>
                                                        <option value="2" >LPD-2</option>
                                                        {{--                                                        <option value="A">All</option>--}}

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2 no-padding">
                                                <div class="form-group">
                                                    <label for="PONo" class="control-label">PO No</label>
                                                    <input type="number" class="form-control" name="lpd_po_no" id="PONo">
                                                </div>
                                            </div>
                                            <div class="col-md-2 no-padding">
                                                <div class="form-group">
                                                    <label for="TypeName" class="control-label">From Date</label>
                                                    <input type="date" class="form-control" name="from_date" id="TypeName"  required>
                                                </div>
                                            </div>
                                            <div class="col-md-2 no-padding">
                                                <div class="form-group">
                                                    <label for="Remarks" class="control-label">To Date</label>
                                                    <input type="date" class="form-control" name="to_date" id="Remarks" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="padding: 0px 15px;">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="IsMerchandising" class="checkbox checkbox-custom-alt checkbox-custom-lg" style="padding-top: 17px">
                                                    <input name="with_delivery_status" id="IsMerchandising" type="checkbox"><i></i> <strong>With Delivery Status?</strong>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="IsDelivery" class="checkbox checkbox-custom-alt checkbox-custom-lg" style="padding-top: 17px">
                                                    <input name="delivery_start_date" id="IsDelivery" type="checkbox"><i></i> <strong>Order By Delivery Start Date?</strong>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="OPO" class="checkbox checkbox-custom-alt checkbox-custom-lg" style="padding-top: 17px">
                                                    <input name="order_by_po_no" id="OPO" type="checkbox"><i></i> <strong>Order By LPD PO NO?</strong>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /tile body -->
                                </section>
                                <!-- /tile -->
                            </form>
                        </div>
                        <!-- /col -->
                    </div>
                    <!-- /tile body -->
                </section>
                <!-- /tile -->
            </div>
            <!-- /col -->
        </div>
        <!-- /row -->
    </div>
@endsection


@section('pageVendorScripts')

@endsection
@section('pageScripts')
    {{--    <script src="{{ asset('back-end/assets/MyJS/jquery.min.js') }}"></script>--}}

    <script>
        $(window).load(function(){

        });


        function refresh()
        {
            window.location.href = window.location.href.replace(/#.*$/, '');

        }

        function iconChange() {

            $('#iconChange').find('i').addClass('fa-edit');

        }
    </script>
@endsection()



