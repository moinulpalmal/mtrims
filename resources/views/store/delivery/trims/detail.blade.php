@extends('layouts.store.store-master')
@section('title')
    Delivery Details
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
            <h2>Store <span>// Trims Store</span></h2>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{route('store.home')}}"><i class="fa fa-home"></i> Store</a>
                    </li>
                    <li>
                        <a href="{{route('store.delivery.trims')}}"> Trims Delivery</a>
                    </li>
                    <li>
                        <a href="{{route('store.delivery.trims.challan.detail', ['id' => $master->id])}}"> Challan No: {{$master->id}}</a>
                    </li>
                    {{--<li>
                        <a href="#"> Print Challan</a>
                    </li>--}}
                </ul>
            </div>
        </div>
        <!-- page content -->
        <div class="pagecontent">
            <!-- row -->
            <div class="row">
                <!-- col -->
                <div class="col-md-2">
                    <!-- tile -->
                    <section id="purchase-order" class="tile tile-simple">
                        <!-- tile widget -->
                        <div class="tile-widget p-30 text-center">
                            {{--<div class="thumb thumb-xl">
                                <img class="img-circle" src="assets/images/arnold-avatar.jpg" alt="">
                            </div>--}}
                            <h4 class="mb-0"><strong>Challan No:</strong> {{$master->id}}</h4>
                            <span class="text-muted">
                                <strong>LPD-{{(App\Helpers\Helper::IDwiseData('purchase_order_masters','id', $master->purchase_order_master_id))->lpd}} PO No:</strong>
                                {{(App\Helpers\Helper::IDwiseData('purchase_order_masters','id', $master->purchase_order_master_id))->lpd_po_no}}
                            </span>
                            <div class="mt-10">
                                <a title="Refresh" class ="myIcon icon-info icon-ef-3 icon-ef-3b icon-color" onclick="refresh()">
                                    <i class="fa fa-refresh"></i>
                                </a>

                                @if($master->status != 'AP')
                                    @if(Auth::user()->hasTaskPermission('updatechallantrims', Auth::user()->id))
                                    <a title="Delivery Challan Master Update" class ="myIcon icon-warning icon-ef-3 icon-ef-3b icon-color" data-toggle="modal" data-target="#POUpdateModal" data-options="splash-2 splash-ef-12">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    @endif
                                        @if(Auth::user()->hasTaskPermission('approvechallan', Auth::user()->id))
                                            <a title="Approve Delivery Challan" class="ApproveOrder myIcon icon-success icon-ef-3 icon-ef-3b icon-color" data-id = "{{ $master->id }}"><i class="fa fa-check"></i></a>
                                        @endif
                                        @if(Auth::user()->hasTaskPermission('deletechallantrims', Auth::user()->id))
                                            <a title="Delete Delivery Challan" class="DeleteOrder myIcon icon-danger icon-ef-3 icon-ef-3b icon-color" data-id = "{{ $master->id }}"><i class="fa fa-trash"></i></a>
                                            @endif
                                @endif
                                    <a target="_blank" href="{{route('store.delivery.trims.challan.print-view', ['id' => $master->id])}}" title="Print View" class ="myIcon icon-danger icon-ef-3 icon-ef-3b icon-color">
                                    <i class="fa fa-file-pdf-o"></i>
                                </a>
                            </div>
                        </div>
                    </section>
                    <!-- /tile -->
                    <!-- tile -->
                    <section class="tile tile-simple">
                        <!-- tile header -->
                        <div class="tile-header">
                            <h1 class="custom-font"><strong>Challan</strong> Info</h1>
                        </div>
                        <!-- /tile header -->
                        <!-- tile body -->
                        <div class="tile-body">
                            <ul class="list-unstyled">
                                <li>
                                    <strong>Challan Date</strong>
                                    <br>
                                    @if($master->challan_date != null)
                                        <p class="text-left text-greensea">
                                            {{\Carbon\Carbon::parse($master->challan_date)->format('d/m/Y')}}
                                        </p>
                                    @endif
                                </li>
                                <hr>
                                <li>
                                    <strong>Buyer Name</strong>
                                    <br>
                                    <p class="text-left text-greensea">{{(App\Helpers\Helper::IDwiseData('buyers','id', (App\Helpers\Helper::IDwiseData('purchase_order_masters','id', $master->purchase_order_master_id))->buyer_id))->name}}</p>
                                </li>
                                <hr>
                                <li>
                                    <strong>LPD-{{(App\Helpers\Helper::IDwiseData('purchase_order_masters','id', $master->purchase_order_master_id))->lpd}} PO No</strong>
                                    <br>
                                    <p class="text-left text-greensea">{{(App\Helpers\Helper::IDwiseData('purchase_order_masters','id', $master->purchase_order_master_id))->lpd_po_no}}</p>

                                </li>
                                {{--<hr>
                                <li>
                                    <strong>Status</strong>
                                    <br>
                                    <p class="text-right text-greensea">{{$master->status}}</p>
                                </li>--}}
                            </ul>
                        </div>
                        <!-- /tile body -->
                    </section>
                    <!-- /tile -->
                    <!-- tile -->
                    <section class="tile tile-simple">
                        <!-- tile header -->
                        <div class="tile-header">
                            <h1 class="custom-font"><strong>Delivery</strong> Location Info</h1>
                        </div>
                        <!-- /tile header -->
                        <!-- tile body -->
                        <div class="tile-body">
                            <ul class="list-unstyled">
                                <li>
                                    <strong>Delivery Store Name</strong>
                                    <br>
                                    <p class="text-left text-blue">{{(App\Helpers\Helper::IDwiseData('stores','id', $master->store_id))->name}}</p>
                                </li>
                                <hr>
                                <li>
                                    <strong>Address</strong>
                                    <br>
                                    <p class="text-left text-blue">{{(App\Helpers\Helper::IDwiseData('stores','id', $master->store_id))->address}}</p>

                                </li>
                                <hr>
                                <li>
                                    <strong>A/C</strong>
                                    <br>
                                    <p class="text-left text-blue">{{$master->account_info}}</p>
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
                            <h1 class="custom-font"><strong>Transportation</strong> Info</h1>
                        </div>
                        <!-- /tile header -->
                        <!-- tile body -->
                        <div class="tile-body">
                            <ul class="list-unstyled">
                                <li>
                                    <strong>Driver Name</strong>
                                    <br>
                                    <p class="text-left text-blue">{{(App\Helpers\Helper::IDwiseData('transport_infos','id', $master->transport_info_id))->driver_name}}</p>
                                </li>
                                <hr>
                                <li>
                                    <strong>Driver Contact</strong>
                                    <br>
                                    <p class="text-left text-blue">{{(App\Helpers\Helper::IDwiseData('transport_infos','id', $master->transport_info_id))->driver_contact_info}}</p>
                                </li>
                                <hr>
                                <li>
                                    <strong>Truck No</strong>
                                    <br>
                                    <p class="text-left text-blue">{{(App\Helpers\Helper::IDwiseData('transport_infos','id', $master->transport_info_id))->transport_no}}</p>
                                </li>
                                <hr>
                                <li>
                                    <strong>Licence No</strong>
                                    <br>
                                    <p class="text-left text-blue">{{(App\Helpers\Helper::IDwiseData('transport_infos','id', $master->transport_info_id))->transport_licence_no}}</p>
                                </li>
                                <hr>
                                <li>
                                    <strong>Transport Name</strong>
                                    <br>
                                    <p class="text-left text-blue">{{(App\Helpers\Helper::IDwiseData('transport_infos','id', $master->transport_info_id))->transport_name}}</p>

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
                        <!-- /tile header -->
                        <!-- tile body -->
                        <div class="tile-body">
                            <p class="text-default lt">{!! $master->remarks !!}</p>
                        </div>
                        <!-- /tile body -->
                    </section>
                    <!-- /tile -->
                </div>
                <!-- /col -->
                <!-- col -->
                <div class="col-md-10">
                    <!-- tile -->
                    <section class="tile tile-simple">
                        <!-- tile body -->
                        <div class="tile-body p-0">
                            <div role="tabpanel">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs tabs-dark" role="tablist">
                                    <li role="presentation" class="active"><a href="#itemList" aria-controls="itemList" role="tab" data-toggle="tab">Item List</a></li>
                                    <li role="presentation" ><a href="#itemReplce" aria-controls="itemReplace" role="tab" data-toggle="tab">Replacement List</a></li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="itemList">
                                        <div class="wrap-reset">
                                           {{-- @if($master->status != 'AP')
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
                                                    <form method="post" id="ItemAdd" name="ItemAddForm" enctype="multipart/form-data">
                                                        {{ csrf_field() }}
                                                        <section class="tile">
                                                            <!-- tile header -->
                                                            <div class="tile-header dvd dvd-btm">
                                                                <h1 class="custom-font"><strong>Item</strong> Update Form</h1>
                                                                @if(Auth::user()->hasTaskPermission('deleteitemchallan', Auth::user()->id))
                                                                <a><button id="iconChange" class="pull-right btn-info btn-xs" type="submit"><i class="fa fa-check"></i></button></a>
                                                                    @endif
                                                            </div>
                                                            <!-- /tile header -->
                                                            <!-- tile body -->
                                                            <div class="tile-body">
                                                                <input type="hidden" id="DetailID" name="item_id">
                                                                <input type="hidden" id="DeliveredID" name="delivered_quantity">
                                                                <input type="hidden" id="MaxID" name="max_quantity">
                                                                <input type="hidden" id="MasterID" name="delivery_master_id" value="{{old('delivery_master_id', $master->id)}}">
                                                                <div class="row" style="padding: 0px 15px;">
                                                                    <div class="col-md-3 no-padding">
                                                                        <div class="form-group">
                                                                            <label for="StyleNo" class="control-label">Style No</label>
                                                                            <input type="text" class="form-control" name="style_no" readonly id="StyleNo" placeholder="Enter style no" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 no-padding">
                                                                        <div class="form-group">
                                                                            <label for="ItemSize" class="control-label">Item Size</label>
                                                                            <input type="text" class="form-control" name="item_size" readonly id="ItemSize" placeholder="Enter item size" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 no-padding">
                                                                        <div class="form-group">
                                                                            <label for="ItemColor" class="control-label">Item Color</label>
                                                                            <input type="text" class="form-control" name="item_color" readonly id="ItemColor" placeholder="Enter item color" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 no-padding">
                                                                        <div class="form-group">
                                                                            <label for="ItemDescription" class="control-label">Description</label>
                                                                            <input type="text" id="ItemDescription" class="form-control ItemDescription" readonly name="item_description" required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row" style="padding: 0px 15px;">
                                                                    <div class="col-md-3 no-padding">
                                                                        <div class="form-group">
                                                                            <label for="StockQuantity" class="control-label">Stock Quantity</label>
                                                                            <input type="number" step="any" class="form-control" name="stock_quantity" readonly id="StockQuantity" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 no-padding">
                                                                        <div class="form-group">
                                                                            <label for="ItemQuantity" class="control-label">Delivery Quantity</label>
                                                                            <input type="number" step="any" class="form-control" name="delivery_quantity" id="ItemQuantity" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 no-padding">
                                                                        <div class="form-group">
                                                                            <label for="GrossCalculationFactor" class="control-label">Unit</label>
                                                                            <input type="text" class="form-control" name="unit" id="GrossCalculationFactor" required readonly value="{{ old('gross_calculation_amount') }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 no-padding">
                                                                        <div class="form-group">
                                                                            <label for="ItemRemarks" class="control-label">Remarks</label>
                                                                            <input type="text" id="ItemRemarks" class="form-control ItemRemarks" name="item_remarks" required>
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
                                            @endif--}}
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
                                                    <section class="tile">
                                                        <!-- tile header -->
                                                       {{-- <div class="tile-header dvd dvd-btm">
                                                            <h1 class="custom-font"><strong>Item</strong> List</h1>
                                                        </div>--}}
                                                        <!-- /tile header -->
                                                        <!-- tile body -->
                                                        <div class="tile-body">
                                                            <div class="table-responsive">
                                                                <table class="table table-hover table-bordered table-condensed table-responsive" id="advanced-usage">
                                                                    <thead>
                                                                        <tr style="background-color: #1693A5; color: white;">
                                                                            <th class="text-center" >Sl No.</th>
                                                                            <th class="text-center">Style No</th>
                                                                            <th class="text-center">Size</th>
                                                                            <th class="text-center">Color</th>
                                                                            <th class="text-center">Description</th>
    {{--                                                                        <th class="text-uppercase text-center">Unit</th>--}}
                                                                            <th class="text-center">Delivery Qty</th>
                                                                            <th class="text-center">Delivery Qty</th>
                                                                            <th class="text-center">Gross Weight(Kg)</th>
                                                                            <th class="text-center">Net Weight(Kg)</th>
                                                                            <th class="text-center">Remarks</th>
                                                                            <th class="text-center">Action</th>

                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    @php($i = 1)
                                                                    @foreach($details as $item)
                                                                        <tr>
                                                                            <td class="text-center"><P>{!! $i++ !!}</P></td>
                                                                            <td><P>{!! (\App\Helpers\Helper::TwoIDwiseData('purchase_order_details', 'purchase_order_master_id', $master->purchase_order_master_id, 'item_count', $item->purchase_order_detail_id))->style_no !!}</P></td>
                                                                            <td><P>{!! (\App\Helpers\Helper::TwoIDwiseData('purchase_order_details', 'purchase_order_master_id', $master->purchase_order_master_id, 'item_count', $item->purchase_order_detail_id))->item_size !!}</P></td>
                                                                            <td><P>{!! (\App\Helpers\Helper::TwoIDwiseData('purchase_order_details', 'purchase_order_master_id', $master->purchase_order_master_id, 'item_count', $item->purchase_order_detail_id))->item_color !!}</P></td>
                                                                            <td><p>{!! (\App\Helpers\Helper::TwoIDwiseData('purchase_order_details', 'purchase_order_master_id', $master->purchase_order_master_id, 'item_count', $item->purchase_order_detail_id))->item_description !!}</p></td>
{{--                                                                            <td class="text-center"><p>{!! (\App\Helpers\Helper::IDwiseData('units', 'id', (\App\Helpers\Helper::TwoIDwiseData('purchase_order_details', 'purchase_order_master_id', $master->purchase_order_master_id, 'item_count', $item->purchase_order_detail_id))->item_unit_id))->short_unit !!}</p></td>--}}
                                                                            <td class="text-right"><P>{!!  number_format($item->gross_delivered_quantity, 0, '.', ',') !!} {!! (\App\Helpers\Helper::IDwiseData('units', 'id', (\App\Helpers\Helper::TwoIDwiseData('purchase_order_details', 'purchase_order_master_id', $master->purchase_order_master_id, 'item_count', $item->purchase_order_detail_id))->item_unit_id))->short_unit !!}</P></td>
                                                                            <td class="text-right"><P>
                                                                                    {!! number_format($item->delivered_quantity, 0, '.', ',') !!} @if($item->gross_unit == 'P')Pcs @elseif($item->gross_unit == 'L')Lassi @elseif($item->gross_unit == 'R') Roll @endif
                                                                                </P></td>
                                                                            <td  class="text-right"><P>{!! number_format( $item->gross_weight, 2, '.', ',') !!}</P></td>
                                                                            <td class="text-right"><P>{!! number_format( $item->total_weight, 2, '.', ',') !!}</P></td>
                                                                            <td class="text-right"><P>{!! $item->remarks !!}</P></td>

                                                                            <td class="text-center">
                                                                                @if(Auth::user()->hasTaskPermission('requestreplace', Auth::user()->id))
                                                                                <button title="Generate Replacement Request" class="btn btn-info btn-xs" data-toggle="modal" data-target="#user{{$item->item_count}}" data-options="splash-2 splash-ef-12"><i class="fa fa-eye"></i></button>
                                                                                    @endif
                                                                                @if($master->status != 'AP')
                                                                                    @if(Auth::user()->hasTaskPermission('deleteitemchallan', Auth::user()->id))
    {{--                                                                                    <a onclick="iconChange()" data-id = "{{ $item->item_count }}" class="EditFactory btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>--}}
                                                                                        @if($details->count() > 1)
                                                                                        <a title="Delete" class="DeleteDetail btn btn-danger btn-xs" data-id = "{{ $item->item_count }}"><i class="fa fa-trash"></i></a>
                                                                                        @endif
                                                                                    @endif
                                                                                    @endif
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
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
                                    <div role="tabpanel" class="tab-pane" id="itemReplce">
                                        <div class="wrap-reset">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
                                                    <section class="tile">
                                                        <!-- tile header -->
                                                    {{-- <div class="tile-header dvd dvd-btm">
                                                         <h1 class="custom-font"><strong>Item</strong> List</h1>
                                                     </div>--}}
                                                    <!-- /tile header -->
                                                        <!-- tile body -->
                                                        <div class="tile-body">
                                                            <div class="table-responsive">
                                                                <table class="table table-hover table-bordered table-condensed table-responsive" id="advanced-usage-2">
                                                                    <thead>
                                                                    <tr style="background-color: #1693A5; color: white;">
                                                                        <th class="text-center">Style No</th>
                                                                        <th class="text-center">Size</th>
                                                                        <th class="text-center">Color</th>
                                                                        <th class="text-center">Description</th>
                                                                        <th class="text-center">Replacement Reason</th>
                                                                        <th class="text-center">Replace Req. Qty</th>
                                                                        <th class="text-center">Production Qty</th>
                                                                        <th class="text-center">Non Production Qty</th>
                                                                        <th class="text-center">QC Passed Qty</th>
                                                                        <th class="text-center">Remarks</th>
                                                                        <th class="text-center">Action</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    @php($i = 1)
                                                                    @foreach( $replacementDetails as $item)
                                                                        <tr @if($item->status == 'R') class="bg-warning" @elseif($item->status == 'A') class="bg-success" @else @endif>
                                                                            <td><P>{!! (\App\Helpers\Helper::TwoIDwiseData('purchase_order_details', 'purchase_order_master_id', $master->purchase_order_master_id, 'item_count', $item->purchase_order_detail_id))->style_no !!}</P></td>
                                                                            <td><P>{!! (\App\Helpers\Helper::TwoIDwiseData('purchase_order_details', 'purchase_order_master_id', $master->purchase_order_master_id, 'item_count', $item->purchase_order_detail_id))->item_size !!}</P></td>
                                                                            <td><P>{!! (\App\Helpers\Helper::TwoIDwiseData('purchase_order_details', 'purchase_order_master_id', $master->purchase_order_master_id, 'item_count', $item->purchase_order_detail_id))->item_color !!}</P></td>
                                                                            <td><p>{!! (\App\Helpers\Helper::TwoIDwiseData('purchase_order_details', 'purchase_order_master_id', $master->purchase_order_master_id, 'item_count', $item->purchase_order_detail_id))->item_description !!}</p></td>
                                                                            {{--                                                                            <td class="text-center"><p>{!! (\App\Helpers\Helper::IDwiseData('units', 'id', (\App\Helpers\Helper::TwoIDwiseData('purchase_order_details', 'purchase_order_master_id', $master->purchase_order_master_id, 'item_count', $item->purchase_order_detail_id))->item_unit_id))->short_unit !!}</p></td>--}}
                                                                            <td class="text-right"><P>{!!  $item->replacement_reason !!}</P></td>
                                                                            <td class="text-right"><P>{!!  number_format($item->requested_replace_quantity, 0, '.', ',') !!}</P></td>
                                                                            <td class="text-right"><P>
                                                                                    {!! number_format($item->production_replace_quantity, 0, '.', ',') !!} @if($item->gross_unit == 'P')Pcs @elseif($item->gross_unit == 'L')Lassi @elseif($item->gross_unit == 'R') Roll @endif
                                                                                </P></td>
                                                                            <td  class="text-right"><P>{!! number_format( $item->non_production_replace_quantity, 0, '.', ',') !!}</P></td>
                                                                            <td  class="text-right"><P>{!! number_format( $item->stored_quantity, 0, '.', ',') !!}</P></td>
                                                                            <td class="text-right"><P>{!! $item->remarks !!}</P></td>
                                                                            <td class="text-center">
                                                                                @if(Auth::user()->hasTaskPermission('approvereplace', Auth::user()->id))
                                                                                    @if($item->status == 'I')
                                                                                        <button title="Approve Replacement Request" class="btn btn-info btn-xs" data-toggle="modal" data-target="#replace{{$item->id}}" data-options="splash-2 splash-ef-12"><i class="fa fa-check"></i></button>
                                                                                        <a title="Reject Replacement Request" class="RejectReplace btn btn-warning btn-xs" data-id = "{{ $item->id }}"><i class="fa fa-times"></i></a>
                                                                                        <a title="Delete Replacement Request" class="DeleteReplace btn btn-danger btn-xs" data-id = "{{ $item->id }}"><i class="fa fa-trash"></i></a>
                                                                                    @else

                                                                                    @endif
                                                                                @endif

                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
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
    <!-- PO Update Modal -->
    <div class="modal splash fade" id="POUpdateModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form method="post" id="POUpdate" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-content">
                    <div class="modal-header bg-greensea">
                        <h3 class="modal-title custom-font text-white">Delivery Challan Update Form</h3>
                    </div>
                    <div class="modal-body">
                            <div class="row" style="padding: 0px 15px;">
                                <input type="hidden" id="MasterID" name="delivery_master_id" value="{{old('delivery_master_id', $master->id)}}">
                                <input type="hidden" class="form-control" name="purchase_order_master_id" value="{{ old('purchase_order_master_id', $purchaseOrderMaster->id) }}">
                                <div class="col-md-3 no-padding">
                                    <div class="form-group">
                                        <label for="LPD_PO" class="control-label">LPD PO No.</label>
                                        <input type="number" class="form-control" name="lpd_po_no" id="LPD_PO" placeholder="2485" required readonly value="{{ old('lpd_po_no', $purchaseOrderMaster->lpd_po_no) }}">
                                    </div>
                                </div>
                                <div class="col-md-3 no-padding">
                                    <div class="form-group">
                                        <label for="Challan_Date" class="control-label">Challan Date</label>
                                        <input type="date" class="form-control" name="challan_date" id="PO_Date" required value="{{ old('challan_date', $master->challan_date) }}">
                                    </div>
                                </div>
                                <div class="col-md-3 no-padding">
                                    <div class="form-group">
                                        <label for="SubContractorType" class="control-label">Select Delivery Location</label>
                                        <select id="SubContractorType" class="form-control chosen-select" name="delivery_location_name" style="width: 100%;">
                                            <option value="">- - - Select - - -</option>
                                            @if(!empty($stores))
                                                @foreach($stores as $item)
                                                    <option value="{{ $item->id }}" @if($item->id == $master->store_id) selected = "selected" @endif {{--selected ="{{ $item->id == $master->store_id ? 'selected' : '' }}"--}}>{{ $item->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 no-padding">
                                    <div class="form-group">
                                        <label for="Transport" class="control-label">Select Transport Licence No</label>
                                        <select id="Transport" class="form-control chosen-select" name="transport_licence_no" style="width: 100%;">
                                            <option value="" selected ="selected">- - - Select - - -</option>
                                            @if(!empty($transports))
                                                @foreach($transports as $item)
                                                    <option value="{{ $item->id }}"  @if($item->id == $master->transport_info_id) selected = "selected" @endif>{{ $item->transport_licence_no }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="padding: 0px 15px;">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="checkbox checkbox-custom-alt checkbox-custom-lg" style="padding-top: 17px">
                                            <input name="is_replacement_challan" id="IsSubCon" @if($master->is_replacement_challan == true) checked @endif type="checkbox"><i></i> <strong>Is Replacement Challan ?</strong>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-9 no-padding">
                                    <div class="form-group">
                                        <label for="Remarks" class="control-label">Remarks</label>
                                        <input type="text" class="form-control" name="remarks" id="Remarks" value="{{ old('remarks', $master->remarks) }}">
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
    @foreach($details as $item)
        <div class="modal splash fade" id="user{{$item->item_count}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form method="post" id="RRUpdate{{$item->item_count}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-content">
                        <div class="modal-header bg-greensea">
                            <h3 class="modal-title custom-font text-white">Replacement Request Form</h3>
                        </div>
                        <div class="modal-body">
                            <div class="row" style="padding: 0px 15px;">
                                <input type="hidden" id="MasterID" name="delivery_master_id" value="{{old('delivery_master_id', $master->id)}}">
                                <input type="hidden" class="form-control" name="purchase_order_master_id" value="{{ old('purchase_order_master_id', $master->purchase_order_master_id) }}">
                                <input type="hidden" class="form-control" name="purchase_order_detail_id" value="{{ old('purchase_order_detail_id', $item->purchase_order_detail_id) }}">
                                <input type="hidden" class="form-control" name="delivery_detail_id" value="{{ old('delivery_detail_id', $item->item_count) }}">
                                <div class="col-md-4 no-padding">
                                    <div class="form-group">
                                        <label for="DQty" class="control-label">Item Delivered Qty</label>
                                        <input type="text" class="form-control" name="item_delivered_qty" id="DQty" required readonly value="{{ old('item_delivered_qty', $item->delivered_quantity) }}">
                                    </div>
                                </div>
                                <div class="col-md-4 no-padding">
                                    <div class="form-group">
                                        <label for="DQty" class="control-label">Item Replace Qty (Suggestion)</label>
                                        <input type="text" class="form-control" name="item_replace_suggestion_qty" id="DQty" required readonly value="{{ old('item_replace_suggestion_qty', \App\DeliveryDetailReplace::getSuggestedReplacementQty($master->id, $item->item_count)) }}">
                                    </div>
                                </div>
                                <div class="col-md-4 no-padding">
                                    <div class="form-group">
                                        <label for="DRQty" class="control-label">Item Replace Request Qty</label>
                                        <input type="number" step="any" class="form-control" name="item_replace_request_qty" id="DRQty" required max="{{\App\DeliveryDetailReplace::getSuggestedReplacementQty($master->id, $item->item_count)}}" value="{{ old('item_replace_request_qty')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="padding: 0px 15px;">
                                <div class="col-md-12 no-padding">
                                    <div class="form-group">
                                        <label for="ReplacementReason" class="control-label">Replacement Reason</label>
                                        <input type="text" class="form-control" name="replacement_reason" id="ReplacementReason" required value="{{ old('replacement_reason') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="padding: 0px 15px;">
                                <div class="col-md-12 no-padding">
                                    <div class="form-group">
                                        <label for="Remarks" class="control-label">Remarks</label>
                                        <input type="text" class="form-control" name="remarks" id="Remarks" value="{{ old('remarks') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a><button class="btn btn-success btn-ef btn-ef-3 btn-ef-3c" type="submit"><i class="fa fa-arrow-right"></i> Generate Request</button></a>
                            <button class="btn btn-lightred btn-ef btn-ef-4 btn-ef-4c" data-dismiss="modal"><i class="fa fa-arrow-left"></i> Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endforeach

    @foreach($replacementDetails as $item)
        <div class="modal splash fade" id="replace{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form method="post" id="RRApprove{{$item->id}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-content">
                        <div class="modal-header bg-greensea">
                            <h3 class="modal-title custom-font text-white">Replacement Request Approval Form {{$item->id}}</h3>
                        </div>
                        <div class="modal-body">
                            <div class="row" style="padding: 0px 15px;">
                                <input type="hidden" id="MasterID" name="id" value="{{old('id', $item->id)}}">
                                <div class="col-md-3 no-padding">
                                    <div class="form-group">
                                        <label for="DRQty" class="control-label">Item Replace Request Qty</label>
                                        <input type="number" step="any" class="form-control" name="item_replace_request_qty" id="DRQty" required readonly value="{{ old('item_replace_request_qty', $item->requested_replace_quantity)}}">
                                    </div>
                                </div>
                                <div class="col-md-3 no-padding">
                                    <div class="form-group">
                                        <label for="DRPQty" class="control-label">Production Replace Qty</label>
                                        <input type="number" step="any" class="form-control" name="production_replace_quantity" id="DRPQty" required value="{{ old('production_replace_quantity')}}">
                                    </div>
                                </div>
                                <div class="col-md-3 no-padding">
                                    <div class="form-group">
                                        <label for="DRNPQty" class="control-label">No Production Replace Qty</label>
                                        <input type="number" step="any" class="form-control" name="non_production_replace_quantity" id="DRNPQty" required value="{{ old('non_production_replace_quantity')}}">
                                    </div>
                                </div>
                                <div class="col-md-3 no-padding">
                                    <div class="form-group">
                                        <label for="DRSQty" class="control-label">QC Passed Replace Qty</label>
                                        <input type="number" step="any" class="form-control" name="stored_quantity" id="DRSQty" required value="{{ old('stored_quantity')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="padding: 0px 15px;">
                                <div class="col-md-12 no-padding">
                                    <div class="form-group">
                                        <label for="ReplacementReason" class="control-label">Replacement Reason</label>
                                        <input type="text" class="form-control" name="replacement_reason" id="ReplacementReason" required readonly value="{{ old('replacement_reason',  $item->replacement_reason) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="padding: 0px 15px;">
                                <div class="col-md-12 no-padding">
                                    <div class="form-group">
                                        <label for="Remarks" class="control-label">Remarks</label>
                                        <input type="text" class="form-control" name="remarks" id="Remarks" value="{{ old('remarks', $item->remarks) }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a><button class="btn btn-success btn-ef btn-ef-3 btn-ef-3c" type="submit"><i class="fa fa-arrow-right"></i> Approve Replace Request</button></a>
                            <button class="btn btn-lightred btn-ef btn-ef-4 btn-ef-4c" data-dismiss="modal"><i class="fa fa-arrow-left"></i> Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endforeach
@endsection

@section('pageScripts')
    <script>
        $(window).load(function(){
            /*$('#advanced-usage').DataTable({

            });*/

            $('.select2').select2();

        });

        @foreach($details as $item)
            $(function(){
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
            });
            $('#RRUpdate{{$item->item_count}}').submit(function(e){
                e.preventDefault();
                var data = $(this).serialize();
                var url = '{{ route('store.delivery.trims.replace.generate') }}';
                //console.log(data);
                //return;
                swal({
                    title: 'Are you sure?',
                    text: 'You want to generate this delivery replace request!',
                    icon: 'warning',
                    buttons: ["Cancel", "Yes!"],
                }).then(function(value) {
                    if (value) {
                        $.ajax({
                            url: url,
                            method:'POST',
                            data:data,
                            success:function(data){
                                //console.log(data);
                                //return;

                                if(data){
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
                    }
                });

            })
        });
        @endforeach

        @foreach($replacementDetails as $item)
        $(function(){
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
            });
            $('#RRApprove{{$item->id}}').submit(function(e){
                e.preventDefault();
                var data = $(this).serialize();
                var url = '{{ route('store.delivery.trims.replace.approve') }}';
                //console.log(data);
                //return;
                swal({
                    title: 'Are you sure?',
                    text: 'You want to approve this delivery replace request!',
                    icon: 'warning',
                    buttons: ["Cancel", "Yes!"],
                }).then(function(value) {
                    if (value) {
                        $.ajax({
                            url: url,
                            method:'POST',
                            data:data,
                            success:function(data){
                                //console.log(data);
                                //return;

                                if(parseInt(data) == 2){
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
                                else if(parseInt(data) == 1){
                                    swal({
                                        title: "Data Not Saved!",
                                        text: "Invalid Quanties!",
                                        icon: "error",
                                        button: "Ok!",
                                        className: "myClass",
                                    });
                                }
                                else{
                                    swal({
                                        title: "Data Not Saved!",
                                        text: "Please Check Your Connections!",
                                        icon: "error",
                                        button: "Ok!",
                                        className: "myClass",
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
                    }
                });

            })
        });
        @endforeach

        $(function(){
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
            });
            $('#ItemAdd').submit(function(e){
                e.preventDefault();
                var data = $(this).serialize();
                var id = $('#DetailID').val();
                var masterId = $('#MasterID').val();
                //console.log(data);
                //return;
                var delivered_qty = parseFloat(document.forms["ItemAddForm"]["delivered_quantity"].value).toFixed(3) ;
                var delivery_qty = parseFloat(document.forms["ItemAddForm"]["delivery_quantity"].value).toFixed(3) ;
                var stock_qty = parseFloat(document.forms["ItemAddForm"]["stock_quantity"].value).toFixed(3) ;
                var max_qty = parseFloat(document.forms["ItemAddForm"]["max_quantity"].value).toFixed(3) ;

               //console.log(max_qty);
                //return;
                if(delivery_qty == ""){
                    swal({
                        title: "Invalid Delivery Quantity!",
                        icon: "warning",
                        button: "Ok!",
                    });
                    return;
                }
                else if(delivery_qty == 0){
                    swal({
                        title: "Invalid Delivery Quantity!",
                        icon: "warning",
                        button: "Ok!",
                    });
                    return;
                }
                else if(delivery_qty > max_qty){
                    swal({
                        title: "Invalid Delivery Quantity!",
                        icon: "warning",
                        button: "Ok!",
                    });
                    return;
                }
                else{
                    var url = '{{ route('store.delivery.trims.challan.save-detail') }}';
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
            $('#POUpdate').submit(function(e){
                e.preventDefault();
                var data = $(this).serialize();
                var masterId = $('#MasterID').val();
                var driver_name = document.forms["POUpdate"]["driver_name"].value;
                var truck_no = document.forms["POUpdate"]["truck_no"].value;
                var licence_no = document.forms["POUpdate"]["licence_no"].value;
                var transport_name = document.forms["POUpdate"]["transport_name"].value;
                var primary_delivery_location = document.forms["POUpdate"]["delivery_location_name"].value;
                if(driver_name == ""){
                    swal({
                        title: "Driver Name Required!",
                        icon: "warning",
                        button: "Ok!",
                    });
                    return false;
                }
                else if(primary_delivery_location == ""){
                    swal({
                        title: "Select Delivery Location!",
                        icon: "warning",
                        button: "Ok!",
                    });
                    return false;
                }
                else if(truck_no == ""){
                    swal({
                        title: "Truck No Required!",
                        icon: "warning",
                        button: "Ok!",
                    });
                    return false;
                }
                else if(licence_no == ""){
                    swal({
                        title: "Licence No Required!",
                        icon: "warning",
                        button: "Ok!",
                    });
                    return false;
                }
                else if(transport_name == ""){
                    swal({
                        title: "Transport Name Required!",
                        icon: "warning",
                        button: "Ok!",
                    });
                    return false;
                }
                else{
                    var url = '{{ route('store.delivery.trims.challan.update-detail') }}';
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



        function refresh()
        {
            window.location.href = window.location.href.replace(/#.*$/, '');
        }

        function iconChange() {

            $('#iconChange').find('i').addClass('fa-edit');

        }
        $('#advanced-usage').on('click',".EditFactory", function(){
            var button = $(this);
            var FactoryID = button.attr("data-id");
            var masterId = {{$master->id}};
            //$('body').animate({scrollTop:0}, 400);
            window.scrollTo({
                top: 0,
                left: 0,
                behavior: 'smooth'
            });
            var url = '{{ route('store.delivery.trims.challan.edit-detail') }}';
            $.ajax({
                url: url,
                method:'POST',
                data:{item_count: FactoryID, delivery_master_id: masterId},
                success:function(data){
                   // console.log(data);
                    $('input[name=style_no]').val(data.style_no);
                    $('input[name=item_size]').val(data.item_size);
                    $('input[name=item_color]').val(data.item_color);
                    $('input[name=item_description]').val(data.item_description);
                    $('input[name=item_remarks]').val(data.remarks);
                    $('input[name=item_id]').val(data.item_id);
                    $('input[name=delivered_quantity]').val(data.delivered_quantity);
                    $('input[name=delivery_quantity]').val(data.delivered_quantity);
                    $('input[name=unit]').val(data.unit);
                    $('input[name=stock_quantity]').val(data.stock_quantity);
                    $('input[name=max_quantity]').val(data.max_quantity);


                    //$('input[name=id]').val(data.id);
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
        $('#purchase-order').on('click',".DeleteOrder", function(){
            var button = $(this);
            var id = button.attr("data-id");
            var url = '{{ route('store.delivery.trims.challan.delete') }}';
            swal({
                title: 'Are you sure?',
                text: 'This trims delivery challan will be removed permanently!',
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

        $('#purchase-order').on('click',".ApproveOrder", function(){
            var button = $(this);
            var id = button.attr("data-id");
            var url = '{{ route('store.delivery.trims.challan.approve') }}';
            swal({
                title: 'Are you sure?',
                text: 'This trims delivery challan will be approved permanently!',
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
        $('#advanced-usage').on('click',".DeleteDetail", function(){
            var button = $(this);
            var id = button.attr("data-id");
            var masterId = {{$master->id}};
            var url = '{{ route('store.delivery.trims.challan.delete-detail') }}';
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
                        data:{item_id: id, _token: '{{csrf_token()}}',delivery_master_id: masterId},
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

        $('#advanced-usage-2').on('click',".RejectReplace", function(){
            var button = $(this);
            var id = button.attr("data-id");
            var url = '{{ route('store.delivery.trims.replace.reject') }}';
            swal({
                title: 'Are you sure?',
                text: 'To Reject This Replacement Request!',
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
        $('#advanced-usage-2').on('click',".DeleteReplace", function(){
            var button = $(this);
            var id = button.attr("data-id");
            var url = '{{ route('store.delivery.trims.replace.delete') }}';
            swal({
                title: 'Are you sure?',
                text: 'To Delete This Replacement Request Permanently!',
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


