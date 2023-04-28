<?php
include "templates/header.php";
?>
<?php
//Submit Review
if (isset($_POST['submit'])) {
    try {
        //Connect to the DB
        require_once '../src/DBconnect.php';

        //Create new Review
        $new_Review = array(
            //ReviewID,ISBN,genreID,UserID,roleID,Date,Comment
            "Book_ISBN" => escape($curr_UserID),
            "Book_genreID" => escape($curr_roleID),//get genre ID
            "UserID" => escape(), //get User ID
            "roleID" => escape($_POST["roleID"]),
            "Date" => escape($_POST["Date"]),
            "Comment" => escape($_POST["Comment"]),
//            "price" => escape($_POST["price"]),
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
            <button type="submit">Submit</button>
        </form>
    </div>

<?php }
?>


<?php
include "templates/footer.php";
?>