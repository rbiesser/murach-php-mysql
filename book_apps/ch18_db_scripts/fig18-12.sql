SELECT categoryID, COUNT(categoryID) AS productCount, 
       AVG(listPrice) AS averageListPrice
FROM products
GROUP BY categoryID
HAVING productCount > 0
ORDER BY productCount

SELECT categoryName, COUNT(*) AS productCount,
       AVG(listPrice) AS averageListPrice
FROM products p JOIN categories c
   ON p.categoryID = c.categoryID 
GROUP BY categoryName
HAVING averageListPrice > 400

SELECT categoryName, COUNT(*) AS productCount,
       AVG(listPrice) AS averageListPrice
FROM products p JOIN categories c
   ON p.categoryID = c.categoryID 
WHERE averageListPrice > 400
GROUP BY categoryName
