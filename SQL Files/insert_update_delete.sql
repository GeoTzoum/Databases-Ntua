-- create customer
INSERT INTO customers (First_Name, Last_Name, Birth_Date, ID_Number, ID_Type, ID_Issuing_Authority) 
VALUES ('$First_Name', '$Last_Name', '$Birth_Date', '$ID_Number', '$ID_Type', '$ID_Issuing_Authority');

-- create area
INSERT INTO areas (Number_Of_Beds, Area_Name, Area_Description) 
VALUES ('$Number_Of_Beds', '$Area_Name', '$Area_Description');

-- create service
INSERT INTO services (Service_Type) 
VALUES ('$Service_Type');

-- create use of service
INSERT INTO use_services(customer_id, service_id, Charge_Date_Time, Charge_Description, Charge_Amount)
VALUES ('$customer_id', '$service_id', '$Charge_Date_Time', '$Charge_Description', '$Charge_Amount');


-- delete customer
DELETE FROM customers WHERE NFCID = '$NFCID';

-- delete area
DELETE FROM areas WHERE Area_ID = '$Area_ID';

-- delete service
DELETE FROM services WHERE Service_ID = '$Service_ID';

--delete use of service
DELETE FROM use_services WHERE customer_id = '$customer_id';


-- read customer
SELECT * FROM customers WHERE NFCID = '$NFCID';

-- read area
SELECT * FROM areas WHERE Area_ID = '$Area_ID';

-- read service
SELECT * FROM services WHERE Service_ID = '$Service_ID';

-- read use of service
SELECT * FROM use_services WHERE customer_id = '$customer_id';


-- update customer
UPDATE customers SET First_Name = '$First_Name', Last_Name = '$Last_Name', Birth_Date = '$Birth_Date',
				ID_Number = '$ID_Number', ID_Type = '$ID_Type', ID_Issuing_Authority = '$ID_Issuing_Authority'
                WHERE NFCID = '$NFCID';
				
-- update area
UPDATE customers SET Number_Of_Beds = '$Number_Of_Beds', Area_Name = '$Area_Name', Area_Description = '$Area_Description'
                WHERE Area_ID = '$Area_ID';
				
-- update service
UPDATE services SET Service_Type = '$Service_Type'
				WHERE Service_ID = '$Service_ID';
				
-- update use of service
UPDATE service_cost SET customer_id = '$customer_id', service_id = '$service_id', Charge_Date_Time = '$Charge_Date_Time', 
					Charge_Description = '$Charge_Description', Charge_Amount = '$Charge_Amount'
				WHERE customer_id = '$customer_id' AND service_id = '$service_id' AND Charge_Date_Time = '$Charge_Date_Time';
