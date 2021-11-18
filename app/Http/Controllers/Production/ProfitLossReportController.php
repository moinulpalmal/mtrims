<?php

namespace App\Http\Controllers\Production;

use App\Buyer;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\TrimsType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfitLossReportController extends Controller
{
    public function index(){
        //$trimsTypes = TrimsType::GetAllActiveTrimsTypesForSelectField();

        return view('production.report.profit-report-index');
    }

    public function generateReport(Request $request){
        //$reportData = null;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $reportDataMaster = DB::table('production_plan_master_setups')
            ->select('id','machine_cost_in_usd', 'material_cost_in_usd', 'production_date')
            ->whereBetween('production_plan_master_setups.production_date', [$request->from_date, $request->to_date])
            ->orderBy('production_plan_master_setups.production_date')
            ->get();


        $total_machine_cost = (float)(Helper::GetTotalMachineCostDate($from_date, $to_date)[0]->total_machine_cost);
        $total_material_cost = (float)(Helper::GetTotalMaterialCostDate($from_date, $to_date)[0]->total_material_cost);
        $total_cost = $total_material_cost + $total_machine_cost;

        //return $total_cost;

        $total_revenue = (float)(Helper::GetTotalProductionRevenueDate($from_date, $to_date)[0]->total_revenue);
        //return $total_revenue;

        return view('production.report.profit-report-print-view',
            compact('reportDataMaster','from_date', 'to_date',
                'total_machine_cost', 'total_material_cost', 'total_cost', 'total_revenue'));
    }

    public function orderStatus(){
        $trimsTypes = TrimsType::GetAllActiveTrimsTypesForSelectField();
        $buyers = Buyer::getActiveBuyerListForSelect();
        return view('production.report.order-status-index', compact('trimsTypes', 'buyers'));
    }

    public function orderStatusReport(Request $request){
        //return $request->all();
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $deliveryStatus = false;
        if($request->get('with_delivery_status') == 'on'){
            $deliveryStatus = true;
        }

        $reportDataMaster = DB::table('purchase_order_details')
            ->join('purchase_order_masters', 'purchase_order_masters.id', '=', 'purchase_order_details.purchase_order_master_id')
            ->join('units', 'purchase_order_details.item_unit_id', '=', 'units.id')
            ->join('buyers', 'purchase_order_masters.buyer_id', '=', 'buyers.id')
            ->join('trims_types', 'trims_types.id', '=', 'purchase_order_details.trims_type_id')
            ->select('purchase_order_masters.po_date', 'purchase_order_masters.lpd', 'purchase_order_masters.lpd_po_no',
                'purchase_order_masters.sample_submission_date', 'purchase_order_masters.delivery_start_date', 'purchase_order_masters.delivery_end_date',
                'purchase_order_details.item_size', 'purchase_order_details.item_color', 'purchase_order_details.item_description', 'purchase_order_details.item_order_quantity',
                'trims_types.name AS trims_type', 'buyers.name AS buyer', 'units.short_unit', 'buyers.id AS buyer_id', 'trims_types.id AS trims_type_id',
                'purchase_order_masters.id', 'purchase_order_details.item_count')
            ->whereBetween('purchase_order_masters.po_date', [$request->from_date, $request->to_date])
            ->where('purchase_order_details.status', '!=', 'D')
            ->get();

        //return $reportDataMaster;

        if($request->get('trims_type') != "A"){
            //$reportDataMaster = $reportDataMaster::

            $reportDataMaster = $reportDataMaster->where('trims_type_id', $request->get('trims_type'));
            //return $reportDataMaster;
        }

        if($request->get('lpd') != ""){
            //$reportDataMaster = $reportDataMaster::

            $reportDataMaster = $reportDataMaster->where('lpd','=', $request->get('lpd'));
        }

        if($request->get('buyer') != ""){
            //$reportDataMaster = $reportDataMaster::

            $reportDataMaster = $reportDataMaster->where('buyer_id','=', $request->get('buyer'));
        }

        if($request->get('lpd_po_no') != ""){
            //$reportDataMaster = $reportDataMaster::

            $reportDataMaster = $reportDataMaster->where('lpd_po_no','=', $request->get('lpd_po_no'));
        }

        if($request->get('delivery_start_date') == 'on'){
            //$deliveryStatus = true;
            $reportDataMaster = $reportDataMaster->sortBy('delivery_start_date');

            //return $reportDataMaster;
        }

        if($request->get('order_by_po_no') == 'on'){
            //$deliveryStatus = true;
            $reportDataMaster = $reportDataMaster->sortBy('lpd_po_no');

            //return $reportDataMaster;
        }

        return view('production.report.order-status-report-print-view',
            compact('reportDataMaster','from_date', 'to_date',
               'deliveryStatus'));
    }


}
