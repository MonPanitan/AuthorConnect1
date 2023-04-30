<?php

namespace System;

use src\PDO;
use src\PDOException;

class automateSystem
{
    public function getUserDetail(string $username, $password)
    {
        //pass in a username to get all detail
        require "../DBConfig.php";
        try {
            //Connect to DB
            require_once '../src/DBconnect.php';
            //IF STATEMENT to check if new username is same as contains in db or not.
            $dbUsername = "SELECT *
            FROM user
            WHERE username = :username";

            $statement = $connection->prepare($dbUsername);
            $statement->bindParam(':username', $username, PDO::PARAM_STR);
            $statement->bindParam(':password', $password, PDO::PARAM_STR);
            $statement->execute();
            $result = $statement->fetchAll();

            $loginUser = new \User();

            if ($result && $statement) {
                require "../common.php";
                foreach ($result as $key => $value) {
                    if ($key == 'UserID')
                        $loginUser->setUserID($value);
                    if ($key == 'Username')
                        $loginUser->setUsername($value);
                    if ($key == 'Password')
                        $loginUser->setPassword($value);
                    if ($key == 'firstname')
                        $loginUser->setFirstname($value);
                    if ($key == 'lastname')
                        $loginUser->setLastname($value);
                    if ($key == 'Email')
                        $loginUser->setEmail($value);
                    if ($key == 'Phone_Num')
                        $loginUser->setPhoneNum($value);


                }
                return $loginUser;
            }

        } catch (PDOException $error) {
            echo $dbUsername . "<br" . $error->getMessage();
        }
    }

    //Delete Author Action from Database
    public function deleteActionFromDB(int $PostID)
    {
        try {
            require_once '../src/DBconnect.php';

            $PostID = $PostID;

            $sql = 'DELETE FROM author_action WHERE PostID = :PostID';
            $statement = $connection->prepare($sql);
            $statement->bindValue(':PostID', $PostID);
            $statement->execute();

            $success = "post " . $PostID . " successfully deleted";
            echo $success;
        } catch (PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
        }
    }

    public function deleteReviewFromDB(int $ReviewID)
    {
        try {
            require_once '../src/DBconnect.php';

            $ReviewID = $ReviewID;

            $sql = 'DELETE FROM review WHERE ReviewID = :ReviewID';
            $statement = $connection->prepare($sql);
            $statement->bindValue(':ReviewID', $ReviewID);
            $statement->execute();

            $success = "Review " . $ReviewID . " successfully deleted";
            echo $success;
        } catch (PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
        }
    }

}