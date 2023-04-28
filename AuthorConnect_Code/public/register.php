<?php
include "../Member/User.php";
require '../common.php';

//If submit button has been clicked it will connect to the DB
//and try to add(post) data into database.
if (isset($_POST['submit'])) {
    try {
        $roleButton = escape($_POST['roleButton']);

        //Pass Data to variable
        $roleID = escape($_POST['roleButton']);
        $username = escape($_POST['username']);
        $password = escape($_POST['password']);
        $firstname = escape($_POST['firstname']);
        $lastname = escape($_POST['lastname']);
        $email = escape($_POST['email']);
        $phoneNum = escape($_POST['phoneNum']);

        //Create object
        $addUser = new User($username, $password, $firstname, $lastname, $email, $phoneNum, $roleID);

        //-------------------------------------------------------------------------------------------
        //This will check If user already exist
        $result = $addUser->checkForExistUser($addUser->$username);

        //Represent user exist
        if ($result) {
            echo "Username: " . $_POST['username'] . ' Already exist';
        } else {
            $new_user = array(
                "roleID" => $addUser->$roleID,
                "username" => $addUser->$username,
                "password" => $addUser->$password,
                "firstname" => $addUser->$firstname,
                "lastname" => $addUser->$lastname,
                "email" => $addUser->$email,
                "Phone_num" => $addUser->$phoneNum,
            );
            //add User to DB
            $addUser->register($new_user);
            header("location:login.php");
        }
        //-------------------------------------------------------------------------------------------

    } catch (PDOException $error) {
        echo $error->getMessage();
    }

}
//include Header html
include "templates/loginHeader.php";
//This will check if code has submitted and updated to the DB

?>
<p>Already registered go to :
    <a href="login.php"> Login </a>
</p>
<h2>Register Page:</h2>
<form method="post">
    <p>please choose your role for register:</p>
    <input type="radio" name="roleButton" value="1" id="authorButton">Author</input>
    <input type="radio" name="roleButton" value="2" id="readerButton">Reader</input>

    <!-- Username -->
    <label for="username">Username:</label>
    <input type="text" name="username" id="username" required>

    <!-- Password -->
    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required>

    <!-- First name -->
    <label for="firstname">First Name:</label>
    <input type="text" name="firstname" id="firstname" required>

    <!-- Last Name -->
    <label for="lastname">Last Name:</label>
    <input type="text" name="lastname" id="lastname" required>

    <!-- Email -->
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required>

    <!-- Phone -->
    <label for="phoneNum">Phone Number:</label>
    <input type="number" name="phoneNum" id="phoneNum">

    <!-- need to add register role -->
    <!-- Method to assign a value of that role
    For example assign for author need a method to assign an increment value to that author-->

    <br><br>
    <!-- Register Button -->
    <input type="submit" name="submit" value="Register">
</form>
<p>Search for an author or Book
    <a href="search.php">Search</a>
</p>
<?php include "templates/footer.php" ?>