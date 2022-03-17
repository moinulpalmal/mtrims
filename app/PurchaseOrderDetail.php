<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PurchaseOrderDetail extends Model
{
    //
    public static function getPOProductList($purchase_order_master_id) {
        return  DB::table('purchase_order_details')->orderBy('item_count')
                ->join('trims_types', 'purchase_order_details.trims_type_id', '=', 'trims_types.id')
                ->join('units', 'purchase_order_details.item_unit_id', '=', 'units.id')
                ->select('trims_types.name AS trims_types_name', 'units.full_unit', 
                    'purchase_order_details.style_no','purchase_order_details.item_size', 'purchase_order_details.item_count',
                    'purchase_order_details.item_color','purchase_order_details.item_description','purchase_order_details.item_order_quantity',
                    'purchase_order_details.sample_item_order_quantity','purchase_order_details.unit_price_in_usd','purchase_order_details.total_price_in_usd',
                    'purchase_order_details.remarks','purchase_order_details.status')
                ->where('purchase_order_details.status','!=', 'D')
                ->where('purchase_order_master_id', $purchase_order_master_id)
                ->get();
    }

    public static function insertPOProductList($request){        
        $purchaseOrderDetail = new PurchaseOrderDetail();
        $purchaseOrderDetail->purchase_order_master_id = $request->purchase_order_master_id;
        $purchaseOrderDetail->style_no = $request->style_no;
        $purchaseOrderDetail->item_size = $request->item_size;
        $purchaseOrderDetail->item_color = $request->item_color;
        $purchaseOrderDetail->item_description = $request->item_description;
        $purchaseOrderDetail->item_unit_id = $request->item_unit;
        $purchaseOrderDetail->unit_price_in_usd = $request->unit_price;
        $purchaseOrderDetail->total_price_in_usd = $request->total;
        $purchaseOrderDetail->remarks = $request->item_remarks;
        $purchaseOrderDetail->item_order_quantity = $request->quantity;
        $purchaseOrderDetail->sample_item_order_quantity = $request->sample_quantity;
        $purchaseOrderDetail->gross_calculation_amount = $request->gross_calculation_amount;
        $purchaseOrderDetail->gross_item_order_quantity = $request->gross_item_order_quantity;
        $purchaseOrderDetail->gross_sample_item_order_quantity = $request->sample_gross_item_order_quantity;
        $purchaseOrderDetail->unit_price_in_usd = $request->unit_price;
        $purchaseOrderDetail->add_amount_percent = $request->add_amount_percent;
        $purchaseOrderDetail->gross_unit_price = $request->gross_unit_price;
        $purchaseOrderDetail->trims_type_id = $request->trims_type;
        $purchaseOrderDetail->total_price_in_usd = $request->total;
        $purchaseOrderDetail->status = 'A';
        
        $purchaseOrderDetail->item_count = PurchaseOrderDetail::orderBy('item_count', 'desc')->where('purchase_order_master_id', $request->purchase_order_master_id)->first()->item_count + 1;
    
        if($purchaseOrderDetail->save())
        {
            $purchaseOrder = PurchaseOrderMaster::find($request->purchase_order_master_id);
            $purchaseOrder->pi_generation_activated = true;
            $purchaseOrder->save();
            return '1';
        }
        return '0';
    }

    public static function updatePOProductList($request, $id){
        $purchaseOrderDetail = PurchaseOrderDetail::where('purchase_order_master_id', $request->purchase_order_master_id)
                ->where('item_count', $id)
                ->first();
            if(!empty($purchaseOrderDetail)){

                $result = DB::table('purchase_order_details')
                    ->where('item_count', $id)
                    ->where('purchase_order_master_id', $request->purchase_order_master_id)
                    ->update(['style_no' => $request->style_no,
                        'item_size' => $request->item_size,
                        'item_color' => $request->item_color,
                        'item_description' => $request->item_description,
                        'item_unit_id' => $request->item_unit,
                        'remarks' => $request->item_remarks,
                        'item_order_quantity' => $request->quantity,
                        'sample_item_order_quantity' => $request->sample_quantity,
                        'gross_calculation_amount' => $request->gross_calculation_amount,
                        'gross_item_order_quantity' => $request->gross_item_order_quantity,
                        'gross_sample_item_order_quantity' => $request->sample_gross_item_order_quantity,
                        'unit_price_in_usd' => $request->unit_price,
                        'add_amount_percent' => $request->add_amount_percent,
                        'gross_unit_price' => $request->gross_unit_price,
                        'trims_type_id' => $request->trims_type,
                        'total_price_in_usd' => $request->total]);

                if($result){

                    $purchaseOrder = PurchaseOrderMaster::find($request->purchase_order_master_id);

                    $purchaseOrder->pi_generation_activated = true;
                    $purchaseOrder->save();
                    return "2";
                }
            }
            return "0";
    }

    public static function getPOProductListEditDetail($request){
        $subContractor = PurchaseOrderDetail::where('purchase_order_master_id', $request->purchase_order_master_id)
            ->where('item_count', $request->item_count)
            ->first();

        //check qty edit access
        //check min qty edit access

        //active
        if($subContractor != null){
            $subContractorData = array(
                'item_size' => $subContractor->item_size,
                'item_color' => $subContractor->item_color,
                'item_description' => $subContractor->item_description,
                'item_unit' => $subContractor->item_unit_id,
                'unit_price_in_usd' => $subContractor->unit_price_in_usd,
                'total_price_in_usd' => $subContractor->total_price_in_usd,
                'remarks' => $subContractor->remarks,
                'item_order_quantity' => $subContractor->item_order_quantity,
                'sample_item_order_quantity' => $subContractor->sample_item_order_quantity,
                'finished_quantity' => $subContractor->finished_quantity,
                'sub_con_order_quantity' => $subContractor->sub_con_order_quantity,
                'sub_con_finished_quantity' => $subContractor->sub_con_finished_quantity,
                'sub_con_delivered_quantity' => $subContractor->sub_con_delivered_quantity,
                'style_no' => $subContractor->style_no,
                'trims_type_id' => $subContractor->trims_type_id,
                'item_id' => $subContractor->item_count,
                'gross_unit_price' => $subContractor->gross_unit_price,
                'gross_calculation_amount' => $subContractor->gross_calculation_amount,
                'gross_item_order_quantity' => $subContractor->gross_item_order_quantity,
                'gross_sample_item_order_quantity' => $subContractor->gross_sample_item_order_quantity,
                'add_amount_percent' => $subContractor->add_amount_percent
            );
            return $subContractorData;
        }

        return null;
    }

    public function purchase_order_master() {
        return $this->belongsTo('PurchaseOrderMaster');
    }

    public static function getPurchaseOrderListByLPDForPlanning($lpd, $myTodayDate){
        return DB::table('purchase_order_details')
            ->join('purchase_order_masters', 'purchase_order_details.purchase_order_master_id', '=', 'purchase_order_masters.id')
            ->join('units', 'purchase_order_details.item_unit_id', '=', 'units.id')
            ->join('trims_types', 'purchase_order_details.trims_type_id', '=', 'trims_types.id')
            ->join('buyers', 'purchase_order_masters.buyer_id', '=', 'buyers.id')
            ->select('purchase_order_masters.lpd_po_no', 'buyers.name AS buyer_name', 'purchase_order_masters.lpd',
                'purchase_order_masters.id AS POM_ID', 'purchase_order_details.item_color',
                'purchase_order_details.item_description', 'purchase_order_details.style_no', 'purchase_order_details.status',
                'purchase_order_details.item_count AS POD_ID', 'purchase_order_details.item_size',
                'trims_types.name AS trims_type_name', 'trims_types.section_setup_id','units.short_unit', 'purchase_order_masters.production_start_date'
                , 'purchase_order_details.trims_type_id', 'purchase_order_masters.production_end_date')
//            ->selectRaw('(purchase_order_details.item_order_quantity-purchase_order_details.finished_quantity) AS not_finished_quantity')
            ->where('purchase_order_masters.status', 'A')
            ->where('purchase_order_details.status', 'A')
            ->where('purchase_order_masters.lpd', $lpd)
            ->whereDate('purchase_order_masters.production_start_date', '<=', $myTodayDate)
            ->get();
    }

    public static function getPurchaseOrderListByAllForPlanning($myTodayDate){
        return DB::table('purchase_order_details')
            ->join('purchase_order_masters', 'purchase_order_details.purchase_order_master_id', '=', 'purchase_order_masters.id')
            ->join('units', 'purchase_order_details.item_unit_id', '=', 'units.id')
            ->join('trims_types', 'purchase_order_details.trims_type_id', '=', 'trims_types.id')
            ->join('buyers', 'purchase_order_masters.buyer_id', '=', 'buyers.id')
            ->select('purchase_order_masters.lpd_po_no', 'buyers.name AS buyer_name', 'purchase_order_masters.lpd',
                'purchase_order_masters.id AS POM_ID', 'purchase_order_details.item_color',
                'purchase_order_details.item_description', 'purchase_order_details.style_no', 'purchase_order_details.status',
                'purchase_order_details.item_count AS POD_ID', 'purchase_order_details.item_size',
                'trims_types.name AS trims_type_name', 'trims_types.section_setup_id','units.short_unit', 'purchase_order_masters.production_start_date'
                , 'purchase_order_details.trims_type_id', 'purchase_order_masters.production_end_date')
//            ->selectRaw('(purchase_order_details.item_order_quantity-purchase_order_details.finished_quantity) AS not_finished_quantity')
            ->where('purchase_order_masters.status', 'A')
            ->where('purchase_order_details.status', 'A')
            ->whereDate('purchase_order_masters.production_start_date', '<=', $myTodayDate)
            ->get();
    }

}
