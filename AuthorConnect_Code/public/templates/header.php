<?php session_start(); //Start a session
require_once "../common.php";
if ($_SESSION['Active'] == false) {
    header("location:login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <meta http-equiv="x-ua-compatible" content="ie=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>AuthorConnect</title>
    <link rel="stylesheet" href="css/headerStyle.css"/>
    <link rel="stylesheet" href="css/footerStyle.css"/>
</head>

<body>

<div id="navBar">
    <nav>
        <a href="index.php">AuthorConnect</a>
        <a href="index.php">Home</a>
        <a href="book.php">Book</a>
        <a href="author.php">Author</a>
        <a href="about.php">About Us</a>
        <a href="contact.php">Contact Us</a>


        <div class="user_Action_Area">
            <!-- Author Action-->
            <?php if (escape($_SESSION['roleID']) == 1) { ?>
                <div class="author_action">
                    <button class="authorActDropbtn">Publish &#8964;</button>
                    <div class="dropdown-content">
                        <a href="publication.php">Publish Book</a>
                        <a href="createAnnouncement.php">Create Announcement</a>
                        <a href="createSurvey.php">Create Survey</a>
                        <a href="createEvent.php">Create Event</a>
                    </div>
                </div>
            <?php } ?>
            <!-- User Profile Area-->
            <div class="userProfile">
                <button class="userDropbtn">
                    <?php echo escape($_SESSION['username']); ?>
                </button>
                <div class="dropdown-content">
                    <?php if (escape($_SESSION['roleID']) == 1) { ?>
                        <a href="update-single-author.php?UserID=<?php echo escape($_SESSION["UserID"]); ?>">Profile</a>
                    <?php } elseif (escape($_SESSION['roleID']) == 2) { ?>
                        <a href="update-single-reader.php?UserID=<?php echo escape($_SESSION["UserID"]); ?>">Profile</a>

                    <?php } ?>
                    <!-- This will goes to personal page-->
                    <a href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </nav>

</div>

<hr>