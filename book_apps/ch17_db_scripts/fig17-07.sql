DROP DATABASE IF EXISTS MikesMusic7;

CREATE DATABASE MikesMusic7;

USE MikesMusic7;

-- use CREATE TABLE to create indexes
CREATE TABLE customers (
  customerID    INT           NOT NULL   AUTO_INCREMENT,
  emailAddress  VARCHAR(255)  NOT NULL, 
  firstName     VARCHAR(60)   NOT NULL, 

  PRIMARY KEY (customerID), 
  UNIQUE INDEX emailAddress (emailAddress), 
  INDEX firstName (firstName)
);

CREATE TABLE orders
(
  orderID      INT           NOT NULL    AUTO_INCREMENT,
  customerID   INT           NOT NULL,
  orderNumber  VARCHAR(50)   NOT NULL,
  orderTotal   DECIMAL(8,2)  NOT NULL,
  
  PRIMARY KEY (orderID), 
  INDEX customerID (customerID), 
  INDEX orderTotal (orderTotal DESC), 
  UNIQUE INDEX customerIDorderNumber (customerID, orderNumber)
);

CREATE TABLE addresses
(
  addressID   INT           NOT NULL    AUTO_INCREMENT,
  customerID  INT           NOT NULL,
  address1    VARCHAR(50)   NOT NULL,
  
  PRIMARY KEY (addressID), 
  INDEX customerID (customerID)
);

-- drop all indexes
DROP INDEX emailAddress ON customers;
DROP INDEX firstName ON customers;
DROP INDEX customerID ON orders;
DROP INDEX orderTotal ON orders;
DROP INDEX customerIDorderNumber ON orders;

-- recreate all indexes
CREATE UNIQUE INDEX emailAddress ON customers (emailAddress);
CREATE INDEX firstName ON customers (firstName);
CREATE INDEX customerID ON orders (customerID);
CREATE INDEX orderTotal ON orders (orderTotal DESC);
CREATE UNIQUE INDEX customerIDorderNumber ON orders (customerID, orderNumber);