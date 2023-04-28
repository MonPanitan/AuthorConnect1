<?php

class Author extends User
{
    private int $roleID;

    //Passing in a book obj
    private Book $book;
    public Publish $publishID;

    //constructor
    public function __construct(string $Username, string $password, string $firstname, string $lastname, string $email, int $phone_num, string $dob)
    {
        parent::__construct($Username, $password, $firstname, $lastname, $email, $phone_num, $dob);
        $this->roleID = 2;
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

    //FUNCTION
    //This publishing will connect to DB and perform and Create to Both Publish and Book Object.
    //This function will check if Both publishing and Book is successfully created then perform connect DB and create object.
    public function publishBook(\Activities\Publish $bookobj)
    {
        return $bookobj;
        echo $bookobj;
    }

    public function createSurvey()
    {

    }

    public function createAnnouncement()
    {

    }

    public function createEvent()
    {

    }

    public function deleteBook()
    {

    }
}