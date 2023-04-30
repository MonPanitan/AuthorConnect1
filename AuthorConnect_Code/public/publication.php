<?php
//This webpage will publish a book
include "../Book_Storage/Book.php";
include "../Book_Storage/Genre.php";


//Connect to DB
if (isset($_POST['submit'])) {
    require_once "../common.php";
    try {
        //Connect to the DB
        require_once '../src/DBconnect.php';

        //insert new book code will go here
        //Create new objects and add that object into the DB
        //escape method will take an input the sanitize in common.php file
        //Create new PublishID
//        $insertPublishID = "INSERT INTO publish (publishID, authorID) VALUES ()"

        //---------------------------------------------------------------------------------------
        //GET USER ID FROM DB
        $authorName = $_POST['author'];
        //SQL search for author
        $sqlAuthor = "SELECT *
        FROM user
        WHERE username = :username";

        $statement = $connection->prepare($sqlAuthor);
        $statement->bindParam(':username', $authorName, PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetchAll();


        //declared UserID
        $curr_UserID = null;
        $curr_roleID = null;
        $curr_publishID = null;


        //GET USER ID and ROLE ID
        if ($statement->rowCount() > 0) {
            foreach ($result as $row) {
                $curr_UserID = $row["UserID"];
                $curr_roleID = $row["roleID"];
            }

//                echo "The userId of user $authorName is $curr_UserID";
        } else {
            // User doesn't exist in the database
            echo "User $authorName not found";
        }
        //--------------------------------------------------------------------------

        //new publish ID
        $new_publish = array(
            "UserID" => $curr_UserID,
            "roleID" => $curr_roleID
        );

        //SQL statement insert to DB
        $sql = sprintf("INSERT INTO %s (%s) values (%s)", "publish", implode(", ",
            array_keys($new_publish)), ":" . implode(", :", array_keys($new_publish)));
        $statement = $connection->prepare($sql);
        $statement->execute($new_publish);

        //------------------------------------------------------------------------------------
        //Retrieve(GET) Publish ID from DB to use in publishing Book
        $curr_publishID = $connection->lastInsertId();


        //---------------------------------------------------------------
        //Create Book
        $book_name = escape($_POST['bookName']);
        $genreID = escape($_POST['genre']);
        $book_isbn = escape($_POST['isbn']);
        $publishID = escape($curr_publishID);
        $book_desc = escape($_POST['book_Desc']);

        $addBook = new \Book_storage\Book($book_isbn, $book_name, $book_desc, $genreID, $publishID);

//        $addBook = new ($bookISBN, $bookName, $description, $genreID, $publishID);
        //CREATE NEW BOOK THEN ADD TO DB

        $new_book = array(
            "bookName" => $addBook->getBookName(),
            "genreID" => $genreID, //Need to convert to genre ID
            "ISBN" => $addBook->getBookIsbn(),
            "publishID" => $publishID,
            "description" => $addBook->getBookDesc(),
//            "image" => escape("NULL"),
        );


        //END CREATE NEW BOOK
//        //----------------------------------------------------------
//
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }

}
//Select GenreID

//include header page
include_once "templates/header.php";
?>


    <h1>This is a Publication Page</h1>
    <!-- Publication page will contain book input detail form -->

    <form method="post">
        <p>Book Publication:</p>

        <!-- Book Name -->
        <label for="bookName">Book Name:</label>
        <input type="text" name="bookName" id="bookName" required>

        <!-- Genre -->
        <label for="genre">Please Select Genre:</label>
        <select id="genre" name="genre">
            <!--This option will read from DB-->
            <!-- HARD CODE FOR NOW -->
            <option value="1">Horror</option> <!-- Horror value -->
            <option value="2">Comedy</option> <!-- Comedy Value -->
            <option value="3">Action</option> <!-- Action Value -->
        </select>

        <!-- ISBN -->
        <label for="isbn">Book ISBN: (Start with 978 or 979)</label>
        <input type="number" name="isbn" id="isbn" maxlength="13" pattern="^(97(8|9))?\d{9}(\d|X)$">

        <!-- Author -->

        <label for="author">Author:</label>
        <input type="text" name="author" id="author" value="<?php echo $_SESSION['username'] ?>" readonly>
        <!-- Does not allow to change the author name-->
        <!-- This section will take firstname and last name from who ever publish-->

        <!-- Image -->
        <!-- How to do image? -->

        <!-- Book Description -->
        <label for="book_Desc">Book Description:</label>
        <textarea name="book_Desc" rows="13" cols="80">Sample text in text field</textarea>

        <br><br>
        <!-- Publish Button -->
        <input type="submit" name="submit" value="Publish">
    </form>

<?php include_once "templates/footer.php"; ?>