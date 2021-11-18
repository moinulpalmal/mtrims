<div class="row">
    <!-- col -->
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <!-- tile -->
        <section class="tile">
            <!-- tile header -->
            <div class="tile-header dvd dvd-btm">
                <h1 class="custom-font"><strong>New Trims Item Delivery Entry Form</strong></h1>
                <a><button onclick="refresh()" class="pull-right btn-warning btn-xs" ><i class="fa fa-refresh"></i></button></a>
            </div>
            <!-- /tile header -->
            <!-- tile body -->
            <div class="tile-body">
                <!-- row -->
                <div class="row">
                    <!-- col -->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <!-- tile -->
                        <section class="tile">
                            <!-- tile header -->
                            <div class="tile-header dvd dvd-btm">
                                <h1 class="custom-font"><strong>Challan Information</strong> Master Information</h1>
                                <a><button id="iconChange" class="pull-right btn-info btn-xs" type="submit"><i class="fa fa-check"></i></button></a>
                            </div>
                            <!-- /tile header -->
                            <!-- tile body -->
                            <div class="tile-body">
                                @if (count($errors) > 0)
                                    <div class="row" style="padding: 0px 15px;">
                                        <div class="col-md-12">
                                            <div class="alert alert-danger">
                                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="row" style="padding: 0px 15px;">
                                    <input type="hidden" class="form-control" name="purchase_order_master_id" value="{{ old('lpd_po_no', $purchaseOrderMaster->id) }}">
                                    <div class="col-md-3 no-padding">
                                        <div class="form-group">
                                            <label for="LPD_PO" class="control-label">LPD PO No.</label>
                                            <input type="number" class="form-control" name="lpd_po_no" id="LPD_PO" placeholder="2485" required readonly value="{{ old('lpd_po_no', $purchaseOrderMaster->lpd_po_no) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3 no-padding">
                                        <div class="form-group">
                                            <label for="Challan_Date" class="control-label">Challan Date</label>
                                            <input type="date" class="form-control" name="challan_date" id="PO_Date" required value="{{ old('challan_date') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3 no-padding">
                                        <div class="form-group">
                                            <label for="SubContractorType" class="control-label">Select Delivery Location</label>
                                            <select id="SubContractorType" class="form-control chosen-select" name="delivery_location_name" style="width: 100%;">
                                                <option value="" selected ="selected">- - - Select - - -</option>
                                                @if(!empty($stores))
                                                    @foreach($stores as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 no-padding">
                                        <div class="form-group">
                                            <label for="Transport" class="control-label">Select Transport Licence No</label>
                                            <select id="Transport" class="form-control chosen-select" name="transport_licence_no" style="width: 100%;">
                                                <option value="" selected ="selected">- - - Select - - -</option>
                                                @if(!empty($transports))
                                                    @foreach($transports as $item)
                                                        <option value="{{ $item->id }}">{{ $item->transport_licence_no }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="padding: 0px 15px;">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="checkbox checkbox-custom-alt checkbox-custom-lg" style="padding-top: 17px">
                                                <input name="is_replacement_challan" id="IsSubCon" type="checkbox"><i></i> <strong>Is Replacement Challan ?</strong>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-9 no-padding">
                                        <div class="form-group">
                                            <label for="Remarks" class="control-label">Remarks</label>
                                            <input type="text" class="form-control" name="remarks" id="Remarks" value="{{ old('remarks') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /tile body -->
                        </section>
                        <!-- /tile -->
                    </div>
                    <!-- /col -->
                    <!-- col -->
                    <!-- /col -->
                </div>
                <!-- /row -->
                <!-- row -->
                <div class="row">
                    <!-- col -->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <!-- tile -->
                        <section class="tile no-padding">
                            <!-- tile header -->
                            <div class="tile-header dvd dvd-btm">
                                <h1 class="custom-font"><strong>Delivery Item List</strong></h1>
                            </div>
                            <!-- /tile header -->
                            <!-- tile body -->
                            <div class="tile-body">
                                <table id="myTable" class="table table-bordered table-hover table-condensed">
                                    <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Style No</th>
                                        <th>Trims Type</th>
                                        <th>Size</th>
                                        <th>Color</th>
                                        <th>Description</th>
                                        <th>Unit</th>
                                        <th>Stock Qty</th>
                                        <th>Delivery Stock Qty</th>
                                        <th>Delivery Unit</th>
                                        <th>Conv. Rate</th>
                                        <th>Delivery Qty</th>
                                        <th>Gross Weight(Kg)</th>
                                        <th>Net Weight(Kg)</th>
                                        <th>Remarks</th>
{{--                                        <th class="text-center"><a style="text-align: center;color: white;" href="#" class="addRow Scroll">Action</a></th>--}}
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php($i = 1)
                                        @foreach($deliveryItemList as $item)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td style="width: 7%">
                                                    <input type="hidden" class="form-control" name="trims_stock_id[]" value="{{ $item->id }}">
                                                    <input type="hidden" class="form-control" name="item_unit_id[]" value="{{ $item->item_unit_id }}">
                                                    <input type="hidden" class="form-control" name="purchase_order_detail_id[]" value="{{ $item->purchase_order_detail_id }}">
                                                    <input type="hidden" class="form-control" name="trims_type_id[]" value="{{ $item->trims_type_id }}" id="trims_type_id{{ $item->id }}">
                                                    <input type="text" class="form-control" name="style_no[]" readonly required value="{{ $item->style_no }}">
                                                </td>
                                                <td style="width: 7%"><input type="text" class="form-control" name="trims_type_name[]" readonly required value="{{$item->trims_type_name}}"></td>
                                                <td style="width: 4%"><input type="text" class="form-control" name="item_size[]" readonly required="" value="{{$item->item_size}}"></td>
                                                <td style="width: 8%"><input type="text" class="form-control" name="item_color[]" readonly required="" value="{{ $item->item_color}}"></td>
                                                <td style="width: 10%"><input type="text" class="form-control" name="item_description[]" readonly required="" value="{{ $item->item_description}}"></td>
                                                <td style="width: 4%"><input type="text" class="form-control" name="item_unit[]" readonly required="" value="{{ $item->full_unit}}"></td>
                                                <td style="width: 8%"><input type="number" class="form-control StockQty" name="stock_quantity[]" readonly required="" value="{{ $item->stock_quantity }}"></td>
                                                <td style="width: 8%"><input type="number" class="form-control DStockQty" name="delivery_stock_quantity[]" step="any" value="0" max="{{$item->stock_quantity}}" id="delivery_stock_quantity{{$item->id}}" required ></td>
                                                <td style="width: 10%">
                                                    {{--<select type="number" class="form-control" name="delivery_unit[]" step="any" required>--}}
                                                    <select class="form-control" name="delivery_unit[]"  {{--data-id="{{ $item->id }}" --}} id="unit{{ $item->id }}" required = "">
                                                        <option value="" selected="selected">- Select -</option>
                                                        @if(!empty($units))
                                                            @foreach($units as $item)
                                                                <option value="{{ $item->id }}">{{ $item->full_unit }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </td>
                                                <td style="width: 5%"><input type="number" class="form-control GrossQty" name="gross_quantity_factor[]" step="any" value="1" required id="gross_qty_factor{{ $item->id }}"></td>
                                                <td style="width: 8%"><input type="number" class="form-control Total" name="delivery_quantity[]" step="any" value="0"  required readonly id="delivery_quantity{{ $item->id }}"></td>
                                                <td style="width: 8%"><input type="number" class="form-control" name="gross_weight[]" step="any"></td>
                                                <td style="width: 8%"><input type="number" class="form-control" name="net_weight[]" step="any"></td>
                                                <td><input type="text" class="form-control" name="item_remarks[]" ></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /tile body -->
                        </section>
                        <!-- /tile -->
                    </div>
                    <!-- /col -->
                    <!-- col -->
                    <!-- /col -->
                </div>
                <!-- /row -->
            </div>
            <!-- /tile body -->
        </section>
        <!-- /tile -->
    </div>
    <!-- /col -->
</div>


