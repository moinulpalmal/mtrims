@extends('layouts.management.management-master')
@section('title')
   Sales Report
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
    </style>
    <div class="page page-dashboard">
        <div class="pageheader">
            <h2>Sales <span>// Report Generate</span></h2>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{route('management.home')}}"><i class="fa fa-home"></i> Management</a>
                    </li>
                    <li>
                        <a href="{{route('management.sales.report.generate')}}"> Generate Sales Report</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- row -->

            <div class="row">
                <!-- col -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <!-- tile -->
                    <section class="tile">
                        <!-- tile header -->
                        <div class="tile-header dvd dvd-btm">
                            <h1 class="custom-font"><strong>Sales Report Generate Form Form</strong></h1>
                            <a><button onclick="refresh()" class="pull-right btn-warning btn-xs" ><i class="fa fa-refresh"></i></button></a>
                        </div>
                        <!-- /tile header -->
                        <!-- tile body -->
                        <div class="tile-body">                            <!-- row -->

                            <div class="row">
                                <!-- col -->
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <!-- tile -->
                                    <form method="post" id="PurchaseOrderFormID" name="PurchaseOrderForm" action="{{route('management.sales.report.generate-result')}}" enctype="multipart/form-data" >
                                        {{ csrf_field() }}
                                    <section class="tile">
                                        <!-- tile header -->
                                        <div class="tile-header dvd dvd-btm">
                                            <h1 class="custom-font"><strong>Sales Report</strong> Search Parameters</h1>
                                            <a><button class="pull-right btn-info btn-xs" type="submit"><i class="fa fa-check"></i></button></a>
                                        </div>
                                        <!-- /tile header -->
                                        <!-- tile body -->
                                        <div class="tile-body">
                                            @if (count($errors) > 0)
                                                <div class="row" style="padding: 0px 15px;">
                                                    <div class="col-md-12">
                                                        <div class="alert alert-danger">
                                                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                                            <ul>
                                                                @foreach ($errors->all() as $error)
                                                                    <li>{{ $error }}</li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="row" style="padding: 0px 15px;">
                                                <div class="col-md-2  no-padding">
                                                    <div class="form-group">
                                                        <label for="YarnTypeName" class="control-label">Select LPD</label>
                                                        <select class="form-control chosen-select" name="lpd"  id="YarnTypeName" style="width: 100% !important; height: 100% !important;">
                                                            <option value="0" selected="selected">- - - Select - - -</option>
                                                            <option value="1" >LPD-1</option>
                                                            <option value="2" >LPD-2</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 no-padding">
                                                    <div class="form-group">
                                                        <label for="LPD_PO" class="control-label">LPD PO No.</label>
                                                        <input type="number" class="form-control" name="lpd_po_no" id="LPD_PO" placeholder="2485" value="{{ old('lpd_po_no') }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 no-padding">
                                                    <div class="form-group">
                                                        <label for="TrimsType" class="control-label">Select Trims Type</label>
                                                        <select id="TrimsType" class="form-control chosen-select" name="trims_type[]" multiple="" tabindex="3" style="width: 100%;">
{{--                                                            <option value="">All</option>--}}
                                                            @if(!empty($trimsTypes))
                                                                @foreach($trimsTypes as $item)
                                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 no-padding">
                                                    <div class="form-group">
                                                        <label for="Buyer" class="control-label">Select Buyer</label>
                                                        <select id="Buyer" class="form-control chosen-select" multiple="" name="buyer[]" style="width: 100%;">
{{--                                                           <option value="A">All</option>--}}
                                                            @if(!empty($buyers))
                                                                @foreach($buyers as $item)
                                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                                <div class="row" style="padding: 0px 15px;">
                                                    <div class="col-md-3 no-padding">
                                                        <div class="form-group">
                                                            <label for="TypeName" class="control-label">From Date</label>
                                                            <input type="date" class="form-control" name="from_date" id="TypeName">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 no-padding">
                                                        <div class="form-group">
                                                            <label for="Remarks" class="control-label">To Date</label>
                                                            <input type="date" class="form-control" name="to_date" id="Remarks">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="OPO" class="checkbox checkbox-custom-alt checkbox-custom-lg" style="padding-top: 17px">
                                                                <input name="without_replacement_challan" id="OPO" type="checkbox"><i></i> <strong>Without Replacement Challan?</strong>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                        <!-- /tile body -->
                                    </section>
                                    </form>
                                    <!-- /tile -->
                                </div>
                                <!-- /col -->
                                <!-- col -->
                                <!-- /col -->
                            </div>
                            <!-- /row -->
                        </div>
                        <!-- /tile body -->
                    </section>
                    <!-- /tile -->
                </div>
                <!-- /col -->
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

        $(window).load(function(){
            sessionStorage.clear();
        });



    </script>
@endsection


