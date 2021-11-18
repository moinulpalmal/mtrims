@extends('layouts.lpd1.lpd-1-master')

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

        #items td, #items th {
            border: 1px solid black !important;
        }
    </style>
    <div class="page page-dashboard">
        <div class="pageheader ">
            <h2>LPD-1 <span>// Local Purchase Division Section: 1</span></h2>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{route('lpd1.home')}}"><i class="fa fa-home"></i> LPD-2</a>
                    </li>
                    <li>
                        <a href="{{route('lpd1.proforma-invoice.po-list')}}"> Pending PO List</a>
                    </li>
                    <li>
                        <a href="{{route('lpd1.proforma-invoice.po.pi-list',['id'=>$purchaseOrder->id])}}"> LPD-2 PO: {{$purchaseOrder->id}}</a>
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
                    <a href="{{route('lpd1.proforma-invoice.po.pi-list',['id'=>$purchaseOrder->id])}}" class="btn btn-ef btn-ef-1 btn-ef-1-default btn-ef-1a btn-rounded-20 mr-5" data-toggle="tooltip" title="Back"><i class="fa fa-times"></i></a>
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
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="border: solid #0b0b0b thick;">
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
                                                    <h4 class="text-uppercase text-strong mb-10 custom-font">
                                                        PROFORMA INVOICE
                                                    </h4>
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
                                                            @endforeach
                                                            {{$proformaInvoice->job_no}}/{{$proformaInvoice->job_year}}@if($proformaInvoice->is_revise == true) - R/{{($proformaInvoice->pi_revise_count)}}@endif</li><li><strong>PI Date:</strong> {{\Carbon\Carbon::parse($proformaInvoice->pi_date)->format('d/m/Y')}}</li>
                                                        <li><strong>Job: </strong> LPD-{{$proformaInvoice->lpd}}</li>
                                                        <li><strong>PO No: </strong> {{$purchaseOrder->lpd_po_no}}</li>
                                                        @if($proformaInvoice->is_follow_pi == true)
                                                            <li><strong>Flow: </strong> {{$proformaInvoice->pi_follow_count}}</li>
                                                        @endif
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
                                                <table class="table table-hover table-condensed" id="items">
                                                    <thead>
                                                    <tr style="height: 3px !important;">
                                                        <th class="text-uppercase text-center" style="font-size: xx-small !important;">Sl#</th>
                                                        <th class="text-uppercase text-center" style=" font-size: xx-small !important;">Item Name</th>
                                                        <th class="text-uppercase text-center" style=" font-size: xx-small !important;">Style No</th>
                                                        <th class="text-uppercase text-center" style=" font-size: xx-small !important;">Item Description</th>
                                                        <th class="text-uppercase text-center" style="font-size: xx-small !important;">Color</th>
                                                        <th class="text-uppercase text-center" style="font-size: xx-small !important;">Unit</th>
                                                        <th class="text-uppercase text-center" style="font-size: xx-small !important;">Qty</th>
                                                        <th class="text-uppercase text-center" style="font-size: xx-small !important;">Gross Qty</th>
                                                        <th class="text-uppercase text-center" style="font-size: xx-small !important;">U. Price</th>
                                                        <th class="text-uppercase text-center" style="font-size: xx-small !important;">Add %</th>
                                                        <th class="text-uppercase text-center" style="font-size: xx-small !important;">Gross U. Price</th>
                                                        <th class="text-uppercase text-center" style="font-size: xx-small !important;">Total Amount</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @php($i = 1)
                                                    @foreach($proformaInvoiceDetails as $item)
                                                        <tr style="height: 1px !important;">
                                                            <td class="text-center" style="font-size: xx-small !important;"><P>{!! $i++ !!}</P></td>
                                                            <td style="font-size: xx-small !important;"><p>{!! (\App\Helpers\Helper::IDwiseData('trims_types', 'id', (\App\Helpers\Helper::TwoIDwiseData('purchase_order_details', 'purchase_order_master_id', $item->purchase_order_master_id, 'item_count', $item->purchase_order_detail_id))->trims_type_id))->name !!}</p></td>
                                                            <td style="font-size: xx-small !important;"><P>{!! (\App\Helpers\Helper::TwoIDwiseData('purchase_order_details', 'purchase_order_master_id', $item->purchase_order_master_id, 'item_count', $item->purchase_order_detail_id))->style_no !!}</P></td>
                                                            <td style="font-size: xx-small !important;">
                                                                <p>
                                                                    {!! (\App\Helpers\Helper::TwoIDwiseData('purchase_order_details', 'purchase_order_master_id', $item->purchase_order_master_id, 'item_count', $item->purchase_order_detail_id))->item_size !!}
                                                                    ;
                                                                    {!! (\App\Helpers\Helper::TwoIDwiseData('purchase_order_details', 'purchase_order_master_id', $item->purchase_order_master_id, 'item_count', $item->purchase_order_detail_id))->item_description !!}
                                                                </p>
                                                            </td>
                                                            <td style="font-size: xx-small !important;"><P>{!! (\App\Helpers\Helper::TwoIDwiseData('purchase_order_details', 'purchase_order_master_id', $item->purchase_order_master_id, 'item_count', $item->purchase_order_detail_id))->item_color !!}</P></td>
                                                            <td style="font-size: xx-small !important;" class="text-right"><p>{!! (\App\Helpers\Helper::IDwiseData('units', 'id', (\App\Helpers\Helper::TwoIDwiseData('purchase_order_details', 'purchase_order_master_id', $item->purchase_order_master_id, 'item_count', $item->purchase_order_detail_id))->item_unit_id))->short_unit !!}</p></td>
                                                            <td style="font-size: xx-small !important;" class="text-right"><P>{!! number_format($item->item_order_quantity, 3, '.', ',') !!}</P></td>
                                                            <td style="font-size: xx-small !important;" class="text-right"><P>{!! number_format($item->gross_item_order_quantity, 3, '.', ',') !!}</P></td>
                                                            <td style="font-size: xx-small !important;" class="text-right"><P>$ {!! number_format($item->item_unit_price  , 5, '.', ',') !!}</P></td>
                                                            <td style="font-size: xx-small !important;" class="text-right"><P>{!! number_format($item->add_amount_percent  , 5, '.', ',') !!}</P></td>
                                                            <td style="font-size: xx-small !important;" class="text-right"><P>$ {!! number_format($item->gross_unit_price, 5, '.', ',') !!}</P></td>
                                                            <td style="font-size: xx-small !important;" class="text-right"><P>$ {!!  number_format($item->total_price, 2, '.', ',') !!}</P></td>
    {{--                                                        <td style="font-size: xx-small !important;" class="text-right"><P>{!! $item->remarks !!}</P></td>--}}
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr style="height: 3px !important;">
                                                            <td colspan="10" class="text-right" style="font-size: small !important;"><P><b>Total:</b></P></td>
                                                            <td colspan="2" class="text-right" style="font-size: small !important;">
                                                                <P>
                                                                    <b>$ {{ number_format($orderPrice->total_items, 2, '.', ',') }}</b>
                                                                </P>
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
                                                            <h5 class="text-uppercase"><b>In Words</b></h5>
                                                            <p>
                                                                {!! $proformaInvoice->total_pi_amount_words !!}
                                                            </p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-left" style="font-size: xx-small !important;">
                                                            <h5 class="text-uppercase"><b>Terms & Conditions</b></h5>
                                                            <p>
                                                                {!! $proformaInvoice->terms_conditions !!}
                                                            </p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-left" style="font-size: xx-small !important;">
                                                            <h5 class="text-uppercase"><b>Banker</b></h5>
                                                            <p>
                                                                {!! $proformaInvoice->bank_information !!}
                                                            </p>
                                                        </td>
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

        function GrandTotal()
        {
            var GrandTotal = 0;
            $('.Total').each(function(i,e){
                var Total = $(this).val() - 0;
                GrandTotal = GrandTotal + Total;
            });
            //document.getElementById("TotalInvoiceAmount").value = Number(GrandTotal);
            $('.GrandTotal').html(GrandTotal.toMoney(2,'.',','));
        };

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
        }


        function refresh()
        {
            window.location.href = window.location.href.replace(/#.*$/, '');
        }

        function iconChange() {

            $('#iconChange').find('i').addClass('fa-edit');

        }


    </script>
@endsection()




