CREATE TABLE customer_quoted (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        customer_name VARCHAR(255) NOT NULL,
        customer_id BIGINT UNIQUE,
        customer_code VARCHAR(255) UNIQUE,
        registration_number VARCHAR(255) UNIQUE,
        create_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (customer_id) REFERENCES supercare2Dev.customer(id)
);

CREATE TABLE address_type (
	id INT AUTO_INCREMENT PRIMARY KEY,
	address VARCHAR(40) UNIQUE,
	create_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)

CREATE TABLE customer_site_quoted (
	id INT(11) AUTO_INCREMENT PRIMARY KEY,
	site_name VARCHAR(255) NOT NULL,
	site_id BIGINT,
	customer_id INT(11) NOT NULL,
	site_code VARCHAR(255) UNIQUE,
	vat_number VARCHAR(255) NULL,
	contact_person VARCHAR(255) NULL,
	email_address VARCHAR(255),
	tel_number VARCHAR(255),
	cell_number VARCHAR(255),
	fax_number VARCHAR(255),
	create_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY (site_id) REFERENCES supercare2Dev.customer_site(id),
	FOREIGN KEY (customer_id) REFERENCES customer_quoted(id),
	--FOREIGN KEY (address_quoted) REFERENCES address_quoted(id)
);

CREATE TABLE address_quoted (
	id INT AUTO_INCREMENT PRIMARY KEY,
	address_name VARCHAR(255) NOT NULL,
	site_quoted INT(11) NOT NULL,
	address_type INT NOT NULL,
	create_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY (site_quoted) REFERENCES customer_site_quoted(id)
,
	FOREIGN KEY (address_type) REFERENCES address_type(id)

);



ALTER TABLE customer_quoted AUTO_INCREMENT = 1000000000;

ALTER TABLE customer_site_quoted AUTO_INCREMENT = 1000000000;

ALTER TABLE customer_quoted
ADD COLUMN upd_date DATETIME AFTER registration_number

ALTER TABLE customer_quoted
ADD COLUMN client_industry INT AFTER registration_number






CREATE TABLE client_industry(
   Id int PRIMARY KEY NOT NULL,
   name varchar(255),
   description varchar(255),
   create_date date)
;

INSERT INTO client_industry (Id,name,description,create_date) VALUES (1,'Commercial','Commercial',{d '2022-02-02'});
INSERT INTO client_industry (Id,name,description,create_date) VALUES (2,'Industrial','Industrial',{d '2022-02-02'});
INSERT INTO client_industry (Id,name,description,create_date) VALUES (3,'Retail','Retail',{d '2022-02-02'});
INSERT INTO client_industry (Id,name,description,create_date) VALUES (4,'Healthcare','Healthcare',{d '2022-02-02'});
INSERT INTO client_industry (Id,name,description,create_date) VALUES (5,'Retirement','Retirement',{d '2022-02-02'});
INSERT INTO client_industry (Id,name,description,create_date) VALUES (6,'Education','Education',{d '2022-02-02'});
INSERT INTO client_industry (Id,name,description,create_date) VALUES (7,'Mining','Mining',{d '2022-02-02'});
INSERT INTO client_industry (Id,name,description,create_date) VALUES (8,'Offshore','Offshore',{d '2022-02-02'});
INSERT INTO client_industry (Id,name,description,create_date) VALUES (9,'Government','Government',null);







ALTER TABLE customer_quoted
ADD FOREIGN KEY (client_industry) REFERENCES client_industry(Id)
;

SELECT * FROM customer_quoted

SELECT * FROM customer_site_quoted

SELECT * FROM supercare2Dev.customer

SELECT * FROM address_type



INSERT INTO address_type (address)
VALUES ("Service"),
	("Postal"),
	("Billing")

INSERT INTO address_type (address)
VALUES ("Physical")

select * from address_quoted



ALTER TABLE address_quoted
ADD COLUMN upd_date DATETIME AFTER address_type

