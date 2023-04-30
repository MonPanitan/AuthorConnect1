<?php
include "../Member/User.php";
//Assume that User already created and in DB
$testRole = 1;
$testUsername = "UsernameTesting";
$testPassword = "PasswordTesting";
$testFirstname = "FirstnameTesing";
$testLastname = "LastnameTesting";
$testEmail = "EmailTesting";
$testPhoneNum = 0000000000;

//create an object
$testUser = new User("", "", "", "", "", 1, 0,);

$testUser->setUsername($testUsername);
$testUser->setPassword($testPassword);
$testUser->setFirstname($testFirstname);
$testUser->setLastname($testLastname);
$testUser->setEmail($testEmail);
$testUser->setPhoneNum($testPhoneNum);
$testUser->setRole($testRole);

//set value for book and requirement needed when comment
$testISBn = 11333;
$testgenreID = 1;
$testDate = "30/4/23";
$testComment = "Test Comment for Test case";
$testUserID = 1; //it's auto increment in the actual DB

//this is a requirement to add to DB
$testReview = array(
    //ReviewID,ISBN,genreID,UserID,roleID,Date,Comment
    "Book_ISBN" => $testISBn,
    "Book_genreID" => $testgenreID,
    "UserID" => $testUserID, //get User ID
    "roleID" => $testRole,
    "Date" => $testDate,
    "Comment" => $testComment,
);

//User Write a review
$testUser->writeReview($testISBn, $testDate, $testComment, $testUserID, $testRole, $testReview);

//Test case fail but works in actual website