@extends('layouts.admin.admin-master')

@section('title')
    Trims Type
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
            <h2>Trims Types <span>Trims Type List</span></h2>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{route('admin.home')}}"><i class="fa fa-home"></i> Administration</a>
                    </li>
                    <li>
                        <a href="{{route('admin.trims-type')}}"> Trims Type</a>
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
                            <h1 class="custom-font"><strong>Trims Type</strong> Insert/Update Form</h1>
                            <a><button id="iconChange" class="pull-right btn-info btn-xs" type="submit"><i class="fa fa-check"></i></button></a>
                        </div>
                        <!-- /tile header -->
                        <!-- tile body -->
                        <div class="tile-body">
                            <input type="hidden" id="HiddenFactoryID" name="id">
                            <div class="row" style="padding: 0px 15px;">
                                <div class="col-md-1 no-padding">
                                    <div class="form-group">
                                        <label for="LPD" class="control-label">Select LPD</label>
                                        <select class="form-control select2" name="lpd"  id="LPD" style="width: 100% !important; height: 100% !important;" required>
                                            <option value="" selected="selected">- - - Select - - -</option>
                                            <option value="1" >LPD-1</option>
                                            <option value="2" >LPD-2</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2 no-padding">
                                    <div class="form-group">
                                        <label for="SectionID" class="control-label">Select Factory Trims Section</label>
                                        <select id="SectionID" class="form-control sectionselect2" name="section" style="width: 100%;">
                                            <option value="" selected ="selected">- - - Select - - -</option>
                                            @if(!empty($sectionSetups))
                                                @foreach($sectionSetups as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2 no-padding">
                                    <div class="form-group">
                                        <label for="TypeName" class="control-label">Type Name</label>
                                        <input type="text" class="form-control" name="name" id="TypeName" placeholder="Enter trims type name" required="">
                                    </div>
                                </div>
                                <div class="col-md-1 no-padding">
                                    <div class="form-group">
                                        <label for="ShortName" class="control-label">Short Code</label>
                                        <input type="text" class="form-control" name="short_name" id="ShortName" placeholder="short name" required="">
                                    </div>
                                </div>
                                <div class="col-md-2 no-padding">
                                    <div class="form-group">
                                        <label for="GrossAmount" class="control-label">Gross Calculation Factor</label>
                                        <input type="number" class="form-control" step="any" name="gross_calculation_amount" id="GrossAmount" placeholder="short name" min="1.0" required>
                                    </div>
                                </div>
                                <div class="col-md-1 no-padding">
                                    <div class="form-group">
                                        <label for="AddAmount" class="control-label">Add Amount(%)</label>
                                        <input type="number" class="form-control" step="any" name="add_amount_percent" id="AddAmount" placeholder="short name" min="0.0">
                                    </div>
                                </div>
                                <div class="col-md-2 no-padding">
                                    <div class="form-group">
                                        <label for="Description" class="control-label">Description</label>
                                        <input type="text" class="form-control" name="description" id="Description">
                                    </div>
                                </div>
                                <div class="col-md-1 no-padding">
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
                        <h1 class="custom-font"><strong>Trims Type</strong> List</h1>
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
                            <table class="table table-hover table-bordered table-condensed table-responsive" id="advanced-usage">
                                <thead>
                                <tr style="background-color: #1693A5; color: white;">
                                    <th class="text-center">LPD</th>
                                    <th class="text-center">Trims Section</th>
                                    <th class="text-center">Type Name</th>
                                    <th class="text-center">Short Code</th>
                                    <th class="text-center">Gross Calculation Factor</th>
                                    <th class="text-center">Add Amount(%)</th>
                                    <th class="text-center">Description</th>
                                    <th class="text-center">Remarks</th>
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


@section('pageVendorScripts')

@endsection
@section('pageScripts')
<script src="{{ asset('/js/common.js') }}"></script>

    <script>

        var table = $('#advanced-usage').DataTable({
            "lengthMenu": [[10, 50, 100, 200, -1], [10, 50, 100, 200, "All"]]
        });

        $(window).load(function(){
            loadDataTable();
            // $('#advanced-usage').DataTable({
            //     "scrollY":        "200px",
            //     "scrollCollapse": true,
            //     "paging":         false
            // });
            $('.select2').select2();
            $('.sectionselect2').select2();

        });

        function loadDataTable() {
            table.destroy();
            var free_table = '<tr><td class="text-center" colspan="4">--- Please Wait... Loading Data  ----</td></tr>';
            $('#advanced-usage').find('tbody').append(free_table);
            table = $("#advanced-usage").DataTable({
                ajax: {
                    url: "/mtrims/public/api/admin/trims-type/not-deleted",
                    dataSrc: ""
                },
                columns: [
                    {
                        render: function(data, type, api_item) {
                            if(api_item.lpd === 1){
                                return "<p class ='text-center'>LPD-1</p>";
                            }
                            else{
                                return "<p class ='text-center'>LPD-2</p>";
                            }
                        }
                    },
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
                        data: "short_name",
                        render: function (data) {
                            return "<p class = 'text-center'>"+ data +"</p>";
                        }
                    },

                    {
                        data: "gross_calculation_amount",
                        render: function (data) {
                            return "<p class = 'text-center'>"+ data +"</p>";
                        }
                    },

                    {
                        data: "add_amount_percent",
                        render: function (data) {
                            return "<p class = 'text-center'>"+ data +"</p>";
                        }
                    },

                    {
                        data: "description",
                        render: function (data) {
                            return "<p class = 'text-left'>"+ data +"</p>";
                        }
                    },

                    {
                        render: function (data, type, val) {
                            if(val.remarks === null){
                                return "<p class = 'text-right'></p>";
                            }
                            else{
                                return "<p class = 'text-right'>"+ val.remarks +"</p>";
                            }
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
                                return "<p class='text-center'><a title= 'Delete' class= 'DeleteTrims btn btn-danger btn-xs' data-id = "+ api_item.id +"><i class='fa fa-trash'></i></a>" +
                                    " &nbsp;" +
                                    "<a title= 'Activate' class= 'ActivateTrims btn btn-success btn-xs' data-id = "+ api_item.id +"><i class='fa fa-arrow-circle-up'></i></a></p>"
                            }
                            else if(api_item.status === 'A'){
                                return "<p class='text-center'><a title= 'Delete' class= 'DeleteTrims btn btn-danger btn-xs' data-id = "+ api_item.id +"><i class='fa fa-trash'></i></a>" +
                                    " &nbsp;" +
                                    "<a title= 'Activate' class= 'DeActivateTrims btn btn-warning btn-xs' data-id = "+ api_item.id +"><i class='fa fa-arrow-circle-down'></i></a>" +
                                    " &nbsp;" +
                                    "<a title= 'Edit' class= 'EditTrims btn btn-warning btn-xs' data-id = "+ api_item.id +"><i class='fa fa-edit'></i></a></p>"
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
                var url = '{{ route('admin.save-trims-type') }}';
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

        $('#advanced-usage').on('click',".EditTrims", function(){
            var button = $(this);
            var FactoryID = button.attr("data-id");
            var url = '{{ route('admin.edit-trims-type') }}';
            $.ajax({
                url: url,
                method:'POST',
                data:{id: FactoryID},
                success:function(data){
                    //console.log(data);
                    //return;
                    $('select[name=lpd]').val(data.lpd).change();
                    $('select[name=section]').val(data.section).change();
                    $('input[name=name]').val(data.name);
                    $('input[name=description]').val(data.description);
                    $('input[name=remarks]').val(data.remarks);
                    $('input[name=short_name]').val(data.short_name);
                    $('input[name=gross_calculation_amount]').val(data.gross_calculation_amount);
                    $('input[name=add_amount_percent]').val(data.add_amount_percent);

                    // $("#SectionID option[value = '" + data.section + "']").attr('selected', 'selected').change();
                    // $("#LPD option[value = '" + data.lpd + "']").attr('selected', 'selected').change();

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

        $('#advanced-usage').on('click',".ActivateTrims", function(){
            var button = $(this);
            var id = button.attr("data-id");
            var url = '{{ route('admin.activate-trims-type') }}';
            swal({
                title: 'Are you sure?',
                text: 'This trims-type will be a active one!',
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

        $('#advanced-usage').on('click',".DeActivateTrims", function(){
            var button = $(this);
            var id = button.attr("data-id");
            var url = '{{ route('admin.de-activate-trims-type') }}';
            swal({
                title: 'Are you sure?',
                text: 'This trims-type will be in-active!',
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

        $('#advanced-usage').on('click',".DeleteTrims", function(){
            var button = $(this);
            var id = button.attr("data-id");
            var url = '{{ route('admin.delete-trims-type') }}';
            swal({
                title: 'Are you sure?',
                text: 'This trims-type will be removed permanently!',
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

