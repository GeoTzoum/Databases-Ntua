
-- δέκα πιο δημοφιλή προϊόντα
SELECT `name`,  sum(`amount`) total FROM products
join `products_transactions` on products_transactions.product_id = products.id 
join `transactions` on products_transactions.transaction_id = transactions.id
join `customers` on transactions.customer_id = customers.id
where customers.id = $customer_id
GROUP BY NAME
ORDER BY TOTAL DESC LIMIT 10;

-- πόσα και ποιά καταστήματα επισκέπτεται
SELECT stores.id, address_street, address_number from stores
join `transactions` on transactions.store_id = stores.id
where customer_id = $customer_id
group by stores.id;

-- διάγραμμα με τις ώρες που επισκέπτεται  +++
SELECT date_of_transaction FROM transactions 
WHERE customer_id = $customer_id AND store_id = $store_id;


-- μέσος όρος συναλλαγών ανά εβδομάδα και ανά μήνα +++
SELECT date_of_transaction, total_cost FROM transactions WHERE customer_id = $customer_id;

