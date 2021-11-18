@extends('layouts.store.store-master')
@section('title')
    Trims Delivery
@endsection

@section('content')
    <style type="text/css">
        /*th{
            background-color: #0689bd;
            color: white;
            !*font-size: x-small;
            height: 10px !important;*!
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
            <h2>Store <span>// Trims Store</span></h2>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{route('store.home')}}"><i class="fa fa-home"></i> Store</a>
                    </li>
                    <li>
                        <a href="{{route('store.delivery.trims')}}"> Trims Delivery</a>
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
                        <h1 class="custom-font"><strong>Trims Delivery</strong> <span>// Challan List</span></h1>
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
                            <table class="table table-hover table-bordered table-condensed table-responsive" id="advanced-usage">
                                <thead>
                                    <tr style="background-color: #1693A5; color: white;">
                                        <th class="text-center">Sl No.</th>
                                        <th class="text-center">Challan No.</th>
                                        <th class="text-center">Challan Date</th>
                                        <th class="text-center">LPD PO No.</th>
                                        <th class="text-center">Buyer Name</th>
                                        <th class="text-center">Delivery Location</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php($i = 1)
                                @foreach($deliveryMasters as $item)
                                    <tr @if($item->status == "AP") class="bg-success" @elseif($item->status == "A") class="bg-warning" @else class="" @endif>
                                        <td class="text-center">{{$i++}}</td>
                                        <td class="text-center">{{$item->id}}</td>
                                        <td class="text-center">{{\Carbon\Carbon::parse($item->challan_date)->format('d/m/Y')}}</td>
                                        <td class="text-center">
                                            <strong>LPD-{{(App\Helpers\Helper::IDwiseData('purchase_order_masters','id', $item->purchase_order_master_id))->lpd}}-PO No:</strong> {{(App\Helpers\Helper::IDwiseData('purchase_order_masters','id', $item->purchase_order_master_id))->lpd_po_no}}
                                        </td>
                                        <td class="text-center">{{(App\Helpers\Helper::IDwiseData('buyers','id', (App\Helpers\Helper::IDwiseData('purchase_order_masters','id', $item->purchase_order_master_id))->buyer_id))->name}}</td>
                                        <td class="text-center">{{(App\Helpers\Helper::IDwiseData('stores','id', $item->store_id))->name}}</td>
                                        <td class="text-center">
                                            <a title="Detail" href="{{route('store.delivery.trims.challan.detail',['id'=>$item->id])}}" class="btn btn-info btn-xs">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td class="text-center">Sl No.</td>
                                        <td class="text-center">Challan No.</td>
                                        <td class="text-center">Challan Date</td>
                                        <td class="text-center">LPD PO No.</td>
                                        <td class="text-center">Buyer Name</td>
                                        <td class="text-center">Delivery Location</td>
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

@section('pageScripts')
    <script>
        $(window).load(function(){
            /*$('#advanced-usage').DataTable({

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

        function refresh()
        {
            window.location.href = window.location.href.replace(/#.*$/, '');
        }

        function iconChange() {

            $('#iconChange').find('i').addClass('fa-edit');

        }

        /*$(document).ready(function() {
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

        } );*/
    </script>
@endsection()


