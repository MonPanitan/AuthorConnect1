<?php
    class reader extends User
    {
        private int $roleID;
        //constructor
        public function __construct(int $UserID,String $Username,String $password, String $firstname, String $lastname,String $email, int $phone_num, String $dob )
        {
            parent::__construct($UserID,$Username,$password,$firstname,$lastname,$email,$phone_num,$dob);
            $this->roleID = 1;
        }

        /**
         * @return int
         */
        public function getRoleID(): int
        {
            return $this->roleID;
        }



        public function __toString(): string
        {
            // TODO: Implement __toString() method.
            return 0; // This will return 0 for now
        }

        public function displayReader(){

        }
        //Call register
        public function register()
    {
        parent::register();

    }
    }

?>