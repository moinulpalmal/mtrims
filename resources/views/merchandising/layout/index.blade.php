@extends('layouts.merchandising.merchandising-master')
@section('title')
    Merchandising
    @endsection

@section('content')
    <div class="page page-dashboard">
        <div class="pageheader">
            <h2>Merchandising <span>// Hamza Trims Limited</span></h2>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{route('merchandising.home')}}"><i class="fa fa-home"></i> Merchandising</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    @endsection
