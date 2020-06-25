/*****************************************
* Create the shopping_cart database
*****************************************/
DROP DATABASE IF EXISTS shopping_cart;
CREATE DATABASE shopping_cart;
USE shopping_cart;  -- MySQL command

-- create the users and grant priveleges to those users
GRANT SELECT, INSERT, DELETE, UPDATE
ON shopping_cart.*
TO user@'%'
IDENTIFIED BY 'pa55word';

GRANT SELECT
ON products
TO tester@'%'
IDENTIFIED BY 'pa55word';

-- create the tables for the database
CREATE TABLE customers (
  customerID        INT            NOT NULL   AUTO_INCREMENT,
  emailAddress      VARCHAR(255)   NOT NULL,
  password          VARCHAR(60)    NOT NULL,
  firstName         VARCHAR(60)    NOT NULL,
  lastName          VARCHAR(60)    NOT NULL,
  shipAddressID     INT                       DEFAULT NULL,
  billingAddressID  INT                       DEFAULT NULL,  
  PRIMARY KEY (customerID),
  UNIQUE INDEX emailAddress (emailAddress)
);

CREATE TABLE addresses (
  addressID         INT            NOT NULL   AUTO_INCREMENT,
  customerID        INT            NOT NULL,
  line1             VARCHAR(60)    NOT NULL,
  line2             VARCHAR(60)               DEFAULT NULL,
  city              VARCHAR(40)    NOT NULL,
  state             VARCHAR(2)     NOT NULL,
  zipCode           VARCHAR(10)    NOT NULL,
  phone             VARCHAR(12)    NOT NULL,
  disabled          TINYINT(1)     NOT NULL   DEFAULT 0,
  PRIMARY KEY (addressID),
  INDEX customerID (customerID)
);

CREATE TABLE orders (
  orderID           INT            NOT NULL   AUTO_INCREMENT,
  customerID        INT            NOT NULL,
  orderDate         DATETIME       NOT NULL,
  shipAmount        DECIMAL(10,2)  NOT NULL,
  taxAmount         DECIMAL(10,2)  NOT NULL,
  shipDate          DATETIME                  DEFAULT NULL,
  shipAddressID     INT            NOT NULL,
  cardType          INT            NOT NULL,
  cardNumber        CHAR(16)       NOT NULL,
  cardExpires       CHAR(7)        NOT NULL,
  billingAddressID  INT            NOT NULL,
  PRIMARY KEY (orderID), 
  INDEX customerID (customerID)
);

CREATE TABLE orderItems (
  itemID            INT            NOT NULL   AUTO_INCREMENT,
  orderID           INT            NOT NULL,
  productID         INT            NOT NULL,
  itemPrice         DECIMAL(10,2)  NOT NULL,
  discountAmount    DECIMAL(10,2)  NOT NULL,
  quantity          INT NOT NULL,
  PRIMARY KEY (itemID), 
  INDEX orderID (orderID), 
  INDEX productID (productID)
);

CREATE TABLE products (
  productID         INT            NOT NULL   AUTO_INCREMENT,
  categoryID        INT            NOT NULL,
  productCode       VARCHAR(10)    NOT NULL,
  productName       VARCHAR(255)   NOT NULL,
  description       TEXT           NOT NULL,
  listPrice         DECIMAL(10,2)  NOT NULL,
  discountPercent   DECIMAL(10,2)  NOT NULL   DEFAULT 0.00,
  dateAdded         DATETIME       NOT NULL,
  PRIMARY KEY (productID), 
  INDEX categoryID (categoryID), 
  UNIQUE INDEX productCode (productCode)
);

CREATE TABLE administrators (
  adminID           INT            NOT NULL   AUTO_INCREMENT,
  emailAddress      VARCHAR(255)   NOT NULL,
  password          VARCHAR(255)   NOT NULL,
  firstName         VARCHAR(255)   NOT NULL,
  lastName          VARCHAR(255)   NOT NULL,
  PRIMARY KEY (adminID)
);