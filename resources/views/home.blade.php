@extends('layouts.common.home-master')

@section('title')
    Modules
    @endsection
@section('content')
    <div class="row">
        <main class="site-wrapper">
            <div class="pt-table desktop-768">
                <div class="pt-tablecell page-home relative" style="background-image: url({{url('/images/admin/home-bg.jpg')}});
    background-position: center;
    background-size: cover;">
                    <div class="overlay"></div>

                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-md-offset-1 col-md-10 col-lg-offset-2 col-lg-8">
                                <div class="page-title  home text-center">
                                  <span class="heading-page"> Welcome to MTRIMS
                                  </span>
{{--                                    <p class="mt20">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>--}}
                                </div>
                                <div class="hexagon-menu clear">
                                    <div  @if(Auth::user()->hasPermission('administrator', Auth::user()->id))
                                          class="hexagon-item"
                                          @else
                                          class="hexagon-item hexagon-disabled"
                                        @endif>
                                        <div class="hex-item">
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                        </div>
                                        <div class="hex-item">
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                        </div>
                                        <a href="{{route('admin.home')}}"  @if(Auth::user()->hasPermission('administrator', Auth::user()->id))
                                        class="hex-content"
                                           @else
                                           class="hex-content hex-disabled"
                                            @endif>
                                            <span class="hex-content-inner">
                                                <span class="icon">
                                                    <i class="fa fa-cogs"></i>
                                                </span>
                                                <span class="title">Admin</span>
                                            </span>
                                            <svg viewBox="0 0 173.20508075688772 200" height="200" width="174" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M86.60254037844386 0L173.20508075688772 50L173.20508075688772 150L86.60254037844386 200L0 150L0 50Z" fill="#1e2530"></path></svg>
                                        </a>
                                    </div>
                                    <div @if(Auth::user()->hasPermission('lpd1', Auth::user()->id))
                                         class="hexagon-item"
                                         @else
                                         class="hexagon-item hexagon-disabled"
                                        @endif>
                                        <div class="hex-item">
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                        </div>
                                        <div class="hex-item">
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                        </div>
                                        <a href="{{route('lpd1.home')}}" @if(Auth::user()->hasPermission('lpd1', Auth::user()->id))
                                        class="hex-content"
                                           @else
                                           class="hex-content hex-disabled"
                                            @endif>
                                            <span class="hex-content-inner">
                                                <span class="icon">
                                                    <i class="fa fa-shopping-cart"></i>
                                                </span>
                                                <span class="title">LPD-1</span>
                                            </span>
                                            <svg viewBox="0 0 173.20508075688772 200" height="200" width="174" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M86.60254037844386 0L173.20508075688772 50L173.20508075688772 150L86.60254037844386 200L0 150L0 50Z" fill="#1e2530"></path></svg>
                                        </a>
                                    </div>
                                    <div @if(Auth::user()->hasPermission('lpd2', Auth::user()->id))
                                         class="hexagon-item"
                                         @else
                                         class="hexagon-item hexagon-disabled"
                                        @endif>
                                        <div class="hex-item">
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                        </div>
                                        <div class="hex-item">
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                        </div>
                                        <a href="{{route('lpd2.home')}}" @if(Auth::user()->hasPermission('lpd2', Auth::user()->id))
                                        class="hex-content"
                                           @else
                                           class="hex-content hex-disabled"
                                            @endif>
                                            <span class="hex-content-inner">
                                                <span class="icon">
                                                    <i class="glyphicon glyphicon-shopping-cart"></i>
                                                </span>
                                                <span class="title">LPD-2</span>
                                            </span>
                                            <svg viewBox="0 0 173.20508075688772 200" height="200" width="174" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M86.60254037844386 0L173.20508075688772 50L173.20508075688772 150L86.60254037844386 200L0 150L0 50Z" fill="#1e2530"></path></svg>
                                        </a>
                                    </div>
                                    <div @if(Auth::user()->hasPermission('production', Auth::user()->id))
                                         class="hexagon-item"
                                         @else
                                         class="hexagon-item hexagon-disabled"
                                        @endif>
                                        <div class="hex-item">
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                        </div>
                                        <div class="hex-item">
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                        </div>
                                        <a href="{{route('production.home')}}" @if(Auth::user()->hasPermission('production', Auth::user()->id))
                                        class="hex-content"
                                           @else
                                           class="hex-content hex-disabled"
                                            @endif>
                                            <span class="hex-content-inner">
                                                <span class="icon">
                                                    <i class="glyphicon glyphicon-tasks"></i>
                                                </span>
                                                <span class="title">Production</span>
                                            </span>
                                            <svg viewBox="0 0 173.20508075688772 200" height="200" width="174" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M86.60254037844386 0L173.20508075688772 50L173.20508075688772 150L86.60254037844386 200L0 150L0 50Z" fill="#1e2530"></path></svg>
                                        </a>
                                    </div>
                                    <div @if(Auth::user()->hasPermission('store', Auth::user()->id))
                                         class="hexagon-item"
                                         @else
                                         class="hexagon-item hexagon-disabled"
                                        @endif>
                                        <div class="hex-item">
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                        </div>
                                        <div class="hex-item">
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                        </div>
                                        <a href="{{route('store.home')}}" @if(Auth::user()->hasPermission('store', Auth::user()->id))
                                        class="hex-content"
                                           @else
                                           class="hex-content hex-disabled"
                                            @endif>
                                            <span class="hex-content-inner">
                                                <span class="icon">
                                                    <i class="fa fa-building"></i>
                                                </span>
                                                <span class="title">Store</span>
                                            </span>
                                            <svg viewBox="0 0 173.20508075688772 200" height="200" width="174" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M86.60254037844386 0L173.20508075688772 50L173.20508075688772 150L86.60254037844386 200L0 150L0 50Z" fill="#1e2530"></path></svg>
                                        </a>
                                    </div>

                                    <div
                                        @if(Auth::user()->hasPermission('management', Auth::user()->id))
                                        class="hexagon-item"
                                        @else
                                            class="hexagon-item hexagon-disabled"
                                        @endif
                                        >

                                        <div class="hex-item">
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                        </div>
                                        <div class="hex-item">
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                        </div>
                                        <a href="{{route('management.home')}}"
                                           @if(Auth::user()->hasPermission('management', Auth::user()->id))
                                           class="hex-content"
                                           @else
                                           class="hex-content hex-disabled"
                                            @endif
                                        >
                                            <span class="hex-content-inner">
                                                <span class="icon">
                                                    <i class="fa fa-institution"></i>
                                                </span>
                                                <span class="title">Management</span>
                                            </span>
                                            <svg viewBox="0 0 173.20508075688772 200" height="200" width="174" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M86.60254037844386 0L173.20508075688772 50L173.20508075688772 150L86.60254037844386 200L0 150L0 50Z" fill="#1e2530"></path></svg>
                                        </a>
                                    </div>
                                    <div
                                        @if(Auth::user()->hasPermission('merchandising', Auth::user()->id))
                                        class="hexagon-item"
                                            @else
                                            class="hexagon-item hexagon-disabled"
                                            @endif

                                    >
                                        <div class="hex-item">
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                        </div>
                                        <div class="hex-item">
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                        </div>
                                        <a href="{{route('merchandising.home')}}"
                                           @if(Auth::user()->hasPermission('merchandising', Auth::user()->id))
                                           class="hex-content"
                                           @else
                                           class="hex-content hex-disabled"
                                               @endif
                                        >
                                            <span class="hex-content-inner">
                                                <span class="icon">
                                                    <i class="fa fa-truck"></i>
                                                </span>
                                                <span class="title">Merchandising</span>
                                            </span>
                                            <svg viewBox="0 0 173.20508075688772 200" height="200" width="174" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M86.60254037844386 0L173.20508075688772 50L173.20508075688772 150L86.60254037844386 200L0 150L0 50Z" fill="#1e2530"></path></svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    {{--<div class="page page-dashboard">
        <div class="row">
            <div class="pageheader">
