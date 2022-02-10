@extends('layouts.admin.admin-master')

@section('title')
    Stores
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
        #StoreAddress {
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
            <h2>Delivery Stores <span> Delivery Store Setup</span></h2>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{route('admin.home')}}"><i class="fa fa-home"></i> Administration</a>
                    </li>
                    <li>
                        <a href="{{route('admin.store')}}">Stores</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- row -->
        <div class="row">
            <!-- col -->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <!-- tile -->
                <form method="post" id="StoreAdd" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <section class="tile">
                        <!-- tile header -->
                        <div class="tile-header dvd dvd-btm">
                            <h1 class="custom-font"><strong>Store</strong> Insert/Update Form</h1>
                            <a><button id="iconChange" class="pull-right btn-info btn-xs" type="submit"><i class="fa fa-check"></i></button></a>
                        </div>
                        <!-- /tile header -->
                        <!-- tile body -->
                        <div class="tile-body">
                            <input type="hidden" id="HiddenFactoryID" name="id">
                            <div class="row" style="padding: 0px 15px;">
                                <div class="col-md-4 no-padding">
                                    <div class="form-group">
                                        <label for="StoreName" class="control-label">Store Name</label>
                                        <input type="text" class="form-control" name="name" id="StoreName" placeholder="Enter Store Name" required="">
                                    </div>
                                </div>
                                <div class="col-md-4 no-padding">
                                    <div class="form-group">
                                        <label for="ShortName" class="control-label">Short Name</label>
                                        <input type="text" class="form-control" name="short_name" id="ShortName" placeholder="Enter short name" required="">
                                    </div>
                                </div>
                                <div class="col-md-4 no-padding">
                                    <div class="form-group">
                                        <label for="StoreType" class="control-label">Select Sub Contractor Type</label>
                                        <select id="StoreType" class="form-control select2" name="store_type" required = "" style="width: 100%;">
                                            <option value="">- - - Select - - -</option>
                                            <option value="C">Central Store</option>
                                            <option value="S">Sub Store</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="row" style="padding: 0px 15px;">
                                <div class="col-md-4 no-padding">
                                    <div class="form-group">
                                        <label for="StoreAddress" class="control-label">Store Address</label>
                                        <textarea type="text" size="3" class="form-control" name="address" id="StoreAddress" placeholder="Enter Store Address" required=""></textarea>
                                    </div>
                                </div>
                                <div class="col-md-4 no-padding">
                                    <div class="form-group">
                                        <label for="CPInfo" class="control-label">Primary Contact Person Info</label>
                                        <textarea type="text" size="3" class="form-control" name="contact_person_info" id="CPInfo" placeholder="Enter Contact Person Info" required=""></textarea>
                                    </div>
                                </div>
                                <div class="col-md-4 no-padding">
                                    <div class="form-group">
                                        <label for="FHInfo" class="control-label">Store Manager Info</label>
                                        <textarea type="text" size="3" class="form-control" name="manager_info" id="FHInfo" placeholder="Enter Store Manager Info" required=""></textarea>
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
                        <h1 class="custom-font"><strong>Store</strong> List</h1>
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
                            {{--                            <li class="remove"><a role="button" tabindex="0" class="tile-close"><i class="fa fa-times"></i></a></li>--}}
                        </ul>
                    </div>
                    <!-- /tile header -->

                    <!-- tile body -->
                    <div class="tile-body">
                        <div class="table-responsive">
                            {{-- <h3 class="text-success text-center">{{Session::get('message')}}</h3> --}}
                            <table class="table table-hover table-bordered table-condensed table-responsive" id="advanced-usage">
                                <thead>
                                    <tr style="background-color: #1693A5; color: white;">
                                        {{-- <th class="text-center">Sl No.</th> --}}
                                        <th class="text-center">Store Name</th>
                                        <th class="text-center">Short Name</th>
                                        <th class="text-center">Store Type</th>
                                        <th class="text-center">Contact Person Info</th>
                                        <th class="text-center">Address</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

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
                <h3 class="modal-title custom-font" id="">Store Details</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-hover table-bordered table-condensed table-responsive">
                            <tbody>
                                <tr>
                                    <td><b>Store Name</b></td>
                                    <td id="FName"></td>
                                    <td><b>Short Name</b></td>
                                    <td id="SName"></td>
                                </tr>
                                <tr>
                                    <td><b>Address</b></td>
                                    <td id="StoAddress"></td>
                                    <td><b>Store Type</b></td>
                                    <td id="StType"></td>
                                </tr>
                                <tr>
                                    <td><b>Manager</b></td>
                                    <td id="TManInfo"></td>
                                    <td><b>Contact Person</b></td>
                                    <td id="TCPInfo"></td>
                                </tr>
                                <tr>
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

    <script>
        $(window).load(function(){
            $('.select2').select2();
            loadDataTable();
        });

        var table = $('#advanced-usage').DataTable({
            "lengthMenu": [[10, 50, 100, 200, -1], [10, 50, 100, 200, "All"]]
        });

        function loadDataTable() {
            table.destroy();
            var free_table = '<tr><td class="text-center" colspan="4">--- Please Wait... Loading Data  ----</td></tr>';
            $('#advanced-usage').find('tbody').append(free_table);
           // $('tbody').html(free_table);
            table = $("#advanced-usage").DataTable({
                ajax: {
                    url: "/mtrims/public/api/admin/store/not-deleted",
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
                        render: function(data, type, api_item) {
                            if(api_item.store_type === 'C'){
                                return "<p class ='text-center'>Central Store</p>";
                            }
                            else if(api_item.status === 'S'){
                                return "<p class ='text-center '>Sub Store</p>";
                            }
                            else{

                            }
                        }
                    },
                    {
                        data: "contact_person_info",
                        render: function (data) {
                            return "<p class ='text-left'>"+ data +"</p>";
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
                                    "<a title= 'Delete' class= 'DeleteStore btn btn-danger btn-xs' data-id = "+ api_item.id +"><i class='fa fa-trash'></i></a>" +
                                    " &nbsp;" +
                                    "<a title= 'Activate' class= 'ActivateStore btn btn-success btn-xs' data-id = "+ api_item.id +"><i class='fa fa-arrow-circle-up'></i></a></p>"
                            }
                            else if(api_item.status === 'A'){
                                return "<p class='text-center'><a title= 'Show Detail' class= 'ShowDetail btn btn-info btn-xs' data-toggle='modal' data-target='#FactoryModal' data-options='splash-2 splash-ef-12' data-id = "+ api_item.id +"><i class='fa fa-eye'></i></a>" +
                                    " &nbsp;" +
                                    "<a title= 'Delete' class= 'DeleteStore btn btn-danger btn-xs' data-id = "+ api_item.id +"><i class='fa fa-trash'></i></a>" +
                                    " &nbsp;" +
                                    "<a title= 'Activate' class= 'DeActivateStore btn btn-warning btn-xs' data-id = "+ api_item.id +"><i class='fa fa-arrow-circle-down'></i></a>" +
                                    " &nbsp;" +
                                    "<a title= 'Edit' class= 'EditStore btn btn-warning btn-xs' data-id = "+ api_item.id +"><i class='fa fa-edit'></i></a></p>"
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
            $('#StoreAdd').submit(function(e){
                e.preventDefault();
                var data = $(this).serialize();
                var id = $('#HiddenFactoryID').val();
                var url = '{{ route('admin.save-store') }}';
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

            })
        });

        $('#advanced-usage').on('click',".ShowDetail", function(){
            var button = $(this);
            var StoreID = button.attr("data-id");
            var url = '{{ route('admin.edit-store') }}';
            $.ajax({
                url: url,
                method:'POST',
                data:{id: StoreID},
                success:function(data){
                    // console.log(data);
                    document.getElementById("FName").innerHTML  = data.name;
                    document.getElementById("SName").innerHTML  = data.short_name;
                    document.getElementById("StoAddress").innerHTML = data.address;
                    document.getElementById("TManInfo").innerHTML = data.manager_info;
                    document.getElementById("TCPInfo").innerHTML = data.contact_person_info;
                    // console.log(document.getElementById("StType").innerHTML = data.store_type);

                    if (data.store_type === "C")
                    {
                        document.getElementById("StType").innerHTML = "Center"
                    }
                    else
                    {
                        document.getElementById("StType").innerHTML = "Sub Store"
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

        $('#advanced-usage').on('click',".EditStore", function(){
            var button = $(this);

            var StoreID = button.attr("data-id");


            var url = '{{ route('admin.edit-store') }}';
            $.ajax({
                url: url,
                method:'POST',
                data:{id: StoreID},
                success:function(data){
                    $('input[name=name]').val(data.name);
                    $('input[name=short_name]').val(data.short_name);
                    $('select[name=store_type]').val(data.store_type).change();
                    document.getElementById('StoreAddress').value = data.address;
                    document.getElementById('FHInfo').value = data.manager_info;
                    document.getElementById('CPInfo').value = data.contact_person_info;
                    $('input[name=id]').val(data.id);
                },
                error:function(error){
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

        $('#advanced-usage').on('click',".ActivateStore", function(){
            var button = $(this);
            var id = button.attr("data-id");
            var url = '{{ route('admin.activate-store') }}';
            swal({
                title: 'Are you sure?',
                text: 'This store will be a active one!',
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


        $('#advanced-usage').on('click',".DeActivateStore", function(){
            var button = $(this);
            var id = button.attr("data-id");
            var url = '{{ route('admin.de-activate-store') }}';
            swal({
                title: 'Are you sure?',
                text: 'This store will be in-active!',
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


        $('#advanced-usage').on('click',".DeleteStore", function(){
            var button = $(this);
            var id = button.attr("data-id");
            var url = '{{ route('admin.delete-store') }}';
            swal({
                title: 'Are you sure?',
                text: 'This store will be removed permanently!',
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

