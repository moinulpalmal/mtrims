@extends('layouts.store.store-master')
@section('title')
    Trims Delivery
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
            <h2>Store <span>// Trims Store</span></h2>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{route('store.home')}}"><i class="fa fa-home"></i> Store</a>
                    </li>
                    <li>
                        <a href="{{route('store.report.trims.delivery')}}"> Trims Delivery Report</a>
                    </li>
                    <li>
                        <a href="#"> Report</a>
                    </li>
                    {{--<li>
                        <a href="{{route('store.delivery.trims.challan.detail', ['id' => $master->id])}}"> Challan No: {{$master->id}}</a>
                    </li>
                    <li>
                        <a href="#"> Print Challan</a>
                    </li>--}}
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
                        <h1 class="custom-font"><strong>Trims Delivery</strong> <span>// Report Section</span></h1>
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
                        <!-- col -->
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <!-- tile -->
                            <form method="post" id="FactoryAdd" action="{{route('store.report.trims.delivery.generate')}}" name="MachineForm" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <section class="tile">
                                    <!-- tile header -->
                                    <div class="tile-header dvd dvd-btm">
                                        <h1 class="custom-font"><strong>Report Setup</strong> Generate Form</h1>
                                        <a><button title="Generate Report" id="iconChange" class="pull-right btn-info btn-xs" type="submit"><i class="fa fa-check"></i></button></a>
                                    </div>
                                    <!-- /tile header -->
                                    <!-- tile body -->
                                    <div class="tile-body">
                                        <div class="row" style="padding: 0px 15px;">
                                            <div class="col-md-4 no-padding">
                                                <div class="form-group">
                                                    <label for="TrimsType" class="control-label">Select Trims Type</label>
                                                    <select id="TrimsType" class="form-control chosen-select" name="trims_type" style="width: 100%;">
                                                        <option value="A" selected ="selected">All</option>
{{--                                                        <option value="A">All</option>--}}
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
                                                    <label for="TypeName" class="control-label">From Date</label>
                                                    <input type="date" class="form-control" name="from_date" id="TypeName"  required>
                                                </div>
                                            </div>
                                            <div class="col-md-4 no-padding">
                                                <div class="form-group">
                                                    <label for="Remarks" class="control-label">To Date</label>
                                                    <input type="date" class="form-control" name="to_date" id="Remarks" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /tile body -->
                                </section>
                                <!-- /tile -->
                            </form>
                        </div>
                        <!-- /col -->
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
            $('#advanced-usage').DataTable({

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



