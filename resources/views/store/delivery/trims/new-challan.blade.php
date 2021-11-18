@extends('layouts.store.store-master')
@section('title')
    New Delivery Challan
@endsection
@section('content')
    <style type="text/css">
        th{
            background-color: #0689bd;
            color: white;
            font-size: x-small !important;
            /*font-size: x-small;
            height: 10px !important;*/
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
        <div class="pageheader">
            <h2>Store <span>// New Trims Delivery Challan</span></h2>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{route('store.home')}}"><i class="fa fa-home"></i> Store</a>
                    </li>
                    <li>
                        <a href="{{route('store.stock.trims')}}"> Current Stock</a>
                    </li>
                    <li>
                        <a href="#"> New Delivery Challan # {{$purchaseOrderMaster->lpd_po_no}}</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- row -->
        <form method="post" name="PurchaseOrderForm" onsubmit="return validateForm()" action="{{route('store.delivery.trims.po.challan.save')}}" enctype="multipart/form-data" >
            {{ csrf_field() }}
            @include('store.delivery.trims.new-challan-form')
        </form>
        <!-- /row -->
    </div>
@endsection

@section('pageScripts')
    <script>
        function refresh()
        {
            window.location.href = window.location.href.replace(/#.*$/, '');

        }

        $(window).load(function(){
            $('.select2').select2();
            sessionStorage.clear();
        });

        $('tbody').delegate('.StockQty,.DStockQty,.Total, .GrossQty','keyup',function(){
            var tr = $(this).parent().parent();
            //var qty = parseFloat(tr.find('.qty').val()).toFixed(5);

            //var gross_qty_factory = parseFloat(document.forms["PurchaseOrderForm"]["gross_calculation_amount"].value).toFixed(3);

            var stock_qty = parseFloat(tr.find('.StockQty').val()).toFixed(5);
            var d_stock_qty = parseFloat(tr.find('.DStockQty').val()).toFixed(5);
            var gross = parseFloat(tr.find('.GrossQty').val()).toFixed(5);
            //console.log(d_stock_qty);
            //console.log(stock_qty);
            //return;
            /*if(d_stock_qty > stock_qty){
                swal({
                    title: "Invalid Delivery Stock Quantity!",
                    icon: "warning",
                    button: "Ok!",
                }).then(function (value) {
                    //console.log(value);
                    if(value){
                        tr.find('.DStockQty').val(0).change();
                        tr.find('.Total').val(0).change();
                        return;
                    }
                });
                //return;
            }*/
            //var total = parseFloat(d_stock_qty/gross).toFixed(3);
            //console.log(g_qty);
            //return;

            tr.find('.Total').val(Math.ceil(parseFloat(d_stock_qty/gross).toFixed(2)));

            //netAmount();
        });

       /* function getTrimsTypeCode(_category) {
            var categoryId = _category.value;
            var rowID = _category.getAttribute("data-id");
            //var
            var gross_qty_factor_id = 'gross_qty_factor'+ rowID;
            var delivery_stock_quantity_id = 'delivery_stock_quantity'+ rowID;
            var delivery_quantity_id = 'delivery_quantity'+ rowID;
            var trims_type_id = 'trims_type_id'+ rowID;

            var trims_type = parseInt(document.getElementById(trims_type_id).value);
            if(trims_type === 1){
                document.getElementById(gross_qty_factor_id).value = 48;
                var delievery_stock_qty = parseFloat(document.getElementById(delivery_stock_quantity_id).value).toFixed(5);

                if(delievery_stock_qty <= 0){
                    document.getElementById(delivery_stock_quantity_id).value = 0;
                    document.getElementById(delivery_quantity_id).value = 0;
                    document.getElementById(gross_qty_factor_id).value = 0;
                }
                else{
                    if(categoryId === 'P'){
                        document.getElementById(delivery_stock_quantity_id).value = 0;
                        document.getElementById(delivery_quantity_id).value = 0;
                    }
                    else if(categoryId === 'C'){
                        document.getElementById(delivery_stock_quantity_id).value = 0;
                        document.getElementById(delivery_quantity_id).value = 0;
                        document.getElementById(gross_qty_factor_id).value = 0;
                    }
                    else if(categoryId === ''){
                        document.getElementById(delivery_stock_quantity_id).value = 0;
                        document.getElementById(delivery_quantity_id).value = 0;
                        document.getElementById(gross_qty_factor_id).value = 0;
                    }
                    else{
                        var gross_qty_factor = parseFloat(document.getElementById(gross_qty_factor_id).value).toFixed(5);
                        //var main_delivery = parseFloat(delievery_stock_qty/gross_qty_factor).toFixed(2);
                        //var int_main_delivery = parseInt(main_delivery);
                        //var float_main_delivery = main_delivery - parseFloat(int_main_delivery);
                        document.getElementById(delivery_quantity_id).value = Math.ceil(parseFloat(delievery_stock_qty/gross_qty_factor).toFixed(2));
                    }
                }
            }
            else if(trims_type === 6){
                document.getElementById(gross_qty_factor_id).value = 1;
                var delievery_stock_qty = parseFloat(document.getElementById(delivery_stock_quantity_id).value).toFixed(5);
                if(delievery_stock_qty <= 0){
                    document.getElementById(delivery_stock_quantity_id).value = 0;
                    document.getElementById(delivery_quantity_id).value = 0;
                    document.getElementById(gross_qty_factor_id).value = 0;
                }
                else{
                    if(categoryId === 'C'){
                        var gross_qty_factor = parseFloat(document.getElementById(gross_qty_factor_id).value).toFixed(5);
                        //var main_delivery = parseFloat(delievery_stock_qty/gross_qty_factor).toFixed(2);
                        //var int_main_delivery = parseInt(main_delivery);
                        //var float_main_delivery = main_delivery - parseFloat(int_main_delivery);
                        document.getElementById(delivery_quantity_id).value = Math.ceil(parseFloat(delievery_stock_qty/gross_qty_factor).toFixed(2));
                    }
                    else{
                        document.getElementById(delivery_stock_quantity_id).value = 0;
                        document.getElementById(delivery_quantity_id).value = 0;

                    }
                }
            }
            else{
                if(categoryId === 'P'){
                    document.getElementById(gross_qty_factor_id).value = 1;
                    var delievery_stock_qty_pcs = parseFloat(document.getElementById(delivery_stock_quantity_id).value).toFixed(5);
                    var gross_qty_factor_pcs = parseFloat(document.getElementById(gross_qty_factor_id).value).toFixed(5);
                    document.getElementById(delivery_quantity_id).value = Math.ceil(parseFloat(delievery_stock_qty_pcs/gross_qty_factor_pcs).toFixed(2));
                }
                else if(categoryId === 'C'){
                    document.getElementById(delivery_stock_quantity_id).value = 0;
                    document.getElementById(delivery_quantity_id).value = 0;
                    document.getElementById(gross_qty_factor_id).value = 0;
                }
                else if(categoryId === ''){
                    document.getElementById(gross_qty_factor_id).value = 0;
                    document.getElementById(delivery_stock_quantity_id).value = 0;
                    document.getElementById(delivery_quantity_id).value = 0;
                }
                else{
                    document.getElementById(gross_qty_factor_id).value = 100;
                    var delievery_stock_qty_o = parseFloat(document.getElementById(delivery_stock_quantity_id).value).toFixed(5);
                    var gross_qty_factor_o = parseFloat(document.getElementById(gross_qty_factor_id).value).toFixed(5);
                    document.getElementById(delivery_quantity_id).value = Math.ceil(parseFloat(delievery_stock_qty_o/gross_qty_factor_o).toFixed(2));
                }
            }

           // document.getElementById(targetID).value = data.gross_calculation_amount;


        }*/

        function validateForm() {
            //console.log(rowID);
            //return false;
           // var factory_name = document.forms["PurchaseOrderForm"]["factory_name"].value;
            //var buyer_name = document.forms["PurchaseOrderForm"]["buyer_name"].value;
            var primary_delivery_location = document.forms["PurchaseOrderForm"]["delivery_location_name"].value;
            var transport_licence_id = document.forms["PurchaseOrderForm"]["transport_licence_no"].value;
            //var trims_type = document.forms["PurchaseOrderForm"]["trims_type"].value;

            if(primary_delivery_location === ""){
                swal({
                    title: "Select Delivery Location!",
                    icon: "warning",
                    button: "Ok!",
                });
                return false;
            }
            else if(transport_licence_id === ""){
                swal({
                    title: "Select Transport Licence No!",
                    icon: "warning",
                    button: "Ok!",
                });
                return false;
            }
            else {
                return true;
            }
        }
    </script>
    {{--<script type="text/javascript">

    </script>--}}
@endsection


