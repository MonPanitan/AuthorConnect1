<?php
include "templates/header.php";

try {
    require_once "../common.php";
    require_once '../src/DBconnect.php';

    $sql = "SELECT *
        FROM user
        WHERE roleID = 1 ";


    $statement = $connection->prepare($sql);
//    $statement->bindParam(':roleID',$location, PDO::PARAM_STR);
    $statement->execute();
    $authors = $statement->fetchAll();
} catch (PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}

?>
<link rel="stylesheet" href="css/authorStyle.css"/>
<h2>This is an author page</h2>
<h1> You are still loggined As : <?php echo $_SESSION['username']; ?></h1>

<!-- This page will contain an author-->

<?php
//If successful
if ($authors && $statement->rowCount() > 0) { ?>

    <div class="grid_container">
        <?php foreach ($authors

        as $row) { ?> <!-- Loop start here-->
        <a href="read-single-author.php?UserID=<?php echo escape($row["UserID"]); ?>">
            <div class="card">
                <h4><img src="image/JkRowling.jpg" alt="Image of JK Rowing" class="author_img"></h4>
                <div class="author_detail">
                    <h2><?php echo escape($row['firstname']) ?> &nbsp <?php echo escape($row['lastname']) ?></h2>

                    <!--                    <h4>Description:--><?php //echo $row['description'] ?><!-- </h4>-->
                    <h4>List of Book</h4>
                </div>
            </div>
            <?php } ?>
    </div>
    <!-- Create a table-->
<?php } ?>




<?php include "templates/footer.php"; ?>
