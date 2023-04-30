<?php
include "../Activities/AuthorPost.php";
include "../Activities/Announcement.php";
//Include Header file
include "templates/header.php";
if (isset($_POST['submit'])) {
    require_once "../common.php";
    try {
        //Connect to the DB
        require_once '../src/DBconnect.php';

        //-----------------------------------------------------------
        //GET USERID AND ROLE ID FROM DB
        //GET USER ID FROM DB

        //SQL search for author
        $sqlAuthor = "SELECT *
        FROM user
        WHERE username = :username";

        $statement = $connection->prepare($sqlAuthor);
        $statement->bindParam(':username', $_SESSION['username'], PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetchAll();

//        var_dump($_SESSION['username']);

        //declared UserID
        $curr_UserID = null;
        $curr_roleID = null;
        $postTypeID = null;


        //GET USER ID and ROLE ID
        if ($statement->rowCount() > 0) {
            foreach ($result as $row) {
                $curr_UserID = escape($row["UserID"]);
                $curr_roleID = escape($row["roleID"]);
            }

//                echo "The userId of user $authorName is $curr_UserID";
        } else {
            // User doesn't exist in the database
            echo "User not found";
        }

        //------------------------------------------------------
        //setup a  variable

        //create Variable for each type
        $postTypeID = escape(1);
        $heading = escape($_POST["heading"]);
        $description = escape($_POST["description"]);
        $date = date('Y-m-d H:i:s');

        //implement to class
        $addAnnouncement = new Announcement($heading, $description, $date);

        //Create AuthorPost first
        //Then add AuthorPost
        $new_Announcement = array(
            //need UserID,roleID,postTypeID, Heading, Description
            "UserID" => escape($curr_UserID),
            "roleID" => escape($curr_roleID),
            "postTypeID" => $postTypeID,
            "Heading" => $addAnnouncement->Heading,
            "description" => $addAnnouncement->Description,
            "Date" => $addAnnouncement->date,

        );

        //-------------------------------------------------------------------------------------------


    } catch (PDOException $error) {
        echo $dbUsername . "<br" . $error->getMessage();
    }
    //-------------------------------------------------------------------------------------------

    //Add New Announcement to DB
    $addAnnouncement->addAnnouncementToDB($new_Announcement);

    echo ' successfully Create Announcement and added to DB';

}

?>
<h2>This is a CREATE ANNOUNCEMENT page</h2>

<form method="post">
    <!-- Heading -->
    <label for="heading">Heading:</label>
    <input type="text" name="heading" id="heading" cols="50" required>

    <!-- Description -->
    <label for="description">Description:</label>
    <textarea name="description" id="description" rows="13" cols="80" required></textarea>

    <br><br>
    <!-- Publish Button -->
    <button type="submit" name="submit" value="Announce">Announce</button>
</form>


<?php include "templates/footer.php"; ?>
