@extends('layouts.admin.admin-master')
@section('title')
    Buyer
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
            <h2>Buyers <span>Buyer List</span></h2>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{route('admin.home')}}"><i class="fa fa-home"></i> Administration</a>
                    </li>
                    <li>
                        <a href="{{route('admin.buyer')}}"> Buyers</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- row -->
        <div class="row">
            <!-- col -->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <!-- tile -->
                <form method="post" id="BuyerAdd" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <section class="tile">
                        <!-- tile header -->
                        <div class="tile-header dvd dvd-btm">
                            <h1 class="custom-font"><strong>Buyer</strong> Insert/Update Form</h1>
                            <a><button id="iconChange" class="pull-right btn-info btn-xs" type="submit"><i class="fa fa-check"></i></button></a>
                        </div>
                        <!-- /tile header -->
                        <!-- tile body -->
                        <div class="tile-body">
                            <input type="hidden" id="HiddenFactoryID" name="id">
                            <div class="row" style="padding: 0px 15px;">
                                <div class="col-md-6 no-padding">
                                    <div class="form-group">
                                        <label for="DepartmentName" class="control-label">Buyer Name</label>
                                        <input type="text" class="form-control" name="name" id="DepartmentName" placeholder="Enter department name" required="">
                                    </div>
                                </div>
                                <div class="col-md-6 no-padding">
                                    <div class="form-group">
                                        <label for="ShortName" class="control-label">Short Name</label>
                                        <input type="text" class="form-control" name="short_name" id="ShortName" placeholder="Enter short name" required="">
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
                        <h1 class="custom-font"><strong>Buyer</strong> List</h1>
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
                            <table class="table table-hover table-bordered table-condensed table-responsive" id="advanced-usage">
                                <thead>
                                <tr style="background-color: #1693A5; color: white;">
                                    {{-- <th class="text-center">Sl No.</th> --}}
                                    <th class="text-center">Buyer Name</th>
                                    <th class="text-center">Short Name</th>
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
                <h3 class="modal-title custom-font" id="">Buyer Details</h3>
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
                                    <td><b>Status</b></td>
                                    <td id="status"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
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
    <script src="{{ asset('/js/common.js') }}"></script>
    <script>
        $(window).load(function(){
            loadDataTable();
        });

        var table = $('#advanced-usage').DataTable({
            "lengthMenu": [[10, 50, 100, 200, -1], [10, 50, 100, 200, "All"]]
        });

        function loadDataTable() {
            table.destroy();
            var free_table = '<tr><td class="text-center" colspan="4">--- Please Wait... Loading Data  ----</td></tr>';
            $('#advanced-usage').find('tbody').append(free_table);
            table = $("#advanced-usage").DataTable({
                ajax: {
                    url: "/mtrims/public/api/admin/buyer/not-deleted",
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
                                    "<a title= 'Edit' class= 'EditBuyer btn btn-warning btn-xs' data-id = "+ api_item.id +"><i class='fa fa-edit'></i></a></p>"
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
            $('#BuyerAdd').submit(function(e){
                e.preventDefault();
                var data = $(this).serialize();
                var id = $('#HiddenFactoryID').val();
                var url = '{{ route('admin.save-buyer') }}';
                // console.log(data);
                $.ajax({
                    url: url,
                    method:'POST',
                    data:data,
                    success:function(data){
                        // console.log(data);
                        if(data === '2')
                        {
                            swal({
                                title: "Data Updated Successfully!",
                                icon: "success",
                                button: "Ok!",
                            }).then(function (value) {
                                if(value){
                                    clearFormWithoutDelay("BuyerAdd");
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
                                    clearFormWithoutDelay("BuyerAdd");
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
                        // console.log(error);
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


        $('#advanced-usage').on('click',".EditBuyer", function(){
            var button = $(this);
            var BuyerID = button.attr("data-id");
            var url = '{{ route('admin.edit-buyer') }}';
            $.ajax({
                url: url,
                method:'POST',
                data:{id: BuyerID},
                success:function(data){
                    $('input[name=name]').val(data.name);
                    $('input[name=short_name]').val(data.short_name);
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

        $('#advanced-usage').on('click',".ShowDetail", function(){
            var button = $(this);
            var StoreID = button.attr("data-id");
            var url = '{{ route('admin.edit-buyer') }}';
            $.ajax({
                url: url,
                method:'POST',
                data:{id: StoreID},
                success:function(data){
                    // console.log(data);
                    document.getElementById("FName").innerHTML  = data.name;
                    document.getElementById("SName").innerHTML  = data.short_name;

                    if (data.status === 'A')
                    {
                        document.getElementById("status").innerHTML = "<p class =''><label class='label label-success'>Active</label></p>"
                    }
                    else
                    {
                        document.getElementById("status").innerHTML = "<p class =''><label class='label label-warning'>In-Active</label></p>"
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


        $('#advanced-usage').on('click',".ActivateBuyer", function(){
            var button = $(this);
            var id = button.attr("data-id");
            var url = '{{ route('admin.activate-buyer') }}';
            swal({
                title: 'Are you sure?',
                text: 'This record and it`s details will be changed!',
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
                        },
                        error:function(error){
                            console.log(error);
                            swal({
                                title: "Operation Unsuccessful!",
                                text: "Somthing wrong happend please check!",
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
            var url = '{{ route('admin.de-activate-buyer') }}';
            swal({
                title: 'Are you sure?',
                text: 'This record and it`s details will be changed!',
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
                                text: "Somthing wrong happend please check!",
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
            var url = '{{ route('admin.delete-buyer') }}';
            swal({
                title: 'Are you sure?',
                text: 'This buyer will be removed permanently!',
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

