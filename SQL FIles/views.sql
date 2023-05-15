CREATE VIEW sales_view AS
SELECT transactions.id, transactions.date_of_transaction, total_cost, stores.id AS store_id, stores.address_number, 
stores.address_street, first_name, last_name, payment_methods.method, categories.id AS cat_id, `categories`.`name` FROM transactions
JOIN customers ON customers.id = transactions.customer_id
JOIN stores ON stores.id = transactions.store_id
JOIN payment_methods ON payment_methods.id = transactions.payment_methods_id
JOIN products_transactions ON products_transactions.transaction_id = transactions.id
JOIN products ON products.id = products_transactions.product_id
JOIN categories ON categories.id = products.category_id
GROUP BY transactions.id, cat_id, `categories`.`name`;

CREATE VIEW customer_view AS 
SELECT customers.id, first_name, last_name, birth_date, address_number, address_street,
address_postal_code, city, number_of_kids, email_id, phone_id, `marital_status`.`status`, cards.id AS card 
FROM customers 
JOIN email_customer  ON email_customer.customer_id = customers.id
JOIN phone_customer ON phone_customer.customer_id = customers.id 
JOIN marital_status ON marital_status.id = customers.marital_status_id
LEFT JOIN cards ON cards.customer_id = customers.id;