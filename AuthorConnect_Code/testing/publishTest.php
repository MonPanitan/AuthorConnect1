<?php
include "../Book_Storage/Book.php";

//Publish a book
$testIsbn = 2983423;
$testName = "TestBookName";
$testDesc = "Test Description";
$testGenreID = 2;
$testPublishID = 555;

try {

    $testBook = new \Book_storage\Book($testIsbn, $testName, $testDesc, $testGenreID, $testPublishID);

    $new_book = array(
        "bookName" => $testBook->getBookName(),
        "genreID" => $testGenreID, //Need to convert to genre ID
        "ISBN" => $testBook->getBookIsbn(),
        "publishID" => $testPublishID,
        "description" => $testBook->getBookDesc(),
    );
    $testBook->addBookToDB($new_book);
} catch (PDOException $error) {
    echo $error;
}


