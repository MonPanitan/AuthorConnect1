<?php

include "templates/header.php";
include "../Activities/AuthorPost.php";
include "../Activities/Announcement.php";
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
    <!--        This will contain a card which will contain List of books, Announcement, Events, Survey -->
    <?php
    //---------------------------------------------------------------
    //Select Announcement where this author publish
    try {
        require_once '../src/DBconnect.php';
        $userID = $_GET['UserID'];

        $sql = "SELECT * 
        FROM author_action 
        WHERE userID = :userID 
        AND postTypeID = 1"; //:userID is a placeholder
        $statement = $connection->prepare($sql);
        $statement->bindValue(':userID', $userID); //replace placeholder with value
        $statement->execute();

        $authorAnnouncement = $statement->fetchAll(); // return an array index column
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }


    //print out Announcement
    if ($authorAnnouncement && $statement->rowCount() > 0) { ?>
        <div class="grid_container">
            <h3>Announcement</h3>
            <?php foreach ($authorAnnouncement as $row) { ?>
                <div class="card">
                    <div class="announcement_detail">
                        <h2>Heading:<?php echo $row['Heading'] ?></h2>
                        <h4>Description: <?php echo $row['description'] ?></h4>
                        <h4>Date: <?php echo $row['Date'] ?></h4>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php }
    //---------------------------------------------------------------
    //Select Events from specific Author
    try {
        require_once '../src/DBconnect.php';
        $userID = $_GET['UserID'];

        $sql = "SELECT * 
        FROM author_action 
        WHERE userID = :userID 
        AND postTypeID = 2"; //:userID is a placeholder
        $statement = $connection->prepare($sql);
        $statement->bindValue(':userID', $userID); //replace placeholder with value
        $statement->execute();

        $authorEvent = $statement->fetchAll(); // return an array index column
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
    //print out Announcement
    if ($authorEvent && $statement->rowCount() > 0) { ?>
        <div class="grid_container">
            <h3>Events</h3>
            <?php foreach ($authorEvent as $row) { ?>
                <div class="card">
                    <div class="event_detail">
                        <h2>Heading:<?php echo $row['Heading'] ?></h2>
                        <h4>Description: <?php echo $row['description'] ?></h4>
                        <h4>Date: <?php echo $row['Date'] ?></h4>
                        <h4>Time: <?php echo $row['Time'] ?></h4>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php }
    //-----------------------------------------------------------------
    //Select Survey from specific Author
    try {
        require_once '../src/DBconnect.php';
        $userID = $_GET['UserID'];

        $sql = "SELECT * 
        FROM author_action 
        WHERE userID = :userID 
        AND postTypeID = 3"; //:userID is a placeholder
        $statement = $connection->prepare($sql);
        $statement->bindValue(':userID', $userID); //replace placeholder with value
        $statement->execute();

        $authorSurvey = $statement->fetchAll(); // return an array index column
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
    //print out Announcement
    if ($authorSurvey && $statement->rowCount() > 0) { ?>
        <div class="grid_container">
            <h3>Surveys</h3>
            <?php foreach ($authorSurvey as $row) { ?>
                <div class="card">
                    <div class="event_detail">
                        <h2>Heading:<?php echo $row['Heading'] ?></h2>
                        <h4>Description: <?php echo $row['description'] ?></h4>
                        <h4>Date: <?php echo $row['Date'] ?></h4>
                        <h4>Time: <?php echo $row['Time'] ?></h4>
                        <h4>Answer1: <?php echo $row['Answer1'] ?></h4>
                        <h4>Answer2: <?php echo $row['Answer2'] ?></h4>
                        <h4>Answer3: <?php echo $row['Answer3'] ?></h4>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php }
    //-----------------------------------------------------------------
    ?>
    <!--        Write a review -->
    <div class="review-Section">
        <p>This area will contain a list of book</p>
    </div>
    <!--    This ill contain a book-->
    <?php include "templates/footer.php";
} ?>

