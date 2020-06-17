SELECT orderID, orderDate, shipDate
FROM orders

SELECT orderID, orderDate, shipDate
FROM orders 
WHERE shipDate IS NULL

SELECT orderID, orderDate, shipDate
FROM orders 
WHERE shipDate IS NOT NULL