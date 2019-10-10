<?php
    
    namespace Cos\Auth;
    use Cos\Database\DatabaseManagement;

    class DbAuth {

        private $db; #object
        private $crypt; #object

        public function enc() :  \Cos\Algorithm\Crypt
        {
            return $this->crypt;
        }

        public function __construct(DatabaseManagement $db = null){
            if (is_null($db)) {
                $this->crypt = new  \Cos\Algorithm\Crypt();
            }else{
                $this->db = $db;
                $this->crypt = new  \Cos\Algorithm\Crypt();
            }
         
        }
        /**
         * @param $username String
         * @param $password String
         * @return Boolean : true ? user found  false ? user not found
         */
        public function login(string $username, string $password) : bool
        {
            session_start();
            /**
             * @param SQL prepare statement
             * @param $username an prepared attribute
             * @param null : use Std class which by default
             * @param true or false : fetch <- waiting only on result 
             */
            $user = $this->db->prepare('SELECT * FROM user WHERE xusername = ? ', [$username], null, true );
       
            if  ($user) 
            {   
                if  ( $this->crypt->bcrypt_verify_password($password,  $user->xpassword) )
                {
                    $_SESSION['chadauth'] = $user->xid;
                    
                    return true;
                }

            }

            return false ;
        }
        
        /**
        * @return boolean false or the session value 
        */
        public function getUserId()
        {
            if($this->logged()){
                return $_SESSION['chadauth'];
            }

            return false;
        }
        /**
         * @return boolean 
        */
        public function logged() : bool 
        {
            return isset($_SESSION['chadauth']);
        }





    }



?>