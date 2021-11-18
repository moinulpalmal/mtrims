<?php

namespace App\Http\Controllers\Management;

use App\Buyer;
use App\Helpers\Report;
use App\Http\Controllers\Controller;
use App\TrimsType;
use Illuminate\Http\Request;

class DeliveryReportController extends Controller
{
    public function report(){
        $buyers = Buyer::getActiveBuyerListForSelect();
        $trimsTypes = TrimsType::GetAllActiveTrimsTypesForSelectField();
        return view('management.delivery.generate', compact('buyers', 'trimsTypes'));
    }

    public function reportGenerate(Request $request){
        //return $request->all();
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $sales = Report::salesReport($request);
        $totalQty = Report::getTotalDeliveredQty($sales);
        //$grandTotalPrice = Report::getGrandTotalPrice($sales);
        return view('management.delivery.delivery-report-print-view', compact('sales', 'totalQty',
            'from_date', 'to_date'));
        //return $request->all();
    }
}
