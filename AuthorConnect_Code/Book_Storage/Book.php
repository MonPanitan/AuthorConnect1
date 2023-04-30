<?php

namespace Book_storage;

use Activities\Publish;
use Activities\Review;

class Book
{
    private string $book_isbn;
    private string $book_name;
    private string $book_desc;
    private string $book_author;
    private string $book_genre;
    private string $image;
    private float $rating;
    private array $reviews;

    /**
     * @return string
     */
    public function getBookIsbn(): string
    {
        return $this->book_isbn;
    }

    /**
     * @param string $book_isbn
     */
    public function setBookIsbn(string $book_isbn): void
    {
        $this->book_isbn = $book_isbn;
    }

    /**
     * @return string
     */
    public function getBookName(): string
    {
        return $this->book_name;
    }

    /**
     * @param string $book_name
     */
    public function setBookName(string $book_name): void
    {
        $this->book_name = $book_name;
    }

    /**
     * @return string
     */
    public function getBookDesc(): string
    {
        return $this->book_desc;
    }

    /**
     * @param string $book_desc
     */
    public function setBookDesc(string $book_desc): void
    {
        $this->book_desc = $book_desc;
    }

    /**
     * @return string
     */
    public function getBookGenre(): string
    {
        return $this->book_genre;
    }

    /**
     * @param string $book_genre
     */
    public function setBookGenre(string $book_genre): void
    {
        $this->book_genre = $book_genre;
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    /**
     * @return float
     */
    public function getRating(): float
    {
        return $this->rating;
    }

    /**
     * @param float $rating
     */
    public function setRating(float $rating): void
    {
        $this->rating = $rating;
    }

    //CONSTRUCT
    public function __construct(string $book_isbn, string $book_name, string $book_desc)
    {
        $this->book_name = $book_name;
        $this->book_isbn = $book_isbn;
        $this->book_desc = $book_desc;
    }


    public function setbook_Author(Publish $publish)
    {
        $this->book_author = $publish->getAuthorNamePublish();
    }

    public function getbook_Author()
    {
        return $this->book_author;
    }

    public function addReview(Review $review)
    {
        $this->reviews[] = $review;
    }

    public function getReview()
    {
        return $this->reviews;
    }


    public function addBookToDB(array $new_book)
    {
        require '../DBConfig.php';
        require '../src/DBconnect.php';

        //This line of code will insert our data (NEW BOOK) into a table
        $sql = sprintf("INSERT INTO %s (%s) values (%s)", "book", implode(", ",
            array_keys($new_book)), ":" . implode(", :", array_keys($new_book)));
        $statement = $connection->prepare($sql);
        $statement->execute($new_book);
    }

    public function setgenre(Genre $genreID)
    {
        //this fucntion will get and set genre of book.
        $this->book_genre = $genreID->getGenreName();
    }

    //display book details?

    public function __toString(): string
    {
        return "Book Name: " . $this->book_name
            . "\nBook ISBN: " . $this->book_isbn
            . "\nBook Desc: " . $this->book_desc
            . "\nBook Author: " . $this->book_author
            . "\nBook Genre: " . $this->book_genre;
    }
}