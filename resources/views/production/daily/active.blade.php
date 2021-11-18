@extends('layouts.production.production-master')

@section('title')
    Daily Production Plan
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
        tfoot input {
            width: 100%;
            padding: 1px;
            box-sizing: border-box;
        }
    </style>
    <div class="page page-dashboard">
        <div class="pageheader ">
            <h2>Production Plan <span>Active Production Plan</span></h2>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{route('production.home')}}"><i class="fa fa-home"></i> Production</a>
                    </li>
                    <li>
                        <a href="{{route('production.plan.daily.active')}}"> Daily Production Plan Active</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- row -->
        <div class="row">            <!-- col -->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">                <!-- tile -->
                <section class="tile">
                    <!-- tile header -->
                    <div class="tile-header dvd dvd-btm">
                        <h1 class="custom-font"><strong>Active Production Plan</strong> List</h1>
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
                        <div class="row no-padding">
                            @if(!empty($sectionSetups))
                            @foreach($sectionSetups as $itemSections)
                                <section class="tile">
                                    <div class="tile-header dvd dvd-btm bg-greensea">
                                        <h1 class="custom-font"><strong>{{$itemSections->name}}</strong></h1>
                                    </div>
                                    <div class="tile-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover table-bordered table-condensed" id="advanced-usage{{$itemSections->id}}">
                                                <thead>
                                                <tr style="background-color: #1693A5; color: white;">
                                                    <th class="text-center">Sl No.</th>
                                                    <th class="text-center">Date</th>
                                                    <th class="text-center">Production Area</th>
                                                    <th class="text-center">Batch No</th>
                                                    <th class="text-center">PO No</th>
                                                    <th class="text-center">Delivery Location</th>
                                                    <th class="text-center">Buyer</th>
                                                    <th class="text-center">Trims Types</th>
                                                    <th class="text-center">Item Description</th>
                                                    <th class="text-center">Size</th>
                                                    <th class="text-center">Color</th>
                                                    <th class="text-center">No Head</th>
                                                    <th class="text-center">Unit</th>
                                                    <th class="text-center">Target Quantity</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php($i = 1)
                                                @if(!empty($activeProductionPlans))
                                                @foreach($activeProductionPlans as $item)
                                                    @if($itemSections->id == (\App\Helpers\Helper::IDwiseData('trims_types', 'id', (\App\Helpers\Helper::TwoIDwiseData('purchase_order_details', 'purchase_order_master_id', $item->purchase_order_master_id, 'item_count', $item->purchase_order_detail_id))->trims_type_id))->section_setup_id)
                                                        <tr>
                                                            <td class="text-center">{{$i++}}</td>
                                                            <td class="text-center">{!! \Carbon\Carbon::parse($item->production_date)->format('d/m/Y')  !!}</td>
                                                            <td class="text-center">{{ (\App\Helpers\Helper::IDwiseData('machine_setups', 'id', $item->machine_id))->name }}</td>
                                                            <td class="text-center">{{$item->purchase_order_master_id}}{{$item->purchase_order_detail_id}}{{$item->id}}</td>
                                                            <td class="text-center">LPD-{!! (\App\Helpers\Helper::IDwiseData('purchase_order_masters', 'id', $item->purchase_order_master_id))->lpd !!}-PO No-{!! (\App\Helpers\Helper::IDwiseData('purchase_order_masters', 'id', $item->purchase_order_master_id))->lpd_po_no !!}</td>
                                                            <td class="text-center">{!! (\App\Helpers\Helper::IDwiseData('stores', 'id', $item->delivery_location_id))->short_name !!}</td>
                                                            <td class="text-center">{!! (\App\Helpers\Helper::IDwiseData('buyers', 'id', (\App\Helpers\Helper::IDwiseData('purchase_order_masters', 'id', $item->purchase_order_master_id))->buyer_id))->name !!}</td>
                                                            <td class="text-center">{!! (\App\Helpers\Helper::IDwiseData('trims_types', 'id', (\App\Helpers\Helper::TwoIDwiseData('purchase_order_details', 'purchase_order_master_id', $item->purchase_order_master_id, 'item_count', $item->purchase_order_detail_id))->trims_type_id))->name !!}</td>
                                                            <td class="text-center">{!! (\App\Helpers\Helper::TwoIDwiseData('purchase_order_details', 'purchase_order_master_id', $item->purchase_order_master_id, 'item_count', $item->purchase_order_detail_id))->item_description !!}</td>
                                                            <td class="text-center">{!! (\App\Helpers\Helper::TwoIDwiseData('purchase_order_details', 'purchase_order_master_id', $item->purchase_order_master_id, 'item_count', $item->purchase_order_detail_id))->item_size !!}</td>
                                                            <td class="text-center">{!! (\App\Helpers\Helper::TwoIDwiseData('purchase_order_details', 'purchase_order_master_id', $item->purchase_order_master_id, 'item_count', $item->purchase_order_detail_id))->item_color !!}</td>
                                                            <td class="text-center">{!! $item->no_of_heads !!}</td>
                                                            <td class="text-center">{!! (\App\Helpers\Helper::IDwiseData('units', 'id', $item->item_unit_id))->short_unit !!}</td>
                                                            <td class="text-center">{!! $item->target_production !!}</td>
                                                            <td class="text-center">
                                                                @if(Auth::user()->hasTaskPermission('deletepp', Auth::user()->id))
                                                                    <button title="Update This Plan" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#plan{{$item->id}}" data-options="splash-2 splash-ef-12"><i class="fa fa-edit"></i></button>
                                                                    <button title="View Production Plan History" class="btn btn-info btn-xs" data-toggle="modal" data-target="#H{{$item->id}}D{{$item->id}}" data-options="splash-2 splash-ef-12"><i class="fa fa-eye"></i></button>
                                                                    @if($item->status == 'A')
                                                                        <a title="Delete" class="DeleteBuyer btn btn-danger btn-xs" data-id = "{{ $item->id }}"><i class="fa fa-trash"></i></a>
                                                                    @endif
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                                @endif
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <td class="text-center">Sl No.</td>
                                                    <td class="text-center">Date</td>
                                                    <td class="text-center">Production Area</td>
                                                    <td class="text-center">Batch No</td>
                                                    <td class="text-center">PO No</td>
                                                    <td class="text-center">Delivery Location</td>
                                                    <td class="text-center">Buyer</td>
                                                    <td class="text-center">Trims Types</td>
                                                    <td class="text-center">Item Description</td>
                                                    <td class="text-center">Size</td>
                                                    <td class="text-center">Color</td>
                                                    <td class="text-center">No Head</td>
                                                    <td class="text-center">Unit</td>
                                                    <td class="text-center">Target Quantity</td>
                                                    <td class="text-center">Action</td>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </section>
                            @endforeach
                                @endif
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
    @if(!empty($activeProductionPlans))
        @foreach($activeProductionPlans as $item)
            <!-- Modal -->
            <div class="modal splash fade" id="plan{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <form method="post" name="PPGenerateForm{{$item->id}}" id="PPGenerate{{$item->id}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="modal-content">
                            <div class="modal-header bg-greensea">
                                <h3 class="modal-title custom-font text-white">Production Plan Insert Form</h3>
                            </div>
                            <div class="modal-body">
                                <div class="row" style="padding: 0px 15px;">
                                    <input type="hidden" id="PlanID{{$item->id}}" name="id" value="{{old('id', $item->id)}}">
                                    <div class="col-md-4 no-padding">
                                        <div class="form-group">
                                            <label for="ProductionDate{{$item->id}}" class="control-label">Production Date</label>
                                            <input type="date" class="form-control" name="production_date" id="ProductionDate{{$item->id}}" required value="{{old('production_date', $item->production_date)}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4 no-padding">
                                        <div class="form-group">
                                            <label for="Stores{{$item->id}}" class="control-label">Select Delivery Location</label>
                                            <select id="Stores{{$item->id}}" class="form-control chosen-select" name="delivery_location" style="width: 100%;">
                                                <option value="" >- - - Select - - -</option>
                                                @if(!empty($stores))
                                                    @foreach($stores as $itemStores)
                                                        <option value="{{ $itemStores->id }}" @if($itemStores->id == $item->delivery_location_id) selected = "selected" @endif>{{ $itemStores->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 no-padding">
                                        <div class="form-group">
                                            <label for="Machine{{$item->id}}" class="control-label">Select {{$item->trims_type_name}} Machine</label>
                                            <select id="Machine{{$item->id}}" class="form-control chosen-select" name="machine_id" style="width: 100%;">
                                                <option value="">- - - Select - - -</option>
                                                @if(!empty($machines))
                                                    @foreach($machines as $itemMachine)
                                                        @if((\App\Helpers\Helper::IDwiseData('trims_types', 'id', (\App\Helpers\Helper::TwoIDwiseData('purchase_order_details', 'purchase_order_master_id', $item->purchase_order_master_id, 'item_count', $item->purchase_order_detail_id))->trims_type_id))->section_setup_id == $itemMachine->section_setup_id)
                                                            <option value="{{ $itemMachine->id }}" @if($itemMachine->id == $item->machine_id) selected = "selected" @endif>{{ $itemMachine->name }}</option>
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
                                            <label for="HeadCount{{$item->id}}" class="control-label">No. of Head</label>
                                            <input type="number" step="any" class="form-control" name="no_of_heads" id="HeadCount{{$item->id}}" required value="{{old('no_of_heads', $item->no_of_heads)}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4 no-padding">
                                        <div class="form-group">
                                            <label for="Finished{{$item->id}}" class="control-label">Pending Quantity</label>
                                            <input type="number" step="any" class="form-control" name="finished_production" id="Finished{{$item->id}}" value="{{old('finished_production', (App\Helpers\Helper::GetSuggestedProductionQuantity($item->purchase_order_master_id, $item->purchase_order_detail_id)))}}" required readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4 no-padding">
                                        <div class="form-group">
                                            <label for="Target{{$item->id}}" class="control-label">Target Production</label>
                                            <input type="hidden" step="any" class="form-control" name="p_target_production" id="PTarget{{$item->id}}" required value="{{($item->target_production + (App\Helpers\Helper::GetSuggestedProductionQuantity($item->purchase_order_master_id, $item->purchase_order_detail_id)))}}">

                                            <input type="number" step="any" class="form-control" name="target_production" id="Target{{$item->id}}" required value="{{old('target_production', $item->target_production)}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="padding: 0px 15px">
                                    <div class="col-md-12 no-padding">
                                        <div class="form-group">
                                            <label for="Remarks{{$item->id}}" class="control-label">Remarks</label>
                                            <input type="text" class="form-control" name="remarks" id="Remarks{{$item->id}}" value="{{old('remarks', $item->remarks)}}">
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
        @endforeach
    @endif
@endsection
@section('pageVendorScripts')

@endsection
@section('pageScripts')
    {{--    <script src="{{ asset('back-end/assets/MyJS/jquery.min.js') }}"></script>--}}

    <script>
        $(window).load(function(){
            @foreach($sectionSetups as $itemTrims)
           {{-- $('#advanced-usage{{$itemTrims->id}}').DataTable({
                /*"scrollY":        "500px",
                "scrollCollapse": true,
                "paging":         false*/
            });--}}

                $(document).ready(function() {
                    // Setup - add a text input to each footer cell
                    $('#advanced-usage{{$itemTrims->id}} tfoot td').each( function () {
                        var title = $(this).text();
                        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
                    } );

                    // DataTable
                    var table = $('#advanced-usage{{$itemTrims->id}}').DataTable({
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
            @endforeach
        });

        @foreach($sectionSetups as $itemSections)
            $('#advanced-usage{{$itemSections->id}}').on('click',".DeleteBuyer", function(){
            var button = $(this);
            var id = button.attr("data-id");
            var url = '{{ route('production.plan.daily.delete') }}';
            swal({
                title: 'Are you sure?',
                text: 'This production plan will be removed permanently!',
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
        @endforeach

        @if(!empty($activeProductionPlans))
        @foreach($activeProductionPlans as $item)
        $(function(){
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
            });
            $('#PPGenerate{{$item->id}}').submit(function(e){
                e.preventDefault();
                var data = $(this).serialize();
                var machine_id = document.forms["PPGenerateForm{{$item->id}}"]["machine_id"].value;
                var delivery_location_id = document.forms["PPGenerateForm{{$item->id}}"]["delivery_location"].value;
                var p_target_production = document.forms["PPGenerateForm{{$item->id}}"]["p_target_production"].value;
                var target_production = document.forms["PPGenerateForm{{$item->id}}"]["target_production"].value;
                var max_target_production = document.forms["PPGenerateForm{{$item->id}}"]["finished_production"].value;
                var variation_production =  parseFloat(p_target_production).toFixed(5); /*+ parseFloat(target_production).toFixed(5);*/
               // console.log(variation_production);
                //console.log(p_target_production );
                //return;
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
                else if(parseFloat(target_production).toFixed(5) > parseFloat(variation_production).toFixed(5)){
                    console.log(variation_production);
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
                    //return;
                    var url = '{{ route('production.plan.daily.update') }}';

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
        @endforeach
        @endif

        function refresh()
        {
            window.location.href = window.location.href.replace(/#.*$/, '');
        }

        function iconChange() {
            $('#iconChange').find('i').addClass('fa-edit');
        }
    </script>
@endsection()




