@extends('layouts.store.store-master')

@section('title')
    Trims Left Over Receive
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
        <div class="pageheader">
            <h2>Store <span>// HTL Store</span></h2>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{route('store.home')}}"><i class="fa fa-home"></i> Store</a>
                    </li>
                    <li>
                        <a href="{{route('store.receive.trims.finished-left-over')}}"> Left Over Trims Item Receive</a>
                    </li>
                </ul>
                {{--<div class="page-toolbar">
                    <a role="button" tabindex="0" class="btn btn-lightred no-border pickDate">
                        <i class="fa fa-calendar"></i>&nbsp;&nbsp;<span></span>&nbsp;&nbsp;<i class="fa fa-angle-down"></i>
                    </a>
                </div>--}}
            </div>
        </div>
        <!-- row -->
        <div class="row">            <!-- col -->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">                <!-- tile -->
                <section class="tile">
                    <!-- tile header -->
                    <div class="tile-header dvd dvd-btm">
                        <h1 class="custom-font"><strong>Trims Item</strong> Finished Left Over Item List</h1>
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
                            @foreach($trimsTypes as $itemTrims)
                                <section class="tile">
                                    <div class="tile-header dvd dvd-btm bg-greensea">
                                        <h1 class="custom-font"><strong>{{$itemTrims->name}}</strong></h1>
                                    </div>
                                    <div class="tile-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover table-bordered table-condensed" id="advanced-usage{{$itemTrims->id}}">
                                                <thead>
                                                <tr style="background-color: #1693A5; color: white;">
                                                    <th class="text-center">Sl No.</th>
                                                    <th class="text-center">PO No</th>
                                                    <th class="text-center">Buyer</th>
                                                    <th class="text-center">Style No</th>
                                                    <th class="text-center">Item Description</th>
                                                    <th class="text-center">Size</th>
                                                    <th class="text-center">Color</th>
                                                    <th class="text-center">Unit</th>
                                                    <th class="text-center">Receive-Able Qty</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php($i = 1)
                                                @foreach($activeProductionPlans as $item)
                                                    @if($itemTrims->id == (\App\Helpers\Helper::TwoIDwiseData('purchase_order_details', 'purchase_order_master_id', $item->purchase_order_master_id, 'item_count', $item->purchase_order_detail_id))->trims_type_id)
                                                        @if($item->left_over_production > 0)
                                                            <tr>
                                                                <td class="text-center">{{$i++}}</td>
                                                                <td class="text-center">LPD-{!! (\App\Helpers\Helper::IDwiseData('purchase_order_masters', 'id', $item->purchase_order_master_id))->lpd !!}-PO No-{!! (\App\Helpers\Helper::IDwiseData('purchase_order_masters', 'id', $item->purchase_order_master_id))->lpd_po_no !!}</td>
                                                                <td class="text-center">{!! (\App\Helpers\Helper::IDwiseData('buyers', 'id', (\App\Helpers\Helper::IDwiseData('purchase_order_masters', 'id', $item->purchase_order_master_id))->buyer_id))->name !!}</td>
                                                                <td class="text-center">{!! (\App\Helpers\Helper::TwoIDwiseData('purchase_order_details', 'purchase_order_master_id', $item->purchase_order_master_id, 'item_count', $item->purchase_order_detail_id))->style_no !!}</td>
                                                                <td class="text-center">{!! (\App\Helpers\Helper::TwoIDwiseData('purchase_order_details', 'purchase_order_master_id', $item->purchase_order_master_id, 'item_count', $item->purchase_order_detail_id))->item_description !!}</td>
                                                                <td class="text-center">{!! (\App\Helpers\Helper::TwoIDwiseData('purchase_order_details', 'purchase_order_master_id', $item->purchase_order_master_id, 'item_count', $item->purchase_order_detail_id))->item_size !!}</td>
                                                                <td class="text-center">{!! (\App\Helpers\Helper::TwoIDwiseData('purchase_order_details', 'purchase_order_master_id', $item->purchase_order_master_id, 'item_count', $item->purchase_order_detail_id))->item_color !!}</td>
                                                                <td class="text-center">{!! (\App\Helpers\Helper::IDwiseData('units', 'id', $item->item_unit_id))->short_unit !!}</td>
                                                                <td class="text-center">{!! $item->left_over_production !!}</td>
                                                                <td class="text-center">
                                                                    <a title="Receive This Trims Item" class="DeActivateBuyer btn btn-warning btn-xs" data-id = "{{ $item->id }}"><i class="fa fa-arrow-circle-up"></i></a>
{{--                                                                    <a title="Reject This Trims Item" class="RejectBuyer btn btn-danger btn-xs" data-id = "{{ $item->id }}"><i class="fa fa-arrow-circle-down"></i></a>--}}
    {{--                                                                <button title="Update This Plan" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#plan{{$item->id}}" data-options="splash-2 splash-ef-12"><i class="fa fa-edit"></i></button>--}}
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endif
                                                @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td class="text-center">Sl No.</td>
                                                        <td class="text-center">PO No</td>
                                                        <td class="text-center">Buyer</td>
                                                        <td class="text-center">Style No</td>
                                                        <td class="text-center">Item Description</td>
                                                        <td class="text-center">Size</td>
                                                        <td class="text-center">Color</td>
                                                        <td class="text-center">Unit</td>
                                                        <td class="text-center">Receive-Able Qty</td>
                                                        <td class="text-center">Action</td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </section>
                            @endforeach
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

@endsection
@section('pageVendorScripts')

@endsection
@section('pageScripts')
    {{--    <script src="{{ asset('back-end/assets/MyJS/jquery.min.js') }}"></script>--}}

    <script>
        $(window).load(function(){
            @foreach($trimsTypes as $itemTrims)
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
            });
            @endforeach


        });

        @foreach($trimsTypes as $itemTrims)
        $('#advanced-usage{{$itemTrims->id}}').on('click',".DeActivateBuyer", function(){
            var button = $(this);
            var id = button.attr("data-id");
            var url = '{{ route('store.receive.trims.finished-left-over.stored') }}';
            swal({
                title: 'Are you sure?',
                text: 'This left over trims item will be stored in the stock!',
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
        $('#advanced-usage{{$itemTrims->id}}').on('click',".RejectBuyer", function(){
            var button = $(this);
            var id = button.attr("data-id");
            var url = '{{ route('store.receive.trims.finished-in-house.reject') }}';
            swal({
                title: 'Are you sure?',
                text: 'This trims item will be rejected!',
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


        function refresh()
        {
            window.location.href = window.location.href.replace(/#.*$/, '');
        }

        function iconChange() {
            $('#iconChange').find('i').addClass('fa-edit');
        }
    </script>
@endsection()






