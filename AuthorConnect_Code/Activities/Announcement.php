<?php

class Announcement extends AuthorPost
{

    public function __construct(string $Heading, string $Description, string $date)
    {
        parent::__construct($Heading, $Description, $date);
    }

    public function addAnnouncementToDB(array $new_Announcement)
    {
        require '../DBConfig.php';
        require '../src/DBconnect.php';
        //This line of code will insert our data into a table
        $sql = sprintf("INSERT INTO %s (%s) values (%s)", "author_action", implode(", ",
            array_keys($new_Announcement)), ":" . implode(", :", array_keys($new_Announcement)));
        $statement = $connection->prepare($sql);
        $statement->execute($new_Announcement);
    }

}