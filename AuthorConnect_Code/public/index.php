<?php
include "templates/header.php"; ?>
    <body>
<?php if (isset($_POST['searchForBook'])) {
    header("location: searchForBook.php");
} elseif (isset($_POST['searchForAuthor'])) {
    header('location:searchForAuthor.php');
} ?>

    <div class="Container">
        <div class="searching">
            <div class="searchBook">
                <h3>Search for Book</h3>
                <form method="post" action="searchForBook.php">
                    <label for="bookName">Book Name:</label>
                    <input type="text" id="bookName" name="bookName">
                    <input type="submit" name="searchForBook" value="Search">
                </form>
            </div>
            <div class="searchAuthor">
                <h3>Search for Author</h3>
                <form method="post" action="searchForAuthor.php">
                    <label for="firstname">Author Name:</label>
                    <input type="text" id="firstname" name="firstname">
                    <input type="submit" name="searchForAuthor" value="Search">
                </form>
            </div>
        </div>
        <div class="MainArea">
            <div class="News">
                <div id="announcement_Container">
                    <!--                    Get every announcement from Database-->
                    <?php
                    //Get Announcement from DB
                    try {
                        require_once '../src/DBconnect.php';

                        $sql = "SELECT * FROM author_action WHERE postTypeID = 1";
                        $statement = $connection->prepare($sql);
                        $statement->execute();

                        $getAllAnnouncement = $statement->fetchAll(); // return an array index column
                    } catch (PDOException $error) {
                        echo $error;
                    }
                    //print out Announcement
                    if ($getAllAnnouncement && $statement->rowCount() > 0) { ?>
                        <div class="grid_container">
                            <h3>Announcement</h3>
                            <?php foreach ($getAllAnnouncement as $row) { ?>

                                <div class="card">
                                    <div class="announcement_detail">
                                        <h4>Heading:<?php echo $row['Heading'] ?></h4>
                                        <h4>Description: <?php echo $row['description'] ?></h4>
                                        <h4>Date: <?php echo $row['Date'] ?></h4>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    <?php }
                    ?>
                </div>
                <div id="event_Container">
                    <!--                    Get every Event from Database-->
                    <?php
                    //Get Event from DB
                    try {
                        require_once '../src/DBconnect.php';

                        $sql = "SELECT * FROM author_action WHERE postTypeID = 2";
                        $statement = $connection->prepare($sql);
                        $statement->execute();

                        $getAllEvent = $statement->fetchAll(); // return an array index column
                    } catch (PDOException $error) {
                        echo $error;
                    }
                    //print out Announcement
                    if ($getAllEvent && $statement->rowCount() > 0) { ?>
                        <div class="grid_container">
                            <h3>Events</h3>
                            <?php foreach ($getAllEvent as $row) { ?>

                                <div class="card">
                                    <div class="announcement_detail">
                                        <h4>Heading:<?php echo escape($row['Heading']) ?></h4>
                                        <h4>Description: <?php echo escape($row['description']) ?></h4>
                                        <h4>Date: <?php echo escape($row['Date']) ?></h4>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
                <div id="survey_Container">
                    <!--                    Get every Event from Database-->
                    <?php
                    //Get Survey from DB
                    try {
                        require_once '../src/DBconnect.php';

                        $sql = "SELECT * FROM author_action WHERE postTypeID = 3";
                        $statement = $connection->prepare($sql);
                        $statement->execute();

                        $getAllSurvey = $statement->fetchAll(); // return an array index column
                    } catch (PDOException $error) {
                        echo $error;
                    }
                    //print out Announcement
                    if ($getAllSurvey && $statement->rowCount() > 0) { ?>
                        <div class="grid_container">
                            <h3>Surveys</h3>
                            <?php foreach ($getAllSurvey as $row) { ?>

                                <div class="card">
                                    <div class="announcement_detail">
                                        <h4>Heading:<?php echo escape($row['Heading']) ?></h4>
                                        <h4>Description: <?php echo escape($row['description']) ?></h4>
                                        <h4>Date: <?php echo escape($row['Date']) ?></h4>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <div class="authorAndBook">
                <div class="author_Container">
                    <h3>Authors</h3>
                </div>
                <div class="Book_Container">
                    <h3>Books</h3>
                </div>
            </div>
        </div>
    </div>

<?php include "templates/footer.php"; ?>