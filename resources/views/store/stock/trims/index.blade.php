@extends('layouts.store.store-master')

@section('title')
    Trims Stock
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
                        <a href="{{route('store.stock.trims')}}"> Current Stock</a>
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
                        <h1 class="custom-font"><strong>Trims Item</strong> Current Stock List</h1>
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
                                                    <th class="text-center">Unit</th>
                                                    <th class="text-center">Stock Qty</th>
                                                    <th class="text-center">Delivered Qty</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php($i = 1)
                                                @foreach($activeProductionPlans as $item)
                                                        <tr>
                                                            <td class="text-center">{{$i++}}</td>
                                                            <td class="text-center">LPD-{{$item->lpd}}-PO No.-{{$item->lpd_po_no}}</td>
                                                            <td class="text-center">{!! $item->trims_type !!}</td>
                                                            <td class="text-center">{!! $item->buyer !!}</td>
                                                            <td class="text-center">{!! $item->style_no !!}</td>
                                                            <td class="text-center">{!! $item->item_description !!}</td>
                                                            <td class="text-center">{!! $item->item_size !!}</td>
                                                            <td class="text-center">{!! $item->item_color !!}</td>
                                                            <td class="text-center">{!! $item->short_unit !!}</td>
                                                            <td class="text-center">{!! $item->stock_quantity !!}</td>
                                                            <td class="text-center">{!!\App\Helpers\Helper::stockGrossDeliveredQtyTotal($item->id) !!}</td>
                                                            {{--<td class="text-center">
                                                                @if($item->delivered_production <= 0)
                                                                    @if($item->delivered_production == 0)
                                                                        @if(Auth::user()->hasTaskPermission('rejectfinishedtrims', Auth::user()->id))
                                                                            <a title="Reject This Trims Item" class="DeActivateBuyer btn btn-danger btn-xs" data-id = "{{ $item->id }}"><i class="fa fa-arrow-circle-down"></i></a>
                                                                        @endif
                                                                    @endif
                                                                @endif
                                                                --}}{{--                                                                <button title="Update This Plan" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#plan{{$item->id}}" data-options="splash-2 splash-ef-12"><i class="fa fa-edit"></i></button>--}}{{--
                                                            </td>--}}
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
                                                        <td class="text-center">Unit</td>
                                                        <td class="text-center">Stock Qty</td>
                                                        <td class="text-center">Delivered Qty</td>
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
                            } );
                        } );
                    }
                });

            });

        });




        /*$('#advanced-usage').on('click',".DeActivateBuyer", function(){
            var button = $(this);
            var id = button.attr("data-id");
            var url = '';
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
        });*/

        function refresh()
        {
            window.location.href = window.location.href.replace(/#.*$/, '');
        }

        function iconChange() {
            $('#iconChange').find('i').addClass('fa-edit');
        }
    </script>
@endsection()






