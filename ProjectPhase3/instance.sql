
CREATE TABLE users(
    user_id INT(4) AUTO_INCREMENT,
    user_name VARCHAR(20) NOT NULL,
    user_password VARCHAR(20) NOT NULL,
    user_created DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(user_id)
)AUTO_INCREMENT=500; 

CREATE TABLE locations(
    location_id INT(4) AUTO_INCREMENT,
    street_address VARCHAR(40),
    postal_code VARCHAR(12),
    city VARCHAR(30) NOT NULL,
    state_province VARCHAR(25),
    PRIMARY KEY(location_id)
)AUTO_INCREMENT=3111;
INSERT INTO locations (street_address, postal_code, city, state_province) VALUES('9001 Patterson Ave', '23229', 'Richmond', 'Virginia' );
INSERT INTO locations (street_address, postal_code, city, state_province) VALUES('11 Vintage Dr', '23229', 'Henrico', 'Virginia' );
INSERT INTO locations (street_address, postal_code, city, state_province) VALUES ('1320 Starling Dr','23229','Richmond','Virginia');
INSERT INTO locations (street_address, postal_code, city, state_province) VALUES ('9650 W Broad St','23229','Richmond','Virginia');

 
 CREATE TABLE products(
    product_id INT(4) AUTO_INCREMENT ,
    product_name VARCHAR(255) NOT NULL,
    product_quantity INT(8) NOT NULL,
    product_price DECIMAL(8, 2) CHECK
        (product_price > 0),
        PRIMARY KEY(product_id)
)AUTO_INCREMENT=1000;
INSERT INTO products(product_name, product_quantity, product_price) VALUES ('Johnnie Walker',100,61.99);
INSERT INTO products(product_name, product_quantity, product_price) VALUES ('Red Wine',50,31.99);
INSERT INTO products(product_name, product_quantity, product_price) VALUES ('Ice Cream',10,9.99);
INSERT INTO products(product_name, product_quantity, product_price) VALUES ('Deer Park- Water',100,4.99);
INSERT INTO products(product_name, product_quantity, product_price) VALUES ('Bud Light 24pk',50,21.99);
INSERT INTO products(product_name, product_quantity, product_price) VALUES ('Coors Light 18pk',10,15.99);

CREATE TABLE store(
    store_id INT(4),
    store_name VARCHAR(30) NOT NULL,
    phone_number VARCHAR(20),
    manager_id INT(6),
    location_id INT(4),
    PRIMARY KEY(store_id),
    FOREIGN KEY(location_id) REFERENCES locations(location_id)
);
INSERT INTO store VALUES (1250,'Quick & Easy','804-236-2564',80451,3111);
INSERT INTO store VALUES (0568,'Quick & Easy','804-266-6564',80450,3112);

 CREATE TABLE employees(
    employee_id INTEGER(6) AUTO_INCREMENT ,
    first_name VARCHAR(20),
    last_name VARCHAR(25) NOT NULL,
    email VARCHAR(25) NOT NULL UNIQUE,
    phone_number VARCHAR(20),
    hire_date DATE NOT NULL,
    supervisior_id INT(4),
    salary DECIMAL(8, 2) CHECK
        (salary > 0),
        location_id INT(4),
        manager_id INT(6),
        store_id INT(4),
        PRIMARY KEY(employee_id),
        FOREIGN KEY(store_id) REFERENCES store(store_id),
        FOREIGN KEY(location_id) REFERENCES locations(location_id)
)AUTO_INCREMENT=80450;
INSERT INTO employees (first_name, last_name, email, phone_number, hire_date, supervisior_id, salary, location_id, manager_id, store_id) VALUES ('Roshan','Pradhan','pradhanr@vcu.edu','804-502-3157',STR_TO_DATE('17-06-2003', '%d-%m-%Y'),NULL,28000,3111,NULL,1250);
INSERT INTO employees (first_name, last_name, email, phone_number, hire_date, supervisior_id, salary, location_id, manager_id, store_id) VALUES ('Ashok','Subedi','subedia@vcu.edu','717-502-3157',STR_TO_DATE('17-06-2014', '%d-%m-%Y'),NULL,30000,3111,80450,1250);
INSERT INTO employees (first_name, last_name, email, phone_number, hire_date, supervisior_id, salary, location_id, manager_id, store_id) VALUES ('Megan','Williams','meganw@vcu.edu','884-562-3157',STR_TO_DATE('17-06-2001', '%d-%m-%Y'),80451,40000,3112,80451,0568);
INSERT INTO employees (first_name, last_name, email, phone_number, hire_date, supervisior_id, salary, location_id, manager_id, store_id) VALUES ('Rabin','Gurung','robgurung@vcu.edu','562-123-3157',STR_TO_DATE('17-06-2009', '%d-%m-%Y'),80451,28000,3112,80450,1250);
INSERT INTO employees (first_name, last_name, email, phone_number, hire_date, supervisior_id, salary, location_id, manager_id, store_id) VALUES ('Gayatri','Subedi','gayatrisubedia@vcu.edu','698-502-3365',STR_TO_DATE('17-06-2021', '%d-%m-%Y'),NULL,25000,3111,80450,1250);

