@extends('layouts.lpd2.lpd-2-master')

@section('title')
    Proforma Invoice
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
            <h2>LPD-2 <span>// Local Purchase Division Section: 2</span></h2>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{route('lpd2.home')}}"><i class="fa fa-home"></i> LPD-2</a>
                    </li>
                    <li>
                        <a href="{{route('lpd2.purchase.order')}}"> Purchase Order</a>
                    </li>
                    <li>
                        <a href="{{route('lpd2.purchase.order.detail', ['id' => $purchaseOrder->id])}}"> PO No: {{$purchaseOrder->lpd_po_no}}</a>
                    </li>
                    <li>
                        <a href="#"> PI Print View</a>
                    </li>
                </ul>

            </div>
        </div>
        <!-- row -->
        <div class="add-nav">
            <div class="nav-heading">
                <h3>LPD - {{$purchaseOrder->lpd}} - PO No : <strong class="text-greensea">{{$purchaseOrder->lpd_po_no}}</strong></h3>
                <span class="controls pull-right">
                    <a href="{{route('lpd2.purchase.order.detail', ['id' => $purchaseOrder->id])}}" class="btn btn-ef btn-ef-1 btn-ef-1-default btn-ef-1a btn-rounded-20 mr-5" data-toggle="tooltip" title="Back"><i class="fa fa-times"></i></a>
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
                                            <div class="col-md-12 text-center">
                                                <h3 class="text-uppercase text-strong mb-10 custom-font">
                                                    Hamza Trims Limited
                                                </h3>
                                                <ul class="list-unstyled text-default lt mb-20">
                                                    <li><strong>Corporate Head Office:</strong> 9/Kha Confidence Center, Shahazadpur, Gulshan, Dhaka-1212</li>
                                                    <li><strong>Factory:</strong> Bangabandhu Road, Tongibari, Ashulia, Dhaka.</li>
                                                </ul>
                                            </div>
                                            <div class="col-md-12 text-center">
                                                <p class="text-uppercase text-strong mb-10 custom-font text-white bg-greensea">
                                                    PROFORMA INVOICE
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
                                            <div class="col-md-6 text-left">
                                                <p class="text-uppercase text-strong mb-10 custom-font">
                                                    To
                                                </p>
                                                <ul class="list-unstyled text-default lt mb-20">
                                                    <li><p>&nbsp;</p></li>
                                                    <li><p>&nbsp;</p></li>
                                                    <li><p>&nbsp;</p></li>
                                                    <li><strong>BUYER:</strong> {{$buyer->name}}</li>
                                                </ul>
                                            </div>
                                            <div class="col-md-6 text-right">
                                                <p class="text-uppercase text-strong mb-10 custom-font">
                                                    Purchase Order Info
                                                </p>
                                                <ul class="list-unstyled text-default lt mb-20">
                                                    <li><strong>PI No:</strong> HTL -  @foreach($uniqTrimsTypes as $item)
                                                            {{ $item->short_name }} -
                                                        @endforeach {{$purchaseOrder->job_no}}/{{$purchaseOrder->job_year}}</li>
                                                    <li><strong>PI Date:</strong> {{\Carbon\Carbon::parse($proformaInvoice->pi_date)->format('d/m/Y')}}</li>
                                                    <li><strong>Job: </strong> LPD-{{$purchaseOrder->lpd}}</li>
                                                    <li><strong>PO No: </strong> {{$purchaseOrder->lpd_po_no}} @if($purchaseOrder->pi_count > 1)- R - {{($purchaseOrder->pi_count)-1}}@endif</li>
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
                                                    <th class="text-uppercase text-center" style="font-size: x-small !important;">Sl No.</th>
                                                    <th class="text-uppercase text-center" style=" font-size: x-small !important;">Trims Type</th>
                                                    <th class="text-uppercase text-center" style=" font-size: x-small !important;">Style No</th>
                                                    <th class="text-uppercase text-center" style=" font-size: x-small !important;">Item Description</th>
                                                    <th class="text-uppercase text-center" style="font-size: x-small !important;">Color</th>
                                                    <th class="text-uppercase text-center" style="font-size: x-small !important;">Unit</th>
                                                    <th class="text-uppercase text-center" style="font-size: x-small !important;">Qty</th>
                                                    <th class="text-uppercase text-center" style="font-size: x-small !important;">Gross Qty</th>
                                                    <th class="text-uppercase text-center" style="font-size: x-small !important;">Unit Price</th>
                                                    <th class="text-uppercase text-center" style="font-size: x-small !important;">Add {{$addAmount}}%</th>
                                                    <th class="text-uppercase text-center" style="font-size: x-small !important;">Total Amount</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php($i = 1)
                                                @foreach($purchaseOrderDetails as $item)
                                                    <tr style="height: 3px !important;">
                                                        <td class="text-center" style="font-size: xx-small !important;"><P>{!! $i++ !!}</P></td>
                                                        <td style="font-size: xx-small !important;"><p> {{ (App\Helpers\Helper::IDwiseData('trims_types','id',$item->trims_type_id))->name }}</p></td>
                                                        <td class="text-left" style="font-size: xx-small !important;"><P>{{$item->style_no}}</P></td>
                                                        <td class="text-left" style="font-size: xx-small !important;"><P>{{$item->item_size}}; {{$item->item_description}}</P></td>
                                                        <td class="text-center" style="font-size: xx-small !important;"><P>{{$item->item_color}}</P></td>
                                                        <td style="font-size: xx-small !important;"><p> {{ (App\Helpers\Helper::IDwiseData('units','id',$item->item_unit_id))->short_unit }}</p></td>
                                                        <td style="font-size: xx-small !important;" class="text-right"><P>{!! $item->item_order_quantity !!}</P></td>
                                                        <td style="font-size: xx-small !important;" class="text-right"><P>{!! $item->gross_item_order_quantity !!}</P></td>
                                                        <td style="font-size: xx-small !important;" class="text-right"><P>$ {!! $item->unit_price_in_usd !!}</P></td>
                                                        <td style="font-size: xx-small !important;" class="text-right"><P>$ {!! $item->gross_unit_price !!}</P></td>
                                                        <td style="font-size: xx-small !important;" class="text-right"><P>$ {!! $item->total_price_in_usd !!}</P></td>
{{--                                                        <td style="font-size: xx-small !important;" class="text-right"><P>{!! $item->remarks !!}</P></td>--}}
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr style="height: 3px !important;">
                                                        <td colspan="9" class="text-right" style="font-size: small !important;"><P><b>Total:</b></P></td>
                                                        <td colspan="2" class="text-right" style="font-size: small !important;"><P><b>$ {{$orderPrice->total_items}}</b></P></td>
                                                    </tr>
                                                </tfoot>
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
                            <div class="col-md-12">
                                <!-- tile -->
                                <section class="tile tile-simple bg-tr-black lter">
                                    <!-- tile body -->
                                    <div class="tile-body p-0">
                                        <div class="table-responsive">
                                            <table class="table table-hover table-condensed">
                                                <tbody>
                                                <tr>
                                                    <td class="text-left" style="font-size: xx-small !important;">
                                                        <h5 class="text-uppercase"><b>Terms & Conditions</b></h5>
                                                        <p>
                                                            1. Payment by irrevocable letter of credit at 90 days sight in our favour.
                                                            <br>
                                                            2. Part shipment allowed.
                                                            <br>
                                                            3. Delivery: Beneficiary's factory to opener's factory.
                                                            <br>
                                                            4. Payment will be made US Dollar currency.
                                                        </p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left" style="font-size: xx-small !important;">
                                                        <h5 class="text-uppercase"><b>Banker</b></h5>
                                                        <p>
                                                            Premier Bank Limited
                                                            <br>
                                                            Gulshan Branch
                                                            <br>
                                                            78 Gulshan Avenue
                                                            <br>
                                                            Dhaka-1212, Bangladesh
                                                            <br>
                                                            Bank Bin No. 000000548
                                                            <br>
                                                            Beneficiary Bin No. 000101986-0403
                                                            <br>
                                                            H. S. Code: {{$proformaInvoice->hs_code}}
                                                        </p>
                                                    </td>
                                                </tr>
                                                </tbody>
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
                                                    <td class="text-left" style="font-size: xx-small !important;">
                                                        <p>For & on behalf of<br><b>Hamza Trims Limited</b></p>
                                                        <br>
                                                        <br>
                                                        <br>
                                                        <hr style="width: 30%; text-align:left;margin-left:0">
                                                        <P><strong>Authorized Signature</strong></P>
                                                    </td>
                                                    {{--<td class="text-center" style="font-size: xx-small !important;">
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
                                                    </td>--}}
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




