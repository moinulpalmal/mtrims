<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\TrimsType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrimsDeliveryReportController extends Controller
{
    public function index(){
        $trimsTypes = TrimsType::GetAllActiveTrimsTypesForSelectField();
        return view('store.delivery.trims.report.index', compact('trimsTypes'));
    }

    public function generateReport(Request $request){
        $reportData = null;
        $from_date = $request->from_date;
        $to_date = $request->to_date;

        if($request->trims_type == 'A'){
            $reportData = DB::table('delivery_details')
                ->join('delivery_masters', 'delivery_masters.id', '=', 'delivery_details.delivery_master_id')
                ->join('purchase_order_details', function ($join) {
                    $join->on('purchase_order_details.item_count', '=', 'delivery_details.purchase_order_detail_id');
                    $join->on('purchase_order_details.purchase_order_master_id', '=', 'delivery_masters.purchase_order_master_id');
                })
                ->join('purchase_order_masters', 'purchase_order_details.purchase_order_master_id', '=', 'purchase_order_masters.id')
                ->join('units', 'purchase_order_details.item_unit_id', '=', 'units.id')
                ->join('buyers', 'purchase_order_masters.buyer_id', '=', 'buyers.id')
                ->join('stores', 'delivery_masters.store_id', '=', 'stores.id')
                ->join('trims_types', 'trims_types.id', '=', 'purchase_order_details.trims_type_id')
                ->select('trims_types.name AS trims_type', 'buyers.name AS buyer_name','purchase_order_masters.lpd',
                    'purchase_order_masters.lpd_po_no', 'purchase_order_details.style_no', 'stores.name AS store_name',
                    'purchase_order_details.item_size', 'purchase_order_details.item_color', 'purchase_order_details.item_description',
                    'delivery_masters.challan_date', 'delivery_masters.id AS challan_no', 'delivery_details.remarks',
                    'delivery_details.gross_delivered_quantity','units.short_unit')
                ->where('delivery_masters.status', 'AP')
                ->whereBetween('delivery_masters.challan_date', [$request->from_date, $request->to_date])
                ->orderBy('buyers.name')
                ->orderBy('trims_types.name')
                ->orderBy('delivery_masters.challan_date')
                ->get();
        }
        else{
            $reportData = DB::table('delivery_details')
                ->join('delivery_masters', 'delivery_masters.id', '=', 'delivery_details.delivery_master_id')
                ->join('purchase_order_details', function ($join) {
                    $join->on('purchase_order_details.item_count', '=', 'delivery_details.purchase_order_detail_id');
                    $join->on('purchase_order_details.purchase_order_master_id', '=', 'delivery_masters.purchase_order_master_id');
                })
                ->join('purchase_order_masters', 'purchase_order_details.purchase_order_master_id', '=', 'purchase_order_masters.id')
                ->join('units', 'purchase_order_details.item_unit_id', '=', 'units.id')
                ->join('buyers', 'purchase_order_masters.buyer_id', '=', 'buyers.id')
                ->join('stores', 'delivery_masters.store_id', '=', 'stores.id')
                ->join('trims_types', 'trims_types.id', '=', 'purchase_order_details.trims_type_id')
                ->select('trims_types.name AS trims_type', 'buyers.name AS buyer_name','purchase_order_masters.lpd',
                    'purchase_order_masters.lpd_po_no', 'purchase_order_details.style_no', 'stores.name AS store_name',
                    'purchase_order_details.item_size', 'purchase_order_details.item_color', 'purchase_order_details.item_description',
                    'delivery_masters.challan_date', 'delivery_masters.id AS challan_no', 'delivery_details.remarks',
                    'delivery_details.gross_delivered_quantity','units.short_unit')
                ->where('delivery_masters.status', 'AP')
                ->where('purchase_order_details.trims_type_id', $request->trims_type)
                ->whereBetween('delivery_masters.challan_date', [$request->from_date, $request->to_date])
                ->orderBy('buyers.name', 'ASC')
                ->orderBy('trims_types.name')
                ->orderBy('delivery_masters.challan_date')
                ->get();
        }

        //return $reportData;

        return view('store.delivery.trims.report.delivery-view',
            compact('reportData', 'from_date', 'to_date'));
    }
}
