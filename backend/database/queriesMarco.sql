CREATE TABLE customer_quoted (
        id INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        create_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        customerName VARCHAR(255) NOT NULL,
        registrationNumber VARCHAR(255) NOT NULL
      );

      SELECT * FROM customer_site WHERE customer_id = 1 AND name like "%" LIMIT 30;

      SELECT customer_id, count(*) FROM customer_site GROUP BY customer_id HAVING count(*) > 100



--Marco
CREATE TABLE attributes
(
   Id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
   Name varchar(255),
   Description varchar(255),
   Value real,
   Region int,
   SalesDistrict int,
   ValidFrom date,
   ValidTill date,
   CreateDate date
)
;



INSERT INTO ATTRIBUTES (Id,Name,Description,Value,Region,SalesDistrict,ValidFrom,ValidTill,CreateDate) VALUES (1,'uif','UIF Rate',1.0,null,null,{d '2022-01-25'},{d '3022-12-31'},{d '2022-01-25'});
INSERT INTO ATTRIBUTES (Id,Name,Description,Value,Region,SalesDistrict,ValidFrom,ValidTill,CreateDate) VALUES (5,'provFund','Provident fund percent',5.25,null,null,{d '2022-01-25'},{d '3022-12-31'},{d '2022-01-25'});
INSERT INTO ATTRIBUTES (Id,Name,Description,Value,Region,SalesDistrict,ValidFrom,ValidTill,CreateDate) VALUES (6,'provFund','Provident fund percent KZN',5.25,1,null,{d '2022-01-25'},{d '3022-12-31'},{d '2022-01-25'});
INSERT INTO ATTRIBUTES (Id,Name,Description,Value,Region,SalesDistrict,ValidFrom,ValidTill,CreateDate) VALUES (7,'trainingLevy','Training levy',1.0,null,null,{d '2022-01-25'},{d '3022-12-31'},{d '2022-01-25'});
INSERT INTO ATTRIBUTES (Id,Name,Description,Value,Region,SalesDistrict,ValidFrom,ValidTill,CreateDate) VALUES (8,'compComm','Comp Comm percent',0.51,null,null,{d '2022-01-25'},{d '3022-12-31'},{d '2022-01-25'});
INSERT INTO ATTRIBUTES (Id,Name,Description,Value,Region,SalesDistrict,ValidFrom,ValidTill,CreateDate) VALUES (9,'NS','Night shift percent',10.0,null,null,{d '2022-01-25'},{d '3022-12-31'},{d '2022-01-25'});
INSERT INTO ATTRIBUTES (Id,Name,Description,Value,Region,SalesDistrict,ValidFrom,ValidTill,CreateDate) VALUES (10,'commissionPercent','Commission Percent',9.091,null,null,{d '2022-02-11'},{d '3022-12-31'},{d '2022-02-11'});
INSERT INTO ATTRIBUTES (Id,Name,Description,Value,Region,SalesDistrict,ValidFrom,ValidTill,CreateDate) VALUES (11,'chemicalsPercent','Chemicals Percent',5.0,null,null,{d '2022-01-25'},{d '3022-12-31'},{d '2022-03-09'});
INSERT INTO ATTRIBUTES (Id,Name,Description,Value,Region,SalesDistrict,ValidFrom,ValidTill,CreateDate) VALUES (12,'materialsPercent','Materials Percent',5.0,null,null,{d '2022-01-25'},{d '3022-12-31'},{d '2022-03-09'});
INSERT INTO ATTRIBUTES (Id,Name,Description,Value,Region,SalesDistrict,ValidFrom,ValidTill,CreateDate) VALUES (13,'uniformPercent','Uniform Percent',1.8,null,null,{d '2022-01-25'},{d '3022-12-31'},{d '2022-03-09'});
INSERT INTO ATTRIBUTES (Id,Name,Description,Value,Region,SalesDistrict,ValidFrom,ValidTill,CreateDate) VALUES (14,'equipmentPercent','Equipment Percent',3.0,null,null,{d '2022-01-25'},{d '3022-12-31'},{d '2022-03-09'});
INSERT INTO ATTRIBUTES (Id,Name,Description,Value,Region,SalesDistrict,ValidFrom,ValidTill,CreateDate) VALUES (15,'overheadsRecovPercent','Overheads Recovery Percent',10.0,null,null,{d '2022-01-25'},{d '3022-12-31'},{d '2022-03-09'});
INSERT INTO ATTRIBUTES (Id,Name,Description,Value,Region,SalesDistrict,ValidFrom,ValidTill,CreateDate) VALUES (16,'minMarginPercent','Minimum Margin Percent',10.0,null,null,{d '2022-01-25'},{d '3022-12-31'},{d '2022-03-15'});
INSERT INTO ATTRIBUTES (Id,Name,Description,Value,Region,SalesDistrict,ValidFrom,ValidTill,CreateDate) VALUES (17,'maxMarginPercent','Maximum Margin Percent',50.0,null,null,{d '2022-01-25'},{d '3022-12-31'},{d '2022-03-15'});
INSERT INTO ATTRIBUTES (Id,Name,Description,Value,Region,SalesDistrict,ValidFrom,ValidTill,CreateDate) VALUES (18,'maxDiscountPercent','Maximum Discount Allowed',10.0,null,null,{d '2022-01-25'},{d '3022-12-31'},{d '2022-03-22'});
INSERT INTO ATTRIBUTES (Id,Name,Description,Value,Region,SalesDistrict,ValidFrom,ValidTill,CreateDate) VALUES (19,'maxHoursAllowedPerDay','Maximum Hours Allowed Per Worker Per Day',12.0,null,null,{d '2022-01-25'},{d '3022-12-31'},{d '2022-03-23'});
INSERT INTO ATTRIBUTES (Id,Name,Description,Value,Region,SalesDistrict,ValidFrom,ValidTill,CreateDate) VALUES (20,'commissionBreakdownLead','Percentage of commission allocated to Lead',10.0,null,null,{d '2022-01-25'},{d '3022-12-31'},{d '2022-03-23'});
INSERT INTO ATTRIBUTES (Id,Name,Description,Value,Region,SalesDistrict,ValidFrom,ValidTill,CreateDate) VALUES (21,'commissionBreakdownSurvey','Percentage of commission allocated to Survey / costing',30.0,null,null,{d '2022-01-25'},{d '3022-12-31'},{d '2022-03-23'});
INSERT INTO ATTRIBUTES (Id,Name,Description,Value,Region,SalesDistrict,ValidFrom,ValidTill,CreateDate) VALUES (22,'commissionBreakdownProposal','Percentage of commission allocated to Proposal / negotiation',30.0,null,null,{d '2022-01-25'},{d '3022-12-31'},{d '2022-03-23'});
INSERT INTO ATTRIBUTES (Id,Name,Description,Value,Region,SalesDistrict,ValidFrom,ValidTill,CreateDate) VALUES (23,'commissionBreakdownSigned','Percentage of commission allocated to Signed Contract',30.0,null,null,{d '2022-01-25'},{d '3022-12-31'},{d '2022-03-23'});


--Marco
CREATE TABLE rosters (
    Id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Name varchar(255),
    Description varchar(255),
    Roster text,
    CreateDate date
);

-- Marco
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



INSERT INTO REGION (Id,RegionName,Description,Address,PostalAddress,TelNum,Email,Website,CreateDate) VALUES (1,'KN01','KwaZulu Natal Region','30 The Boulevard, Westway Office Park, Westville','PO Box 74177, Rochdale Park, 3630','(031) 570-9600','info@supercare.co.za','www.supercare.co.za',{ts '2022-01-25 14:33:18'});
INSERT INTO REGION (Id,RegionName,Description,Address,PostalAddress,TelNum,Email,Website,CreateDate) VALUES (2,'NG01','Northern Gauteng Region','22 Milkyway Avenue, Linbro Business Park, Sandton','PO Box 11498, Queenswood 0121','(012) 333-2552','info@supercare.co.za','www.supercare.co.za',{ts '2022-02-02 10:50:30'});
INSERT INTO REGION (Id,RegionName,Description,Address,PostalAddress,TelNum,Email,Website,CreateDate) VALUES (3,'SG01','Southern Gauteng Region','22 Milkyway Avenue, Linbro Business Park, Sandton','PO Box 62145, Marshalltown 2107','(011) 709-8100','info@supercare.co.za','www.supercare.co.za',{ts '2022-02-02 10:50:35'});
INSERT INTO REGION (Id,RegionName,Description,Address,PostalAddress,TelNum,Email,Website,CreateDate) VALUES (4,'CAO1','Cape Region','High Street Village, 6 High Street, Bellville, 7530','Postnet Suite 3, Private Bag X22, Tygervallley, 7536','(021) 974-6500','info@supercare.co.za','www.supercare.co.za',{ts '2022-02-02 10:50:43'});
INSERT INTO REGION (Id,RegionName,Description,Address,PostalAddress,TelNum,Email,Website,CreateDate) VALUES (5,'IN01','NCIS','22 Milkyway Avenue, Linbro Business Park, Sandton','PO Box 62145, Marshalltown 2107','(011) 709-8100','info@empactgroup.co.za','www.empactgroup.co.za',{ts '2022-02-28 15:36:34'});
INSERT INTO REGION (Id,RegionName,Description,Address,PostalAddress,TelNum,Email,Website,CreateDate) VALUES (6,'NW01',null,null,null,null,'info@supercare.co.za','www.supercare.co.za',{ts '2022-02-28 15:40:27'});


-- Marco
INSERT INTO attributes (Name, Value, Region, ValidFrom, ValidTill, CreateDate) VALUES ('UIF', 1, null, NOW(), NOW() + 30, NOW());
INSERT INTO attributes (Name, Value, Region, ValidFrom, ValidTill, CreateDate) VALUES ('hourlyRateTemp', 23.87, null, NOW(), NOW() + 30, NOW());
INSERT INTO attr;ibutes (Name, Value, Region, ValidFrom, ValidTill, CreateDate) VALUES ('hourlyRateTemp', 23.87, null, CURDATE(), CURDATE() + 30, CURDATE());
INSERT INTO attributes (Name, Value, Region, ValidFrom, ValidTill, CreateDate) VALUES ('hourlyRateSuper', 50, null, CURDATE(), CURDATE() + 30, CURDATE());
INSERT INTO attributes (Name, Value, Region, ValidFrom, ValidTill, CreateDate) VALUES ('provFund', 5.25, null, '2022-01-25', '2022-01-25', '2022-01-25');
INSERT INTO attributes (Name, Value, Region, ValidFrom, ValidTill, CreateDate) VALUES ('provFund', 5.25, 1, '2022-01-25', '2022-01-25', '2022-01-25');
INSERT INTO attributes (Name, Value, Region, ValidFrom, ValidTill, CreateDate) VALUES ('trainingLevy', 1, null, '2022-01-25', '2022-01-25', '2022-01-25');
INSERT INTO attributes (Name, Value, Region, ValidFrom, ValidTill, CreateDate) VALUES ('compComm', 0.51, null, '2022-01-25', '2022-01-25', '2022-01-25');
INSERT INTO attributes (Name, Value, Region, ValidFrom, ValidTill, CreateDate) VALUES ('nightShift', 10, null, '2022-01-25', '2022-01-25', '2022-01-25');


