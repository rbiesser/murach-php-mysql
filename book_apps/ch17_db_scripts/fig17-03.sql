CREATE DATABASE IF NOT EXISTS my_guitar_shop2;

USE my_guitar_shop2;

-- A statement that creates a table with column attributes
DROP TABLE IF EXISTS customers3a;
CREATE TABLE customers3a
(
  customerID  INT,
  firstName   VARCHAR(60),
  lastName    VARCHAR(60)
);

DROP TABLE IF EXISTS customers3b;
CREATE TABLE customers3b
(
  customerID  INT           NOT NULL   UNIQUE,
  firstName   VARCHAR(60)   NOT NULL,
  lastName    VARCHAR(60)   NOT NULL
);

-- Another statement that creates a table with column attributes
DROP TABLE IF EXISTS orders;
CREATE TABLE orders
(
  orderID      INT           NOT NULL   UNIQUE,
  vendorID     INT           NOT NULL,
  orderNumber  VARCHAR(50)   NOT NULL,
  orderDate    DATE          NOT NULL,
  orderTotal   DECIMAL(9,2)  NOT NULL,
  paymentTotal DECIMAL(9,2)             DEFAULT 0
);