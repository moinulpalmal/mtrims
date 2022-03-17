@extends('layouts.lpd1.lpd-1-master')
@section('title')
    Purchase Order Details
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
    <div class="page page-profile">
        <div class="pageheader">
            <h2>LPD-1 <span>// Local Purchase Division Section: 1</span></h2>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{route('lpd1.home')}}"><i class="fa fa-home"></i> LPD-1</a>
                    </li>
                    <li>
                        <a href="{{route('lpd1.purchase.order.active')}}"> Purchase Order</a>
                    </li>

                    <li>
                        <a href="{{route('lpd1.purchase.order.detail', ['id' => $purchaseOrder->id])}}"> PO No: {{$purchaseOrder->lpd_po_no}}</a>
                    </li>
                </ul>

            </div>
        </div>
        <!-- page content -->
        <div class="pagecontent">
            <!-- row -->
            <div class="row">
                <!-- col -->
                <div class="col-md-3">
                    <!-- tile -->
                    <section id="purchase-order" class="tile tile-simple">
                        <!-- tile widget -->
                        <div class="tile-widget p-30 text-center">
                            {{--<div class="thumb thumb-xl">
                                <img class="img-circle" src="assets/images/arnold-avatar.jpg" alt="">
                            </div>--}}
                            <h4 class="mb-0"><strong>LPD PO No:</strong> {{$purchaseOrder->lpd_po_no}}</h4>
                            <span class="text-muted">
                                <strong>HTL Job No:</strong>
                                @foreach($uniqTrimsTypes as $item)
                                    {{ $item->short_name }}-
                                @endforeach
                                {{$purchaseOrder->job_year}}/{{$purchaseOrder->job_no}}
                            </span>
                            <div class="mt-10">
                                <a title="Refresh" class ="myIcon icon-info icon-ef-3 icon-ef-3b icon-color" onclick="refresh()">
                                    <i class="fa fa-refresh"></i>
                                </a>
                                @if($purchaseOrder->close_request == 0)
                                    @if(Auth::user()->hasTaskPermission('lpdtwoupdatepo', Auth::user()->id))
                                    <a title="Purchase Order Master Update" class ="myIcon icon-warning icon-ef-3 icon-ef-3b icon-color" data-toggle="modal" data-target="#POUpdateModal" data-options="splash-2 splash-ef-12">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    @endif
                                    @if($deleteAccess == true)
                                        @if(Auth::user()->hasTaskPermission('lpdonedeletepo', Auth::user()->id))
                                        <a title="Delete Purchase Order" class="DeleteOrder myIcon icon-danger icon-ef-3 icon-ef-3b icon-color" data-id = "{{ $purchaseOrder->id }}"><i class="fa fa-trash"></i></a>
                                        @endif
                                    @endif
                                @else

                                @endif
                            </div>
                        </div>
                    </section>
                    <!-- /tile -->
                    <!-- tile -->
                    <section class="tile tile-simple">
                        <!-- tile header -->
                        <div class="tile-header">
                            <h1 class="custom-font"><strong>Order</strong> Status</h1>
                        </div>
                        <!-- /tile header -->
                        <!-- tile body -->
                        <div class="tile-body">
                            <ul class="list-unstyled">
                                <li>
                                    <div class="row">
                                        <div class="col-md-5 pull-left">
                                            <strong>Order Date</strong>
                                        </div>
                                        <div class="col-md-7 pull-right">
                                            @if($purchaseOrder->po_date != null)
                                                <p class="text-right text-greensea">
                                                    {{\Carbon\Carbon::parse($purchaseOrder->po_date)->format('d/m/Y')}}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </li>
                                <hr>
                                <li>
                                    <div class="row">
                                        <div class="col-md-5 pull-left">
                                            <strong>Last Approval Date</strong>
                                        </div>
                                        <div class="col-md-7 pull-right">
                                            @if($purchaseOrder->approval_date != null)
                                                <p class="text-right text-greensea">{{\Carbon\Carbon::parse($purchaseOrder->approval_date)->format('d/m/Y')}}</p>
                                            @endif
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!-- /tile body -->
                    </section>
                    <!-- /tile -->
                    <!-- tile -->
                    <section class="tile tile-simple">
                        <!-- tile header -->
                        <div class="tile-header">
                            <h1 class="custom-font"><strong>Production</strong> Plans & Date</h1>
                        </div>
                        <div class="tile-widget p-30 text-center">
                            <div class="mt-10">
                               {{-- @if(Auth::user()->hasTaskPermission('lpdonepropose', Auth::user()->id))
                                    <a title="Production & Delivery Proposal" class ="myIcon icon-warning icon-ef-3 icon-ef-3b icon-color" data-toggle="modal" data-target="#dateProposalModal" data-options="splash-2 splash-ef-12">
                                        <i class="fa fa-calendar"></i>
                                    </a>
                                @endif--}}
                                @if($purchaseOrder->close_request == 0)
                                    @if(Auth::user()->hasTaskPermission('lpdoneapprovepo', Auth::user()->id))
                                        <a title="Provide Purchase Order Dates" class ="myIcon icon-success icon-ef-3 icon-ef-3b icon-color" data-toggle="modal" data-target="#poApprovalModal" data-options="splash-2 splash-ef-12">
                                            <i class="fa fa-calendar"></i>
                                        </a>
                                        @endif
                                @endif
                            </div>
                        </div>
                        <!-- /tile header -->
                        <!-- tile body -->
                        <div class="tile-body">
                            <ul class="list-unstyled">
                                <li>
                                    <div class="row">
                                        <div class="col-md-5 pull-left">
                                            <strong>Sample Submission Date</strong>
                                        </div>
                                        <div class="col-md-7 pull-right">
                                            @if($purchaseOrder->sample_submission_date != null)
                                                <p class="text-right text-blue">{{\Carbon\Carbon::parse($purchaseOrder->sample_submission_date)->format('d/m/Y')}}</p>
                                            @endif
                                        </div>
                                    </div>
                                </li>
                                <hr>
                                <li>
                                    <div class="row">
                                        <div class="col-md-5 pull-left">
                                            <strong>Production Start Date</strong>
                                        </div>
                                        <div class="col-md-7 pull-right">
                                            @if($purchaseOrder->production_start_date != null)
                                                <p class="text-right text-blue">{{\Carbon\Carbon::parse($purchaseOrder->production_start_date)->format('d/m/Y')}}</p>
                                            @endif
                                        </div>
                                    </div>
                                </li>
                                <hr>
                                <li>
                                    <div class="row">
                                        <div class="col-md-5 pull-left">
                                            <strong>Production Closing Date</strong>
                                        </div>
                                        <div class="col-md-7 pull-right">
                                            @if($purchaseOrder->production_end_date != null)
                                                <p class="text-right text-blue">{{\Carbon\Carbon::parse($purchaseOrder->production_end_date)->format('d/m/Y')}}</p>
                                            @endif
                                        </div>
                                    </div>
                                </li>
                                <hr>
                                <li>
                                    <div class="row">
                                        <div class="col-md-5 pull-left">
                                            <strong>Delivery Start Date</strong>
                                        </div>
                                        <div class="col-md-7 pull-right">
                                            @if($purchaseOrder->delivery_start_date != null)
                                                <p class="text-right text-blue">{{\Carbon\Carbon::parse($purchaseOrder->delivery_start_date)->format('d/m/Y')}}</p>
                                            @endif
                                        </div>
                                    </div>
                                </li>
                                <hr>
                                <li>
                                    <div class="row">
                                        <div class="col-md-5 pull-left">
                                            <strong>Delivery Closing Date</strong>
                                        </div>
                                        <div class="col-md-7 pull-right">
                                            @if($purchaseOrder->delivery_start_date != null)
                                                <p class="text-right text-blue">{{\Carbon\Carbon::parse($purchaseOrder->delivery_end_date)->format('d/m/Y')}}</p>
                                            @endif
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!-- /tile body -->
                    </section>
                    <!-- /tile -->

                    <!-- tile -->
                    <section class="tile tile-simple">
                        <!-- tile header -->
                        <div class="tile-header">
                            <h1 class="custom-font"><strong>Remarks</strong> </h1>
                        </div>

                        <!-- tile body -->

                        <div class="tile-body">
                            <p class="text-default lt">{!! $purchaseOrder->remarks !!}</p>
                        </div>
                        <!-- /tile body -->
                    </section>
                    <!-- /tile -->
                    <section id="purchase-order-close" class="tile tile-simple">
                        <!-- tile header -->
                        <div class="tile-header">
                            <h1 class="custom-font"><strong>Purchase Order Close Section</strong> </h1>
                        </div>
                        <div class="tile-widget p-30 text-center">
{{--                            {{Auth::user()->hasTaskPermission('lpdonepocloserequest', Auth::user()->id)}}--}}
                            <div class="mt-10">
                                @if(Auth::user()->hasTaskPermission('lpdoneclosereq', Auth::user()->id))
                                    @if($purchaseOrder->close_request == 0)
                                        <a title="Generate Close Request for This Purchase Order" class="CloseRequestOrder myIcon icon-info icon-ef-3 icon-ef-3b icon-color" data-id = "{{ $purchaseOrder->id }}"><i class="fa fa-times"></i></a>
                                    @endif
                                @endif
                                @if(Auth::user()->hasTaskPermission('lpdoneapclosereq', Auth::user()->id))
                                    @if($purchaseOrder->close_request == 1)
                                        @if($purchaseOrder->status == "A")
                                            <a title="Approve Close Request for This Purchase Order" class="CloseApproveOrder myIcon icon-success icon-ef-3 icon-ef-3b icon-color" data-id = "{{ $purchaseOrder->id }}"><i class="fa fa-check"></i></a>
                                        @endif
                                        @endif
                                @endif
                            </div>
                        </div>
                        <!-- /tile header -->
                        <!-- tile body -->

                        <div class="tile-body">
                            <p class="text-default lt">{!! $purchaseOrder->remarks !!}</p>
                        </div>
                        <!-- /tile body -->
                    </section>
                </div>
                <!-- /col -->
                <!-- col -->
                <div class="col-md-9">
                    <!-- tile -->
                    <section class="tile tile-simple">
                        <!-- tile body -->
                        <div class="tile-body p-0">
                            <div role="tabpanel">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs tabs-dark" role="tablist">
                                    <li role="presentation" class="active"><a href="#itemList" aria-controls="itemList" role="tab" data-toggle="tab">Item List</a></li>
                                    <li role="presentation"><a href="#productionPlan" aria-controls="settingsTab" role="tab" data-toggle="tab">Production Plan</a></li>
                                    <li role="presentation"><a href="#productionAchievement" aria-controls="productionTab" role="tab" data-toggle="tab">Production Achievement</a></li>
                                    <li role="presentation"><a href="#stock" aria-controls="proformaTab" role="tab" data-toggle="tab">Current Stock</a></li>
                                    <li role="presentation"><a href="#delivery" aria-controls="proformaTab" role="tab" data-toggle="tab">Approved Delivery</a></li>
                                    <li role="presentation"><a href="#delivery-not" aria-controls="proformaTab" role="tab" data-toggle="tab">Not Approved Delivery</a></li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="itemList">
                                        <div class="wrap-reset">
                                            @if($purchaseOrder->close_request == 0)
                                                @if(Auth::user()->hasTaskPermission('lpdtwoadditem', Auth::user()->id))
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
                                                            <form method="post" id="ItemAdd" name="ItemAddForm" enctype="multipart/form-data">
                                                                {{ csrf_field() }}
                                                                <section class="tile">
                                                                    <!-- tile header -->
                                                                    <div class="tile-header dvd dvd-btm">
                                                                        <h1 class="custom-font"><strong>Item</strong> Insert/Update Form</h1>

                                                                        <a><button id="iconChange" class="pull-right btn-info btn-xs" type="submit"><i class="fa fa-check"></i></button></a>

                                                                    </div>
                                                                    <!-- /tile header -->
                                                                    <!-- tile body -->
                                                                    <div class="tile-body">
                                                                        <input type="hidden" id="DetailID" name="item_id">
                                                                        <input type="hidden" id="MasterID" name="purchase_order_master_id" value="{{old('purchase_order_master_id', $purchaseOrder->id)}}">
                                                                        <div class="row" style="padding: 0px 15px;">
                                                                            <div class="col-md-3 no-padding">
                                                                                <div class="form-group">
                                                                                    <label for="TrimsTypeID" class="control-label">Select Trims Type</label>
                                                                                    <select id="TrimsTypeID" class="form-control select2" name="trims_type" required style="width: 100%;" onchange="javascript:getTrimsTypeCode(this)">
                                                                                        <option value="">- - - Select - - -</option>
                                                                                        @if(!empty($trimsTypes))
                                                                                            @foreach($trimsTypes as $group)
                                                                                                <option value="{{ $group->id }}">{{ $group->name }}</option>
                                                                                            @endforeach'
                                                                                        @endif'
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-3 no-padding">
                                                                                <div class="form-group">
                                                                                    <label for="UnitID" class="control-label">Select Unit</label>
                                                                                    <select id="UnitID" class="form-control select2" name="item_unit" required style="width: 100%;">
                                                                                        <option value="">- - - Select - - -</option>
                                                                                        @if(!empty($units))
                                                                                            @foreach($units as $group)
                                                                                                <option value="{{ $group->id }}">{{ $group->full_unit }}</option>
                                                                                            @endforeach'
                                                                                        @endif'
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-3 no-padding">
                                                                                <div class="form-group">
                                                                                    <label for="StyleNo" class="control-label">Style No</label>
                                                                                    <input type="text" class="form-control" name="style_no" id="StyleNo" placeholder="Enter style no" required>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-3 no-padding">
                                                                                <div class="form-group">
                                                                                    <label for="ItemSize" class="control-label">Item Size / Count</label>
                                                                                    <input type="text" class="form-control" name="item_size" id="ItemSize" placeholder="Enter item size" required>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row" style="padding: 0px 15px;">
                                                                            <div class="col-md-3 no-padding">
                                                                                <div class="form-group">
                                                                                    <label for="ItemColor" class="control-label">Item Color</label>
                                                                                    <input type="text" class="form-control" name="item_color" id="ItemColor" placeholder="Enter item color" required>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-3 no-padding">
                                                                                <div class="form-group">
                                                                                    <label for="ItemQuantity" class="control-label">Item Quantity (P)</label>
                                                                                    <input type="number" class="form-control qty" step="any" name="quantity" id="ItemQuantity" required>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-3 no-padding">
                                                                                <div class="form-group">
                                                                                    <label for="SItemQuantity" class="control-label">Item Quantity (S)</label>
                                                                                    <input type="number" class="form-control s_qty" step="any" name="sample_quantity" id="SItemQuantity" required>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-3 no-padding">
                                                                                <div class="form-group">
                                                                                    <label for="GrossCalculationFactor" class="control-label">Gross Calculation Factor</label>
                                                                                    <input type="number" step="any" class="form-control gross_factor" name="gross_calculation_amount" id="GrossCalculationFactor" required >
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row" style="padding: 0px 15px;">
                                                                            <div class="col-md-3 no-padding">
                                                                                <div class="form-group">
                                                                                    <label for="GrossQuantity" class="control-label">Gross Quantity (P)</label>
                                                                                    <input type="number" step="any" class="form-control gross_quantity" name="gross_item_order_quantity" id="GrossQuantity" readonly>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-3 no-padding">
                                                                                <div class="form-group">
                                                                                    <label for="SGrossQuantity" class="control-label">Gross Quantity (S)</label>
                                                                                    <input type="number" step="any" class="form-control s_gross_quantity" name="sample_gross_item_order_quantity" id="SGrossQuantity" readonly>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-3 no-padding">
                                                                                <div class="form-group">
                                                                                    <label for="UnitPrice" class="control-label">Unit Price (USD)</label>
                                                                                    <input type="number" id="UnitPrice" class="form-control UnitPrice" step="any" name="unit_price" required>
                                                                                    {{--                                                                            <input type="number" class="form-control qty" name="quantity" id="ItemQuantity" required>--}}
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-3 no-padding">
                                                                                <div class="form-group">
                                                                                    <label for="AddAmount" class="control-label">Add Amount %</label>
                                                                                    <input type="number" id="AddAmount" step="any" class="form-control AddAmountPercent" name="add_amount_percent" required>
                                                                                    {{--                                                                            <input type="number" class="form-control qty" name="quantity" id="ItemQuantity" required>--}}
                                                                                </div>
                                                                            </div>
                                                                            
                                                                        </div>
                                                                        <div class="row" style="padding: 0px 15px;">
                                                                            <div class="col-md-3 no-padding">
                                                                                <div class="form-group">
                                                                                    <label for="GrossUnitPrice" class="control-label">Gross Unit Price (USD)</label>
                                                                                    <input type="number" step="any" id="AddAmount" class="form-control GrossUnitPrice" name="gross_unit_price" required readonly>
                                                                                    {{--                                                                            <input type="number" class="form-control qty" name="quantity" id="ItemQuantity" required>--}}
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-3 no-padding">
                                                                                <div class="form-group">
                                                                                    <label for="Total" class="control-label">Total Price (USD)</label>
                                                                                    <input type="number" step="any" id="Total" class="form-control Total" readonly = "" name="total" required>
                                                                                    {{--                                                                            <input type="number" class="form-control qty" name="quantity" id="ItemQuantity" required>--}}
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6 no-padding">
                                                                                <div class="form-group">
                                                                                    <label for="ItemRemarks" class="control-label">Remarks</label>
                                                                                    <input type="text" id="ItemRemarks" class="form-control ItemRemarks" name="item_remarks">{{--                                                                            <input type="number" class="form-control qty" name="quantity" id="ItemQuantity" required>--}}
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row" style="padding: 0px 15px;">
                                                                            <div class="col-md-12 no-padding">
                                                                                <div class="form-group">
                                                                                    <label for="ItemDescription" class="control-label">Description</label>
                                                                                    <input type="text" id="ItemDescription" class="form-control ItemDescription" name="item_description" required>{{--                                                                            <input type="number" class="form-control qty" name="quantity" id="ItemQuantity" required>--}}
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- /tile body -->
                                                                </section>
                                                                <!-- /tile -->
                                                            </form>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endif
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
                                                    <section class="tile">
                                                        <!-- tile header -->
                                                        <div class="tile-header dvd dvd-btm">
                                                            <h1 class="custom-font"><strong>Item</strong> List</h1>
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
                                                                            <a onclick="loadPOListDataTable()" role="button" tabindex="0" class="tile-refresh">
                                                                                <i class="fa fa-refresh"></i> Refresh
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <!-- /tile header -->
                                                        <!-- tile body -->
                                                        <div class="tile-body">
                                                            <div class="table-responsive">
                                                                <table class="table table-hover table-bordered table-condensed table-responsive" id="advanced-usage">
                                                                    <thead>
                                                                    <tr style="background-color: #1693A5; color: white;">
                                                                        <th class="text-center">Trims Type</th>
                                                                        <th class="text-center">Style No</th>
                                                                        <th class="text-center">Size</th>
                                                                        <th class="text-center">Color</th>
                                                                        <th class="text-center">Description</th>
                                                                        <th class="text-center">Unit</th>
                                                                        <th class="text-center">Ordered Qty (P)</th>
                                                                        <th class="text-center">Ordered Qty (S)</th>
                                                                        <th class="text-center">Unit Price (USD)</th>
                                                                        <th class="text-center">Total Price (USD)</th>
                                                                        <th class="text-center">Remarks</th>
                                                                        {{-- <th class="text-center">Status</th> --}}
                                                                        @if($purchaseOrder->close_request == 0)
                                                                            <th class="text-center">Action</th>
                                                                        @endif
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    

                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <!-- /tile body -->
                                                    </section>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="productionPlan">
                                        <div class="wrap-reset">
                                            <form class="profile-settings">
                                                <div class="row">
                                                    <div class="form-group col-md-6 legend">
                                                        <h4><strong>Production</strong> Plans</h4>
                                                        {{--                                                        <p>Your personal account settings</p>--}}
                                                    </div>
                                                    <div class="form-group col-md-6 legend text-right">
                                                        <a onclick="loadPOProductionPlanDataTable()" role="button" class="tile-refresh myIcon icon-warning icon-ef-3 icon-ef-3b icon-color" title="Refresh">
                                                            <i class="fa fa-refresh"></i>
                                                        </a>
                                                        <a href="{{route('lpd1.purchase.order.detail.plan-report', ['id' => $purchaseOrder->id])}}" title="Production Plan Report" class ="myIcon icon-danger icon-ef-3 icon-ef-3b icon-color">
                                                            <i class="fa fa-file-pdf-o"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="table-responsive">
                                                            <table class="table table-hover table-bordered table-condensed table-responsive" id="production_plan_table">
                                                                <thead>
                                                                <tr style="height: 3px !important;">
                                                                    <th style="font-size: small !important;">Production Area</th>
                                                                    <th style="font-size: small !important;">Production Date</th>
                                                                    <th style="font-size: small !important;">Delivery Location</th>
                                                                    <th style="font-size: small !important;">Trims Type</th>
                                                                    <th style="font-size: small !important;">Item Description</th>
                                                                    <th style="font-size: small !important;">Size</th>
                                                                    <th style="font-size: small !important;">Color</th>
                                                                    <th style="font-size: small !important;">No Head</th>
                                                                    <th style="font-size: small !important;">Unit</th>
                                                                    <th style="font-size: small !important;">Target</th>
                                                                    <th style="font-size: small !important;">Remarks</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                {{-- @foreach($productionPlanDetails as $item)
                                                                    <tr style="height: 3px !important;">
                                                                        <td style="font-size: x-small !important;"><p>{{ (\App\Helpers\Helper::IDwiseData('machine_setups', 'id', $item->machine_id))->name }}</p></td>
                                                                        <td style="font-size: x-small !important;"><p>{{ \Carbon\Carbon::parse($item->production_date)->format('d/m/Y') }}</p></td>
                                                                        <td style="font-size: x-small !important;"><p>{!! (\App\Helpers\Helper::IDwiseData('stores', 'id', $item->delivery_location_id))->short_name !!}</p></td>
                                                                        <td style="font-size: x-small !important;"><p>{!! (\App\Helpers\Helper::IDwiseData('trims_types', 'id', (\App\Helpers\Helper::TwoIDwiseData('purchase_order_details', 'purchase_order_master_id', $item->purchase_order_master_id, 'item_count', $item->purchase_order_detail_id))->trims_type_id))->name !!}</p></td>
                                                                        <td style="font-size: x-small !important;"><p>{!! (\App\Helpers\Helper::TwoIDwiseData('purchase_order_details', 'purchase_order_master_id', $item->purchase_order_master_id, 'item_count', $item->purchase_order_detail_id))->item_description !!}</p></td>
                                                                        <td style="font-size: x-small !important;"><P>{!! (\App\Helpers\Helper::TwoIDwiseData('purchase_order_details', 'purchase_order_master_id', $item->purchase_order_master_id, 'item_count', $item->purchase_order_detail_id))->item_size !!}</P></td>
                                                                        <td style="font-size: x-small !important;"><P>{!! (\App\Helpers\Helper::TwoIDwiseData('purchase_order_details', 'purchase_order_master_id', $item->purchase_order_master_id, 'item_count', $item->purchase_order_detail_id))->item_color !!}</P></td>
                                                                        <td style="font-size: x-small !important;" class="text-right"><p>{!! $item->no_of_heads !!}</p></td>
                                                                        <td style="font-size: x-small !important;" class="text-right"><p>{!! (\App\Helpers\Helper::IDwiseData('units', 'id', $item->item_unit_id))->short_unit !!}</p></td>
                                                                        <td style="font-size: x-small !important;" class="text-right"><p>{!! $item->target_production !!}</p></td>
                                                                        <td style="font-size: x-small !important;" class="text-right"><P>{!! $item->remarks !!}</P></td>
                                                                    </tr>
                                                                @endforeach --}}
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>

                                        </div>

                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="productionAchievement">
                                        <div class="wrap-reset">
                                            <form class="profile-settings">
                                                <div class="row">
                                                    <div class="form-group col-md-6 legend">
                                                        <h4><strong>Production</strong> Achievement</h4>
                                                        {{--                                                        <p>Your personal account settings</p>--}}
                                                    </div>
                                                    <div class="form-group col-md-6 legend text-right">
                                                        <a href="{{route('lpd1.purchase.order.detail.achievement-report', ['id' => $purchaseOrder->id])}}" title="Production Achievement Report" class ="myIcon icon-danger icon-ef-3 icon-ef-3b icon-color">
                                                            <i class="fa fa-file-pdf-o"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="table-responsive">
                                                            <table class="table table-hover table-bordered table-condensed" id="achievement_table">
                                                                <thead>
                                                                <tr style="height: 3px !important;">
                                                                    <th style="font-size: small !important;">Production Area</th>
                                                                    <th style="font-size: small !important;">Production Date</th>
                                                                    <th style="font-size: small !important;">Delivery Location</th>
                                                                    <th style="font-size: small !important;">Trims Type</th>
                                                                    <th style="font-size: small !important;">Item Description</th>
                                                                    <th style="font-size: small !important;">Size</th>
                                                                    <th style="font-size: small !important;">Color</th>
                                                                    <th style="font-size: small !important;">No Head</th>
                                                                    <th style="font-size: small !important;">Unit</th>
                                                                    <th style="font-size: small !important;">Target</th>
                                                                    <th style="font-size: small !important;">Achievement</th>
                                                                    <th style="font-size: small !important;">Variation</th>
                                                                    <th style="font-size: small !important;">Remarks</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($productionPlanDetails as $item)
                                                                    <tr style="height: 3px !important;">
                                                                        <td style="font-size: x-small !important;"><p>{{ (\App\Helpers\Helper::IDwiseData('machine_setups', 'id', $item->machine_id))->name }}</p></td>
                                                                        <td style="font-size: x-small !important;"><p>{{ \Carbon\Carbon::parse($item->production_date)->format('d/m/Y') }}</p></td>
                                                                        <td style="font-size: x-small !important;"><p>{!! (\App\Helpers\Helper::IDwiseData('stores', 'id', $item->delivery_location_id))->short_name !!}</p></td>
                                                                        <td style="font-size: x-small !important;"><p>{!! (\App\Helpers\Helper::IDwiseData('trims_types', 'id', (\App\Helpers\Helper::TwoIDwiseData('purchase_order_details', 'purchase_order_master_id', $item->purchase_order_master_id, 'item_count', $item->purchase_order_detail_id))->trims_type_id))->name !!}</p></td>
                                                                        <td style="font-size: x-small !important;"><p>{!! (\App\Helpers\Helper::TwoIDwiseData('purchase_order_details', 'purchase_order_master_id', $item->purchase_order_master_id, 'item_count', $item->purchase_order_detail_id))->item_description !!}</p></td>
                                                                        <td style="font-size: x-small !important;"><P>{!! (\App\Helpers\Helper::TwoIDwiseData('purchase_order_details', 'purchase_order_master_id', $item->purchase_order_master_id, 'item_count', $item->purchase_order_detail_id))->item_size !!}</P></td>
                                                                        <td style="font-size: x-small !important;"><P>{!! (\App\Helpers\Helper::TwoIDwiseData('purchase_order_details', 'purchase_order_master_id', $item->purchase_order_master_id, 'item_count', $item->purchase_order_detail_id))->item_color !!}</P></td>
                                                                        <td style="font-size: x-small !important;" class="text-right"><p>{!! $item->no_of_heads !!}</p></td>
                                                                        <td style="font-size: x-small !important;" class="text-right"><p>{!! (\App\Helpers\Helper::IDwiseData('units', 'id', $item->item_unit_id))->short_unit !!}</p></td>
                                                                        <td style="font-size: x-small !important;" class="text-right"><p>{!! $item->target_production !!}</p></td>
                                                                        <td style="font-size: x-small !important;" class="text-right"><p>{!! $item->achievement_production !!}</p></td>
                                                                        <td style="font-size: x-small !important;" class="text-right"><p>{!! $item->target_production - $item->achievement_production !!}</p></td>
                                                                        <td style="font-size: x-small !important;" class="text-right"><P>{!! $item->remarks !!}</P></td>
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="stock">
                                        <div class="wrap-reset">
                                            <form class="profile-settings">
                                                <div class="row">
                                                    <div class="form-group col-md-6 legend">
                                                        <h4><strong>Stock</strong> Available Stock List</h4>
                                                    </div>
                                                    <div class="form-group col-md-6 legend text-right">
                                                        <a href="{{route('lpd1.purchase.order.detail.stock-report', ['id' => $purchaseOrder->id])}}" title="Production Achievement Report" class ="myIcon icon-danger icon-ef-3 icon-ef-3b icon-color">
                                                            <i class="fa fa-file-pdf-o"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="table-responsive">
                                                            <table class="table table-hover table-bordered table-condensed" id="stock_table">
                                                                <thead>
                                                                <tr style="height: 3px !important;">
                                                                    <th style="font-size: small !important;">Trims Type</th>
                                                                    <th style="font-size: small !important;">Item Description</th>
                                                                    <th style="font-size: small !important;">Size</th>
                                                                    <th style="font-size: small !important;">Color</th>
                                                                    <th style="font-size: small !important;">Unit</th>
                                                                    <th style="font-size: small !important;">Received Quantity</th>
                                                                    <th style="font-size: small !important;">Delivered Quantity</th>
                                                                    <th style="font-size: small !important;">Balance Quantity</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($currentStocks as $item)
                                                                    @if($item->status == 'E')
                                                                    <tr class="bg-warning text-white">
                                                                        <td style="font-size: x-small !important;"><p>{!! $item->trims_type !!}</p></td>
                                                                        <td style="font-size: x-small !important;"><p>{!! $item->item_description !!}</p></td>
                                                                        <td style="font-size: x-small !important;"><P>{!! $item->item_size !!}</P></td>
                                                                        <td style="font-size: x-small !important;"><P>{!! $item->item_color !!}</P></td>
                                                                        <td style="font-size: x-small !important;" class="text-right"><p>{!! $item->short_unit !!}</p></td>
                                                                        <td style="font-size: x-small !important;" class="text-right"><p>{!! (\App\Helpers\Helper::stockGrossDeliveredQtyTotal($item->id)) + $item->stock_quantity !!}</p></td>
                                                                        <td style="font-size: x-small !important;" class="text-right"><p>{!! \App\Helpers\Helper::stockGrossDeliveredQtyTotal($item->id) !!}</p></td>
                                                                        <td style="font-size: x-small !important;" class="text-right"><p>{!! $item->stock_quantity !!}</p></td>
                                                                    </tr>
                                                                    @else
                                                                        <tr @if($item->is_free_stock == true) class="bg-danger text-white" @else class="bg-greensea text-white" @endif>
                                                                            <td style="font-size: x-small !important;"><p>{!! $item->trims_type !!}</p></td>
                                                                            <td style="font-size: x-small !important;"><p>{!! $item->item_description !!}</p></td>
                                                                            <td style="font-size: x-small !important;"><P>{!! $item->item_size !!}</P></td>
                                                                            <td style="font-size: x-small !important;"><P>{!! $item->item_color !!}</P></td>
                                                                            <td style="font-size: x-small !important;" class="text-right"><p>{!! $item->short_unit !!}</p></td>
                                                                            <td style="font-size: x-small !important;" class="text-right"><p>{!! (\App\Helpers\Helper::stockGrossDeliveredQtyTotal($item->id)) + $item->stock_quantity !!}</p></td>
                                                                            <td style="font-size: x-small !important;" class="text-right"><p>{!! \App\Helpers\Helper::stockGrossDeliveredQtyTotal($item->id) !!}</p></td>
                                                                            <td style="font-size: x-small !important;" class="text-right"><p>{!! $item->stock_quantity !!}</p></td>
                                                                        </tr>
                                                                        @endif
                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="delivery">
                                        <div class="wrap-reset">
                                            <form class="profile-settings">
                                                <div class="row">
                                                    <div class="form-group col-md-6 legend">
                                                        <h4><strong>Delivery</strong> Approved Delivered Item List</h4>
                                                        {{--                                                        <p>Your personal account settings</p>--}}
                                                    </div>
                                                    <div class="form-group col-md-6 legend text-right">
                                                        <a href="{{route('lpd1.purchase.order.detail.delivery-report', ['id' => $purchaseOrder->id])}}" title="Production Achievement Report" class ="myIcon icon-danger icon-ef-3 icon-ef-3b icon-color">
                                                            <i class="fa fa-file-pdf-o"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="table-responsive">
                                                            <table class="table table-hover table-bordered table-condensed" id="confirmed_delivery_table">
                                                                <thead>
                                                                <tr style="height: 3px !important;">
                                                                    <th style="font-size: small !important;">Sl</th>
                                                                    <th style="font-size: small !important;">Trims Type</th>
                                                                    <th style="font-size: small !important;">Style No</th>
                                                                    <th style="font-size: small !important;">Delivery Place</th>
                                                                    <th style="font-size: small !important;">Description</th>
                                                                    <th style="font-size: small !important;">Delivery Date</th>
                                                                    <th style="font-size: small !important;">Challan No</th>
                                                                    <th style="font-size: small !important;">Color</th>
                                                                    <th style="font-size: small !important;">Size</th>
                                                                    <th style="font-size: small !important;">Unit</th>
                                                                    <th style="font-size: small !important;">G. Qty</th>
                                                                    <th style="font-size: small !important;">D. Unit</th>
                                                                    <th style="font-size: small !important;">D. Qty</th>
                                                                    <th style="font-size: small !important;">G. Weight(Kg)</th>
                                                                    <th style="font-size: small !important;">N. Weight(Kg)</th>
                                                                    <th style="font-size: small !important;">Remarks</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @php($i = 1)
                                                                @foreach($deliveryData as $item)
                                                                    @if($item->status == 'AP')
                                                                        <tr style="height: 3px !important;">
                                                                            <td class="text-center" style="font-size: x-small !important;"><P>{!! $i++ !!}</P></td>
                                                                            <td style="font-size: x-small !important;" class="text-right"><p>{!! $item->trims_type !!}</p></td>
                                                                            <td style="font-size: x-small !important;" class="text-left"><P>{!! $item->style_no!!}</P></td>
                                                                            <td style="font-size: x-small !important;" class="text-left"><P>{!! $item->store_name!!}</P></td>
                                                                            <td style="font-size: x-small !important;" class="text-left"><P>{!! $item->item_description!!}</P></td>
                                                                            <td style="font-size: x-small !important;" class="text-center"><P>{{\Carbon\Carbon::parse($item->challan_date)->format('j-M-Y')}}</P></td>
                                                                            <td style="font-size: x-small !important;" class="text-center"><P>{!! $item->challan_no!!}</P></td>
                                                                            <td style="font-size: x-small !important;" class="text-center"><P>{!! $item->item_color!!}</P></td>
                                                                            <td style="font-size: x-small !important;" class="text-center"><P>{!! $item->item_size!!}</P></td>
                                                                            <td style="font-size: x-small !important;" class="text-center"><P>{!! $item->short_unit!!}</P></td>
                                                                            <td style="font-size: x-small !important;" class="text-right"><P>{!! $item->gross_delivered_quantity!!}</P></td>
                                                                            <td style="font-size: x-small !important;" class="text-center"><P>@if($item->gross_unit == 'P')Pcs @elseif($item->gross_unit == 'L')Lassi @elseif($item->gross_unit == 'R') Roll @endif</P></td>
                                                                            <td style="font-size: x-small !important;" class="text-right"><P>{!! $item->delivered_quantity!!}</P></td>
                                                                            <td style="font-size: x-small !important;" class="text-right"><P>{!! $item->gross_weight!!}</P></td>
                                                                            <td style="font-size: x-small !important;" class="text-right"><P>{!! $item->total_weight!!}</P></td>
                                                                            <td style="font-size: x-small !important;" class="text-right"><P>{!! $item->remarks !!}</P></td>
                                                                        </tr>
                                                                    @endif
                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="delivery-not">
                                        <div class="wrap-reset">
                                            <form class="profile-settings">
                                                <div class="row">
                                                    <div class="form-group col-md-6 legend">
                                                        <h4><strong>Delivery</strong>Not Approved Delivered Item List</h4>
                                                        {{--                                                        <p>Your personal account settings</p>--}}
                                                    </div>
                                                    <div class="form-group col-md-6 legend text-right">
                                                        <a href="{{route('lpd1.purchase.order.detail.delivery-not-approved-report', ['id' => $purchaseOrder->id])}}" title="Production Achievement Report" class ="myIcon icon-danger icon-ef-3 icon-ef-3b icon-color">
                                                            <i class="fa fa-file-pdf-o"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="table-responsive">
                                                            <table class="table table-hover table-bordered table-condensed" id="not_confirmed_delivery_table">
                                                                <thead>
                                                                <tr style="height: 3px !important;">
                                                                    <th style="font-size: small !important;">Sl No</th>
                                                                    <th style="font-size: small !important;">Trims Type</th>
                                                                    <th style="font-size: small !important;">Style No</th>
                                                                    <th style="font-size: small !important;">Delivery Place</th>
                                                                    <th style="font-size: small !important;">Description</th>
                                                                    <th style="font-size: small !important;">Delivery Date</th>
                                                                    <th style="font-size: small !important;">Challan No</th>
                                                                    <th style="font-size: small !important;">Color</th>
                                                                    <th style="font-size: small !important;">Size</th>
                                                                    <th style="font-size: small !important;">Unit</th>
                                                                    <th style="font-size: small !important;">G. Qty</th>
                                                                    <th style="font-size: small !important;">D. Unit</th>
                                                                    <th style="font-size: small !important;">D. Qty</th>
                                                                    <th style="font-size: small !important;">G. Weight(Kg)</th>
                                                                    <th style="font-size: small !important;">N. Weight(Kg)</th>
                                                                    <th style="font-size: small !important;">Remarks</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @php($i = 1)
                                                                @foreach($deliveryData as $item)
                                                                    @if($item->status == 'A')
                                                                        <tr style="height: 3px !important;">
                                                                            <td class="text-center" style="font-size: x-small !important;"><P>{!! $i++ !!}</P></td>
                                                                            <td style="font-size: x-small !important;" class="text-left"><p>{!! $item->trims_type !!}</p></td>
                                                                            <td style="font-size: x-small !important;" class="text-left"><P>{!! $item->style_no!!}</P></td>
                                                                            <td style="font-size: x-small !important;" class="text-left"><P>{!! $item->store_name!!}</P></td>
                                                                            <td style="font-size: x-small !important;" class="text-left"><P>{!! $item->item_description!!}</P></td>
                                                                            <td style="font-size: x-small !important;" class="text-center"><P>{{\Carbon\Carbon::parse($item->challan_date)->format('j-M-Y')}}</P></td>
                                                                            <td style="font-size: x-small !important;" class="text-center"><P>{!! $item->challan_no!!}</P></td>
                                                                            <td style="font-size: x-small !important;" class="text-center"><P>{!! $item->item_color!!}</P></td>
                                                                            <td style="font-size: x-small !important;" class="text-center"><P>{!! $item->item_size!!}</P></td>
                                                                            <td style="font-size: x-small !important;" class="text-center"><P>{!! $item->short_unit!!}</P></td>
                                                                            <td style="font-size: x-small !important;" class="text-right"><P>{!! $item->gross_delivered_quantity!!}</P></td>
                                                                            <td style="font-size: x-small !important;" class="text-center"><P>@if($item->gross_unit == 'P')Pcs @elseif($item->gross_unit == 'L')Lassi @elseif($item->gross_unit == 'R') Roll @endif</P></td>
                                                                            <td style="font-size: x-small !important;" class="text-right"><P>{!! $item->delivered_quantity!!}</P></td>
                                                                            <td style="font-size: x-small !important;" class="text-right"><P>{!! $item->gross_weight!!}</P></td>
                                                                            <td style="font-size: x-small !important;" class="text-right"><P>{!! $item->total_weight!!}</P></td>
                                                                            <td style="font-size: x-small !important;" class="text-right"><P>{!! $item->remarks !!}</P></td>
                                                                        </tr>
                                                                    @endif
                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /tile body -->
                    </section>
                    <!-- /tile -->
                </div>
                <!-- /col -->
            </div>
            <!-- /row -->
        </div>
        <!-- /page content -->
    </div>
