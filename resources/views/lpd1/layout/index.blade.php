@extends('layouts.lpd1.lpd-1-master')
@section('title')
    LPD-1
    @endsection
@section('content')
    <div class="page page-dashboard">
        <div class="pageheader">
            <h2>LPD-1 <span>// Local Purchase Division: 1</span></h2>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{route('lpd1.home')}}"><i class="fa fa-home"></i> LPD-1</a>
                    </li>
                </ul>
                {{--<div class="page-toolbar">
                    <a role="button" tabindex="0" class="btn btn-lightred no-border pickDate">
                        <i class="fa fa-calendar"></i>&nbsp;&nbsp;<span></span>&nbsp;&nbsp;<i class="fa fa-angle-down"></i>
                    </a>
                </div>--}}
            </div>
        </div>
    </div>
    @endsection
