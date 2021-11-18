<?php

namespace App\Http\Controllers\Production;

use App\Buyer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductionSearchController extends Controller
{
    public function lpdPOSearch(){
        //search by lpd-po
        return view('production.search.lpd-po');
    }

    public function buyerSearch(){
        $buyers = Buyer::orderBy('name')->where('status', '!=', 'D')->get();
        return view('production.search.buyer', compact('buyers'));
    }

    public function lpdPOSearchResult(Request $request){
        $purchaseOrderDetails = DB::table('purchase_order_details')
            ->join('purchase_order_masters', 'purchase_order_details.purchase_order_master_id', '=', 'purchase_order_masters.id')
            ->join('units', 'purchase_order_details.item_unit_id', '=', 'units.id')
            ->join('trims_types', 'purchase_order_masters.trims_type_id', '=', 'trims_types.id')
            ->join('buyers', 'purchase_order_masters.buyer_id', '=', 'buyers.id')
            ->select('purchase_order_masters.lpd_po_no', 'buyers.name AS buyer_name',
                'purchase_order_masters.id AS POM_ID', 'purchase_order_details.item_color',
                'purchase_order_details.item_description', 'purchase_order_details.style_no', 'purchase_order_details.status',
                'purchase_order_details.item_count AS POD_ID', 'purchase_order_details.item_size',
                'trims_types.name AS trims_type_name', 'units.short_unit', 'purchase_order_masters.approved_production_start_date'
                , 'purchase_order_masters.trims_type_id', 'purchase_order_masters.approved_delivery_end_date')
            ->selectRaw('(purchase_order_details.item_order_quantity-purchase_order_details.finished_quantity) AS not_finished_quantity')
            ->where('purchase_order_masters.status', '!=','D')
            ->where('purchase_order_details.status', '!=','D')
            ->where('purchase_order_masters.lpd_po_no', '=', $request->lpd_po_no)
            ->get();
    }
}
