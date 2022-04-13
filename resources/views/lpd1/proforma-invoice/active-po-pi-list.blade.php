@extends('layouts.lpd1.lpd-1-master')
@section('title')
    Proforma Invoice
@endsection

@section('content')
    <style type="text/css">
        th{
            background-color: #0689bd;
            color: white;
            /*font-size: x-small;
            height: 10px !important;*/
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
        textarea {
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            display: block; /*reset from inline*/
            width: 100%;
            margin: 0; /*remove defaults*/
            padding: 4px;
            background: #9bd8eb;
            border: 1px solid #333;
            overflow-y: auto; /*resets IE*/
            overflow-x: hidden;
            size: 100px !important;
            /*resize: none;*/
        }
    </style>
    <div class="page page-dashboard">
        <div class="pageheader">
            <h2>LPD-1 <span>// Local Purchase Division Section: 1</span></h2>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{route('lpd1.home')}}"><i class="fa fa-home"></i> LPD-1</a>
                    </li>
                    <li>
                        <a href="{{route('lpd1.proforma-invoice.po-list')}}"> Pending PO List</a>
                    </li>
                    <li>
                        <a href="{{route('lpd1.proforma-invoice.po.pi-list',['id'=>$purchaseOrder->id])}}"> LPD-1 PO: {{$purchaseOrder->id}}</a>
                    </li>
                    <li>
                        <a href="#"> Proforma Invoice List</a>
                    </li>
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
                                @if(Auth::user()->hasTaskPermission('lpdonecreatepi', Auth::user()->id))
                                    @if($purchaseOrder->pi_generation_activated == true)
                                        @if($newSinglePIApplicable  == true)
                                            <a title="Generate New Single PI" class ="myIcon icon-blue icon-ef-3 icon-ef-3b icon-color" data-toggle="modal" data-target="#PIGenerateModal" data-options="splash-2 splash-ef-12">
                                                <i class="fa fa-save"></i>
                                            </a>
                                        @endif
                                       {{-- @if($followPIApplicable  == true)
                                                <a title="Generate New Flow PI" class ="myIcon icon-warning icon-ef-3 icon-ef-3b icon-color" data-toggle="modal" data-target="#FollowPIGenerateModal" data-options="splash-2 splash-ef-12">
                                                    <i class="fa fa-save"></i>
                                                </a>
                                            @endif--}}
                                    @endif
                                @endif
                            </div>
                        </div>

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
                                    <li role="presentation" class="active"><a href="#piList" aria-controls="piList" role="tab" data-toggle="tab">PI List</a></li>
                                    </ul>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="piList">
                                        <div class="wrap-reset">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
                                                    <section class="tile">
                                                        <!-- tile header -->
                                                        <div class="tile-header dvd dvd-btm">
                                                            <h1 class="custom-font"><strong>Item</strong> List</h1>
                                                        </div>
                                                        <!-- /tile header -->
                                                        <!-- tile body -->
                                                        <div class="tile-body">
                                                            <div class="table-responsive">
                                                                <table class="table table-hover table-bordered table-condensed table-responsive" id="pi-table">
                                                                    <thead>
                                                                    <tr>
                                                                        <th class="text-center" style="font-size: small">Sl#</th>
                                                                        <th class="text-center" style="font-size: small">Job No</th>
                                                                        <th class="text-center" style="font-size: small">Job Year</th>
                                                                        <th class="text-center" style="font-size: small">PI Date</th>
                                                                        <th class="text-center" style="font-size: small">Terms & Conditions</th>
                                                                        <th class="text-center" style="font-size: small">Bank Information</th>
                                                                        {{--<th class="text-center">Total Amount (USD)</th>--}}
                                                                        <th class="text-center" style="font-size: small">Amount in Words</th>
                                                                        <th class="text-center" style="font-size: small">Remarks</th>
                                                                        <th class="text-center" style="font-size: small">Action</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    @php($i = 1)
                                                                    @foreach($proformaInvoices as $item)
                                                                        <tr>
                                                                            <td class="text-center" style="font-size: xx-small">{{$i++}}</td>
                                                                            <td class="text-center" style="font-size: xx-small">{{$item->job_no}}</td>
                                                                            <td class="text-center" style="font-size: xx-small">{{$item->job_year}}</td>
                                                                            <td class="text-center" style="font-size: xx-small">{{\Carbon\Carbon::parse($item->pi_date)->format('d/m/Y')}}</td>
                                                                            <td class="text-left" >{!! $item->terms_conditions !!}</td>
                                                                            <td class="text-left" >{!! $item->bank_information !!}</td>
                                                                            <td class="text-left" style="font-size: xx-small">{!! $item->total_pi_amount_words !!}</td>
                                                                            <td class="text-right" style="font-size: xx-small">{{$item->remarks}}</td>
                                                                            <td class="text-center">
                                                                                @if(Auth::user()->hasTaskPermission('lpdoneupdatepi', Auth::user()->id))
                                                                                    @if($item->is_follow_pi == true)
                                                                                        <a title="Update Flow PI" class ="btn btn-warning btn-xs" data-toggle="modal" data-target="#PIUpdateModalFollow{{$item->id}}" data-options="splash-2 splash-ef-12">
                                                                                            <i class="fa fa-edit"></i>
                                                                                        </a>
                                                                                        @else
                                                                                        <a title="Update PI" class ="btn btn-warning btn-xs" data-toggle="modal" data-target="#PIUpdateModal{{$item->id}}" data-options="splash-2 splash-ef-12">
                                                                                            <i class="fa fa-edit"></i>
                                                                                        </a>
                                                                                        @endif
                                                                                @endif
                                                                                <a target="_blank" href="{{route('lpd1.proforma-invoice.download', ['id' => $item->id])}}" title="Download PI" class ="btn btn-danger btn-xs">
                                                                                        <i class="fa fa-file-pdf-o"></i>
                                                                                </a>
                                                                                    @if(Auth::user()->hasTaskPermission('lpdoneapprovepi', Auth::user()->id))
                                                                                       @if($item->status == "I")
                                                                                            <a title="Delete" class="DeleteDetail btn btn-danger btn-xs" data-id = "{{ $item->id }}"><i class="fa fa-trash"></i></a>
                                                                                            <a title="Approve" class="ApproveDetail btn btn-success btn-xs" data-id = "{{ $item->id }}"><i class="fa fa-check"></i></a>
                                                                                        @endif
                                                                                        @if($item->status == "A")
{{--                                                                                               <a title="Delete" class="DeleteDetail btn btn-danger btn-xs" data-id = "{{ $item->id }}"><i class="fa fa-trash"></i></a>--}}
                                                                                            <a title="Dis-Approve" class="DisApproveDetail btn btn-danger btn-xs" data-id = "{{ $item->id }}"><i class="fa fa-times"></i></a>
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
    <!-- Single PI Generate Modal -->
    <div class="modal splash fade" id="PIGenerateModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form method="post" name="PIGenerateForm" id="PIGenerate" {{--onsubmit="return validateForm()"--}} enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-content">
                    <div class="modal-header bg-greensea">
                        <h3 class="modal-title custom-font text-white">New Proforma Invoice (Single)</h3>
                    </div>
                    <div class="modal-body">
                        <div class="row" style="padding: 0px 15px;">
                            <input type="hidden" id="MasterID" name="purchase_order_master_id" value="{{old('purchase_order_master_id', $purchaseOrder->id)}}">
                            <div class="col-md-6 no-padding">
                                <div class="form-group">
                                    <label for="PIAmount" class="control-label">PI Value (USD)</label>
                                    <input type="number" class="form-control" name="total_pi_amount" id="PIAmount" readonly required value="{{ old('total_pi_amount', number_format($orderQty->total_items, 2, '.', '') ) }}">
                                </div>
                            </div>
                            <div class="col-md-6 no-padding">
                                <div class="form-group">
                                    <label for="PI_Date" class="control-label">PI Date</label>
                                    <input type="date" class="form-control" name="pi_date" id="PI_Date" required >
                                </div>
                            </div>
                            {{--<div class="col-md-4 no-padding">
                                <div class="form-group">
                                    <label for="ToPerson" class="control-label">H. S. Code</label>
                                    <input type="text" class="form-control" name="hs_code" id="ToPerson" required>
                                </div>
                            </div>--}}
                        </div>
                        <div class="row" style="padding: 0px 15px;">
                            <div class="col-md-12 no-padding">
                                <div class="form-group">
                                    <label for="AmountInWords" class="control-label">Amount in Words</label>
                                    <input type="text" class="form-control" name="amount_in_words" id="AmountInWords" required onkeypress="return /^[a-zA-Z ]+$/.test(event.key)">

                                   {{-- <input type="text" name="field" maxlength="8"
                                           title="Only Letters"
                                           value="Type Letters Only"
                                           onkeydown="return alphaOnly(event);"
                                           onblur="if (this.value == '') {this.value = 'Type Letters Only';}"
                                           onfocus="if (this.value == 'Type Letters Only') {this.value = '';}"/>--}}
                                </div>
                            </div>
                        </div>
                        <div class="row" style="padding: 0px 15px;">
                            <div class="col-md-12 no-padding">
                                <div class="form-group">
                                    <label for="BankInformation" class="control-label">Bank Information</label>
                                    <textarea size="50" class="form-control" name="bank_information" id="BankInformation"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="padding: 0px 15px;">
                            <div class="col-md-12 no-padding">
                                <div class="form-group">
                                    <label for="TermsCondition" class="control-label">Term & Conditions</label>
                                    <textarea size="50" class="form-control" name="terms_conditions" id="TermsCondition"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="padding: 0px 15px;">
                            <div class="col-md-12 no-padding">
                                <div class="form-group">
                                    <label for="PIRemarks" class="control-label">Remarks</label>
                                    {{--                                    <textarea size="5" class="form-control" name="pi_remarks" id="PIRemarks" ></textarea>--}}
                                    <input type="text" class="form-control" name="pi_remarks" id="PIRemarks">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a><button class="btn btn-success btn-ef btn-ef-3 btn-ef-3c" type="submit"><i class="fa fa-arrow-right"></i> Generate</button></a>
                        <button class="btn btn-lightred btn-ef btn-ef-4 btn-ef-4c" data-dismiss="modal"><i class="fa fa-arrow-left"></i> Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- PO Update Approval Modal -->

    <!-- Follow PI Generate Modal -->
   {{-- <div class="modal splash fade" id="FollowPIGenerateModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">

            <form method="post" name="FollowPIGenerateForm" id="FollowPIGenerate" --}}{{--onsubmit="return validateForm()"--}}{{-- enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-content">
                    <div class="modal-header bg-greensea">
                        <h3 class="modal-title custom-font text-white">New Proforma Invoice (Flow)</h3>
                    </div>
                    <div class="modal-body">
                        <div class="row" style="padding: 0px 15px;">
                            <input type="hidden" id="MasterID" name="purchase_order_master_id" value="{{old('purchase_order_master_id', $purchaseOrder->id)}}">
                            <div class="col-md-6 no-padding">
                                <div class="form-group">
                                    <label for="FollowPIAmount" class="control-label">PI Value (USD)</label>
                                    <input type="number" class="form-control FollowPIAmount" name="total_pi_amount" id="FollowPIAmount" readonly >
                                </div>
                            </div>
                            <div class="col-md-6 no-padding">
                                <div class="form-group">
                                    <label for="PI_Date" class="control-label">PI Date</label>
                                    <input type="date" class="form-control" name="pi_date" id="Follow_PI_Date" required >
                                </div>
                            </div>
                        </div>
                        <div class="row" style="padding: 0px 15px;">
                            <div class="col-md-12 no-padding">
                                <div class="form-group">
                                    <label for="AmountInWords" class="control-label">Amount in Words</label>
                                    <input type="text" class="form-control" name="amount_in_words" id="AmountInWords" required onkeypress="return /^[a-zA-Z ]+$/.test(event.key)">
                                </div>
                            </div>
                        </div>
                        <div class="row" style="padding: 0px 15px;">
                            <div class="col-md-12 no-padding">
                                <div class="form-group">
                                    <label for="FollowBankInformation" class="control-label">Bank Information</label>
                                    <textarea size="50" class="form-control" name="bank_information" id="FollowBankInformation"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="padding: 0px 15px;">
                            <div class="col-md-12 no-padding">
                                <div class="form-group">
                                    <label for="FollowTermsCondition" class="control-label">Term & Conditions</label>
                                    <textarea size="50" class="form-control" name="terms_conditions" id="FollowTermsCondition"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="padding: 0px 15px;">
                            <div class="col-md-12 no-padding">
                                <div class="form-group">
                                    <label for="FollowPIRemarks" class="control-label">Remarks</label>
                                    --}}{{--                                    <textarea size="5" class="form-control" name="pi_remarks" id="PIRemarks" ></textarea>--}}{{--
                                    <input type="text" class="form-control" name="pi_remarks" id="FollowPIRemarks">
                                </div>
                            </div>
                        </div>
                        <div class="row no-padding" style="padding: 0px 15px;">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
                                <!-- tile -->
                                <section class="tile no-padding">
                                    <!-- tile header -->
                                    <div class="tile-header dvd dvd-btm">
                                        <h1 class="custom-font"><strong>Item List</strong></h1>
                                    </div>
                                    <!-- /tile header -->
                                    <!-- tile body -->
                                    <div class="tile-body no-padding">
                                        <table id="myTableFollow" class="table table-bordered table-hover table-condensed">
                                            <thead>
                                            <tr>
                                                <th>Style No</th>
                                                <th>Trims Type</th>
                                                <th>Description</th>
                                                <th>Color</th>
                                                <th>Unit</th>
                                                <th>PO Qty</th>
                                                <th>Pending Qty</th>
                                                <th>PI Qty</th>
                                                --}}{{--<th>Price</th>--}}{{--
                                                --}}{{--<th>Remarks</th>--}}{{--
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php($i = 1)
                                            @foreach($purchaseOrderDetails as $item)
                                                @if((\App\Helpers\PIHelper::getPIItemPendingQuantity($item->purchase_order_master_id, $item->item_count) != 0))
                                                <tr>
                                                    <td>
                                                        <input type="hidden" class="form-control" name="purchase_order_detail_id[]" value="{{ $item->item_count }}">
                                                        <input type="hidden" class="form-control gross" name="gross_calculation_amount[]" value="{{ $item->gross_calculation_amount }}">
                                                        <input type="hidden" class="form-control GrossUnitPrice" name="gross_unit_price[]" value="{{ $item->gross_unit_price }}">
                                                        <input type="hidden" class="form-control PIFollowTotal" name="total_price[]">
                                                        <input type="text" class="form-control" name="style_no[]" readonly required value="{{ $item->style_no }}">
                                                    </td>
                                                    <td><input type="text" class="form-control" name="trims_type_name[]" readonly required value="{{(App\Helpers\Helper::IDwiseData('trims_types','id',$item->trims_type_id))->name}}"></td>
                                                    <td><input type="text" class="form-control" name="item_details[]" readonly required="" value="{{$item->item_size}}; {{ $item->item_description}}"></td>
                                                    <td><input type="text" class="form-control" name="item_color[]" readonly required="" value="{{ $item->item_color}}"></td>
                                                    <td><input type="text" class="form-control" name="item_unit[]" readonly required="" value="{{ (App\Helpers\Helper::IDwiseData('units','id',$item->item_unit_id))->short_unit }}"></td>
                                                    <td><input type="number" class="form-control" name="po_quantity[]" readonly required="" value="{{ $item->item_order_quantity}}"></td>
                                                    <td><input type="number" class="form-control" name="pending_quantity[]" readonly required step="any" value="{{ \App\Helpers\PIHelper::getPIItemPendingQuantity($item->purchase_order_master_id, $item->item_count)}}"></td>

                                                    <td><input type="number" class="form-control qty" name="follow_pi_quantity[]" required @if(\App\Helpers\PIHelper::getPIItemPendingQuantity($item->purchase_order_master_id, $item->item_count) == 0) readonly @endif step="any" value="0" max="{{ \App\Helpers\PIHelper::getPIItemPendingQuantity($item->purchase_order_master_id, $item->item_count)}}"></td>
--}}{{--                                                    <td><input type="text" class="form-control"  name="pi_item_remarks[]" @if(\App\Helpers\PIHelper::getPIItemPendingQuantity($item->purchase_order_master_id, $item->item_count) == 0) readonly @endif></td>--}}{{--

                                                </tr>
                                                @endif
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /tile body -->
                                </section>
                                <!-- /tile -->
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a><button class="btn btn-success btn-ef btn-ef-3 btn-ef-3c" type="submit"><i class="fa fa-arrow-right"></i> Generate</button></a>
                        <button class="btn btn-lightred btn-ef btn-ef-4 btn-ef-4c" data-dismiss="modal"><i class="fa fa-arrow-left"></i> Cancel</button>
                    </div>
                </div>
            </form>


        </div>
    </div>--}}
    <!-- PO Update Approval Modal -->
    @endsection

<!-- PI Update Modal -->
@foreach($proformaInvoices as $itemPI)
    @if($itemPI->is_follow_pi)
        <div class="modal splash fade" id="PIUpdateModalFollow{{$itemPI->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form method="post" name="FollowPIUpdateForm{{$itemPI->id}}" id="FollowPIUpdate{{$itemPI->id}}" {{--onsubmit="return validateForm()"--}} enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-content">
                        <div class="modal-header bg-blue">
                            <h3 class="modal-title custom-font text-white">Update Current Proforma Invoice</h3>
                        </div>
                        <div class="modal-body">
                            <div class="row" style="padding: 0px 15px;">
                                <input type="hidden" id="MasterID" name="purchase_order_master_id" value="{{old('purchase_order_master_id', $purchaseOrder->id)}}">
                                <input type="hidden" id="FollowPIMasterID" name="id" value="{{old('id', $itemPI->id)}}">
                                <div class="col-md-6 no-padding">
                                    <div class="form-group">
                                        <label for="PIFollowAmountUpdate{{$itemPI->id}}" class="control-label">PI Value (USD)</label>
                                        <input type="number" class="form-control PIFollowAmountUpdate{{$itemPI->id}}" name="total_pi_amount" id="PIFollowAmountUpdate{{$itemPI->id}}" step="any" readonly required value="{{\App\Helpers\PIHelper::getTotalPIValue($itemPI->id)}}">
                                    </div>
                                </div>
                                <div class="col-md-6 no-padding">
                                    <div class="form-group">
                                        <label for="PI_Date" class="control-label">PI Date</label>
                                        <input type="date" class="form-control" name="pi_date" id="PI_Date" required value="{{ old('pi_date', $itemPI->pi_date) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="padding: 0px 15px;">
                                <div class="col-md-12 no-padding">
                                    <div class="form-group">
                                        <label for="AmountInWords" class="control-label">Amount in Words</label>
                                        <input type="text" class="form-control" name="amount_in_words" id="AmountInWords" onkeypress="return /^[a-zA-Z ]+$/.test(event.key)" required value="{{ old('amount_in_words', $itemPI->total_pi_amount_words) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="padding: 0px 15px;">
                                <div class="col-md-12 no-padding">
                                    <div class="form-group">
                                        <label for="FollowBankInformationUpdate{{$itemPI->id}}" class="control-label">Bank Information</label>
                                        <textarea size="20" class="form-control" name="bank_information" id="FollowBankInformationUpdate{{$itemPI->id}}">
                                            {!!  $itemPI->bank_information !!}
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="padding: 0px 15px;">
                                <div class="col-md-12 no-padding">
                                    <div class="form-group">
                                        <label for="FollowTermsConditionUpdate{{$itemPI->id}}" class="control-label">Term & Conditions</label>
                                        <textarea size="20" class="form-control" name="terms_conditions" id="FollowTermsConditionUpdate{{$itemPI->id}}">
                                            {!!  $itemPI->terms_conditions !!}
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="padding: 0px 15px;">
                                <div class="col-md-12 no-padding">
                                    <div class="form-group">
                                        <label for="FollowPIRemarks" class="control-label">Remarks</label>
                                        {{--                                    <textarea size="5" class="form-control" name="pi_remarks" id="PIRemarks" ></textarea>--}}
                                        <input type="text" class="form-control" name="pi_remarks" id="FollowPIRemarks" value="{{ old('pi_remarks', $itemPI->remarks) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row no-padding" style="padding: 0px 15px;">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
                                    <!-- tile -->
                                    <section class="tile no-padding">
                                        <!-- tile header -->
                                        <div class="tile-header dvd dvd-btm">
                                            <h1 class="custom-font"><strong>Item List</strong></h1>
                                        </div>
                                        <!-- /tile header -->
                                        <!-- tile body -->
                                        <div class="tile-body no-padding">
                                            <table id="myTableFollowUpdate{{$itemPI->id}}" class="table table-bordered table-hover table-condensed">
                                                <thead>
                                                <tr>
                                                    <th>Style No</th>
                                                    <th>Trims Type</th>
                                                    <th>Description</th>
                                                    <th>Color</th>
                                                    <th>Unit</th>
                                                    <th>PO Qty</th>
                                                    <th>Pending Qty</th>
                                                    <th>PI Qty</th>
{{--                                                    <th>Remarks</th>--}}
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php($i = 1)
                                                @foreach($purchaseOrderDetails as $item)
                                                        <tr>
                                                            <td>
                                                                <input type="hidden" class="form-control" name="purchase_order_detail_id[]" value="{{ $item->item_count }}">
                                                                <input type="hidden" class="form-control gross" name="gross_calculation_amount[]" value="{{ $item->gross_calculation_amount }}">
                                                                <input type="hidden" class="form-control GrossUnitPrice" name="gross_unit_price[]" value="{{ $item->gross_unit_price }}">
                                                                <input type="hidden" step="any" readonly value="{{\App\Helpers\PIHelper::getPIItemCurrentTotalPrice($itemPI->id, $item->item_count)}}" class="form-control PIFollowTotalUpdate{{$itemPI->id}}" name="total_price[]">
                                                                <input type="text" class="form-control" name="style_no[]" readonly required value="{{ $item->style_no }}">
                                                            </td>
                                                            <td><input type="text" class="form-control" name="trims_type_name[]" readonly required value="{{(App\Helpers\Helper::IDwiseData('trims_types','id',$item->trims_type_id))->name}}"></td>
                                                            <td><input type="text" class="form-control" name="item_details[]" readonly required="" value="{{$item->item_size}}; {{ $item->item_description}}"></td>
                                                            <td><input type="text" class="form-control" name="item_color[]" readonly required="" value="{{ $item->item_color}}"></td>
                                                            <td><input type="text" class="form-control" name="item_unit[]" readonly required="" value="{{ (App\Helpers\Helper::IDwiseData('units','id',$item->item_unit_id))->short_unit }}"></td>
                                                            <td><input type="number" class="form-control" name="po_quantity[]" readonly required="" value="{{ $item->item_order_quantity}}"></td>
                                                            <td><input type="number" class="form-control" name="pending_quantity[]" readonly required step="any" value="{{ \App\Helpers\PIHelper::getPIItemPendingQuantity($item->purchase_order_master_id, $item->item_count)}}"></td>
                                                            @if((\App\Helpers\PIHelper::getPIItemPendingQuantity($item->purchase_order_master_id, $item->item_count)) + (\App\Helpers\PIHelper::getPIItemCurrentQuantity($itemPI->id, $item->item_count)) <= 0)
                                                                <td><input type="number" class="form-control qty" name="follow_pi_quantity[]" required step="any" value="{{old('follow_pi_quantity[]', \App\Helpers\PIHelper::getPIItemCurrentQuantity($itemPI->id, $item->item_count)) }}" max="0"></td>
                                                            @else
                                                                <td><input type="number" class="form-control qty" name="follow_pi_quantity[]" required step="any" value="{{old('follow_pi_quantity[]', \App\Helpers\PIHelper::getPIItemCurrentQuantity($itemPI->id, $item->item_count)) }}" max="{{ (\App\Helpers\PIHelper::getPIItemPendingQuantity($item->purchase_order_master_id, $item->item_count)) + (\App\Helpers\PIHelper::getPIItemCurrentQuantity($itemPI->id, $item->item_count))  }}"></td>
                                                            @endif
                                                        </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /tile body -->
                                    </section>
                                    <!-- /tile -->
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
    @else
        <div class="modal splash fade" id="PIUpdateModal{{$itemPI->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form method="post" name="PIUpdateFormSingle{{$itemPI->id}}" id="PIUpdate{{$itemPI->id}}" {{--onsubmit="return validateForm()"--}} enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-content">
                        <div class="modal-header bg-blue">
                            <h3 class="modal-title custom-font text-white">Update Current Proforma Invoice</h3>
                        </div>
                        <div class="modal-body">
                            <div class="row" style="padding: 0px 15px;">
                                <input type="hidden" id="MasterID" name="purchase_order_master_id" value="{{old('purchase_order_master_id', $purchaseOrder->id)}}">
                                <input type="hidden" id="PIMasterID" name="id" value="{{old('id', $itemPI->id)}}">

                                <div class="col-md-6 no-padding">
                                    <div class="form-group">
                                        <label for="PIAmount" class="control-label">PI Value (USD)</label>
                                        <input type="number" class="form-control" name="total_pi_amount" id="PIAmount" readonly required value="{{ old('total_pi_amount', $orderQty->total_items) }}">
                                    </div>
                                </div>
                                <div class="col-md-6 no-padding">
                                    <div class="form-group">
                                        <label for="PI_Date" class="control-label">PI Date</label>
                                        <input type="date" class="form-control" name="pi_date" id="PI_Date" required value="{{ old('pi_date', $itemPI->pi_date) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="padding: 0px 15px;">
                                <div class="col-md-12 no-padding">
                                    <div class="form-group">
                                        <label for="AmountInWords" class="control-label">Amount in Words</label>
                                        <input type="text" class="form-control" name="amount_in_words" id="AmountInWords" onkeypress="return /^[a-zA-Z ]+$/.test(event.key)" required value="{{ old('amount_in_words', $itemPI->total_pi_amount_words) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="padding: 0px 15px;">
                                <div class="col-md-12 no-padding">
                                    <div class="form-group">
                                        <label for="BankInformationUpdate" class="control-label">Bank Information</label>
                                        <textarea size="20" class="form-control" name="bank_information" id="BankInformationUpdate">
                                            {!! $itemPI->bank_information !!}
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="padding: 0px 15px;">
                                <div class="col-md-12 no-padding">
                                    <div class="form-group">
                                        <label for="TermsConditionUpdate" class="control-label">Term & Conditions</label>
                                        <textarea size="20" class="form-control" name="terms_conditions" id="TermsConditionUpdate">
                                            {!! $itemPI->terms_conditions !!}
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="padding: 0px 15px;">
                                <div class="col-md-12 no-padding">
                                    <div class="form-group">
                                        <label for="PIRemarks" class="control-label">Remarks</label>
                                        {{--                                    <textarea size="5" class="form-control" name="pi_remarks" id="PIRemarks" ></textarea>--}}
                                        <input type="text" class="form-control" name="pi_remarks" id="PIRemarks" value="{{ old('pi_remarks', $itemPI->remarks) }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a><button class="btn btn-success btn-ef btn-ef-3 btn-ef-3c" type="submit"><i class="fa fa-arrow-right"></i> Update Single</button></a>
                            <button class="btn btn-lightred btn-ef btn-ef-4 btn-ef-4c" data-dismiss="modal"><i class="fa fa-arrow-left"></i> Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @endif
@endforeach
<!-- PI Update Approval Modal -->

@section('pageScripts')
    <script>
        $(window).load(function(){
            $('#advanced-usage').DataTable({

            });

           /* $(document).ready(function () {
                $('#BankInformation').ckeditor();
            });*/
        });

        $('#myTableFollow').delegate('.qty, .gross, .GrossUnitPrice','keyup',function(){
            //console.log("hit");
            //var follow_pi_quantity = document.getElementById('FollowPIGenerate').elements["follow_pi_quantity[]"];
            //var gross_unit_price = document.getElementById('FollowPIGenerate').elements["gross_unit_price[]"];
            //var gross_calculation_amount = document.getElementById('FollowPIGenerate').elements["gross_calculation_amount[]"];


            var tr = $(this).parent().parent();
            var qty = parseFloat(tr.find('.qty').val()).toFixed(5);
            var gross_qty_factory = parseFloat(tr.find('.gross').val()).toFixed(5);
            var g_qty = parseFloat(qty/gross_qty_factory).toFixed(3);
            var g_unit_price = parseFloat(tr.find('.GrossUnitPrice').val()).toFixed(5);
            var total = parseFloat(g_qty*g_unit_price).toFixed(5);
            tr.find('.PIFollowTotal').val(parseFloat(total).toFixed(2));

            GrandTotal();

        });

        function GrandTotal()
        {
            var GrandTotal = 0;
            $('.PIFollowTotal').each(function(i,e){
                var Total = $(this).val() - 0;
                GrandTotal = GrandTotal + Total;
            });
            //document.getElementById("TotalInvoiceAmount").value = Number(GrandTotal);
            //$('.GrandTotal').html(GrandTotal.toMoney(2,'.',','));
            document.getElementById("FollowPIAmount").value = parseFloat(GrandTotal).toFixed(2);
        }




        $('#pi-table').on('click',".ApproveDetail", function(){
            var button = $(this);
            var id = button.attr("data-id");
            var url = '{{ route('lpd1.proforma-invoice.approve') }}';
            swal({
                title: 'Are you sure?',
                text: 'This proforma invoice will be approved permanently!',
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
        $('#pi-table').on('click',".DeleteDetail", function(){
            var button = $(this);
            var id = button.attr("data-id");
            var url = '{{ route('lpd1.proforma-invoice.delete') }}';
            swal({
                title: 'Are you sure?',
                text: 'This proforma invoice will be removed permanently!',
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
        $('#pi-table').on('click',".DisApproveDetail", function(){
            var button = $(this);
            var id = button.attr("data-id");
            var url = '{{ route('lpd1.proforma-invoice.reject') }}';
            swal({
                title: 'Are you sure?',
                text: 'This proforma invoice will be rejected!',
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

        $(function(){
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
            });
            $('#PIGenerate').submit(function(e){
                e.preventDefault();
                var data = $(this).serialize();
                var masterId = $('#MasterID').val();
                // hs_code = document.forms["PIGenerateForm"]["hs_code"].value;
                var terms_conditions = document.forms["PIGenerateForm"]["terms_conditions"].value;
                var bank_information = document.forms["PIGenerateForm"]["bank_information"].value;
                var amount_in_words = document.forms["PIGenerateForm"]["amount_in_words"].value;

                /*if(hs_code == ""){
                    swal({
                        title: "HS Code Required!",
                        icon: "warning",
                        button: "Ok!",
                    });
                    return false;
                }
                else*/
                if(terms_conditions == ""){
                    swal({
                        title: "Terms & Condition Required!",
                        icon: "warning",
                        button: "Ok!",
                    });
                    return false;
                }
                else if(amount_in_words == ""){
                    swal({
                        title: "Amounts in Words Required!",
                        icon: "warning",
                        button: "Ok!",
                    });
                    return false;
                }
                else if(bank_information == ""){
                    swal({
                        title: "Bank Information Required!",
                        icon: "warning",
                        button: "Ok!",
                    });
                    return false;
                }
                else{
                    var url = '{{ route('lpd1.proforma-invoice.po.pi-single.save') }}';
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
            $('#FollowPIGenerate').submit(function(e){
                e.preventDefault();
                var data = $(this).serialize();
                var masterId = $('#MasterID').val();
                var amount_in_words = document.forms["FollowPIGenerateForm"]["amount_in_words"].value;
                var terms_conditions = document.forms["FollowPIGenerateForm"]["terms_conditions"].value;
                var bank_information = document.forms["FollowPIGenerateForm"]["bank_information"].value;
                //var pi_quantity = document.forms["FollowPIGenerateForm"]["pi_quantity[]"].value;
                var flow_pi_count = document.getElementById('FollowPIGenerate').elements["follow_pi_quantity[]"];
               // var flow_pi_count = document.forms["FollowPIGenerateForm"].getElementsByName('follow_pi_quantity[]');
                var check_pi_qty = 0;
                //var length = parseInt(flow_pi_count.length);
                for (var i = 0; i < flow_pi_count.length; i++) {
                    var a = parseFloat(flow_pi_count[i].value).toFixed(5);
                    //console.log(a);
                    if(a <= 0.00000){
                        check_pi_qty = parseInt(check_pi_qty)  + parseInt("1");
                    }
                    else{
                        check_pi_qty = parseInt(check_pi_qty)
                    }

                }
                //return;

                if(terms_conditions == ""){
                    swal({
                        title: "Terms & Condition Required!",
                        icon: "warning",
                        button: "Ok!",
                    });
                    return false;
                }
                else if(bank_information == ""){
                    swal({
                        title: "Bank Information Required!",
                        icon: "warning",
                        button: "Ok!",
                    });
                    return false;
                }
                else if(amount_in_words == ""){
                    swal({
                        title: "Amount in Words Required!",
                        icon: "warning",
                        button: "Ok!",
                    });
                    return false;
                }
                else if(parseInt(check_pi_qty) >= parseInt(flow_pi_count.length)){
                    swal({
                        title: "Check PI Quantities!",
                        icon: "warning",
                        button: "Ok!",
                    });
                    return false;
                }
                else{
                    var url = '{{ route('lpd1.proforma-invoice.po.pi-follow.save') }}';
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

        function GrandTotalUpdate(id)
        {
            var GrandTotal = 0;
            $('.PIFollowTotalUpdate'+id+'').each(function(i,e){
                var Total = $(this).val() - 0;
                GrandTotal = GrandTotal + Total;
            });
            document.getElementById("PIFollowAmountUpdate"+id).value = parseFloat(GrandTotal).toFixed(2);
        }

        @foreach($proformaInvoices as $itemPI)
        @if($itemPI->is_follow_pi)
        $('#myTableFollowUpdate{{$itemPI->id}}').delegate('.qty, .gross, .GrossUnitPrice','keyup',function(){

            var tr = $(this).parent().parent();
            var qty = parseFloat(tr.find('.qty').val()).toFixed(5);
            var gross_qty_factory = parseFloat(tr.find('.gross').val()).toFixed(5);
            var g_qty = parseFloat(qty/gross_qty_factory).toFixed(3);
            var g_unit_price = parseFloat(tr.find('.GrossUnitPrice').val()).toFixed(5);
            var total = parseFloat(g_qty*g_unit_price).toFixed(5);
            tr.find('.PIFollowTotalUpdate{{$itemPI->id}}').val(parseFloat(total).toFixed(2));
            GrandTotalUpdate({{$itemPI->id}});

        });

        $(function(){
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
            });
            $('#FollowPIUpdate{{$itemPI->id}}').submit(function(e){

                e.preventDefault();
                var data = $(this).serialize();
                var masterId = $('#MasterID').val();
                // hs_code = document.forms["PIGenerateForm"]["hs_code"].value;
                var terms_conditions = document.forms["FollowPIUpdateForm{{$itemPI->id}}"]["terms_conditions"].value;
                var bank_information = document.forms["FollowPIUpdateForm{{$itemPI->id}}"]["bank_information"].value;
                var amount_in_words = document.forms["FollowPIUpdateForm{{$itemPI->id}}"]["amount_in_words"].value;
                var flow_pi_count = document.getElementById('FollowPIUpdate{{$itemPI->id}}').elements["follow_pi_quantity[]"];
                // var flow_pi_count = document.forms["FollowPIGenerateForm"].getElementsByName('follow_pi_quantity[]');
                var check_pi_qty = 0;
                //var length = parseInt(flow_pi_count.length);
                for (var i = 0; i < flow_pi_count.length; i++) {
                    var a = parseFloat(flow_pi_count[i].value).toFixed(5);
                    //console.log(a);
                    if(a <= 0.00000){
                        check_pi_qty = parseInt(check_pi_qty)  + parseInt("1");
                    }
                    else{
                        check_pi_qty = parseInt(check_pi_qty)
                    }

                }

                //return;
                if(terms_conditions == ""){
                    swal({
                        title: "Terms & Condition Required!",
                        icon: "warning",
                        button: "Ok!",
                    });
                    return false;
                }
                else if(amount_in_words == ""){
                    swal({
                        title: "Amounts in Words Required!",
                        icon: "warning",
                        button: "Ok!",
                    });
                    return false;
                }
                else if(bank_information == ""){
                    swal({
                        title: "Bank Information Required!",
                        icon: "warning",
                        button: "Ok!",
                    });
                    return false;
                }
                else if(parseInt(check_pi_qty) >= parseInt(flow_pi_count.length)){
                    swal({
                        title: "Check PI Quantities!",
                        icon: "warning",
                        button: "Ok!",
                    });
                    return false;
                }
                else{
                    var url = '{{ route('lpd1.proforma-invoice.po.pi-follow.update') }}';
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
            @else

        $(function(){
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
            });
            $('#PIUpdate{{$itemPI->id}}').submit(function(e){

                e.preventDefault();
                var data = $(this).serialize();
                var masterId = $('#MasterID').val();
                // hs_code = document.forms["PIGenerateForm"]["hs_code"].value;
                var terms_conditions = document.forms["PIUpdateFormSingle{{$itemPI->id}}"]["terms_conditions"].value;
                var bank_information = document.forms["PIUpdateFormSingle{{$itemPI->id}}"]["bank_information"].value;
                var amount_in_words = document.forms["PIUpdateFormSingle{{$itemPI->id}}"]["amount_in_words"].value;
                if(terms_conditions == ""){
                    swal({
                        title: "Terms & Condition Required!",
                        icon: "warning",
                        button: "Ok!",
                    });
                    return false;
                }
                else if(amount_in_words == ""){
                    swal({
                        title: "Amounts in Words Required!",
                        icon: "warning",
                        button: "Ok!",
                    });
                    return false;
                }
                else if(bank_information == ""){
                    swal({
                        title: "Bank Information Required!",
                        icon: "warning",
                        button: "Ok!",
                    });
                    return false;
                }
                else{
                    var url = '{{ route('lpd1.proforma-invoice.po.pi-single.update') }}';
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
            @endif
        @endforeach


        function refresh()
        {
            window.location.href = window.location.href.replace(/#.*$/, '');
        }

        function iconChange() {

            $('#iconChange').find('i').addClass('fa-edit');

        }


    </script>
@endsection()

