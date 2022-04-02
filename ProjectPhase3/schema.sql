
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