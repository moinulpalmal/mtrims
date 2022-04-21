<?php

namespace App\Http\Controllers\LPD2\API;

use App\Http\Controllers\Controller;
use App\PurchaseOrderMaster;
use Illuminate\Http\Request;

class ProformaInvoiceController extends Controller
{
    public function getPOList()
    {
        return PurchaseOrderMaster::getProformaInvoicePOList();
    }
    
}