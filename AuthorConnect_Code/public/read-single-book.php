<?php
include "templates/header.php";
include "../Member/User.php";


?>
<?php
//Submit Review
if (isset($_POST['submit'])) {
    require_once '../common.php';
    //Connect to the DB
    require_once '../src/DBconnect.php';

    //insert new book code will go here
    //Create new objects and add that object into the DB
    //escape method will take an input the sanitize in common.php file
    //Create new PublishID
//        $insertPublishID = "INSERT INTO publish (publishID, authorID) VALUES ()"

    //---------------------------------------------------------------------------------------
    //GET USER ID FROM DB
    $authorName = $_SESSION['username'];
    //SQL search for author
    $sqlAuthor = "SELECT *
        FROM user
        WHERE username = :username";

    $statement = $connection->prepare($sqlAuthor);
    $statement->bindParam(':username', $authorName, PDO::PARAM_STR);
    $statement->execute();
    $result = $statement->fetchAll();


    //declared UserID
    $curr_Username = null;
    $curr_Password = null;
    $curr_Firstname = null;
    $curr_Lastname = null;
    $curr_email = null;
    $curr_Phone_Num = null;
    $curr_UserID = null;
    $curr_roleID = null;
    $curr_publishID = null;

    //Declare Book
    $curr_book_isbn = $_GET['ISBN'];
    $curr_book_genreID = 1;


    //GET USER ID and ROLE ID
    if ($statement->rowCount() > 0) {
        foreach ($result as $row) {
            $curr_Username = $row['Username'];
            $curr_Password = $row['Password'];
            $curr_Firstname = $row['firstname'];
            $curr_Lastname = $row['lastname'];
            $curr_email = $row['Email'];
            $curr_Phone_Num = $row['Phone_num'];
            $curr_UserID = $row["UserID"];
            $curr_roleID = $row["roleID"];

        }
        //Create Current User Object
        $curr_User = new User($curr_Username, $curr_Password, $curr_Firstname, $curr_Lastname, $curr_email, $curr_Phone_Num, $curr_roleID);

        $date = date('Y-m-d H:i:s');
        $comment = $_POST["comment"];
        var_dump($comment);
        var_dump($curr_book_isbn);


        //Create new Review object
        $new_Review = array(
            //ReviewID,ISBN,genreID,UserID,roleID,Date,Comment
            "Book_ISBN" => $curr_book_isbn,
            "Book_genreID" => $curr_book_genreID,
            "UserID" => $curr_UserID, //get User ID
            "roleID" => $curr_roleID,
            "Date" => $date,
            "Comment" => $comment,
        );
        //Add Review to a DB
        //Create Review Object

        $curr_User->writeReview($curr_book_isbn, $date, $comment, $curr_UserID, $curr_roleID, $new_Review);

    } else {
        // User doesn't exist in the database
        echo "User $authorName not found";
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
//Get Reviews from Databases
try {
    require_once '../src/DBconnect.php';

    $sql = "SELECT *
        FROM review";


    $statement = $connection->prepare($sql);
//    $statement->bindParam(':roleID',$location, PDO::PARAM_STR);
    $statement->execute();
    $reviews = $statement->fetchAll();
} catch (PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}
//If successful Display a Review

//--------------------------------------------------------------
?>

    <h2>This is read specific Book detail page</h2>
<?php
if ($book && $statement) {

    foreach ($book as $key => $value) { ?>

        <div class="book_detail">
            <!-- Genre ID -->
            <p><?php if ($key == 'genreID') {
                    echo "Genre ID" . $value;
                } ?></p>

            <!-- Book Name -->
            <p> <?php if ($key == 'bookName') {
                    echo "Book Name : " . $value;
                } ?></p>
            <!-- Book ISBN -->
            <p><?php if ($key == 'ISBN') {
                    echo "ISBN : " . $value;
                    $curr_book_isbn = $value;
                } ?></p>
            <!-- Author Name -->

            <!-- Description -->
            <p><?php if ($key == 'description') {
                    echo "Description: " . $value;
                } ?></p>

        </div>
    <?php } ?>
    <!--        Write a review -->
    <div class="review-Section">
        <p>This area will contain a reviews</p>
        <?php if ($reviews && $statement->rowCount() > 0) { ?>

            <div class="grid_container">
                <?php foreach ($reviews as $row) { ?>
                    <div class="card">
                        <div class="book_detail">
                            <h2>Review ID:<?php echo $row['ReviewID'] ?></h2>
                            <h4>User ID: <?php echo $row['UserID'] ?></h4>
                            <h4>Date: <?php echo $row['Date'] ?></h4>
                            <h4>Comment: <?php echo $row['Comment'] ?></h4>
                        </div>
                    </div>
                    </a>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
    <div class="reviewForm">
        <form method="post">
            <textarea name="comment" id="comment" rows="10" cols="50"> Write a review</textarea>
            <button type="submit" name="submit">Submit</button>
        </form>
    </div>

<?php }
?>


<?php
include "templates/footer.php";
?>