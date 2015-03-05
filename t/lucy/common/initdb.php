<?php
function checkDatabaseTables() {
     $helper=new SQLHelper();
     $sql="CREATE TABLE if not exists users (ID int NOT NULL AUTO_INCREMENT, PRIMARY KEY (ID));";
     $helper->doSQL($sql);	// try and create user table
     $sql="ALTER TABLE users ADD COLUMN username varchar(50)";
     $helper->doSQL($sql);	// Add in column
     $sql="ALTER TABLE users ADD COLUMN email varchar(50)";
     $helper->doSQL($sql);	// Add in column
     $sql="ALTER TABLE users ADD COLUMN mobile varchar(50)";
     $helper->doSQL($sql);	// Add in column
     $sql="ALTER TABLE users ADD COLUMN password varchar(100)";
     $helper->doSQL($sql);	// Add in column
     $sql="ALTER TABLE users ADD COLUMN validationID varchar(100)";
     $helper->doSQL($sql);	// Add in column
     $sql="ALTER TABLE users ADD COLUMN emailConfirmed tinyint default 0";
     $helper->doSQL($sql);	// Add in column
        
     
     
     // Address table
     $sql="CREATE TABLE if not exists addresses (ID int NOT NULL AUTO_INCREMENT, PRIMARY KEY (ID));";
     $helper->doSQL($sql);	// try and create user table
     $sql="ALTER TABLE addresses ADD COLUMN userid int";
     $helper->doSQL($sql);	// Add in column
     $sql="ALTER TABLE  addresses ADD COLUMN houseNameNumber varchar(20)";
     $helper->doSQL($sql);	// Add in column
     $sql="ALTER TABLE  addresses ADD COLUMN postcode varchar(15)";
     $helper->doSQL($sql);	// Add in column
     $sql="ALTER TABLE  addresses ADD COLUMN posttown varchar(30)";
     $helper->doSQL($sql);	// Add in column
        
     // TODO Add in more tables and table definitions here
     
     
     $helper->close();		// close connection


}

checkDatabaseTables();

?>
