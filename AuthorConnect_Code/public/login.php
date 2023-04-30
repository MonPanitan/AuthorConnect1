<?php include "templates/loginHeader.php";

/*NOTE : THIS PAGE STILL NEED TO GIVE USER SESSION AND REDIRECT USER WHEN LOGIN
THE STRING ECHO SUCCESSFULLY LOGIN STILL DOES NOT SHOW UP.
PLUS SIDE ITS CONNECT TO DB*/

//Connection to DB and retrieve information
if (isset($_POST['submit'])) {
    try {
        require "../common.php";
        //Connect to the DB
        require_once '../src/DBconnect.php';

        $sql = "SELECT *
    FROM user
    WHERE username = :username
    AND password = :password ";

        //Input username
        $loginUsername = $_POST['username'];
        $loginPassword = $_POST['password'];


        $statement = $connection->prepare($sql);
        $statement->bindParam(':username', $loginUsername, PDO::PARAM_STR);
        $statement->bindParam(':password', $loginPassword, PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetchAll();

    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
if (isset($_POST['submit'])) {

    //Compare input value with DB value
//    if(($_POST['username'] == $username) && ($_POST['password'] == $password)){
    if ($result && $statement) {
        if ($statement->rowCount() > 0) {
            foreach ($result as $row) {
                $_SESSION['roleID'] = $row["roleID"];
                $_SESSION['UserID'] = $row["UserID"];
            }
        }
        echo 'success';

        $_SESSION['username'] = $loginUsername;
        $_SESSION['Active'] = true;

        //Redirect to main page
        header("location:index.php");

        exit;// quit from executing code below.

    } else {
        echo 'Incorrect Login Detail';
    }
} ?>

<form class="form" method="post">
    <p class="form-title">Sign in to your account</p>
    <div class="input-container">
        <!-- Username -->
        <label for="username">Username:</label>
        <input type="username" name="username" id="username" required>
    </div>

    <div class="input-container">
        <!-- Password -->
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
    </div>

    <br><br>
    <!-- login Button -->
    <button type="submit" class="submit" name="submit" value="Login">Login</button>
    <p class="register-link">
        No account?
        <a href="register.php">Sign up</a>
    </p>
</form>
</body>
</html>