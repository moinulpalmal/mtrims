@extends('layouts.lpd2.lpd-2-master')
@section('title')
    Proforma Invoice
@endsection

@section('content')
    <style type="text/css">
       /* th{
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
       .redRow {
            background-color: #F0AD4E !important;
        }
    </style>
    <div class="page page-dashboard">
        <div class="pageheader">
            <h2>LPD-2 <span>// Local Purchase Division Section: 2</span></h2>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{route('lpd2.home')}}"><i class="fa fa-home"></i> LPD-2</a>
                    </li>
                    <li>
                        <a href="{{route('lpd2.proforma-invoice.po-list')}}"> Pending PO List</a>
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
                        <h1 class="custom-font"><strong>Purchase Order List</strong> <span>// Pending Proforma Invoices</span></h1>
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
                                        <a onclick="loadDataTable()" role="button" tabindex="0" class="tile-refresh">
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
                            {{-- <h3 class="text-success text-center">{{Session::get('message')}}</h3> --}}
                            <table class="table table-hover table-bordered table-condensed table-responsive" id="advanced-usage">
                                <thead>
                                <tr style="background-color: #1693A5; color: white;">
                                    <th class="text-center">LPD PO No.</th>
                                    <th class="text-center">HTL Job No.</th>
                                    <th class="text-center">Order Date</th>
                                    <th class="text-center">Buyer Name</th>
                                    <th class="text-center">Is PI Generated?</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                {{-- @php($i = 1)
                                @foreach($purchaseOrders as $item)
                                    <tr @if($item->pi_generation_activated == true) class="bg-warning" @else class="bg-success" @endif >
                                        <td class="text-center">{{$i++}}</td>
                                        <td class="text-center">{{$item->lpd_po_no}}</td>
                                        <td class="text-center">HTL-{{$item->job_year}}/{{$item->job_no}}</td>
                                        <td class="text-center">{{\Carbon\Carbon::parse($item->po_date)->format('d/m/Y')}}</td>
                                        <td class="text-left">{{ (App\Helpers\Helper::IDwiseData('buyers','id',$item->buyer_id))->name }}</td>
                                        <td class="text-center">
                                            <a title="PI List" href="{{route('lpd2.proforma-invoice.po.pi-list',['id'=>$item->id])}}" class="btn btn-info btn-xs">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            
                                        </td>
                                    </tr>
                                @endforeach --}}
                                </tbody>
                                <tfoot>
                                <tr>
                                    {{-- <td class="text-center">Sl No.</td> --}}
                                    <td class="text-center">LPD PO No.</td>
                                    <td class="text-center">HTL Job No.</td>
                                    <td class="text-center">Order Date</td>
                                    <td class="text-center">Buyer Name</td>
                                    <td class="text-center">Is PI Generated?</td>
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
<script src="{{ asset('/js/common.js') }}"></script>
    <script>
        var po_list_table = $('#advanced-usage').DataTable({
            "lengthMenu": [[10, 50, 100, 200, -1], [10, 50, 100, 200, "All"]]
        });

        $(window).load(function(){
            loadDataTable();

            $(document).ready(function() {
                // Setup - add a text input to each footer cell
                $('#advanced-usage tfoot td').each( function () {
                    var title = $(this).text();
                    $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
                } );

                // DataTable
                // var table = $('#advanced-usage').DataTable({
                //     initComplete: function () {
                //         // Apply the search
                //         this.api().columns().every( function () {
                //             var that = this;
                //             $( 'input', this.footer() ).on( 'keyup change clear', function () {
                //                 if ( that.search() !== this.value ) {
                //                     that
                //                         .search( this.value )
                //                         .draw();
                //                 }
                //             } );
                //         } );
                //     }
                // });

            } );
            
        });


        function loadDataTable() {
            po_list_table.destroy();
            var free_table = '<tr><td class="text-center" colspan="6">--- Please Wait... Loading Data  ----</td></tr>';
            $('#advanced-usage').find('tbody').append(free_table);
           // $('tbody').html(free_table);
           po_list_table = $("#advanced-usage").DataTable({
                ajax: {
                    url: "/mtrims/public/api/lpd2/proforma-invoice/active-po-list",
                    dataSrc: ""
                },
                columns: [
                    {
                        data: "lpd_po_no",
                        render: function (data) {
                            return "<p class ='text-center'>"+ data +"</p>";
                        }
                    },
                    {
                        render: function (data,type,item) {
                            return "<p class = 'text-center'>"+'HTL-'+ item.job_year + '/' + item.job_no +"</p>";
                        }
                    },
                    {
                        data: "po_date",
                        render: function (data) {
                            return "<p class ='text-center'>"+ returnBDStringFormatDate(data) +"</p>";
                        }
                    },
                    {
                        data: "buyer_name",
                        render: function (data) {
                            return "<p class ='text-left'>"+ data +"</p>";
                        }
                    },
                    {
                        render: function(row, data, api_item) {
                            if(api_item.pi_generation_activated === 0){
                                return "<p class ='text-center'><label class='label label-success'>Yes</label></p>";
                            }
                            else if(api_item.pi_generation_activated === 1){
                                return "<p class ='text-center '><label class='label label-warning'>No</label></p>";
                            }
                            else{
                                return "<p class = 'text-center'></p>";
                            }
                        }
                    },
                    {
                        /*data: "id",*/
                        render: function(data, type, api_item) {
                            return "<p class='text-center'><a title= 'Show Detail' class= 'ShowDetail btn btn-info btn-xs' data-toggle='modal' data-target='#FactoryModal' data-options='splash-2 splash-ef-12' data-id = "+ api_item.id +"><i class='fa fa-eye'></i></a>" +"</p>"
                        }
                    }
                ],

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
        }


        $('#advanced-usage').on('click',".ShowDetail", function(){
            var button = $(this);
            var id = button.attr("data-id");
            var url = '{{ route('lpd2.proforma-invoice.po.pi-list', ['id' =>  'ListID']) }}';
            url = url.replace('ListID', id);
            window.open(url, "_blank");

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

