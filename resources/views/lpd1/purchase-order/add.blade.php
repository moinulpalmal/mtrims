@extends('layouts.lpd1.lpd-1-master')
@section('title')
    New Purchase Order
@endsection
@section('content')
    <style type="text/css">
        th{
            background-color: #0689bd;
            color: white;
            font-size: x-small;
            /*height: 10px !important;*/
        }
        td{
            font-size: x-small;
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
            <h2>LPD-1 <span>// Local Purchase Division Section: 1</span></h2>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{route('lpd1.home')}}"><i class="fa fa-home"></i> LPD-1</a>
                    </li>
                    <li>
                        <a href="{{route('lpd1.purchase.order')}}"> Purchase Order</a>
                    </li>
                    <li>
                        <a href="{{route('lpd1.purchase.order.new')}}"> New Purchase Order</a>
                    </li>
                </ul>

            </div>
        </div>
        <!-- row -->
        <form method="post" name="PurchaseOrderForm" onsubmit="return validateForm()" action="{{route('lpd1.purchase.order.save')}}" enctype="multipart/form-data" >
            {{ csrf_field() }}
            @include('lpd1.purchase-order.input-form')
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
            //load wysiwyg editor
            /* $(document).ready(function() {
                 $('#myTable').DataTable();
             } );*/

            $('.select2').select2();
            sessionStorage.clear()

        });

        $(document).ready(function(){
            $("#HasFlowCount").click(function () {
                $("#IsCheck").toggle();
            });
        });

        function getTrimsTypeCode(_category) {
            var categoryId = _category.value;
            var rowID = _category.getAttribute("data-id");
            //var
            var targetID = 'grossID'+ rowID;
            var targetID2 = 'AddParcentID'+ rowID;
            //console.log(targetID);
            var url = '{{ route('admin.trims-type.get-code') }}';
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
            });
            if(categoryId)
            {
                $.ajax({
                    url : url,
                    data:{id: categoryId},
                    type : "POST",
                    dataType : "json",
                    success:function(data){
                        document.getElementById(targetID).value = data.gross_calculation_amount;
                        document.getElementById(targetID2).value = data.add_amount_percent;
                    }
                });
            }
            else
            {
                document.getElementById(targetID).value = 0;
                document.getElementById(targetID2).value = 0;
            }
        }

        $('.addRow').on('click',function(){
            //var trims_type = document.forms["PurchaseOrderForm"]["trims_type"].value;
            addRow();
            /*if(trims_type == ""){
                swal({
                    title: "Select Trims Type!",
                    icon: "warning",
                    button: "Ok!",
                });
                return false;
            }
            else{
                addRow();
            }*/

        });

        function validateForm() {
            var rowID = sessionStorage.getItem("rowID");

            if(rowID){
                rowID = parseInt(rowID);
            }
            else{
                rowID = 0;
            }
            //console.log(rowID);
            //return false;
            var factory_name = document.forms["PurchaseOrderForm"]["factory_name"].value;
            var buyer_name = document.forms["PurchaseOrderForm"]["buyer_name"].value;
            var primary_delivery_location = document.forms["PurchaseOrderForm"]["primary_delivery_location"].value;
            //var trims_type = document.forms["PurchaseOrderForm"]["trims_type"].value;
            if(buyer_name == ""){
                swal({
                    title: "Select Buyer Name!",
                    icon: "warning",
                    button: "Ok!",
                });
                return false;
            }
            else if(primary_delivery_location == ""){
                swal({
                    title: "Select Primary Delivery Location!",
                    icon: "warning",
                    button: "Ok!",
                });
                return false;
            }
            else if(factory_name == ""){
                swal({
                    title: "Select Factory Name!",
                    icon: "warning",
                    button: "Ok!",
                });
                return false;
            }
            else if(rowID <= 0){
                //console.log(rowID);

                swal({
                    title: "Empty item list!",
                    icon: "warning",
                    button: "Ok!",
                });
                sessionStorage.setItem("rowID", rowID);
                return false;
            }



        }

        function addRow()
        {
            var rowID = sessionStorage.getItem("rowID");
            if(rowID){
                rowID = parseInt(rowID);
                rowID++;
            }else{
                rowID = 0;
                rowID++;
            }
            sessionStorage.setItem("rowID", rowID);
            var tr = '<tr>'+
                '<td width="7%"><input type="text" class="form-control StyleNo" name="style_no['+rowID+']" required=""></td>'+
                '<td width="5%">'+
                '<select style="width: 100%;" class="form-control select2 TrimsTypeID" data-id = "'+rowID+'" name="trims_type['+rowID+']" id="TrimsTypeID'+rowID+'" required="" onchange="javascript:getTrimsTypeCode(this)">'+
                '<option value = "">- Select -</option>'+
                '@if(!empty($trimsTypes))'+
                '@foreach($trimsTypes as $item)'+
                '<option value="{{ $item->id }}">{{ $item->name }}</option>'+
                '@endforeach'+
                '@endif'+
                '</select>'+
                '</td>'+
                '<td width="10%"><input type="text" class="form-control ItemSize" name="item_size['+rowID+']" required=""></td>'+
                '<td width="6%"><input type="text" class="form-control ItemColor" name="item_color['+rowID+']" required=""></td>'+
                '<td width="10%"><input type="text" class="form-control ItemDescription" name="item_description['+rowID+']" required=""></td>'+
                '<td width="6%">'+
                '<select style="width: 100%;" class="form-control select2 UnitID" name="item_unit['+rowID+']" id="UnitID'+rowID+'" required="">'+
                '<option value = "">- Select -</option>'+
                '@if(!empty($units))'+
                '@foreach($units as $item)'+
                '<option value="{{ $item->id }}">{{ $item->full_unit }}</option>'+
                '@endforeach'+
                '@endif'+
                '</select>'+
                '</td>'+
                '<td width="7%"><input type="text" class="form-control ItemRemarks" name="item_remarks['+rowID+']" ></td>'+
                '<td width="8%"><input type="number" step="any" class="form-control qty" name="quantity['+rowID+']" required="" ></td>'+
                '<td width="5%"><input type="number" step="any" class="form-control gross" name="gross['+rowID+']" id = "grossID'+rowID+'" required=""></td>'+
                '<td width="8%"><input type="number" step="any" readonly step="any" class="form-control g_qty" name="gross_quantity['+rowID+']"></td>'+

                '<td width="8%"><input type="number" step="any" class="form-control UnitPrice" name="unit_price['+rowID+']" required=""></td>'+
                '<td width="5%"><input type="number" step="any" class="form-control AddPercent" name="add_percent['+rowID+']" id="AddParcentID'+rowID+'" required=""></td>'+
                '<td width="9%"><input type="number" step="any" readonly class="form-control GrossUnitPrice"  name="gross_unit_price['+rowID+']"></td>'+

                '<td width="9%"><input type="number" step="any" class="form-control Total" readonly = "" name="total['+rowID+']" required=""></td>'+
                '<td width="2%" class="text-center"><a href="#" class="btn-danger btn-sm remove"><i class="fa fa-trash"></i></a></td>'+
                '</tr>';
            $('#myTable').find('tbody:last').append(tr);
            $("select.select2").select2();
            //$('.chosen-select').trigger('chosen:updated');
        };

        $('body').delegate('.remove','click',function(){

            var l = $('#myTable >tbody >tr').length;
            if(l == 1)
            {
                $("select.select2").select2();
                //alert('Not allowed to remove this row!');
                swal({
                    title: "Not allowed to remove this row!",
                    icon: "warning",
                    button: "Ok!",
                })
            }
            else
            {
                $(this).parent().parent().remove();
                $("select.select2").select2();

            }
        });

        $('tbody').delegate('.qty,.UnitPrice,.Total, .AddPercent, .gross, .GrossUnitPrice','keyup',function(){
            var tr = $(this).parent().parent();
            var qty = parseFloat(tr.find('.qty').val()).toFixed(5);

            //var gross_qty_factory = parseFloat(document.forms["PurchaseOrderForm"]["gross_calculation_amount"].value).toFixed(3);
            var gross_qty_factory = parseFloat(tr.find('.gross').val()).toFixed(5);
            //console.log(gross_qty_factory);
            //return;

            var g_qty = parseFloat(qty/gross_qty_factory).toFixed(3);
            //console.log(g_qty);
            //return;

            tr.find('.g_qty').val(g_qty);

            var unit_price = parseFloat(tr.find('.UnitPrice').val()).toFixed(5);


            var add_amount = parseFloat(tr.find('.AddPercent').val()).toFixed(5);
            // console.log(add_amount);
            //return;
            var total_unit_price = ((100*unit_price) + (unit_price *  add_amount))/100;

            var g_unit_price = parseFloat(total_unit_price).toFixed(5);
            tr.find('.GrossUnitPrice').val(g_unit_price);
            var dis = 0;
            var total = parseFloat((g_qty * g_unit_price) - (g_qty*g_unit_price*dis)/100).toFixed(5);

            tr.find('.Total').val(parseFloat(total).toFixed(3));

            tr.find('.withoutdiscount').val(qty*g_unit_price);
            GrandTotal();
            //netAmount();
        });

        function GrandTotal()
        {
            var GrandTotal = 0;
            $('.Total').each(function(i,e){
                var Total = $(this).val() - 0;
                GrandTotal = GrandTotal + Total;
            });
            //document.getElementById("TotalInvoiceAmount").value = Number(GrandTotal);
            $('.GrandTotal').html(GrandTotal.toMoney(3,'.',','));
        };
        Number.prototype.toMoney = function(decimals, decimal_sep, thousands_sep)
        {
            var n = this,
                c = isNaN(decimals) ? 2 : Math.abs(decimals),
                d = decimal_sep || '.',
                t = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                sign = (n < 0) ? '-' : '',
                i = parseInt(n = Math.abs(n).toFixed(c)) + '',
                j = ((j = i.length) > 3) ? j % 3 : 0;
            return sign + (j ? i.substr(0, j) + t : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : '');
        }
    </script>
    {{--<script type="text/javascript">

    </script>--}}
@endsection

