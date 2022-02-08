@extends('layouts.admin.admin-master')

@section('title')
    Factories
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
        #FactoryAddress {
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            display: block; /*reset from inline*/
            width: 100%;
            margin: 0; /*remove defaults*/
            padding: 4px;
            background: #EEF;
            border: 1px solid #333;
            overflow-y: auto; /*resets IE*/
            overflow-x: hidden;
            resize: none;
        }
        #MasInfo {
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            display: block; /*reset from inline*/
            width: 100%;
            margin: 0; /*remove defaults*/
            padding: 4px;
            background: #EEF;
            border: 1px solid #333;
            overflow-y: auto; /*resets IE*/
            overflow-x: hidden;
            resize: none;
        }

        #CPInfo {
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            display: block; /*reset from inline*/
            width: 100%;
            margin: 0; /*remove defaults*/
            padding: 4px;
            background: #EEF;
            border: 1px solid #333;
            overflow-y: auto; /*resets IE*/
            overflow-x: hidden;
            resize: none;
        }

        #ManInfo {
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            display: block; /*reset from inline*/
            width: 100%;
            margin: 0; /*remove defaults*/
            padding: 4px;
            background: #EEF;
            border: 1px solid #333;
            overflow-y: auto; /*resets IE*/
            overflow-x: hidden;
            resize: none;
        }

        #FHInfo {
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            display: block; /*reset from inline*/
            width: 100%;
            margin: 0; /*remove defaults*/
            padding: 4px;
            background: #EEF;
            border: 1px solid #333;
            overflow-y: auto; /*resets IE*/
            overflow-x: hidden;
            resize: none;
        }
        #StoreInfo {
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            display: block; /*reset from inline*/
            width: 100%;
            margin: 0; /*remove defaults*/
            padding: 4px;
            background: #EEF;
            border: 1px solid #333;
            overflow-y: auto; /*resets IE*/
            overflow-x: hidden;
            resize: none;
        }
    </style>
    <div class="page page-dashboard">
        <div class="pageheader ">
            <h2>Factories <span>Factory List</span></h2>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{route('admin.home')}}"><i class="fa fa-home"></i> Administration</a>
                    </li>
                    <li>
                        <a href="{{route('admin.factory')}}">Factories</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- row -->
        <div class="row">
            <!-- col -->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <!-- tile -->
                <form method="post" id="FactoryAdd" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <section class="tile">
                        <!-- tile header -->
                        <div class="tile-header dvd dvd-btm">
                            <h1 class="custom-font"><strong>Factory</strong> Insert/Update Form</h1>
                        {{--<h3 class="box-title" style="color: white;"><i class="fa fa-industry"></i>&nbsp;&nbsp;Factories Entry/Update</h3>--}}
                            <a><button id="iconChange" class="pull-right btn-info btn-xs" type="submit"><i class="fa fa-check"></i></button></a>
                        {{--<ul class="controls">--}}
                        {{--<li><a><button id="iconChange" class="pull-right" type="submit"><i class="fa fa-check"></i></button></a></li>--}}
                        {{--</ul>--}}
                        </div>
                        <!-- /tile header -->
                        <!-- tile body -->
                        <div class="tile-body">
                            <input type="hidden" id="HiddenFactoryID" name="id">
                            <div class="row" style="padding: 0px 15px;">
                                <div class="col-md-4 no-padding">
                                    <div class="form-group">
                                        <label for="FactoryName" class="control-label">Factory Name</label>
                                        <input type="text" class="form-control" name="name" id="FactoryName" placeholder="Enter factory name" required="">
                                    </div>
                                </div>
                                <div class="col-md-2 no-padding">
                                    <div class="form-group">
                                        <label for="ShortName" class="control-label">Short Name</label>
                                        <input type="text" class="form-control" name="short_name" id="ShortName" placeholder="Enter short name" required="">
                                    </div>
                                </div>
                                <div class="col-md-2 no-padding">
                                    <div class="form-group">
                                        <label for="VatNo" class="control-label">VAT No</label>
                                        <input type="text" class="form-control" name="vat_no" id="VatNo" placeholder="Enter VAT no" readonly>
                                    </div>
                                </div>
                                <div class="col-md-2 no-padding">
                                    <div class="form-group">
                                        <label for="BinNo" class="control-label">BIN No</label>
                                        <input type="text" class="form-control" name="bin_no" id="BinNo" placeholder="Enter BIN no" readonly>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="checkbox checkbox-custom-alt checkbox-custom-lg" style="padding-top: 17px">
                                            <input name="IsCHO" id="IsCHO" type="checkbox"><i></i> <strong>Is CHO ?</strong>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="padding: 0px 15px;">
                                <div class="col-md-4 no-padding">
                                    <div class="form-group">
                                        <label for="FactoryAddress" class="control-label">Factory Address</label>
                                        <textarea type="text" size="3" class="form-control" name="address" id="FactoryAddress" placeholder="Enter factory address" required=""></textarea>
                                    </div>
                                </div>
                                <div class="col-md-4 no-padding">
                                    <div class="form-group">
                                        <label for="CPInfo" class="control-label">Primary Contact Person Info</label>
                                        <textarea type="text" size="3" class="form-control" name="contact_person_info" id="CPInfo" placeholder="Enter factory address" required=""></textarea>
                                    </div>
                                </div>
                                <div class="col-md-4 no-padding">
                                    <div class="form-group">
                                        <label for="FHInfo" class="control-label">Factory Head Info</label>
                                        <textarea type="text" size="3" class="form-control" name="factory_head_info" id="FHInfo" placeholder="Enter factory head info" required=""></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="padding: 0px 15px;">
                                <div class="col-md-4 no-padding">
                                    <div class="form-group">
                                        <label for="ManInfo" class="control-label">Factory Manager Info</label>
                                        <textarea type="text" size="3" class="form-control" name="manager_info" id="ManInfo" placeholder="Enter factory manager info" required=""></textarea>
                                    </div>
                                </div>
                                <div class="col-md-4 no-padding">
                                    <div class="form-group">
                                        <label for="StoreInfo" class="control-label">Factory Store Info</label>
                                        <textarea type="text" size="3" class="form-control" name="factory_store_info" id="StoreInfo" placeholder="Enter factory store info" readonly></textarea>
                                    </div>
                                </div>
                                <div class="col-md-4 no-padding">
                                    <div class="form-group">
                                        <label for="MasInfo" class="control-label">Factory Messenger Info</label>
                                        <textarea type="text" size="3" class="form-control" name="factory_messenger_info" id="MasInfo" placeholder="Enter factory messenger info" required=""></textarea>
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
                        <h1 class="custom-font"><strong>Factory</strong> List</h1>
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
                        </ul>
                    </div>
                    <!-- /tile header -->

                    <!-- tile body -->
                    <div class="tile-body">
                        <div class="table-responsive">
                           {{-- <h3 class="text-success text-center">{{Session::get('message')}}</h3>--}}
                            <table class="table table-hover table-bordered table-condensed table-responsive" id="advanced-usage">
                                <thead>
                                <tr style="background-color: #1693A5; color: white;">
                                    <th class="text-center">Factory Name</th>
                                    <th class="text-center">Short Name</th>
                                    <th class="text-center">Address</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                {{--@php($i = 1)
                                @foreach($factories as $item)
                                    <tr>
                                        <td class="text-center">{{$i++}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{!! $item->short_name !!}</td>
                                        <td>{!! $item->address !!}</td>
                                        <td class="text-center">
                                            <button class="btn btn-info btn-xs" data-toggle="modal" data-target="#user{{$item->id}}" data-options="splash-2 splash-ef-12"><i class="fa fa-eye"></i></button>
                                            <a onclick="iconChange()" data-id = "{{ $item->id }}" class="EditFactory btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>
                                            <a class="DeleteFactory btn btn-danger btn-xs" ><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach--}}
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

@section('page-modals')
        <!-- Modal -->
        <div class="modal splash fade" id="FactoryModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title custom-font" id="">Factory Details</h3>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-hover table-bordered table-condensed table-responsive">
                                    <tbody>
                                        <tr>
                                            <td><b>Factory Name</b></td>
                                            <td id="FName"></td>
                                            <td><b>Short Name</b></td>
                                            <td id="SName"></td>
                                        </tr>
                                        <tr>
                                            <td><b>Address</b></td>
                                            <td id="FacAddress"></td>
                                            <td><b>Is CHO</b></td>
                                            <td id="TIsCho"></td>
                                        </tr>
                                        <tr>
                                            <td><b>VAT No.</b></td>
                                            <td id="TVatNo"></td>
                                            <td><b>BIN No.</b></td>
                                            <td id="TBinNo"></td>
                                        </tr>
                                        <tr>
                                            <td><b>Factory Head</b></td>
                                            <td id="TFHInfo"></td>
                                            <td><b>Factory Manager</b></td>
                                            <td id="TManInfo"></td>
                                        </tr>
                                        <tr>
                                            <td><b>Contact Person</b></td>
                                            <td id="TCPInfo"></td>
                                            <td><b>Store Info</b></td>
                                            <td id="TStoreInfo"></td>
                                        </tr>
                                        <tr>
                                            <td><b>Messenger Info</b></td>
                                            <td id="TMsnInfo"></td>
                                            <td><b>Status</b></td>
                                            <td id="status"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        {{-- <button class="btn btn-success btn-ef btn-ef-3 btn-ef-3c"><i class="fa fa-arrow-right"></i> Submit</button> --}}
                        <button class="btn btn-lightred btn-ef btn-ef-4 btn-ef-4c" data-dismiss="modal"><i class="fa fa-arrow-left"></i> Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
@endsection
@section('pageVendorScripts')

@endsection
@section('pageScripts')
{{--    <script src="{{ asset('back-end/assets/MyJS/jquery.min.js') }}"></script>--}}
    <script src="{{ asset('/js/common.js') }}"></script>
    <script>
        var table = $('#advanced-usage').DataTable({
            "lengthMenu": [[10, 50, 100, 200, -1], [10, 50, 100, 200, "All"]]
        });
        $(window).load(function(){
            loadDataTable();
        });
        function loadDataTable() {
            table.destroy();
            var free_table = '<tr><td class="text-center" colspan="4">--- Please Wait... Loading Data  ----</td></tr>';
            $('#advanced-usage').find('tbody').append(free_table);
           // $('tbody').html(free_table);
            table = $("#advanced-usage").DataTable({
                ajax: {
                    url: "/mtrims/public/api/admin/factory/not-deleted",
                    dataSrc: ""
                },
                columns: [
                    {
                        data: "name",
                        render: function (data) {
                            return "<p class = 'text-left'>"+ data +"</p>";
                        }
                    },
                    {
                        data: "short_name",
                        render: function (data) {
                            return "<p class = 'text-center'>"+ data +"</p>";
                        }
                    },
                    {
                        data: "address",
                        render: function (data) {
                            return "<p class ='text-left'>"+ data +"</p>";
                        }
                    },
                    {
                        render: function(data, type, api_item) {
                            if(api_item.status === 'I'){
                                return "<p class ='text-center'><label class='label label-warning'>In-Active</label></p>";
                            }
                            else if(api_item.status === 'A'){
                                return "<p class ='text-center '><label class='label label-success'>Active</label></p>";
                            }
                            else{

                            }
                        }
                    },
                    {
                        /*data: "id",*/
                        render: function(data, type, api_item) {
                            if(api_item.status === 'I'){
                                return "<p class='text-center'><a title= 'Show Detail' class= 'ShowDetail btn btn-info btn-xs' data-toggle='modal' data-target='#FactoryModal' data-options='splash-2 splash-ef-12' data-id = "+ api_item.id +"><i class='fa fa-eye'></i></a>" +
                                    " &nbsp;" +
                                    "<a title= 'Delete' class= 'DeleteBuyer btn btn-danger btn-xs' data-id = "+ api_item.id +"><i class='fa fa-trash'></i></a>" +
                                    " &nbsp;" +
                                    "<a title= 'Activate' class= 'ActivateBuyer btn btn-success btn-xs' data-id = "+ api_item.id +"><i class='fa fa-arrow-circle-up'></i></a></p>"
                            }
                            else if(api_item.status === 'A'){
                                return "<p class='text-center'><a title= 'Show Detail' class= 'ShowDetail btn btn-info btn-xs' data-toggle='modal' data-target='#FactoryModal' data-options='splash-2 splash-ef-12' data-id = "+ api_item.id +"><i class='fa fa-eye'></i></a>" +
                                    " &nbsp;" +
                                    "<a title= 'Delete' class= 'DeleteBuyer btn btn-danger btn-xs' data-id = "+ api_item.id +"><i class='fa fa-trash'></i></a>" +
                                    " &nbsp;" +
                                    "<a title= 'Activate' class= 'DeActivateBuyer btn btn-warning btn-xs' data-id = "+ api_item.id +"><i class='fa fa-arrow-circle-down'></i></a>" +
                                    " &nbsp;" +
                                    "<a title= 'Edit' class= 'EditFactory btn btn-warning btn-xs' data-id = "+ api_item.id +"><i class='fa fa-edit'></i></a></p>"
                            }
                            else{

                            }
                        }
                    }
                ]
            });
        }

        $(function(){
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
            });
            $('#FactoryAdd').submit(function(e){
                e.preventDefault();
                var data = $(this).serialize();
                var id = $('#HiddenFactoryID').val();
                var url = '{{ route('admin.save-factory') }}';
                //console.log(data);
                $.ajax({
                    url: url,
                    method:'POST',
                    data:data,
                    success:function(data){
                        //console.log(data);
                        if(data === '2')
                        {
                            swal({
                                title: "Data Updated Successfully!",
                                icon: "success",
                                button: "Ok!",
                            }).then(function (value) {
                                if(value){
                                    clearFormWithoutDelay("FactoryAdd");
                                    loadDataTable();
                                }
                            });
                        }
                        else if(data === '1')
                        {
                            swal({
                                title: "Data Inserted Successfully!",
                                icon: "success",
                                button: "Ok!",
                            }).then(function (value) {
                                if(value){
                                    clearFormWithoutDelay("FactoryAdd");
                                    loadDataTable();
                                }
                            });
                        }
                        else{
                            swal({
                                title: "Data Not Saved!",
                                text: "Please Check Your Data!",
                                icon: "error",
                                button: "Ok!",
                                className: "myClass",
                            });
                        }
                    },
                    error:function(error){
                        swal({
                            title: "Data Not Saved!",
                            text: "Please Check Your Data!",
                            icon: "error",
                            button: "Ok!",
                            className: "myClass",

                        });
                    }
                })

            })
        });

        $('#advanced-usage').on('click',".ShowDetail", function(){
            var button = $(this);
            var FactoryID = button.attr("data-id");
            var url = '{{ route('admin.edit-factory') }}';
            $.ajax({
                url: url,
                method:'POST',
                data:{id: FactoryID},
                success:function(data){
                    console.log(data);
                    document.getElementById("FName").innerHTML  = data.name;
                    document.getElementById("SName").innerHTML  = data.short_name;
                    document.getElementById("FacAddress").innerHTML = data.address;
                    document.getElementById("TVatNo").innerHTML = data.vat_no;
                    document.getElementById("TBinNo").innerHTML = data.bin_no;
                    document.getElementById("TFHInfo").innerHTML = data.factory_head_info;
                    document.getElementById("TManInfo").innerHTML = data.manager_info;
                    document.getElementById("TCPInfo").innerHTML = data.contact_person_info;
                    document.getElementById("TStoreInfo").innerHTML = data.factory_store_info;
                    document.getElementById("TMsnInfo").innerHTML = data.factory_messenger_info;

                    if (data.is_cho == 1)
                    {
                        document.getElementById("TIsCho").innerHTML = "<p class =''><label class='label label-success'>Yes</label></p>"
                    }
                    else
                    {
                        document.getElementById("demo").innerHTML = "<p class =''><label class='label label-warning'>No</label></p>"
                    }

                    if (data.status === 'A')
                    {
                        document.getElementById("status").innerHTML = "<p class =''><label class='label label-success'>Active</label></p>"
                    }
                    else
                    {
                        document.getElementById("status").innerHTML = "<p class =''><label class='label label-warning'>Inactive</label></p>"
                    }
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
        $('#advanced-usage').on('click',".EditFactory", function(){
            var button = $(this);

            var FactoryID = button.attr("data-id");


            var url = '{{ route('admin.edit-factory') }}';
            $.ajax({
                url: url,
                method:'POST',
                data:{id: FactoryID},
                success:function(data){
                    $('input[name=name]').val(data.name);
                    $('input[name=short_name]').val(data.short_name);
                    $('input[name=vat_no]').val(data.vat_no);
                    $('input[name=bin_no]').val(data.bin_no);
                    document.getElementById('FactoryAddress').value = data.address;
                    document.getElementById('FHInfo').value = data.factory_head_info;
                    document.getElementById('ManInfo').value = data.manager_info;
                    document.getElementById('StoreInfo').value = data.factory_store_info;
                    document.getElementById('CPInfo').value = data.contact_person_info;
                    document.getElementById('MasInfo').value = data.factory_messenger_info;
                    //console.log();
                    if (data.is_cho == 1)
                    {
                        $('input[name=IsCHO]').prop('checked', true);
                    }
                    else if (data.is_cho == 0)
                    {
                        $('input[name=IsCHO]').prop('checked', false);
                    }
                    $('input[name=id]').val(data.id);
                    moveToTop();
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

        $('#advanced-usage').on('click',".ActivateBuyer", function(){
            var button = $(this);
            var id = button.attr("data-id");
            var url = '{{ route('admin.activate-factory') }}';
            swal({
                title: 'Are you sure?',
                text: 'This factory will be a active one!',
                icon: 'warning',
                buttons: ["Cancel", "Yes!"],
            }).then(function(value) {
                if (value) {
                    //window.location.href = url;
                    //console.log(id);
                    $.ajax({
                        method:'DELETE',
                        url: url,
                        data:{id: id, _token: '{{csrf_token()}}'},
                        success:function(data){
                            if(data){
                                //console.log(data);
                                if(data === '2'){
                                    swal({
                                        title: "Operation Successful!",
                                        icon: "success",
                                        button: "Ok!",
                                    }).then(function (value) {
                                        if(value){
                                            loadDataTable();
                                        }
                                    });
                                }
                                else{
                                    swal({
                                        title: "Operation Unsuccessful!",
                                        text: "Something wrong happened please check!",
                                        icon: "error",
                                        button: "Ok!",
                                        className: "myClass",
                                    });
                                }

                            }
                        },
                        error:function(error){
                            swal({
                                title: "Operation Unsuccessful!",
                                text: "Something wrong happened please check!",
                                icon: "error",
                                button: "Ok!",
                                className: "myClass",
                            });
                        }
                    })
                }
            });
        });

        $('#advanced-usage').on('click',".DeActivateBuyer", function(){
            var button = $(this);
            var id = button.attr("data-id");
            var url = '{{ route('admin.de-activate-factory') }}';
            swal({
                title: 'Are you sure?',
                text: 'This factory will be in-active!',
                icon: 'warning',
                buttons: ["Cancel", "Yes!"],
            }).then(function(value) {
                if (value) {
                    //window.location.href = url;
                    //console.log(id);
                    $.ajax({
                        method:'DELETE',
                        url: url,
                        data:{id: id, _token: '{{csrf_token()}}'},
                        success:function(data){
                            if(data){
                                if(data === '2'){
                                    swal({
                                        title: "Operation Successful!",
                                        icon: "success",
                                        button: "Ok!",
                                    }).then(function (value) {
                                        if(value){
                                            loadDataTable();
                                        }
                                    });
                                }
                                else{
                                    swal({
                                        title: "Operation Unsuccessful!",
                                        text: "Something wrong happened please check!",
                                        icon: "error",
                                        button: "Ok!",
                                        className: "myClass",
                                    });
                                }
                            }
                        },
                        error:function(error){
                            console.log(error);
                            swal({
                                title: "Operation Unsuccessful!",
                                text: "Something wrong happened please check!",
                                icon: "error",
                                button: "Ok!",
                                className: "myClass",
                            });
                        }
                    })
                }
            });
        });

        $('#advanced-usage').on('click',".DeleteBuyer", function(){
            var button = $(this);
            var id = button.attr("data-id");
            var url = '{{ route('admin.delete-factory') }}';
            swal({
                title: 'Are you sure?',
                text: 'This factory will be removed permanently!',
                icon: 'warning',
                buttons: ["Cancel", "Yes!"],
            }).then(function(value) {
                if (value) {
                    //window.location.href = url;
                    //console.log(id);
                    $.ajax({
                        method:'DELETE',
                        url: url,
                        data:{id: id, _token: '{{csrf_token()}}'},
                        success:function(data){
                            if(data){
                                if(data === '2'){
                                    swal({
                                        title: "Operation Successful!",
                                        icon: "success",
                                        button: "Ok!",
                                    }).then(function (value) {
                                        if(value){
                                            loadDataTable();
                                        }
                                    });
                                }
                                else{
                                    swal({
                                        title: "Operation Unsuccessful!",
                                        text: "Something wrong happened please check!",
                                        icon: "error",
                                        button: "Ok!",
                                        className: "myClass",
                                    });
                                }
                            }
                        },
                        error:function(error){
                            swal({
                                title: "Operation Unsuccessful!",
                                text: "Something wrong happened please check!",
                                icon: "error",
                                button: "Ok!",
                                className: "myClass",
                            });
                        }
                    })
                }
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
