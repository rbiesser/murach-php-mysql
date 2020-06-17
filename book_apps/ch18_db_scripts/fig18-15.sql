INSERT INTO products
VALUES (DEFAULT, 1, 'tele', 'Fender Telecaster', 'NA', 
        '949.99', DEFAULT, NOW())

INSERT INTO products
    (categoryID, productCode, productName, description, 
     listPrice, dateAdded)
VALUES
    (1, 'tele', 'Fender Telecaster', 'NA', 
     '949.99', NOW())

INSERT INTO categories (categoryID, categoryName) VALUES
(4, 'Keyboards'),
(5, 'Brass'),
(6, 'Woodwind')
