@extends('layouts.admin.admin-master')
@section('title')
    Departments
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
            <h2>Departments <span>Department List</span></h2>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{route('admin.home')}}"><i class="fa fa-home"></i> Administration</a>
                    </li>
                    <li>
                        <a href="{{route('admin.factory')}}"> Departments</a>
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
                            <h1 class="custom-font"><strong>Department</strong> Insert/Update Form</h1>
                            <a><button id="iconChange" class="pull-right btn-info btn-xs" type="submit"><i class="fa fa-check"></i></button></a>
                        </div>
                        <!-- /tile header -->
                        <!-- tile body -->
                        <div class="tile-body">
                            <input type="hidden" id="HiddenFactoryID" name="id">
                            <div class="row" style="padding: 0px 15px;">
                                <div class="col-md-4 no-padding">
                                    <div class="form-group">
                                        <label for="FactoryName" class="control-label">Select Factory Name</label>
                                        <select id="FactoryName" class="form-control select2 @error('factory_name') is-invalid @enderror" name="factory_name" required = "" style="width: 100%;">
                                            <option value="">- - - Select - - -</option>
                                            @if(!empty($factories))
                                                @foreach($factories as $factory)
                                                    <option value="{{ $factory->id }}">{{ $factory->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 no-padding">
                                    <div class="form-group">
                                        <label for="DepartmentName" class="control-label">Department Name</label>
                                        <input type="text" class="form-control" name="name" id="DepartmentName" placeholder="Enter department name" required="">
                                    </div>
                                </div>
                                <div class="col-md-2 no-padding">
                                    <div class="form-group">
                                        <label for="ShortName" class="control-label">Short Name</label>
                                        <input type="text" class="form-control" name="short_name" id="ShortName" placeholder="Enter short name" required="">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="IsMerchandising" class="checkbox checkbox-custom-alt checkbox-custom-lg" style="padding-top: 17px">
                                            <input name="IsMerchandising" id="IsMerchandising" type="checkbox"><i></i> <strong>Is Merchandising Dept.?</strong>
                                        </label>
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
                        <h1 class="custom-font"><strong>Department</strong> List</h1>
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
                            <h3 class="text-success text-center">{{Session::get('message')}}</h3>
                            <table class="table table-hover table-bordered table-condensed table-responsive" id="advanced-usage">
                                <thead>
                                <tr style="background-color: #1693A5; color: white;">
                                    <th class="text-center">Factory Name</th>
                                    <th class="text-center">Department Name</th>
                                    <th class="text-center">Short Name</th>
                                    <th class="text-center">Is Merchandising</th>
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

@endsection
@section('pageVendorScripts')

@endsection
@section('pageScripts')
    <script src="{{ asset('/js/common.js') }}"></script>
    <script>
        var table = $('#advanced-usage').DataTable({
            "lengthMenu": [[10, 50, 100, 200, -1], [10, 50, 100, 200, "All"]]
        });

        $(window).load(function(){
            $('.select2').select2();
            loadDataTable();
        });
        function loadDataTable() {
            table.destroy();
            var free_table = '<tr><td class="text-center" colspan="6">--- Please Wait... Loading Data  ----</td></tr>';
            $('tbody').html(free_table);
            table = $("#advanced-usage").DataTable({
                ajax: {
                    url: "/mtrims/public/api/admin/department/not-deleted",
                    dataSrc: ""
                },
                columns: [
                    {
                        data: "factory_name",
                        render: function (data) {
                            return "<p class = 'text-left'>"+ data +"</p>";
                        }
                    },
                    {
                        data: "name",
                        render: function (data) {
                            return "<p class = 'text-left'>"+ data +"</p>";
                        }
                    },
                    {
                        data: "short_name",
                        render: function (data) {
                            return "<p class ='text-center'>"+ data +"</p>";
                        }
                    },
                    {
                        render: function(data, type, dep) {
                            if(dep.is_merchandising_department == false){
                                return "<p class ='text-center '><label class='label label-warning'>No</label></p>";
                            }
                            else if(dep.is_merchandising_department == true){
                                return "<p class ='text-center '><label class='label label-success'>Yes</label></p>";
                            }
                            else{

                            }
                        }
                    },
                    {
                        render: function(data, type, machine) {
                            if(machine.status === 'I'){
                                return "<p class ='text-center '><label class='label label-warning'>In-Active</label></p>";
                            }
                            else if(machine.status === 'A'){
                                return "<p class ='text-center '><label class='label label-success'>Active</label></p>";
                            }
                            else{

                            }
                        }
                    },
                    {
                        /*data: "id",*/
                        render: function(data, type, machine) {
                            if(machine.status === 'I'){
                                return "<p class='text-center'><a title= 'Delete' class= 'DeleteBuyer btn btn-danger btn-xs' data-id = "+ machine.id +"><i class='fa fa-trash'></i></a>" +
                                    " &nbsp;" +
                                    "<a title= 'Activate' class= 'ActivateBuyer btn btn-success btn-xs' data-id = "+ machine.id +"><i class='fa fa-arrow-circle-up'></i></a></p>"
                            }
                            else if(machine.status === 'A'){
                                return "<p class='text-center'><a title= 'Delete' class= 'DeleteBuyer btn btn-danger btn-xs' data-id = "+ machine.id +"><i class='fa fa-trash'></i></a>" +
                                    " &nbsp;" +
                                    "<a title= 'Activate' class= 'DeActivateBuyer btn btn-warning btn-xs' data-id = "+ machine.id +"><i class='fa fa-arrow-circle-down'></i></a>" +
                                    " &nbsp;" +
                                    "<a title= 'Edit' class= 'EditFactory btn btn-warning btn-xs' data-id = "+ machine.id +"><i class='fa fa-edit'></i></a></p>"
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
                var url = '{{ route('admin.save-department') }}';
                //console.log(data);
                $.ajax({
                    url: url,
                    method:'POST',
                    data:data,
                    success:function(data){
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
        $('#advanced-usage').on('click',".EditFactory", function(){
            var button = $(this);
            var FactoryID = button.attr("data-id");
            var url = '{{ route('admin.edit-department') }}';
            $.ajax({
                url: url,
                method:'POST',
                data:{id: FactoryID},
                success:function(data){
                    $('input[name=name]').val(data.name);
                    $('input[name=short_name]').val(data.short_name);
                    $('select[name=factory_name]').val(data.factory_name).change();
                    //$("#FactoryName option[value = '" + data.factory_name + "']").attr('selected', 'selected').change();
                    //console.log();
                    if (data.IsMerchandising == 1)
                    {
                        $('input[name=IsMerchandising]').prop('checked', true);
                    }
                    else if (data.IsMerchandising == 0)
                    {
                        $('input[name=IsMerchandising]').prop('checked', false);
                    }
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

        $('#advanced-usage').on('click',".ActivateBuyer", function(){
            var button = $(this);
            var id = button.attr("data-id");
            var url = '{{ route('admin.activate-department') }}';
            swal({
                title: 'Are you sure?',
                text: 'This department will be a active one!',
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
            var url = '{{ route('admin.de-activate-department') }}';
            swal({
                title: 'Are you sure?',
                text: 'This department will be in-active!',
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
            var url = '{{ route('admin.delete-department') }}';
            swal({
                title: 'Are you sure?',
                text: 'This department will be removed permanently!',
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

