SELECT COUNT(*) AS productCount
FROM products

SELECT COUNT(*) AS totalCount, 
       COUNT(shipDate) AS shippedCount 
FROM orders

SELECT MIN(listPrice) AS lowestPrice, 
       MAX(listPrice) AS highestPrice, 
       AVG(listPrice) AS averagePrice 
FROM products

SELECT SUM(itemPrice * quantity – discountAmount) AS ordersTotal 
FROM orderItems
