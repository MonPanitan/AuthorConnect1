<?php
include "../Activities/AuthorPost.php";
include "../Activities/Announcement.php";


$testHeading = "This is a test heading";
$testDesc = "This si a test description";
$testDate = "20/4/23";
$testUserID = 27;
$testRoleID = 1;
$testPostTypeID = 2;
try {
    require '../common.php';

    //Create object
    $addAnnouncement = new Announcement($testHeading, $testDesc, $testDate);

    $new_Announcement = array(
        //need UserID,roleID,postTypeID, Heading, Description
        "UserID" => escape($testUserID),
        "roleID" => escape($testRoleID),
        "postTypeID" => $testPostTypeID,
        "Heading" => $addAnnouncement->Heading,
        "description" => $addAnnouncement->Description,
        "Date" => $addAnnouncement->date,

    );
} catch (PDOException $error) {
    echo $error;
}
echo $addAnnouncement->addAnnouncementToDB($new_Announcement);