SELECT COUNT(*) FROM products
WHERE categoryID = 32;

SELECT categoryID, categoryName,  
    (SELECT COUNT(*) FROM products
     WHERE products.categoryID = categories.categoryID) AS productCount
FROM categories
WHERE categoryID = 32;

SELECT categoryID, categoryName,  
      (SELECT COUNT(*) FROM products p
       WHERE p.categoryID = c.categoryID) AS productCount
FROM categories c
