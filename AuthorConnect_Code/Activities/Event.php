<?php

class Event extends AuthorPost
{

    public string $eventPlace;
    public string $time;
    public int $price;

    public function __construct(string $Heading, string $Description, string $date, string $eventPlace, string $time, int $price)
    {
        parent::__construct($Heading, $Description, $date);
        $this->eventPlace = $eventPlace;
        $this->time = $time;
        $this->price = $price;
    }

    public function addEventToDB(array $new_Event)
    {
        require '../DBConfig.php';
        require '../src/DBconnect.php';

        //This line of code will insert our data into a table
        $sql = sprintf("INSERT INTO %s (%s) values (%s)", "author_action", implode(", ",
            array_keys($new_Event)), ":" . implode(", :", array_keys($new_Event)));
        $statement = $connection->prepare($sql);
        $statement->execute($new_Event);
    }
}