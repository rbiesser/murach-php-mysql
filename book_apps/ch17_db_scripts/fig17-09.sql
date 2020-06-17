CREATE USER joel
IDENTIFIED BY 'sesame';

RENAME USER joel
TO joelmurach;

GRANT USAGE
ON *.*
TO joelmurach
IDENTIFIED BY 'newpassword';

DROP USER joelmurach;