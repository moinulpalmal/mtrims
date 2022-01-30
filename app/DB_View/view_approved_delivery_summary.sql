CREATE VIEW view_approved_delivery_summary
AS
SELECT purchase_order_masters.lpd, purchase_order_masters.lpd_po_no, buyers.name AS buyer_name, buyers.id AS buyer_id,
trims_types.name AS trims_types, trims_types.id AS trims_type_id,purchase_order_details.style_no, purchase_order_details.item_color,
purchase_order_details.item_size, purchase_order_details.item_description,
delivery_masters.id AS challan_no, stores.name AS delivery_location_name, delivery_masters.challan_date,
units.full_unit, units.short_unit,
delivery_details.gross_delivered_quantity, purchase_order_details.unit_price_in_usd AS unit_price,
(delivery_details.gross_delivered_quantity * purchase_order_details.unit_price_in_usd) AS total_price,
delivery_details.remarks,
delivery_masters.purchase_order_master_id, delivery_details.purchase_order_detail_id, delivery_masters.is_replacement_challan
FROM delivery_details
INNER JOIN delivery_masters ON delivery_masters.id = delivery_details.delivery_master_id
INNER JOIN purchase_order_details ON
	(purchase_order_details.item_count = delivery_details.purchase_order_detail_id
	AND purchase_order_details.purchase_order_master_id = delivery_masters.purchase_order_master_id)
INNER JOIN purchase_order_masters ON purchase_order_masters.id = purchase_order_details.purchase_order_master_id
INNER JOIN buyers ON buyers.id = purchase_order_masters.buyer_id
INNER JOIN units ON units.id = purchase_order_details.item_unit_id
INNER JOIN trims_types ON trims_types.id = purchase_order_details.trims_type_id
INNER JOIN stores ON stores.id = delivery_masters.store_id
WHERE delivery_masters.status = 'AP'
