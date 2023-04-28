<?php session_start(); //Start a session
if($_SESSION['Active'] == false){
    header("location:login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>AuthorConnect</title>
    <link rel="stylesheet" href="css/headerStyle.css" />
    <link rel="stylesheet" href="css/footerStyle.css" />
</head>

<body>

<div id="navBar">
    <nav>
        <a href="main.php">AuthorConnect</a>
        <a href="main.php">Home</a>
        <a href="book.php">Book</a>
        <a href="author.php">Author</a>
        <a href="about.php">About Us</a>
        <a href="contact.php">Contact Us</a>
        <!-- Author Action-->
        <div class="author_action">
            <button class="authorActDropbtn">Publish &#8964;</button>
            <div class="dropdown-content">
                <a href="publication.php">Publish Book</a>
                <a href="createAnnouncement.php">Create Announcement</a>
                <a href="createSurvey.php">Create Survey</a>
                <a href="createEvent.php">Create Event</a>
            </div>
        </div>
    </nav>




</div>
<form action="logout.php" method="post" name="Logout_form" class="form-signin">
    <button type="submit" class="button" name="submit" value="logout">Logout</button>
</form>
<hr>