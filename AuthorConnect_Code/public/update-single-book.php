<?php
include "templates/header.php";
?>
<?php
//Submit Review
if (isset($_POST['submit'])) {
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

    //Add Review to a DB
    try {
        //Connect to the DB
        require_once '../src/DBconnect.php';

        //Create new Review
        $new_Review = array(
            //ReviewID,ISBN,genreID,UserID,roleID,Date,Comment
            "Book_ISBN" => escape($_GET['ISBN']),
            "Book_genreID" => escape($curr_roleID),//get genre ID
            "UserID" => escape($curr_UserID), //get User ID
            "roleID" => escape($_POST["roleID"]),
            "Date" => escape($_POST["Date"]),
            "Comment" => escape($_POST["Comment"]),
        );
    } catch (PDOException $error) {
        echo $error->getMessage();
    }
}
//------------------------------------------------------------
//get book details (everything from book)
if (isset($_GET['ISBN'])) {
    try {
        require_once '../src/DBconnect.php';
        $isbn = $_GET['ISBN'];

        $sql = "SELECT * FROM book WHERE isbn = :isbn"; //:id is a placeholder
        $statement = $connection->prepare($sql);
        $statement->bindValue(':isbn', $isbn); //replace placeholder with value
        $statement->execute();

        $book = $statement->fetch(PDO::FETCH_ASSOC); // return an array index column

    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }

} else {
    echo "Something went wrong";
    exit;
}
//--------------------------------------------------------------
?>

    <h2>This is read specific author detail page</h2>
<?php
if ($book && $statement) {
    require "../common.php";
    foreach ($book as $key => $value) { ?>

        <div class="book_detail">
            <!-- Image -->

            <!-- Book Name -->
            <p> <?php if ($key == 'bookName') {
                    echo "Book Name : " . $value;
                } ?></p>
            <!-- Book ISBN -->
            <p><?php if ($key == 'ISBN') {
                    echo "ISBN : " . $value;
                } ?></p>
            <!-- Author Name -->

            <!-- Description -->
            <p><?php if ($key == 'description') {
                    echo "Description: " . $value;
                } ?></p>
            <!--Review!! -->
        </div>
    <?php } ?>
    <!--        Write a review -->
    <div class="review-Section">
        <p>This area will contain a reviews</p>
    </div>
    <div class="reviewForm">
        <form method="post">
            <textarea rows="10" cols="50"> Write a review</textarea>
            <button type="submit" name="submit">Submit</button>
        </form>
    </div>

<?php }
?>


<?php
include "templates/footer.php";
?>