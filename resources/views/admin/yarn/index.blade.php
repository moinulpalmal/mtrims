@extends('layouts.admin.admin-master')
@section('title')
    Yarn Setup
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
            <h2>Yarns Types <span>Yarn List</span></h2>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{route('admin.home')}}"><i class="fa fa-home"></i> Administration</a>
                    </li>
                    <li>
                        <a href="{{route('admin.yarn.count')}}"> Yarn Setup</a>
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
                            <h1 class="custom-font"><strong>Yarn Setup</strong> Insert/Update Form</h1>
                            <a><button id="iconChange" class="pull-right btn-info btn-xs" type="submit"><i class="fa fa-check"></i></button></a>
                        </div>
                        <!-- /tile header -->
                        <!-- tile body -->
                        <div class="tile-body">
                            <input type="hidden" id="HiddenFactoryID" name="id">
                            <div class="row" style="padding: 0px 15px;">

                                <div class="col-md-3 no-padding">
                                    <div class="form-group">
                                        <label for="YarnTypeName" class="control-label">Select Yarn Type</label>
                                        <select class="form-control typelect2" name="yarn_type"  id="YarnTypeName" style="width: 100% !important; height: 100% !important;" onchange="javascript:getYarnCount(this)" required>
                                            <option value="" selected="selected">- - - Select - - -</option>
                                                @if(!empty($types))
                                                    @foreach($types as $type)
                                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                                    @endforeach
                                                @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 no-padding">
                                    <div class="form-group">
                                        <label for="YarnCountName" class="control-label">Select Yarn Count</label>
                                        <select class="form-control select2" name="yarn_count"  id="YarnCountName" style="width: 100%;" required>
                                            <option value="" selected="selected">- - - Select - - -</option>
                                                @if(!empty($counts))
                                                    @foreach($counts as $type)
                                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                                    @endforeach
                                                @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2 no-padding">
                                    <div class="form-group">
                                        <label for="YarnColorName" class="control-label">Yarn Color</label>
                                        <input type="text" class="form-control" name="color" id="YarnColorName" placeholder="Enter yarn color" required="">
                                    </div>
                                </div>
                                <div class="col-md-4 no-padding">
                                    <div class="form-group">
                                        <label for="Remarks" class="control-label">Remarks</label>
                                        <input type="text" class="form-control" name="remarks" id="Remarks" placeholder="Enter remarks" required="">
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
                        <h1 class="custom-font"><strong>Yarn</strong> List</h1>
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
                                    <th class="text-center">Type</th>
                                    <th class="text-center">Count</th>
                                    <th class="text-center">Color</th>
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
            $('.typelect2').select2();
        });

        function loadDataTable() {
            table.destroy();
            var free_table = '<tr><td class="text-center" colspan="4">--- Please Wait... Loading Data  ----</td></tr>';
            $('#advanced-usage').find('tbody').append(free_table);
            table = $("#advanced-usage").DataTable({
                ajax: {
                    url: "/mtrims/public/api/admin/yarn-setup/not-deleted",
                    dataSrc: ""
                },
                columns: [
                    {
                        data: "type",
                        render: function (data) {
                            return "<p class = 'text-left'>"+ data +"</p>";
                        }
                    },
                    {
                        data: "count",
                        render: function (data) {
                            return "<p class = 'text-left'>"+ data +"</p>";
                        }
                    },
                    {
                        data: "color",
                        render: function (data) {
                            return "<p class = 'text-center'>"+ data +"</p>";
                        }
                    },

                    {
                        data: "remarks",
                        render: function (data) {
                            return "<p class = 'text-left'>"+ data +"</p>";
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

        function getYarnCount(_yarn_type) {
            var id = _yarn_type.value;
            //var rowID = _category.getAttribute("data-id");
           // var targetID = 'SubCategoryID'+ rowID;
            var url = '{{ route('admin.yarn.count.drop-down-list') }}';
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
            });
            if(id)
            {
                $.ajax({
                    url : url,
                    data:{YarnTypeID: id},
                    type : "POST",
                    dataType : "json",
                    success:function(data)
                    {
                        //console.log(data);
                        defaultKey = " ";
                        defaultValue = "- - - Select - - -";
                        $('select[id= "YarnCountName"]').empty();

                        $('select[id= "YarnCountName"]').append('<option value="'+ defaultKey +'">'+ defaultValue +'</option>');
                        $.each(data, function(key,value){
                            //console.log(data);
                            $('select[id= "YarnCountName"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                        $('#YarnCountName').trigger('chosen:updated');
                    }
                });
            }
            else
            {
                defaultKey = " ";
                defaultValue = "- - - Select - - -";

                $('select[id= "YarnCountName"]').empty();
                $('select[id= "YarnCountName"]').append('<option value="'+ defaultKey +'">'+ defaultValue +'</option>');
                $('#YarnCountName').trigger('chosen:updated');
            }
        };

        $(function(){
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
            });
            $('#FactoryAdd').submit(function(e){
                e.preventDefault();
                var data = $(this).serialize();
                var id = $('#HiddenFactoryID').val();
                //console.log(data);
                var url = '{{ route('admin.yarn.setup.save') }}';
                //console.log(url);
                //return;
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


        $('#advanced-usage').on('click',".EditFactory", function(){
            var button = $(this);
            var FactoryID = button.attr("data-id");
            //$('body').animate({scrollTop:0}, 400);
            window.scrollTo({
                top: 0,
                left: 0,
                behavior: 'smooth'
            });
            var url = '{{ route('admin.yarn.setup.edit') }}';
            $.ajax({
                url: url,
                method:'POST',
                data:{id: FactoryID},
                success:function(data){
                    //console.log(data);
                    $('input[name=color]').val(data.color);
                    $('input[name=remarks]').val(data.remarks);
                    $('input[name=id]').val(data.id).change();
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
        /*$('#advanced-usage').on('click',".ActivateBuyer", function(){
            var button = $(this);
            var id = button.attr("data-id");
            var url = '{{ route('admin.yarn.setup.activate') }}';
            swal({
                title: 'Are you sure?',
                text: 'This yarn will be a active one!',
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
            var url = '{{ route('admin.yarn.count.de-activate') }}';
            swal({
                title: 'Are you sure?',
                text: 'This yarn will be in-active!',
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
                                        console.log(value);
                                        window.location.href = window.location.href.replace(/#.*$/, '');
                                    }
                                });
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
            var url = '{{ route('admin.yarn.count.delete') }}';
            swal({
                title: 'Are you sure?',
                text: 'This yarn setup will be removed permanently!',
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
                                text: "Something wrong happened please check!",
                                icon: "error",
                                button: "Ok!",
                                className: "myClass",
                            });
                        }
                    })
                }
            });
        });*/

        function refresh()
        {
            window.location.href = window.location.href.replace(/#.*$/, '');

        }

        function iconChange() {

            $('#iconChange').find('i').addClass('fa-edit');

        }
    </script>
@endsection()



