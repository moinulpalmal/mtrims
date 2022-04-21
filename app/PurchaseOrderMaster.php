<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PurchaseOrderMaster extends Model
{
    public static function getPurchaseOrderDetail($request){
        // $poDetails = PurchaseOrderMaster::find($request->id);

        $poDetails = DB::table('purchase_order_masters')
                ->join('production_achieve_asum_master','purchase_order_masters.id','=','production_achieve_asum_master.id')
                ->join('buyers','purchase_order_masters.buyer_id','=','buyers.id')
                ->join('factories','purchase_order_masters.factory_id','=','factories.id')
                ->join('stores','purchase_order_masters.primary_delivery_location_id','=','stores.id')
                ->select('buyers.id AS buyer_id','buyers.name AS buyer_name','factories.id AS factory_id','factories.name AS factory_name','stores.id AS delivery_location_id','stores.name AS delivery_location',
                    'purchase_order_masters.lpd_po_no','purchase_order_masters.job_no','purchase_order_masters.buyer_po_no','purchase_order_masters.job_year',
                    'purchase_order_masters.status','purchase_order_masters.remarks','purchase_order_masters.inserted_by','purchase_order_masters.approved_by',
                    'purchase_order_masters.lpd','purchase_order_masters.pi_count','purchase_order_masters.pi_generation_activated','purchase_order_masters.po_date',
                    'purchase_order_masters.approval_date','purchase_order_masters.sample_submission_date','purchase_order_masters.production_start_date',
                    'purchase_order_masters.production_end_date','purchase_order_masters.delivery_start_date','purchase_order_masters.delivery_end_date',
                    'purchase_order_masters.close_requested_by','purchase_order_masters.close_approved_by','purchase_order_masters.close_request','purchase_order_masters.close_request_date',
                    'purchase_order_masters.close_approval_date','purchase_order_masters.flow_count','purchase_order_masters.revise_count','purchase_order_masters.has_flow_count',
                    'purchase_order_masters.is_urgent','purchase_order_masters.po_type','purchase_order_masters.id', 'production_achieve_asum_master.total_achievement')
                ->where('purchase_order_masters.status','!=', 'D')
                ->where('purchase_order_masters.id', $request->id)
                ->first();
                // ->get();

        $poDetail = array(
            'lpd_po_no' => $poDetails->lpd_po_no,
            'job_no' => $poDetails->job_no,
            'buyer_id' => $poDetails->buyer_id,
            'buyer_name' => $poDetails->buyer_name,
            'buyer_po_no' => $poDetails->buyer_po_no,
            'job_year' => $poDetails->job_year,
            'primary_delivery_location_id' => $poDetails->delivery_location_id,
            'primary_delivery_location' => $poDetails->delivery_location,
            'status' => $poDetails->status,
            'remarks' => $poDetails->remarks,
            'inserted_by' => $poDetails->inserted_by,
            'approved_by' => $poDetails->approved_by,
            'lpd' => $poDetails->lpd,
            'pi_count' => $poDetails->pi_count,
            'pi_generation_activated' => $poDetails->pi_generation_activated,
            'factory_id' => $poDetails->factory_id,
            'factory_name' => $poDetails->factory_name,
            'po_date' => $poDetails->po_date,
            'approval_date' => $poDetails->approval_date,
            'sample_submission_date' => $poDetails->sample_submission_date,
            'production_start_date' => $poDetails->production_start_date,
            'production_end_date' => $poDetails->production_end_date,
            'delivery_start_date' => $poDetails->delivery_start_date,
            'delivery_end_date' => $poDetails->delivery_end_date,
            'close_requested_by' => $poDetails->close_requested_by,
            'close_approved_by' => $poDetails->close_approved_by,
            'close_request' => $poDetails->close_request,
            'close_request_date' => $poDetails->close_request_date,
            'close_approval_date' => $poDetails->close_approval_date,
            'flow_count' => $poDetails->flow_count,
            'revise_count' => $poDetails->revise_count,
            'has_flow_count' => $poDetails->has_flow_count,
            'is_urgent' => $poDetails->is_urgent,
            'po_type' => $poDetails->po_type,
            'total_achievement' => $poDetails->total_achievement,
            'id' => $poDetails->id
        );
        return $poDetail;
    }

    public static function getProformaInvoicePOList()
    {
        return PurchaseOrderMaster::orderBy('lpd_po_no', 'DESC')
            ->join('buyers','purchase_order_masters.buyer_id','=','buyers.id')
            ->select('buyers.name AS buyer_name','purchase_order_masters.lpd_po_no','purchase_order_masters.job_year','purchase_order_masters.job_no',
            'purchase_order_masters.po_date','purchase_order_masters.status','purchase_order_masters.pi_generation_activated','purchase_order_masters.id')
            ->where('purchase_order_masters.status', '!=', 'D')
//            ->where('pi_generation_activated', true)
            ->where('lpd', 2)
            ->take(1500)
            ->get();



    }

    public function purchase_order_detail()
    {
        return $this->hasOne('PurchaseOrderDetail', 'purchase_order_master_id', 'id');
    }

    public static function getActivePurchaseOrderByLpd($lpd){
        return PurchaseOrderMaster::orderBy('lpd_po_no', 'DESC')
            ->where('status', 'A')
            ->where('lpd', $lpd)
            ->get();

    }

    public static function getTotalOrderQuantity ($id){
        $result = DB::table('view_p_o_order_sum')
                    ->select('id', 'total_order_quantity')
                    ->where('id', $id)
                    ->get();

        if($result->count() > 0){
            $result[0]->total_order_quantity;
        }

        return 0;
    }

    public static function getTotalStockQuantity($id){
        $result = DB::table('view_p_o_stock_sum')
            ->select('id', 'total_stock_quantity')
            ->where('id', $id)
            ->get();

        if($result->count() > 0){
            $result[0]->total_order_quantity;
        }

        return 0;
    }

    public static function getTotalDeliveredQuantity($id){

    }
}
