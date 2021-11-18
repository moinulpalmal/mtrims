@extends('layouts.store.store-master')
@section('title')
    Delivery PO List
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
            <h2>Store <span>// Ready Purchase Order List</span></h2>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{route('store.home')}}"><i class="fa fa-home"></i> Store</a>
                    </li>
                    <li>
                        <a href="{{route('store.delivery.trims.po-list')}}"> Ready Purchase Order List</a>
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
                        <h1 class="custom-font"><strong>Purchase Order List</strong> <span>// Current Ready Purchase Order List</span></h1>
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
                            <h3 class="text-success text-center">{{Session::get('message')}}</h3>
                            <table class="table table-hover table-bordered table-condensed table-responsive" id="advanced-usage">
                                <thead>
                                <tr style="background-color: #1693A5; color: white;">
                                    <th class="text-center">Sl No.</th>
                                   {{-- <th class="text-center">Trims Type.</th>--}}
                                    <th class="text-center">LPD PO No.</th>
                                    <th class="text-center">HTL Job No.</th>
                                    <th class="text-center">Buyer Name</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($i = 1)
                                @foreach($deliveryPOList as $item)
                                    <tr>
                                        <td class="text-center">{{$i++}}</td>
                                        {{--<td class="text-center">{{$item->trims_type_name}}</td>--}}
                                        <td class="text-center">LPD - {{$item->lpd}} -{{$item->lpd_po_no}}</td>
                                        <td class="text-center">HTL - {{$item->job_no}}\{{$item->job_year}}</td>
{{--                                        <td class="text-center">HTL- {{ (App\Helpers\Helper::IDwiseData('trims_types','id',$item->trims_type_id))->short_name }}{{$item->job_year}}/{{$item->job_no}}</td>--}}
                                        <td class="text-center">{{ $item->buyer_name }}</td>
                                      <td class="text-center">
                                          @if(Auth::user()->hasTaskPermission('createchallantrims', Auth::user()->id))
                                            <a title="Create Delivery Challan" href="{{route('store.delivery.trims.po.challan',['id'=>$item->purchase_order_master_id])}}" class="btn btn-info btn-xs">
                                                <i class="fa fa-truck"></i>
                                            </a>
                                              @endif
{{--
                                              <a title="Create Delivery Challan" href="{{route('store.delivery.trims.po.challan',['id'=>$item->purchase_order_master_id])}}" class="btn btn-info btn-xs">
                                                  <i class="fa fa-truck"></i>
                                              </a>--}}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td class="text-center">Sl No.</td>
                                        {{-- <th class="text-center">Trims Type.</th>--}}
                                        <td class="text-center">LPD PO No.</td>
                                        <td class="text-center">HTL Job No.</td>
                                        <td class="text-center">Buyer Name</td>
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
    </script>
@endsection()


