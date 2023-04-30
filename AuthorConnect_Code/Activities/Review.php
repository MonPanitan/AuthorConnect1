<?php

class Review
{
    private int $reviewID;
    private string $date;
    private string $comment;

    //Author
    //User is composition
    private int $UserID;
    private int $roleID;

    //Book is aggregation
    private string $book_ISBN;
    private int $book_genreID;


    public function __construct(string $book_ISBN, string $date, string $comment)
    {
        $this->book_ISBN = $book_ISBN;
        $this->date = $date;
        $this->comment = $comment;
    }


    public function addReviewToDB(array $newReview)
    {
        require '../DBConfig.php';
        require '../src/DBconnect.php';

        //This line of code will insert our data into a table
        $sql = sprintf("INSERT INTO %s (%s) values (%s)", "review", implode(", ",
            array_keys($newReview)), ":" . implode(", :", array_keys($newReview)));
        $statement = $connection->prepare($sql);
        $statement->execute($newReview);

    }

    /**
     * @return int
     */
    public function getUserID(): int
    {
        return $this->UserID;
    }

    /**
     * @param int $UserID
     */
    public function setUserID(int $UserID): void
    {
        $this->UserID = $UserID;
    }

    /**
     * @return int
     */
    public function getRoleID(): int
    {
        return $this->roleID;
    }

    /**
     * @param int $roleID
     */
    public function setRoleID(int $roleID): void
    {
        $this->roleID = $roleID;
    }

}