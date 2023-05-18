CREATE INDEX idx_service_cost_charge_description
ON use_services (Charge_Description);

CREATE INDEX idx_service_cost_charge_amount
ON use_services (Charge_Amount);

CREATE INDEX idx_customers_birth_date
ON customers (Birth_Date);