--}}{{--                <h2>Module Selection</h2>--}}{{--
                <br>
            </div>
        </div>
        <!-- cards row -->
        <div class="row">
            <!-- col -->
            <div class="card-container col-lg-4 col-sm-6 col-sm-12">
                <div class="card">
                    <div class="front bg-greensea">
                        <!-- row -->
                        <div class="row">
                            <!-- col -->
                            <div class="col-xs-4">
                                <i class="fa fa-cogs fa-4x"></i>
                            </div>
                            <!-- /col -->
                            <!-- col -->
                            <div class="col-xs-8">
                                <p class="text-elg text-left text-strong mb-0">Admin</p>
                                <span>Administrative Settings</span>
                            </div>
                            <!-- /col -->
                        </div>
                        <!-- /row -->
                    </div>
                    <div class="back bg-greensea">
                        <!-- row -->
                        <div class="row">
                            <!-- col -->
                            <div class="col-xs-12">
                                <a href="{{route('admin.home')}}"><i class="fa fa-chain-broken fa-2x"></i> Login</a>
                            </div>
                            <!-- /col -->
                        </div>
                        <!-- /row -->
                    </div>
                </div>
            </div>
            <!-- /col -->

            <!-- col -->
            <div class="card-container col-lg-4 col-sm-6 col-sm-12">
                <div class="card">
                    <div class="front bg-lightred">

                        <!-- row -->
                        <div class="row">
                            <!-- col -->
                            <div class="col-xs-4">
                                <i class="fa fa-shopping-cart fa-4x"></i>
                            </div>
                            <!-- /col -->
                            <!-- col -->
                            <div class="col-xs-8">
                                <p class="text-elg text-strong mb-0">LPD-1</p>
                                <span>Local Purchase Division One</span>
                            </div>
                            <!-- /col -->
                        </div>
                        <!-- /row -->
                    </div>
                    <div class="back bg-lightred">
                        <!-- row -->
                        <div class="row">
                            <!-- col -->
                            <div class="col-xs-12">
                                <a href="{{route('lpd1.home')}}"><i class="fa fa-chain-broken fa-2x"></i> Login</a>
                            </div>
                            <!-- /col -->
                        </div>
                        <!-- /row -->
                    </div>
                </div>
            </div>
            <!-- /col -->
            <!-- col -->
            <div class="card-container col-lg-4 col-sm-6 col-sm-12">
                <div class="card">
                    <div class="front bg-lightred">

                        <!-- row -->
                        <div class="row">
                            <!-- col -->
                            <div class="col-xs-4">
                                <i class="fa fa-shopping-cart fa-4x"></i>
                            </div>
                            <!-- /col -->
                            <!-- col -->
                            <div class="col-xs-8">
                                <p class="text-elg text-strong mb-0">LPD-2</p>
                                <span>Local Purchase Division Two</span>
                            </div>
                            <!-- /col -->
                        </div>
                        <!-- /row -->

                    </div>
                    <div class="back bg-lightred">
                        <!-- row -->
                        <div class="row">
                            <!-- col -->
                            <div class="col-xs-12">
                                <a href="{{route('lpd2.home')}}"><i class="fa fa-chain-broken fa-2x"></i> Login</a>
                            </div>
                            <!-- /col -->

                        </div>
                        <!-- /row -->

                    </div>
                </div>
            </div>
            <!-- /col -->

            <!-- col -->
            <div class="card-container col-lg-4 col-sm-6 col-sm-12">
                <div class="card">
                    <div class="front bg-blue">

                        <!-- row -->
                        <div class="row">
                            <!-- col -->
                            <div class="col-xs-4">
                                <i class="fa fa-tasks fa-4x"></i>
                            </div>
                            <!-- /col -->
                            <!-- col -->
                            <div class="col-xs-8">
                                <p class="text-elg text-strong mb-0">Production</p>
                                <span>Production Plan</span>
                            </div>
                            <!-- /col -->
                        </div>
                        <!-- /row -->
                    </div>
                    <div class="back bg-blue">
                        <!-- row -->
                        <div class="row">
                            <!-- col -->
                            <div class="col-xs-12">
                                <a href=#><i class="fa fa-chain-broken fa-2x"></i> Login</a>
                            </div>
                            <!-- /col -->
                        </div>
                        <!-- /row -->
                    </div>
                </div>
            </div>
            <!-- /col -->
            <!-- col -->
            <div class="card-container col-lg-4 col-sm-6 col-sm-12">
                <div class="card">
                    <div class="front bg-amethyst">
                        <!-- row -->
                        <div class="row">
                            <!-- col -->
                            <div class="col-xs-4">
                                <i class="fa fa-building fa-4x"></i>
                            </div>
                            <!-- /col -->
                            <!-- col -->
                            <div class="col-xs-8">
                                <p class="text-elg text-left text-strong mb-0">Store</p>
                                <span>Store Management</span>
                            </div>
                            <!-- /col -->
                        </div>
                        <!-- /row -->
                    </div>
                    <div class="back bg-amethyst">
                        <!-- row -->
                        <div class="row">
                            <!-- col -->
                            <div class="col-xs-12">
                                <a href=#><i class="fa fa-chain-broken fa-2x"></i> Login</a>
                            </div>
                            <!-- /col -->
                        </div>
                        <!-- /row -->
                    </div>
                </div>
            </div>
            <!-- /col -->
            <!-- col -->
            <div class="card-container col-lg-4 col-sm-6 col-sm-12">
                <div class="card">
                    <div class="front bg-danger">
                        <!-- row -->
                        <div class="row">
                            <!-- col -->
                            <div class="col-xs-4">
                                <i class="fa fa-institution fa-4x"></i>
                            </div>
                            <!-- /col -->
                            <!-- col -->
                            <div class="col-xs-8">
                                <p class="text-elg text-left text-strong mb-0">Management</p>
                                <span>Management Topics</span>
                            </div>
                            <!-- /col -->
                        </div>
                        <!-- /row -->
                    </div>
                    <div class="back bg-danger">
                        <!-- row -->
                        <div class="row">
                            <!-- col -->
                            <div class="col-xs-12">
                                <a href=#><i class="fa fa-chain-broken fa-2x"></i> Login</a>
                            </div>
                            <!-- /col -->
                        </div>
                        <!-- /row -->
                    </div>
                </div>
            </div>
            <!-- /col -->

            <!-- col -->
            <div class="card-container col-lg-4 col-sm-6 col-sm-12">
                <div class="card">
                    <div class="front bg-warning">

                        <!-- row -->
                        <div class="row">
                            <!-- col -->
                            <div class="col-xs-4">
                                <i class="fa fa-database fa-4x"></i>
                            </div>
                            <!-- /col -->
                            <!-- col -->
                            <div class="col-xs-8">
                                <p class="text-elg text-strong mb-0">Audit</p>
                                <span>Audit Checkup</span>
                            </div>
                            <!-- /col -->
                        </div>
                        <!-- /row -->

                    </div>
                    <div class="back bg-warning">
                        <!-- row -->
                        <div class="row">
                            <!-- col -->
                            <div class="col-xs-12">
                                <a href=#><i class="fa fa-chain-broken fa-2x"></i> Login</a>
                            </div>
                            <!-- /col -->

                        </div>
                        <!-- /row -->

                    </div>
                </div>
            </div>
            <!-- /col -->

            <!-- col -->
            <div class="card-container col-lg-4 col-sm-6 col-sm-12">
                <div class="card">
                    <div class="front bg-blue">
                        <!-- row -->
                        <div class="row">
                            <!-- col -->
                            <div class="col-xs-4">
                                <i class="fa fa-truck fa-4x"></i>
                            </div>
                            <!-- /col -->
                            <!-- col -->
                            <div class="col-xs-8">
                                <p class="text-elg text-strong mb-0">Merchandising</p>
                                <span>Merchandising Section</span>
                            </div>
                            <!-- /col -->
                        </div>
                        <!-- /row -->

                    </div>
                    <div class="back bg-blue">
                        <!-- row -->
                        <div class="row">
                            <!-- col -->
                            <div class="col-xs-12">
                                <a href=#><i class="fa fa-chain-broken fa-2x"></i> Login</a>
                            </div>
                            <!-- /col -->

                        </div>
                        <!-- /row -->

                    </div>
                </div>
            </div>
            <!-- /col -->

        </div>

    </div>--}}
@endsection
