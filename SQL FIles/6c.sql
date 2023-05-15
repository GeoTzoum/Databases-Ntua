-- δέκα πιο δημοφιλή ζεύγη προϊόντων
SELECT products1.`name` AS name1, products2.`name` AS name2, B.counter FROM (
(SELECT A.pr1 AS p1, A.pr2 AS p2, COUNT(*) AS counter  FROM ( 
SELECT prodtrans1.product_id AS pr1, prodtrans2.product_id AS pr2 
FROM products_transactions AS prodtrans1, products_transactions AS prodtrans2 
WHERE prodtrans1.transaction_id = prodtrans2.transaction_id 
	AND prodtrans1.product_id <> prodtrans2.product_id) AS A
GROUP BY p1, p2)) AS B JOIN
products AS products1 ON products1.id = p1
JOIN products AS products2 ON products2.id = p2
ORDER BY counter DESC
LIMIT 20;

-- 3 πιο δημοφιλείς θέσεις σε ένα κατάστημα
SELECT shelf, corridor, COUNT(products_transactions.`product_id`) AS counter
FROM products_transactions, transactions, store_products
WHERE products_transactions.transaction_id = transactions.id 
	AND transactions.store_id = store_products.store_id 
	AND products_transactions.product_id = store_products.product_id
	AND transactions.store_id = $store_id
GROUP BY shelf, corridor
ORDER BY counter DESC
LIMIT 3;

-- το ποσοστό ανά κατηγορία προϊόντος που οι πελάτες εμπιστεύονται προϊόντα με ετικέτες καταστήματος
SELECT tag, COUNT(tag) AS counter FROM products_transactions, products
WHERE products_transactions.product_id = products.id 
AND products.category_id = '$category_id'
GROUP BY tag;

-- τις ώρες που οι καταναλωτές ξοδεύουν περισσότερα λεφτά
SELECT AVG(total_cost) AS avg, inter FROM 
(SELECT A.total_cost, CASE WHEN A.hours BETWEEN 8 AND 12 THEN 'first' 
WHEN A.hours BETWEEN 12 AND 15 THEN 'second'
WHEN A.hours BETWEEN 15 AND 18 THEN 'third'
ELSE 'forth' END AS inter FROM 
(SELECT total_cost, HOUR(date_of_transaction) AS hours FROM transactions) AS A) AS B
GROUP BY B.inter;

-- ποσοστό ηλικιακών ομάδων ανά ώρα
SELECT COUNT(*) AS counter, E.interv, E.ageinterv FROM (
SELECT C.age_inter AS ageinterv, D.inter AS interv FROM (
SELECT customers.id AS customer, CASE WHEN YEAR(birth_date) BETWEEN 0 AND 1965 THEN 'elder'
WHEN YEAR(birth_date) BETWEEN 1960 AND 1990 THEN 'middleaged'
ELSE 'young' END AS age_inter FROM customers) AS C JOIN (
SELECT customer, inter FROM    
(SELECT A.customer_id AS customer, CASE WHEN A.hours BETWEEN 8 AND 12 THEN 'first' 
WHEN A.hours BETWEEN 12 AND 15 THEN 'second'
WHEN A.hours BETWEEN 15 AND 18 THEN 'third'
ELSE 'forth' END AS inter FROM 
(SELECT customer_id, HOUR(date_of_transaction) AS hours FROM transactions) AS A) AS B) AS D
ON C.customer = D.customer) AS E
GROUP BY E.ageinterv, E.interv;