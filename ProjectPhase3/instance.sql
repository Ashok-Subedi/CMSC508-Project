
CREATE TABLE users(
    user_id INT(4) AUTO_INCREMENT,
    user_name VARCHAR(20) NOT NULL,
    user_password VARCHAR(20) NOT NULL,
    PRIMARY KEY(user_id)
); 

CREATE TABLE locations(
    location_id INT(4),
    street_address VARCHAR(40),
    postal_code VARCHAR(12),
    city VARCHAR(30) NOT NULL,
    state_province VARCHAR(25),
    PRIMARY KEY(location_id)
);
INSERT INTO locations VALUES( 100, '9001 Patterson Ave', '23229', 'Richmond', 'Virginia' );
INSERT INTO locations VALUES( 101, '11 Vintage Dr', '23229', 'Henrico', 'Virginia' );

 
 CREATE TABLE products(
    product_id INT(4) AUTO_INCREMENT,
    product_name VARCHAR(20) NOT NULL,
    product_quantity INT(8) NOT NULL,
    product_price DECIMAL(8, 2) CHECK
        (product_price > 0),
        PRIMARY KEY(product_id)
);

CREATE TABLE store(
    store_id INT(4),
    store_name VARCHAR(30) NOT NULL,
    phone_number VARCHAR(20),
    manager_id INT(6),
    location_id INT(4),
    PRIMARY KEY(store_id),
    FOREIGN KEY(location_id) REFERENCES locations(location_id)
);
INSERT INTO store VALUES (1250,'Quick & Easy','804-236-2564',1,100);
INSERT INTO store VALUES (0568,'Quick & Easy','804-266-6564',2,100);

 CREATE TABLE employees(
    employee_id INTEGER(6) AUTO_INCREMENT,
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
);
INSERT INTO employees VALUES (1,'Roshan','Pradhan','pradhanr@vcu.edu','804-502-3157',STR_TO_DATE('17-06-2003', '%d-%m-%Y'),NULL,28000,100,2001,1250);
INSERT INTO employees VALUES (2,'Ashok','Subedi','subedia@vcu.edu','717-502-3157',STR_TO_DATE('17-06-2014', '%d-%m-%Y'),001,30000,101,NULL,1250);


CREATE TABLE supplier(
    supplier_id INT(4) AUTO_INCREMENT,
    supplier_name VARCHAR(20) NOT NULL,
    phone_number VARCHAR(20) NOT NULL,
    location_id INT(4),
    product_id INT(4),
    PRIMARY KEY(supplier_id),
    FOREIGN KEY(location_id) REFERENCES locations(location_id),
    FOREIGN KEY(product_id) REFERENCES products(product_id)
);

 CREATE TABLE merchandise(
    merchandise_id INT(4) AUTO_INCREMENT,
    store_id INT(4),
    supplier_id INT(4),
    order_date DATE,
    product_price DECIMAL(8, 2) CHECK
        (product_price > 0),
        PRIMARY KEY(merchandise_id),
        FOREIGN KEY(store_id) REFERENCES store(store_id),
        FOREIGN KEY(supplier_id) REFERENCES supplier(supplier_id)
);

CREATE TABLE customers(
    customer_id INTEGER(6) AUTO_INCREMENT,
    first_name VARCHAR(20),
    last_name VARCHAR(25) NOT NULL,
    email VARCHAR(25),
    phone_number VARCHAR(20),
    location_id INT(4),
    store_id INT(4),
    PRIMARY KEY(customer_id),
    FOREIGN KEY(store_id) REFERENCES store(store_id),
    FOREIGN KEY(location_id) REFERENCES locations(location_id)
); 
INSERT INTO customers VALUES (101,'Ryan','Shrestha','ryan@gmail.com','804-256-3564',100,0568);
INSERT INTO customers VALUES (102,'Rylan','Subedi','rylan@gmail.com','804-256-3564',100,0568);

CREATE TABLE sales(
    sale_id INT(4) AUTO_INCREMENT,
    employee_id INTEGER(6) NOT NULL,
    customer_id INTEGER(6) NOT NULL,
    sale_date DATE,
    sale_quantity INT(4),
    sale_price DECIMAL(8, 2) CHECK
        (sale_price > 0),
        PRIMARY KEY(sale_id),
        FOREIGN KEY(employee_id) REFERENCES employees(employee_id),
        FOREIGN KEY(customer_id) REFERENCES customers(customer_id)
);

CREATE TABLE shipments(
    shipment_id INT(4) AUTO_INCREMENT,
    sale_id INT(4) NOT NULL,
    shipment_date DATE,
    PRIMARY KEY(shipment_id),
    FOREIGN KEY(sale_id) REFERENCES sales(sale_id)
);