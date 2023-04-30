<?php

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
} ?>
<?php include "templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) : ?>
    <?php echo escape($_POST['firstname']); ?> successfully updated.
<?php endif; ?>

<h2>Edit READER</h2>

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

<?php
//.......................................
//This area will show a reviews

try {
    require_once '../src/DBconnect.php';
    $userID = $_GET['UserID'];

    $sql = "SELECT * 
        FROM review 
        WHERE userID = :userID"; //:userID is a placeholder
    $statement = $connection->prepare($sql);
    $statement->bindValue(':userID', $userID); //replace placeholder with value
    $statement->execute();

    $readerReviews = $statement->fetchAll(); // return an array index column
} catch (PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}

//print out Announcement
if ($readerReviews && $statement->rowCount() > 0) { ?>
    <div class="grid_container">
        <h3>Reviews</h3>
        <?php foreach ($readerReviews as $row) { ?>
            <div class="card">
                <div class="announcement_detail">
                    <h2>Book ISBN:<?php echo $row['Book_ISBN'] ?></h2>
                    <h4>Date: <?php echo $row['Date'] ?></h4>
                    <h4>Comment: <?php echo $row['Comment'] ?></h4>
                </div>
            </div>
            <a href="successfullyDelete.php?UserID=<?php echo($_SESSION['UserID']); ?>&ReviewID=<?php echo escape($row["ReviewID"]); ?>">Delete</a>

        <?php } ?>
    </div>
<?php }
?>


<?php include "templates/footer.php"; ?>