-- Marco
CREATE TABLE role (
    Id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    RoleName varchar(255),
    CreateDate date
);



INSERT INTO ROLE (Id,RoleName,CreateDate) VALUES (1,'Permanent Cleaner',{d '2022-01-25'});
INSERT INTO ROLE (Id,RoleName,CreateDate) VALUES (2,'Temporary Cleaner',{d '2022-01-25'});
INSERT INTO ROLE (Id,RoleName,CreateDate) VALUES (3,'Supervisor',{d '2022-01-25'});


-- Marco
CREATE TABLE role_rate (
    Id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name varchar(255),
    rate float,
    role int NOT NULL,
    Region int,
    SalesDistrict int,
    valid_from date,
    valid_till date,
    create_date date,
    FOREIGN KEY (role) REFERENCES role(id)
);

INSERT INTO role_rate (Id,name,rate,role,Region,SalesDistrict,valid_from,valid_till,create_date) VALUES (1,'Default Cleaner Rate Permanent',23.27,1,null,null,{d '2022-01-25'},{d '2022-12-31'},{d '2022-01-25'});
INSERT INTO role_rate (Id,name,rate,role,Region,SalesDistrict,valid_from,valid_till,create_date) VALUES (2,'Default Cleaner Rate Temp',23.27,2,null,null,{d '2022-01-25'},{d '2022-12-31'},{d '2022-01-25'});
INSERT INTO role_rate (Id,name,rate,role,Region,SalesDistrict,valid_from,valid_till,create_date) VALUES (3,'Supervisor Rate',87.0,3,null,null,{d '2022-01-25'},{d '2022-12-31'},{d '2022-01-25'});
INSERT INTO role_rate (Id,name,rate,role,Region,SalesDistrict,valid_from,valid_till,create_date) VALUES (4,'Permanent Cleaner Rate Metro',25.85,1,null,1,{d '2022-01-25'},{d '2022-12-31'},{d '2022-03-28'});
INSERT INTO role_rate (Id,name,rate,role,Region,SalesDistrict,valid_from,valid_till,create_date) VALUES (5,'Temporary Cleaner Rate Metro',25.85,2,null,1,{d '2022-01-25'},{d '2022-12-31'},{d '2022-03-28'});
INSERT INTO role_rate (Id,name,rate,role,Region,SalesDistrict,valid_from,valid_till,create_date) VALUES (6,'Supervisor Rate Metro',25.85,3,null,1,{d '2022-01-25'},{d '2022-12-31'},{d '2022-03-28'});
INSERT INTO role_rate (Id,name,rate,role,Region,SalesDistrict,valid_from,valid_till,create_date) VALUES (8,'KZN Rate',25.58,1,1,null,{d '2022-01-25'},{d '2022-12-31'},{d '2022-04-11'});
INSERT INTO role_rate (Id,name,rate,role,Region,SalesDistrict,valid_from,valid_till,create_date) VALUES (9,'KZN Rate Temp',25.58,2,1,null,{d '2022-01-25'},{d '2022-12-31'},{d '2022-04-11'});





-- Marco
CREATE TABLE holidays (
    Id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name varchar(255),
    description varchar(255),
    holiday_date date,
    valid_from date,
    valid_till date,
    create_date date
);






-- Marco
INSERT INTO HOLIDAYS (Id,name,description,holiday_date,valid_from,valid_till,create_date) VALUES (1,'New Years Day','New Year’s Day',{d '2022-01-01'},{d '2022-01-25'},{d '2522-03-21'},{d '2022-01-25'});
INSERT INTO HOLIDAYS (Id,name,description,holiday_date,valid_from,valid_till,create_date) VALUES (2,'Human Rights Day','Human Rights Day',{d '2022-03-21'},{d '2022-01-25'},{d '2522-03-21'},{d '2022-01-25'});
INSERT INTO HOLIDAYS (Id,name,description,holiday_date,valid_from,valid_till,create_date) VALUES (3,'Good Friday','Good Friday *',{d '2022-04-02'},{d '2022-01-25'},{d '2522-03-21'},{d '2022-01-25'});
INSERT INTO HOLIDAYS (Id,name,description,holiday_date,valid_from,valid_till,create_date) VALUES (4,'Family Day','Family Day',{d '2022-04-05'},{d '2022-01-25'},{d '2522-03-21'},{d '2022-01-25'});
INSERT INTO HOLIDAYS (Id,name,description,holiday_date,valid_from,valid_till,create_date) VALUES (5,'Freedom Day','Freedom Day',{d '2022-04-27'},{d '2022-01-25'},{d '2522-03-21'},{d '2022-01-25'});
INSERT INTO HOLIDAYS (Id,name,description,holiday_date,valid_from,valid_till,create_date) VALUES (6,'Workers Day','Workers Day',{d '2022-05-01'},{d '2022-01-25'},{d '2522-03-21'},{d '2022-01-25'});
INSERT INTO HOLIDAYS (Id,name,description,holiday_date,valid_from,valid_till,create_date) VALUES (7,'Youth Day','Youth Day',{d '2022-06-16'},{d '2022-01-25'},{d '2522-03-21'},{d '2022-01-25'});
INSERT INTO HOLIDAYS (Id,name,description,holiday_date,valid_from,valid_till,create_date) VALUES (8,'National Womens Day','National Women’s Day',{d '2022-08-09'},{d '2022-01-25'},{d '2522-03-21'},{d '2022-01-25'});
INSERT INTO HOLIDAYS (Id,name,description,holiday_date,valid_from,valid_till,create_date) VALUES (9,'Heritage Day','Heritage Day',{d '2022-09-24'},{d '2022-01-25'},{d '2522-03-21'},{d '2022-01-25'});
INSERT INTO HOLIDAYS (Id,name,description,holiday_date,valid_from,valid_till,create_date) VALUES (11,'Day of Reconciliation','Day of Reconciliation',{d '2022-12-16'},{d '2022-01-25'},{d '2522-03-21'},{d '2022-01-25'});
INSERT INTO HOLIDAYS (Id,name,description,holiday_date,valid_from,valid_till,create_date) VALUES (12,'Christmas Day','Christmas Day',{d '2022-12-25'},{d '2022-01-25'},{d '2522-03-21'},{d '2022-01-25'});
INSERT INTO HOLIDAYS (Id,name,description,holiday_date,valid_from,valid_till,create_date) VALUES (13,'Day of Goodwill','Day of Goodwill',{d '2022-12-26'},{d '2022-01-25'},{d '2522-03-21'},{d '2022-01-25'});


-- Marco
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








CREATE TABLE quote (
    Id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    QuoteName varchar(255),
    CreateDate datetime
);


ALTER TABLE rosters
ADD quote_id int;


ALTER TABLE rosters
ADD FOREIGN KEY (quote_id) REFERENCES quote(Id);











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
ADD COLUMN sales_org INT AFTER special_notes;


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
ADD FOREIGN KEY (sales_district) REFERENCES sales_district(Id);

ALTER TABLE quote
ADD COLUMN client_order_date date AFTER client_order_no;

ALTER TABLE quote
ADD COLUMN valid_from date AFTER client_order_date;




CREATE TABLE profit_center
(
   Id int PRIMARY KEY NOT NULL,
   name varchar(255),
   description varchar(255),
   sales_office int,
   sales_org int,
   sales_division int,
   is_active bit,
   create_date date
)
;
ALTER TABLE profit_center
ADD CONSTRAINT profit_center_ibfk_3
FOREIGN KEY (sales_division)
REFERENCES sales_division(Id)
;
ALTER TABLE profit_center
ADD CONSTRAINT profit_center_ibfk_2
FOREIGN KEY (sales_org)
REFERENCES sales_org(Id)
;
ALTER TABLE profit_center
ADD CONSTRAINT profit_center_ibfk_1
FOREIGN KEY (sales_office)
REFERENCES region(Id)
;
CREATE INDEX sales_office ON profit_center(sales_office)
;
CREATE INDEX sales_org ON profit_center(sales_org)
;
CREATE INDEX sales_division ON profit_center(sales_division)
;







ALTER TABLE profit_center
ADD FOREIGN KEY (sales_office) REFERENCES region(Id);


ALTER TABLE profit_center
ADD COLUMN sales_org INT AFTER sales_office;



ALTER TABLE profit_center
ADD FOREIGN KEY (sales_org) REFERENCES sales_org(Id);




ALTER TABLE sales_division
ADD COLUMN sales_org INT AFTER description;




ALTER TABLE sales_division
ADD FOREIGN KEY (sales_org) REFERENCES sales_org(Id);



ALTER TABLE sales_division
ADD COLUMN is_active BIT AFTER sales_org;


ALTER TABLE profit_center
ADD COLUMN sales_division INT AFTER sales_org;




CREATE TABLE document_format (
    Id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    format_name varchar(255),
    create_date datetime
);


insert into document_format (format_name,create_date) values ('Word',now());
insert into document_format (format_name,create_date) values ('PDF',now());


CREATE TABLE template
(
   Id int PRIMARY KEY NOT NULL,
   template_name varchar(255),
   template varchar(255),
   template_directory varchar(255),
   template_description varchar(255),
   document_format int,
   created_date timestamp,
   upd_date timestamp,
   is_active bit
)
;
ALTER TABLE template
ADD CONSTRAINT template_ibfk_1
FOREIGN KEY (document_format)
REFERENCES document_format(Id)
;
CREATE INDEX document_format ON template(document_format)
;




ALTER TABLE template
ADD FOREIGN KEY (document_format) REFERENCES document_format(Id);



ALTER TABLE template
ADD COLUMN template_directory VARCHAR(255) AFTER template;


<<<<<<< HEAD




alter table customer_site_quoted 
ADD COLUMN upd_date TIMESTAMP AFTER fax_number;



alter table rosters 
add column isActive bit after quote_id


alter table rosters add column startDate date after name


alter table rosters add column service int after name


alter table rosters add column tabledata longtext after service

alter table rosters add column costSheet longtext after tabledata

alter table quote add column sales_exec_code varchar(255) after sales_district


alter table quote add column sales_exec_name varchar(255) after sales_exec_code


alter table quote add column sales_exec_name varchar(255) after sales_exec_name

alter table quote add column sales_exec_code varchar(255) after sales_exec_name


alter table quote add column area_manager_code varchar(255) after sales_exec_name

alter table quote add column area_manager_name varchar(255) after area_manager_code


alter table quote add column profit_center int after j_number
=======
INSERT INTO MENU (menu_id,name,relative_path,sequence,parent_menu_id) VALUES (78,'Configuration Portal','#{customerController.costingModel()}',2,76);
UPDATE menu // set relative_path to new iFrame

insert into role_menu (role_id,menu_id) values (9,78) 
insert into role_menu (role_id,menu_id) values (1,78) 
insert into role_menu (role_id,menu_id) values (1,77) 





CREATE TABLE sales_district
(
   Id int PRIMARY KEY NOT NULL,
   DistrictName varchar(255),
   CreateDate timestamp
)
;



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



