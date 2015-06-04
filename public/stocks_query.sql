select products_sum.id, products_sum.name, sum(consumed) as total_consumed, sum(purchased) as total_purchased, (sum(purchased) - sum(consumed)) as remaining from 
(select products.id, products.name, 
0 as purchased,
ifnull(order_items.quantity, 0) as consumed 
from products 
left join order_items on products.id = order_items.product_id
where products.product_type_id = 2 or products.product_type_id = 4
union
select products.id, products.name, 
ifnull(stocks.quantity, 0) as purchased,
0 as consumed 
from products 
left join stocks on products.id = stocks.product_id 
where products.product_type_id = 2 or products.product_type_id = 4
union
select products.id, products.name, 
0 as purchased,
ifnull(ingredient_order_items.quantity * ingredients.quantity, 0) as consumed 
from products 
left join ingredients on products.id = ingredients.ingredient_product_id 
left join order_items as ingredient_order_items on ingredients.prepared_product_id 
where products.product_type_id = 2 or products.product_type_id = 4
) as products_sum
group by products_sum.id, products_sum.name