DROP VIEW trims_stock_delivery_sum
CREATE VIEW trims_stock_delivery_sum AS
SELECT delivery_details.trims_stock_id, trims_stocks.stock_quantity,  (trims_stocks.stock_quantity + SUM(delivery_details.gross_delivered_quantity)) AS received_quantity,
SUM(delivery_details.gross_delivered_quantity) AS total_delivered_quantity
FROM delivery_details
INNER JOIN delivery_masters ON delivery_masters.id = delivery_details.delivery_master_id
INNER JOIN trims_stocks ON trims_stocks.id = delivery_details.trims_stock_id
WHERE delivery_masters.status <> 'D'
GROUP BY delivery_details.trims_stock_id, trims_stocks.stock_quantity
