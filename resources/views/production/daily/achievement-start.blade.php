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
    </style>
    <div class="page page-dashboard">
        <div class="pageheader ">
            <h2>Production Plan <span>Achievement Date Form</span></h2>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{route('production.home')}}"><i class="fa fa-home"></i> Production</a>
                    </li>
                    <li>
                        <a href="{{route('production.plan.daily.achievement')}}"> Daily Production Achievement</a>
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
                        <h1 class="custom-font"><strong>Daily Production Achievement</strong> Form</h1>
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
                                    <li>
                                        <a role="button" tabindex="0" class="tile-fullscreen">
                                            <i class="fa fa-expand"></i> Fullscreen
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
                        <form method="post" name="PurchaseOrderForm" onsubmit="return validateForm()" action="{{route('production.plan.daily.achievement.get')}}" enctype="multipart/form-data" >
                            {{ csrf_field() }}
                            <div class="row no-padding">
                                <!-- col -->
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <!-- tile -->
                                    <section class="tile">
                                        <!-- tile header -->
                                        <div class="tile-header dvd dvd-btm bg-greensea">
                                            <h1 class="custom-font"><strong>Provide Achievement Date</strong></h1>
                                            <a><button id="iconChange" class="pull-right btn-info btn-xs" type="submit"><i class="fa fa-check"></i></button></a>
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
                                                <div class="col-md-5 col-sm-12"></div>
                                                <div class="col-md-2 col-sm-12 no-padding">
                                                    <div class="form-group">
                                                        <label for="LPD_PO" class="control-label">Production Plan Achievement Date</label>
                                                        <input type="date" class="form-control" name="production_date" id="LPD_PO" required value="{{ old('production_date') }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-5 col-sm-12"></div>
                                            </div>
                                        </div>
                                        <!-- /tile body -->
                                    </section>
                                    <!-- /tile -->
                                </div>
                                <!-- /col -->
                                <!-- col -->
                                <!-- /col -->
                            </div>
                        </form>
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





