-- create customer
INSERT INTO customers (first_name, last_name, birth_date, address_number, address_street, address_postal_code, city, number_of_kids, marital_status_id) 
VALUES ('$first_name', '$last_name', '$birth_date', '$address_number', '$address_street', '$postal_code', '$city', '$number_of_kids', '$marital_status');

-- create product
INSERT INTO products (tag, name, category_id, price) VALUES ('$tag', '$name', '$category', '$price');

-- create store
INSERT INTO stores (opening_hour, closing_hour, address_number, address_street, address_postal_code, city, square_meters) 
VALUES ('08:00', '21:00', '$address_number', '$address_street', '$postal_code', '$city', '$square_meters');


-- delete customer
DELETE FROM customers WHERE id = $customer_id;

-- delete product
DELETE FROM products WHERE id = $product_id;

-- delete store
DELETE FROM stores WHERE id = $store_id;


-- read customer
SELECT * FROM customers WHERE id = '$customer_id';

-- read product
SELECT * FROM products WHERE id = '$product_id';

-- read store
SELECT * FROM stores WHERE id = '$store_id';


-- update customer
UPDATE customers SET first_name = '$first_name', last_name = '$last_name', birth_date = '$birth_date',
				address_number = '$address_number', address_street = '$address_street', address_postal_code = '$postal_code',
                city = '$city', number_of_kids = '$number_of_kids', marital_status_id = '$marital_status'
                WHERE id = '$customer_id';

-- update product
UPDATE products SET tag = '$tag', name = '$name', category_id = '$category', price = '$price'
                WHERE id = '$product_id';

-- update store
UPDATE stores SET address_number = '$address_number', address_street = '$address_street',
                address_postal_code = '$postal_code', city = '$city', square_meters = '$square_meters'
                WHERE id = '$store_id';