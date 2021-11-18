@extends('layouts.lpd2.lpd-2-master')
@section('title')
    LPD-2
    @endsection

@section('content')
    <div class="page page-dashboard">
        <div class="pageheader">
            <h2>LPD-2 <span>// Local Purchase Division Section: 2</span></h2>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{route('lpd2.home')}}"><i class="fa fa-home"></i> LPD-2</a>
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
