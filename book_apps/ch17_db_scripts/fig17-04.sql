DROP DATABASE IF  EXISTS MikesMusic4;

CREATE DATABASE MikesMusic4;

USE MikesMusic4;

-- A table with a column-level primary key
CREATE TABLE customers1 (
  customerID    INT           NOT NULL   PRIMARY KEY  AUTO_INCREMENT,
  emailAddress  VARCHAR(255)  NOT NULL   UNIQUE
);

-- A table with a table-level primary key
CREATE TABLE customers2 (
  customerID    INT           NOT NULL   AUTO_INCREMENT,
  emailAddress  VARCHAR(255)  NOT NULL   UNIQUE, 

  PRIMARY KEY (customerID) 
);

-- A table with a two-column primary key
CREATE TABLE orderItems (
  orderID         INT            NOT NULL,
  productID       INT            NOT NULL,
  itemPrice       DECIMAL(10,2)  NOT NULL,
  discountAmount  DECIMAL(10,2)  NOT NULL,
  quantity        INT            NOT NULL,

  PRIMARY KEY (orderID, productID)
);
