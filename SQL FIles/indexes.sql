CREATE INDEX idx_transactions_date_of_transaction
ON supermarket.`transactions` (date_of_transaction);

CREATE INDEX idx__transactions_total_cost
ON supermarket.`transactions` (total_cost);

CREATE INDEX idx_transactions_payment_method
ON supermarket.`transactions` (payment_methods_id);