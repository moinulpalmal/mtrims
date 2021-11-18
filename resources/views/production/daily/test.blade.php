@foreach($purchaseOrderDetails as $item)
    {{App\Helpers\Helper::GetTotalOrderQuantity($item->POM_ID, $item->POD_ID) -  App\Helpers\Helper::GetAchievementProductionQuantity($item->POM_ID, $item->POD_ID)  - App\Helpers\Helper::GetTotalActiveProductionQuantity($item->POM_ID, $item->POD_ID) }}

@endforeach
