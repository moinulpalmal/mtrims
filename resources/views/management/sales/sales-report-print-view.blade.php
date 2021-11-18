@extends('layouts.management.management-master')

@section('title')
    Sales Report
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
            <h2>Sales <span>// Report Generate</span></h2>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{route('management.home')}}"><i class="fa fa-home"></i> Management</a>
                    </li>
                    <li>
                        <a href="{{route('management.sales.report.generate')}}"> Generate Sales Report</a>
                    </li>
                    <li>
                        <a href="#"> Print View</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- row -->
        <div class="add-nav">
            <div class="nav-heading">
                <h3>Order Status Report : <strong class="text-greensea"></strong></h3>
                <span class="controls pull-right">
                    <a href="{{route('management.sales.report.generate')}}" class="btn btn-ef btn-ef-1 btn-ef-1-default btn-ef-1a btn-rounded-20 mr-5" data-toggle="tooltip" title="Back"><i class="fa fa-times"></i></a>
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
                                                    Sales Report
                                                </h3>
                                                @if(!empty($from_date))
                                                    @if(!empty($to_date))
                                                        <ul class="list-unstyled text-default lt mb-20">
                                                            <li><strong>From Date:</strong> {{\Carbon\Carbon::parse($from_date)->format('j-M-Y')}}</li>
                                                            <li><strong>To Date:</strong> {{\Carbon\Carbon::parse($to_date)->format('j-M-Y')}}</li>
                                                        </ul>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </section>

                                <section class="tile tile-simple">
                                    <!-- tile body -->
                                    <div class="tile-body p-0">
                                        <div class="table-responsive">
                                            <table class="table table-hover table-bordered table-condensed">
                                                <thead>
                                                <tr style="height: 3px !important;">
                                                    <th class="text-uppercase text-center" style="font-size: xx-small !important;">PO No</th>
                                                    <th class="text-uppercase text-center" style="font-size: xx-small !important;">Item Name</th>
                                                    <th class="text-uppercase text-center" style="font-size: xx-small !important;">Buyer</th>
                                                    <th class="text-uppercase text-center" style="font-size: xx-small !important;">Style No</th>
                                                    <th class="text-uppercase text-center" style="font-size: xx-small !important;">Item Description</th>
                                                    <th class="text-uppercase text-center" style="font-size: xx-small !important;">Size</th>
                                                    <th class="text-uppercase text-center" style="font-size: xx-small !important;">Color</th>
                                                    <th class="text-uppercase text-center" style="font-size: xx-small !important;">Challan No</th>
                                                    <th class="text-uppercase text-center" style="font-size: xx-small !important;">Delivery Location</th>
                                                    <th class="text-uppercase text-center" style="font-size: xx-small !important;">Challan Date</th>
                                                    <th class="text-uppercase text-center" style="font-size: xx-small !important;">Unit</th>
                                                    <th class="text-uppercase text-center" style="font-size: xx-small !important;">Delivered Qty</th>
                                                    <th class="text-uppercase text-center" style="font-size: xx-small !important;">Unit Price</th>
                                                    <th class="text-uppercase text-center" style="font-size: xx-small !important;">Total Price</th>
                                                    <th class="text-uppercase text-center" style="font-size: xx-small !important;">Remarks</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php($i = 1)
                                                @foreach($sales as $item)
                                                    <tr style="height: 3px !important;">

                                                        <td style="font-size: xx-small !important;" class="text-center"><P>LPD-{!! $item->lpd !!}-{!! $item->lpd_po_no !!}</P></td>
                                                        <td style="font-size: xx-small !important;" class="text-center"><P>{{ $item->trims_types }}</P></td>
                                                        <td style="font-size: xx-small !important;" class="text-center"><P>{!! $item->buyer_name !!}</P></td>
                                                        <td style="font-size: xx-small !important;" class="text-center"><P>{!! $item->style_no !!}</P></td>
                                                        <td style="font-size: xx-small !important;" class="text-center"><P>{{ $item->item_description }}</P></td>
                                                        <td style="font-size: xx-small !important;" class="text-center"><P>{{ $item->item_size }}</P></td>
                                                        <td style="font-size: xx-small !important;" class="text-center"><P>{{ $item->item_color }}</P></td>
                                                        <td style="font-size: xx-small !important;" class="text-center"><P>{{ $item->challan_no }}</P></td>
                                                        <td style="font-size: xx-small !important;" class="text-center"><P>{{ $item->delivery_location_name }}</P></td>
                                                        <td style="font-size: xx-small !important; width: 5%" class="text-center"><P>{{ \Carbon\Carbon::parse($item->challan_date)->format('j-M-Y') }}</P></td>
                                                        <td style="font-size: xx-small !important;" class="text-center"><P>{{ $item->full_unit }}</P></td>
                                                        <td style="font-size: xx-small !important;" class="text-right"><P>{{ number_format($item->gross_delivered_quantity, 0, '.', ',') }}</P></td>
                                                        <td style="font-size: xx-small !important;" class="text-right">
                                                            <P>
                                                                @if($item->is_replacement_challan == true)
                                                                    {{ number_format(0, 2, '.', ',') }}
                                                                @else
                                                                {{ number_format($item->unit_price, 2, '.', ',') }}
                                                                    @endif
                                                            </P>
                                                        </td>
                                                        <td style="font-size: xx-small !important;" class="text-right">
                                                            <P>
                                                                @if($item->is_replacement_challan == true)
                                                                    {{ number_format(0, 2, '.', ',') }}
                                                                @else
                                                                    {{ number_format($item->total_price, 2, '.', ',') }}
                                                                @endif
                                                            </P>
                                                        </td>
                                                        <td style="font-size: xx-small !important;" class="text-left">@if($item->is_replacement_challan == true)<P class="text-danger"><strong>Replacement Challan;</strong></P>@endif<P>{!! $item->remarks !!}</P></td>
                                                    </tr>
                                                @endforeach
                                                <tr style="height: 3px !important;">
                                                    <td style="font-size: small !important;" class="text-right " colspan="11"><P><strong> Grand Total</strong></P></td>
                                                    <td style="font-size: small !important;" class="text-right " ><P><strong> {{ number_format($totalQty, 0, '.', ',') }}</strong></P></td>
                                                    <td style="font-size: small !important;" class="text-right "><P></P></td>
                                                    <td style="font-size: small !important;" class="text-right " ><P><strong> {{ number_format($grandTotalPrice, 2, '.', ',') }}</strong></P></td>
                                                    <td style="font-size: small !important;" class="text-right "><P></P></td>
                                                </tr>
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
                                            <h4 class="text-warning">Cost:</h4>
                                            <li class="ng-binding"><strong class="inline-block w-sm mb-7">Labour, Machine & O/H:</strong> $ {!! $total_machine_cost !!}</li>
                                            <li class="ng-binding"><strong class="inline-block w-sm mb-7">Raw Materials:</strong> $ {!! $total_material_cost !!}</li>
                                            <li class="ng-binding"><strong class="inline-block w-sm mb-7">Total Cost:</strong> $ {!! $total_cost !!}</li>
                                            <h4 class="text-blue">Revenue:</h4>
                                            <li class="ng-binding"><strong class="inline-block w-sm mb-7">Total Revenue:</strong> $ {!! $total_revenue !!}</li>
                                            --}}{{--                                            <li class="ng-binding"><strong class="inline-block w-sm mb-5">Total Refunded:</strong> $0.00</li>--}}{{--
                                            @if(($total_revenue - $total_cost) < 0 )
                                                <li><strong class="inline-block w-sm">Loss: </strong> <h3 class="inline-block text-danger ng-binding"> $ {!! ( $total_cost - $total_revenue) !!}</h3></li>

                                            @else
                                                <li><strong class="inline-block w-sm">Profit: </strong> <h3 class="inline-block text-success ng-binding"> $ {!! ($total_revenue - $total_cost) !!}</h3></li>

                                            @endif
                                        </ul>
                                    </div>
                                    <!-- /tile body -->

                                </section>
                                <!-- /tile -->
                            </div>
                            <!-- /col -->
                            <div class="col-md-12">
                                <section class="tile tile-simple">
                                    <div class="tile-footer">
                                        <p class="text-right" style="font-size: xx-small !important;">Report Generate From MTRIMS-Date:{{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>
                                    </div>
                                </section>
                            </div>
                        </div>--}}
                        <!-- /row -->
                    </div>
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



