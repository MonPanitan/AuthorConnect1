<?php

class Survey extends AuthorPost
{
    public string $answer1;
    public string $answer2;
    public string $answer3;


    public function __construct(string $Heading, string $Description, string $date, string $answer1, string $answer2, string $answer3)
    {
        parent::__construct($Heading, $Description, $date);
        $this->answer1 = $answer1;
        $this->answer2 = $answer2;
        $this->answer3 = $answer3;
    }

    public function addSurveyToDB(array $new_Survey)
    {
        require '../DBConfig.php';
        require '../src/DBconnect.php';

        //This line of code will insert our data into a table
        $sql = sprintf("INSERT INTO %s (%s) values (%s)", "author_action", implode(", ",
            array_keys($new_Survey)), ":" . implode(", :", array_keys($new_Survey)));
        $statement = $connection->prepare($sql);
        $statement->execute($new_Survey);

    }
}
