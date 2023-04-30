<?php
include "../System/automateSystem.php";
require_once '../common.php';


//Update to Database
if (isset($_POST['submit'])) {
    try {
        require_once '../src/DBconnect.php';
        //run update query
        $user = [
            "UserID" => escape($_POST['UserID']),
            "roleID" => escape($_POST['roleID']),
//            "EmpID" => escape($_POST['EmpID']),
            "Username" => escape($_POST['Username']),
            "Password" => escape($_POST['Password']),
//            "image" => escape($_POST['image']),
            "firstname" => escape($_POST['firstname']),
            "lastname" => escape($_POST['lastname']),
            "Email" => escape($_POST['Email']),
            "Phone_num" => escape($_POST['Phone_num']),
            "DOB" => escape($_POST['DOB']),
//            "Verify_Status" => escape($_POST['Verify_Status']),
//            "Link" => escape($_POST['Link']),
            "description" => escape($_POST['description'])
        ];
        $sql = "UPDATE user
                SET UserID = :UserID,
                    roleID = :roleID,
                    Username = :Username,
                    Password = :Password,
                    firstname = :firstname,
                    lastname = :lastname,
                    Email = :Email,
                    Phone_num = :Phone_num,
                    DOB = :DOB,
                    description = :description
                WHERE UserID = :UserID";

        $statement = $connection->prepare($sql);
        $statement->execute($user);

    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

if (isset($_GET['UserID'])) {
    try {
        require_once '../src/DBconnect.php';
        $UserID = $_GET['UserID'];

        $sql = "SELECT * FROM user WHERE UserID = :UserID"; //:id is a placeholder
        $statement = $connection->prepare($sql);
        $statement->bindValue(':UserID', $UserID); //replace placeholder with value
        $statement->execute();

        $user = $statement->fetch(PDO::FETCH_ASSOC); // return an array index column
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }

} else {
    echo "Something went wrong";
    exit;
}
?>
<?php require "templates/header.php"; ?>
<?php if (isset($_POST['submit']) && $statement) : ?>
    <?php echo escape($_POST['firstname']); ?> successfully updated.
<?php endif; ?>

<h2>Edit a user</h2>

<form method="post">
    <?php foreach ($user as $key => $value) : ?>
        <label for="<?php echo $key; ?>"> <?php echo ucfirst($key); ?></label>
        <?php if ($value == null) { ?>
            <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo "NULL"; ?>"
        <?php } else ?>
            <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo escape($value); ?>"
        <?php echo($key === 'UserID' ? 'readonly' : null); ?>
        <?php echo($key === 'roleID' ? 'readonly' : null); ?>
        >

    <?php endforeach; ?>
    <input type="submit" name="submit" value="Submit">
</form>
<div class="authorActivityContainer">
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
                        <h2>Heading:<?php echo escape($row['Heading']) ?></h2>
                        <h4>Description: <?php echo escape($row['description']) ?></h4>
                        <h4>Date: <?php echo escape($row['Date']) ?></h4>
                    </div>
                </div>
                <a href="successfullyDelete.php?UserID=<?php echo($_SESSION['UserID']); ?>&PostID=<?php echo escape($row["PostID"]); ?>">Delete</a>

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
    //print out Events
    if ($authorEvent && $statement->rowCount() > 0) { ?>
        <div class="grid_container">
            <h3>Events</h3>
            <?php foreach ($authorEvent as $row) { ?>
                <div class="card">
                    <div class="event_detail">
                        <h2>Heading:<?php echo escape($row['Heading']) ?></h2>
                        <h4>Description: <?php echo escape($row['description']) ?></h4>
                        <h4>Date: <?php echo escape($row['Date']) ?></h4>
                        <h4>Time: <?php echo escape($row['Time']) ?></h4>
                    </div>
                    <a href="successfullyDelete.php?UserID=<?php echo($_SESSION['UserID']); ?>&PostID=<?php echo escape($row["PostID"]); ?>">Delete</a>

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
                        <h2>Heading:<?php echo escape($row['Heading']) ?></h2>
                        <h4>Description: <?php echo escape($row['description']) ?></h4>
                        <h4>Date: <?php echo escape($row['Date']) ?></h4>
                        <h4>Time: <?php echo escape($row['Time']) ?></h4>
                        <h4>Answer1: <?php echo escape($row['Answer1']) ?></h4>
                        <h4>Answer2: <?php echo escape($row['Answer2']) ?></h4>
                        <h4>Answer3: <?php echo escape($row['Answer3']) ?></h4>
                    </div>
                    <a href="successfullyDelete.php?UserID=<?php echo($_SESSION['UserID']); ?>&PostID=<?php echo escape($row["PostID"]); ?>">Delete</a>

                </div>
            <?php } ?>
        </div>
    <?php }
    //-----------------------------------------------------------------
    ?>
</div>
<a href="index.php">Back to home</a>
<?php require "templates/footer.php"; ?>
