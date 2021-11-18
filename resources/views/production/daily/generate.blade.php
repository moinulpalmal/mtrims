
@extends('layouts.production.production-master')

@section('title')
    Daily Production Plan
@endsection
@section('content')
    <style type="text/css">
        /*th{
            background-color: #0689bd;
            color: white;
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
        tfoot input {
            width: 100%;
            padding: 1px;
            box-sizing: border-box;
        }
    </style>
    <div class="page page-dashboard">
        <div class="pageheader ">
            <h2>Production Plan <span>Generate Production Plan</span></h2>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{route('production.home')}}"><i class="fa fa-home"></i> Production</a>
                    </li>
                    <li>
                        <a href="{{route('production.plan.daily.generate')}}"> Daily Production Plan Generate</a>
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
                        <h1 class="custom-font"><strong>Pending Production Item</strong> List</h1>
                        <ul class="controls">
                            <li class="dropdown">
                                <a role="button" tabindex="0" class="dropdown-toggle settings" data-toggle="dropdown">
                                    <i class="fa fa-cog"></i>
                                    <i class="fa fa-spinner fa-spin"></i>
                                </a>
                                <ul class="dropdown-menu pull-right with-arrow animated littleFadeInUp">
                                    <li>
                                        <a role="button" tabindex="0" class="tile-toggle">
                                            <span class="minimize"><i class="fa fa-angle-down"></i>&nbsp;&nbsp;&nbsp;Minimize</span>
                                            <span class="expand"><i class="fa fa-angle-up"></i>&nbsp;&nbsp;&nbsp;Expand</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a onclick="refresh()" role="button" tabindex="0" class="tile-refresh">
                                            <i class="fa fa-refresh"></i> Refresh
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            {{--                            <li class="remove"><a role="button" tabindex="0" class="tile-close"><i class="fa fa-times"></i></a></li>--}}
                        </ul>
                    </div>
                    <!-- /tile header -->
                    <!-- tile body -->
                    <div class="tile-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered table-condensed" id="advanced-usage">
                                <thead>
                                <tr style="background-color: #1693A5; color: white;">
                                    <th class="text-center">Sl No.</th>
                                    <th class="text-center">PO No</th>
                                    <th class="text-center">Trims Type</th>
                                    <th class="text-center">Buyer</th>
                                    <th class="text-center">Style No</th>
                                    <th class="text-center">Item Description</th>
                                    <th class="text-center">Size</th>
                                    <th class="text-center">Color</th>
                                    <th class="text-center">Start Date</th>
                                    <th class="text-center">Closing Date</th>
                                    <th class="text-center">Unit</th>
                                    <th class="text-center">Pending Quantity</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($i = 1)
                                @foreach($purchaseOrderDetails as $item)
                                    @if(\App\Helpers\Helper::GetSuggestedProductionQuantity($item->POM_ID, $item->POD_ID) != 0)
                                            <tr>
                                                <td class="text-center">{{$i++}}</td>
                                                <td class="text-center">LPD-{!! $item->lpd !!}-PO No-{!! $item->lpd_po_no !!}</td>
                                                <td class="text-center">{!! $item->trims_type_name !!}</td>
                                                <td class="text-center">{!! $item->buyer_name !!}</td>
                                                <td class="text-center">{!! $item->style_no !!}</td>
                                                <td class="text-center">{!! $item->item_description !!}</td>
                                                <td class="text-center">{!! $item->item_size !!}</td>
                                                <td class="text-center">{!! $item->item_color !!}</td>
                                                <td class="text-center">{!! \Carbon\Carbon::parse($item->production_start_date)->format('d/m/Y')  !!}</td>
                                                <td class="text-center">{!! \Carbon\Carbon::parse($item->production_end_date)->format('d/m/Y')  !!}</td>
                                                <td class="text-center">{!! $item->short_unit !!}</td>
                                                <td class="text-right">
                                                    {{--{{$item->not_finished_quantity}}--}}
                                                    {{ \App\Helpers\Helper::GetSuggestedProductionQuantity($item->POM_ID, $item->POD_ID)  }}
                                                </td>
                                                <td class="text-center">
                                                    @if(Auth::user()->hasTaskPermission('createpp', Auth::user()->id))
                                                    <button title="Insert Today Plan" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#{{$item->POM_ID}}D{{$item->POD_ID}}" data-options="splash-2 splash-ef-12"><i class="fa fa-edit"></i></button>
                                                    <button title="View Production Plan History" class="btn btn-info btn-xs" data-toggle="modal" data-target="#H{{$item->POM_ID}}D{{$item->POD_ID}}" data-options="splash-2 splash-ef-12"><i class="fa fa-eye"></i></button>
                                                    @endif
                                                </td>
                                            </tr>
                                    @endif
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td class="text-center">Sl No.</td>
                                    <td class="text-center">PO No</td>
                                    <td class="text-center">Trims Type</td>
                                    <td class="text-center">Buyer</td>
                                    <td class="text-center">Style No</td>
                                    <td class="text-center">Item Description</td>
                                    <td class="text-center">Size</td>
                                    <td class="text-center">Color</td>
                                    <td class="text-center">Approved Production Start Date</td>
                                    <td class="text-center">Approved Delivery End Date</td>
                                    <td class="text-center">Unit</td>
                                    <td class="text-center">Pending Quantity</td>
                                    <td class="text-center">Action</td>
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
@endsection

@section('page-modals')
    @foreach($purchaseOrderDetails as $item)
        @if((App\Helpers\Helper::GetTotalOrderQuantity($item->POM_ID, $item->POD_ID) -  App\Helpers\Helper::GetAchievementProductionQuantity($item->POM_ID, $item->POD_ID)  - App\Helpers\Helper::GetTotalActiveProductionQuantity($item->POM_ID, $item->POD_ID))) != 0)
        <!-- Modal -->
        <div class="modal splash fade" id="{{$item->POM_ID}}D{{$item->POD_ID}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form method="post" name="PPGenerateForm{{$item->POM_ID}}D{{$item->POD_ID}}" id="PPGenerate{{$item->POM_ID}}D{{$item->POD_ID}}" {{--onsubmit="return validateForm()"--}} enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-content">
                        <div class="modal-header bg-greensea">
                            <h3 class="modal-title custom-font text-white">Production Plan Insert Form</h3>
                        </div>
                        <div class="modal-body">
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
                                <input type="hidden" id="MasterID{{$item->POM_ID}}D{{$item->POD_ID}}" name="purchase_order_master_id" value="{{old('purchase_order_master_id', $item->POM_ID)}}">
                                <input type="hidden" id="DetailID{{$item->POM_ID}}D{{$item->POD_ID}}" name="purchase_order_detail_id" value="{{old('purchase_order_detail_id', $item->POD_ID)}}">
                                <input type="hidden" id="TrimTypeID{{$item->POM_ID}}D{{$item->POD_ID}}" name="trims_type_id" value="{{old('trims_type_id', $item->trims_type_id)}}">
                                <div class="col-md-4 no-padding">
                                    <div class="form-group">
                                        <label for="ProductionDate{{$item->POM_ID}}D{{$item->POD_ID}}" class="control-label">Production Date</label>
                                        <input type="date" class="form-control" name="production_date" id="ProductionDate{{$item->POM_ID}}D{{$item->POD_ID}}" required>
                                    </div>
                                </div>
                                <div class="col-md-4 no-padding">
                                    <div class="form-group">
                                        <label for="Stores{{$item->POM_ID}}D{{$item->POD_ID}}" class="control-label">Select Delivery Location</label>
                                        <select id="Stores{{$item->POM_ID}}D{{$item->POD_ID}}" class="form-control chosen-select" name="delivery_location" style="width: 100%;">
                                            <option value="" selected ="selected">- - - Select - - -</option>
                                            @if(!empty($stores))
                                                @foreach($stores as $itemStores)
                                                        <option value="{{ $itemStores->id }}">{{ $itemStores->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 no-padding">
                                    <div class="form-group">
                                        <label for="Machine{{$item->POM_ID}}D{{$item->POD_ID}}" class="control-label">Select {{$item->trims_type_name}} Machine</label>
                                        <select id="Machine{{$item->POM_ID}}D{{$item->POD_ID}}" class="form-control chosen-select" name="machine_id" style="width: 100%;">
                                            <option value="" selected ="selected">- - - Select - - -</option>
                                            @if(!empty($machines))
                                                @foreach($machines as $itemMachine)
                                                    @if($item->section_setup_id == $itemMachine->section_setup_id)
                                                        <option value="{{ $itemMachine->id }}">{{ $itemMachine->name }}</option>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="padding: 0px 15px;">
                                <div class="col-md-4 no-padding">
                                    <div class="form-group">
                                        <label for="HeadCount{{$item->POM_ID}}D{{$item->POD_ID}}" class="control-label">No. of Head</label>
                                        <input type="number" step="any" class="form-control" name="no_of_heads" id="HeadCount{{$item->POM_ID}}D{{$item->POD_ID}}" required>
                                    </div>
                                </div>
                                <div class="col-md-4 no-padding">
                                    <div class="form-group">
                                        <label for="Finished{{$item->POM_ID}}D{{$item->POD_ID}}" class="control-label">Pending Quantity</label>
                                        <input type="number" step="any" class="form-control" name="finished_production" id="Finished{{$item->POM_ID}}D{{$item->POD_ID}}" value="{{old('finished_production', \App\Helpers\Helper::GetSuggestedProductionQuantity($item->POM_ID, $item->POD_ID))}}" required readonly>
                                    </div>
                                </div>
                                <div class="col-md-4 no-padding">
                                    <div class="form-group">
                                        <label for="Target{{$item->POM_ID}}D{{$item->POD_ID}}" class="control-label">Target Production</label>
                                        <input type="number" step="any" max="{{ \App\Helpers\Helper::GetSuggestedProductionQuantity($item->POM_ID, $item->POD_ID)  }}
                                            " class="form-control" name="target_production" id="Target{{$item->POM_ID}}D{{$item->POD_ID}}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="padding: 0px 15px">
                                <div class="col-md-12 no-padding">
                                    <div class="form-group">
                                        <label for="Remarks{{$item->POM_ID}}D{{$item->POD_ID}}" class="control-label">Remarks</label>
                                        <input type="text" class="form-control" name="remarks" id="Remarks{{$item->POM_ID}}D{{$item->POD_ID}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a><button class="btn btn-success btn-ef btn-ef-3 btn-ef-3c" type="submit"><i class="fa fa-arrow-right"></i> Submit Plan</button></a>
                            <button class="btn btn-lightred btn-ef btn-ef-4 btn-ef-4c" data-dismiss="modal"><i class="fa fa-arrow-left"></i> Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Modal -->
        @endif
    @endforeach
@endsection
@section('pageVendorScripts')

@endsection
@section('pageScripts')
    {{--    <script src="{{ asset('back-end/assets/MyJS/jquery.min.js') }}"></script>--}}

    <script>
        $(window).load(function(){
            /*$('#advanced-usage').DataTable({
               /!* "scrollY":        "1000px",
                "scrollCollapse": true,
                "paging":         false*!/
            });*/
            $(document).ready(function() {
                // Setup - add a text input to each footer cell
                $('#advanced-usage tfoot td').each( function () {
                    var title = $(this).text();
                    $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
                } );

                // DataTable
                var table = $('#advanced-usage').DataTable({
                    initComplete: function () {
                        // Apply the search
                        this.api().columns().every( function () {
                            var that = this;
                            $( 'input', this.footer() ).on( 'keyup change clear', function () {
                                if ( that.search() !== this.value ) {
                                    that
                                        .search( this.value )
                                        .draw();
                                }
                            } );
                        } );
                    }
                });

            } );

        });

        function validateForm() {

            var trims_type = document.forms["PurchaseOrderForm"]["trims_type"].value;
            if(trims_type == ""){
                swal({
                    title: "Select Trims Type!",
                    icon: "warning",
                    button: "Ok!",
                });
                return false;
            }
            return true;
        }


        @foreach($purchaseOrderDetails as $item)
        @if((App\Helpers\Helper::GetTotalOrderQuantity($item->POM_ID, $item->POD_ID) -  App\Helpers\Helper::GetAchievementProductionQuantity($item->POM_ID, $item->POD_ID)  - App\Helpers\Helper::GetTotalActiveProductionQuantity($item->POM_ID, $item->POD_ID)) != 0)
        $(function(){
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
            });
            $('#PPGenerate{{$item->POM_ID}}D{{$item->POD_ID}}').submit(function(e){
                e.preventDefault();
                var data = $(this).serialize();
                var machine_id = document.forms["PPGenerateForm{{$item->POM_ID}}D{{$item->POD_ID}}"]["machine_id"].value;
                var delivery_location_id = document.forms["PPGenerateForm{{$item->POM_ID}}D{{$item->POD_ID}}"]["delivery_location"].value;
                var target_production = document.forms["PPGenerateForm{{$item->POM_ID}}D{{$item->POD_ID}}"]["target_production"].value;
                var max_target_production = document.forms["PPGenerateForm{{$item->POM_ID}}D{{$item->POD_ID}}"]["finished_production"].value;
                var variation_production =  parseFloat(max_target_production).toFixed(5) - parseFloat(target_production).toFixed(5);

                if(machine_id == ""){
                    swal({
                        title: "Select Trims Machine!",
                        icon: "warning",
                        button: "Ok!",
                    });
                    return false;
                }
                else if(target_production <= 0){
                    swal({
                        title: "Invalid Target Production!",
                        icon: "warning",
                        button: "Ok!",
                    });
                    return false;
                }
                else if(variation_production < 0){
                    swal({
                        title: "Invalid Target Production!",
                        icon: "warning",
                        button: "Ok!",
                    });
                    return false;
                }
                else if(target_production == ""){
                    swal({
                        title: "Invalid Target Production!",
                        icon: "warning",
                        button: "Ok!",
                    });
                    return false;
                }
                else if(delivery_location_id == ""){
                    swal({
                        title: "Select Delivery Location!",
                        icon: "warning",
                        button: "Ok!",
                    });
                    return false;
                }
                else{
                    var url = '{{ route('production.plan.daily.save') }}';

                    $.ajax({
                        url: url,
                        method:'POST',
                        data:data,
                        success:function(data){
                            swal({
                                title: "Data Inserted Successfully!",
                                icon: "success",
                                button: "Ok!",
                            }).then(function (value) {
                                if(value){
                                    window.location.href = window.location.href.replace(/#.*$/, '');
                                }
                            });
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



