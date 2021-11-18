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
                        <a href="{{route('production.plan.daily.master')}}"> Production Plan Setup</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- row -->
        <div class="row">
            <!-- col -->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <!-- tile -->
                <form method="post" id="FactoryAdd" name="MachineForm" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <section class="tile">
                        <!-- tile header -->
                        <div class="tile-header dvd dvd-btm">
                            <h1 class="custom-font"><strong>Production Plan Setup</strong> Insert/Update Form</h1>
                            @if(Auth::user()->hasTaskPermission('ppapproval', Auth::user()->id))
                                <a><button id="iconChange" class="pull-right btn-info btn-xs" type="submit"><i class="fa fa-check"></i></button></a>
                            @endif
                        </div>
                        <!-- /tile header -->
                        <!-- tile body -->
                        <div class="tile-body">
                            <input type="hidden" id="HiddenFactoryID" name="id">
                            <div class="row" style="padding: 0px 15px;">
                                {{--<div class="col-md-2 no-padding">
                                    <div class="form-group">
                                        <label for="TMachine" class="control-label">Total Machine</label>
                                        <input type="number" class="form-control" name="total_machine" id="TMachine" required>
                                    </div>
                                </div>
                                <div class="col-md-2 no-padding">
                                    <div class="form-group">
                                        <label for="TRMachine" class="control-label">Total Running Machine</label>
                                        <input type="number" class="form-control" name="total_running_machine" id="TRMachine" required>
                                    </div>
                                </div>--}}
                                <div class="col-md-1 no-padding">
                                    <div class="form-group">
                                        <label for="PDate" class="control-label">Production Date</label>
                                        <input type="date" class="form-control" name="production_date" id="PDate" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3 no-padding">
                                    <div class="form-group">
                                        <label for="MCost" class="control-label">Average Raw Materials Cost USD($)</label>
                                        <input type="number" class="form-control" min="1" name="material_cost_in_usd" id="MCost">
                                    </div>
                                </div>
                                <div class="col-md-3 no-padding">
                                    <div class="form-group">
                                        <label for="MCCost" class="control-label">Labour, Utility & O/H Cost per day/ Machine Cost USD($)</label>
                                        <input type="number" class="form-control" min="1" name="machine_cost_in_usd" id="MCCost" required>
                                    </div>
                                </div>
                                <div class="col-md-5 no-padding">
                                    <div class="form-group">
                                        <label for="Remarks" class="control-label">Remarks</label>
                                        <input type="text" class="form-control" name="remarks" id="Remarks">
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
            <!-- col -->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <!-- tile -->
                <section class="tile">
                    <!-- tile header -->
                    <div class="tile-header dvd dvd-btm">
                        <h1 class="custom-font"><strong>Machine List</strong> List</h1>
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
                            <table class="table table-hover table-bordered table-condensed" id="advanced-usage">
                                <thead>
                                <tr style="background-color: #1693A5; color: white;">
                                    <th class="text-center">Sl No.</th>
                                    <th class="text-center">Production Date</th>
                                    {{--<th class="text-center">Total M\C</th>
                                    <th class="text-center">Running M\C</th>
                                    <th class="text-center">Idle M\C</th>--}}
                                    <th class="text-center">Labour, Utility & O/H Cost per day/ Machine</th>
                                    <th class="text-center">Average Raw Materials Cost</th>
                                    <th class="text-center">Total Cost</th>
                                    <th class="text-center">Remarks</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($i = 1)
                                @foreach($productionPlans as $item)
                                    <tr>
                                        <td class="text-center">{{$i++}}</td>
                                        <td class="text-center">{!! \Carbon\Carbon::parse($item->production_date)->format('d/m/Y')  !!}</td>
                                        {{--<td class="text-right">{{$item->total_machine}}</td>
                                        <td class="text-right">{{$item->total_running_machine}}</td>
                                        <td class="text-right">{{$item->total_machine-$item->total_running_machine}}</td>--}}
                                        <td class="text-right">$ {{$item->machine_cost_in_usd}}</td>
                                        <td class="text-right">$ {{$item->material_cost_in_usd}}</td>
                                        <td class="text-right">$ {{$item->machine_cost_in_usd + $item->material_cost_in_usd}}</td>
                                        <td class="text-right">{!! $item->remarks !!}</td>
                                        <td class="text-center">
                                            @if(Auth::user()->hasTaskPermission('ppapproval', Auth::user()->id))
                                            <a onclick="iconChange()" data-id = "{{ $item->id }}" class="EditFactory btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>
                                            @endif
                                            <a target href="{{route('production.plan.daily.master.plan.report', ['id' => $item->id])}}" title="Production Plan Report" class ="btn btn-danger btn-xs">
                                                <i class="fa fa-file-pdf-o"></i>
                                            </a>
                                            <a target href="{{route('production.plan.daily.master.achievement.report', ['id' => $item->id])}}" title="Production Achievement Report" class ="btn btn-success btn-xs">
                                                <i class="fa fa-file-pdf-o"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
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


