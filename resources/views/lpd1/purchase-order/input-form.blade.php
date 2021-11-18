<div class="row">
    <!-- col -->
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <!-- tile -->
        <section class="tile">
            <!-- tile header -->
            <div class="tile-header dvd dvd-btm">
                <h1 class="custom-font"><strong>New Purchase Order Entry Form</strong></h1>
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
                                <h1 class="custom-font"><strong>Purchase Order</strong> Master Information</h1>
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
                                    <div class="col-md-3 no-padding">
                                        <div class="form-group">
                                            <label for="LPD_PO" class="control-label">LPD PO No.</label>
                                            <input type="number" class="form-control" name="lpd_po_no" id="LPD_PO" placeholder="2485" required value="{{ old('lpd_po_no') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3 no-padding">
                                        <div class="form-group">
                                            <label for="Buyer_PO_No" class="control-label">Buyer PO No.</label>
                                            <input type="text" class="form-control" name="buyer_po_no" id="Buyer_PO_No" required value="{{ old('buyer_po_no') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3 no-padding">
                                        <div class="form-group">
                                            <label for="PO_Date" class="control-label">Purchase Order Date</label>
                                            <input type="date" class="form-control" name="purchase_order_date" id="PO_Date" required value="{{ old('purchase_order_date') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3 no-padding">
                                        <div class="form-group">
                                            <label for="SubContractorType" class="control-label">Select Buyer</label>
                                            <select id="SubContractorType" class="form-control chosen-select" name="buyer_name" style="width: 100%;">
                                                <option value="" selected ="selected">- - - Select - - -</option>
                                                @if(!empty($buyers))
                                                    @foreach($buyers as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 no-padding">
                                    <div class="form-group">
                                        <label for="FactoryName" class="control-label">Select Factory</label>
                                        <select id="FactoryName" class="form-control chosen-select" name="factory_name" style="width: 100%;">
                                            <option value="" selected ="selected">- - - Select - - -</option>
                                            @if(!empty($factories))
                                                @foreach($factories as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="row" style="padding: 0px 15px;">
                                    <div class="col-md-3 no-padding">
                                        <div class="form-group">
                                            <label for="DeliveryLocation" class="control-label">Primary Delivery Location</label>
                                            <select id="DeliveryLocation" class="form-control chosen-select" name="primary_delivery_location" style="width: 100%;">
                                                <option value="" selected ="selected">- - - Select - - -</option>
                                                @if(!empty($stores))
                                                    @foreach($stores as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 no-padding">
                                        <div class="form-group">
                                            <label for="Remarks" class="control-label">Remarks</label>
                                            {{--                                                    <in size="5" class="form-control" name="remarks" id="Remarks" placeholder="Enter sub-contractor address"></in>--}}
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
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
                        <!-- tile -->
                        <section class="tile no-padding">
                            <!-- tile header -->
                            <div class="tile-header dvd dvd-btm">
                                <h1 class="custom-font"><strong>Item List</strong></h1>
                            </div>
                            <!-- /tile header -->
                            <!-- tile body -->
                            <div class="tile-body">
                                <table id="myTable" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>Style No</th>
                                        <th>Trims Type</th>
                                        <th>Size / Count</th>
                                        <th>Color</th>
                                        <th>Description/Shade</th>
                                        <th>Unit</th>
                                        <th>Remarks</th>
                                        <th>Qty</th>
                                        <th>Gross (F)</th>
                                        <th>Qty (Gross)</th>
                                        <th>U. Price (USD)</th>
                                        <th>Add Amt(%)</th>
                                        <th>G. U. Price(%)</th>
                                        <th>Total (USD)</th>
                                        <th class="text-center"><a style="text-align: center;color: white;" href="#" class="addRow Scroll"><i class="fa fa-plus"></i></a></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td style="border: none;">

                                        </td>
                                        <td style="border: none;">

                                        </td>
                                        <td style="border: none;">

                                        </td>
                                        <td style="border: none;">

                                        </td>
                                        <td style="border: none;">

                                        </td>
                                        <td style="border: none;">

                                        </td>
                                        <td style="border: none;">

                                        </td>
                                        <td style="border: none;">

                                        </td>
                                        <td style="border: none;">

                                        </td>
                                        <td style="border: none;">

                                        </td>
                                        <td style="border: none;">

                                        </td>
                                        <td style="border: none;">

                                        </td>
                                        {{--<td style="border: none;">

                                        </td>--}}

                                        <td style="border: none;color: #3c8dbc;"><b>Grand Total</b></td>
                                        <td><b class="GrandTotal"></b></td>
                                    </tr>
                                    </tfoot>
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


