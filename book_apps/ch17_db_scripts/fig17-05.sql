DROP DATABASE IF  EXISTS MikesMusic5;

CREATE DATABASE MikesMusic5;

USE MikesMusic5;

-- A table with a column-level primary key
CREATE TABLE customers (
  customerID    INT           NOT NULL   PRIMARY KEY  AUTO_INCREMENT,
  emailAddress  VARCHAR(255)  NOT NULL   UNIQUE,
  firstName     VARCHAR(30)   NOT NULL
);

INSERT INTO customers 
VALUES(1, 'joelmurach@yahoo.com', 'Joelhasalongfirstname');

CREATE TABLE products (
  productID     INT           NOT NULL   PRIMARY KEY  AUTO_INCREMENT,
  productName   VARCHAR(30)   NOT NULL
);

-- A statement that renames a table
ALTER TABLE products RENAME TO product;

-- A statement that adds a new column
ALTER TABLE customers ADD lastTransactionDate DATE
AFTER emailAddress;

-- A statement that drops a column
ALTER TABLE customers DROP lastTransactionDate;

-- A statement that renames a column
ALTER TABLE customers 
CHANGE emailAddress email VARCHAR(255) NOT NULL UNIQUE;

-- A statement that changes the definition of a column
ALTER TABLE customers MODIFY firstName VARCHAR(100) NOT NULL;

-- A statement that changes the data type of a column
ALTER TABLE customers MODIFY firstName CHAR(100) NOT NULL;

-- A statement that may cause data to be lost
ALTER TABLE customers MODIFY firstName VARCHAR(8);

-- A statement that sets the default value of a column
ALTER TABLE customers ALTER firstName SET DEFAULT '';

-- A statement that drops the default value of a column
ALTER TABLE customers ALTER firstName DROP DEFAULT;