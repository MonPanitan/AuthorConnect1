<?php

namespace Activities;

use Book_storage\Book;

class Publish
{
    public int $publishID;
    public \Author $author;
    public Book $book;

    //CONSTRUCT
    public function __construct(int $UserID, int $roleID)//Publish must contain book as well
    {
        $this->author = $UserID;
    }

    /**
     * @return int
     */
    public function getPublishID(): int
    {
        return $this->publishID;
    }

    /**
     * @param int $publishID
     */
    public function setPublishID(int $publishID): void
    {
        $this->publishID = $publishID;
    }

    //FUNCTION
    public function getAuthorNamePublish()
    {
        return $this->author->getFirstName();
    }

    //This will get book with Authorname
    public function getBook(Book $book)
    {

        return $this->book = $book;
    }


    //To string
    public function __toString(): string
    {
        return "publishID: " . $this->publishID
            . "\nBook: " . $this->book;
    }
}