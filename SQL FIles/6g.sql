-- Ερώτημα 6g ταξινόμηση καταστημάτων βάση των συναλλαγών που έχουν γίνει σε αυτά
SELECT stores.id, address_number, address_street, city, A.counter  FROM stores JOIN ( 
SELECT COUNT(*) AS counter, store_id AS store FROM transactions
GROUP BY store_id) AS A
ON stores.id = A.store
ORDER BY counter DESC;

-- ταξινόμηση πελατών βάση των αγορών τους
SELECT first_name, last_name , A.counter FROM customers JOIN (
SELECT COUNT(*) AS counter, customer_id AS customer FROM transactions
GROUP BY customer_id) AS A
ON customers.id = A.customer
ORDER BY counter DESC;