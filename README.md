# Sales and Inventory Management System for a Hardware Store
This is a Point-of-Sale system that keeps track of sales, inventory, returned items, suppliers, and purchases from suppliers. This was created by the Slayce group for a CMSC-128 project.

Additional features:
* Trash section for deleted items
* Export sale summaries, supplier transactions, and inventory
* Backup database

Set-up:
1. Install xampp. Open xampp and start the Apache and mySQL servers.
2. Open the browser and go to phpmyadmin through http://localhost/phpmyadmin/
3. Open the db.sql file in env folder. At the end of the file, modify the username and password to fit your preferences. The default username is "Username 1" and the password is "123".
3. Click on the import tab then choose the db.sql file inside the env folder. Click open then click the Go button at the bottom right corner of the windows. This will create a new database ‘hardware’ with the tables needed.
4. Import items.csv, suppliers.csv, supplier_items.csv, and inventory.csv in the corresponding tables to populate the database.

