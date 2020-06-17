SELECT firstName, lastName, orderDate
FROM customers c
   INNER JOIN orders o
      ON c.customerID = o.customerID
ORDER BY orderDate

SELECT firstName, lastName, o.orderID, name, itemPrice, quantity
FROM customers c
   INNER JOIN orders o
      ON c.customerID = o.customerID
   INNER JOIN orderItems oi
      ON o.orderID = oi.orderID
   INNER JOIN products p
      ON oi.productID = p.productID
ORDER BY o.orderID