CREATE TABLE supplier(
    supplier_id INT(4) AUTO_INCREMENT,
    supplier_name VARCHAR(20) NOT NULL,
    phone_number VARCHAR(20) NOT NULL,
    location_id INT(4),
    product_id INT(4),
    PRIMARY KEY(supplier_id),
    FOREIGN KEY(location_id) REFERENCES locations(location_id),
    FOREIGN KEY(product_id) REFERENCES products(product_id)
)AUTO_INCREMENT=1225;

INSERT INTO supplier (supplier_name, phone_number, location_id, product_id) VALUES ('BJs Wholesale Club','804-727-3500',3113,1000);
INSERT INTO supplier (supplier_name, phone_number, location_id, product_id) VALUES ('Costco Wholesale','804-687-3522',3114,1000);
INSERT INTO supplier (supplier_name, phone_number, location_id, product_id) VALUES ('Walmart','800-365-3500',3113,1004);
INSERT INTO supplier (supplier_name, phone_number, location_id, product_id) VALUES ('Sams Club','787-300-4565',3114,1003);

 CREATE TABLE merchandise(
    merchandise_id INT(4) AUTO_INCREMENT,
    store_id INT(4) NOT NULL,
    supplier_id INT(4) NOT NULL,
    order_date TIMESTAMP NOT NULL,
    product_id INT(4),
    product_quantity INT(8) NOT NULL,
    product_price DECIMAL(8, 2) NOT NULL CHECK
        (product_price > 0),
        PRIMARY KEY(merchandise_id),
        FOREIGN KEY(store_id) REFERENCES store(store_id),
        FOREIGN KEY(product_id) REFERENCES products(product_id),
        FOREIGN KEY(supplier_id) REFERENCES supplier(supplier_id)
)AUTO_INCREMENT=150;

INSERT INTO merchandise(store_id, supplier_id, order_date,product_id, product_quantity, product_price) VALUES (1250,1225,CURRENT_TIMESTAMP(),1003,5,28.99);
INSERT INTO merchandise(store_id, supplier_id, order_date,product_id, product_quantity, product_price) VALUES (1250,1226,CURRENT_DATE,1002,3,460.99);
INSERT INTO merchandise(store_id, supplier_id, order_date,product_id, product_quantity, product_price) VALUES (568,1225,CURRENT_TIMESTAMP(),1001,5,28.99);
INSERT INTO merchandise(store_id, supplier_id, order_date,product_id, product_quantity, product_price) VALUES (1250,1226,CURRENT_DATE,1000,3,140.99);
INSERT INTO merchandise(store_id, supplier_id, order_date,product_id, product_quantity, product_price) VALUES (568,1225,CURRENT_TIMESTAMP(),1003,5,218.99);
INSERT INTO merchandise(store_id, supplier_id, order_date,product_id, product_quantity, product_price) VALUES (1250,1226,CURRENT_DATE,1002,3,400.99);

