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

        //password validation
        if (strlen($password) < 8) {
            $errors[] = "Password must be at least 8 characters";
        }

        //Create object
        $addUser = new User($username, $password, $firstname, $lastname, $email, $phoneNum, $roleID);

        //-------------------------------------------------------------------------------------------
        //This will check If user already exist
        $result = $addUser->checkForExistUser($addUser->getUsername());

        //Represent user exist
        if ($result) {
            echo "Username: " . $_POST['username'] . ' Already exist';
        } else {
            $new_user = array(
                "roleID" => $addUser->getRole(),
                "username" => $addUser->getUsername(),
                "password" => $addUser->getPassword(),
                "firstname" => $addUser->getFirstname(),
                "lastname" => $addUser->getLastname(),
                "email" => $addUser->getEmail(),
                "Phone_num" => $addUser->getPhoneNum(),
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
        <input type="radio" name="roleButton" value="1" id="authorButton" required>Author </input>
        <input type="radio" name="roleButton" value="2" id="readerButton" required>Reader </input>

        <!-- Username -->
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required>

        <!-- Password -->
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" minlength="8" required
               title="Password must contain at least 8 characters"> <!-- Minimum 8 character-->

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
        <input type="tel" name="phoneNum" id="phoneNum" placeholder="08x-xxxxxxx" pattern="[0-9]{3}[0-9]{7}">

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