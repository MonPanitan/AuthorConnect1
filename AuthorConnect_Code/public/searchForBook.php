<?php
include "templates/header.php"; ?>

This is search for book page
<br>
<?php
//Connect TO DB
try {
    require_once "../common.php";
    require_once '../src/DBconnect.php';

    $sql = "SELECT *
        FROM book
        WHERE bookName = :bookName";

    $bookName = $_POST['bookName'];

    $statement = $connection->prepare($sql);
    $statement->bindParam(':bookName', $bookName, PDO::PARAM_STR);
    $statement->execute();
    $result = $statement->fetchAll();
} catch (PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}

//If successful Display a book
if ($result && $statement->rowCount() > 0) { ?>

    <div class="grid_container">
        <?php foreach ($result as $row) { ?>
            <a href="read-single-book.php?ISBN=<?php echo escape($row['ISBN']) ?>"</a>
            <div class=" card">
                <div class="book_detail">
                    <h2>Book:<?php echo $row['bookName'] ?></h2>
                    <h4>Description: <?php echo $row['description'] ?></h4>
                    <h4>rating: <?php echo $row['rating'] ?></h4>
                </div>
            </div>
            </a>
        <?php } ?>
    </div>
<?php } else {

    echo "<br><br><br>" . "Does not found a book : " . $bookName . " In Database";
} ?>

<?php include "templates/footer.php"; ?>
