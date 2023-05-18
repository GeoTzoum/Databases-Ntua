CREATE VIEW customer_info AS 
SELECT c.NFCID, First_Name, Last_Name, Birth_Date, ID_Number, ID_Type,ID_Issuing_Authority, Email, Phone_Number
FROM customers AS c
JOIN email ON email.Customer_ID = c.NFCID
JOIN phone ON phone.Customer_ID = c.NFCID;

--show customer view
SELECT * FROM customer_info;
 
CREATE VIEW servicecost_view AS
SELECT c.NFCID, s.Service_ID, u.Charge_Amount
FROM customers AS c, services as s, use_services as u
WHERE c.NFCID = u.customer_id AND u.service_id = s.Service_ID AND u.Charge_Amount > 0;

--show service cost view
SELECT * FROM servicecost_view;