@endsection

@section('page-modals')
    <!-- Proposal Date Modal -->
    <div class="modal splash fade" id="dateProposalModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form method="post" id="ProductionProposalAdd" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-content">
                    <div class="modal-header bg-blue">
                        <h3 class="modal-title custom-font text-white">Proposed Production Start & Delivery End Date</h3>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" id="MasterID" name="purchase_order_master_id" value="{{old('purchase_order_master_id', $purchaseOrder->id)}}">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="PO_Date" class="control-label">Production Start Date</label>
                                    <input type="date" class="form-control" name="production_start_date" id="PO_Date" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="DE_Date" class="control-label">Delivery End Date</label>
                                    <input type="date" class="form-control" name="delivery_end_date" id="DE_Date" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a><button class="btn btn-success btn-ef btn-ef-3 btn-ef-3c" type="submit"><i class="fa fa-arrow-right"></i> Submit</button></a>
                        <button class="btn btn-lightred btn-ef btn-ef-4 btn-ef-4c" data-dismiss="modal"><i class="fa fa-arrow-left"></i> Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Proposal Date Modal -->
    <!-- Proposal Date Approval Modal -->
    <div class="modal splash fade" id="poApprovalModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form method="post" id="ProductionApprovalAdd" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-content">
                    <div class="modal-header bg-greensea">
                        <h3 class="modal-title custom-font text-white">Production Plan Dates</h3>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" id="MasterID" name="purchase_order_master_id" value="{{old('purchase_order_master_id', $purchaseOrder->id)}}">
                            <div class="col-md-12">
                            <div class="form-group">
                                <label for="S_Submission_Date" class="control-label">Sample Submission Date</label>
                                <input type="date" class="form-control" name="sample_submission_date" id="S_Submission_Date">
                            </div>
                        </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="P_Start_Date" class="control-label">Production Start Date</label>
                                    <input type="date" class="form-control" name="production_start_date" id="P_Start_Date" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="DE_Date" class="control-label">Production Closing Date</label>
                                    <input type="date" class="form-control" name="production_end_date" id="P_End_Date" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="D_Start_Date" class="control-label">Delivery Start Date</label>
                                    <input type="date" class="form-control" name="delivery_start_date" id="D_Start_Date" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="D_End_Date" class="control-label">Delivery Closing Date</label>
                                    <input type="date" class="form-control" name="delivery_end_date" id="D_End_Date" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a><button class="btn btn-success btn-ef btn-ef-3 btn-ef-3c" type="submit"><i class="fa fa-arrow-right"></i> Approve</button></a>
                        <button class="btn btn-lightred btn-ef btn-ef-4 btn-ef-4c" data-dismiss="modal"><i class="fa fa-arrow-left"></i> Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Proposal Date Approval Modal -->

    <!-- PO Update Modal -->
    <div class="modal splash fade" id="POUpdateModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form method="post" id="POUpdate" {{--onsubmit="return validateForm()"--}} enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-content">
                    <div class="modal-header bg-greensea">
                        <h3 class="modal-title custom-font text-white">Purchase Order Update Form</h3>
                    </div>
                    <div class="modal-body">
                            <div class="row" style="padding: 0px 15px;">
                                <input type="hidden" id="MasterID" name="purchase_order_master_id" value="{{old('purchase_order_master_id', $purchaseOrder->id)}}">

                                <div class="col-md-4 no-padding">
                                    <div class="form-group">
                                        <label for="SubContractorType" class="control-label">Select Buyer</label>
                                        <select id="SubContractorType" class="form-control select2" name="buyer_name" style="width: 100%;">
                                            <option value="">- - - Select - - -</option>
                                            @if(!empty($buyers))
                                                @foreach($buyers as $item)
                                                    <option value="{{ $item->id }}" @if($item->id == $purchaseOrder->buyer_id) selected = "selected"@endif >{{ $item->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 no-padding">
                                    <div class="form-group">
                                        <label for="FactoryName" class="control-label">Select Factory</label>
                                        <select id="FactoryName" class="form-control select2" name="factory_name" style="width: 100%;">
                                            <option value="">- - - Select - - -</option>
                                            @if(!empty($factories))
                                                @foreach($factories as $item)
                                                    <option value="{{ $item->id }}" @if($item->id == $purchaseOrder->factory_id) selected = "selected" @endif>{{ $item->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 no-padding">
                                    <div class="form-group">
                                        <label for="POType" class="control-label">PO Type</label>
                                        <select id="POType" class="form-control select2" name="po_type" style="width: 100%;">
                                            <option value="">- - - Select - - -</option>
                                            <option value="S" {{ $purchaseOrder->po_type == 'S' ? 'selected' : '' }}>Sample PO</option>
                                            <option value="P" {{ $purchaseOrder->po_type == 'P' ? 'selected' : '' }}>Production PO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="padding: 0px 15px;">
                                <div class="col-md-4 no-padding">
                                    <div class="form-group">
                                        <label for="DeliveryLocation" class="control-label">Primary Delivery Location</label>
                                        <select id="DeliveryLocation" class="form-control select2" name="primary_delivery_location" style="width: 100%;">
                                            <option value="">- - - Select - - -</option>
                                            @if(!empty($stores))
                                                @foreach($stores as $item)
                                                    <option value="{{ $item->id }}" @if($item->id == $purchaseOrder->primary_delivery_location_id) selected = "selected" @endif>{{ $item->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 no-padding">
                                    <div class="form-group">
                                        <label for="PO_Date" class="control-label">Purchase Order Date</label>
                                        <input type="date" class="form-control" name="purchase_order_date" id="PO_Date" required value="{{ old('purchase_order_date', $purchaseOrder->po_date) }}">
                                    </div>
                                </div>
                                <div class="col-md-2 ">
                                    <div class="form-group">
                                        <label class="checkbox checkbox-custom-alt checkbox-custom-lg" style="padding-top: 17px">
                                            <input type="checkbox" name="is_urgent" value="1"  {{  ($purchaseOrder->is_urgent == 1 ? ' checked' : '') }}/><i></i> <strong>Is Urgent ?</strong>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3 ">
                                    <div class="form-group">
                                        <label class="checkbox checkbox-custom-alt checkbox-custom-lg" style="padding-top: 17px">
                                            <input name="has_flow_count" id="HasFlowCount" value="1"  {{  ($purchaseOrder->has_flow_count == 1 ? ' checked' : '') }} type="checkbox"><i></i> <strong>Has Flow Count ?</strong>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="padding: 0px 15px;">
                                <div class="col-md-4 no-padding">
                                    <div class="form-group">
                                        <label for="LPD_PO" class="control-label">LPD PO No.</label>
                                        <input type="text" class="form-control" name="lpd_po_no" id="LPD_PO" placeholder="2485" required value="{{ old('lpd_po_no', $purchaseOrder->lpd_po_no) }}">
                                    </div>
                                </div>
                                <div class="col-md-4 no-padding">
                                    <div class="form-group">
                                        <label for="ReviseCount" class="control-label">Revise Count</label>
                                        <input type="number" min="0" class="form-control" name="revise_count" id="ReviseCount" placeholder="Enter Revise Count" required value="{{ old('revise_count', $purchaseOrder->revise_count) }}">
                                    </div>
                                </div>
                                @if (($purchaseOrder->has_flow_count == 1))
                                    <div class="col-md-4 no-padding">
                                        <div class="form-group">
                                            <label for="FlowCount" class="control-label">Flow Count</label>
                                            <input type="number" min="1" class="form-control" name="flow_count" id="FlowCount" placeholder="Enter Flow Count" value="{{ old('flow_count', $purchaseOrder->flow_count) }}">
                                        </div>
                                    </div>
                                @else
                                    <div class="col-md-4 no-padding" style="display: none;" id="IsCheck">
                                        <div class="form-group">
                                            <label for="FlowCount" class="control-label">Flow Count</label>
                                            <input type="number" min="1" class="form-control" name="flow_count" id="FlowCount" placeholder="Enter Flow Count"  value="{{ old('flow_count', $purchaseOrder->flow_count) }}">
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="row" style="padding: 0px 15px;">
                                <div class="col-md-12 no-padding">
                                    <div class="form-group">
                                        <label for="Buyer_PO_No" class="control-label">Buyer PO No.</label>
                                        <input type="text" class="form-control" name="buyer_po_no" id="Buyer_PO_No" required value="{{ old('buyer_po_no', $purchaseOrder->buyer_po_no) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="padding: 0px 15px;">
                                <div class="col-md-12 no-padding">
                                    <div class="form-group">
                                        <label for="Remarks" class="control-label">Remarks</label>
{{--                                        <textarea size="5" class="form-control" name="remarks_update" id="Remarks" >{!! $purchaseOrder->remarks !!}</textarea>--}}
                                        <input type="text" class="form-control" name="remarks" id="Remarks" value="{{old('remarks_update',$purchaseOrder->remarks)}}">
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <a><button class="btn btn-success btn-ef btn-ef-3 btn-ef-3c" type="submit"><i class="fa fa-arrow-right"></i> Update</button></a>
                        <button class="btn btn-lightred btn-ef btn-ef-4 btn-ef-4c" data-dismiss="modal"><i class="fa fa-arrow-left"></i> Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- PO Update Approval Modal -->
@endsection

@section('pageScripts')
<script src="{{ asset('/js/common.js') }}"></script>
    <script>

        var po_master_id = {{ $purchaseOrder->id }};       

        var po_product_list_table = $('#advanced-usage').DataTable({
            "lengthMenu": [[10, 50, 100, 200, -1], [10, 50, 100, 200, "All"]]
        });

        // var po_production_plan_table = $('#advanced-usage').DataTable({
        //     "lengthMenu": [[10, 50, 100, 200, -1], [10, 50, 100, 200, "All"]]
        // });

        var po_production_plan_table = $('#production_plan_table').DataTable({
            "lengthMenu": [[10, 50, 100, 200, -1], [10, 50, 100, 200, "All"]]
        });

        $(window).load(function(){
           
            loadPOListDataTable();

            // $('#production_plan_table').DataTable({

            // });

            loadPOProductionPlanDataTable();

            $('#achievement_table').DataTable({

            });

            $('#stock_table').DataTable({

            });

            $('#confirmed_delivery_table').DataTable({

            });

            $('#not_confirmed_delivery_table').DataTable({

            });

            $('.select2').select2();
            sessionStorage.clear();

        });

        $(document).ready(
        function(){
            $("#HasFlowCount").click(function () {
                $("#IsCheck").toggle();
                $('input[name="flow_count"]').val('');

                
            });
        });

        function loadPOListDataTable() {

            po_product_list_table.destroy();
            var free_table = '<tr><td class="text-center" colspan="12">--- Please Wait... Loading Data  ----</td></tr>';
            $('#advanced-usage').find('tbody').append(free_table);
           // $('tbody').html(free_table);
           po_product_list_table = $("#advanced-usage").DataTable({
                ajax: {
                    url: "/mtrims/public/api/lpd1/purchase-order/detail/product-list/"+ {{ $purchaseOrder->id }},
                    dataSrc: ""
                },
                columns: [
                    {
                        data: "trims_types_name",
                        render: function (data) {
                            return "<p class = 'text-center'>"+ data +"</p>";
                        }
                    },
                    {
                        data: "style_no",
                        render: function (data) {
                            return "<p class = 'text-left'>"+ data +"</p>";
                        }
                    },
                    {
                        data: "item_size",
                        render: function (data) {
                            return "<p class = 'text-left'>"+ data +"</p>";
                        }
                    },
                    {
                        data: "item_color",
                        render: function (data) {
                            return "<p class = 'text-left'>"+ data +"</p>";
                        }
                    },
                    {
                        data: "item_description",
                        render: function (data) {
                            return "<p class = 'text-left'>"+ data +"</p>";
                        }
                    },
                    {
                        data: "full_unit",
                        render: function (data) {
                            return "<p class = 'text-left'>"+ data +"</p>";
                        }
                    },
                    {
                        data: "item_order_quantity",
                        render: function (data) {
                            return "<p class = 'text-right'>"+ data +"</p>";
                        }
                    },
                    {
                        data: "sample_item_order_quantity",
                        render: function (data) {
                            return "<p class = 'text-right'>"+ data +"</p>";
                        }
                    },
                    {
                        data: "unit_price_in_usd",
                        render: function (data) {
                            return "<p class = 'text-right'><span style='float:left;'>$</span>"+ data +"</p>";
                        }
                    },
                    {
                        data: "total_price_in_usd",
                        render: function (data) {
                            return "<p class = 'text-right'><span style='float:left;'>$</span>"+data +"</p>";
                        }
                    },
                    {
                        render: function (data, type, val) {
                            if(val.remarks === null){
                                return "<p class = 'text-right'></p>";
                            }
                            else{
                                return "<p class = 'text-right'>"+ val.remarks +"</p>";
                            }
                        }
                    },
                    @if($purchaseOrder->close_request == 0)
                    {                       
                        render: function(data, type, api_item) {
                            return "<p class='text-center'>"+
                                    @if(Auth::user()->hasTaskPermission('lpdtwodeleteitem', Auth::user()->id))
                                    "<a title= 'Delete' class= 'DeleteDetail btn btn-danger btn-xs' data-id = "+ api_item.item_count +"><i class='fa fa-trash'></i></a>" +
                                    " &nbsp;" +
                                    @endif
                                    @if(Auth::user()->hasTaskPermission('lpdtwoadditem', Auth::user()->id))
                                    "<a title= 'Edit' class= 'EditFactory btn btn-warning btn-xs' data-id = "+ api_item.item_count +"><i class='fa fa-edit'></i></a></p>"
                                    @endif
                        }
                    }
                    @endif
                ]
            });
        }

        function loadPOProductionPlanDataTable() {

            po_production_plan_table.destroy();
            var free_table = '<tr><td class="text-center" colspan="11">--- Please Wait... Loading Data  ----</td></tr>';
            $('#production_plan_table').find('tbody').append(free_table);
            // $('#advanced-usage').find('tbody').append(free_table);
            // $('tbody').html(free_table);
            po_production_plan_table = $("#production_plan_table").DataTable({
            // po_production_plan_table = $("#advanced-usage").DataTable({
                ajax: {
                    url: "/mtrims/public/api/lpd1/purchase-order/detail/production-plan/"+ {{ $purchaseOrder->id }},
                    dataSrc: ""
                },
                columns: [
                    {
                        data: "machine_id",
                        render: function (data) {
                            return "<p class = 'text-center'>"+ data +"</p>";
                        }
                    },
                    {
                        data: "production_date",
                        render: function (data) {
                            return "<p class = 'text-left'>"+ data +"</p>";
                        }
                    },
                    {
                        data: "delivery_location_id",
                        render: function (data) {
                            return "<p class = 'text-left'>"+ data +"</p>";
                        }
                    },
                    {
                        data: "trims_type_id",
                        render: function (data) {
                            return "<p class = 'text-left'>"+ data +"</p>";
                        }
                    },
                    {
                        data: "item_description",
                        render: function (data) {
                            return "<p class = 'text-left'>"+ data +"</p>";
                        }
                    },
                    {
                        data: "item_size",
                        render: function (data) {
                            return "<p class = 'text-left'>"+ data +"</p>";
                        }
                    },
                    {
                        data: "item_color",
                        render: function (data) {
                            return "<p class = 'text-right'>"+ data +"</p>";
                        }
                    },
                    {
                        data: "no_of_heads",
                        render: function (data) {
                            return "<p class = 'text-right'>"+ data +"</p>";
                        }
                    },
                    {
                        data: "item_unit_id",
                        render: function (data) {
                            return "<p class = 'text-right'>"+ data +"</p>";
                        }
                    },
                    {
                        data: "target_production",
                        render: function (data) {
                            return "<p class = 'text-right'>"+ data +"</p>";
                        }
                    },
                    {
                        render: function (data, type, val) {
                            if(val.remarks === null){
                                return "<p class = 'text-right'></p>";
                            }
                            else{
                                return "<p class = 'text-right'>"+ val.remarks +"</p>";
                            }
                        }
                    }
                    
                ]
            });
            }




        function getTrimsTypeCode(_category) {
            var categoryId = _category.value;
            //var rowID = _category.getAttribute("data-id");
            //var
            //var targetID = 'grossID'+ rowID;
            //var targetID2 = 'AddParcentID'+ rowID;
            //console.log(targetID);
            var url = '{{ route('admin.trims-type.get-code') }}';
            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}
            });
            if (categoryId) {
                $.ajax({
                    url: url,
                    data: {id: categoryId},
                    type: "POST",
                    dataType: "json",
                    success: function (data) {
                        document.forms["ItemAddForm"]["gross_calculation_amount"].value = data.gross_calculation_amount;
                        document.forms["ItemAddForm"]["add_amount_percent"].value = data.add_amount_percent;
                       // document.forms["ItemAddForm"]["gross_calculation_amount"].value = 1;
                        //document.forms["ItemAddForm"]["add_amount_percent"].value = 0;
                        //document.getElementById(targetID).value = data.gross_calculation_amount;
                        //document.getElementById(targetID2).value = data.add_amount_percent;

                    }
                });
            } else {
                document.forms["ItemAddForm"]["gross_calculation_amount"].value = 0;
                document.forms["ItemAddForm"]["add_amount_percent"].value = 0;
            }
        };


        $('#ItemAdd').delegate('.qty, .s_qty, .UnitPrice,.Total, .AddAmountPercent, .gross_factor, .GrossUnitPrice','keyup',function(){
            var tr = $(this).parent().parent().parent().parent().parent().parent();
            //console.log($(this).parent().parent().parent().parent().parent().parent());
            //var qty = tr.find('.qty').val();
            var qty = parseFloat(tr.find('.qty').val()).toFixed(5);
            var s_qty = parseFloat(tr.find('.s_qty').val()).toFixed(5);
            var gross_qty_factory = parseFloat(document.forms["ItemAddForm"]["gross_calculation_amount"].value).toFixed(5);
            var g_qty = parseFloat(qty/gross_qty_factory).toFixed(3);
            var s_g_qty = parseFloat(s_qty/gross_qty_factory).toFixed(3);
            tr.find('.gross_quantity').val(g_qty);
            tr.find('.s_gross_quantity').val(s_g_qty);

            var unit_price = parseFloat(tr.find('.UnitPrice').val()).toFixed(5);
            var add_amount = parseFloat(document.forms["ItemAddForm"]["add_amount_percent"].value).toFixed(5);
            var total_unit_price = (100*unit_price + unit_price * add_amount)/100;
            var g_unit_price = parseFloat(total_unit_price).toFixed(5);
            tr.find('.GrossUnitPrice').val(g_unit_price);
            var dis = 0;
            var total = parseFloat((g_qty * g_unit_price) - (g_qty*g_unit_price*dis)/100).toFixed(5);
            tr.find('.Total').val(parseFloat(total).toFixed(2));

            //var price = tr.find('.UnitPrice').val();
            //var dis = 0;
            //var total = (qty * price) - (qty*price*dis)/100;
            // tr.find('.Total').val(total);
            //tr.find('.withoutdiscount').val(qty*price);
            //GrandTotal();
            //netAmount();
        });

        Number.prototype.toMoney = function(decimals, decimal_sep, thousands_sep)
        {
            var n = this,
                c = isNaN(decimals) ? 2 : Math.abs(decimals),
                d = decimal_sep || '.',
                t = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                sign = (n < 0) ? '-' : '',
                i = parseInt(n = Math.abs(n).toFixed(c)) + '',
                j = ((j = i.length) > 3) ? j % 3 : 0;
            return sign + (j ? i.substr(0, j) + t : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : '');
        };

        function refresh()
        {
            window.location.href = window.location.href.replace(/#.*$/, '');
        }

        function iconChange() {

            $('#iconChange').find('i').addClass('fa-edit');

        }

        $(function(){
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
            });
            $('#ItemAdd').submit(function(e){
                e.preventDefault();
                var data = $(this).serialize();
                // var id = $('#DetailID').val();
                // var masterId = $('#MasterID').val();
                // console.log(masterId);
                // return;

                var url = '{{ route('lpd1.purchase.order.detail.save') }}';
                // console.log(data);
                
                $.ajax({
                    url: url,
                    method:'POST',
                    data:data,
                    success:function(data){    
                    //    console.log(data);
                    //    clearFormWithoutDelay("ItemAdd");
                    // var poMasterID = 
                    //    return;                    
                        if(data === '2')
                        {
                            swal({
                                title: "Data Updated Successfully!",
                                icon: "success",
                                button: "Ok!",
                            }).then(function (value) {
                                if(value){
                                    clearFormWithoutDelay("ItemAdd");                                    
                                    loadPOListDataTable();
                                    document.forms["ItemAddForm"]["purchase_order_master_id"].value = po_master_id;
                                }
                            });
                        }
                        else if(data === '1')
                        {
                            swal({
                                title: "Data Inserted Successfully!",
                                icon: "success",
                                button: "Ok!",
                            }).then(function (value) {
                                if(value){
                                    clearFormWithoutDelay("ItemAdd");
                                    loadPOListDataTable();
                                    document.forms["ItemAddForm"]["purchase_order_master_id"].value = po_master_id;
                                }
                            });
                        }
                        else{
                            swal({
                                title: "Data Not Saved!",
                                text: "Please Check Your Data!",
                                icon: "error",
                                button: "Ok!",
                                className: "myClass",
                            });
                        }
                    },
                    error:function(error){
                        console.log(error);
                        swal({
                            title: "Data Not Saved!",
                            text: "Please Check Your Data!",
                            icon: "error",
                            button: "Ok!",
                            className: "myClass",
                        });
                    }
                })

            })
        });


        $('#advanced-usage').on('click',".EditFactory", function(){
            var button = $(this);
            var FactoryID = button.attr("data-id");      
            var url = '{{ route('lpd1.purchase.order.detail.edit') }}';
            $.ajax({
                url: url,
                method:'POST',
                data:{item_count: FactoryID, purchase_order_master_id: $('#MasterID').val()},
                success:function(data){                    
                    $('input[name=item_size]').val(data.item_size);
                    $('input[name=item_color]').val(data.item_color);
                    $('input[name=item_description]').val(data.item_description);
                    $('input[name=unit_price]').val(data.unit_price_in_usd);
                    $('input[name=total]').val(data.total_price_in_usd);
                    $('input[name=item_remarks]').val(data.remarks);
                    $('input[name=quantity]').val(data.item_order_quantity);
                    $('input[name=sample_quantity]').val(data.sample_item_order_quantity);
                    $('input[name=style_no]').val(data.style_no);
                    $('input[name=item_id]').val(data.item_id);
                    $('input[name=gross_unit_price]').val(data.gross_unit_price);
                    //$('input[name=gross_calculation_amount]').val(data.gross_calculation_amount);
                    $('input[name=gross_item_order_quantity]').val(data.gross_item_order_quantity);
                    $('input[name=sample_gross_item_order_quantity]').val(data.gross_sample_item_order_quantity);


                    //$('input[name=remarks]').val(data.remarks);

                    //document.getElementById('ItemRemarks').value = data.remarks;
                    //document.getElementById('Remarks').value = data.remarks;
                    $("#UnitID option[value = '" + data.item_unit + "']").attr('selected', 'selected').change();
                    $("#TrimsTypeID option[value = '" + data.trims_type_id + "']").attr('selected', 'selected').change();

                    $('input[name=gross_calculation_amount]').val(data.gross_calculation_amount);
                    $('input[name=add_amount_percent]').val(data.add_amount_percent);
                    //console.log();

                    $('input[name=id]').val(data.id);
                    moveToTop();
                },
                error:function(error){
                    swal({
                        title: "No Data Found!",
                        text: "no data!",
                        icon: "error",
                        button: "Ok!",
                        className: "myClass",
                    });
                }
            })

        });


        $('#advanced-usage').on('click',".DeleteDetail", function(){
            var button = $(this);
            var id = button.attr("data-id");
            var url = '{{ route('lpd1.purchase.order.detail.delete') }}';
            swal({
                title: 'Are you sure?',
                text: 'This item will be removed permanently!',
                icon: 'warning',
                buttons: ["Cancel", "Yes!"],
            }).then(function(value) {
                if (value) {
                    //window.location.href = url;
                    //console.log(id);
                    $.ajax({
                        method:'DELETE',
                        url: url,
                        data:{item_id: id, _token: '{{csrf_token()}}', purchase_order_master_id: $('#MasterID').val()},
                        success:function(data){
                            if(data){
                                //console.log(data);
                                if(data === '2'){
                                    swal({
                                        title: "Operation Successful!",
                                        icon: "success",
                                        button: "Ok!",
                                    }).then(function (value) {
                                        if(value){
                                            loadPOListDataTable();
                                        }
                                    });
                                }
                                else{
                                    swal({
                                        title: "Operation Unsuccessful!",
                                        text: "Something wrong happened please check!",
                                        icon: "error",
                                        button: "Ok!",
                                        className: "myClass",
                                    });
                                }
                            }
                        },
                        error:function(error){
                            console.log(error);
                            swal({
                                title: "Operation Unsuccessful!",
                                text: "Somthing wrong happend please check!",
                                icon: "error",
                                button: "Ok!",
                                className: "myClass",
                            });
                        }
                    })
                }
            });
        });


        $(function(){
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
            });
            $('#ProductionProposalAdd').submit(function(e){
                e.preventDefault();
                var data = $(this).serialize();
                var id = $('#DetailID').val();
                var masterId = $('#MasterID').val();
                //console.log(masterId);
                //return;
                var url = '{{ route('lpd1.purchase.order.update-proposal-date') }}';
                //console.log(data);
                $.ajax({
                    url: url,
                    method:'POST',
                    data:data,
                    success:function(data){
                        console.log(data);
                        if(id)
                        {
                            swal({
                                title: "Data Updated Successfully!",
                                icon: "success",
                                button: "Ok!",
                            }).then(function (value) {
                                if(value){
                                    window.location.href = window.location.href.replace(/#.*$/, '');
                                }
                            });
                        }
                        else
                        {
                            swal({
                                title: "Data Inserted Successfully!",
                                icon: "success",
                                button: "Ok!",
                            }).then(function (value) {
                                if(value){
                                    window.location.href = window.location.href.replace(/#.*$/, '');
                                }
                            });
                        }
                    },
                    error:function(error){
                        //console.log(error);
                        swal({
                            title: "Data Not Saved!",
                            text: "Please Check Your Data!",
                            icon: "error",
                            button: "Ok!",
                            className: "myClass",
                        });
                    }
                })

            })
        });

        $(function(){
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
            });
            $('#ProductionApprovalAdd').submit(function(e){
                e.preventDefault();
                var data = $(this).serialize();
                var id = $('#DetailID').val();
                var masterId = $('#MasterID').val();
                //console.log(masterId);
                //return;
                var url = '{{ route('lpd1.purchase.order.approve-proposal-date') }}';
                //console.log(data);
                $.ajax({
                    url: url,
                    method:'POST',
                    data:data,
                    success:function(data){
                       // console.log(data);
                        if(id)
                        {
                            swal({
                                title: "Data Updated Successfully!",
                                icon: "success",
                                button: "Ok!",
                            }).then(function (value) {
                                if(value){
                                    window.location.href = window.location.href.replace(/#.*$/, '');
                                }
                            });
                        }
                        else
                        {
                            swal({
                                title: "Data Inserted Successfully!",
                                icon: "success",
                                button: "Ok!",
                            }).then(function (value) {
                                if(value){
                                    window.location.href = window.location.href.replace(/#.*$/, '');
                                }
                            });
                        }
                    },
                    error:function(error){
                        console.log(error);
                        swal({
                            title: "Data Not Saved!",
                            text: "Please Check Your Data!",
                            icon: "error",
                            button: "Ok!",
                            className: "myClass",
                        });
                    }
                })

            })
        });

        $(function(){
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
            });
            $('#POUpdate').submit(function(e){
                e.preventDefault();
                var data = $(this).serialize();
                var masterId = $('#MasterID').val();
                var factory_name = document.forms["POUpdate"]["factory_name"].value;
                var buyer_name = document.forms["POUpdate"]["buyer_name"].value;
                var primary_delivery_location = document.forms["POUpdate"]["primary_delivery_location"].value;
                var po_type = document.forms["POUpdate"]["po_type"].value;
                var flow_count = document.forms["POUpdate"]["flow_count"].value;
                
                if ($("#HasFlowCount").is(":checked")) {
                    if(flow_count == ""){
                        swal({
                            title: "Insert Flow Count!",
                            icon: "warning",
                            button: "Ok!",
                        });
                        return false;
                    }
                    } else {

                    }
                if(buyer_name == ""){
                    swal({
                        title: "Select Buyer Name!",
                        icon: "warning",
                        button: "Ok!",
                    });
                    return false;
                }
                else if(primary_delivery_location == ""){
                    swal({
                        title: "Select Primary Delivery Location!",
                        icon: "warning",
                        button: "Ok!",
                    });
                    return false;
                }
                else if(factory_name == ""){
                    swal({
                        title: "Select Factory Name!",
                        icon: "warning",
                        button: "Ok!",
                    });
                    return false;
                }
                else if(po_type == ""){
                    swal({
                        title: "Select PO Type!",
                        icon: "warning",
                        button: "Ok!",
                    });
                    return false;
                }

                else{
                    var url = '{{ route('lpd1.purchase.order.update') }}';
                    //console.log(data);
                    //return;
                    $.ajax({
                        url: url,
                        method:'POST',
                        data:data,
                        success:function(data){
                            //console.log(data);
                            if(masterId)
                            {
                                swal({
                                    title: "Data Updated Successfully!",
                                    icon: "success",
                                    button: "Ok!",
                                }).then(function (value) {
                                    if(value){
                                        window.location.href = window.location.href.replace(/#.*$/, '');
                                    }
                                });
                            }
                            else
                            {
                                swal({
                                    title: "Data Inserted Successfully!",
                                    icon: "success",
                                    button: "Ok!",
                                }).then(function (value) {
                                    if(value){
                                        window.location.href = window.location.href.replace(/#.*$/, '');
                                    }
                                });
                            }
                        },
                        error:function(error){
                            console.log(error);
                            swal({
                                title: "Data Not Saved!",
                                text: "Please Check Your Data!",
                                icon: "error",
                                button: "Ok!",
                                className: "myClass",
                            });
                        }
                    })
                }

            })
        });

        $(function(){
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
            });
            $('#PIGenerate').submit(function(e){
                e.preventDefault();
                var data = $(this).serialize();
                var masterId = $('#MasterID').val();
                var hs_code = document.forms["PIGenerateForm"]["hs_code"].value;
                //var terms_conditions = document.forms["PIGenerateForm"]["terms_conditions"].value;
                //var bank_information = document.forms["PIGenerateForm"]["bank_information"].value;

                if(hs_code == ""){
                    swal({
                        title: "HS Code Required!",
                        icon: "warning",
                        button: "Ok!",
                    });
                    return false;
                }
                else{
                    var url = '{{ route('lpd1.proforma.invoice.generate') }}';
                    //console.log(data);
                    //return;
                    $.ajax({
                        url: url,
                        method:'POST',
                        data:data,
                        success:function(data){
                            //console.log(data);
                            if(data)
                            {
                                swal({
                                    title: "Data Inserted Successfully!",
                                    icon: "success",
                                    button: "Ok!",
                                }).then(function (value) {
                                    if(value){
                                        window.location.href = window.location.href.replace(/#.*$/, '');
                                    }
                                });
                            }
                            else
                            {
                                swal({
                                    title: "Something wrong happened!",
                                    icon: "warning",
                                    button: "Ok!",
                                }).then(function (value) {
                                    if(value){
                                        window.location.href = window.location.href.replace(/#.*$/, '');
                                    }
                                });
                            }
                        },
                        error:function(error){
                            console.log(error);
                            swal({
                                title: "Data Not Saved!",
                                text: "Please Check Your Data!",
                                icon: "error",
                                button: "Ok!",
                                className: "myClass",
                            });
                        }
                    })
                }

            })
        });

        $(function(){
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
            });
            $('#PIUpdate').submit(function(e){
                e.preventDefault();
                console.log("hit");
                var data = $(this).serialize();
                var masterId = $('#MasterID').val();
                var hs_code = document.forms["PIUpdateForm"]["hs_code"].value;
                //var terms_conditions = document.forms["PIGenerateForm"]["terms_conditions"].value;
                //var bank_information = document.forms["PIGenerateForm"]["bank_information"].value;

                if(hs_code == ""){
                    swal({
                        title: "HS Code Required!",
                        icon: "warning",
                        button: "Ok!",
                    });
                    return false;
                }
                else{
                    var url = '{{ route('lpd1.proforma.invoice.update') }}';
                    //console.log(data);
                    //return;
                    $.ajax({
                        url: url,
                        method:'POST',
                        data:data,
                        success:function(data){
                            //console.log(data);
                            if(data)
                            {
                                swal({
                                    title: "Data Inserted Successfully!",
                                    icon: "success",
                                    button: "Ok!",
                                }).then(function (value) {
                                    if(value){
                                        window.location.href = window.location.href.replace(/#.*$/, '');
                                    }
                                });
                            }
                            else
                            {
                                swal({
                                    title: "Something wrong happened!",
                                    icon: "warning",
                                    button: "Ok!",
                                }).then(function (value) {
                                    if(value){
                                        window.location.href = window.location.href.replace(/#.*$/, '');
                                    }
                                });
                            }
                        },
                        error:function(error){
                            console.log(error);
                            swal({
                                title: "Data Not Saved!",
                                text: "Please Check Your Data!",
                                icon: "error",
                                button: "Ok!",
                                className: "myClass",
                            });
                        }
                    })
                }

            })
        });


        $('#purchase-order').on('click',".DeleteOrder", function(){
            var button = $(this);
            var id = button.attr("data-id");
            var url = '{{ route('lpd1.purchase.order.delete') }}';
            swal({
                title: 'Are you sure?',
                text: 'This purchase order will be removed permanently!',
                icon: 'warning',
                buttons: ["Cancel", "Yes!"],
            }).then(function(value) {
                if (value) {
                    //window.location.href = url;
                    //console.log(id);
                    $.ajax({
                        method:'DELETE',
                        url: url,
                        data:{id: id, _token: '{{csrf_token()}}'},
                        success:function(data){
                            if(data){
                                //console.log(data);
                                swal({
                                    title: "Operation Successful!",
                                    icon: "success",
                                    button: "Ok!",
                                }).then(function (value) {
                                    if(value){
                                        //console.log(value);
                                        window.location.href = window.location.href.replace(/#.*$/, '');
                                    }
                                });
                            }
                        },
                        error:function(error){
                            console.log(error);
                            swal({
                                title: "Operation Unsuccessful!",
                                text: "Somthing wrong happend please check!",
                                icon: "error",
                                button: "Ok!",
                                className: "myClass",
                            });
                        }
                    })
                }
            });
        });


        $('#purchase-order-close').on('click',".CloseRequestOrder", function(){
            var button = $(this);
            var id = button.attr("data-id");
            var url = '{{ route('lpd1.purchase.order.close.request') }}';
            swal({
                title: 'Are you sure?',
                text: 'Purchase order close request will be generated; after that you can not update this purchase order!',
                icon: 'warning',
                buttons: ["Cancel", "Yes!"],
            }).then(function(value) {
                if (value) {
                    //window.location.href = url;
                    //console.log(id);
                    $.ajax({
                        method:'DELETE',
                        url: url,
                        data:{id: id, _token: '{{csrf_token()}}'},
                        success:function(data){
                            if(data){
                                //console.log(data);
                                swal({
                                    title: "Operation Successful!",
                                    icon: "success",
                                    button: "Ok!",
                                }).then(function (value) {
                                    if(value){
                                        //console.log(value);
                                        window.location.href = window.location.href.replace(/#.*$/, '');
                                    }
                                });
                            }
                        },
                        error:function(error){
                            console.log(error);
                            swal({
                                title: "Operation Unsuccessful!",
                                text: "Somthing wrong happend please check!",
                                icon: "error",
                                button: "Ok!",
                                className: "myClass",
                            });
                        }
                    })
                }
            });
        });
        $('#purchase-order-close').on('click',".CloseApproveOrder", function(){
            var button = $(this);
            var id = button.attr("data-id");
            var url = '{{ route('lpd1.purchase.order.close.approve') }}';
            swal({
                title: 'Are you sure?',
                text: 'Purchase order close request will be approved; after that you can not update this purchase order!',
                icon: 'warning',
                buttons: ["Cancel", "Yes!"],
            }).then(function(value) {
                if (value) {
                    //window.location.href = url;
                    //console.log(id);
                    $.ajax({
                        method:'DELETE',
                        url: url,
                        data:{id: id, _token: '{{csrf_token()}}'},
                        success:function(data){
                            if(data){
                                //console.log(data);
                                swal({
                                    title: "Operation Successful!",
                                    icon: "success",
                                    button: "Ok!",
                                }).then(function (value) {
                                    if(value){
                                        //console.log(value);
                                        window.location.href = window.location.href.replace(/#.*$/, '');
                                    }
                                });
                            }
                        },
                        error:function(error){
                            console.log(error);
                            swal({
                                title: "Operation Unsuccessful!",
                                text: "Somthing wrong happend please check!",
                                icon: "error",
                                button: "Ok!",
                                className: "myClass",
                            });
                        }
                    })
                }
            });
        });


    </script>
@endsection()

