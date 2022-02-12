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
                                <div class="col-md-4 no-padding">
                                    <div class="form-group">
                                        <label for="SubContractorName" class="control-label">Name</label>
                                        <input type="text" class="form-control" name="name" id="SubContractorName" placeholder="Enter supplier name" required="">
                                    </div>
                                </div>
                                <div class="col-md-4 no-padding">
                                    <div class="form-group">
                                        <label for="SubContractorType" class="control-label">Select Supplier Type</label>
                                        <select id="SubContractorType" class="form-control chosen-select" name="supplier_type" required = "" style="width: 100%;">
                                            <option value="">- - - Select - - -</option>
                                            <option value="I">International</option>
                                            <option value="L">Local</option>
                                            <option value="LI">Local & International</option>
                                        </select>
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
                                {{-- @php($i = 1)
                                @foreach($suppliers as $item)
                                    <tr>
                                        <td class="text-center">{{$i++}}</td>
                                        <td class="text-left">{{$item->name}}</td>
                                        <td>
                                            @if($item->type == 'I')
                                                <p><strong>International</strong></p>
                                            @elseif($item->type == 'L')
                                                <p><strong>Local</strong></p>
                                            @elseif($item->type == 'LI')
                                                <p><strong>International & Local</strong></p>
                                            @else
                                                <p><strong></strong></p>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($item->status == 'I')
                                                <span class="label label-info">Waiting for approval</span>
                                            @elseif($item->status == 'A')
                                                <span class="label label-success">Active</span>
                                            @elseif($item->status == 'B')
                                                <span class="label label-danger">Blocked</span>
                                            @elseif($item->status == 'IN')
                                                <span class="label label-warning">In-Active</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-info btn-xs" data-toggle="modal" data-target="#user{{$item->id}}" data-options="splash-2 splash-ef-12"><i class="fa fa-eye"></i></button>
                                            <a onclick="iconChange()" data-id = "{{ $item->id }}" class="EditSupplier btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>
                                            @if($item->status == 'I')
                                                <a title="Activate" class="ActivateBuyer btn btn-success btn-xs" data-id = "{{ $item->id }}"><i class="fa fa-arrow-circle-up"></i></a>
                                            @else
                                                @if($item->status == 'A')
                                                    <a title="De-Activate" class="DeActivateBuyer btn btn-warning btn-xs" data-id = "{{ $item->id }}"><i class="fa fa-arrow-circle-down"></i></a>
                                                    <a title="Block" class="BlockActivateBuyer btn btn-danger btn-xs" data-id = "{{ $item->id }}"><i class="fa fa-times"></i></a>
                                                @elseif($item->status == 'IN' || $item->status == 'B')
                                                    <a title="Activate" class="ActivateBuyer btn btn-success btn-xs" data-id = "{{ $item->id }}"><i class="fa fa-arrow-circle-up"></i></a>
                                                @endif
                                                @if($item->status == 'A')
                                                    <a title="Delete" class="DeleteBuyer btn btn-danger btn-xs" data-id = "{{ $item->id }}"><i class="fa fa-trash"></i></a>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach --}}
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
                            else if(api_item.status === 'L'){
                                return "<p class ='text-center '>Local</p>";
                            }
                            else{
                                return "<p class ='text-center '>Both</p>";
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
                console.log(data);
                var url = '{{ route('admin.save-supplier') }}';
                //console.log(data);
                $.ajax({
                    url: url,
                    method:'POST',
                    data:data,
                    success:function(data){
                        console.log(data);
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

        $('#advanced-usage').on('click',".EditSupplier", function(){
            var button = $(this);
            var BuyerID = button.attr("data-id");
            var url = '{{ route('admin.edit-supplier') }}';
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
            var FactoryID = button.attr("data-id");
            var url = '{{ route('admin.edit-supplier') }}';
            $.ajax({
                url: url,
                method:'POST',
                data:{id: FactoryID},
                success:function(data){
                    // console.log(data);
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

        $('#advanced-usage').on('click',".EditSupplier", function(){
            var button = $(this);
            var FactoryID = button.attr("data-id");
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
                data:{id: FactoryID},
                success:function(data){
                    $('input[name=name]').val(data.name);
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
                text: 'This supplier will be a active one!',
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

        $('#advanced-usage').on('click',".DeActivateSupplier", function(){
            var button = $(this);
            var id = button.attr("data-id");
            var url = '{{ route('admin.in-activate-sub-contractor') }}';
            swal({
                title: 'Are you sure?',
                text: 'This sub-contractor will be in-active!',
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

        function refresh()
        {
            window.location.href = window.location.href.replace(/#.*$/, '');

        }

        function iconChange() {

            $('#iconChange').find('i').addClass('fa-edit');

        }
    </script>
@endsection()

