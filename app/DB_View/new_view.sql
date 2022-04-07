DROP VIEW trims_stock_delivery_sum
CREATE VIEW trims_stock_delivery_sum AS
SELECT delivery_details.trims_stock_id, trims_stocks.stock_quantity,  (trims_stocks.stock_quantity + SUM(delivery_details.gross_delivered_quantity)) AS received_quantity,
SUM(delivery_details.gross_delivered_quantity) AS total_delivered_quantity
FROM delivery_details
INNER JOIN delivery_masters ON delivery_masters.id = delivery_details.delivery_master_id
INNER JOIN trims_stocks ON trims_stocks.id = delivery_details.trims_stock_id
WHERE delivery_masters.status <> 'D'
GROUP BY delivery_details.trims_stock_id, trims_stocks.stock_quantity


/* Production Achievement SUM*/
CREATE VIEW production_achieve_sum_master AS
SELECT SUM(achievement_production) AS total_achievement, purchase_order_master_id FROM production_plan_detail_setups
WHERE STATUS <> 'D'
GROUP BY purchase_order_master_id

CREATE VIEW production_achieve_asum_master AS
SELECT purchase_order_masters.id, IFNULL(production_achieve_sum_master.total_achievement, 0) AS total_achievement
FROM purchase_order_masters
LEFT JOIN production_achieve_sum_master ON production_achieve_sum_master.purchase_order_master_id = purchase_order_masters.id
WHERE purchase_order_masters.status <> 'D'
ORDER BY purchase_order_masters.id

/* Production Achievement SUM*/