CREATE TABLE service_frequency (
	id INT AUTO_INCREMENT PRIMARY KEY,
	frequency VARCHAR(40) UNIQUE,
	create_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

SELECt * FROM service_frequency

INSERT INTO service_frequency (frequency)
VALUES ("Once Off"),
	("Daily"),
	("Weekly"),
	("Monthly"),
	("Yearly")

UPDATE service_frequency
SET frequency = "Anually"
WHERE frequency = "Daily";

UPDATE service_frequency
SET frequency = "Bianually"
WHERE frequency = "Weekly";

UPDATE service_frequency
SET frequency = "Quartely"
WHERE frequency = "Monthly";

UPDATE service_frequency
SET frequency = "Monthly"
WHERE frequency = "Yearly";

INSERT INTO service_frequency (frequency)
VALUES ("Bimonthly")

CREATE TABLE contract_duration (
	id INT AUTO_INCREMENT PRIMARY KEY,
	duration VARCHAR(40) UNIQUE,
	create_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)

INSERT INTO contract_duration (duration)
VALUES ("Once Off"),
	("6 months"),
	("12 months"),
	("24 months"),
	("36 months")

select * from contract_duration

UPDATE contract_duration
SET duration = "1 month"
WHERE duration = "6 months";

UPDATE contract_duration
SET duration = "2 months"
WHERE duration = "12 months";

UPDATE contract_duration
SET duration = "3 months"
WHERE duration = "24 months";

UPDATE contract_duration
SET duration = "4 months"
WHERE duration = "36 months";


INSERT INTO contract_duration (duration)
VALUES ("5 months"),
	("6 months"),
	("12 months"),
	("24 months"),
	("36 months")

CREATE TABLE quote (
	id INT AUTO_INCREMENT PRIMARY KEY,
	quote_number VARCHAR(10) UNIQUE NOT NULL,
	client_order_no VARCHAR(40) NOT NULL,
	service_frequency INT NOT NULL,
	contract_duration INT NOT NULL,
	site_quoted INT UNIQUE NOT NULL,
	service_start_date VARCHAR(40) DEFAULT NULL,
	sap_quote_no VARCHAR(40) DEFAULT NULL,
	debtors_no VARCHAR(40) DEFAULT NULL,
	contract_code VARCHAR(40) DEFAULT NULL,
	j_number VARCHAR(40) DEFAULT NULL,
	profit_center VARCHAR(40) DEFAULT NULL,
	service_description VARCHAR(255) NOT NULL,
	special_notes VARCHAR(255),
	created_by BIGINT DEFAULT NULL,
	last_updated_by BIGINT DEFAULT NULL,
	upd_date DATETIME,
	create_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY (site_quoted) REFERENCES customer_site_quoted(id),
	FOREIGN KEY (created_by) REFERENCES supercare2Dev.user(id),
	FOREIGN KEY (last_updated_by) REFERENCES supercare2Dev.user(id),
	FOREIGN KEY (service_frequency) REFERENCES service_frequency(id),
	FOREIGN KEY (contract_duration) REFERENCES contract_duration(id)
);


CREATE TABLE sales_org
(
   Id int PRIMARY KEY NOT NULL,
   name varchar(255),
   description varchar(255),
   create_date date
)
;

INSERT INTO sales_org (Id,name,description,create_date) VALUES (1,'FSSG','FSSG',{d '2022-02-03'});
INSERT INTO sales_org (Id,name,description,create_date) VALUES (3,'SHYG','Hygiene',{d '2022-04-01'});


CREATE TABLE sales_division
(
   Id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
   name varchar(255),
   description varchar(255),
   sales_org int,
   is_active bit,
   create_date date
)
;



CREATE TABLE region
(
   Id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
   RegionName varchar(255),
   Description varchar(255),
   Address varchar(255),
   PostalAddress varchar(255),
   TelNum varchar(255),
   Email varchar(255),
   Website varchar(255),
   CreateDate timestamp
)
;


ALTER TABLE quote MODIFY quote_number VARCHAR(10) UNIQUE

ALTER TABLE quote DROP FOREIGN KEY quote_ibfk_1;

ALTER TABLE quote DROP INDEX site_quoted

ALTER TABLE quote ADD CONSTRAINT fk_site_quoted FOREIGN KEY (site_quoted) REFERENCES customer_site_quoted(id)
;

SHOW CREATE TABLE quote

show index from quote

select * from quote

SELECT CONCAT('HO', LPAD(77, 8, 0));

UPDATE quote SET quote_number =  CONCAT('HO', LPAD(id, 8, 0)) WHERE id = 1

ALTER TABLE quote
ADD COLUMN sales_org INT AFTER special_notes;

ALTER TABLE quote
ADD FOREIGN KEY (sales_org) REFERENCES sales_org(Id)
;

ALTER TABLE quote
ADD COLUMN sales_division INT AFTER sales_org;

ALTER TABLE quote
ADD FOREIGN KEY (sales_division) REFERENCES sales_division(Id)
;

ALTER TABLE quote
ADD COLUMN region INT AFTER sales_division;

ALTER TABLE quote
ADD FOREIGN KEY (region) REFERENCES region(Id)
;





CREATE TABLE sales_district
(
   Id int PRIMARY KEY NOT NULL,
   DistrictName varchar(255),
   CreateDate timestamp
)
;



ALTER TABLE quote
ADD COLUMN sales_org INT AFTER registration_number;


ALTER TABLE quote
ADD FOREIGN KEY (sales_org) REFERENCES sales_org(Id);


ALTER TABLE quote
ADD COLUMN sales_division INT AFTER sales_org;


ALTER TABLE quote
ADD FOREIGN KEY (sales_division) REFERENCES sales_division(Id);


ALTER TABLE quote
ADD COLUMN region INT AFTER sales_division;


ALTER TABLE quote
ADD FOREIGN KEY (region) REFERENCES region(Id);




ALTER TABLE quote
ADD column sales_district INT AFTER region

ALTER TABLE quote
ADD FOREIGN KEY (sales_district) REFERENCES sales_district(Id)
;

ALTER TABLE quote
ADD COLUMN client_order_date date AFTER client_order_no;

ALTER TABLE quote
ADD COLUMN valid_from date AFTER client_order_date;

ALTER TABLE quote
ADD COLUMN client_quote_no VARCHAR(40) NOT NULL AFTER client_order_no

CREATE TABLE contact_type (
	id INT AUTO_INCREMENT PRIMARY KEY,
	contact VARCHAR(40) UNIQUE,
	create_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)

INSERT INTO contact_type (contact)
VALUES ("Client Overview"),
	("Decision Maker"),
	("Accounts Department"),
	("Company Responsible for Payment")

select * from contact

CREATE TABLE contact (
	id INT AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(40) NOT NULL,
	quote_id INT NOT NULL,
	contact_type INT NOT NULL,
	designation VARCHAR(40),
	email VARCHAR(40) NOT NULL,
	fax_number VARCHAR(40),
	tel_number VARCHAR(40),
	cell_number VARCHAR(40),
	upd_date DATETIME,
	create_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY (quote_id) REFERENCES quote(id)
,
	FOREIGN KEY (contact_type) REFERENCES contact_type(id)

);

select * from client_industry

UPDATE client_industry
SET name = "Commercial"
WHERE name = "Health Care";

UPDATE client_industry
SET name = "Industrial"
WHERE name = "Hospitality";

UPDATE client_industry
SET name = "Retail"
WHERE name = "Manufacturing Other";

UPDATE client_industry
SET name = "Healthcare"
WHERE name = "Airports";

UPDATE client_industry
SET name = "Retirement"
WHERE name = "Government";

UPDATE client_industry
SET name = "Education"
WHERE name = "Commerce";

UPDATE client_industry
SET name = "Mining"
WHERE name = "Retail";

UPDATE client_industry
SET name = "Offshore"
WHERE name = "Education";

UPDATE client_industry
SET name = "Education"
WHERE name = "Offshore"
AND description = "Commerce";

INSERT INTO client_industry (name, description)
VALUES ("Government", "Government")

UPDATE client_industry
SET description = "Commercial"
WHERE name = "Commercial";

UPDATE client_industry
SET description = "Industrial"
WHERE name = "Industrial";

UPDATE client_industry
SET description = "Retail"
WHERE name = "Retail";

UPDATE client_industry
SET description = "Healthcare"
WHERE name = "Healthcare";

UPDATE client_industry
SET description = "Retirement"
WHERE name = "Retirement";

UPDATE client_industry
SET description = "Education"
WHERE name = "Education";

UPDATE client_industry
SET description = "Mining"
WHERE name = "Mining";

UPDATE client_industry
SET description = "Offshore"
WHERE name = "Offshore";




update profit_center set sales_office = 3 where id in (
610,
612,
613,
614,
616,
623,
625,
626,
627,
628,
629,
630,
631,
632,
633,
634,
681,
682,
705,
801,
802
)



update profit_center set sales_office = 2  where id in (
380,
600,
611,
616,
617,
615,
624,
700,
704,
805
)

ALTER TABLE quote
ADD sales_stage VARCHAR(255) AFTER profit_center,
ADD present_date DATE AFTER sales_stage,
ADD award_date DATE AFTER present_date,
ADD start_date DATE AFTER award_date

ALTER TABLE quote
ADD status VARCHAR(255) AFTER special_notes


update quote
set quote_number = replace(quote_number, 'HO0', 'CLN');

ALTER TABLE quote
  DROP COLUMN profit_centre;

ALTER TABLE customer_quoted DROP INDEX registration_number





ALTER TABLE quote
ADD COLUMN sales_district_sap VARCHAR(255) AFTER sales_district;

ALTER TABLE quote
ADD COLUMN sales_group VARCHAR(255) AFTER sales_district_sap;