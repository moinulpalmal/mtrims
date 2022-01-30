
CREATE VIEW view_item_color_list AS
SELECT DISTINCT item_color
FROM purchase_order_details

SELECT *FROM view_item_color_list


CREATE VIEW view_item_size_list AS
SELECT DISTINCT item_size
FROM purchase_order_details

SELECT *FROM view_item_size_list

SELECT *FROM view_p_o_order_sum

CREATE VIEW view_p_o_order_sum AS
SELECT purchase_order_master_id AS id,SUM(item_order_quantity) AS total_order_quantity
FROM purchase_order_details
GROUP BY purchase_order_master_id

SELECT *FROM view_p_o_stock_sum

CREATE VIEW view_p_o_stock_sum AS
SELECT purchase_order_master_id AS id,SUM(stock_quantity) AS total_stock_quantity
FROM trims_stocks
GROUP BY purchase_order_master_id


