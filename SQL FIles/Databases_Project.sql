CREATE TABLE `categories`(
	`id` INT NOT NULL PRIMARY KEY,
    `name` VARCHAR(25)
);

CREATE TABLE `product_tag`(
	`id` BOOLEAN NOT NULL PRIMARY KEY
);

CREATE TABLE `products`(
	`id` INT NOT NULL AUTO_INCREMENT,
    `tag` BOOLEAN NOT NULL,
    `name` VARCHAR(25) NOT NULL,
    `category_id` INT NOT NULL,
    PRIMARY KEY(`id`),
    CONSTRAINT `fk_categories_id__products_categories_id`
    FOREIGN KEY(`category_id`) 
    REFERENCES `categories`(`id`),
    CONSTRAINT `fk_product_tag__products_tag`
    FOREIGN KEY(`tag`) 
    REFERENCES `product_tag`(`id`)
);

CREATE TABLE `stores`(
	`id` INT NOT NULL,
    `opening_hour` TIME NOT NULL,
    `closing_hour` TIME NOT NULL,
    `address_number` INT NOT NULL,
    `address_street` VARCHAR(25) NOT NULL,
    `address_postal_code` INT NOT NULL,
    `city` VARCHAR(25) NOT NULL,
    `square_meters` INT NOT NULL,
    PRIMARY KEY(`id`)
);


CREATE TABLE `phone_store`(
	`phone_id` NUMERIC(10,0) NOT NULL,
    `store_id` INT NOT NULL,
	CONSTRAINT `fk_store_id__phone_store_stores_id`
    FOREIGN KEY(`store_id`) 
    REFERENCES `stores`(`id`),
    PRIMARY KEY (`phone_id`)
);

CREATE TABLE `store_products`(
	`shelf` INT NOT NULL,
    `corridor` INT NOT NULL,
    `price` DECIMAL(5,2) NOT NULL,
    `product_id` INT NOT NULL,
    `store_id` INT NOT NULL,
	CONSTRAINT `fk_product_id__sells_products_id`
    FOREIGN KEY(`product_id`) 
    REFERENCES `products`(`id`),
    CONSTRAINT `fk_stores_id__sells_stores_id`
    FOREIGN KEY(`store_id`) 
    REFERENCES `stores`(`id`),
    PRIMARY KEY(`product_id`,`store_id`)
);


CREATE TABLE `store_categories`(
    `store_id` INT NOT NULL,
    `category_id` INT NOT NULL,
	CONSTRAINT `fk_store_id__store_categories_stores_id`
    FOREIGN KEY(`store_id`) 
    REFERENCES `stores`(`id`),
    CONSTRAINT `fk_category_id__store_categories_categories_id`
    FOREIGN KEY(`category_id`) 
    REFERENCES `categories`(`id`),
    PRIMARY KEY(`store_id`,`category_id`)
);

CREATE TABLE `marital_status`(
	`id` INT NOT NULL PRIMARY KEY,
    `status` VARCHAR(25)
);

CREATE TABLE `customers`(
	`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `first_name` VARCHAR(25),
    `last_name` VARCHAR(25),
    `birth_date` date,
    `address_number` INT NOT NULL,
    `address_street` VARCHAR(25) NOT NULL,
    `address_postal_code` INT NOT NULL,
    `city` VARCHAR(25) NOT NULL,
    `number_of_kids` INT NOT NULL,
    `marital_status_id` INT NOT NULL,
    CONSTRAINT `fk_marital_status_id__customers_marital_status_id`
    FOREIGN KEY(`marital_status_id`) 
    REFERENCES `marital_status`(`id`)
);

CREATE TABLE `phone_customer`(
	`phone_id` NUMERIC(10,0) NOT NULL,
    `customer_id` INT NOT NULL,
	CONSTRAINT `fk_customer_id__phone_customer_customer_id`
    FOREIGN KEY(`customer_id`) 
    REFERENCES `customers`(`id`),
    PRIMARY KEY (`phone_id`)
);

CREATE TABLE `email_customer`(
	`email_id` VARCHAR(45),
    `customer_id` INT NOT NULL,
    CONSTRAINT `fk_customer_id__email_customer_customers_id`
    FOREIGN KEY(`customer_id`) 
    REFERENCES `customers`(`id`),
    PRIMARY KEY (`email_id`)
);

CREATE TABLE `email_store`(
	`email_id` VARCHAR(45),
    `store_id` INT NOT NULL,
    CONSTRAINT `fk_store_id__email_store_stores_id`
    FOREIGN KEY(`store_id`) 
    REFERENCES `stores`(`id`),
    PRIMARY KEY (`email_id`)
);

CREATE TABLE `cards`(
	`id` INT NOT NULL AUTO_INCREMENT UNIQUE,
    `customer_id` INT NOT NULL UNIQUE,
    `points` INT NOT NULL,
    `gift_cards` INT NOT NULL,
    CONSTRAINT `fk_customer_id__cards_customer_id`
    FOREIGN KEY(`customer_id`) 
    REFERENCES `customers`(`id`),
    PRIMARY KEY(`id`,`customer_id`)
);

CREATE TABLE `price_history`(
	`id` INT NOT NULL AUTO_INCREMENT,
    `product_id` INT NOT NULL,
    `new_price` DECIMAL(5,2) NOT NULL,
    `old_price` DECIMAL(5,2) NOT NULL,
    `date` DATE NOT NULL,
    CONSTRAINT `fk_product_id__price_history_product_id`
    FOREIGN KEY(`product_id`) 
    REFERENCES `products`(`id`),
    PRIMARY KEY(`id`, `product_id`)
);

CREATE TABLE `payment_methods`(
	`id` INT NOT NULL PRIMARY KEY,
    `method` VARCHAR(25)
);

CREATE TABLE `transactions`(
	`id` INT NOT NULL AUTO_INCREMENT,
	`customer_id` INT NOT NULL,
    `store_id` INT NOT NULL,
    `payment_methods_id` INT NOT NULL,
    `date_of_transaction` DATETIME NOT NULL,
    `number_of_products` INT NOT NULL,
    `total_cost` DECIMAL(6,2) NOT NULL,
	CONSTRAINT `fk_store_id__transactions_store_id`
    FOREIGN KEY(`store_id`) 
    REFERENCES `stores`(`id`),
	CONSTRAINT `fk_customers_id__transactions_customer_id`
    FOREIGN KEY(`customer_id`) 
    REFERENCES `customers`(`id`),
	PRIMARY KEY(`id`),
    CONSTRAINT `fk_payment_methods_id__transactions_payment_method__id`
    FOREIGN KEY(`payment_methods_id`)
    REFERENCES `payment_methods`(`id`)
);

CREATE TABLE `products_transactions`(
	`transaction_id` INT NOT NULL,
    `product_id` INT NOT NULL,
    `amount` INT NOT NULL,
	CONSTRAINT `fk_transaction_id__products_transactions_transactions_id`
	FOREIGN KEY(`transaction_id`) 
	REFERENCES `transactions`(`id`),  
    CONSTRAINT `fk_product_id__products_transactions_products_id`
	FOREIGN KEY(`product_id`) 
	REFERENCES `products`(`id`),
    PRIMARY KEY(`transaction_id`,`product_id`)
);

