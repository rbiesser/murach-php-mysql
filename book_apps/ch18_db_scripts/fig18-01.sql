SELECT * FROM products;

SELECT productID, productName, listPrice
FROM products
ORDER BY listPrice;

SELECT productID, productName, listPrice
FROM products
WHERE listPrice < 450
ORDER BY listPrice;

SELECT productID, productName, listPrice
FROM products
WHERE listPrice < 10;


