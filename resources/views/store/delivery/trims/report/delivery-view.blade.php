
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
            <h2>Store <span>//Trims Delivery Report</span></h2>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{route('store.home')}}"><i class="fa fa-home"></i> Store</a>
                    </li>
                    <li>
                        <a href="{{route('store.report.trims.delivery')}}"> Trims Delivery Report</a>
                    </li>
                    <li>
                        <a href="#"> Report</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- row -->
        <div class="add-nav">
            <div class="nav-heading">
                <h3>Delivery Status Report: <strong class="text-greensea">{{--{{$master->id}}--}}</strong></h3>
                <span class="controls pull-right">
                    <a href="{{route('store.report.trims.delivery')}}" class="btn btn-ef btn-ef-1 btn-ef-1-default btn-ef-1a btn-rounded-20 mr-5" data-toggle="tooltip" title="Back"><i class="fa fa-times"></i></a>
{{--                    <a href="javascript:;" class="btn btn-ef btn-ef-1 btn-ef-1-default btn-ef-1a btn-rounded-20 mr-5" data-toggle="tooltip" title="Send"><i class="fa fa-envelope"></i></a>--}}
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
                                            <div class="col-md-6 text-left">
                                                <h3 class="text-uppercase text-strong mb-10 custom-font">
                                                    Hamza Trims Limited
                                                </h3>
                                                <ul class="list-unstyled text-default lt mb-20">
                                                    <li><strong>Corporate Head Office:</strong> 9/Kha Confidence Center, Shahazadpur, Gulshan, Dhaka-1212</li>
                                                    <li><strong>Factory:</strong> Bangabandhu Road, Tongibari, Ashulia, Dhaka.</li>
                                                </ul>
                                            </div>
                                            <div class="col-md-6 text-right">
                                                <h3 class="text-uppercase text-strong mb-10 custom-font">
                                                    Delivery Status Report
                                                </h3>
                                                <ul class="list-unstyled text-default lt mb-20">
                                                    <li><strong>From Date:</strong> {{\Carbon\Carbon::parse($from_date)->format('j-M-Y')}}</li>
                                                    <li><strong>To Date:</strong> {{\Carbon\Carbon::parse($to_date)->format('j-M-Y')}}</li>
                                                    {{--                                                    <li><strong>Buyer Name:</strong> {{(App\Helpers\Helper::IDwiseData('buyers','id', (App\Helpers\Helper::IDwiseData('purchase_order_masters','id', $master->purchase_order_master_id))->buyer_id))->name}}</li>--}}
                                                    {{--                                                    <li><strong>LPD-{{(App\Helpers\Helper::IDwiseData('purchase_order_masters','id', $master->purchase_order_master_id))->lpd}} PO No:</strong> {{(App\Helpers\Helper::IDwiseData('purchase_order_masters','id', $master->purchase_order_master_id))->lpd_po_no}}</li>--}}
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
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
                                                        <th class="text-uppercase text-center" style="font-size: x-small !important;">Sl No</th>
                                                        <th class="text-uppercase text-center" style="font-size: x-small !important;">Buyer</th>
                                                        <th class="text-uppercase text-center" style="font-size: x-small !important;">Trims Type</th>
                                                        <th class="text-uppercase text-center" style="font-size: x-small !important;">LPD PO</th>
                                                        <th class="text-uppercase text-center" style=" font-size: x-small !important;">Style No</th>
                                                        <th class="text-uppercase text-center" style="font-size: x-small !important;">Delivery Place</th>
                                                        <th class="text-uppercase text-center" style="font-size: x-small !important;">Description</th>
                                                        <th class="text-uppercase text-center" style="font-size: x-small !important;">Date</th>
                                                        <th class="text-uppercase text-center" style="font-size: x-small !important;">Challan No</th>
                                                        <th class="text-uppercase text-center" style="font-size: x-small !important;">Color</th>
                                                        <th class="text-uppercase text-center" style=" font-size: x-small !important;">Size</th>
                                                        <th class="text-uppercase text-center" style="font-size: x-small !important;">Unit</th>
                                                        <th class="text-uppercase text-center" style="font-size: x-small !important;">Qty</th>
                                                        <th class="text-uppercase text-center" style="font-size: x-small !important;">Remarks</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php($i = 1)
                                                    @foreach($reportData as $item)
                                                        <tr style="height: 3px !important;">
                                                            <td class="text-center" style="font-size: xx-small !important;"><P>{!! $i++ !!}</P></td>
                                                            <td style="font-size: xx-small !important;" class="text-left"><P>{!! $item->buyer_name!!}</P></td>
                                                            <td style="font-size: xx-small !important;" class="text-left"><P>{!! $item->trims_type!!}</P></td>
                                                            <td style="font-size: xx-small !important;" class="text-left"><P>LPD - {!! $item->lpd!!} - {!! $item->lpd_po_no!!}</P></td>
                                                            <td style="font-size: xx-small !important;" class="text-left"><P>{!! $item->style_no!!}</P></td>
                                                            <td style="font-size: xx-small !important;" class="text-left"><P>{!! $item->store_name!!}</P></td>
                                                            <td style="font-size: xx-small !important;" class="text-left"><P>{!! $item->item_description!!}</P></td>
                                                            <td style="font-size: xx-small !important;" class="text-center"><P>{{\Carbon\Carbon::parse($item->challan_date)->format('j-M-Y')}}</P></td>
                                                            <td style="font-size: xx-small !important;" class="text-center"><P>{!! $item->challan_no !!}</P></td>
                                                            <td style="font-size: xx-small !important;" class="text-center"><P>{!! $item->item_color !!}</P></td>
                                                            <td style="font-size: xx-small !important;" class="text-center"><P>{!! $item->item_size !!}</P></td>
                                                            <td style="font-size: xx-small !important;" class="text-center"><P>{!! $item->short_unit !!}</P></td>
                                                            <td style="font-size: xx-small !important;" class="text-right"><P>{!!  number_format($item->gross_delivered_quantity, 0, '.', ',') !!}</P></td>
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
                    </div>
                </div>
            </div>
        </div>
        <!-- /row -->
    </div>
@endsection
@section('pageScripts')
    <script>
        function refresh()
        {
            window.location.href = window.location.href.replace(/#.*$/, '');
        }

        function iconChange() {
            $('#iconChange').find('i').addClass('fa-edit');
        }
    </script>
@endsection()