CREATE TABLE customers(
    customer_id INTEGER(6) AUTO_INCREMENT,
    first_name VARCHAR(20),
    last_name VARCHAR(25) NOT NULL,
    email VARCHAR(25),
    phone_number VARCHAR(20) NOT NULL,
    location_id INT(4) NOT NULL,
    store_id INT(4) NOT NULL,
    PRIMARY KEY(customer_id),
    FOREIGN KEY(store_id) REFERENCES store(store_id),
    FOREIGN KEY(location_id) REFERENCES locations(location_id)
)AUTO_INCREMENT=200; 
INSERT INTO customers (first_name, last_name, email, phone_number, location_id, store_id) VALUES ('Ryan','Shrestha','ryan@gmail.com','804-256-3564',3111,1250);
INSERT INTO customers (first_name, last_name, email, phone_number, location_id, store_id) VALUES ('Rylan','Subedi','rylan@gmail.com','804-256-3564',3111,0568);
INSERT INTO customers (first_name, last_name, email, phone_number, location_id, store_id) VALUES ('Mike','Mills','mike2022@gmail.com','804-255-3564',3112,0568);
INSERT INTO customers (first_name, last_name, email, phone_number, location_id, store_id) VALUES ('Sweta','Shrestha','sweta@gmail.com','804-656-3564',3112,0568);
INSERT INTO customers (first_name, last_name, email, phone_number, location_id, store_id) VALUES ('Cano','Amigo','amigo@gmail.com','894-256-3564',3112,0568);


CREATE TABLE sales(
    sale_id INT(4) AUTO_INCREMENT,
    employee_id INTEGER(6) NOT NULL,
    customer_id INTEGER(6) NOT NULL,
    sale_date TIMESTAMP NOT NULL ,
    product_id INT(4),
    sale_quantity INT(4) NOT NULL,
    sale_price DECIMAL(8, 2) NOT NULL CHECK
        (sale_price > 0),
        PRIMARY KEY(sale_id),
        FOREIGN KEY(employee_id) REFERENCES employees(employee_id),
        FOREIGN KEY(product_id) REFERENCES products(product_id),
        FOREIGN KEY(customer_id) REFERENCES customers(customer_id)
)AUTO_INCREMENT=001;

INSERT INTO sales(employee_id, customer_id, sale_date, product_id, sale_quantity, sale_price) VALUES (80451,200,CURRENT_TIMESTAMP(),1000,5,524.89);
INSERT INTO sales(employee_id, customer_id, sale_date, product_id, sale_quantity, sale_price) VALUES (80454,201,CURRENT_TIMESTAMP(),1001,3,398.02);
INSERT INTO sales(employee_id, customer_id, sale_date, product_id, sale_quantity, sale_price) VALUES (80452,204,CURRENT_TIMESTAMP(),1003,2,568.01);
INSERT INTO sales(employee_id, customer_id, sale_date, product_id, sale_quantity, sale_price) VALUES (80453,203,CURRENT_TIMESTAMP(),1002,1,2.99);
INSERT INTO sales(employee_id, customer_id, sale_date, product_id, sale_quantity, sale_price) VALUES (80454,202,CURRENT_TIMESTAMP(),1000,4,1.99);

CREATE TABLE shipments(
    shipment_id INT(4) AUTO_INCREMENT,
    sale_id INT(4) NOT NULL,
    shipment_date TIMESTAMP NOT NULL,
    PRIMARY KEY(shipment_id),
    FOREIGN KEY(sale_id) REFERENCES sales(sale_id)
)AUTO_INCREMENT=1101;

INSERT INTO shipments(sale_id, shipment_date) VALUES (1,CURRENT_TIMESTAMP());
INSERT INTO shipments(sale_id, shipment_date) VALUES (3,CURRENT_TIMESTAMP());
INSERT INTO shipments(sale_id, shipment_date) VALUES (4,CURRENT_TIMESTAMP());
INSERT INTO shipments(sale_id, shipment_date) VALUES (2,CURRENT_TIMESTAMP());
INSERT INTO shipments(sale_id, shipment_date) VALUES (2,CURRENT_TIMESTAMP());