INSERT INTO SALES_DISTRICT (Id,DistrictName,CreateDate) VALUES (1,'Metro',{ts '2022-03-28 13:52:40'});
INSERT INTO SALES_DISTRICT (Id,DistrictName,CreateDate) VALUES (2,'Rural',{ts '2022-03-28 13:52:55'});




CREATE TABLE roster_history
(
   Id int PRIMARY KEY NOT NULL,
   Name varchar(255),
   startDate date,
   service int,
   tabledata longtext,
   costSheet longtext,
   CreateDate date,
   roster_id int,
   isActive bit
)
;

ALTER TABLE roster_history
ADD CONSTRAINT roster_history_ibfk_1
FOREIGN KEY (roster_id)
REFERENCES rosters(Id)
;
CREATE INDEX roster_id ON roster_history(roster_id)
;


ALTER TABLE quote add
FOREIGN KEY (profit_center)
REFERENCES profit_center(Id)


CREATE TABLE service_type
(
   Id int PRIMARY KEY NOT NULL,
   Name varchar(255),
   Description varchar(255),
   CreateDate timestamp
)
;




alter table quote add column regional_manager_name varchar(255) after area_manager_code


INSERT INTO SERVICE_TYPE (Id,Name,Description,CreateDate) VALUES (3,'Additional staff','this will be when we quote for additional staff not working a full month and or long period of times.',{ts '2022-03-08 14:46:03'});
INSERT INTO SERVICE_TYPE (Id,Name,Description,CreateDate) VALUES (4,'Ablution Deep Cleaning','Service line',{ts '2022-03-08 14:51:08'});
INSERT INTO SERVICE_TYPE (Id,Name,Description,CreateDate) VALUES (5,'Pest Services','Service line',{ts '2022-03-08 14:51:08'});
INSERT INTO SERVICE_TYPE (Id,Name,Description,CreateDate) VALUES (6,'Hygiene Services','Service line',{ts '2022-03-08 14:51:08'});
INSERT INTO SERVICE_TYPE (Id,Name,Description,CreateDate) VALUES (7,'Carpet cleaning','',{ts '2022-03-08 14:51:08'});
INSERT INTO SERVICE_TYPE (Id,Name,Description,CreateDate) VALUES (8,'Window cleaning','this includes high level widow cleaning',{ts '2022-03-08 14:51:08'});
INSERT INTO SERVICE_TYPE (Id,Name,Description,CreateDate) VALUES (9,'High level cleaning','',{ts '2022-03-08 14:51:08'});
INSERT INTO SERVICE_TYPE (Id,Name,Description,CreateDate) VALUES (10,'Deep cleaning of ablutions','',{ts '2022-03-08 14:51:08'});
INSERT INTO SERVICE_TYPE (Id,Name,Description,CreateDate) VALUES (11,'Shut down cleaning','',{ts '2022-03-08 14:51:08'});
INSERT INTO SERVICE_TYPE (Id,Name,Description,CreateDate) VALUES (12,'Fogging','',{ts '2022-03-08 14:51:08'});
INSERT INTO SERVICE_TYPE (Id,Name,Description,CreateDate) VALUES (13,'Strip and seal','',{ts '2022-03-08 14:51:08'});
INSERT INTO SERVICE_TYPE (Id,Name,Description,CreateDate) VALUES (14,'Pre occupational clean','',{ts '2022-03-08 14:51:08'});
INSERT INTO SERVICE_TYPE (Id,Name,Description,CreateDate) VALUES (15,'Specialized floor cleaning','other than strip and seal',{ts '2022-03-08 14:51:08'});
INSERT INTO SERVICE_TYPE (Id,Name,Description,CreateDate) VALUES (16,'Floor restoration','',{ts '2022-03-08 14:51:08'});
INSERT INTO SERVICE_TYPE (Id,Name,Description,CreateDate) VALUES (17,'Allowances','',{ts '2022-03-08 14:51:08'});
INSERT INTO SERVICE_TYPE (Id,Name,Description,CreateDate) VALUES (18,'Loan equipment','Walk behind & Ride on',{ts '2022-03-08 14:51:08'});
INSERT INTO SERVICE_TYPE (Id,Name,Description,CreateDate) VALUES (19,'Loose equipment & Materials','',{ts '2022-03-08 14:51:08'});
INSERT INTO SERVICE_TYPE (Id,Name,Description,CreateDate) VALUES (20,'Escalator cleaning','',{ts '2022-03-08 14:51:08'});
INSERT INTO SERVICE_TYPE (Id,Name,Description,CreateDate) VALUES (21,'Basement / Parking cleaning','',{ts '2022-03-08 14:51:08'});
INSERT INTO SERVICE_TYPE (Id,Name,Description,CreateDate) VALUES (22,'Hospitality -special events','',{ts '2022-03-08 14:51:08'});
INSERT INTO SERVICE_TYPE (Id,Name,Description,CreateDate) VALUES (23,'Upholstery Cleaning',null,{ts '2022-03-08 14:51:09'});
INSERT INTO SERVICE_TYPE (Id,Name,Description,CreateDate) VALUES (25,'Other',null,{ts '2022-03-08 14:51:09'});




INSERT INTO sales_division (Id,name,description,sales_org,is_active,create_date) VALUES (1,'CL','Cleaning',1,true,{d '2022-02-02'});
INSERT INTO sales_division (Id,name,description,sales_org,is_active,create_date) VALUES (2,'LB','Labour',1,false,{d '2022-02-02'});
INSERT INTO sales_division (Id,name,description,sales_org,is_active,create_date) VALUES (3,'SS','Special',1,false,{d '2022-02-02'});
INSERT INTO sales_division (Id,name,description,sales_org,is_active,create_date) VALUES (5,'HY','Hygiene',3,true,{d '2022-04-08'});
INSERT INTO sales_division (Id,name,description,sales_org,is_active,create_date) VALUES (6,'PS','Pest Control',3,true,{d '2022-04-08'});
INSERT INTO sales_division (Id,name,description,sales_org,is_active,create_date) VALUES (7,'DC','Deep Cleaning',3,true,{d '2022-04-08'});



INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (100,'OT_AD_ADMNG','OT_AD_ADMNG',2,3,null,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (101,'OT_AD_ADMBFN','OT_AD_ADMBFN',2,3,null,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (102,'OT_HY_BFN01','OT_HY_BFN01',2,3,5,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (103,'OT_AD_ADMLEP','OT_AD_ADMLEP',2,3,null,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (104,'OT_HY_LEP01','OT_HY_LEP01',2,3,5,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (105,'OT_AD_ADMPOL','OT_AD_ADMPOL',2,3,null,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (106,'OT_HY_POL02','OT_HY_POL02',2,3,5,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (107,'OT_AD_ADMNLP','OT_AD_ADMNLP',2,3,null,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (108,'OT_HY_BRT01','OT_HY_BRT01',2,3,5,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (109,'OT_AD_ADMSEC','OT_AD_ADMSEC',2,3,null,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (110,'OT_HY_SEC01','OT_HY_SEC01',2,3,5,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (111,'OT_RC_SEC01','OT_RC_SEC01',2,3,null,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (112,'OT_MN_SEC01','OT_MN_SEC01',2,3,null,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (113,'OT_RC_BFN01','OT_RC_BFN01',2,3,null,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (114,'OT_MN_BFN01','OT_MN_BFN01',2,3,null,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (115,'OT_AD_ADMBRT','OT_AD_ADMBRT',2,3,null,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (116,'OT_RC_BRT01','OT_RC_BRT01',2,3,null,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (117,'OT_MN_BRT01','OT_MN_BRT01',2,3,null,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (118,'OT_MN_LEP01','OT_MN_LEP01',2,3,null,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (119,'OT_PS_BRT01','OT_PS_BRT01',2,3,3,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (120,'CN_AD_ADMSG','CN_AD_ADMSG',3,3,null,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (121,'CN_HY_LPK01','CN_HY_LPK01',3,3,5,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (122,'CN_DC_LPK01','CN_DC_LPK01',3,3,7,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (131,'CN_AD_ADMLPK','CN_AD_ADMLPK',3,3,null,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (132,'CN_RC_LPK01','CN_RC_LPK01',3,3,null,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (139,'CN_MN_LPK01','CN_MN_LPK01',3,3,null,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (140,'KZ_AD_ADMKZN','KZ_AD_ADMKZN',1,3,null,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (141,'KZ_HY_DBN01','KZ_HY_DBN01',1,3,5,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (144,'KZ_AD_ADMDBN','KZ_AD_ADMDBN',1,3,null,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (145,'KZ_RC_DBN01','KZ_RC_DBN01',1,3,null,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (149,'KZ_HY_RBY01','KZ_HY_RBY01',1,3,5,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (150,'KZ_PS_RBY01','KZ_PS_RBY01',1,3,3,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (151,'KZ_AD_ADMRBY','KZ_AD_ADMRBY',1,3,null,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (159,'KZ_MN_DBN01','KZ_MN_DBN01',1,3,null,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (160,'CA_AD_ADMWCP','CA_AD_ADMWCP',4,3,null,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (161,'CA_HY_CTN01','CA_HY_CTN01',4,3,5,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (165,'CA_AD_ADMCTN','CA_AD_ADMCTN',4,3,null,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (166,'CA_AD_ADMELS','CA_AD_ADMELS',4,3,null,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (167,'CA_AD_ ADMGEO','CA_AD_ ADMGEO',4,3,null,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (168,'CA_AD_ADMPLZ','CA_AD_ADMPLZ',4,3,null,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (169,'CA_RC_CTN01','CA_RC_CTN01',4,3,null,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (170,'CA_HY_GEO01','CA_HY_GEO01',4,3,5,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (171,'CA_HY_PLZ01','CA_HY_PLZ01',4,3,5,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (172,'CA_HY_ELS01','CA_HY_ELS01',4,3,5,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (173,'CA_RC_ELS01','CA_RC_ELS01',4,3,null,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (174,'CA_RC_GEO01','CA_RC_GEO01',4,3,null,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (175,'CA_RC_PLZ01','CA_RC_PLZ01',4,3,null,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (176,'CA_MN_ELS01','CA_MN_ELS01',4,3,null,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (177,'CA_MN_GEO01','CA_MN_GEO01',4,3,null,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (178,'CA_MN_PLZ01','CA_MN_PLZ01',4,3,null,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (179,'CA_MN_CTN01','CA_MN_CTN01',4,3,null,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (180,'NC_HY_NTC01','NC_HY_NTC01',5,3,5,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (182,'NC_RC_NTC01','NC_RC_NTC01',5,3,null,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (183,'NC_PS_NTC01','NC_PS_NTC01',5,3,3,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (186,'NC_DC_NTC01','NC_DC_NTC01',5,3,7,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (188,'NC_AD_ADMNTC','NC_AD_ADMNTC',5,3,null,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (189,'NC_MN_NTC01','NC_MN_NTC01',5,3,null,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (190,'OT_AD_AMDBLT','OT_AD_AMDBLT',2,3,null,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (191,'OT_HY_AMDBLT','OT_HY_AMDBLT',2,3,null,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (192,'OT_PS_AMDBLT','OT_PS_AMDBLT',2,3,null,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (193,'OT_DC_AMDBLT','OT_DC_AMDBLT',2,3,null,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (194,'OT_RC_AMDBLT','OT_RC_AMDBLT',2,3,null,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (195,'OT_MN_AMDBLT','OT_MN_AMDBLT',2,3,null,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (220,'KZN Training','KZN Training',1,1,1,true,{d '2022-02-03'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (235,'EC Training','EC Training',4,1,1,true,{d '2022-02-03'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (320,'OT_PS_BFN01','OT_PS_BFN01',2,3,3,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (321,'OT_PS_LEP01','OT_PS_LEP01',2,3,3,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (322,'OT_PS_POL01','OT_PS_POL01',2,3,3,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (323,'OT_PS_NLP01','OT_PS_NLP01',2,3,3,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (325,'OT_PS_SEC01','OT_PS_SEC01',2,3,3,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (327,'OT_RC_POL01','OT_RC_POL01',2,3,null,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (329,'OT_MN_POL01','OT_MN_POL01',2,3,null,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (330,'OT_DC_BFN01','OT_DC_BFN01',2,3,7,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (331,'OT_DC_LEP01','OT_DC_LEP01',2,3,7,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (332,'OT_DC_POL01','OT_DC_POL01',2,3,7,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (333,'OT_DC_NLP01','OT_DC_NLP01',2,3,7,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (334,'OT_DC_BRT01','OT_DC_BRT01',2,3,7,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (335,'OT_DC_SEC01','OT_DC_SEC01',2,3,7,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (336,'OT_RC_LEP01','OT_RC_LEP01',2,3,null,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (337,'OT_HY_NLP01','OT_HY_NLP01',2,3,5,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (338,'OT_RC_NLP01','OT_RC_NLP01',2,3,null,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (339,'OT_MN_NLP01','OT_MN_NLP01',2,3,null,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (340,'CN_PS_LPK01','CN_PS_LPK01',3,3,3,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (350,'KZ_PS_DBN01','KZ_PS_DBN01',1,3,3,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (352,'KZ_DC_RBY01','KZ_DC_RBY01',1,3,7,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (353,'KZ_RC_RBY01','KZ_RC_RBY01',1,3,null,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (354,'KZ_MN_RBY01','KZ_MN_RBY01',1,3,null,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (360,'CA_PS_CTN01','CA_PS_CTN01',4,3,3,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (361,'CA_PS_PLZ01','CA_PS_PLZ01',4,3,3,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (362,'CA_PS_ELS01','CA_PS_ELS01',4,3,3,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (363,'CA_PS_GEO01','CA_PS_GEO01',4,3,3,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (376,'CA_DC_CTN01','CA_DC_CTN01',4,3,7,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (377,'CA_DC_PLZ01','CA_DC_PLZ01',4,3,7,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (378,'CA_DC_ELS01','CA_DC_ELS01',4,3,7,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (379,'CA_DC_GEO01','CA_DC_GEO01',4,3,7,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (380,'NG Hygiene','NG Hygiene',2,1,1,true,{d '2022-02-03'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (384,'Kzn Hygiene','Kzn Hygiene',1,1,1,true,{d '2022-02-03'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (385,null,null,4,1,1,true,{d '2022-04-06'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (386,'WC Hygiene','WC Hygiene',4,1,1,true,{d '2022-02-03'});
INSERT INTO profit_center (Id,name,description,sales_office,sales_org,sales_division,is_active,create_date) VALUES (390,'KZ_DC_DBN01','KZ_DC_DBN01',1,3,7,true,{d '2022-04-06'});




INSERT INTO template (Id,template_name,template,template_directory,template_description,document_format,created_date,upd_date,is_active) VALUES (1,'Quote','quote.docx','https://qa.supercarehygiene.co.za/crgHooks/SupercareCostingModel/backend/docs/','Quote',2,{ts '2022-04-12 08:43:26'},{ts '2022-04-12 08:43:26'},true);
INSERT INTO template (Id,template_name,template,template_directory,template_description,document_format,created_date,upd_date,is_active) VALUES (2,'Acceptance Form','acceptanceForm.docx','https://qa.supercarehygiene.co.za/crgHooks/SupercareCostingModel/backend/docs/','Acceptance Form',2,{ts '2022-04-12 08:44:35'},{ts '2022-04-12 08:44:35'},true);
INSERT INTO template (Id,template_name,template,template_directory,template_description,document_format,created_date,upd_date,is_active) VALUES (3,'J-Form','jForm.docx','https://qa.supercarehygiene.co.za/crgHooks/SupercareCostingModel/backend/docs/','J-Form',2,{ts '2022-04-12 08:45:02'},{ts '2022-04-12 08:45:02'},true);
INSERT INTO template (Id,template_name,template,template_directory,template_description,document_format,created_date,upd_date,is_active) VALUES (4,'Job Card','jobCard.docx','https://qa.supercarehygiene.co.za/crgHooks/SupercareCostingModel/backend/docs/','Job Card',1,{ts '2022-04-12 08:49:03'},{ts '2022-04-12 08:49:03'},true);
INSERT INTO template (Id,template_name,template,template_directory,template_description,document_format,created_date,upd_date,is_active) VALUES (5,'Commission Claim','commissionClaim.docx','https://qa.supercarehygiene.co.za/crgHooks/SupercareCostingModel/backend/docs/','Commission Claim',2,{ts '2022-04-12 08:49:35'},{ts '2022-04-12 08:49:35'},true);


ALTER TABLE quote
ADD sales_stage VARCHAR(255) AFTER profit_center,
ADD present_date DATE AFTER sales_stage,
ADD award_date DATE AFTER present_date,
ADD start_date DATE AFTER award_date


ALTER TABLE quote
ADD status VARCHAR(255) AFTER special_notes


ALTER TABLE quote
ADD total_contract_price double AFTER status




ALTER TABLE rosters
ADD COLUMN service_price double AFTER costSheet;


ALTER TABLE rosters
ADD COLUMN service_markup double AFTER service_price;






--Marco
CREATE TABLE executive_summary
(
    Id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    quote int,
    FOREIGN KEY (quote) REFERENCES quote(id),
    labour real,
    overtime real,
    public_holidays real,
    supervision real,
    equipment real,
    equipment_repairs real,
    transport real,
    chemicals real,
    loose_equipment real,
    uniforms real,
    consumables real,
    sub_cont_int real,
    sub_cont_ext real,
    other_cont real,
    overheads real,
    management_fee real
)
;




Create table TVBVK (
MANDT varchar(6),
VKBUR varchar(8),
VKGRP varchar(6),
createdate datetime not null DEFAULT NOW(),
upddate datetime not null DEFAULT NOW()
)

ALTER TABLE TVBVK
ADD COLUMN UPDFLAG INT AFTER upddate;


Create table T171T (
MANDT varchar(6),
SPRAS varchar(2),
BZIRK varchar(12),
BZTXT varchar(40),
createdate datetime not null DEFAULT NOW(),
upddate datetime not null DEFAULT NOW()
)



ALTER TABLE T171T
ADD COLUMN UPDFLAG INT AFTER upddate;






INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','CA01','C01',{ts '2022-05-20 14:40:26'},{ts '2022-05-20 14:40:26'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','CA01','C02',{ts '2022-05-20 14:40:26'},{ts '2022-05-20 14:40:26'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','CA01','C03',{ts '2022-05-20 14:40:26'},{ts '2022-05-20 14:40:26'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','CA01','C04',{ts '2022-05-20 14:40:27'},{ts '2022-05-20 14:40:27'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','CA01','C05',{ts '2022-05-20 14:40:27'},{ts '2022-05-20 14:40:27'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','CA01','C06',{ts '2022-05-20 14:40:27'},{ts '2022-05-20 14:40:27'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','CA01','C07',{ts '2022-05-20 14:40:27'},{ts '2022-05-20 14:40:27'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','CA01','C08',{ts '2022-05-20 14:40:27'},{ts '2022-05-20 14:40:27'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','CA01','C09',{ts '2022-05-20 14:40:27'},{ts '2022-05-20 14:40:27'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','CA01','C10',{ts '2022-05-20 14:40:27'},{ts '2022-05-20 14:40:27'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','CA01','C11',{ts '2022-05-20 14:40:27'},{ts '2022-05-20 14:40:27'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','CA01','C12',{ts '2022-05-20 14:40:27'},{ts '2022-05-20 14:40:27'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','CA01','C13',{ts '2022-05-20 14:40:27'},{ts '2022-05-20 14:40:27'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','CA01','C14',{ts '2022-05-20 14:40:27'},{ts '2022-05-20 14:40:27'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','CA01','C15',{ts '2022-05-20 14:40:27'},{ts '2022-05-20 14:40:27'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','CA01','C16',{ts '2022-05-20 14:40:27'},{ts '2022-05-20 14:40:27'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','CA01','C17',{ts '2022-05-20 14:40:27'},{ts '2022-05-20 14:40:27'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','CA01','C18',{ts '2022-05-20 14:40:27'},{ts '2022-05-20 14:40:27'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','CA01','C19',{ts '2022-05-20 14:40:27'},{ts '2022-05-20 14:40:27'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','CA01','C20',{ts '2022-05-20 14:40:27'},{ts '2022-05-20 14:40:27'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','CA01','C21',{ts '2022-05-20 14:40:27'},{ts '2022-05-20 14:40:27'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','CA01','C22',{ts '2022-05-20 14:40:27'},{ts '2022-05-20 14:40:27'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','CA01','C23',{ts '2022-05-20 14:40:27'},{ts '2022-05-20 14:40:27'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','CA01','C24',{ts '2022-05-20 14:40:27'},{ts '2022-05-20 14:40:27'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','CA01','C25',{ts '2022-05-20 14:40:27'},{ts '2022-05-20 14:40:27'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','CA01','C28',{ts '2022-05-20 14:40:27'},{ts '2022-05-20 14:40:27'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','CA01','C29',{ts '2022-05-20 14:40:27'},{ts '2022-05-20 14:40:27'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','CA01','C30',{ts '2022-05-20 14:40:27'},{ts '2022-05-20 14:40:27'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','CA01','C31',{ts '2022-05-20 14:40:27'},{ts '2022-05-20 14:40:27'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','CA01','C32',{ts '2022-05-20 14:40:27'},{ts '2022-05-20 14:40:27'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','CA01','C33',{ts '2022-05-20 14:40:27'},{ts '2022-05-20 14:40:27'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','CA01','C34',{ts '2022-05-20 14:40:27'},{ts '2022-05-20 14:40:27'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','CA01','C35',{ts '2022-05-20 14:40:27'},{ts '2022-05-20 14:40:27'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','CA01','C36',{ts '2022-05-20 14:40:27'},{ts '2022-05-20 14:40:27'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','CA01','C38',{ts '2022-05-20 14:40:27'},{ts '2022-05-20 14:40:27'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','CA01','C40',{ts '2022-05-20 14:40:27'},{ts '2022-05-20 14:40:27'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','CA01','C41',{ts '2022-05-20 14:40:27'},{ts '2022-05-20 14:40:27'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','CA01','C42',{ts '2022-05-20 14:40:27'},{ts '2022-05-20 14:40:27'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','CA01','C43',{ts '2022-05-20 14:40:27'},{ts '2022-05-20 14:40:27'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','CA01','C44',{ts '2022-05-20 14:40:27'},{ts '2022-05-20 14:40:27'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','CA01','C45',{ts '2022-05-20 14:40:27'},{ts '2022-05-20 14:40:27'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','CA01','C46',{ts '2022-05-20 14:40:27'},{ts '2022-05-20 14:40:27'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','CA01','C47',{ts '2022-05-20 14:40:27'},{ts '2022-05-20 14:40:27'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','CA01','C48',{ts '2022-05-20 14:40:27'},{ts '2022-05-20 14:40:27'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','CA01','C49',{ts '2022-05-20 14:40:27'},{ts '2022-05-20 14:40:27'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','CA01','C50',{ts '2022-05-20 14:40:27'},{ts '2022-05-20 14:40:27'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','CA01','C51',{ts '2022-05-20 14:40:27'},{ts '2022-05-20 14:40:27'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','CA01','C52',{ts '2022-05-20 14:40:27'},{ts '2022-05-20 14:40:27'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','CA01','C53',{ts '2022-05-20 14:40:27'},{ts '2022-05-20 14:40:27'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','CA01','C54',{ts '2022-05-20 14:40:27'},{ts '2022-05-20 14:40:27'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','CA01','C55',{ts '2022-05-20 14:40:27'},{ts '2022-05-20 14:40:27'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','CA01','C56',{ts '2022-05-20 14:40:27'},{ts '2022-05-20 14:40:27'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','CA01','C57',{ts '2022-05-20 14:40:27'},{ts '2022-05-20 14:40:27'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','CA01','C58',{ts '2022-05-20 14:40:27'},{ts '2022-05-20 14:40:27'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','CA01','C59',{ts '2022-05-20 14:40:27'},{ts '2022-05-20 14:40:27'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','CA01','C60',{ts '2022-05-20 14:40:27'},{ts '2022-05-20 14:40:27'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','CA01','C61',{ts '2022-05-20 14:40:27'},{ts '2022-05-20 14:40:27'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','CA01','C62',{ts '2022-05-20 14:40:27'},{ts '2022-05-20 14:40:27'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','CA01','C63',{ts '2022-05-20 14:40:27'},{ts '2022-05-20 14:40:27'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','CA01','CS1',{ts '2022-05-20 14:40:27'},{ts '2022-05-20 14:40:27'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','CA01','F01',{ts '2022-05-20 14:40:27'},{ts '2022-05-20 14:40:27'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','EC01','CS1',{ts '2022-05-20 14:40:27'},{ts '2022-05-20 14:40:27'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','HO01','CS1',{ts '2022-05-20 14:40:27'},{ts '2022-05-20 14:40:27'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','HO01','F01',{ts '2022-05-20 14:40:27'},{ts '2022-05-20 14:40:27'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','HO01','H01',{ts '2022-05-20 14:40:27'},{ts '2022-05-20 14:40:27'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','IN01','CS1',{ts '2022-05-20 14:40:27'},{ts '2022-05-20 14:40:27'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','IN01','CS2',{ts '2022-05-20 14:40:27'},{ts '2022-05-20 14:40:27'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','IN01','I01',{ts '2022-05-20 14:40:27'},{ts '2022-05-20 14:40:27'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','IN01','I02',{ts '2022-05-20 14:40:28'},{ts '2022-05-20 14:40:28'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','IN01','I03',{ts '2022-05-20 14:40:28'},{ts '2022-05-20 14:40:28'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','IN01','I04',{ts '2022-05-20 14:40:28'},{ts '2022-05-20 14:40:28'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','IN01','I05',{ts '2022-05-20 14:40:28'},{ts '2022-05-20 14:40:28'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','IN01','I06',{ts '2022-05-20 14:40:28'},{ts '2022-05-20 14:40:28'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','IN01','I07',{ts '2022-05-20 14:40:28'},{ts '2022-05-20 14:40:28'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','IN01','I08',{ts '2022-05-20 14:40:28'},{ts '2022-05-20 14:40:28'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','IN01','I09',{ts '2022-05-20 14:40:28'},{ts '2022-05-20 14:40:28'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','IN01','I10',{ts '2022-05-20 14:40:28'},{ts '2022-05-20 14:40:28'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','IN01','I11',{ts '2022-05-20 14:40:28'},{ts '2022-05-20 14:40:28'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','IN01','I12',{ts '2022-05-20 14:40:28'},{ts '2022-05-20 14:40:28'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','IN01','I13',{ts '2022-05-20 14:40:28'},{ts '2022-05-20 14:40:28'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','IN01','I14',{ts '2022-05-20 14:40:28'},{ts '2022-05-20 14:40:28'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','IN01','I15',{ts '2022-05-20 14:40:28'},{ts '2022-05-20 14:40:28'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','IN01','I16',{ts '2022-05-20 14:40:28'},{ts '2022-05-20 14:40:28'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','IN01','I17',{ts '2022-05-20 14:40:28'},{ts '2022-05-20 14:40:28'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','IN01','I18',{ts '2022-05-20 14:40:28'},{ts '2022-05-20 14:40:28'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','IN01','I19',{ts '2022-05-20 14:40:28'},{ts '2022-05-20 14:40:28'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','IN01','I20',{ts '2022-05-20 14:40:28'},{ts '2022-05-20 14:40:28'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','IN01','I21',{ts '2022-05-20 14:40:28'},{ts '2022-05-20 14:40:28'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','IN01','I22',{ts '2022-05-20 14:40:28'},{ts '2022-05-20 14:40:28'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','IN01','I23',{ts '2022-05-20 14:40:28'},{ts '2022-05-20 14:40:28'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','IN01','I24',{ts '2022-05-20 14:40:28'},{ts '2022-05-20 14:40:28'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','IN01','I25',{ts '2022-05-20 14:40:28'},{ts '2022-05-20 14:40:28'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','IN01','I26',{ts '2022-05-20 14:40:28'},{ts '2022-05-20 14:40:28'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','IN01','I27',{ts '2022-05-20 14:40:28'},{ts '2022-05-20 14:40:28'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','IN01','I28',{ts '2022-05-20 14:40:28'},{ts '2022-05-20 14:40:28'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','IN01','I29',{ts '2022-05-20 14:40:28'},{ts '2022-05-20 14:40:28'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','IN01','I30',{ts '2022-05-20 14:40:28'},{ts '2022-05-20 14:40:28'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','KN01','CS1',{ts '2022-05-20 14:40:28'},{ts '2022-05-20 14:40:28'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','KN01','F01',{ts '2022-05-20 14:40:28'},{ts '2022-05-20 14:40:28'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','KN01','K01',{ts '2022-05-20 14:40:28'},{ts '2022-05-20 14:40:28'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','KN01','K02',{ts '2022-05-20 14:40:28'},{ts '2022-05-20 14:40:28'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','KN01','K03',{ts '2022-05-20 14:40:28'},{ts '2022-05-20 14:40:28'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','KN01','K04',{ts '2022-05-20 14:40:28'},{ts '2022-05-20 14:40:28'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','KN01','K05',{ts '2022-05-20 14:40:28'},{ts '2022-05-20 14:40:28'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','KN01','K06',{ts '2022-05-20 14:40:28'},{ts '2022-05-20 14:40:28'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','KN01','K07',{ts '2022-05-20 14:40:28'},{ts '2022-05-20 14:40:28'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','KN01','K08',{ts '2022-05-20 14:40:28'},{ts '2022-05-20 14:40:28'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','KN01','K09',{ts '2022-05-20 14:40:28'},{ts '2022-05-20 14:40:28'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','KN01','K10',{ts '2022-05-20 14:40:28'},{ts '2022-05-20 14:40:28'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','KN01','K11',{ts '2022-05-20 14:40:28'},{ts '2022-05-20 14:40:28'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','KN01','K12',{ts '2022-05-20 14:40:28'},{ts '2022-05-20 14:40:28'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','KN01','K13',{ts '2022-05-20 14:40:28'},{ts '2022-05-20 14:40:28'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','KN01','K14',{ts '2022-05-20 14:40:28'},{ts '2022-05-20 14:40:28'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','KN01','K15',{ts '2022-05-20 14:40:28'},{ts '2022-05-20 14:40:28'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','KN01','K16',{ts '2022-05-20 14:40:28'},{ts '2022-05-20 14:40:28'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','KN01','K17',{ts '2022-05-20 14:40:28'},{ts '2022-05-20 14:40:28'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','KN01','K18',{ts '2022-05-20 14:40:28'},{ts '2022-05-20 14:40:28'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','KN01','K19',{ts '2022-05-20 14:40:28'},{ts '2022-05-20 14:40:28'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','KN01','K20',{ts '2022-05-20 14:40:28'},{ts '2022-05-20 14:40:28'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','KN01','K21',{ts '2022-05-20 14:40:28'},{ts '2022-05-20 14:40:28'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','KN01','K22',{ts '2022-05-20 14:40:28'},{ts '2022-05-20 14:40:28'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','KN01','K23',{ts '2022-05-20 14:40:28'},{ts '2022-05-20 14:40:28'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','KN01','K24',{ts '2022-05-20 14:40:28'},{ts '2022-05-20 14:40:28'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','KN01','K25',{ts '2022-05-20 14:40:28'},{ts '2022-05-20 14:40:28'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','KN01','K26',{ts '2022-05-20 14:40:28'},{ts '2022-05-20 14:40:28'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','KN01','K27',{ts '2022-05-20 14:40:28'},{ts '2022-05-20 14:40:28'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','KN01','K28',{ts '2022-05-20 14:40:28'},{ts '2022-05-20 14:40:28'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','KN01','K29',{ts '2022-05-20 14:40:28'},{ts '2022-05-20 14:40:28'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','KN01','K30',{ts '2022-05-20 14:40:28'},{ts '2022-05-20 14:40:28'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','KN01','K36',{ts '2022-05-20 14:40:28'},{ts '2022-05-20 14:40:28'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','KN01','K38',{ts '2022-05-20 14:40:28'},{ts '2022-05-20 14:40:28'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','KN01','K47',{ts '2022-05-20 14:40:28'},{ts '2022-05-20 14:40:28'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','KN01','K48',{ts '2022-05-20 14:40:28'},{ts '2022-05-20 14:40:28'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','KN01','K49',{ts '2022-05-20 14:40:28'},{ts '2022-05-20 14:40:28'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','KN01','K50',{ts '2022-05-20 14:40:28'},{ts '2022-05-20 14:40:28'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','KN01','K51',{ts '2022-05-20 14:40:29'},{ts '2022-05-20 14:40:29'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','KN01','K52',{ts '2022-05-20 14:40:29'},{ts '2022-05-20 14:40:29'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','KN01','K53',{ts '2022-05-20 14:40:29'},{ts '2022-05-20 14:40:29'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','KN01','K54',{ts '2022-05-20 14:40:29'},{ts '2022-05-20 14:40:29'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','KN01','K55',{ts '2022-05-20 14:40:29'},{ts '2022-05-20 14:40:29'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','KN01','K56',{ts '2022-05-20 14:40:29'},{ts '2022-05-20 14:40:29'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','KN01','K57',{ts '2022-05-20 14:40:29'},{ts '2022-05-20 14:40:29'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','KN01','K58',{ts '2022-05-20 14:40:29'},{ts '2022-05-20 14:40:29'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','KN01','K59',{ts '2022-05-20 14:40:29'},{ts '2022-05-20 14:40:29'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','KN01','K60',{ts '2022-05-20 14:40:29'},{ts '2022-05-20 14:40:29'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','KN01','K61',{ts '2022-05-20 14:40:29'},{ts '2022-05-20 14:40:29'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','KN01','K62',{ts '2022-05-20 14:40:29'},{ts '2022-05-20 14:40:29'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','KN01','K63',{ts '2022-05-20 14:40:29'},{ts '2022-05-20 14:40:29'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','KN01','K64',{ts '2022-05-20 14:40:29'},{ts '2022-05-20 14:40:29'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','KN01','K65',{ts '2022-05-20 14:40:29'},{ts '2022-05-20 14:40:29'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','KN01','K66',{ts '2022-05-20 14:40:29'},{ts '2022-05-20 14:40:29'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','KN01','K67',{ts '2022-05-20 14:40:29'},{ts '2022-05-20 14:40:29'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','KN01','K68',{ts '2022-05-20 14:40:29'},{ts '2022-05-20 14:40:29'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','KN01','K69',{ts '2022-05-20 14:40:29'},{ts '2022-05-20 14:40:29'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','KN01','K70',{ts '2022-05-20 14:40:29'},{ts '2022-05-20 14:40:29'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','KN01','K71',{ts '2022-05-20 14:40:29'},{ts '2022-05-20 14:40:29'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','KN01','K72',{ts '2022-05-20 14:40:29'},{ts '2022-05-20 14:40:29'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','KN01','K73',{ts '2022-05-20 14:40:29'},{ts '2022-05-20 14:40:29'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','KN01','K74',{ts '2022-05-20 14:40:29'},{ts '2022-05-20 14:40:29'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','KN01','K75',{ts '2022-05-20 14:40:29'},{ts '2022-05-20 14:40:29'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','KN01','K76',{ts '2022-05-20 14:40:29'},{ts '2022-05-20 14:40:29'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','KN01','K77',{ts '2022-05-20 14:40:29'},{ts '2022-05-20 14:40:29'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','KN01','K78',{ts '2022-05-20 14:40:29'},{ts '2022-05-20 14:40:29'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','KN01','K79',{ts '2022-05-20 14:40:29'},{ts '2022-05-20 14:40:29'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','KN01','K80',{ts '2022-05-20 14:40:29'},{ts '2022-05-20 14:40:29'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','KN01','K81',{ts '2022-05-20 14:40:29'},{ts '2022-05-20 14:40:29'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','KN01','K82',{ts '2022-05-20 14:40:29'},{ts '2022-05-20 14:40:29'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','KN01','K83',{ts '2022-05-20 14:40:29'},{ts '2022-05-20 14:40:29'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','KN01','K84',{ts '2022-05-20 14:40:29'},{ts '2022-05-20 14:40:29'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','LS01','CS1',{ts '2022-05-20 14:40:29'},{ts '2022-05-20 14:40:29'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','NA01','CS1',{ts '2022-05-20 14:40:29'},{ts '2022-05-20 14:40:29'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','NG01','CS1',{ts '2022-05-20 14:40:29'},{ts '2022-05-20 14:40:29'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','NG01','CS2',{ts '2022-05-20 14:40:29'},{ts '2022-05-20 14:40:29'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','NG01','F01',{ts '2022-05-20 14:40:29'},{ts '2022-05-20 14:40:29'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','NG01','N01',{ts '2022-05-20 14:40:29'},{ts '2022-05-20 14:40:29'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','NG01','N02',{ts '2022-05-20 14:40:29'},{ts '2022-05-20 14:40:29'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','NG01','N03',{ts '2022-05-20 14:40:29'},{ts '2022-05-20 14:40:29'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','NG01','N04',{ts '2022-05-20 14:40:29'},{ts '2022-05-20 14:40:29'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','NG01','N05',{ts '2022-05-20 14:40:29'},{ts '2022-05-20 14:40:29'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','NG01','N06',{ts '2022-05-20 14:40:29'},{ts '2022-05-20 14:40:29'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','NG01','N07',{ts '2022-05-20 14:40:29'},{ts '2022-05-20 14:40:29'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','NG01','N08',{ts '2022-05-20 14:40:29'},{ts '2022-05-20 14:40:29'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','NG01','N09',{ts '2022-05-20 14:40:29'},{ts '2022-05-20 14:40:29'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','NG01','N10',{ts '2022-05-20 14:40:29'},{ts '2022-05-20 14:40:29'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','NG01','N11',{ts '2022-05-20 14:40:29'},{ts '2022-05-20 14:40:29'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','NG01','N12',{ts '2022-05-20 14:40:29'},{ts '2022-05-20 14:40:29'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','NG01','N13',{ts '2022-05-20 14:40:29'},{ts '2022-05-20 14:40:29'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','NG01','N14',{ts '2022-05-20 14:40:29'},{ts '2022-05-20 14:40:29'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','NG01','N15',{ts '2022-05-20 14:40:29'},{ts '2022-05-20 14:40:29'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','NG01','N16',{ts '2022-05-20 14:40:29'},{ts '2022-05-20 14:40:29'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','NG01','N17',{ts '2022-05-20 14:40:29'},{ts '2022-05-20 14:40:29'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','NG01','N18',{ts '2022-05-20 14:40:29'},{ts '2022-05-20 14:40:29'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','NG01','N19',{ts '2022-05-20 14:40:29'},{ts '2022-05-20 14:40:29'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','NG01','N20',{ts '2022-05-20 14:40:29'},{ts '2022-05-20 14:40:29'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','NG01','N21',{ts '2022-05-20 14:40:29'},{ts '2022-05-20 14:40:29'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','NG01','N22',{ts '2022-05-20 14:40:29'},{ts '2022-05-20 14:40:29'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','NG01','N23',{ts '2022-05-20 14:40:29'},{ts '2022-05-20 14:40:29'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','NG01','N24',{ts '2022-05-20 14:40:29'},{ts '2022-05-20 14:40:29'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','NG01','N25',{ts '2022-05-20 14:40:29'},{ts '2022-05-20 14:40:29'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','NG01','N26',{ts '2022-05-20 14:40:29'},{ts '2022-05-20 14:40:29'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','NG01','N27',{ts '2022-05-20 14:40:29'},{ts '2022-05-20 14:40:29'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','NG01','N28',{ts '2022-05-20 14:40:29'},{ts '2022-05-20 14:40:29'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','NG01','N29',{ts '2022-05-20 14:40:30'},{ts '2022-05-20 14:40:30'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','NG01','N30',{ts '2022-05-20 14:40:30'},{ts '2022-05-20 14:40:30'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','NG01','N31',{ts '2022-05-20 14:40:30'},{ts '2022-05-20 14:40:30'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','NG01','N32',{ts '2022-05-20 14:40:30'},{ts '2022-05-20 14:40:30'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','NG01','N33',{ts '2022-05-20 14:40:30'},{ts '2022-05-20 14:40:30'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','NG01','N34',{ts '2022-05-20 14:40:30'},{ts '2022-05-20 14:40:30'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','NG01','N35',{ts '2022-05-20 14:40:30'},{ts '2022-05-20 14:40:30'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','NG01','N36',{ts '2022-05-20 14:40:30'},{ts '2022-05-20 14:40:30'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','NG01','N37',{ts '2022-05-20 14:40:30'},{ts '2022-05-20 14:40:30'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','NG01','N38',{ts '2022-05-20 14:40:30'},{ts '2022-05-20 14:40:30'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','NG01','N39',{ts '2022-05-20 14:40:30'},{ts '2022-05-20 14:40:30'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','NG01','N40',{ts '2022-05-20 14:40:30'},{ts '2022-05-20 14:40:30'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','NG01','N41',{ts '2022-05-20 14:40:30'},{ts '2022-05-20 14:40:30'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','NG01','N42',{ts '2022-05-20 14:40:30'},{ts '2022-05-20 14:40:30'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','NW01','W01',{ts '2022-05-20 14:40:30'},{ts '2022-05-20 14:40:30'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','SB01','A01',{ts '2022-05-20 14:40:30'},{ts '2022-05-20 14:40:30'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','SG01','CS1',{ts '2022-05-20 14:40:30'},{ts '2022-05-20 14:40:30'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','SG01','CS2',{ts '2022-05-20 14:40:30'},{ts '2022-05-20 14:40:30'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','SG01','F01',{ts '2022-05-20 14:40:30'},{ts '2022-05-20 14:40:30'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','SG01','S01',{ts '2022-05-20 14:40:30'},{ts '2022-05-20 14:40:30'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','SG01','S02',{ts '2022-05-20 14:40:30'},{ts '2022-05-20 14:40:30'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','SG01','S03',{ts '2022-05-20 14:40:30'},{ts '2022-05-20 14:40:30'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','SG01','S04',{ts '2022-05-20 14:40:30'},{ts '2022-05-20 14:40:30'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','SG01','S05',{ts '2022-05-20 14:40:30'},{ts '2022-05-20 14:40:30'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','SG01','S06',{ts '2022-05-20 14:40:30'},{ts '2022-05-20 14:40:30'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','SG01','S07',{ts '2022-05-20 14:40:30'},{ts '2022-05-20 14:40:30'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','SG01','S08',{ts '2022-05-20 14:40:30'},{ts '2022-05-20 14:40:30'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','SG01','S09',{ts '2022-05-20 14:40:30'},{ts '2022-05-20 14:40:30'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','SG01','S10',{ts '2022-05-20 14:40:30'},{ts '2022-05-20 14:40:30'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','SG01','S11',{ts '2022-05-20 14:40:30'},{ts '2022-05-20 14:40:30'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','SG01','S12',{ts '2022-05-20 14:40:30'},{ts '2022-05-20 14:40:30'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','SG01','S13',{ts '2022-05-20 14:40:30'},{ts '2022-05-20 14:40:30'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','SG01','S14',{ts '2022-05-20 14:40:30'},{ts '2022-05-20 14:40:30'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','SG01','S15',{ts '2022-05-20 14:40:30'},{ts '2022-05-20 14:40:30'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','SG01','S16',{ts '2022-05-20 14:40:30'},{ts '2022-05-20 14:40:30'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','SG01','S17',{ts '2022-05-20 14:40:30'},{ts '2022-05-20 14:40:30'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','SG01','S18',{ts '2022-05-20 14:40:30'},{ts '2022-05-20 14:40:30'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','SG01','S19',{ts '2022-05-20 14:40:30'},{ts '2022-05-20 14:40:30'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','SG01','S20',{ts '2022-05-20 14:40:30'},{ts '2022-05-20 14:40:30'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','SG01','S21',{ts '2022-05-20 14:40:30'},{ts '2022-05-20 14:40:30'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','SG01','S22',{ts '2022-05-20 14:40:30'},{ts '2022-05-20 14:40:30'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','SG01','S23',{ts '2022-05-20 14:40:30'},{ts '2022-05-20 14:40:30'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','SG01','S24',{ts '2022-05-20 14:40:30'},{ts '2022-05-20 14:40:30'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','SG01','S25',{ts '2022-05-20 14:40:30'},{ts '2022-05-20 14:40:30'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','SG01','S26',{ts '2022-05-20 14:40:30'},{ts '2022-05-20 14:40:30'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','SG01','S27',{ts '2022-05-20 14:40:30'},{ts '2022-05-20 14:40:30'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','SG01','S28',{ts '2022-05-20 14:40:30'},{ts '2022-05-20 14:40:30'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','SG01','S29',{ts '2022-05-20 14:40:30'},{ts '2022-05-20 14:40:30'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','SG01','S30',{ts '2022-05-20 14:40:30'},{ts '2022-05-20 14:40:30'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','SG01','S31',{ts '2022-05-20 14:40:30'},{ts '2022-05-20 14:40:30'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','SG01','S32',{ts '2022-05-20 14:40:30'},{ts '2022-05-20 14:40:30'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','SG01','S33',{ts '2022-05-20 14:40:30'},{ts '2022-05-20 14:40:30'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','SG01','S34',{ts '2022-05-20 14:40:30'},{ts '2022-05-20 14:40:30'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','SG01','S37',{ts '2022-05-20 14:40:30'},{ts '2022-05-20 14:40:30'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','SG01','S38',{ts '2022-05-20 14:40:30'},{ts '2022-05-20 14:40:30'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','SG01','S39',{ts '2022-05-20 14:40:30'},{ts '2022-05-20 14:40:30'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','SG01','S40',{ts '2022-05-20 14:40:30'},{ts '2022-05-20 14:40:30'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','SG01','S41',{ts '2022-05-20 14:40:30'},{ts '2022-05-20 14:40:30'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','SG01','S42',{ts '2022-05-20 14:40:30'},{ts '2022-05-20 14:40:30'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','SG01','S43',{ts '2022-05-20 14:40:30'},{ts '2022-05-20 14:40:30'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','SG01','S44',{ts '2022-05-20 14:40:30'},{ts '2022-05-20 14:40:30'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','SG01','S45',{ts '2022-05-20 14:40:30'},{ts '2022-05-20 14:40:30'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','SG01','S46',{ts '2022-05-20 14:40:30'},{ts '2022-05-20 14:40:30'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','SG01','S47',{ts '2022-05-20 14:40:30'},{ts '2022-05-20 14:40:30'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','SG01','S48',{ts '2022-05-20 14:40:30'},{ts '2022-05-20 14:40:30'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','SG01','S49',{ts '2022-05-20 14:40:31'},{ts '2022-05-20 14:40:31'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','SG01','S50',{ts '2022-05-20 14:40:31'},{ts '2022-05-20 14:40:31'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','SG01','S51',{ts '2022-05-20 14:40:31'},{ts '2022-05-20 14:40:31'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','SG01','S52',{ts '2022-05-20 14:40:31'},{ts '2022-05-20 14:40:31'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','SG01','S53',{ts '2022-05-20 14:40:31'},{ts '2022-05-20 14:40:31'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','SG01','S54',{ts '2022-05-20 14:40:31'},{ts '2022-05-20 14:40:31'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','SG01','S55',{ts '2022-05-20 14:40:31'},{ts '2022-05-20 14:40:31'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','SG01','S56',{ts '2022-05-20 14:40:31'},{ts '2022-05-20 14:40:31'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','SG01','S57',{ts '2022-05-20 14:40:31'},{ts '2022-05-20 14:40:31'});
INSERT INTO TVBVK (MANDT,VKBUR,VKGRP,createdate,upddate) VALUES ('040','SG01','S58',{ts '2022-05-20 14:40:31'},{ts '2022-05-20 14:40:31'});





INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','BI014','Leon Baker',{ts '2022-05-20 14:59:53.983000'},{ts '2022-05-20 14:59:53.983000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','BI001','Liesel Whittington',{ts '2022-05-20 15:07:52.880000'},{ts '2022-05-20 15:07:52.880000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','BI002','Stefan Potgieter',{ts '2022-05-20 15:07:52.897000'},{ts '2022-05-20 15:07:52.897000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','BI003','Hanno De Lange',{ts '2022-05-20 15:07:52.913000'},{ts '2022-05-20 15:07:52.913000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','BI004','Pieter Daniel',{ts '2022-05-20 15:07:52.927000'},{ts '2022-05-20 15:07:52.927000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','BI006','Joanne Rowan',{ts '2022-05-20 15:07:52.947000'},{ts '2022-05-20 15:07:52.947000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','BI008','Justin Jacobs',{ts '2022-05-20 15:07:52.960000'},{ts '2022-05-20 15:07:52.960000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','BI009','BLANK',{ts '2022-05-20 15:07:52.973000'},{ts '2022-05-20 15:07:52.973000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','BI012','James Wichary',{ts '2022-05-20 15:07:52.990000'},{ts '2022-05-20 15:07:52.990000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','BI013','BLANK',{ts '2022-05-20 15:07:53.007000'},{ts '2022-05-20 15:07:53.007000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','BI015','Igna Barnard',{ts '2022-05-20 15:07:53.033000'},{ts '2022-05-20 15:07:53.033000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','BI016','Dale Riches',{ts '2022-05-20 15:07:53.067000'},{ts '2022-05-20 15:07:53.067000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','BI017','Hanri Oelofse',{ts '2022-05-20 15:07:53.083000'},{ts '2022-05-20 15:07:53.083000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','BI019','Chris Van Niekerk',{ts '2022-05-20 15:07:53.103000'},{ts '2022-05-20 15:07:53.103000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','BI020','Dawid Verwey',{ts '2022-05-20 15:07:53.117000'},{ts '2022-05-20 15:07:53.117000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','BI021','Greg Bishop',{ts '2022-05-20 15:07:53.133000'},{ts '2022-05-20 15:07:53.133000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','BI022','Lorraine Botha',{ts '2022-05-20 15:07:53.150000'},{ts '2022-05-20 15:07:53.150000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','BI023','Johan Ceronio',{ts '2022-05-20 15:07:53.167000'},{ts '2022-05-20 15:07:53.167000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','CAOP01','Gameeda Jardien',{ts '2022-05-20 15:07:53.180000'},{ts '2022-05-20 15:07:53.180000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','CAOP02','Lisa-Marie Botha',{ts '2022-05-20 15:07:53.197000'},{ts '2022-05-20 15:07:53.197000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','CAOP03','Theunis vd Westhuize',{ts '2022-05-20 15:07:53.210000'},{ts '2022-05-20 15:07:53.210000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','CAOP04','Ronnie Du Preez',{ts '2022-05-20 15:07:53.223000'},{ts '2022-05-20 15:07:53.223000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','ED001','Kirsty Boschoff',{ts '2022-05-20 15:07:53.240000'},{ts '2022-05-20 15:07:53.240000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','ED002','Michael Darck',{ts '2022-05-20 15:07:53.253000'},{ts '2022-05-20 15:07:53.253000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','ED003','Barbara Mcvey',{ts '2022-05-20 15:07:53.270000'},{ts '2022-05-20 15:07:53.270000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','ED004','Chris van Niekerk',{ts '2022-05-20 15:07:53.287000'},{ts '2022-05-20 15:07:53.287000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','ES001','Derek Swan',{ts '2022-05-20 15:07:53.300000'},{ts '2022-05-20 15:07:53.300000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','ES002','BLANK',{ts '2022-05-20 15:07:53.317000'},{ts '2022-05-20 15:07:53.317000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','ES003','BLANK',{ts '2022-05-20 15:07:53.330000'},{ts '2022-05-20 15:07:53.330000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','ES004','Dave Hepburn',{ts '2022-05-20 15:07:53.347000'},{ts '2022-05-20 15:07:53.347000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','ES005','BLANK',{ts '2022-05-20 15:07:53.360000'},{ts '2022-05-20 15:07:53.360000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','ES006','Dale Riches',{ts '2022-05-20 15:07:53.377000'},{ts '2022-05-20 15:07:53.377000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','ES007','BLANK',{ts '2022-05-20 15:07:53.390000'},{ts '2022-05-20 15:07:53.390000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','ES008','Hanrie Oelofse',{ts '2022-05-20 15:07:53.407000'},{ts '2022-05-20 15:07:53.407000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','ES009','James Wichary',{ts '2022-05-20 15:07:53.420000'},{ts '2022-05-20 15:07:53.420000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','ES010','BLANK',{ts '2022-05-20 15:07:53.433000'},{ts '2022-05-20 15:07:53.433000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','ES011','BLANK',{ts '2022-05-20 15:07:53.450000'},{ts '2022-05-20 15:07:53.450000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','HC001','Ashleigh Caine',{ts '2022-05-20 15:07:53.463000'},{ts '2022-05-20 15:07:53.463000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','HC002','Lorraine Botha',{ts '2022-05-20 15:07:53.480000'},{ts '2022-05-20 15:07:53.480000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','HC003','Chantelle Stubenvoll',{ts '2022-05-20 15:07:53.493000'},{ts '2022-05-20 15:07:53.493000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','HC004','Allen Nzama',{ts '2022-05-20 15:07:53.510000'},{ts '2022-05-20 15:07:53.510000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','HC005','Helena Prinsloo',{ts '2022-05-20 15:07:53.523000'},{ts '2022-05-20 15:07:53.523000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','HC006','Rishandra Bissessur',{ts '2022-05-20 15:07:53.540000'},{ts '2022-05-20 15:07:53.540000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','HC007','Riette van der Raad',{ts '2022-05-20 15:07:53.553000'},{ts '2022-05-20 15:07:53.553000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','HC008','Enid Van Heerden',{ts '2022-05-20 15:07:53.570000'},{ts '2022-05-20 15:07:53.570000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','HC009','BLANK',{ts '2022-05-20 15:07:53.583000'},{ts '2022-05-20 15:07:53.583000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','HC010','Elanza Barnard',{ts '2022-05-20 15:07:53.600000'},{ts '2022-05-20 15:07:53.600000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','HC011','Vacant',{ts '2022-05-20 15:07:53.617000'},{ts '2022-05-20 15:07:53.617000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','HC012','Amanda Schoeman',{ts '2022-05-20 15:07:53.633000'},{ts '2022-05-20 15:07:53.633000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','HC013','Renita VD Merwe',{ts '2022-05-20 15:07:53.647000'},{ts '2022-05-20 15:07:53.647000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','HC014','Cherryl Farquharson',{ts '2022-05-20 15:07:53.663000'},{ts '2022-05-20 15:07:53.663000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','HC015','Carike Snygans',{ts '2022-05-20 15:07:53.677000'},{ts '2022-05-20 15:07:53.677000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','HC016','Lucky Makena',{ts '2022-05-20 15:07:53.693000'},{ts '2022-05-20 15:07:53.693000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','HC017','Kirsty Boshoff',{ts '2022-05-20 15:07:53.710000'},{ts '2022-05-20 15:07:53.710000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','HC018','Logan Naidoo',{ts '2022-05-20 15:07:53.723000'},{ts '2022-05-20 15:07:53.723000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','HOOP01','Head Office',{ts '2022-05-20 15:07:53.740000'},{ts '2022-05-20 15:07:53.740000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','INOP01','Rentia Van Der Merwe',{ts '2022-05-20 15:07:53.757000'},{ts '2022-05-20 15:07:53.757000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','INOP02','Belinda Venter',{ts '2022-05-20 15:07:53.770000'},{ts '2022-05-20 15:07:53.770000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','INOP03','Sanet Smit',{ts '2022-05-20 15:07:53.787000'},{ts '2022-05-20 15:07:53.787000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','INOP04','Helena Prinsloo',{ts '2022-05-20 15:07:53.803000'},{ts '2022-05-20 15:07:53.803000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','INOP05','Lucky Makena',{ts '2022-05-20 15:07:53.817000'},{ts '2022-05-20 15:07:53.817000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','INOP06','Vacant',{ts '2022-05-20 15:07:53.833000'},{ts '2022-05-20 15:07:53.833000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','KNOP01','LEON PIETER STAPELBE',{ts '2022-05-20 15:07:53.850000'},{ts '2022-05-20 15:07:53.850000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','KNOP02','GULAB MAHO HOOSAN',{ts '2022-05-20 15:07:53.867000'},{ts '2022-05-20 15:07:53.867000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','KNOP03','MARISKA VAN HEERDEN',{ts '2022-05-20 15:07:53.880000'},{ts '2022-05-20 15:07:53.880000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','KNOP04','FAZEL MOHAMMED',{ts '2022-05-20 15:07:53.897000'},{ts '2022-05-20 15:07:53.897000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','KNOP05','CHEZ WEPENZER',{ts '2022-05-20 15:07:53.913000'},{ts '2022-05-20 15:07:53.913000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','KNOP06','VACANT',{ts '2022-05-20 15:07:53.930000'},{ts '2022-05-20 15:07:53.930000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','KNOP07','JANOS KOVACS',{ts '2022-05-20 15:07:53.943000'},{ts '2022-05-20 15:07:53.943000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','KNOP08','MUSAWENKOSI KHUMALO',{ts '2022-05-20 15:07:53.963000'},{ts '2022-05-20 15:07:53.963000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','KNOP09','RONNIE DU PREEZ',{ts '2022-05-20 15:07:53.980000'},{ts '2022-05-20 15:07:53.980000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','KNOP13','JAMES NKOMO',{ts '2022-05-20 15:07:53.997000'},{ts '2022-05-20 15:07:53.997000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','KNOP14','ERROL STRONG',{ts '2022-05-20 15:07:54.010000'},{ts '2022-05-20 15:07:54.010000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','KNOP15','JOHANNA VEERASAMY',{ts '2022-05-20 15:07:54.027000'},{ts '2022-05-20 15:07:54.027000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','KNOP16','FRANCOIS JV RENSBURG',{ts '2022-05-20 15:07:54.043000'},{ts '2022-05-20 15:07:54.043000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','KNOP17','SHAUN NAIDOO',{ts '2022-05-20 15:07:54.063000'},{ts '2022-05-20 15:07:54.063000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','KNOP18','DANIE VAN DEN BERG',{ts '2022-05-20 15:07:54.080000'},{ts '2022-05-20 15:07:54.080000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','KNOP19','RYAN JV RENSBURG',{ts '2022-05-20 15:07:54.097000'},{ts '2022-05-20 15:07:54.097000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','KNOP20','BELINDA BOTES',{ts '2022-05-20 15:07:54.110000'},{ts '2022-05-20 15:07:54.110000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','NG0P01','LUCIA WILHELMINA JAC',{ts '2022-05-20 15:07:54.127000'},{ts '2022-05-20 15:07:54.127000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','NGOP01','LUCIA WILHELMINA JAC',{ts '2022-05-20 15:07:54.140000'},{ts '2022-05-20 15:07:54.140000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','NGOP02','LULU JACOBS',{ts '2022-05-20 15:07:54.157000'},{ts '2022-05-20 15:07:54.157000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','NGOP03','VACANT',{ts '2022-05-20 15:07:54.170000'},{ts '2022-05-20 15:07:54.170000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','NGOP04','ESTELLE BOTHA',{ts '2022-05-20 15:07:54.187000'},{ts '2022-05-20 15:07:54.187000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','NGOP05','ANTONETTE STEYN',{ts '2022-05-20 15:07:54.200000'},{ts '2022-05-20 15:07:54.200000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','NO-OPS','No Ops Manager',{ts '2022-05-20 15:07:54.217000'},{ts '2022-05-20 15:07:54.217000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','NWOP01','Veronica Sterley',{ts '2022-05-20 15:07:54.233000'},{ts '2022-05-20 15:07:54.233000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','PROO1','Arno Karemaker',{ts '2022-05-20 15:07:54.250000'},{ts '2022-05-20 15:07:54.250000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','RE001','Angelique Power',{ts '2022-05-20 15:07:54.263000'},{ts '2022-05-20 15:07:54.263000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','SFS001','SC Financial Service',{ts '2022-05-20 15:07:54.280000'},{ts '2022-05-20 15:07:54.280000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','SGOP01','VACANT',{ts '2022-05-20 15:07:54.293000'},{ts '2022-05-20 15:07:54.293000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','SGOP02','CLAERWEN ISAACS',{ts '2022-05-20 15:07:54.310000'},{ts '2022-05-20 15:07:54.310000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','SGOP03','SOLENE BESTER',{ts '2022-05-20 15:07:54.323000'},{ts '2022-05-20 15:07:54.323000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','SGOP04','VACANT',{ts '2022-05-20 15:07:54.340000'},{ts '2022-05-20 15:07:54.340000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','SGOP05','PELEGRINA THERESA LE',{ts '2022-05-20 15:07:54.353000'},{ts '2022-05-20 15:07:54.353000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','SGOP06','XERXES SEEGERS',{ts '2022-05-20 15:07:54.370000'},{ts '2022-05-20 15:07:54.370000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','SGOP07','HERMANN VORSTER',{ts '2022-05-20 15:07:54.387000'},{ts '2022-05-20 15:07:54.387000'});
INSERT INTO T171T (MANDT,SPRAS,BZIRK,BZTXT,createdate,upddate) VALUES ('040','E','ST0001','Sbonokwanqobi Tradin',{ts '2022-05-20 15:07:54.400000'},{ts '2022-05-20 15:07:54.400000'});





-- Add Approved columns
ALTER TABLE quote
ADD COLUMN regional_manager_approved int AFTER start_date;
ALTER TABLE quote
ADD COLUMN regional_manager_approved_date date AFTER regional_manager_approved;
ALTER TABLE quote
ADD COLUMN regional_director_approved int AFTER regional_manager_approved_date;
ALTER TABLE quote
ADD COLUMN regional_director_approved_date date AFTER regional_director_approved;
ALTER TABLE quote
ADD COLUMN manager_director_approved int AFTER regional_director_approved_date;
ALTER TABLE quote
ADD COLUMN manager_director_approved_date date AFTER manager_director_approved;










-- Recurring

ALTER TABLE rosters
ADD type VARCHAR(255) AFTER Name


ALTER TABLE rosters
ADD uid VARCHAR(255) AFTER Name





ALTER TABLE quote
ADD template LONGTEXT AFTER area_manager_name




insert into attributes (Name,Description,ValidFrom) values ('sappableFrom', 'Date from which the SAP button will work', now())

update attributes set createDate = now() where id = 24


CREATE TABLE job_titles
(
   Id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
   name varchar(255),
   description varchar(255),
   create_date date,
   upd_date date
)
;



INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContClean','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContTeamLea','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContMgr','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContSup','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('Learner','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('197_Clean','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('197_GenWork','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContAdminC','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContArtisAid','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContAshHanl','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContAssChef','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContAssCook','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContAssHous','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContAssNurse','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContAuxNurse','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContBaker','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContBarLady','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContBlockm','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContBoilAss','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContBrewer','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContC/DHouse','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContCaregive','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContCarpent','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContCarwAss','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContCashier','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContCaterAss','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContChef','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContCleanLR','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContCoalHand','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContCook','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContCoreCut','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContCourier','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContCPClean','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContCPHouse','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContDeskCo','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContDinRAss','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContDMAss','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContDrive','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContDriveAss','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContDryAss','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContElec','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContENurseAs','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContExeHouse','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContFacAss','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContFarmWork','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContFitAss','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContFolDrive','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContFoodPrep','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContFoodSAss','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContForeman','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContForkDriv','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContFuelAtte','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContGarden','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContGenWork','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContGolfCDri','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContGriller','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContGroomer','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContHandym','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContHostess','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContHousek','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContHousema','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContHousemo','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContIndContr','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContInstWork','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContKitcAss','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContKitcClea','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContKitcHos','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContLabHT','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContLabHTR','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContLauSta','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContLauSup','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContLeaHa','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContMaint','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContMCoO','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContMech','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContMesse','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContMillrAss','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContMilyAss','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContMilyCle','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContMilyFD','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContMKAss','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContMRAss','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContNurse','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContOrderly','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContOSettl','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContPack','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContPaint','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContPlum','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContPMDay','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContPortHC','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContPowSCl','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContPumpAtt','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContRegNurse','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContResMan','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContResSup','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContRewAss','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContRoomAtt','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContRunner','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContSculClea','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContSeamst','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContSecWinAs','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContServCo','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContSiteSup','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContSorters','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContSousChef','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContSpeSerCo','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContSprPaint','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContStaNurse','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContStenc','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContStencAss','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContStoreCle','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContStorema','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContTalleCle','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContTaupe','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContTeaLad','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContTechn','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContTempCle','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContTheaAss','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContTranCle','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContTrucAss','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContValeSta','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContWaiter','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContWardAss','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContWardHos','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContWasBLo','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContWasFee','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContWasPCle','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContWasPDr','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContWatchma','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContWetEHelp','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContWindCle','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ContWorkFor','',now(),now());
INSERT INTO job_titles (name, description, create_date, upd_date) VALUES ('ShopStew','',now(),now());





insert into attributes (Name,Description,value,ValidFrom,ValidTill,CreateDate) values ('bonus', 'Bonus Percent', 4.33, now(), '3022-12-31', now())


insert into attributes (Name,Description,value,ValidFrom,ValidTill,CreateDate) values ('primeODRate', 'Prime OD Rate', 9, now(), '3022-12-31', now())

    ALTER TABLE TVBVK
ADD description varchar(255);