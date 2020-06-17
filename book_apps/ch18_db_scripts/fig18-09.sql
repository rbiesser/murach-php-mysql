SELECT firstName, lastName, orderDate
FROM customers 
   INNER JOIN orders 
      ON customers.customerID = orders.customerID
ORDER BY orderDate