@extends('layouts.lpd1.lpd-1-master')

@section('title')
    Purchase Order
@endsection
@section('content')
    <style type="text/css">
        th{
            background-color: #0689bd;
            color: white;
        }
        /*td p{
            font-size: 5px !important;
        }*/
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
            <h2>LPD-1 <span>// Local Purchase Division Section: 1</span></h2>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{route('lpd1.home')}}"><i class="fa fa-home"></i> LPD-1</a>
                    </li>
                    <li>
                        <a href="{{route('lpd1.purchase.order')}}"> Purchase Order</a>
                    </li>

                    <li>
                        <a href="{{route('lpd1.purchase.order.detail', ['id' => $purchaseOrder->id])}}"> PO No: {{$purchaseOrder->lpd_po_no}}</a>
                    </li>
                    <li>
                        <a href="#"> Production Plan Print View</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- row -->
        <!-- row -->
        <div class="add-nav">
            <div class="nav-heading">
                <span class="controls pull-right">
                    <a href="{{route('lpd1.purchase.order.detail', ['id' => $purchaseOrder->id])}}" class="btn btn-ef btn-ef-1 btn-ef-1-default btn-ef-1a btn-rounded-20 mr-5" data-toggle="tooltip" title="Back"><i class="fa fa-times"></i></a>
                    <a href="javascript:window.print()" class="btn btn-ef btn-ef-1 btn-ef-1-default btn-ef-1a btn-rounded-20" data-toggle="tooltip" title="Print"><i class="fa fa-print"></i></a>
                </span>
            </div>
            <div role="tabpanel">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#details" aria-controls="details" role="tab" data-toggle="tab">Details</a></li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="details">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <!-- tile -->
                                <section class="tile tile-simple bg-tr-black lter">
                                    <!-- tile body -->
                                    <div class="tile-body">
                                        <!-- row -->
                                        <div class="row">
                                            <!-- col -->
                                            <div class="col-md-8">
                                                <p class="text-uppercase text-strong mb-10 custom-font">
                                                    Hamza Trims Limited
                                                </p>
                                                <ul class="list-unstyled text-default lt mb-20">
                                                    <li><strong>Corporate Head Office:</strong> 9/Kha Confidence Center, Shahazadpur, Gulshan, Dhaka-1212</li>
                                                    {{--                                                    <li><strong>Factory:</strong> 9/Kha Confidence Center, Shahazadpur, Gulshan, Dhaka-1212</li>--}}
                                                    <li><strong>Factory:</strong> Bangabandhu Road, Tongibari, Ashulia, Dhaka.</li>
                                                </ul>
                                            </div>
                                            <!-- /col -->
                                            <!-- col -->
                                            <div class="col-md-4 text-right">
                                                <h4 class="mb-0 text-custom text-strong"><strong class="text-greensea">Production Plan Report</strong></h4>
                                                <ul class="list-unstyled text-default lt mb-20">
                                                    <li><strong>LPD-1-PO NO:</strong> {{$purchaseOrder->lpd_po_no}}</li>
                                                    <li><strong>Buyer:</strong> {{(\App\Helpers\Helper::IDwiseData('buyers', 'id', $purchaseOrder->buyer_id))->name}}</li>
                                                    <li><strong>HTL Job No:</strong>
                                                        @foreach($uniqTrimsTypes as $item)
                                                            {{ $item->short_name }}-
                                                        @endforeach
                                                        {{$purchaseOrder->job_year}}/{{$purchaseOrder->job_no}}
                                                    </li>
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
                                            <table class="table table-hover table-bordered table-condensed">
                                                <thead>
                                                <tr style="height: 3px !important;">
                                                    <th style="font-size: x-small !important;">Production Area</th>
                                                    <th style="font-size: x-small !important;">Production Date</th>
                                                    <th style="font-size: x-small !important;">Proposed Delivery Location</th>
                                                    <th style="font-size: x-small !important;">Trims Type</th>
                                                    <th style="font-size: x-small !important;">Item Description</th>
                                                    <th style="font-size: x-small !important;">Size</th>
                                                    <th style="font-size: x-small !important;">Color</th>
                                                    <th style="font-size: x-small !important;">No Head</th>
                                                    <th style="font-size: x-small !important;">Unit</th>
                                                    <th style="font-size: x-small !important;">Target</th>
                                                    <th style="font-size: x-small !important;">Remarks</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($productionPlanDetails as $item)
                                                    <tr style="height: 3px !important;">
                                                        <td style="font-size: xx-small !important;"><p>{{ (\App\Helpers\Helper::IDwiseData('machine_setups', 'id', $item->machine_id))->name }}</p></td>
                                                        <td style="font-size: xx-small !important;"><p>{{ \Carbon\Carbon::parse($item->production_date)->format('d/m/Y') }}</p></td>
                                                        <td style="font-size: xx-small !important;"><p>{!! (\App\Helpers\Helper::IDwiseData('stores', 'id', $item->delivery_location_id))->short_name !!}</p></td>
                                                        <td style="font-size: xx-small !important;"><p>{!! (\App\Helpers\Helper::IDwiseData('trims_types', 'id', (\App\Helpers\Helper::TwoIDwiseData('purchase_order_details', 'purchase_order_master_id', $item->purchase_order_master_id, 'item_count', $item->purchase_order_detail_id))->trims_type_id))->name !!}</p></td>
                                                        <td style="font-size: xx-small !important;"><p>{!! (\App\Helpers\Helper::TwoIDwiseData('purchase_order_details', 'purchase_order_master_id', $item->purchase_order_master_id, 'item_count', $item->purchase_order_detail_id))->item_description !!}</p></td>
                                                        <td style="font-size: xx-small !important;"><P>{!! (\App\Helpers\Helper::TwoIDwiseData('purchase_order_details', 'purchase_order_master_id', $item->purchase_order_master_id, 'item_count', $item->purchase_order_detail_id))->item_size !!}</P></td>
                                                        <td style="font-size: xx-small !important;"><P>{!! (\App\Helpers\Helper::TwoIDwiseData('purchase_order_details', 'purchase_order_master_id', $item->purchase_order_master_id, 'item_count', $item->purchase_order_detail_id))->item_color !!}</P></td>
                                                        <td style="font-size: xx-small !important;" class="text-right"><p>{!! $item->no_of_heads !!}</p></td>
                                                        <td style="font-size: xx-small !important;" class="text-right"><p>{!! (\App\Helpers\Helper::IDwiseData('units', 'id', $item->item_unit_id))->short_unit !!}</p></td>
                                                        <td style="font-size: xx-small !important;" class="text-right"><p>{!! $item->target_production !!}</p></td>
                                                        <td style="font-size: xx-small !important;" class="text-right"><P>{!! $item->remarks !!}</P></td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
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
                        </div>
                        <!-- row -->
                    {{--<div class="row">
                        <!-- col -->
                        <div class="col-md-5 col-md-offset-7 price-total">
                            <!-- tile -->
                            <section class="tile tile-simple bg-tr-black lter">
                                <!-- tile body -->
                                <div class="tile-body">
                                    <ul class="list-unstyled">
                                        <li class="ng-binding"><strong class="inline-block w-sm mb-5">Total Machine:</strong> {!! (\App\Helpers\Helper::GetTotalActiveMachineCount()) !!}</li>
                                        <li class="ng-binding"><strong class="inline-block w-sm mb-5">Total Running Machine:</strong> {!! (\App\Helpers\Helper::GetTotalRunningMachineCount($productionPlanMaster->id)) !!}</li>
                                        <li class="ng-binding"><strong class="inline-block w-sm mb-5">Idle Machine:</strong> {!! (\App\Helpers\Helper::GetTotalIdleMachineCount($productionPlanMaster->id)) !!}</li>
                                        <li class="ng-binding"><strong class="inline-block w-sm mb-5">Total Target Production:</strong> {!! (\App\Helpers\Helper::GetTotalProductionCount($productionPlanMaster->id))->total_target_production !!}</li>
                                        --}}{{--                                            <li class="ng-binding"><strong class="inline-block w-sm mb-5">Total Refunded:</strong> $0.00</li>--}}{{--
                                        --}}{{--                                            <li><strong class="inline-block w-sm">Total Due:</strong> <h3 class="inline-block text-success ng-binding">$890.21</h3></li>--}}{{--
                                    </ul>
                                </div>
                                <!-- /tile body -->
                            </section>
                            <!-- /tile -->
                        </div>
                        <!-- /col -->
                    </div>--}}
                    <!-- /row -->
                    </div>
                </div>
            </div>
        </div>
        <!-- /row -->
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



