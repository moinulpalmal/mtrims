@extends('layouts.merchandising.merchandising-master')
@section('title')
    PO Search
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
            <h2>Merchandising <span>// Hamza Trims Limited</span></h2>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{route('merchandising.home')}}"><i class="fa fa-home"></i> Merchandising</a>
                    </li>
                    <li>
                        <a href="{{route('merchandising.purchase.order.search')}}"> Purchase Order Search</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- row -->
        <form method="post" id="PurchaseOrderFormID" name="PurchaseOrderForm" {{--onsubmit="return validateForm()"--}} {{--action="{{route('merchandising.purchase.order.search.get')}}"--}} enctype="multipart/form-data" >
            {{ csrf_field() }}
            <div class="row">
                <!-- col -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <!-- tile -->
                    <section class="tile">
                        <!-- tile header -->
                        <div class="tile-header dvd dvd-btm">
                            <h1 class="custom-font"><strong>Purchase Order Search Form</strong></h1>
{{--                            <a><button onclick="refresh()" class="pull-right btn-warning btn-xs" ><i class="fa fa-refresh"></i></button></a>--}}
                        </div>
                        <!-- /tile header -->
                        <!-- tile body -->
                        <div class="tile-body">
                            <!-- row -->
                            <div class="row">
                                <!-- col -->
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <!-- tile -->
                                    <section class="tile">
                                        <!-- tile header -->
                                        <div class="tile-header dvd dvd-btm">
                                            <h1 class="custom-font"><strong>Purchase Order</strong> Master Information</h1>
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
                                                <div class="col-md-3  no-padding">

                                                </div>
                                                <div class="col-md-3  no-padding">
                                                    <div class="form-group">
                                                        <label for="YarnTypeName" class="control-label">Select LPD</label>
                                                        <select class="form-control" name="lpd"  id="YarnTypeName" style="width: 100% !important; height: 100% !important;" required>
                                                            <option value="" selected="selected">- - - Select - - -</option>
                                                            <option value="1" >LPD-1</option>
                                                            <option value="2" >LPD-2</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 no-padding">
                                                    <div class="form-group">
                                                        <label for="LPD_PO" class="control-label">LPD PO No.</label>
                                                        <input type="number" class="form-control" name="lpd_po_no" id="LPD_PO" placeholder="2485" required value="{{ old('lpd_po_no') }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-3  no-padding">

                                                </div>
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
                            <!-- /row -->
                        </div>
                        <!-- /tile body -->
                    </section>
                    <!-- /tile -->
                </div>
                <!-- /col -->
            </div>
        </form>
        <!-- /row -->
    </div>


@endsection

@section('pageScripts')
    <script>
        function refresh()
        {
            window.location.href = window.location.href.replace(/#.*$/, '');
        }

        $(window).load(function(){
            sessionStorage.clear();
        });

        $(function(){
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
            });
            $('#PurchaseOrderFormID').submit(function(e){
                e.preventDefault();
                var data = $(this).serialize();
                //var id = $('#DetailID').val();
                //var masterId = $('#MasterID').val();
                //console.log(masterId);
                //return;
                var url = '{{ route('merchandising.purchase.order.search.check') }}';
                //console.log(data);
                $.ajax({
                    url: url,
                    method:'POST',
                    data:data,
                    success:function(data){
                        if(data){
							//var pid = data.id;
                            var url = '{{ route('merchandising.purchase.order.detail', ['id' =>  'pid']) }}';
							url = url.replace('pid', data.id);
							//console.log(url);
							//return;
                            //window.location = "merchandising/purchase/order/detail/" + data.id
                            //console.log(data.id);
							document.location.href = url;
                        }
                        else{
                            swal({
                                title: "No Data!",
                                text: "No purchase order found!",
                                icon: "warning",
                                button: "Ok!",
                                className: "myClass",
                            });
                        }

                    },
                    error:function(error){
                        console.log(error);
                        swal({
                            title: "Somethin went wrong!",
                            text: "Please Check Your Data!",
                            icon: "error",
                            button: "Ok!",
                            className: "myClass",
                        });
                    }
                })

            })
        });

    </script>
@endsection

