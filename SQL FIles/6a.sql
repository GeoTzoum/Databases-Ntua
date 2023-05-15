-- Ερώτημα 6α

SELECT * FROM transactions WHERE store_id = $store_id and date_of_transaction between $start_date and $end_date and 
payment_methods_id =$payment_method and number_of_products > $number_of_products
and total_cost > $total_cost;
