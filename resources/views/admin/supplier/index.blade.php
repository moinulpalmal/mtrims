@extends('layouts.admin.admin-master')
@section('title')
    Supplier
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
        #SubContractorAddress {
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
        #Remarks {
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
            <h2>Suppliers <span>Supplier List</span></h2>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{route('admin.home')}}"><i class="fa fa-home"></i> Administration</a>
                    </li>
                    <li>
                        <a href="{{route('admin.sub-contractor')}}"> Supplier</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- row -->
        <div class="row">
            <!-- col -->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <!-- tile -->
                <form method="post" id="SupplierAdd" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <section class="tile">
                        <!-- tile header -->
                        <div class="tile-header dvd dvd-btm">
                            <h1 class="custom-font"><strong>Supplier</strong> Insert/Update Form</h1>
                            <a><button id="iconChange" class="pull-right btn-info btn-xs" type="submit"><i class="fa fa-check"></i></button></a>
                        </div>
                        <!-- /tile header -->
                        <!-- tile body -->
                        <div class="tile-body">
                            <input type="hidden" id="HiddenFactoryID" name="id">
                            <div class="row" style="padding: 0px 15px;">
                                <div class="col-md-4 no-padding" style="height:30px !important;">
                                    <div class="form-group">
                                        <label for="SupplierType" class="control-label">Select Supplier Type</label>
                                        <select id="SupplierType" class="form-control select2 " name="supplier_type" required = "" style="width: 100%;">
                                            <option value="">- - - Select - - -</option>
                                            <option value="I">International</option>
                                            <option value="L">Local</option>
                                            <option value="LI">Local & International</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 no-padding">
                                    <div class="form-group">
                                        <label for="SubContractorName" class="control-label">Name</label>
                                        <input type="text" class="form-control" name="name" id="SubContractorName" placeholder="Enter supplier name" required="">
                                    </div>
                                </div>
                                
                                <div class="col-md-4 no-padding">
                                    <div class="form-group">
                                        <label for="SubContractorGrade" class="control-label">Grade Details</label>
                                        <input type="text" class="form-control" name="supplier_grade" id="SubContractorGrade" placeholder="A,B,C" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="padding: 0px 15px;">
                                <div class="col-md-6 no-padding">
                                    <div class="form-group">
                                        <label for="SubContractorAddress" class="control-label">Supplier Address</label>
                                        <textarea type="text" size="3" class="form-control" name="address" id="SubContractorAddress" placeholder="Enter supplier address" required=""></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6 no-padding">
                                    <div class="form-group">
                                        <label for="Remarks" class="control-label">Remarks</label>
                                        <textarea type="text" size="3" class="form-control" name="remarks" id="Remarks"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="padding: 0px 15px;">
                                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 no-padding">
                                    <section class="tile">
                                        <div class="tile-header dvd dvd-btm bg-greensea">
                                            <h3 class="custom-font"><strong>Owner Info</strong></h3>
                                        </div>
                                        <div class="tile-body">
                                            <div class="col-md-12 no-padding">
                                                <div class="form-group">
                                                    <label for="OwnerName" class="control-label">Name</label>
                                                    <input type="text" class="form-control" name="owner_name" id="OwnerName" placeholder="Enter name" required="">
                                                </div>
                                            </div>
                                            <div class="col-md-12 no-padding">
                                                <div class="form-group">
                                                    <label for="OwnerDesignation" class="control-label">Designation</label>
                                                    <input type="text" class="form-control" name="owner_designation" id="OwnerDesignation" placeholder="Enter designation" required="">
                                                </div>
                                            </div>
                                            <div class="col-md-12 no-padding">
                                                <div class="form-group">
                                                    <label for="OwnerMobileNo" class="control-label">Mobile No</label>
                                                    <input type="text" class="form-control" name="owner_mobile_no" id="OwnerMobileNo" placeholder="Enter mobile no" required="">
                                                </div>
                                            </div>
                                            <div class="col-md-12 no-padding">
                                                <div class="form-group">
                                                    <label for="OwnerEmail" class="control-label">Email</label>
                                                    <input type="email" class="form-control" name="owner_email" id="OwnerEmail" placeholder="Enter email" required="">
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 no-padding">
                                    <section class="tile">
                                        <div class="tile-header dvd dvd-btm bg-greensea">
                                            <h3 class="custom-font"><strong>Primary Contact Person Info</strong></h3>
                                        </div>
                                        <div class="tile-body">
                                            <div class="col-md-12 no-padding">
                                                <div class="form-group">
                                                    <label for="PrimaryContactPersonName" class="control-label">Name</label>
                                                    <input type="text" class="form-control" name="primary_contact_person" id="PrimaryContactPersonName" placeholder="Enter name" required="">
                                                </div>
                                            </div>
                                            <div class="col-md-12 no-padding">
                                                <div class="form-group">
                                                    <label for="PrimaryContactPersonDesignation" class="control-label">Designation</label>
                                                    <input type="text" class="form-control" name="primary_designation" id="PrimaryContactPersonDesignation" placeholder="Enter designation" required="">
                                                </div>
                                            </div>
                                            <div class="col-md-12 no-padding">
                                                <div class="form-group">
                                                    <label for="PrimaryMobileNo" class="control-label">Mobile No</label>
                                                    <input type="text" class="form-control" name="primary_mobile_no" id="PrimaryMobileNo" placeholder="Enter mobile no" required="">
                                                </div>
                                            </div>
                                            <div class="col-md-12 no-padding">
                                                <div class="form-group">
                                                    <label for="PrimaryEmail" class="control-label">Email</label>
                                                    <input type="email" class="form-control" name="primary_email" id="PrimaryEmail" placeholder="Enter email" required="">
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 no-padding">
                                    <section class="tile">
                                        <div class="tile-header dvd dvd-btm bg-greensea">
                                            <h3 class="custom-font"><strong>Secondary Contact Person Info</strong></h3>
                                        </div>
                                        <div class="tile-body">
                                            <div class="col-md-12 no-padding">
                                                <div class="form-group">
                                                    <label for="SecondaryContactPersonName" class="control-label">Name</label>
                                                    <input type="text" class="form-control" name="secondary_contact_person" id="SecondaryContactPersonName" placeholder="Enter name" required="">
                                                </div>
                                            </div>
                                            <div class="col-md-12 no-padding">
                                                <div class="form-group">
                                                    <label for="SecondaryContactPersonDesignation" class="control-label">Designation</label>
                                                    <input type="text" class="form-control" name="secondary_designation" id="SecondaryContactPersonDesignation" placeholder="Enter designation" required="">
                                                </div>
                                            </div>
                                            <div class="col-md-12 no-padding">
                                                <div class="form-group">
                                                    <label for="SecondaryMobileNo" class="control-label">Mobile No</label>
                                                    <input type="text" class="form-control" name="secondary_mobile_no" id="SecondaryMobileNo" placeholder="Enter mobile no" required="">
                                                </div>
                                            </div>
                                            <div class="col-md-12 no-padding">
                                                <div class="form-group">
                                                    <label for="SecondaryEmail" class="control-label">Email</label>
                                                    <input type="email" class="form-control" name="secondary_email" id="SecondaryEmail" placeholder="Enter email" required="">
                                                </div>
                                            </div>
                                        </div>
                                    </section>
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
                        <h1 class="custom-font"><strong>Supplier</strong> List</h1>
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
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Type</th>
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
                <h3 class="modal-title custom-font" id="">Supplier Details</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <section class="tile">
                            <div class="tile-header dvd dvd-btm">
                                <h4 class="custom-font"><strong>Basic Info</strong></h4>
                            </div><br>
                            <table class="table table-hover table-bordered table-condensed table-responsive">
                                <tbody>
                                    <tr>
                                        <td><b>Supplier Name</b></td>
                                        <td id="TSupName"></td>
                                        <td><b>Supplier Type</b></td>
                                        <td id="TSupType"></td>
                                    </tr>
                                    <tr>
                                        <td><b>Supplier Grade</b></td>
                                        <td id="TSupGrade"></td>
                                        <td><b>Supplier Address</b></td>
                                        <td id="TSupAddress"></td>
                                    </tr>
                                    <tr>
                                        <td><b>Remarks</b></td>
                                        <td id="TSupRemark"></td>
                                        <td><b>Status</b></td>
                                        <td id="status"></td>
                                    </tr>
                                </tbody>
                            </table><br>

                            <div class="tile-header dvd dvd-btm">
                                <h4 class="custom-font"><strong>Owner Info</strong></h4>
                            </div><br>
                            <table class="table table-hover table-bordered table-condensed table-responsive">
                                <tbody>
                                    <tr>
                                        <td><b>Owner Name</b></td>
                                        <td id="TOwnerName"></td>
                                        <td><b>Owner Desig</b></td>
                                        <td id="TOwnerDesig"></td>
                                    </tr>
                                    <tr>
                                        <td><b>Owner Mobile</b></td>
                                        <td id="TOwnerMob"></td>
                                        <td><b>Owner Email</b></td>
                                        <td id="TOwnerEmail"></td>
                                    </tr>
                                </tbody>
                            </table><br>

                            <div class="tile-header dvd dvd-btm">
                                <h4 class="custom-font"><strong>Primary Contact Person Info</strong></h4>
                            </div><br>
                            <table class="table table-hover table-bordered table-condensed table-responsive">
                                <tbody>
                                    <tr>
                                        <td><b>Person Name</b></td>
                                        <td id="TPrimaryContactPersonName"></td>
                                        <td><b>Designation</b></td>
                                        <td id="TPrimaryContactPersonDesignation"></td>
                                    </tr>
                                    <tr>
                                        <td><b>Mobile No</b></td>
                                        <td id="TPrimaryMobileNo"></td>
                                        <td><b>Email</b></td>
                                        <td id="TPrimaryEmail"></td>
                                    </tr>
                                </tbody>
                            </table><br>

                            <div class="tile-header dvd dvd-btm">
                                <h4 class="custom-font"><strong>Secondary Contact Person Info</strong></h4>
                            </div><br>
                            <table class="table table-hover table-bordered table-condensed table-responsive">
                                <tbody>
                                     <tr>
                                        <td><b>Person Name</b></td>
                                        <td id="TSecondaryContactPersonName"></td>
                                        <td><b>Designation</b></td>
                                        <td id="TSecondaryContactPersonDesignation"></td>
                                    </tr>
                                    <tr>
                                        <td><b>Mobile No</b></td>
                                        <td id="TSecondaryMobileNo"></td>
                                        <td><b>Email</b></td>
                                        <td id="TSecondaryEmail"></td>
                                    </tr>
                                </tbody>
                            </table>

                        </section>
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
        
        var table = $('#advanced-usage').DataTable({
            "lengthMenu": [[10, 50, 100, 200, -1], [10, 50, 100, 200, "All"]]
        });

        $(window).load(function(){
            $('.select2').select2();
            loadDataTable();
        });

        function loadDataTable() {
            table.destroy();
            var free_table = '<tr><td class="text-center" colspan="4">--- Please Wait... Loading Data  ----</td></tr>';
            $('#advanced-usage').find('tbody').append(free_table);
            table = $("#advanced-usage").DataTable({
                ajax: {
                    url: "/mtrims/public/api/admin/supplier/not-deleted",
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
                        render: function(data, type, api_item) {
                            if(api_item.type === 'I'){
                                return "<p class ='text-center'>International</p>";
                            }
                            else if(api_item.type === 'L'){
                                return "<p class ='text-center '>Local</p>";
                            }
                            else{
                                return "<p class ='text-center '>International & Local</p>";
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
                                return "<p class='text-center'><a title= 'Show Detail' class= 'ShowDetail btn btn-info btn-xs' data-toggle='modal' data-target='#FactoryModal' data-options='splash-2 splash-ef-12' data-id = "+ api_item.id +"><i class='fa fa-eye'></i></a>" +
                                    " &nbsp;" +
                                    "<a title= 'Delete' class= 'DeleteSupplier btn btn-danger btn-xs' data-id = "+ api_item.id +"><i class='fa fa-trash'></i></a>" +
                                    " &nbsp;" +
                                    "<a title= 'Activate' class= 'ActivateSupplier btn btn-success btn-xs' data-id = "+ api_item.id +"><i class='fa fa-arrow-circle-up'></i></a></p>"
                            }
                            else if(api_item.status === 'A'){
                                return "<p class='text-center'><a title= 'Show Detail' class= 'ShowDetail btn btn-info btn-xs' data-toggle='modal' data-target='#FactoryModal' data-options='splash-2 splash-ef-12' data-id = "+ api_item.id +"><i class='fa fa-eye'></i></a>" +
                                    " &nbsp;" +
                                    "<a title= 'Delete' class= 'DeleteSupplier btn btn-danger btn-xs' data-id = "+ api_item.id +"><i class='fa fa-trash'></i></a>" +
                                    " &nbsp;" +
                                    "<a title= 'Activate' class= 'DeActivateSupplier btn btn-warning btn-xs' data-id = "+ api_item.id +"><i class='fa fa-arrow-circle-down'></i></a>" +
                                    " &nbsp;" +
                                    "<a title= 'Edit' class= 'EditSupplier btn btn-warning btn-xs' data-id = "+ api_item.id +"><i class='fa fa-edit'></i></a></p>"
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
            $('#SupplierAdd').submit(function(e){
                e.preventDefault();
                var data = $(this).serialize();
                var id = $('#HiddenFactoryID').val();
                // console.log(data);
                var url = '{{ route('admin.save-supplier') }}';
                //console.log(data);
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
                                    clearFormWithoutDelay("SupplierAdd");
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
                                    clearFormWithoutDelay("SupplierAdd");
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

        $('#advanced-usage').on('click',".ShowDetail", function(){
            var button = $(this);
            var SupplierID = button.attr("data-id");
            var url = '{{ route('admin.edit-supplier') }}';
            $.ajax({
                url: url,
                method:'POST',
                data:{id: SupplierID},
                success:function(data){
                    // console.log(data);
                    document.getElementById("TSupName").innerHTML  = data.name;
                    document.getElementById("TSupGrade").innerHTML  = data.supplier_grade;
                    document.getElementById("TSupAddress").innerHTML  = data.address;
                    document.getElementById("TSupRemark").innerHTML  = data.remarks;
                    document.getElementById("TOwnerName").innerHTML  = data.owner_name;
                    document.getElementById("TOwnerDesig").innerHTML  = data.owner_designation;
                    document.getElementById("TOwnerMob").innerHTML = data.owner_mobile_no;
                    document.getElementById("TOwnerEmail").innerHTML = data.owner_email;
                    document.getElementById("TPrimaryContactPersonName").innerHTML = data.primary_contact_person;
                    document.getElementById("TPrimaryContactPersonDesignation").innerHTML = data.primary_designation;
                    document.getElementById("TPrimaryEmail").innerHTML = data.primary_email;
                    document.getElementById("TPrimaryMobileNo").innerHTML = data.primary_mobile_no;
                    document.getElementById("TSecondaryContactPersonName").innerHTML = data.secondary_contact_person;
                    document.getElementById("TSecondaryContactPersonDesignation").innerHTML = data.secondary_designation;
                    document.getElementById("TSecondaryEmail").innerHTML = data.secondary_email;
                    document.getElementById("TSecondaryMobileNo").innerHTML = data.secondary_mobile_no;
                    // document.getElementById("supplier_type").innerHTML = data.supplier_type;
                    
                    if (data.supplier_type === 'I')
                    {
                        document.getElementById("TSupType").innerHTML = "International"
                    }
                    else if (data.supplier_type === 'L')
                    {
                        document.getElementById("TSupType").innerHTML = "Local"
                    }
                    else {
                        document.getElementById("TSupType").innerHTML = "International & Local"
                    }

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

        $('#advanced-usage').on('click',".EditSupplier", function(){
            var button = $(this);
            var SupplierID = button.attr("data-id");
            //$('body').animate({scrollTop:0}, 400);
            window.scrollTo({
                top: 0,
                left: 0,
                behavior: 'smooth'
            });
            var url = '{{ route('admin.edit-supplier') }}';
            $.ajax({
                url: url,
                method:'POST',
                data:{id: SupplierID},
                success:function(data){
                    $('input[name=name]').val(data.name);
                    $('select[name=supplier_type]').val(data.supplier_type).change();
                    $('input[name=supplier_grade]').val(data.supplier_grade);
                    $('input[name=owner_name]').val(data.owner_name);
                    $('input[name=owner_email]').val(data.owner_email);
                    $('input[name=owner_designation]').val(data.owner_designation);
                    $('input[name=owner_mobile_no]').val(data.owner_mobile_no);
                    $('input[name=primary_contact_person]').val(data.primary_contact_person);
                    $('input[name=primary_mobile_no]').val(data.primary_mobile_no);
                    $('input[name=primary_email]').val(data.primary_email);
                    $('input[name=primary_designation]').val(data.primary_designation);
                    $('input[name=secondary_contact_person]').val(data.secondary_contact_person);
                    $('input[name=secondary_mobile_no]').val(data.secondary_mobile_no);
                    $('input[name=secondary_email]').val(data.secondary_email);
                    $('input[name=secondary_designation]').val(data.secondary_designation);
                    //$('input[name=remarks]').val(data.remarks);

                    document.getElementById('SubContractorAddress').value = data.address;
                    document.getElementById('Remarks').value = data.remarks;
                    //$("#FactoryName option[value = '" + data.factory_name + "']").attr('selected', 'selected').change();
                    //console.log();

                    $('input[name=id]').val(data.id);
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


        $('#advanced-usage').on('click',".ActivateSupplier", function(){
            var button = $(this);
            var id = button.attr("data-id");
            var url = '{{ route('admin.activate-supplier') }}';
            swal({
                title: 'Are you sure?',
                text: 'This supplier will be active !',
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
                            // console.log(error);
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

        $('#advanced-usage').on('click',".DeActivateSupplier", function(){
            var button = $(this);
            var id = button.attr("data-id");
            var url = '{{ route('admin.in-activate-supplier') }}';
            swal({
                title: 'Are you sure?',
                text: 'This Supplier will be in-active!',
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

        $('#advanced-usage').on('click',".BlockActivateBuyer", function(){
            var button = $(this);
            var id = button.attr("data-id");
            var url = '{{ route('admin.black-list-supplier') }}';
            swal({
                title: 'Are you sure?',
                text: 'This supplier will be blocked!',
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
                                swal({
                                    title: "Operation Successful!",
                                    icon: "success",
                                    button: "Ok!",
                                }).then(function (value) {
                                    if(value){
                                        //console.log(value);
                                        window.location.href = window.location.href.replace(/#.*$/, '');
                                    }
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

        $('#advanced-usage').on('click',".DeleteSupplier", function(){
            var button = $(this);
            var id = button.attr("data-id");
            var url = '{{ route('admin.delete-supplier') }}';
            swal({
                title: 'Are you sure?',
                text: 'This supplier will be removed permanently!',
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
                            // console.log(error);
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

        function refresh()
        {
            window.location.href = window.location.href.replace(/#.*$/, '');

        }

        function iconChange() {

            $('#iconChange').find('i').addClass('fa-edit');

        }
    </script>
@endsection()

