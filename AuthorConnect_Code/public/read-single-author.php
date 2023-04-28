<?php

include "templates/header.php";
?>
<?php
//------------------------------------------------------------
//get book details (everything from book)
if (isset($_GET['UserID'])) {
    try {
        require_once '../src/DBconnect.php';
        $userID = $_GET['UserID'];

        $sql = "SELECT * FROM user WHERE userID = :userID"; //:id is a placeholder
        $statement = $connection->prepare($sql);
        $statement->bindValue(':userID', $userID); //replace placeholder with value
        $statement->execute();

        $author = $statement->fetch(PDO::FETCH_ASSOC); // return an array index column
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
if ($author && $statement) {
    require "../common.php";

    foreach ($author as $key => $value) { ?>

        <div class="author_detail">
            <!-- Image -->
            <p>
                <?php if ($key == 'image') { ?>
                    <img src="image/JkRowling.jpg" alt="Image of JK Rowing" class="author_img">
                <?php } ?>
            </p>

            <!-- Book Name -->
            <p> <?php
                if ($key == 'firstname') {
                    echo $value;
                }
                if ($key == 'lastname') {
                    echo " " . $value;
                }
                ?>
            </p>

            <!-- Author Name -->

            <!-- Description -->
            <!--            <p>--><?php //if ($key == 'description') {
            //                    echo "Description: " . $value;
            //                } ?><!--</p>-->
            <!--Review!! -->
        </div>
    <?php } ?>
    <!--        Write a review -->
    <div class="review-Section">
        <p>This area will contain a list of book</p>
    </div>
    <!--    This ill contain a book-->
    <?php include "templates/footer.php";
} ?>