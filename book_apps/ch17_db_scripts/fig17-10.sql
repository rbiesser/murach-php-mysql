-- Example 1: Create a user with no privileges
GRANT USAGE
ON *.* 
TO joel IDENTIFIED BY 'sesame';

-- Example 2: Create a user with database privileges
GRANT SELECT, INSERT, UPDATE, DELETE
ON MikesMusic.*
TO mmuser IDENTIFIED BY 'pa55word';

-- Example 3: Create a user with global privileges
GRANT ALL 
ON *.*
TO dba IDENTIFIED BY 'supersecret'
WITH GRANT OPTION;

-- Example 4: Grants table privileges to a user
GRANT SELECT, INSERT, UPDATE
ON MikesMusic.products TO joel;

-- Example 5: Grant database privileges to a user
GRANT SELECT, INSERT, UPDATE
ON MikesMusic.* TO joel;

-- Example 6: Grant global privileges to a user
GRANT SELECT, INSERT, UPDATE
ON *.* TO joel;

-- Example 7: Grants column privileges to a user
GRANT SELECT (name, description, listPrice), UPDATE (description)
ON MikesMusic.products TO joel;

-- Example 8: Use the default database
GRANT SELECT, INSERT, UPDATE, DELETE
ON customers TO joel;

-- Example 9: Create multiple users
GRANT SELECT, INSERT, UPDATE, DELETE
ON MikesMusic.*
TO mike IDENTIFIED BY 'pa55word',
   anne IDENTIFIED BY 'pa55word',
   ben IDENTIFIED BY 'pa55word'
WITH GRANT OPTION;

-- Test
GRANT CREATE
ON MikesMusic.*
TO joel;

DROP USER mike, anne, ben;

