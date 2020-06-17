SELECT productName FROM products
WHERE productName LIKE 'Fender%'

SELECT productName FROM products
WHERE productName LIKE '%cast%'

SELECT zipCode FROM addresses
WHERE zipCode LIKE '076__'

SELECT orderDate FROM orders
WHERE orderDate LIKE '2010-06-__%'
