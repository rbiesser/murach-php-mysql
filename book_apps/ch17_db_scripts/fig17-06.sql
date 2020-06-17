DROP DATABASE IF EXISTS MikesMusic6;

CREATE DATABASE MikesMusic6;

USE MikesMusic6;

-- A table with a column-level primary key
DROP TABLE IF EXISTS customers;
CREATE TABLE customers (
  customerID    INT           NOT NULL   PRIMARY KEY  AUTO_INCREMENT,
  emailAddress  VARCHAR(255)  NOT NULL   UNIQUE,
  firstName     VARCHAR(30)   NOT NULL
);

INSERT INTO customers 
VALUES(1, 'joelmurach@yahoo.com', 'Joelhasalongfirstname');

DROP TABLE customers;
