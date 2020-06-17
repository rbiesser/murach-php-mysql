UPDATE table_name
SET column_name_1 = expression_1 [, column_name_2 = expression_2]...
[WHERE search_condition]

UPDATE products
SET discountPercent = '10.00'
WHERE productName = 'Fender Telecaster'

UPDATE products
SET discountPercent = '25.00', 
    description = 'This guitar has great tone and smooth playability.'
WHERE productName = 'Fender Telecaster'

UPDATE products
SET discountPercent = '15.00'
WHERE categoryID = 2

UPDATE products
SET discountPercent = '15.00'

UPDATE orders
SET shipAmount = 0
WHERE customerID IN
   (SELECT customerID
    FROM customers
    WHERE lastName = 'Sherwood')
