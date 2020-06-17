-- the subquery
SELECT AVG(listPrice) FROM products

-- the query
SELECT productName, listPrice
FROM products
WHERE listPrice > (SELECT AVG(listPrice) FROM products)
ORDER BY listPrice DESC

-- the subquery
SELECT categoryID FROM categories WHERE categoryName = 'Basses'

-- the query
SELECT productName, listPrice
FROM products
WHERE categoryID = (SELECT categoryID FROM categories WHERE categoryName = 'Basses')
