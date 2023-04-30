<?php
include "templates/header.php";
include "../System/automateSystem.php";

if (isset($_GET['UserID']) && isset($_GET['PostID'])) {
    $PostID = escape($_GET['PostID']);
    $UserID = escape($_GET['UserID']);
    $automateSystem = new \System\automateSystem();
    $automateSystem->deleteActionFromDB($PostID); ?>
    <br>
    <a href="update-single-author.php?UserID=<?php echo escape($_SESSION["UserID"]); ?>">Go Back</a>
<?php } elseif (isset($_GET['UserID']) && isset($_GET['ReviewID'])) {
    $ReviewID = escape($_GET['ReviewID']);
    $UserID = escape($_GET['UserID']);
    $automateSystem = new \System\automateSystem();
    $automateSystem->deleteReviewFromDB($ReviewID); ?>
    <br>
    <a href="update-single-reader.php?UserID=<?php echo escape($_SESSION["UserID"]); ?>">Go Back</a>
<?php } ?>



<?php include "templates/footer.php"; ?>
