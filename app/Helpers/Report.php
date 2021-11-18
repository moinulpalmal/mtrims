<?php


namespace App\Helpers;


use Illuminate\Support\Facades\DB;

class Report
{
    public static function salesReport($request){
        // if replacement = 0 than all replacement, = 1 than with replacement

        $sales = DB::table('view_approved_delivery_summary')
            ->select('*')
            //->whereBetween('challan_date', array($request->from_date, $request->to_date))
            ->orderBy('lpd')
            ->orderBy('lpd_po_no')
            ->orderBy('trims_types')
            ->orderBy('challan_date', 'ASC')
            ->get();

        if(!empty($request->get('from_date'))){
            if(!empty($request->get('to_date'))){
                $sales = $sales->whereBetween('challan_date', array($request->from_date, $request->to_date));
            }
        }
        if(!empty($request->get('buyer'))){
            $sales = $sales->whereIn('buyer_id', $request->get('buyer'));
        }

        if($request->lpd != 0){
            $sales = $sales->where('lpd', $request->lpd);
        }

        if($request->trims_type_id != 0){
            $sales = $sales->where('trims_type_id', $request->trims_type_id);
        }

        if(!empty($request->get('trims_type'))){
            $sales = $sales->whereIn('trims_type_id', $request->get('trims_type'));
        }

        if($request->lpd_po_no != null){
            $sales = $sales->where('lpd_po_no', $request->lpd_po_no);
        }

        if($request->without_replacement_challan == "on"){
            //return 23;
            $sales = $sales->where('is_replacement_challan', '!=', true);
        }

        return $sales;
    }

    public static function getTotalDeliveredQty($sales){
        $total = 0;
        foreach ($sales as $item){

            $total = $total + ((float)$item->gross_delivered_quantity);
        }

        return $total;
    }

    public static function getGrandTotalPrice($sales){
        $total = 0;
        foreach ($sales as $item){
            if($item->is_replacement_challan == 0){
                $total = $total + (float)$item->total_price;
            }
        }

        return $total;
    }

}
