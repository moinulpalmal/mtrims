@extends('layouts.production.production-master')

@section('title')
    Production Plan
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
            <h2>Production Plan <span>Production Plan Setup</span></h2>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{route('production.home')}}"><i class="fa fa-home"></i> Production</a>
                    </li>
                    <li>
                        <a href="{{route('production.search.lpd-po')}}"> LPD PO Based Search </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- row -->
        <div class="row">

        </div>
        <!-- /row -->
    </div>
@endsection


@section('pageVendorScripts')

@endsection
@section('pageScripts')
    {{--    <script src="{{ asset('back-end/assets/MyJS/jquery.min.js') }}"></script>--}}

    <script>
        $(window).load(function(){
            $('#advanced-usage').DataTable({
                "scrollY":        "1000px",
                "scrollCollapse": true,
                "paging":         false
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



