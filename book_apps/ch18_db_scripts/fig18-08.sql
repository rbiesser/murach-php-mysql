SELECT productName, listPrice, discountPercent
FROM products
WHERE listPrice < 500
ORDER BY productName

SELECT productName, listPrice, discountPercent
FROM products
WHERE listPrice < 500
ORDER BY listPrice DESC

SELECT productName, listPrice, discountPercent
FROM products
ORDER BY discountPercent, listPrice DESC