<?php
include '../Activities/Review.php';

class User
{
    protected int $userID;
    protected string $username;
    protected string $password;
    protected string $image;
    protected string $firstname;
    protected string $lastname;
    protected string $email;
    protected int $phone_Num;
    protected string $dob;
    protected int $role;

    private $review;

    //CONSTRUCT
    public function __construct(string $Username, string $password, string $firstname, string $lastname, string $email, int $phone_num, int $role)
    {
        $this->username = $Username;
        $this->password = $password;
        $this->lastname = $lastname;
        $this->firstname = $firstname;
        $this->email = $email;
        $this->phone_Num = $phone_num;
        $this->role = $role;
    }


    //GETTER AND SETTER

    /**
     * @return int
     */
    public function getUserID(string $username): int
    {
        $sqlAuthor = "SELECT UserID
        FROM user
        WHERE username = :username";

        $statement = $connection->prepare($sqlAuthor);
        $statement->bindParam(':username', $username, PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetchAll();

        return $result;
    }

    /**
     * @param int $userID
     */
    public function setUserID(int $userID): void
    {
        $this->userID = $userID;
    }

    /**
     * @return String
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param String $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return String
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param String $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return String
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * @param String $image
     */
    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    /**
     * @return String
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @param String $firstname
     */
    public function setFirstname(string $firstname): void
    {
        $this->firstname = $firstname;
    }

    /**
     * @return String
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * @param String $lastname
     */
    public function setLastname(string $lastname): void
    {
        $this->lastname = $lastname;
    }

    /**
     * @return String
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param String $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return int
     */
    public function getPhoneNum(): int
    {
        return $this->phone_Num;
    }

    /**
     * @param int $phone_Num
     */
    public function setPhoneNum(int $phone_Num): void
    {
        $this->phone_Num = $phone_Num;
    }

    /**
     * @return String
     */
    public function getDob(): string
    {
        return $this->dob;
    }

    /**
     * @param String $dob
     */
    public function setDob(string $dob): void
    {
        $this->dob = $dob;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     */
    public function setRole($role): void
    {
        $this->role = $role;
    }

    //FUNCTION
    public function register(array $newUser)
    {
        require '../DBConfig.php';
        require '../src/DBconnect.php';

        //This line of code will insert our data into a table
        $sql = sprintf("INSERT INTO %s (%s) values (%s)", "user", implode(", ",
            array_keys($newUser)), ":" . implode(", :", array_keys($newUser)));
        $statement = $connection->prepare($sql);
        $statement->execute($newUser);
    }

    public function login(string $loginUsername, string $loginPassword)
    {
        try {
            $sql = "SELECT username, password
    FROM user
    WHERE username = :username
    AND password = :password ";

            $statement = $connection->prepare($sql);
            $statement->bindParam(':username', $loginUsername, PDO::PARAM_STR);
            $statement->bindParam(':password', $loginPassword, PDO::PARAM_STR);
            $statement->execute();
            $result = $statement->fetchAll();

            return $result;

        } catch (PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
        }
    }

    public function checkForExistUser(string $username)
    {
        require "../DBConfig.php";
        try {
            //Connect to DB
            require_once '../src/DBconnect.php';
            //IF STATEMENT to check if new username is same as contains in db or not.
            $dbUsername = "SELECT *
            FROM user
            WHERE username = :username";

            $newUsername = $_POST['username'];

            $statement = $connection->prepare($dbUsername);
            $statement->bindParam(':username', $newUsername, PDO::PARAM_STR);
            $statement->execute();
            $result = $statement->fetchAll();

            return $result;

        } catch (PDOException $error) {
            echo $dbUsername . "<br" . $error->getMessage();
        }
    }


    public function search()
    {

    }


    public function writeReview(string $book_ISBN, string $date, string $comment, int $UserID, int $roleID, array $new_review)
    {
        //composition of review
        $this->review = new Review($book_ISBN, $date, $comment);
        $this->review->setUserID($UserID);
        $this->review->setRoleID($roleID);

        $this->review->addReviewToDB($new_review);
    }

    public function rateABook()
    {

    }

    public function favBook()
    {

    }

    public function deleteComment()
    {

    }

    public function logout()
    {

    }


}