<?php
//This file will install a DB and create a requires Table into DB
require "DBConfig.php";

try{
    $connection = new PDO("mysql:host=localhost",$username, $password, $options);
    $sql = file_get_contents("data/init.sql"); // get content from init.sql file
    $connection->exec($sql);// tell connection to execute the sql query

    //if successful will print below
    echo "DB and table users created successfully";

}catch (PDOException $error){
    echo $sql . "<br>" . $error->getMessage();// print out the error message
}
