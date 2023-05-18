CREATE DATABASE hotel_GND;
USE hotel_GND;

CREATE TABLE customers (
NFCID INT NOT NULL AUTO_INCREMENT,
First_Name VARCHAR(20) NOT NULL,
Last_Name VARCHAR(20) NOT NULL,
Birth_Date DATE NOT NULL,
ID_Number BIGINT NOT NULL,
ID_Type VARCHAR(20),
ID_Issuing_Authority VARCHAR(20),
PRIMARY KEY (NFCID)
);

CREATE TABLE email (
Email VARCHAR(40),
Customer_ID INT NOT NULL,
PRIMARY KEY (Email, Customer_ID),
FOREIGN KEY(Customer_ID) 
REFERENCES customers(NFCID)
);

CREATE TABLE phone (
Phone_Number NUMERIC(10,0),
Customer_ID INT NOT NULL,
PRIMARY KEY (Phone_Number, Customer_ID),
FOREIGN KEY(Customer_ID) 
REFERENCES customers(NFCID)
);

CREATE TABLE areas (
Area_ID INT NOT NULL AUTO_INCREMENT,
Number_Of_Beds INT,
Area_Name VARCHAR(25) NOT NULL,
Area_Description VARCHAR(256),
PRIMARY KEY (Area_ID)
);

CREATE TABLE visit (
customer_id INT NOT NULL,
areas_id INT NOT NULL,
Entrance_Date_Time DATETIME NOT NULL,
Exit_Date_Time DATETIME NOT NULL,
FOREIGN KEY (customer_id)
REFERENCES customers(NFCID),
FOREIGN KEY (areas_id)
REFERENCES areas(Area_ID),
PRIMARY KEY (customer_id, areas_id, Entrance_Date_Time)
);

CREATE TABLE have_access (
customer_id INT NOT NULL,
areas_id INT NOT NULL,
Start_Date_Time DATETIME NOT NULL,
End_Date_Time DATETIME NOT NULL,
FOREIGN KEY (customer_id)
REFERENCES customers(NFCID),
FOREIGN KEY (areas_id)
REFERENCES areas(Area_ID),
PRIMARY KEY (customer_id, areas_id)
);

CREATE TABLE services (
Service_ID INT NOT NULL AUTO_INCREMENT,
Service_Type VARCHAR(40),
PRIMARY KEY (Service_ID)
);

CREATE TABLE provide (
service_id INT NOT NULL,
areas_id INT NOT NULL,
FOREIGN KEY (service_id)
REFERENCES services(Service_ID),
FOREIGN KEY (areas_id)
REFERENCES areas(Area_ID),
PRIMARY KEY (service_id, areas_id)
);

CREATE TABLE services_registration (
service_reg_id INT NOT NULL,
FOREIGN KEY(service_reg_id) 
REFERENCES services(Service_ID),
PRIMARY KEY (service_reg_id)
);

CREATE TABLE services_no_registration (
service_reg_id INT NOT NULL,
FOREIGN KEY(service_reg_id) 
REFERENCES services(Service_ID),
PRIMARY KEY (service_reg_id)
);

CREATE TABLE register_in_services (
customer_id INT NOT NULL,
service_id INT NOT NULL,
Registration_Date_Time DATETIME NOT NULL,
FOREIGN KEY (customer_id)
REFERENCES customers(NFCID),
FOREIGN KEY (service_id)
REFERENCES services_registration(service_reg_id),
PRIMARY KEY (customer_id, service_id)
);

CREATE TABLE use_services (
customer_id INT NOT NULL,
service_id INT NOT NULL,
Charge_Date_Time DATETIME NOT NULL,
Charge_Description VARCHAR(50),
Charge_Amount DECIMAL(10,2),
FOREIGN KEY (customer_id)
REFERENCES customers(NFCID),
FOREIGN KEY (service_id)
REFERENCES services(Service_ID),
PRIMARY KEY (customer_id, service_id, Charge_Date_Time)
);