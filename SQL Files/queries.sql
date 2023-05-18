-- (9) if a customer is positive find all the areas he visited
SELECT v.areas_id, Entrance_Date_Time, Exit_Date_Time
FROM visit AS v, customers as c, areas as a
WHERE c.NFCID = '$NFCID' AND v.customer_id = c.NFCID AND v.areas_id = a.Area_ID;

-- (10) if a customer is found positive find all the customers that could also be infected
SELECT DISTINCT c1.NFCID, c1.First_Name, c1.Last_Name, c1.Birth_Date, c1.ID_Number, c1.ID_Type, c1.ID_Issuing_Authority
FROM customers as c1,customers AS c2, visit as v1,visit as v2, areas AS A
WHERE c2.NFCID = '$NFCID' AND v2.customer_id = c2.NFCID AND v2.areas_id = A.Area_ID AND c1.NFCID = v1.customer_id AND v1.areas_id = v2.areas_id
AND (v1.Entrance_Date_Time BETWEEN DATE_ADD(v2.Entrance_Date_Time, INTERVAL -60 MINUTE) AND DATE_ADD(v2.Exit_Date_Time, INTERVAL 60 MINUTE) OR v2.Entrance_Date_Time BETWEEN v1.Entrance_Date_Time AND v1.Exit_Date_Time)
AND c1.NFCID != '$NFCID' AND v1.areas_id = A.Area_id;

-- (11a) the most visited areas
SELECT areas.Area_ID, Number_Of_Beds, Area_Name, Area_Description, A.counter  
FROM areas JOIN ( 
	SELECT COUNT(*) AS counter, areas_id AS area FROM visit
	GROUP BY areas_id) AS A
ON areas.Area_ID = A.area
ORDER BY counter DESC;

-- (11b) the most visited services
SELECT services.Service_ID, Service_Type, S.counter  
FROM services JOIN ( 
	SELECT COUNT(*) AS counter, service_id AS service FROM use_services
	GROUP BY service_id) AS S
ON services.Service_ID = S.service
ORDER BY counter DESC;

-- (11c) the services visited by the most customers
SELECT services.Service_ID, Service_Type, B.counter  
FROM services JOIN ( 
	SELECT COUNT(DISTINCT use_services.customer_id) AS counter, service_id AS service FROM use_services
	GROUP BY service_id) AS B
ON services.Service_ID = B.service
ORDER BY counter DESC;
