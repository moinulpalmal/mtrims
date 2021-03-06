@extends('layouts.production.production-master')

@section('title')
    Machine
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
            <h2>Machine Setup <span>Trims Machine Setup</span></h2>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{route('production.home')}}"><i class="fa fa-home"></i> Production</a>
                    </li>
                    <li>
                        <a href="{{route('production.machine')}}"> Machine Setup</a>
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
                            <h1 class="custom-font"><strong>Machine Setup</strong> Insert/Update Form</h1>
                            <a><button id="iconChange" class="pull-right btn-info btn-xs" type="submit"><i class="fa fa-check"></i></button></a>
                        </div>
                        <!-- /tile header -->
                        <!-- tile body -->
                        <div class="tile-body">
                            <input type="hidden" id="HiddenFactoryID" name="id">
                            <div class="row" style="padding: 0px 15px;">
                                <div class="col-md-2 no-padding">
                                    <div class="form-group">
                                        <label for="TrimsType" class="control-label text-bold">Select Section</label>
                                        <select id="TrimsType" class="form-control select2" name="section" style="width: 100%;">
                                            <option value="" selected ="selected">- - - Select - - -</option>
                                            @if(!empty($section_setups))
                                                @foreach($section_setups as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 no-padding">
                                    <div class="form-group">
                                        <label for="TypeName" class="control-label text-bold">Machine Name</label>
                                        <input type="text" class="form-control" name="name" id="TypeName" placeholder="Enter machine name" required="">
                                    </div>
                                </div>
                                <div class="col-md-2 no-padding">
                                    <div class="form-group">
                                        <label for="ActiveHours" class="control-label text-bold">Active Hours</label>
                                        <input type="number" min="1" max="24" class="form-control" name="active_hours" id="ActiveHours">
                                    </div>
                                </div>
                                <div class="col-md-4 no-padding">
                                    <div class="form-group">
                                        <label for="Remarks" class="control-label text-bold">Remarks</label>
                                        <input type="text" class="form-control" name="remarks" id="Remarks">
                                    </div>
                                </div>
                                {{--<div class="col-md-2">
                                    <div class="form-group">
                                        <label class="checkbox checkbox-custom-alt checkbox-custom-lg" style="padding-top: 17px">
                                            <input name="IsSubCon" id="IsSubCon" type="checkbox"><i></i> <strong>Is Sub-Con Machine ?</strong>
                                        </label>
                                    </div>
                                </div>--}}
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
                            <table class="table table-hover table-bordered table-condensed" id="advanced-usage">
                                <thead>
                                <tr style="background-color: #1693A5; color: white;">
                                    {{--<th class="text-center">Sl No.</th>--}}
                                    <th class="text-center">Section Name</th>
                                    <th class="text-center">Machine Name</th>
                                    <th class="text-center">Active Hour</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Remarks</th>
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
            $('.select2').select2();
            loadDataTable();
        });

        function loadDataTable() {
            table.destroy();
            var free_table = '<tr><td class="text-center" colspan="6">--- Please Wait... Loading Data  ----</td></tr>';
            $('tbody').html(free_table);
            table = $("#advanced-usage").DataTable({
                ajax: {
                    url: "/mtrims/public/api/production/machine/not-deleted",
                    dataSrc: ""
                },
                columns: [
                    {
                        data: "section_setup_name",
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
                        data: "active_hours",
                        render: function (data) {
                            return "<p class ='text-center'>"+ data +"</p>";
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
                        data: "remarks",
                        render: function (data) {
                            return "<p class ='text-right'>"+ data +"</p>";
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

        function validateForm() {
            var trims_type = document.forms["PurchaseOrderForm"]["trims_type"].value;

            if(trims_type === ""){
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
               /* var id = $('#HiddenFactoryID').val();*/
                var url = '{{ route('production.machine.save') }}';
                var trims_type = document.forms["MachineForm"]["section"].value;
                if(trims_type === ""){
                    swal({
                        title: "Select Section!",
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
                                swalDataNotSaved();
                            }
                        },
                        error:function(error){
                            swalDataNotSaved();
                        }
                    })
                }

            })
        });

        $('#advanced-usage').on('click',".EditFactory", function(){
            var button = $(this);
            var FactoryID = button.attr("data-id");
            var url = '{{ route('production.machine.edit') }}';
            $.ajax({
                url: url,
                method:'POST',
                data:{id: FactoryID},
                success:function(data){
                    if(data){
                        $('input[name=name]').val(data.name);
                        $('input[name=remarks]').val(data.remarks);
                        $('input[name=active_hours]').val(data.active_hours);
                        $('select[name=section]').val(data.section).change();
                        /*if (data.is_sub_con === 1)
                        {
                            $('input[name=IsSubCon]').prop('checked', true);
                        }
                        else if (data.is_sub_con === 0)
                        {
                            $('input[name=IsSubCon]').prop('checked', false);
                        }*/

                        $('input[name=id]').val(data.id);
                        moveToTop();
                    }
                    else{
                        swalNoDataFound();
                    }

                },
                error:function(error){
                   swalNoDataFound();
                }
            })

        });

        $('#advanced-usage').on('click',".ActivateBuyer", function(){
            var button = $(this);
            var id = button.attr("data-id");
            var url = '{{ route('production.machine.activate') }}';
            swal({
                title: 'Are you sure?',
                text: 'This machine will be a active one!',
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
            var url = '{{ route('production.machine.de-activate') }}';
            swal({
                title: 'Are you sure?',
                text: 'This machine will be in-active!',
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
            var url = '{{ route('production.machine.delete') }}';
            swal({
                title: 'Are you sure?',
                text: 'This machine will be removed permanently!',
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


