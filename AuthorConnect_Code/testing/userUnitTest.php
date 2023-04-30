<?php
include "../Member/User.php";
//Testing Register
//This refers to register page

//Testing variable
$testRole = 1;
$testUsername = "UsernameTesting";
$testPassword = "PasswordTesting";
$testFirstname = "FirstnameTesing";
$testLastname = "LastnameTesting";
$testEmail = "EmailTesting";
$testPhoneNum = 0000000000;

//perform a test
$testUser = new User("", "", "", "", "", 1, 0,);
echo "Before: \n";

displayUser($testUser);


//add a data to variable

$testUser->setUsername($testUsername);
$testUser->setPassword($testPassword);
$testUser->setFirstname($testFirstname);
$testUser->setLastname($testLastname);
$testUser->setEmail($testEmail);
$testUser->setPhoneNum($testPhoneNum);
$testUser->setRole($testRole);

echo "\n";

echo "After: ";
"\n";
displayUser($testUser);


function displayUser($testUser)
{
    echo "Username: " . $testUser->getUsername() . "\n";
    echo "Password: " . $testUser->getPassword() . "\n";
    echo "Firstname: " . $testUser->getFirstname() . "\n";
    echo "Lastname: " . $testUser->getLastname() . "\n";
    echo "Email: " . $testUser->getEmail() . "\n";
    echo "PhoneNum: " . $testUser->getPhoneNum() . "\n";
    echo "Role: " . $testUser->getRole() . "\n";
}