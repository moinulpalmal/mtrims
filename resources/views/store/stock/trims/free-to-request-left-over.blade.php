@extends('layouts.store.store-master')

@section('title')
    Free To Requested Left Over Stock
@endsection
@section('content')
    <style type="text/css">
       /* th{
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
        <div class="pageheader">
            <h2>Store <span>// HTL Store</span></h2>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{route('store.home')}}"><i class="fa fa-home"></i> Store</a>
                    </li>
                    <li>
                        <a href="{{route('store.stock.free-trims.requested-left-over')}}"> Free To Requested Left Over Stock</a>
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
                        <h1 class="custom-font"><strong>Trims Item</strong> Free To Requested Left Over Stock List</h1>
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
                                <section class="tile">
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
                                                    <th class="text-center">Left Over Reason</th>
                                                    <th class="text-center">Unit</th>
                                                    <th class="text-center">Qty</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php($i = 1)
                                                @foreach($activeProductionPlans as $item)
                                                        <tr >
                                                            <td class="text-center">{{$i++}}</td>
                                                            <td class="text-center">LPD-{{$item->lpd}}-PO No.-{{$item->lpd_po_no}}</td>
                                                            <td class="text-center">{!! $item->trims_type !!}</td>
                                                            <td class="text-center">{!! $item->buyer !!}</td>
                                                            <td class="text-center">{!! $item->style_no !!}</td>
                                                            <td class="text-center">{!! $item->item_description !!}</td>
                                                            <td class="text-center">{!! $item->item_size !!}</td>
                                                            <td class="text-center">{!! $item->item_color !!}</td>
                                                            <td class="text-center">{!! $item->left_over_reason !!}</td>
                                                            <td class="text-center">{!! $item->short_unit !!}</td>
                                                            <td class="text-right">{!! $item->requested_left_over_quantity !!}</td>
                                                            <td class="text-center">
{{--                                                                <button title="Update This Plan" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#plan{{$item->id}}" data-options="splash-2 splash-ef-12"><i class="fa fa-edit"></i></button>--}}
                                                                <button title="Approve Left Over Request" class="btn btn-success btn-xs" data-toggle="modal" data-target="#left{{$item->id}}" data-options="splash-2 splash-ef-12"><i class="fa fa-check"></i></button>
                                                                <a title="Reject Left Over Request" class="DeActivateBuyer btn btn-danger btn-xs" data-id = "{{ $item->id }}"><i class="fa fa-times"></i></a>
                                                            </td>
                                                        </tr>
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
                                                        <td class="text-center">Left Over Reason</td>
                                                        <td class="text-center">Unit</td>
                                                        <td class="text-center">Qty</td>
                                                        <td class="text-center">Action</td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </section>
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
    @foreach($activeProductionPlans as $item)
        <div class="modal splash fade" id="left{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form method="post" id="LeftRequest{{$item->id}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-content">
                        <div class="modal-header bg-greensea">
                            <h3 class="modal-title custom-font text-white">Left Over Request Generate Form {{$item->id}}</h3>
                        </div>
                        <div class="modal-body">
                            <div class="row" style="padding: 0px 15px;">
                                <input type="hidden" id="MasterID{{$item->id}}" name="id" value="{{old('id', $item->id)}}">
                                <div class="col-md-6 no-padding">
                                    <div class="form-group">
                                        <label for="DRPQty{{$item->id}}" class="control-label">Left Over Request Qty</label>
                                        <input type="number" step="any" class="form-control" name="item_request_qty" id="DRPQty{{$item->id}}" required value="{{ old('item_request_qty', $item->requested_left_over_quantity)}}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6 no-padding">
                                    <div class="form-group">
                                        <label for="DRQty{{$item->id}}" class="control-label">Left Over Approve Qty</label>
                                        <input type="number" step="any" class="form-control" name="item_approve_qty" id="DRQty{{$item->id}}" max="{{$item->requested_left_over_quantity}}" required value="{{ old('item_approve_qty')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="padding: 0px 15px;">
                                <div class="col-md-12 no-padding">
                                    <div class="form-group">
                                        <label for="ReplacementReason{{$item->id}}" class="control-label">Replacement Reason</label>
                                        <input type="text" class="form-control" name="replacement_reason" id="ReplacementReason{{$item->id}}" required readonly value="{{ old('replacement_reason', $item->left_over_reason) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="padding: 0px 15px;">
                                <div class="col-md-12 no-padding">
                                    <div class="form-group">
                                        <label for="Remarks{{$item->id}}" class="control-label">Remarks</label>
                                        <input type="text" class="form-control" name="remarks" id="Remarks{{$item->id}}" value="{{ old('remarks', $item->remarks) }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a><button class="btn btn-success btn-ef btn-ef-3 btn-ef-3c" type="submit"><i class="fa fa-arrow-right"></i> Generate Request</button></a>
                            <button class="btn btn-lightred btn-ef btn-ef-4 btn-ef-4c" data-dismiss="modal"><i class="fa fa-arrow-left"></i> Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endforeach
@endsection
@section('pageVendorScripts')

@endsection
@section('pageScripts')
    {{--    <script src="{{ asset('back-end/assets/MyJS/jquery.min.js') }}"></script>--}}

    <script>
        $(window).load(function(){
            {{--@foreach($trimsTypes as $itemTrims)
            $('#advanced-usage{{$itemTrims->id}}').DataTable({
                /*"scrollY":        "500px",
                "scrollCollapse": true,
                "paging":         false*/
            });
            @endforeach--}}
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
                            });
                        });
                    }
                });

            });

        });

        @foreach($activeProductionPlans as $item)
        $(function(){
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
            });
            $('#LeftRequest{{$item->id}}').submit(function(e){
                e.preventDefault();
                var data = $(this).serialize();
                var url = '{{ route('store.stock.free-trims.approve-left-over') }}';
                //console.log(data);
                //return;
                swal({
                    title: 'Are you sure?',
                    text: 'You want to approve this left over request!',
                    icon: 'warning',
                    buttons: ["Cancel", "Yes!"],
                }).then(function(value) {
                    if (value) {
                        $.ajax({
                            url: url,
                            method:'POST',
                            data:data,
                            success:function(data){
                               // console.log(data);
                                 //return;
                                if(parseInt(data) == 2){
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
                                else if(parseInt(data) == 1){
                                    swal({
                                        title: "Data Not Saved!",
                                        text: "Invalid Quantity!",
                                        icon: "error",
                                        button: "Ok!",
                                        className: "myClass",
                                    });
                                }
                                else if(parseInt(data) == 3){
                                    swal({
                                        title: "Data Not Saved!",
                                        text: "Invalid Request!",
                                        icon: "error",
                                        button: "Ok!",
                                        className: "myClass",
                                    });
                                }
                                else{
                                    swal({
                                        title: "Data Not Saved!",
                                        text: "Please Check Your Connections!",
                                        icon: "error",
                                        button: "Ok!",
                                        className: "myClass",
                                    });
                                }

                            },
                            error:function(error){
                                //console.log(error);
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
                });

            })
        });
        @endforeach

        $('#advanced-usage').on('click',".DeActivateBuyer", function(){
            var button = $(this);
            var id = button.attr("data-id");
            var url = '{{ route('store.stock.free-trims.reject-left-over') }}';
            swal({
                title: 'Are you sure?',
                text: 'This left over request will be rejected!',
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

        function refresh()
        {
            window.location.href = window.location.href.replace(/#.*$/, '');
        }

        function iconChange() {
            $('#iconChange').find('i').addClass('fa-edit');
        }
    </script>
@endsection()






