@extends('layouts.merchandising.merchandising-master')
@section('title')
    Purchase Order Item Details
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
            <h2>Merchandising <span>// Hamza Trims Limited</span></h2>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{route('merchandising.home')}}"><i class="fa fa-home"></i> Merchandising</a>
                    </li>
                    <li>
                        <a href="{{route('merchandising.purchase.order.search')}}"> Purchase Order Search</a>
                    </li>
                    <li>
                        <a href="{{route('merchandising.purchase.order.detail', ['id' => $purchaseOrder->id])}}">LPD - {{$purchaseOrder->lpd}} - PO No: {{$purchaseOrder->lpd_po_no}}</a>
                    </li>
                    <li>
                        <a href="{{route('merchandising.purchase.order.detail.item',['id'=>$purchaseOrderDetails->purchase_order_master_id, 'item'=>$purchaseOrderDetails->item_count])}}"> {{$purchaseOrderDetails->item_size}}</a>
                    </li>
                </ul>

            </div>
        </div>
        <!-- page content -->
        <div class="pagecontent">
            <!-- row -->
            <div class="row">
                <!-- col -->
                <!-- /col -->
                <!-- col -->
                <div class="col-md-12">
                    <!-- tile -->
                    <section class="tile tile-simple">
                        <!-- tile body -->
                        <div class="tile-body p-0">
                            <div role="tabpanel">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs tabs-dark" role="tablist">
                                    <li role="presentation" class="active"><a href="#itemList" aria-controls="itemList" role="tab" data-toggle="tab">Item Details</a></li>
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
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
                                                    <section class="tile">
                                                       {{-- <!-- tile header -->
                                                        <div class="tile-header dvd dvd-btm">
                                                            <h1 class="custom-font"><strong>Item</strong> List</h1>
                                                        </div>
                                                        <!-- /tile header -->--}}
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
                                                                        <th class="text-center">Ordered Qty</th>
                                                                        <th class="text-center">Unit Price (USD)</th>
                                                                        <th class="text-center">Total Price (USD)</th>
                                                                        <th class="text-center">Remarks</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="text-left">{{(App\Helpers\Helper::IDwiseData('trims_types','id',$purchaseOrderDetails->trims_type_id))->name}}</td>
                                                                            <td class="text-left">{{$purchaseOrderDetails->style_no}}</td>
                                                                            <td class="text-left">{{$purchaseOrderDetails->item_size}}</td>
                                                                            <td class="text-left">{{$purchaseOrderDetails->item_color}}</td>
                                                                            <td class="text-left">{{$purchaseOrderDetails->item_description}}</td>
                                                                            <td class="text-center">{{ (App\Helpers\Helper::IDwiseData('units','id',$purchaseOrderDetails->item_unit_id))->full_unit }}</td>
                                                                            <td class="text-right">{{ $purchaseOrderDetails->item_order_quantity }}</td>
                                                                            <td class="text-right">{{ $purchaseOrderDetails->unit_price_in_usd }}</td>
                                                                            <td class="text-right">{{ $purchaseOrderDetails->total_price_in_usd }}</td>
                                                                            <td class="text-right">{{ $purchaseOrderDetails->remarks}}</td>
                                                                        </tr>
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
                                                        <a target="_blank" href="{{route('merchandising.purchase.order.detail.item.plan-report', ['id' => $purchaseOrder->id, 'item'=>$purchaseOrderDetails->item_count])}}" title="Production Plan Report" class ="myIcon icon-danger icon-ef-3 icon-ef-3b icon-color">
                                                            <i class="fa fa-file-pdf-o"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="table-responsive">
                                                            <table class="table table-hover table-bordered table-condensed" id="production_plan_table">
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
                                    <div role="tabpanel" class="tab-pane" id="productionAchievement">
                                        <div class="wrap-reset">
                                            <form class="profile-settings">
                                                <div class="row">
                                                    <div class="form-group col-md-6 legend">
                                                        <h4><strong>Production</strong> Achievement</h4>
                                                        {{--                                                        <p>Your personal account settings</p>--}}
                                                    </div>
                                                    <div class="form-group col-md-6 legend text-right">
                                                        <a target="_blank" href="{{route('merchandising.purchase.order.detail.item.achievement-report', ['id' => $purchaseOrder->id, 'item' => $purchaseOrderDetails->item_count] )}}" title="Production Achievement Report" class ="myIcon icon-danger icon-ef-3 icon-ef-3b icon-color">
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
                                                        <a target="_blank" href="{{route('merchandising.purchase.order.detail.item.stock-report', ['id' => $purchaseOrder->id, 'item' => $purchaseOrderDetails->item_count])}}" title="Production Achievement Report" class ="myIcon icon-danger icon-ef-3 icon-ef-3b icon-color">
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
                                                                    <th style="font-size: small !important;">Balance Quantity</th>s
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($currentStocks as $item)
                                                                    <tr style="height: 3px !important;">
                                                                        <td style="font-size: x-small !important;"><p>{!! $item->trims_type !!}</p></td>
                                                                        <td style="font-size: x-small !important;"><p>{!! $item->item_description !!}</p></td>
                                                                        <td style="font-size: x-small !important;"><P>{!! $item->item_size !!}</P></td>
                                                                        <td style="font-size: x-small !important;"><P>{!! $item->item_color !!}</P></td>
                                                                        <td style="font-size: x-small !important;" class="text-right"><p>{!! $item->short_unit !!}</p></td>
                                                                        <td style="font-size: x-small !important;" class="text-right"><p>{!! (\App\Helpers\Helper::stockGrossDeliveredQtyTotal($item->id)) + $item->stock_quantity !!}</p></td>
                                                                        <td style="font-size: x-small !important;" class="text-right"><p>{!! \App\Helpers\Helper::stockGrossDeliveredQtyTotal($item->id) !!}</p></td>
                                                                        <td style="font-size: x-small !important;" class="text-right"><p>{!! $item->stock_quantity !!}</p></td>
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
                                    <div role="tabpanel" class="tab-pane" id="delivery">
                                        <div class="wrap-reset">
                                            <form class="profile-settings">
                                                <div class="row">
                                                    <div class="form-group col-md-6 legend">
                                                        <h4><strong>Delivery</strong> Approved Delivered Item List</h4>
                                                        {{--                                                        <p>Your personal account settings</p>--}}
                                                    </div>
                                                    <div class="form-group col-md-6 legend text-right">
                                                        <a target="_blank" href="{{route('merchandising.purchase.order.detail.item.delivery-report', ['id' => $purchaseOrder->id, 'item' => $purchaseOrderDetails->item_count])}}" title="Production Achievement Report" class ="myIcon icon-danger icon-ef-3 icon-ef-3b icon-color">
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
                                                        <a target="_blank" href="{{route('merchandising.purchase.order.detail.item.delivery-not-approved-report', ['id' => $purchaseOrder->id, 'item' => $purchaseOrderDetails->item_count])}}" title="Production Achievement Report" class ="myIcon icon-danger icon-ef-3 icon-ef-3b icon-color">
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




@endsection

@section('pageScripts')
    <script>
        $(window).load(function(){
            $('#advanced-usage').DataTable({
            });

            $('#production_plan_table').DataTable({

            });

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




        function refresh()
        {
            window.location.href = window.location.href.replace(/#.*$/, '');
        }

        function iconChange() {

            $('#iconChange').find('i').addClass('fa-edit');

        }


    </script>
@endsection()

