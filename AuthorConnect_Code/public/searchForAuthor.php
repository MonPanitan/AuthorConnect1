<?php
include "templates/header.php"; ?>

This is search for book page
<?php
//Connect TO DB
try {
    require_once "../common.php";
    require_once '../src/DBconnect.php';

    $sql = "SELECT *
        FROM user
        WHERE firstname = :authorName";

    $authorName = $_POST['firstname'];

    $statement = $connection->prepare($sql);
    $statement->bindParam(':authorName', $authorName, PDO::PARAM_STR);
    $statement->execute();
    $result = $statement->fetchAll();
} catch (PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}

//If successful Display a book
if ($result && $statement->rowCount() > 0) { ?>

    <div class="grid_container">
        <?php foreach ($result as $row) { ?>
            <a href="read-single-author.php?UserID=<?php echo escape($row['UserID']) ?>"</a>
            <div class=" card">
                <div class="book_detail">
                    <h4><?php echo $row['firstname'] ?></h4>
                    <h4><?php echo $row['lastname'] ?></h4>
                    <h4>Description: <?php echo $row['description'] ?></h4>
                </div>
            </div>
            </a>
        <?php } ?>
    </div>
<?php } else {
    echo "Does not found a Author: " . $authorName . " In Database";
} ?>

<?php include "templates/footer.php"; ?>
