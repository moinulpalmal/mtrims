@extends('layouts.admin.admin-master')
@section('title')
    Bank Beneficiary Bin
@endsection
@section('content')
    <style type="text/css">
        th {
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
            <h2>Beneficiary Bin <span>Beneficiary Bin List</span></h2>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{route('admin.home')}}"><i class="fa fa-home"></i> Administration</a>
                    </li>
                    <li>
                        <a href="{{route('admin.bank.beneficiary-bin')}}">Beneficiary Bin</a>
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
                            <h1 class="custom-font"><strong>Beneficiary Bin</strong> Insert/Update Form</h1>
                            <a><button id="iconChange" class="pull-right btn-info btn-xs" type="submit"><i class="fa fa-check"></i></button></a>
                        </div>
                        <!-- /tile header -->
                        <!-- tile body -->
                        <div class="tile-body">
                            <input type="hidden" id="HiddenFactoryID" name="id">
                            <div class="row" style="padding: 0px 15px;">
                                <div class="col-md-3 no-padding">
                                    <div class="form-group">
                                        <label for="BankName" class="control-label">Select Bank</label>
                                        <select class="form-control select2" name="bank_name" id="BankName" style="width: 100% !important; height: 100% !important;" required>
                                            <option value="" selected="selected">- - - Select - - -</option>
                                            @if(!empty($banks))
                                                @foreach($banks as $bank)
                                                    <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 no-padding">
                                    <div class="form-group">
                                        <label for="BinNo" class="control-label">Beneficiary Bin No</label>
                                        <input type="text" class="form-control" name="bin_no" id="BinNo" placeholder="Enter Beneficiary Bin No" required="">
                                    </div>
                                </div>
                                <div class="col-md-6 no-padding">
                                    <div class="form-group">
                                        <label for="Remarks" class="control-label">Remarks</label>
                                        <input type="text" class="form-control" name="remarks" id="Remarks" placeholder="Enter remarks">
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
                        <h1 class="custom-font"><strong>Beneficiary Bin</strong> List</h1>
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
                                    <th class="text-center">Bank Name</th>
                                    <th class="text-center">Bin No</th>
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
            loadDataTable();
            $('.select2').select2();
        });

        function loadDataTable() {
            table.destroy();
            var free_table = '<tr><td class="text-center" colspan="4">--- Please Wait... Loading Data  ----</td></tr>';
            $('#advanced-usage').find('tbody').append(free_table);
            table = $("#advanced-usage").DataTable({
                ajax: {
                    url: "/mtrims/public/api/admin/bank-beneficiary-bin/not-deleted",
                    dataSrc: ""
                },
                columns: [
                    {
                        data: "bank_name",
                        render: function (data) {
                            return "<p class = 'text-left'>"+ data +"</p>";
                        }
                    },
                    {
                        data: "bin_no",
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
                                return "<p class='text-center'><a title= 'Delete' class= 'DeleteBuyer btn btn-danger btn-xs' data-id = "+ api_item.id +"><i class='fa fa-trash'></i></a>" +
                                    " &nbsp;" +
                                    "<a title= 'Activate' class= 'ActivateBuyer btn btn-success btn-xs' data-id = "+ api_item.id +"><i class='fa fa-arrow-circle-up'></i></a></p>"
                            }
                            else if(api_item.status === 'A'){
                                return "<p class='text-center'><a title= 'Delete' class= 'DeleteBuyer btn btn-danger btn-xs' data-id = "+ api_item.id +"><i class='fa fa-trash'></i></a>" +
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
                console.log(data);
                var url = '{{ route('admin.bank.beneficiary-bin.save') }}';
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


        $('#advanced-usage').on('click',".EditFactory", function(){
            var button = $(this);
            var FactoryID = button.attr("data-id");
            //$('body').animate({scrollTop:0}, 400);
            window.scrollTo({
                top: 0,
                left: 0,
                behavior: 'smooth'
            });
            var url = '{{ route('admin.bank.beneficiary-bin.edit') }}';
            $.ajax({
                url: url,
                method:'POST',
                data:{id: FactoryID},
                success:function(data){
                    $('input[name=id]').val(data.id);
                    $('select[name=bank_name]').val(data.bank_name).change();
                    $('input[name=bin_no]').val(data.bin_no);
                    $('input[name=remarks]').val(data.remarks);
                    //console.log();
                    moveToTop();

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
            var url = '{{ route('admin.bank.beneficiary-bin.activate') }}';
            swal({
                title: 'Are you sure?',
                text: 'This bank beneficiary-bin will be a active one!',
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

        $('#advanced-usage').on('click',".DeActivateBuyer", function(){
            var button = $(this);
            var id = button.attr("data-id");
            var url = '{{ route('admin.bank.beneficiary-bin.de-activate') }}';
            swal({
                title: 'Are you sure?',
                text: 'This bank beneficiary-bin will be in-active!',
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
            var url = '{{ route('admin.bank.beneficiary-bin.delete') }}';
            swal({
                title: 'Are you sure?',
                text: 'This beneficiary-bin will be removed permanently!',
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

        function refresh()
        {
            window.location.href = window.location.href.replace(/#.*$/, '');

        }

        function iconChange() {

            $('#iconChange').find('i').addClass('fa-edit');

        }
    </script>
@endsection()


