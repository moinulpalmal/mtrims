<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
</head>
<body>
<style>
    *{
        font-family: sans-serif; /* Change your font family */
    }

    .top-table{
        border-collapse: collapse;
        margin: 25px 0;
        width: 100%;
        border-radius: 5px 5px 0 0;
        overflow: hidden;
    }
    .top-table thead tr{
        text-align: center;
    }

    .top-table th,
    .top-table td {
        padding: 1px 1px 1px 1px;
    }

    .content-table {
        border-width: 1px;
        border-color: #003398;
        /*border-collapse: collapse;*/
        margin: 25px 0;
        font-size: 0.9em;
        width: 100%;
        border-radius: 5px 5px 0 0;
        overflow: hidden;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
    }

    .content-table thead tr {
        background-color: #009879;
        color: #ffffff;
        text-align: left;
        font-weight: bold;
    }

    .content-table th,
    .content-table td {
        padding: 1px 1px 1px 1px;
    }

    .content-table tbody tr {
        border-bottom: 1px solid #dddddd;
    }

    .content-table tbody tr:nth-of-type(even) {
        background-color: #f3f3f3;
    }

    .content-table tbody tr:last-of-type {
        border-bottom: 2px solid #009879;
    }

    .content-table tbody tr.active-row {
        font-weight: bold;
        color: #009879;
    }

    .content-table tbody tr p {
        font-size: xx-small;
    }

    p{
        font-size: xx-small;
    }

    ol{
        font-size: xx-small;
    }

</style>

<table class = "top-table">
    <tbody >
    <tr>
        <td style="text-align:center; width: 20cm;" colspan="4">
            <h2>Hamza Trims Limited</h2>
            <p style="font-size: xx-small; ">
                <b>Corporate Head Office:</b> 9/Kha Confidence Center, Shahazadpur, Gulshan, Dhaka-1212
                <br>
                <b>Factory:</b> Bangabandhu Road, Tongibari, Ashulia, Dhaka.
            </p>
            <h4>PROFORMA INVOICE</h4>
        </td>
    </tr>
    <tr>
        <td style="text-align:left; width: 1cm;">
            <strong>To:</strong>
        </td>
        <td style="text-align:left; width: 8cm;">
            <p>
                &nbsp;
                &nbsp;
                &nbsp;
                &nbsp;
            </p>

        </td>
        <td style="text-align:left; width: 4cm;"></td>
        <td style="width: 7cm;">
            <p style="text-align: right; font-size: x-small;">
                <strong>P/I No: HTL - {{$trimsType->short_name}} {{$purchaseOrder->job_no}}/{{$purchaseOrder->job_year}}</strong>
                <br>
                <strong>Date: {{\Carbon\Carbon::parse($purchaseOrder->po_date)->format('d/m/Y')}}</strong>
            </p>
        </td>
    </tr>
    <tr>
        <td style="text-align:left; width: 20cm;" colspan="4">
            <strong>BUYER: </strong>{{$buyer->name}}
        </td>
    </tr>
    </tbody>
</table>

<table class="content-table" >
    <thead>
    <tr >
        <th style="width: 0.7cm; text-align: center">
            <small><b>Sl#</b></small>
        </th>
        <th style="width: 1.7cm; text-align: center">
            <small><b>Style No</b></small>
        </th>
        <th style="width: 4.9cm; text-align: center">
            <small><b>Item Description</b></small>
        </th>
        <th style="width: 1.5cm; text-align: center">
            <small><b>Color</b></small>
        </th>
        <th style="width: 1cm; text-align: center">
            <small><b>Unit</b></small>
        </th>
        <th style="width: 2cm; text-align: center">
            <small><b>Qty</b></small>
        </th>
        <th style="width: 2cm; text-align: center">
            <small><b>Gross Qty</b></small>
        </th>
        <th style="width: 2cm; text-align: center">
            <small><b>Unit Price</b></small>
        </th>
        <th style="width: 2cm; text-align: center">
            <small><b>Add {{$addAmount}}%</b></small>
        </th>
        <th style="width: 2.5cm; text-align: center">
            <small><b>Total Amount</b></small>
        </th>
        {{--<th style="width: 2cm; text-align: center">
            <small><b>Remarks</b></small>
        </th>--}}
    </tr>
    </thead>
    <tbody>
    <tr>
        @php($i = 1)
        @foreach($purchaseOrderDetails as $item)
        <td style="width: 0.7cm; text-align: left">
            <p style="text-align: center; font-size: xx-small;">
                {{$i++}}
            </p>
        </td>
        <td style="width: 1.7cm; text-align: left">
            <p style="text-align: left; font-size: xx-small;">
                {{$item->style_no}}
            </p>
        </td>
        <td style="width: 2cm; text-align: left">
            <p style="text-align: left; font-size: xx-small;">
                {{$item->item_size}} {{$item->item_description}}
            </p>
        </td>
        <td style="width: 1.5cm; text-align: left">
            <p style="text-align: left; font-size: xx-small;">
                {{$item->item_color}}
            </p>
        </td>
        <td style="width: 1cm; text-align: center">
            <p style="text-align: center; font-size: xx-small;">
                {{ (App\Helpers\Helper::IDwiseData('units','id',$item->item_unit_id))->short_unit }}
            </p>
        </td>
        <td style="width: 2cm; text-align: right">
            <p style="text-align: right; font-size: xx-small;">
                {{$item->item_order_quantity}}
            </p>
        </td>
        <td style="width: 2cm; text-align: right">
            <p style="text-align: right; font-size: xx-small;">
                {{$item->gross_item_order_quantity}}
            </p>
        </td>
        <td style="width: 2cm; text-align: right">
            <p style="text-align: right; font-size: xx-small;">
                $ {{$item->unit_price_in_usd}}
            </p>
        </td>
            <td style="width: 2cm; text-align: right">
                <p style="text-align: right; font-size: xx-small;">
                    $ {{$item->gross_unit_price}}
                </p>
            </td>
        <td style="width: 2.5cm; text-align: right">
            <p style="text-align: right; font-size: xx-small;">
                $ {{$item->total_price_in_usd}}
            </p>
        </td>
        {{--<td style="width: 2cm; text-align: right;">
            <p style="text-align: right; font-size: small;">
                {{$item->remarks}}
            </p>
        </td>--}}
    </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr style="border-bottom: 4px solid #009879;">
        <td colspan="9">
            <p style="text-align: right"><b>Total:</b></p>
        </td>
        <td colspan="2">
            <p style="text-align: right"><b>$ {{$orderPrice->total_items}}</b></p>
        </td>
    </tr>
    </tfoot>
</table>
<p style="text-align: left; font-size: small"><b>In Word: </b>{!! $proformaInvoice->amount_in_words !!}</p>
<h5 style="text-align: left;">TERMS & CONDITIONS</h5>
<p style="text-align: left; font-size: xx-small;">{!! $proformaInvoice->terms_conditions !!}</p>
<h5 style="text-align: left;">BANKER:</h5>
<p style="text-align: left; font-size: xx-small;">{!! $proformaInvoice->bank_information !!}</p>
<p style="text-align: left; font-size: xx-small;">For & on behalf of<br><b>Hamza Trims Limited</b></p>
<br>
<br>
<br>
<hr style="width: 30%; text-align:left;margin-left:0">
<p style="text-align: left; margin-top: 0;"><b>Authorized Signature</b></p>
</body>
</html>
