# SimpleComputerPartsMgmt

Hello good day! 

This is a very simple computer parts management system implemented using PHP and mySQL.

I have included the php files under htdocs folder and the mySQL scripts (create database/table and insert to table) under mySQL scripts folder.

Note: The scripts should be executed on order. I took the liberty of adding numbers to the file name to know the sequence of execution.

To run this simple application, 1st you need to execute the create and insert scripts in mySQL. Once that's done you need to update the variables:
- $dbHost
- $dbUsername
- $dbPassword
- $dbName

As those might change depending on your setup.

After the setup you may be able to run via cmd using the command "php -S localhost:<port number>"
 
Note: As the developer, I request that you put the index.php in "htdocs" folder and access the application via "localhost:<port number>/htdocs" as I have created a functionality to redirect to htdocs (making that as the home page)

