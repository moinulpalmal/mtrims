<?php

namespace App\Http\Controllers\Merchandising;

use App\Buyer;
use App\DeliveryMaster;
use App\Factory;
use App\Http\Controllers\Controller;
use App\ProductionPlanDetailSetup;
use App\ProformaInvoice;
use App\PurchaseOrderDetail;
use App\PurchaseOrderMaster;
use App\Store;
use App\TrimsType;
use App\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MerchandisingController extends Controller
{
    public function index(){
        return view('merchandising.layout.index');
    }

    public function search(){
        return view('merchandising.search.index');
    }

    public function checkOrder(Request $request){
        $po = DB::table('purchase_order_masters')
            ->select('lpd_po_no', 'id')
            ->where('lpd', $request->lpd)
            ->where('lpd_po_no', $request->lpd_po_no)
            ->where('status','!=', 'D')
            ->first();

        if($po != null)
        {
            $yarnData = array(
                'id' => $po->id
            );
            return $yarnData;
        }

        return null;
    }

	public function getOrder(Request $request){
        $po = DB::table('purchase_order_masters')
            ->select('lpd_po_no', 'id')
            ->where('lpd', $request->lpd)
            ->where('lpd_po_no', $request->lpd_po_no)
            ->where('status','!=', 'D')
            ->first();

        if($po != null)
        {
           return redirect()->route('merchandising.purchase.order.detail', ['id' => $po->id]);
        }

        //return retrun
    }

    public function orderDetail($id){
        $purchaseOrder = PurchaseOrderMaster::find($id);

        //return $purchaseOrder;

        $purchaseOrderDetails = PurchaseOrderDetail::orderBy('item_count')
            ->where('status','!=', 'D')
            ->where('purchase_order_master_id', $id)
            ->get();


        $uniqTrimsTypes = DB::table('purchase_order_details')
                                    ->join('trims_types', 'purchase_order_details.trims_type_id', '=', 'trims_types.id')
                                    ->select('trims_types.short_name', 'trims_types.name')
                                    ->where('purchase_order_details.purchase_order_master_id', $id)
                                    ->orderBy('trims_types.name')
                                    ->groupBy('purchase_order_details.trims_type_id', 'trims_types.short_name', 'trims_types.name')
                                    ->get();

        $orderQty =  DB::table('purchase_order_details')->select(DB::raw('sum(total_price_in_usd) as total_items'))
            ->where('status', '!=', 'D')
            ->first();

        $finishedQty =  DB::table('purchase_order_details')->select(DB::raw('sum(gross_unit_price * finished_quantity) as total_items'))
            ->where('status', '!=', 'D')
            ->first();

        $deliveredQty =  DB::table('purchase_order_details')->select(DB::raw('sum(gross_unit_price * delivered_quantity) as total_items'))
            ->where('status', '!=', 'D')
            ->first();

        $subConQty =  DB::table('purchase_order_details')->select(DB::raw('sum(gross_unit_price * sub_con_order_quantity) as total_items'))
            ->where('status', '!=', 'D')
            ->first();

        $lastPi = ProformaInvoice::where('purchase_order_master_id', $id)
            ->where('status', '!=', 'D')
            ->where('pi_count', $purchaseOrder->pi_count)
            ->first();

        $proformaInvoices = ProformaInvoice::orderBy('pi_count')
            ->where('purchase_order_master_id', $id)
            ->where('status', '!=', 'D')
            ->where('pi_count', $purchaseOrder->pi_count)
            ->get();

        $productionPlanDetails = ProductionPlanDetailSetup::where('purchase_order_master_id', $id)
            ->where('status', '!=', 'D')
            ->orderBy('production_date', 'DESC')
            ->get();

        //return $productionPlanDetails;

        $deliveryMasters = DeliveryMaster::orderBy('challan_date', 'DESC')
            ->where('status', '!=', 'D')
            ->where('purchase_order_master_id', $id)
            ->get();

        //$activeProductionPlans = ProductionPlanDetailSetup::orderBy('production_date', 'ASC')->where('status', 'SI')->get();
        $deliveryData = DB::table('delivery_details')
            ->join('delivery_masters', 'delivery_masters.id', '=', 'delivery_details.delivery_master_id')
            ->join('purchase_order_details', function ($join) {
                $join->on('purchase_order_details.item_count', '=', 'delivery_details.purchase_order_detail_id');
                $join->on('purchase_order_details.purchase_order_master_id', '=', 'delivery_masters.purchase_order_master_id');
            })
            ->join('purchase_order_masters', 'purchase_order_details.purchase_order_master_id', '=', 'purchase_order_masters.id')
            ->join('units', 'purchase_order_details.item_unit_id', '=', 'units.id')
            ->join('stores', 'delivery_masters.store_id', '=', 'stores.id')
            ->join('trims_types', 'purchase_order_details.trims_type_id', '=', 'trims_types.id')
            ->select('purchase_order_masters.lpd',
                'purchase_order_masters.lpd_po_no', 'purchase_order_details.style_no', 'stores.name AS store_name',
                'purchase_order_details.item_size', 'purchase_order_details.item_color', 'purchase_order_details.item_description',
                'delivery_masters.challan_date', 'delivery_masters.id AS challan_no', 'delivery_details.remarks', 'delivery_details.total_weight',
                'delivery_details.delivered_quantity', 'delivery_details.gross_delivered_quantity', 'delivery_details.gross_unit',
                'delivery_details.gross_weight', 'delivery_masters.is_replacement_challan',
                'units.short_unit', 'delivery_masters.status', 'trims_types.name AS trims_type')
            ->where('delivery_masters.status', '!=','D')
            ->where('purchase_order_masters.id', $id)
            ->orderBy('delivery_masters.challan_date')
            ->orderBy('trims_types.name')
            ->get();

        $currentStocks = DB::table('trims_stocks')
            ->join('purchase_order_masters', 'trims_stocks.purchase_order_master_id', '=', 'purchase_order_masters.id')
            ->join('purchase_order_details', function ($join) {
                $join->on('purchase_order_details.item_count', '=', 'trims_stocks.purchase_order_detail_id');
                $join->on('purchase_order_details.purchase_order_master_id', '=', 'trims_stocks.purchase_order_master_id');
            })
            ->join('buyers', 'purchase_order_masters.buyer_id', '=', 'buyers.id')
            ->join('trims_types', 'purchase_order_details.trims_type_id', '=', 'trims_types.id')
            ->join('units', 'purchase_order_details.item_unit_id', '=', 'units.id')
            ->select('purchase_order_masters.lpd', 'trims_stocks.stock_quantity', 'trims_stocks.delivered_quantity', 'trims_stocks.id',
                'purchase_order_masters.lpd_po_no', 'purchase_order_details.style_no','buyers.name AS buyer',
                'purchase_order_details.item_size', 'purchase_order_details.item_color', 'purchase_order_details.item_description', 'trims_stocks.status',
                'units.short_unit', 'trims_types.name AS trims_type')
            ->where('trims_stocks.status','!=', 'D')
            ->where('trims_stocks.is_free_stock',false)
            ->where('purchase_order_masters.id', $id)
            ->get();
        //return $deliveryData;

        return view('merchandising.purchase-order.detail',
            compact('purchaseOrder', 'deliveryMasters',
                'purchaseOrderDetails', 'orderQty', 'finishedQty', 'deliveredQty', 'subConQty',
                'lastPi', 'proformaInvoices', 'productionPlanDetails', 'deliveryData', 'uniqTrimsTypes', 'currentStocks'));
    }

    public function orderItemDetail($id, $item){
        $purchaseOrder = PurchaseOrderMaster::find($id);
        if($purchaseOrder == null)
        {
            return redirect()->route('merchandising.purchase.order.search');
        }

        $purchaseOrderDetails = PurchaseOrderDetail::where('status','!=', 'D')
            ->where('purchase_order_master_id', $id)
            ->where('item_count', $item)
            ->first();

        //return $purchaseOrderDetail;
        if($purchaseOrderDetails != null){
            //return $purchaseOrderDetails;

            $productionPlanDetails = ProductionPlanDetailSetup::where('purchase_order_master_id', $id)
                ->where('purchase_order_detail_id', $item)
                ->where('status', '!=', 'D')
                ->orderBy('production_date', 'DESC')
                ->get();

            //return $productionPlanDetails;

           /* $deliveryData = DB::table('delivery_details')
                ->join('delivery_masters', 'delivery_masters.id', '=', 'delivery_details.delivery_master_id')
                ->join('purchase_order_details', function ($join) {
                    $join->on('purchase_order_details.item_count', '=', 'delivery_details.purchase_order_detail_id');
                    $join->on('purchase_order_details.purchase_order_master_id', '=', 'delivery_masters.purchase_order_master_id');
                })
                ->join('purchase_order_masters', 'purchase_order_details.purchase_order_master_id', '=', 'purchase_order_masters.id')
                ->join('units', 'purchase_order_details.item_unit_id', '=', 'units.id')
                ->join('production_plan_detail_setups', 'delivery_details.production_plan_detail_setup_id', '=', 'production_plan_detail_setups.id')
                ->join('stores', 'delivery_masters.store_id', '=', 'stores.id')
                ->join('trims_types', 'purchase_order_details.trims_type_id', '=', 'trims_types.id')
                ->select('purchase_order_masters.lpd', 'production_plan_detail_setups.production_date',
                    'purchase_order_masters.lpd_po_no', 'purchase_order_details.style_no', 'stores.name AS store_name',
                    'purchase_order_details.item_size', 'purchase_order_details.item_color', 'purchase_order_details.item_description',
                    'delivery_masters.challan_date', 'delivery_masters.id AS challan_no', 'delivery_details.remarks',
                    'delivery_details.delivered_quantity','units.short_unit', 'delivery_masters.status', 'trims_types.name AS trims_type', 'delivery_details.total_weight')
                ->where('delivery_masters.status', '!=','D')
                ->where('purchase_order_masters.id', $id)
                ->where('purchase_order_details.item_count', $item)
                ->orderBy('delivery_masters.challan_date')
                ->orderBy('trims_types.name')
                ->get();*/

            $deliveryData = DB::table('delivery_details')
                ->join('delivery_masters', 'delivery_masters.id', '=', 'delivery_details.delivery_master_id')
                ->join('purchase_order_details', function ($join) {
                    $join->on('purchase_order_details.item_count', '=', 'delivery_details.purchase_order_detail_id');
                    $join->on('purchase_order_details.purchase_order_master_id', '=', 'delivery_masters.purchase_order_master_id');
                })
                ->join('purchase_order_masters', 'purchase_order_details.purchase_order_master_id', '=', 'purchase_order_masters.id')
                ->join('units', 'purchase_order_details.item_unit_id', '=', 'units.id')
                ->join('stores', 'delivery_masters.store_id', '=', 'stores.id')
                ->join('trims_types', 'purchase_order_details.trims_type_id', '=', 'trims_types.id')
                ->select('purchase_order_masters.lpd',
                    'purchase_order_masters.lpd_po_no', 'purchase_order_details.style_no', 'stores.name AS store_name',
                    'purchase_order_details.item_size', 'purchase_order_details.item_color', 'purchase_order_details.item_description',
                    'delivery_masters.challan_date', 'delivery_masters.id AS challan_no', 'delivery_details.remarks', 'delivery_details.total_weight',
                    'delivery_details.delivered_quantity', 'delivery_details.gross_delivered_quantity', 'delivery_details.gross_unit',
                    'delivery_details.gross_weight',
                    'units.short_unit', 'delivery_masters.status', 'trims_types.name AS trims_type')
                ->where('delivery_masters.status', '!=','D')
                ->where('purchase_order_masters.id', $id)
                ->where('purchase_order_details.item_count', $item)
                ->orderBy('delivery_masters.challan_date')
                ->orderBy('trims_types.name')
                ->get();

            $currentStocks = DB::table('trims_stocks')
                ->join('purchase_order_masters', 'trims_stocks.purchase_order_master_id', '=', 'purchase_order_masters.id')
                ->join('purchase_order_details', function ($join) {
                    $join->on('purchase_order_details.item_count', '=', 'trims_stocks.purchase_order_detail_id');
                    $join->on('purchase_order_details.purchase_order_master_id', '=', 'trims_stocks.purchase_order_master_id');
                })
                ->join('buyers', 'purchase_order_masters.buyer_id', '=', 'buyers.id')
                ->join('trims_types', 'purchase_order_details.trims_type_id', '=', 'trims_types.id')
                ->join('units', 'purchase_order_details.item_unit_id', '=', 'units.id')
                ->select('purchase_order_masters.lpd', 'trims_stocks.stock_quantity', 'trims_stocks.delivered_quantity',
                    'purchase_order_masters.lpd_po_no', 'purchase_order_details.style_no','buyers.name AS buyer',
                    'purchase_order_details.item_size', 'purchase_order_details.item_color', 'purchase_order_details.item_description', 'trims_stocks.id',
                    'units.short_unit', 'trims_types.name AS trims_type')
                ->where('trims_stocks.status', '!=','D')
                ->where('purchase_order_masters.id', $id)
                ->where('purchase_order_details.item_count', $item)
                ->get();

            //return $deliveryData;

            return view('merchandising.purchase-order.item-detail',
                compact('purchaseOrder','purchaseOrderDetails', 'productionPlanDetails', 'deliveryData', 'currentStocks'));
        }

        return redirect()->route('merchandising.purchase.order.search');
    }

    //edit section change korte hobe

    public function planReport($id){
        $purchaseOrder = PurchaseOrderMaster::find($id);

        if($purchaseOrder == null){
            return redirect()->route('merchandising.purchase.order.search');
        }
        else if($purchaseOrder->status == 'D'){
            return redirect()->route('merchandising.purchase.order.search');
        }
        else{

            $uniqTrimsTypes = DB::table('purchase_order_details')
                                    ->join('trims_types', 'purchase_order_details.trims_type_id', '=', 'trims_types.id')
                                    ->select('trims_types.short_name', 'trims_types.name')
                                    ->where('purchase_order_details.purchase_order_master_id', $id)
                                    ->orderBy('trims_types.name')
                                    ->groupBy('purchase_order_details.trims_type_id', 'trims_types.short_name', 'trims_types.name')
                                    ->get();

            $productionPlanDetails = ProductionPlanDetailSetup::where('purchase_order_master_id', $id)
                ->where('status', '!=', 'D')
                ->orderBy('production_date', 'DESC')
                ->get();

            //return $productionPlanDetails;

            return view('merchandising.purchase-order.plan-print-view',
                compact('uniqTrimsTypes', 'productionPlanDetails', 'purchaseOrder'));
        } // other
    }

    public function planReportItem($id, $item){
        $purchaseOrder = PurchaseOrderMaster::find($id);

        if($purchaseOrder == null){
            return redirect()->route('merchandising.purchase.order.search');
        }
        else if($purchaseOrder->status == 'D'){
            return redirect()->route('merchandising.purchase.order.search');
        }
        else{

            $uniqTrimsTypes = DB::table('purchase_order_details')
                                    ->join('trims_types', 'purchase_order_details.trims_type_id', '=', 'trims_types.id')
                                    ->select('trims_types.short_name', 'trims_types.name')
                                    ->where('purchase_order_details.purchase_order_master_id', $id)
                                    ->orderBy('trims_types.name')
                                    ->groupBy('purchase_order_details.trims_type_id', 'trims_types.short_name', 'trims_types.name')
                                    ->get();

            $productionPlanDetails = ProductionPlanDetailSetup::where('purchase_order_master_id', $id)
                ->where('purchase_order_detail_id', $item)
                ->where('status', '!=', 'D')
                ->orderBy('production_date', 'DESC')
                ->get();

            //return $productionPlanDetails;

            return view('merchandising.purchase-order.plan-print-view',
                compact('uniqTrimsTypes', 'productionPlanDetails', 'purchaseOrder'));
        } // other
    }

    public function achievementReport($id){
        $purchaseOrder = PurchaseOrderMaster::find($id);
        if($purchaseOrder == null){
            return redirect()->route('merchandising.purchase.order.search');
        }
        else if($purchaseOrder->status == 'D'){
            return redirect()->route('merchandising.purchase.order.search');
        }
        else{

            $uniqTrimsTypes = DB::table('purchase_order_details')
                                    ->join('trims_types', 'purchase_order_details.trims_type_id', '=', 'trims_types.id')
                                    ->select('trims_types.short_name', 'trims_types.name')
                                    ->where('purchase_order_details.purchase_order_master_id', $id)
                                    ->orderBy('trims_types.name')
                                    ->groupBy('purchase_order_details.trims_type_id', 'trims_types.short_name', 'trims_types.name')
                                    ->get();

            $productionPlanDetails = ProductionPlanDetailSetup::where('purchase_order_master_id', $id)
                ->where('status', '!=', 'D')
                ->orderBy('production_date', 'DESC')
                ->get();

            return view('merchandising.purchase-order.achievement-print-view',
                compact('uniqTrimsTypes', 'productionPlanDetails', 'purchaseOrder'));
        } // other data
    }

    public function achievementReportItem($id, $item){

        $purchaseOrder = PurchaseOrderMaster::find($id);
        if($purchaseOrder == null){
            return redirect()->route('merchandising.purchase.order.search');
        }
        else if($purchaseOrder->status == 'D'){
            return redirect()->route('merchandising.purchase.order.search');
        }
        else{

            $uniqTrimsTypes = DB::table('purchase_order_details')
                                    ->join('trims_types', 'purchase_order_details.trims_type_id', '=', 'trims_types.id')
                                    ->select('trims_types.short_name', 'trims_types.name')
                                    ->where('purchase_order_details.purchase_order_master_id', $id)
                                    ->orderBy('trims_types.name')
                                    ->groupBy('purchase_order_details.trims_type_id', 'trims_types.short_name', 'trims_types.name')
                                    ->get();

            $productionPlanDetails = ProductionPlanDetailSetup::where('purchase_order_master_id', $id)
                ->where('purchase_order_detail_id', $item)
                ->where('status', '!=', 'D')
                ->orderBy('production_date', 'DESC')
                ->get();

            return view('merchandising.purchase-order.achievement-print-view',
                compact('uniqTrimsTypes', 'productionPlanDetails', 'purchaseOrder'));
        } // other data
    }

    public function currentStockReport($id){
        $purchaseOrder = PurchaseOrderMaster::find($id);
        if($purchaseOrder == null){
            return redirect()->route('merchandising.purchase.order.search');
        }
        else if($purchaseOrder->status == 'D'){
            return redirect()->route('merchandising.purchase.order.search');
        }
        else{

            $uniqTrimsTypes = DB::table('purchase_order_details')
                                    ->join('trims_types', 'purchase_order_details.trims_type_id', '=', 'trims_types.id')
                                    ->select('trims_types.short_name', 'trims_types.name')
                                    ->where('purchase_order_details.purchase_order_master_id', $id)
                                    ->orderBy('trims_types.name')
                                    ->groupBy('purchase_order_details.trims_type_id', 'trims_types.short_name', 'trims_types.name')
                                    ->get();

            $currentStocks = DB::table('trims_stocks')
                ->join('purchase_order_masters', 'trims_stocks.purchase_order_master_id', '=', 'purchase_order_masters.id')
                ->join('purchase_order_details', function ($join) {
                    $join->on('purchase_order_details.item_count', '=', 'trims_stocks.purchase_order_detail_id');
                    $join->on('purchase_order_details.purchase_order_master_id', '=', 'trims_stocks.purchase_order_master_id');
                })
                ->join('buyers', 'purchase_order_masters.buyer_id', '=', 'buyers.id')
                ->join('trims_types', 'purchase_order_details.trims_type_id', '=', 'trims_types.id')
                ->join('units', 'purchase_order_details.item_unit_id', '=', 'units.id')
                ->select('purchase_order_masters.lpd', 'trims_stocks.stock_quantity', 'trims_stocks.delivered_quantity',
                    'purchase_order_masters.lpd_po_no', 'purchase_order_details.style_no','buyers.name AS buyer',
                    'purchase_order_details.item_size', 'purchase_order_details.item_color', 'purchase_order_details.item_description', 'trims_stocks.id',
                    'units.short_unit', 'trims_types.name AS trims_type')
                ->where('trims_stocks.status','!=', 'D')
                ->where('purchase_order_masters.id', $id)
                ->get();

           /* $productionPlanDetails = ProductionPlanDetailSetup::
                where('purchase_order_master_id', $id)
                ->where('status', 'SI')
                ->orderBy('production_date')
                ->get();*/

            return view('merchandising.purchase-order.stock-print-view',
                compact('uniqTrimsTypes', 'currentStocks', 'purchaseOrder'));
        }
    }

    public function currentStockReportItem($id, $item){
        $purchaseOrder = PurchaseOrderMaster::find($id);
        if($purchaseOrder == null){
            return redirect()->route('merchandising.purchase.order.search');
        }
        else if($purchaseOrder->status == 'D'){
            return redirect()->route('merchandising.purchase.order.search');
        }
        else{

            $uniqTrimsTypes = DB::table('purchase_order_details')
                                    ->join('trims_types', 'purchase_order_details.trims_type_id', '=', 'trims_types.id')
                                    ->select('trims_types.short_name', 'trims_types.name')
                                    ->where('purchase_order_details.purchase_order_master_id', $id)
                                    ->orderBy('trims_types.name')
                                    ->groupBy('purchase_order_details.trims_type_id', 'trims_types.short_name', 'trims_types.name')
                                    ->get();

            $productionPlanDetails = ProductionPlanDetailSetup::where('purchase_order_master_id', $id)
                ->where('purchase_order_detail_id', $item)
                ->where('status', 'SI')
                ->orderBy('production_date')
                ->get();

            $currentStocks = DB::table('trims_stocks')
                ->join('purchase_order_masters', 'trims_stocks.purchase_order_master_id', '=', 'purchase_order_masters.id')
                ->join('purchase_order_details', function ($join) {
                    $join->on('purchase_order_details.item_count', '=', 'trims_stocks.purchase_order_detail_id');
                    $join->on('purchase_order_details.purchase_order_master_id', '=', 'trims_stocks.purchase_order_master_id');
                })
                ->join('buyers', 'purchase_order_masters.buyer_id', '=', 'buyers.id')
                ->join('trims_types', 'purchase_order_details.trims_type_id', '=', 'trims_types.id')
                ->join('units', 'purchase_order_details.item_unit_id', '=', 'units.id')
                ->select('purchase_order_masters.lpd', 'trims_stocks.stock_quantity', 'trims_stocks.delivered_quantity',
                    'purchase_order_masters.lpd_po_no', 'purchase_order_details.style_no','buyers.name AS buyer',
                    'purchase_order_details.item_size', 'purchase_order_details.item_color', 'purchase_order_details.item_description', 'trims_stocks.id',
                    'units.short_unit', 'trims_types.name AS trims_type')
                ->where('trims_stocks.status', '!=','D')
                ->where('purchase_order_masters.id', $id)
                ->where('purchase_order_details.item_count', $item)
                ->get();

            return view('merchandising.purchase-order.stock-print-view',
                compact('uniqTrimsTypes', 'currentStocks', 'purchaseOrder'));
        }
    }

    public function deliveryReport($id){
        $purchaseOrder = PurchaseOrderMaster::find($id);
        if($purchaseOrder == null){
            return redirect()->route('merchandising.purchase.order.search');
        }
        else if($purchaseOrder->status == 'D'){
            return redirect()->route('merchandising.purchase.order.search');
        }
        else{

            $uniqTrimsTypes = DB::table('purchase_order_details')
                                    ->join('trims_types', 'purchase_order_details.trims_type_id', '=', 'trims_types.id')
                                    ->select('trims_types.short_name', 'trims_types.name')
                                    ->where('purchase_order_details.purchase_order_master_id', $id)
                                    ->orderBy('trims_types.name')
                                    ->groupBy('purchase_order_details.trims_type_id', 'trims_types.short_name', 'trims_types.name')
                                    ->get();

            $deliveryData = DB::table('delivery_details')
                ->join('delivery_masters', 'delivery_masters.id', '=', 'delivery_details.delivery_master_id')
                ->join('purchase_order_details', function ($join) {
                    $join->on('purchase_order_details.item_count', '=', 'delivery_details.purchase_order_detail_id');
                    $join->on('purchase_order_details.purchase_order_master_id', '=', 'delivery_masters.purchase_order_master_id');
                })
                ->join('purchase_order_masters', 'purchase_order_details.purchase_order_master_id', '=', 'purchase_order_masters.id')
                ->join('units', 'purchase_order_details.item_unit_id', '=', 'units.id')
                ->join('stores', 'delivery_masters.store_id', '=', 'stores.id')
                ->join('trims_types', 'purchase_order_details.trims_type_id', '=', 'trims_types.id')
                ->select('purchase_order_masters.lpd',
                    'purchase_order_masters.lpd_po_no', 'purchase_order_details.style_no', 'stores.name AS store_name',
                    'purchase_order_details.item_size', 'purchase_order_details.item_color', 'purchase_order_details.item_description',
                    'delivery_masters.challan_date', 'delivery_masters.id AS challan_no', 'delivery_details.remarks', 'delivery_details.total_weight',
                    'delivery_details.delivered_quantity', 'delivery_details.gross_delivered_quantity', 'delivery_details.gross_unit',
                    'delivery_details.gross_weight', 'delivery_masters.is_replacement_challan',
                    'units.short_unit', 'delivery_masters.status', 'trims_types.name AS trims_type')
                ->where('delivery_masters.status', 'AP')
                ->where('purchase_order_masters.id', $id)
                ->orderBy('delivery_masters.challan_date')
                ->orderBy('trims_types.name')
                ->get();

            return view('merchandising.purchase-order.delivery-print-view',
                compact('uniqTrimsTypes', 'deliveryData', 'purchaseOrder'));
        } // other data
    }

    public function deliveryReportItem($id, $item){
        $purchaseOrder = PurchaseOrderMaster::find($id);
        if($purchaseOrder == null){
            return redirect()->route('merchandising.purchase.order.search');
        }
        else if($purchaseOrder->status == 'D'){
            return redirect()->route('merchandising.purchase.order.search');
        }
        else{

            $uniqTrimsTypes = DB::table('purchase_order_details')
                                    ->join('trims_types', 'purchase_order_details.trims_type_id', '=', 'trims_types.id')
                                    ->select('trims_types.short_name', 'trims_types.name')
                                    ->where('purchase_order_details.purchase_order_master_id', $id)
                                    ->orderBy('trims_types.name')
                                    ->groupBy('purchase_order_details.trims_type_id', 'trims_types.short_name', 'trims_types.name')
                                    ->get();

            $deliveryData = DB::table('delivery_details')
                ->join('delivery_masters', 'delivery_masters.id', '=', 'delivery_details.delivery_master_id')
                ->join('purchase_order_details', function ($join) {
                    $join->on('purchase_order_details.item_count', '=', 'delivery_details.purchase_order_detail_id');
                    $join->on('purchase_order_details.purchase_order_master_id', '=', 'delivery_masters.purchase_order_master_id');
                })
                ->join('purchase_order_masters', 'purchase_order_details.purchase_order_master_id', '=', 'purchase_order_masters.id')
                ->join('units', 'purchase_order_details.item_unit_id', '=', 'units.id')
                ->join('stores', 'delivery_masters.store_id', '=', 'stores.id')
                ->join('trims_types', 'purchase_order_details.trims_type_id', '=', 'trims_types.id')
                ->select('purchase_order_masters.lpd',
                    'purchase_order_masters.lpd_po_no', 'purchase_order_details.style_no', 'stores.name AS store_name',
                    'purchase_order_details.item_size', 'purchase_order_details.item_color', 'purchase_order_details.item_description',
                    'delivery_masters.challan_date', 'delivery_masters.id AS challan_no', 'delivery_details.remarks', 'delivery_details.total_weight',
                    'delivery_details.delivered_quantity', 'delivery_details.gross_delivered_quantity', 'delivery_details.gross_unit',
                    'delivery_details.gross_weight', 'delivery_masters.is_replacement_challan',
                    'units.short_unit', 'delivery_masters.status', 'trims_types.name AS trims_type')
                ->where('delivery_masters.status', 'AP')
                ->where('purchase_order_masters.id', $id)
                ->where('purchase_order_details.item_count', $item)
                ->orderBy('delivery_masters.challan_date')
                ->orderBy('trims_types.name')
                ->get();

            return view('merchandising.purchase-order.delivery-print-view',
                compact('uniqTrimsTypes', 'deliveryData', 'purchaseOrder'));
        } // other data
    }
    public function deliveryReportNotApproved($id){
        $purchaseOrder = PurchaseOrderMaster::find($id);
        if($purchaseOrder == null){
            return redirect()->route('merchandising.purchase.order.search');
        }
        else if($purchaseOrder->status == 'D'){
            return redirect()->route('merchandising.purchase.order.search');
        }
        else{

            $uniqTrimsTypes = DB::table('purchase_order_details')
                                    ->join('trims_types', 'purchase_order_details.trims_type_id', '=', 'trims_types.id')
                                    ->select('trims_types.short_name', 'trims_types.name')
                                    ->where('purchase_order_details.purchase_order_master_id', $id)
                                    ->orderBy('trims_types.name')
                                    ->groupBy('purchase_order_details.trims_type_id', 'trims_types.short_name', 'trims_types.name')
                                    ->get();

            $deliveryData = DB::table('delivery_details')
                ->join('delivery_masters', 'delivery_masters.id', '=', 'delivery_details.delivery_master_id')
                ->join('purchase_order_details', function ($join) {
                    $join->on('purchase_order_details.item_count', '=', 'delivery_details.purchase_order_detail_id');
                    $join->on('purchase_order_details.purchase_order_master_id', '=', 'delivery_masters.purchase_order_master_id');
                })
                ->join('purchase_order_masters', 'purchase_order_details.purchase_order_master_id', '=', 'purchase_order_masters.id')
                ->join('units', 'purchase_order_details.item_unit_id', '=', 'units.id')
                ->join('stores', 'delivery_masters.store_id', '=', 'stores.id')
                ->join('trims_types', 'purchase_order_details.trims_type_id', '=', 'trims_types.id')
                ->select('purchase_order_masters.lpd',
                    'purchase_order_masters.lpd_po_no', 'purchase_order_details.style_no', 'stores.name AS store_name',
                    'purchase_order_details.item_size', 'purchase_order_details.item_color', 'purchase_order_details.item_description',
                    'delivery_masters.challan_date', 'delivery_masters.id AS challan_no', 'delivery_details.remarks', 'delivery_details.total_weight',
                    'delivery_details.delivered_quantity', 'delivery_details.gross_delivered_quantity', 'delivery_details.gross_unit',
                    'delivery_details.gross_weight', 'delivery_masters.is_replacement_challan',
                    'units.short_unit', 'delivery_masters.status', 'trims_types.name AS trims_type')
                ->where('delivery_masters.status', '!=','D')
                ->where('purchase_order_masters.id', $id)
                ->orderBy('delivery_masters.challan_date')
                ->orderBy('trims_types.name')
                ->get();

            return view('merchandising.purchase-order.delivery-not-print-view',
                compact('uniqTrimsTypes', 'deliveryData', 'purchaseOrder'));
        } // other data
    }

    public function deliveryReportNotApprovedItem($id, $item){
        $purchaseOrder = PurchaseOrderMaster::find($id);
        if($purchaseOrder == null){
            return redirect()->route('merchandising.purchase.order.search');
        }
        else if($purchaseOrder->status == 'D'){
            return redirect()->route('merchandising.purchase.order.search');
        }
        else{

            $uniqTrimsTypes = DB::table('purchase_order_details')
                                    ->join('trims_types', 'purchase_order_details.trims_type_id', '=', 'trims_types.id')
                                    ->select('trims_types.short_name', 'trims_types.name')
                                    ->where('purchase_order_details.purchase_order_master_id', $id)
                                    ->orderBy('trims_types.name')
                                    ->groupBy('purchase_order_details.trims_type_id', 'trims_types.short_name', 'trims_types.name')
                                    ->get();

            $deliveryData = DB::table('delivery_details')
                ->join('delivery_masters', 'delivery_masters.id', '=', 'delivery_details.delivery_master_id')
                ->join('purchase_order_details', function ($join) {
                    $join->on('purchase_order_details.item_count', '=', 'delivery_details.purchase_order_detail_id');
                    $join->on('purchase_order_details.purchase_order_master_id', '=', 'delivery_masters.purchase_order_master_id');
                })
                ->join('purchase_order_masters', 'purchase_order_details.purchase_order_master_id', '=', 'purchase_order_masters.id')
                ->join('units', 'purchase_order_details.item_unit_id', '=', 'units.id')
                ->join('stores', 'delivery_masters.store_id', '=', 'stores.id')
                ->join('trims_types', 'purchase_order_details.trims_type_id', '=', 'trims_types.id')
                ->select('purchase_order_masters.lpd',
                    'purchase_order_masters.lpd_po_no', 'purchase_order_details.style_no', 'stores.name AS store_name',
                    'purchase_order_details.item_size', 'purchase_order_details.item_color', 'purchase_order_details.item_description',
                    'delivery_masters.challan_date', 'delivery_masters.id AS challan_no', 'delivery_details.remarks', 'delivery_details.total_weight',
                    'delivery_details.delivered_quantity', 'delivery_details.gross_delivered_quantity', 'delivery_details.gross_unit',
                    'delivery_details.gross_weight', 'delivery_masters.is_replacement_challan',
                    'units.short_unit', 'delivery_masters.status', 'trims_types.name AS trims_type')
                ->where('delivery_masters.status', '!=','D')
                ->where('purchase_order_masters.id', $id)
                ->where('purchase_order_details.item_count', $item)
                ->orderBy('delivery_masters.challan_date')
                ->orderBy('trims_types.name')
                ->get();

            return view('merchandising.purchase-order.delivery-not-print-view',
                compact('uniqTrimsTypes', 'deliveryData', 'purchaseOrder'));
        } // other data
    }

    //edit section
}
