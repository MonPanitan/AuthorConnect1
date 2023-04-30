<?php
include "../Activities/AuthorPost.php";
include "../Activities/Survey.php";

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
        //setup a  variable
        $postTypeID = escape(3);
        $heading = $_POST["heading"];
        $description = $_POST["description"];
        $date = date('Y-m-d H:i:s');
        $answer1 = escape($_POST["answer1"]);
        $answer2 = escape($_POST["answer2"]);
        $answer3 = escape($_POST["answer3"]);

        //implement into class
        $addSurvey = new Survey($heading, $description, $date, $answer1, $answer2, $answer3);

        //take value from Survey object and then add to DB
        $new_Event = array(
            "UserID" => escape($curr_UserID),
            "roleID" => escape($curr_roleID),
            "postTypeID" => $postTypeID,
            "Heading" => $addSurvey->Heading,
            "description" => $addSurvey->Description,
            "Answer1" => $addSurvey->answer1,
            "Answer2" => $addSurvey->answer2,
            "Answer3" => $addSurvey->answer3,
        );

        //-------------------------------------------------------------------------------------------


    } catch (PDOException $error) {
        echo $dbUsername . "<br" . $error->getMessage();
    }
    //-------------------------------------------------------------------------------------------

    //Add Survey to DB
    $addSurvey->addSurveyToDB($new_Event);

    echo ' successfully Create Event and added to DB';

}

?>
<h2>This is a CREATE SURVEY page</h2>

<form method="post">
    <!-- Heading -->
    <label for="heading">Heading of Survey:</label>
    <input type="text" name="heading" id="heading" required>

    <!-- Description -->
    <label for="description">Description:</label>
    <textarea name="description" id="description" rows="13" cols="80" required></textarea>

    <!--    Requires at least 2 choice otherwise it not a surveys
            Maximum 3 choice-->
    <!--    Answer1-->
    <label for="answer1">Answer 1</label>
    <input type="text" name="answer1" id="answer1" required>

    <!--    Answer2-->
    <label for="answer2">Answer 2</label>
    <input type="text" name="answer2" id="answer2" required>

    <!--    Answer3-->
    <label for="answer3">Answer 3</label>
    <input type="text" name="answer3" id="answer3">


    <br><br>
    <!-- Publish Button -->
    <button type="submit" name="submit" value="Survey">Publish Survey</button>
</form>


<?php include "templates/footer.php"; ?>