@section('pageVendorScripts')

@endsection
@section('pageScripts')
    {{--    <script src="{{ asset('back-end/assets/MyJS/jquery.min.js') }}"></script>--}}

    <script>
        $(window).load(function(){
            $('#advanced-usage').DataTable({

            });
        });

        function validateForm() {

            var trims_type = document.forms["PurchaseOrderForm"]["trims_type"].value;

            if(trims_type == ""){
                swal({
                    title: "Select Trims Type!",
                    icon: "warning",
                    button: "Ok!",
                });
                return false;
            }

            return true;
        }

        $(function(){
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
            });
            $('#FactoryAdd').submit(function(e){
                e.preventDefault();
                var data = $(this).serialize();
                var id = $('#HiddenFactoryID').val();
                var url = '{{ route('production.plan.daily.master.save') }}';


                //var total_machine = document.forms["MachineForm"]["total_machine"].value;

                if(false){
                    swal({
                        title: "Total Machine Required!",
                        icon: "warning",
                        button: "Ok!",
                    });
                    return false;
                }
                else{
                    //console.log(data);
                    $.ajax({
                        url: url,
                        method:'POST',
                        data:data,
                        success:function(data){
                            //console.log(data);
                            if(id)
                            {
                                swal({
                                    title: "Data Updated Successfully!",
                                    icon: "success",
                                    button: "Ok!",
                                }).then(function (value) {
                                    if(value){
                                        window.location.href = window.location.href.replace(/#.*$/, '');
                                    }
                                });
                            }
                            else
                            {
                                swal({
                                    title: "Data Inserted Successfully!",
                                    icon: "success",
                                    button: "Ok!",
                                }).then(function (value) {
                                    if(value){
                                        window.location.href = window.location.href.replace(/#.*$/, '');
                                    }
                                });
                            }
                        },
                        error:function(error){
                            console.log(error);
                            swal({
                                title: "Data Not Saved!",
                                text: "Please Check Your Data!",
                                icon: "error",
                                button: "Ok!",
                                className: "myClass",

                            });
                        }
                    })
                }



            })
        });
        $('#advanced-usage').on('click',".EditFactory", function(){
            var button = $(this);

            var FactoryID = button.attr("data-id");


            var url = '{{ route('production.plan.daily.master.edit') }}';
            $.ajax({
                url: url,
                method:'POST',
                data:{id: FactoryID},
                success:function(data){
                    $('input[name=machine_cost_in_usd]').val(data.machine_cost_in_usd);
                    $('input[name=material_cost_in_usd]').val(data.material_cost_in_usd);
                   /* $('input[name=total_machine]').val(data.total_machine);
                    $('input[name=total_running_machine]').val(data.total_running_machine);*/
                    $('input[name=production_date]').val(data.production_date);
                    $('input[name=remarks]').val(data.remarks);


                    $('input[name=id]').val(data.id);
                },
                error:function(error){
                    //console.log(error);
                    swal({
                        title: "No Data Found!",
                        text: "no data!",
                        icon: "error",
                        button: "Ok!",
                        className: "myClass",
                    });
                }
            })

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


