@extends('layouts.store.store-master')

@section('title')
    Delivery Challan
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
            <h2>Store <span>//Trims Delivery</span></h2>
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
                    <li>
                        <a href="#"> Print Challan</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- row -->
        <div class="add-nav">
            <div class="nav-heading">
                <h3>Challan No : <strong class="text-greensea">{{$master->id}}</strong></h3>
                <span class="controls pull-right">
                    <a href="{{route('store.delivery.trims.challan.detail',['id'=>$master->id])}}" class="btn btn-ef btn-ef-1 btn-ef-1-default btn-ef-1a btn-rounded-20 mr-5" data-toggle="tooltip" title="Back"><i class="fa fa-times"></i></a>
{{--                    <a href="javascript:;" class="btn btn-ef btn-ef-1 btn-ef-1-default btn-ef-1a btn-rounded-20 mr-5" data-toggle="tooltip" title="Send"><i class="fa fa-envelope"></i></a>--}}
                    <a href="javascript:window.print()" class="btn btn-ef btn-ef-1 btn-ef-1-default btn-ef-1a btn-rounded-20" data-toggle="tooltip" title="Print"><i class="fa fa-print"></i></a>
                </span>
            </div>
            <div role="tabpanel">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#officecopy" aria-controls="officecopy" role="tab" data-toggle="tab">Office Copy</a></li>
                    {{--<li role="presentation" ><a href="#customercopy" aria-controls="customercopy" role="tab" data-toggle="tab">Customer Copy</a></li>
                    <li role="presentation" ><a href="#accountscopy" aria-controls="accountscopy" role="tab" data-toggle="tab">Accounts Copy</a></li>
                    <li role="presentation" ><a href="#gatecopy" aria-controls="gatecopy" role="tab" data-toggle="tab">Gatepass Copy</a></li>--}}
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="officecopy">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <!-- tile -->
                                <section class="tile tile-simple bg-tr-black lter">
                                    <!-- tile body -->
                                    <div class="tile-body">
                                        <!-- row -->
                                        <div class="row">
                                            <!-- col -->
                                            <div class="col-md-12 text-center">
                                                <h3 class="text-uppercase text-strong mb-10 custom-font">
                                                    Hamza Trims Limited
                                                </h3>
                                                <ul class="list-unstyled text-default lt mb-20">
                                                    <li><strong>Corporate Head Office:</strong> 9/Kha Confidence Center, Shahazadpur, Gulshan, Dhaka-1212</li>
                                                    <li><strong>Factory:</strong> Bangabandhu Road, Tongibari, Ashulia, Dhaka.</li>
                                                </ul>
                                            </div>
                                            <div class="col-md-12 text-center no-padding">
                                                <p class="text-uppercase text-strong mb-10 custom-font text-white bg-greensea">
                                                   DELIVERY CHALLAN
                                                </p>
                                            </div>
                                            {{--<div class="col-md-6 text-right no-padding">
                                                <p class="text-uppercase text-strong mb-10 custom-font text-white bg-greensea">
                                                    Office Copy &nbsp;&nbsp;&nbsp;
                                                </p>
                                            </div>--}}
                                            <!-- /col -->
                                        </div>
                                    </div>
                                    <!-- /tile body -->
                                    <!-- tile body -->
                                    <div class="tile-body">
                                        <!-- row -->
                                        <div class="row">
                                            <!-- col -->
                                            <div class="col-md-4 text-left">
                                                <p class="text-uppercase text-strong mb-10 custom-font">
                                                    To
                                                </p>
                                                <ul class="list-unstyled text-default lt mb-20">
                                                    <li><strong>Delivery Location:</strong> {{(App\Helpers\Helper::IDwiseData('stores','id', $master->store_id))->name}}</li>
                                                    <li><strong>Address:</strong> {{(App\Helpers\Helper::IDwiseData('stores','id', $master->store_id))->address}}</li>
                                                    <li><strong>Contact Person:</strong>  {{(App\Helpers\Helper::IDwiseData('stores','id', $master->store_id))->contact_person_info}}</li>
                                                </ul>
                                            </div>
                                            <div class="col-md-4 text-left">
                                                <p class="text-uppercase text-strong mb-10 custom-font">
                                                    Transportation Info
                                                </p>
                                                <ul class="list-unstyled text-default lt mb-20">
                                                    <li><strong>Driver Name:</strong> {{(App\Helpers\Helper::IDwiseData('transport_infos','id', $master->transport_info_id))->driver_name}}</li>
                                                    <li><strong>Truck No:</strong> {{(App\Helpers\Helper::IDwiseData('transport_infos','id', $master->transport_info_id))->transport_no}}</li>
                                                    <li><strong>Licence No:</strong> {{(App\Helpers\Helper::IDwiseData('transport_infos','id', $master->transport_info_id))->transport_licence_no}}</li>
                                                    <li><strong>Transport Name:</strong> {{(App\Helpers\Helper::IDwiseData('transport_infos','id', $master->transport_info_id))->transport_name}}</li>
                                                </ul>
                                            </div>
                                            <!-- /col -->
                                            <!-- col -->
                                            <div class="col-md-4 text-left">
                                                <p class="text-uppercase text-strong mb-10 custom-font">
                                                    Challan Info
                                                </p>
                                                <ul class="list-unstyled text-default lt mb-20">
                                                   <li><strong>Challan No:</strong> {{$master->id}}</li>
                                                   <li><strong>Challan Date:</strong> {{\Carbon\Carbon::parse($master->challan_date)->format('j-M-Y')}}</li>
                                                   <li><strong>Buyer Name:</strong> {{(App\Helpers\Helper::IDwiseData('buyers','id', (App\Helpers\Helper::IDwiseData('purchase_order_masters','id', $master->purchase_order_master_id))->buyer_id))->name}}</li>
                                                   <li><strong>LPD-{{(App\Helpers\Helper::IDwiseData('purchase_order_masters','id', $master->purchase_order_master_id))->lpd}} PO No:</strong> {{(App\Helpers\Helper::IDwiseData('purchase_order_masters','id', $master->purchase_order_master_id))->lpd_po_no}}</li>
                                                </ul>
                                            </div>
                                            <!-- /col -->
                                        </div>
                                    </div>
                                    <!-- /tile body -->
                                </section>
                                <!-- /tile -->
                                <!-- tile -->
                                <section class="tile tile-simple">
                                    <!-- tile body -->
                                    <div class="tile-body p-0">
                                                <div class="table-responsive">
                                                    <p style="font-size: x-small !important;"><b>Please acknowledge receipt of the following:</b></p>
                                                    <table class="table table-hover table-bordered table-condensed">
                                                        <thead>
                                                        <tr style="height: 3px !important;">
                                                            <th class="text-uppercase text-center" style="font-size: x-small !important;">Sl No.</th>
                                                            <th class="text-uppercase text-center" style=" font-size: x-small !important;">Style No</th>
                                                            <th class="text-uppercase text-center" style=" font-size: x-small !important;">Item Name</th>
                                                            <th class="text-uppercase text-center" style=" font-size: x-small !important;">Size</th>
                                                            <th class="text-uppercase text-center" style="font-size: x-small !important;">Color</th>
                                                            <th class="text-uppercase text-center" style="font-size: x-small !important;">Description</th>
                                                            <th class="text-uppercase text-center" style="font-size: x-small !important;">Stock Qty</th>
                                                            <th class="text-uppercase text-center" style="font-size: x-small !important;">Delivery Qty</th>
                                                            <th class="text-uppercase text-center" style="font-size: x-small !important;">Gross Weight(Kg)</th>
                                                            <th class="text-uppercase text-center" style="font-size: x-small !important;">Net Weight(Kg)</th>
                                                            <th class="text-uppercase text-center" style="font-size: x-small !important;">Remarks</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @php($i = 1)
                                                        @foreach($details as $item)
                                                                <tr style="height: 3px !important;">
                                                                    <td class="text-center" style="font-size: xx-small !important;"><P>{!! $i++ !!}</P></td>
                                                                    <td style="font-size: xx-small !important;"><P>{!! (\App\Helpers\Helper::TwoIDwiseData('purchase_order_details', 'purchase_order_master_id', $master->purchase_order_master_id, 'item_count', $item->purchase_order_detail_id))->style_no !!}</P></td>
                                                                    <td style="font-size: xx-small !important;"><p>{!! (\App\Helpers\Helper::IDwiseData('trims_types', 'id', (\App\Helpers\Helper::TwoIDwiseData('purchase_order_details', 'purchase_order_master_id', $master->purchase_order_master_id, 'item_count', $item->purchase_order_detail_id))->trims_type_id))->name !!}</p></td>
                                                                    <td style="font-size: xx-small !important;"><P>{!! (\App\Helpers\Helper::TwoIDwiseData('purchase_order_details', 'purchase_order_master_id', $master->purchase_order_master_id, 'item_count', $item->purchase_order_detail_id))->item_size !!}</P></td>
                                                                    <td style="font-size: xx-small !important;"><P>{!! (\App\Helpers\Helper::TwoIDwiseData('purchase_order_details', 'purchase_order_master_id', $master->purchase_order_master_id, 'item_count', $item->purchase_order_detail_id))->item_color !!}</P></td>
                                                                    <td style="font-size: xx-small !important;"><p>{!! (\App\Helpers\Helper::TwoIDwiseData('purchase_order_details', 'purchase_order_master_id', $master->purchase_order_master_id, 'item_count', $item->purchase_order_detail_id))->item_description !!}</p></td>
                                                                    <td style="font-size: xx-small !important;" class="text-right"><P>{!!  number_format($item->gross_delivered_quantity, 0, '.', ',') !!} {!! (\App\Helpers\Helper::IDwiseData('units', 'id', (\App\Helpers\Helper::TwoIDwiseData('purchase_order_details', 'purchase_order_master_id', $master->purchase_order_master_id, 'item_count', $item->purchase_order_detail_id))->item_unit_id))->short_unit !!}</P></td>
                                                                    <td style="font-size: xx-small !important;" class="text-right">
                                                                        <P>
                                                                            {!! number_format($item->delivered_quantity, 0, '.', ',') !!} {!! (\App\Helpers\Helper::IDwiseData('units', 'id', $item->gross_unit)->short_unit) !!}
                                                                        </P>
                                                                    </td>
                                                                    <td style="font-size: xx-small !important;" class="text-right"><P>{!! number_format( $item->gross_weight, 2, '.', ',') !!}</P></td>
                                                                    <td style="font-size: xx-small !important;" class="text-right"><P>{!! number_format( $item->total_weight, 2, '.', ',') !!}</P></td>
                                                                    <td style="font-size: xx-small !important;" class="text-right"><P>{!! $item->remarks !!}</P></td>
                                                                </tr>
                                                        @endforeach
                                                        </tbody>
                                                        <tfoot>
                                                            <td colspan="6" class="text-right" style="font-size: small !important;"><P><b>Total:</b></P></td>
                                                            <td class="text-right" style="font-size: small !important;">
                                                                <P>
                                                                    <b> {!! number_format($details->sum('gross_delivered_quantity'), 0, '.', ',') !!}</b>
                                                                </P>
                                                            </td>
                                                            <td class="text-right" style="font-size: small !important;">
                                                                <P>
                                                                    <b> {!! number_format($details->sum('delivered_quantity'), 0, '.', ',') !!}</b>
                                                                </P>
                                                            </td>
                                                            <td class="text-right" style="font-size: small !important;">
                                                                <P>
                                                                    <b> {!! number_format($details->sum('gross_weight'), 2, '.', ',') !!}</b>
                                                                </P>
                                                            </td>
                                                            <td class="text-right" style="font-size: small !important;">
                                                                <P>
                                                                    <b> {!! number_format($details->sum('total_weight'), 2, '.', ',') !!}</b>
                                                                </P>
                                                            </td>
                                                        </tfoot>
                                                    </table>
                                                </div>

                                    </div>
                                    <!-- /tile body -->
                                </section>
                                <!-- /tile -->
                            </div>
                        </div>
                        <div class="row">
                            <!-- col -->
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <!-- tile -->
                                <section class="tile tile-simple bg-tr-black lter">
                                    <div class="tile-body">
                                        <!-- row -->
                                        <div class="row">
                                            <!-- col -->
                                            <div class="col-md-12 text-left no-padding">
                                                <p class="text-strong mb-40 custom-font text-black-50">
                                                    <b class="text-uppercase" style="font-size: medium">&nbsp; Remarks</b><br>
                                                    &nbsp; @if($master->is_replacement_challan) <strong class="text-danger">Replacement Challan; &nbsp;</strong>@endif{!! $master->remarks !!}

                                                </p>
                                            </div>
                                            {{--<div class="col-md-6 text-right no-padding">
                                                <p class="text-strong mb-40 custom-font">
                                                    @if($master->is_urgent)
                                                        <b class="text-uppercase text-danger" style="font-size: medium">&nbsp; Urgent</b><br>
                                                    @endif
                                                    @if($master->is_revised)
                                                        <b class="text-uppercase text-danger" style="font-size: medium">&nbsp; Revised</b><br>
                                                        <strong>Revise Date:</strong> {{\Carbon\Carbon::parse($master->last_revise_date)->format('j-M-Y')}}
                                                    @endif
                                                </p>
                                            </div>--}}
                                        </div>
                                    </div>
                                    <!-- tile body -->

                                </section>
                                <!-- /tile -->
                            </div>
                            <!-- /col -->
                        </div>
                        <!-- /row -->
                        <!-- row -->
                        <div class="row">
                            <!-- col -->
                            <div class="col-md-12">
                                <!-- tile -->
                                <section class="tile tile-simple bg-tr-black lter">
                                    <!-- tile body -->
                                    <div class="tile-body p-0">
                                        <div class="table-responsive">
                                            <table class="table table-hover table-condensed">
                                                <tfoot>
                                                <tr>
                                                    <td class="text-center" style="font-size: xx-small !important;">
                                                        <hr>
                                                        <P><strong>Receiver's Signature</strong></P>
                                                    </td>
                                                    <td class="text-center" style="font-size: xx-small !important;">
                                                        <hr>
                                                        <P><strong>Store-Officer</strong></P>
                                                    </td>
                                                    <td class="text-center" style="font-size: xx-small !important;">
                                                        <hr>
                                                        <P><strong>Manager-Store</strong></P>
                                                    </td>
                                                    <td class="text-center" style="font-size: xx-small !important;">
                                                        <hr>
                                                        <P><strong>Authorized Signature</strong></P>
                                                    </td>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>

                                    </div>
                                    <!-- /tile body -->
                                    <div class="tile-footer">
                                        <p class="text-right" style="font-size: xx-small !important;">Report Generate From MTRIMS-Date:{{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>
                                    </div>
                                </section>
                                <!-- /tile -->
                            </div>
                            <!-- /col -->
                        </div>
                        <!-- /row -->
                    </div>
                    <{{--div role="tabpanel" class="tab-pane" id="customercopy">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <!-- tile -->
                                <section class="tile tile-simple bg-tr-black lter">
                                    <!-- tile body -->
                                    <div class="tile-body">
                                        <!-- row -->
                                        <div class="row">
                                            <!-- col -->
                                            <div class="col-md-12 text-center">
                                                <h3 class="text-uppercase text-strong mb-10 custom-font">
                                                    Hamza Trims Limited
                                                </h3>
                                                <ul class="list-unstyled text-default lt mb-20">
                                                    <li><strong>Corporate Head Office:</strong> 9/Kha Confidence Center, Shahazadpur, Gulshan, Dhaka-1212</li>
                                                    <li><strong>Factory:</strong> Bangabandhu Road, Tongibari, Ashulia, Dhaka.</li>
                                                </ul>
                                            </div>
                                            <div class="col-md-6 text-left no-padding">
                                                <p class="text-uppercase text-strong mb-10 custom-font text-white bg-greensea">
                                                    &nbsp;&nbsp;&nbsp;DELIVERY CHALLAN
                                                </p>
                                            </div>
                                            <div class="col-md-6 text-right no-padding">
                                                <p class="text-uppercase text-strong mb-10 custom-font text-white bg-greensea">
                                                    Customer Copy&nbsp;&nbsp;&nbsp;
                                                </p>
                                            </div>
                                            <!-- /col -->
                                        </div>
                                    </div>
                                    <!-- /tile body -->
                                    <!-- tile body -->
                                    <div class="tile-body">
                                        <!-- row -->
                                        <div class="row">
                                            <!-- col -->
                                            <div class="col-md-4 text-left">
                                                <p class="text-uppercase text-strong mb-10 custom-font">
                                                    To
                                                </p>
                                                <ul class="list-unstyled text-default lt mb-20">
                                                    <li><strong>Delivery Location:</strong> {{(App\Helpers\Helper::IDwiseData('stores','id', $master->store_id))->name}}</li>
                                                    <li><strong>Address:</strong> {{(App\Helpers\Helper::IDwiseData('stores','id', $master->store_id))->address}}</li>
                                                    <li><strong>Contact Person:</strong>  {{(App\Helpers\Helper::IDwiseData('stores','id', $master->store_id))->contact_person_info}}</li>
                                                </ul>
                                            </div>
                                            <div class="col-md-4 text-left">
                                                <p class="text-uppercase text-strong mb-10 custom-font">
                                                    Transportation Info
                                                </p>
                                                <ul class="list-unstyled text-default lt mb-20">
                                                    <li><strong>Driver Name:</strong> {{$master->driver_name}}</li>
                                                    <li><strong>Truck No:</strong> {{$master->truck_no}}</li>
                                                    <li><strong>Licence No:</strong> {{$master->licence_no}}</li>
                                                    <li><strong>Transport Name:</strong> {{$master->transport_name}}</li>
                                                </ul>
                                            </div>
                                            <!-- /col -->
                                            <!-- col -->
                                            <div class="col-md-4 text-left">
                                                <p class="text-uppercase text-strong mb-10 custom-font">
                                                    Challan Info
                                                </p>
                                                <ul class="list-unstyled text-default lt mb-20">
                                                    <li><strong>Challan No:</strong> {{$master->id}}</li>
                                                    <li><strong>Challan Date:</strong> {{\Carbon\Carbon::parse($master->challan_date)->format('j-M-Y')}}</li>
                                                    <li><strong>Buyer Name:</strong> {{(App\Helpers\Helper::IDwiseData('buyers','id', (App\Helpers\Helper::IDwiseData('purchase_order_masters','id', $master->purchase_order_master_id))->buyer_id))->name}}</li>
                                                    <li><strong>LPD-{{(App\Helpers\Helper::IDwiseData('purchase_order_masters','id', $master->purchase_order_master_id))->lpd}} PO No:</strong> {{(App\Helpers\Helper::IDwiseData('purchase_order_masters','id', $master->purchase_order_master_id))->lpd_po_no}}</li>
                                                </ul>
                                            </div>
                                            <!-- /col -->
                                        </div>
                                    </div>
                                    <!-- /tile body -->
                                </section>
                                <!-- /tile -->
                                <!-- tile -->
                                <section class="tile tile-simple">
                                    <!-- tile body -->
                                    <div class="tile-body p-0">
                                        <div class="table-responsive">
                                            <p style="font-size: x-small !important;"><b>Please acknowledge receipt of the following:</b></p>
                                            <table class="table table-hover table-bordered table-condensed">
                                                <thead>
                                                <tr style="height: 3px !important;">
                                                    <th class="text-uppercase text-center" style="font-size: x-small !important;">Sl No.</th>
                                                    <th class="text-uppercase text-center" style=" font-size: x-small !important;">Style No</th>
                                                    <th class="text-uppercase text-center" style=" font-size: x-small !important;">Trims Type</th>
                                                    <th class="text-uppercase text-center" style=" font-size: x-small !important;">Size</th>
                                                    <th class="text-uppercase text-center" style="font-size: x-small !important;">Color</th>
                                                    <th class="text-uppercase text-center" style="font-size: x-small !important;">Description</th>
                                                    <th class="text-uppercase text-center" style="font-size: x-small !important;">Unit</th>
                                                    <th class="text-uppercase text-center" style="font-size: x-small !important;">Qty</th>
                                                    <th class="text-uppercase text-center" style="font-size: x-small !important;">Weight(Kg)</th>
                                                    <th class="text-uppercase text-center" style="font-size: x-small !important;">Remarks</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php($i = 1)
                                                @foreach($details as $item)
                                                    <tr style="height: 3px !important;">
                                                        <td class="text-center" style="font-size: xx-small !important;"><P>{!! $i++ !!}</P></td>
                                                        <td style="font-size: xx-small !important;"><P>{!! (\App\Helpers\Helper::TwoIDwiseData('purchase_order_details', 'purchase_order_master_id', $master->purchase_order_master_id, 'item_count', $item->purchase_order_detail_id))->style_no !!}</P></td>
                                                        <td style="font-size: xx-small !important;"><p>{!! (\App\Helpers\Helper::IDwiseData('trims_types', 'id', (\App\Helpers\Helper::TwoIDwiseData('purchase_order_details', 'purchase_order_master_id', $master->purchase_order_master_id, 'item_count', $item->purchase_order_detail_id))->trims_type_id))->name !!}</p></td>
                                                        <td style="font-size: xx-small !important;"><P>{!! (\App\Helpers\Helper::TwoIDwiseData('purchase_order_details', 'purchase_order_master_id', $master->purchase_order_master_id, 'item_count', $item->purchase_order_detail_id))->item_size !!}</P></td>
                                                        <td style="font-size: xx-small !important;"><P>{!! (\App\Helpers\Helper::TwoIDwiseData('purchase_order_details', 'purchase_order_master_id', $master->purchase_order_master_id, 'item_count', $item->purchase_order_detail_id))->item_color !!}</P></td>
                                                        <td style="font-size: xx-small !important;"><p>{!! (\App\Helpers\Helper::TwoIDwiseData('purchase_order_details', 'purchase_order_master_id', $master->purchase_order_master_id, 'item_count', $item->purchase_order_detail_id))->item_description !!}</p></td>
                                                        <td style="font-size: xx-small !important;" class="text-center"><p>{!! (\App\Helpers\Helper::IDwiseData('units', 'id', (\App\Helpers\Helper::TwoIDwiseData('purchase_order_details', 'purchase_order_master_id', $master->purchase_order_master_id, 'item_count', $item->purchase_order_detail_id))->item_unit_id))->short_unit !!}</p></td>
                                                        <td style="font-size: xx-small !important;" class="text-right"><P>{!! $item->delivered_quantity!!}</P></td>
                                                        <td style="font-size: xx-small !important;" class="text-right"><P>{!! $item->total_weight !!}</P></td>
                                                        <td style="font-size: xx-small !important;" class="text-right"><P>{!! $item->remarks !!}</P></td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                    <!-- /tile body -->
                                </section>
                                <!-- /tile -->
                            </div>
                        </div>
                        <!-- row -->
                        <div class="row">
                            <!-- col -->
                            <div class="col-md-5 col-md-offset-7 price-total">
                                <!-- tile -->
                                <section class="tile tile-simple bg-tr-black lter">
                                    <!-- tile body -->
                                    <div class="tile-body">
                                        <ul class="list-unstyled">
                                            <li class="ng-binding"><strong class="inline-block w-sm mb-5">Remarks:</strong> {!! $master->remarks !!}</li>
                                        </ul>
                                    </div>
                                    <!-- /tile body -->
                                    <div class="tile-footer">
                                        <p class="text-right" style="font-size: xx-small !important;">Report Generate From MTRIMS-Date:{{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>
                                    </div>
                                </section>
                                <!-- /tile -->
                            </div>
                            <!-- /col -->
                        </div>
                        <!-- /row -->
                        <!-- row -->
                        <div class="row">
                            <!-- col -->
                            <div class="col-md-12">
                                <!-- tile -->
                                <section class="tile tile-simple bg-tr-black lter">
                                    <!-- tile body -->
                                    <div class="tile-body p-0">
                                        <div class="table-responsive">
                                            <table class="table table-hover table-condensed">
                                                <tfoot>
                                                <tr>
                                                    <td class="text-center" style="font-size: xx-small !important;">
                                                        <hr>
                                                        <P><strong>Receiver's Signature</strong></P>
                                                    </td>
                                                    <td class="text-center" style="font-size: xx-small !important;">
                                                        <hr>
                                                        <P><strong>Store-Officer</strong></P>
                                                    </td>
                                                    <td class="text-center" style="font-size: xx-small !important;">
                                                        <hr>
                                                        <P><strong>Manager-Store</strong></P>
                                                    </td>
                                                    <td class="text-center" style="font-size: xx-small !important;">
                                                        <hr>
                                                        <P><strong>Authorized Signature</strong></P>
                                                    </td>
                                                </tr>
                                                </tfoot>
                                            </table>
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
                    <div role="tabpanel" class="tab-pane" id="accountscopy">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <!-- tile -->
                                <section class="tile tile-simple bg-tr-black lter">
                                    <!-- tile body -->
                                    <div class="tile-body">
                                        <!-- row -->
                                        <div class="row">
                                            <!-- col -->
                                            <div class="col-md-12 text-center">
                                                <h3 class="text-uppercase text-strong mb-10 custom-font">
                                                    Hamza Trims Limited
                                                </h3>
                                                <ul class="list-unstyled text-default lt mb-20">
                                                    <li><strong>Corporate Head Office:</strong> 9/Kha Confidence Center, Shahazadpur, Gulshan, Dhaka-1212</li>
                                                    <li><strong>Factory:</strong> Bangabandhu Road, Tongibari, Ashulia, Dhaka.</li>
                                                </ul>
                                            </div>
                                            <div class="col-md-6 text-left no-padding">
                                                <p class="text-uppercase text-strong mb-10 custom-font text-white bg-greensea">
                                                    &nbsp;&nbsp;&nbsp; DELIVERY CHALLAN
                                                </p>
                                            </div>
                                            <div class="col-md-6 text-right no-padding">
                                                <p class="text-uppercase text-strong mb-10 custom-font text-white bg-greensea">
                                                    Accounts Copy &nbsp;&nbsp;&nbsp;
                                                </p>
                                            </div>
                                            <!-- /col -->
                                        </div>
                                    </div>
                                    <!-- /tile body -->
                                    <!-- tile body -->
                                    <div class="tile-body">
                                        <!-- row -->
                                        <div class="row">
                                            <!-- col -->
                                            <div class="col-md-4 text-left">
                                                <p class="text-uppercase text-strong mb-10 custom-font">
                                                    To
                                                </p>
                                                <ul class="list-unstyled text-default lt mb-20">
                                                    <li><strong>Delivery Location:</strong> {{(App\Helpers\Helper::IDwiseData('stores','id', $master->store_id))->name}}</li>
                                                    <li><strong>Address:</strong> {{(App\Helpers\Helper::IDwiseData('stores','id', $master->store_id))->address}}</li>
                                                    <li><strong>Contact Person:</strong>  {{(App\Helpers\Helper::IDwiseData('stores','id', $master->store_id))->contact_person_info}}</li>
                                                </ul>
                                            </div>
                                            <div class="col-md-4 text-left">
                                                <p class="text-uppercase text-strong mb-10 custom-font">
                                                    Transportation Info
                                                </p>
                                                <ul class="list-unstyled text-default lt mb-20">
                                                    <li><strong>Driver Name:</strong> {{$master->driver_name}}</li>
                                                    <li><strong>Truck No:</strong> {{$master->truck_no}}</li>
                                                    <li><strong>Licence No:</strong> {{$master->licence_no}}</li>
                                                    <li><strong>Transport Name:</strong> {{$master->transport_name}}</li>
                                                </ul>
                                            </div>
                                            <!-- /col -->
                                            <!-- col -->
                                            <div class="col-md-4 text-left">
                                                <p class="text-uppercase text-strong mb-10 custom-font">
                                                    Challan Info
                                                </p>
                                                <ul class="list-unstyled text-default lt mb-20">
                                                    <li><strong>Challan No:</strong> {{$master->id}}</li>
                                                    <li><strong>Challan Date:</strong> {{\Carbon\Carbon::parse($master->challan_date)->format('j-M-Y')}}</li>
                                                    <li><strong>Buyer Name:</strong> {{(App\Helpers\Helper::IDwiseData('buyers','id', (App\Helpers\Helper::IDwiseData('purchase_order_masters','id', $master->purchase_order_master_id))->buyer_id))->name}}</li>
                                                    <li><strong>LPD-{{(App\Helpers\Helper::IDwiseData('purchase_order_masters','id', $master->purchase_order_master_id))->lpd}} PO No:</strong> {{(App\Helpers\Helper::IDwiseData('purchase_order_masters','id', $master->purchase_order_master_id))->lpd_po_no}}</li>
                                                </ul>
                                            </div>
                                            <!-- /col -->
                                        </div>
                                    </div>
                                    <!-- /tile body -->
                                </section>
                                <!-- /tile -->
                                <!-- tile -->
                                <section class="tile tile-simple">
                                    <!-- tile body -->
                                    <div class="tile-body p-0">
                                        <div class="table-responsive">
                                            <p style="font-size: x-small !important;"><b>Please acknowledge receipt of the following:</b></p>
                                            <table class="table table-hover table-bordered table-condensed">
                                                <thead>
                                                <tr style="height: 3px !important;">
                                                    <th class="text-uppercase text-center" style="font-size: x-small !important;">Sl No.</th>
                                                    <th class="text-uppercase text-center" style=" font-size: x-small !important;">Style No</th>
                                                    <th class="text-uppercase text-center" style=" font-size: x-small !important;">Trims Type</th>
                                                    <th class="text-uppercase text-center" style=" font-size: x-small !important;">Size</th>
                                                    <th class="text-uppercase text-center" style="font-size: x-small !important;">Color</th>
                                                    <th class="text-uppercase text-center" style="font-size: x-small !important;">Description</th>
                                                    <th class="text-uppercase text-center" style="font-size: x-small !important;">Unit</th>
                                                    <th class="text-uppercase text-center" style="font-size: x-small !important;">Qty</th>
                                                    <th class="text-uppercase text-center" style="font-size: x-small !important;">Weight(Kg)</th>
                                                    <th class="text-uppercase text-center" style="font-size: x-small !important;">Remarks</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php($i = 1)
                                                @foreach($details as $item)
                                                    <tr style="height: 3px !important;">
                                                        <td class="text-center" style="font-size: xx-small !important;"><P>{!! $i++ !!}</P></td>
                                                        <td style="font-size: xx-small !important;"><P>{!! (\App\Helpers\Helper::TwoIDwiseData('purchase_order_details', 'purchase_order_master_id', $master->purchase_order_master_id, 'item_count', $item->purchase_order_detail_id))->style_no !!}</P></td>
                                                        <td style="font-size: xx-small !important;"><p>{!! (\App\Helpers\Helper::IDwiseData('trims_types', 'id', (\App\Helpers\Helper::TwoIDwiseData('purchase_order_details', 'purchase_order_master_id', $master->purchase_order_master_id, 'item_count', $item->purchase_order_detail_id))->trims_type_id))->name !!}</p></td>
                                                        <td style="font-size: xx-small !important;"><P>{!! (\App\Helpers\Helper::TwoIDwiseData('purchase_order_details', 'purchase_order_master_id', $master->purchase_order_master_id, 'item_count', $item->purchase_order_detail_id))->item_size !!}</P></td>
                                                        <td style="font-size: xx-small !important;"><P>{!! (\App\Helpers\Helper::TwoIDwiseData('purchase_order_details', 'purchase_order_master_id', $master->purchase_order_master_id, 'item_count', $item->purchase_order_detail_id))->item_color !!}</P></td>
                                                        <td style="font-size: xx-small !important;"><p>{!! (\App\Helpers\Helper::TwoIDwiseData('purchase_order_details', 'purchase_order_master_id', $master->purchase_order_master_id, 'item_count', $item->purchase_order_detail_id))->item_description !!}</p></td>
                                                        <td style="font-size: xx-small !important;" class="text-center"><p>{!! (\App\Helpers\Helper::IDwiseData('units', 'id', (\App\Helpers\Helper::TwoIDwiseData('purchase_order_details', 'purchase_order_master_id', $master->purchase_order_master_id, 'item_count', $item->purchase_order_detail_id))->item_unit_id))->short_unit !!}</p></td>
                                                        <td style="font-size: xx-small !important;" class="text-right"><P>{!! $item->delivered_quantity!!}</P></td>
                                                        <td style="font-size: xx-small !important;" class="text-right"><P>{!! $item->total_weight !!}</P></td>
                                                        <td style="font-size: xx-small !important;" class="text-right"><P>{!! $item->remarks !!}</P></td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                    <!-- /tile body -->
                                </section>
                                <!-- /tile -->
                            </div>
                        </div>
                        <!-- row -->
                        <div class="row">
                            <!-- col -->
                            <div class="col-md-5 col-md-offset-7 price-total">
                                <!-- tile -->
                                <section class="tile tile-simple bg-tr-black lter">
                                    <!-- tile body -->
                                    <div class="tile-body">
                                        <ul class="list-unstyled">
                                            <li class="ng-binding"><strong class="inline-block w-sm mb-5">Remarks:</strong> {!! $master->remarks !!}</li>
                                        </ul>
                                    </div>
                                    <!-- /tile body -->
                                </section>
                                <!-- /tile -->
                            </div>
                            <!-- /col -->
                        </div>
                        <!-- /row -->
                        <!-- row -->
                        <div class="row">
                            <!-- col -->
                            <div class="col-md-12">
                                <!-- tile -->
                                <section class="tile tile-simple bg-tr-black lter">
                                    <!-- tile body -->
                                    <div class="tile-body p-0">
                                        <div class="table-responsive">
                                            <table class="table table-hover table-condensed">
                                                <tfoot>
                                                <tr>
                                                    <td class="text-center" style="font-size: xx-small !important;">
                                                        <hr>
                                                        <P><strong>Receiver's Signature</strong></P>
                                                    </td>
                                                    <td class="text-center" style="font-size: xx-small !important;">
                                                        <hr>
                                                        <P><strong>Store-Officer</strong></P>
                                                    </td>
                                                    <td class="text-center" style="font-size: xx-small !important;">
                                                        <hr>
                                                        <P><strong>Manager-Store</strong></P>
                                                    </td>
                                                    <td class="text-center" style="font-size: xx-small !important;">
                                                        <hr>
                                                        <P><strong>Authorized Signature</strong></P>
                                                    </td>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- /tile body -->
                                    <div class="tile-footer">
                                        <p class="text-right" style="font-size: xx-small !important;">Report Generate From MTRIMS-Date:{{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>
                                    </div>
                                </section>
                                <!-- /tile -->
                            </div>
                            <!-- /col -->
                        </div>
                        <!-- /row -->
                    </div>
                    <div role="tabpanel" class="tab-pane" id="gatecopy">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <!-- tile -->
                                <section class="tile tile-simple bg-tr-black lter">
                                    <!-- tile body -->
                                    <div class="tile-body">
                                        <!-- row -->
                                        <div class="row">
                                            <!-- col -->
                                            <div class="col-md-12 text-center">
                                                <h3 class="text-uppercase text-strong mb-10 custom-font">
                                                    Hamza Trims Limited
                                                </h3>
                                                <ul class="list-unstyled text-default lt mb-20">
                                                    <li><strong>Corporate Head Office:</strong> 9/Kha Confidence Center, Shahazadpur, Gulshan, Dhaka-1212</li>
                                                    <li><strong>Factory:</strong> Bangabandhu Road, Tongibari, Ashulia, Dhaka.</li>
                                                </ul>
                                            </div>
                                            <div class="col-md-6 text-left no-padding">
                                                <p class="text-uppercase text-strong mb-10 custom-font text-white bg-greensea">
                                                    &nbsp;&nbsp;&nbsp; DELIVERY CHALLAN
                                                </p>
                                            </div>
                                            <div class="col-md-6 text-right no-padding">
                                                <p class="text-uppercase text-strong mb-10 custom-font text-white bg-greensea">
                                                    Gate Pass &nbsp;&nbsp;&nbsp;
                                                </p>
                                            </div>
                                            <!-- /col -->
                                        </div>
                                    </div>
                                    <!-- /tile body -->
                                    <!-- tile body -->
                                    <div class="tile-body">
                                        <!-- row -->
                                        <div class="row">
                                            <!-- col -->
                                            <div class="col-md-4 text-left">
                                                <p class="text-uppercase text-strong mb-10 custom-font">
                                                    To
                                                </p>
                                                <ul class="list-unstyled text-default lt mb-20">
                                                    <li><strong>Delivery Location:</strong> {{(App\Helpers\Helper::IDwiseData('stores','id', $master->store_id))->name}}</li>
                                                    <li><strong>Address:</strong> {{(App\Helpers\Helper::IDwiseData('stores','id', $master->store_id))->address}}</li>
                                                    <li><strong>Contact Person:</strong>  {{(App\Helpers\Helper::IDwiseData('stores','id', $master->store_id))->contact_person_info}}</li>
                                                </ul>
                                            </div>
                                            <div class="col-md-4 text-left">
                                                <p class="text-uppercase text-strong mb-10 custom-font">
                                                    Transportation Info
                                                </p>
                                                <ul class="list-unstyled text-default lt mb-20">
                                                    <li><strong>Driver Name:</strong> {{$master->driver_name}}</li>
                                                    <li><strong>Truck No:</strong> {{$master->truck_no}}</li>
                                                    <li><strong>Licence No:</strong> {{$master->licence_no}}</li>
                                                    <li><strong>Transport Name:</strong> {{$master->transport_name}}</li>
                                                </ul>
                                            </div>
                                            <!-- /col -->
                                            <!-- col -->
                                            <div class="col-md-4 text-left">
                                                <p class="text-uppercase text-strong mb-10 custom-font">
                                                    Challan Info
                                                </p>
                                                <ul class="list-unstyled text-default lt mb-20">
                                                    <li><strong>Challan No:</strong> {{$master->id}}</li>
                                                    <li><strong>Challan Date:</strong> {{\Carbon\Carbon::parse($master->challan_date)->format('j-M-Y')}}</li>
                                                    <li><strong>Buyer Name:</strong> {{(App\Helpers\Helper::IDwiseData('buyers','id', (App\Helpers\Helper::IDwiseData('purchase_order_masters','id', $master->purchase_order_master_id))->buyer_id))->name}}</li>
                                                    <li><strong>LPD-{{(App\Helpers\Helper::IDwiseData('purchase_order_masters','id', $master->purchase_order_master_id))->lpd}} PO No:</strong> {{(App\Helpers\Helper::IDwiseData('purchase_order_masters','id', $master->purchase_order_master_id))->lpd_po_no}}</li>
                                                </ul>
                                            </div>
                                            <!-- /col -->
                                        </div>
                                    </div>
                                    <!-- /tile body -->
                                </section>
                                <!-- /tile -->
                                <!-- tile -->
                                <section class="tile tile-simple">
                                    <!-- tile body -->
                                    <div class="tile-body p-0">
                                        <div class="table-responsive">
                                            <p style="font-size: x-small !important;"><b>Please acknowledge receipt of the following:</b></p>
                                            <table class="table table-hover table-bordered table-condensed">
                                                <thead>
                                                <tr style="height: 3px !important;">
                                                    <th class="text-uppercase text-center" style="font-size: x-small !important;">Sl No.</th>
                                                    <th class="text-uppercase text-center" style=" font-size: x-small !important;">Style No</th>
                                                    <th class="text-uppercase text-center" style=" font-size: x-small !important;">Trims Type</th>
                                                    <th class="text-uppercase text-center" style=" font-size: x-small !important;">Size</th>
                                                    <th class="text-uppercase text-center" style="font-size: x-small !important;">Color</th>
                                                    <th class="text-uppercase text-center" style="font-size: x-small !important;">Description</th>
                                                    <th class="text-uppercase text-center" style="font-size: x-small !important;">Unit</th>
                                                    <th class="text-uppercase text-center" style="font-size: x-small !important;">Qty</th>
                                                    <th class="text-uppercase text-center" style="font-size: x-small !important;">Weight(Kg)</th>
                                                    <th class="text-uppercase text-center" style="font-size: x-small !important;">Remarks</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php($i = 1)
                                                @foreach($details as $item)
                                                    <tr style="height: 3px !important;">
                                                        <td class="text-center" style="font-size: xx-small !important;"><P>{!! $i++ !!}</P></td>
                                                        <td style="font-size: xx-small !important;"><P>{!! (\App\Helpers\Helper::TwoIDwiseData('purchase_order_details', 'purchase_order_master_id', $master->purchase_order_master_id, 'item_count', $item->purchase_order_detail_id))->style_no !!}</P></td>
                                                        <td style="font-size: xx-small !important;"><p>{!! (\App\Helpers\Helper::IDwiseData('trims_types', 'id', (\App\Helpers\Helper::TwoIDwiseData('purchase_order_details', 'purchase_order_master_id', $master->purchase_order_master_id, 'item_count', $item->purchase_order_detail_id))->trims_type_id))->name !!}</p></td>
                                                        <td style="font-size: xx-small !important;"><P>{!! (\App\Helpers\Helper::TwoIDwiseData('purchase_order_details', 'purchase_order_master_id', $master->purchase_order_master_id, 'item_count', $item->purchase_order_detail_id))->item_size !!}</P></td>
                                                        <td style="font-size: xx-small !important;"><P>{!! (\App\Helpers\Helper::TwoIDwiseData('purchase_order_details', 'purchase_order_master_id', $master->purchase_order_master_id, 'item_count', $item->purchase_order_detail_id))->item_color !!}</P></td>
                                                        <td style="font-size: xx-small !important;"><p>{!! (\App\Helpers\Helper::TwoIDwiseData('purchase_order_details', 'purchase_order_master_id', $master->purchase_order_master_id, 'item_count', $item->purchase_order_detail_id))->item_description !!}</p></td>
                                                        <td style="font-size: xx-small !important;" class="text-center"><p>{!! (\App\Helpers\Helper::IDwiseData('units', 'id', (\App\Helpers\Helper::TwoIDwiseData('purchase_order_details', 'purchase_order_master_id', $master->purchase_order_master_id, 'item_count', $item->purchase_order_detail_id))->item_unit_id))->short_unit !!}</p></td>
                                                        <td style="font-size: xx-small !important;" class="text-right"><P>{!! $item->delivered_quantity!!}</P></td>
                                                        <td style="font-size: xx-small !important;" class="text-right"><P>{!! $item->total_weight !!}</P></td>
                                                        <td style="font-size: xx-small !important;" class="text-right"><P>{!! $item->remarks !!}</P></td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                    <!-- /tile body -->
                                </section>
                                <!-- /tile -->
                            </div>
                        </div>
                        <!-- row -->
                        <div class="row">
                            <!-- col -->
                            <div class="col-md-5 col-md-offset-7 price-total">
                                <!-- tile -->
                                <section class="tile tile-simple bg-tr-black lter">
                                    <!-- tile body -->
                                    <div class="tile-body">
                                        <ul class="list-unstyled">
                                            <li class="ng-binding"><strong class="inline-block w-sm mb-5">Remarks:</strong> {!! $master->remarks !!}</li>
                                        </ul>
                                    </div>
                                    <!-- /tile body -->
                                </section>
                                <!-- /tile -->
                            </div>
                            <!-- /col -->
                        </div>
                        <!-- /row -->
                        <!-- row -->
                        <div class="row">
                            <!-- col -->
                            <div class="col-md-12">
                                <!-- tile -->
                                <section class="tile tile-simple bg-tr-black lter">
                                    <!-- tile body -->
                                    <div class="tile-body p-0">
                                        <div class="table-responsive">
                                            <table class="table table-hover table-condensed">
                                                <tfoot>
                                                <tr>
                                                    <td class="text-center" style="font-size: xx-small !important;">
                                                        <hr>
                                                        <P><strong>Receiver's Signature</strong></P>
                                                    </td>
                                                    <td class="text-center" style="font-size: xx-small !important;">
                                                        <hr>
                                                        <P><strong>Store-Officer</strong></P>
                                                    </td>
                                                    <td class="text-center" style="font-size: xx-small !important;">
                                                        <hr>
                                                        <P><strong>Manager-Store</strong></P>
                                                    </td>
                                                    <td class="text-center" style="font-size: xx-small !important;">
                                                        <hr>
                                                        <P><strong>Authorized Signature</strong></P>
                                                    </td>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- /tile body -->
                                    <div class="tile-footer">
                                        <p class="text-right" style="font-size: xx-small !important;">Report Generate From MTRIMS-Date:{{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>
                                    </div>
                                </section>
                                <!-- /tile -->
                            </div>
                            <!-- /col -->
                        </div>
                        <!-- /row -->
                    </div>--}}
                </div>
            </div>
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



