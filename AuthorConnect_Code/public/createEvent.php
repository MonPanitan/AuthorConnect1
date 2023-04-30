<?php
include "../Activities/AuthorPost.php";
include "../Activities/Event.php";

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
                $curr_UserID = $row["UserID"];
                $curr_roleID = $row["roleID"];
            }

//                echo "The userId of user $authorName is $curr_UserID";
        } else {
            // User doesn't exist in the database
            echo "User not found";
        }

        //------------------------------------------------------
        //Create variables
        $postTypeID = escape(2);
        $heading = $_POST["heading"];
        $description = $_POST["description"];
        $date = date('Y-m-d H:i:s');
        $eventPlace = escape($_POST["location"]);
        $time = escape($_POST["time"]);
        $price = escape($_POST["price"]);

        //implement and create class
        $addEvent = new Event($heading, $description, $date, $eventPlace, $time, $price);

        //Create AuthorPost first
        //Then add AuthorPost
        $new_Event = array(
            //need UserID,roleID,postTypeID, Heading, Description
            "UserID" => escape($curr_UserID),
            "roleID" => escape($curr_roleID),
            "postTypeID" => $postTypeID, // still hard Code
            "Heading" => $addEvent->Heading,
            "description" => $addEvent->Description,
            "Place" => $addEvent->eventPlace,
            "price" => $addEvent->price,
        );

        //-------------------------------------------------------------------------------------------


    } catch (PDOException $error) {
        echo $dbUsername . "<br" . $error->getMessage();
    }
    //-------------------------------------------------------------------------------------------

    //Add Event into DB
    $addEvent->addEventToDB($new_Event);

    echo ' successfully Create Event and added to DB';

}

?>
<h2>This is a CREATE Event page</h2>

<form method="post">
    <!-- Heading -->
    <label for="heading">Heading:</label>
    <input type="text" name="heading" id="heading" required>

    <!-- Description -->
    <label for="description">Description:</label>
    <textarea name="description" id="description" rows="13" cols="80" required></textarea>

    <!-- Event Place-->
    <label for="location">Location:</label>
    <input type="text" name="location" id="location">

    <!-- Event Time-->
    <label for="Time">Time:</label>
    <input type="time" name="time" id="time">

    <!-- Event Price-->
    <label for="price">Price: (in Euro)</label>
    <input type="number" name="price" id="price">

    <br><br>
    <!-- Publish Button -->
    <button type="submit" name="submit" value="Event">Publish Event</button>
</form>


<?php include "templates/footer.php"; ?>
