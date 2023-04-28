<?php
try {
    require "../common.php";
    require_once '../src/DBconnect.php';

    $sql = "SELECT *
        FROM book";


    $statement = $connection->prepare($sql);
//    $statement->bindParam(':roleID',$location, PDO::PARAM_STR);
    $statement->execute();
    $books = $statement->fetchAll();
} catch (PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}
include "templates/header.php"; ?>
<link rel="stylesheet" href="css/bookStyle.css"/>
<!-- This page will contain a specific book that related to author-->

<?php
//If successful Display a book
if ($books && $statement->rowCount() > 0) { ?>

    <div class="grid_container">
        <?php foreach ($books as $row) { ?>
            <a href="update-single-book.php?ISBN=<?php echo escape($row["ISBN"]); ?>">
                <div class="card">
                    <div class="book_detail">
                        <h2>Book:<?php echo $row['bookName'] ?></h2>
                        <h4>Description: <?php echo $row['description'] ?></h4>
                        <h4>rating: <?php echo $row['rating'] ?></h4>
                    </div>
                </div>
            </a>
        <?php } ?>
    </div>
<?php } ?>


<?php include "templates/footer.php"; ?>
