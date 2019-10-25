# PHP-CRUD-template
a template for Create Read Update and Delete operations on oo php

# INSTRUCTIONS

# 1, create a database
create a database and give it a name of your liking.

# 2. Create repairs table

use this sql script;
        CREATE TABLE `emmanuelcg`.`repairs` ( `id` INT NOT NULL AUTO_INCREMENT , `deviceName` VARCHAR(255) NOT NULL , `Customer` VARCHAR(255) NOT NULL , `problemDescription` TEXT NOT NULL , `servicedBy` VARCHAR(255) NOT NULL , `imeiNumber` BIGINT NOT NULL , `date` DATE NOT NULL , `cost` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

# 3. Configure the environment
Go to the config directory, open the conf.php file and past this code;
        define('ROOT_URL', 'http/localhost/crud/'); //document root
        define('DB_HOST', 'localhost'); //host
        define('DB_NAME', 'yourDatabaseName'); //your database
        define('DB_USER', 'user'); // user = your username
        define('DB_PASS', 'password'); // your password. leave blank ('') if you do not use a password

Save the file and close

# 4. Use the app

navigate to the index.php and play with the code 🎉🎈

