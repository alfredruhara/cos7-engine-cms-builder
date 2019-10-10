<?php

    namespace Cos\Algorithm;

    
    class Crypt  extends Algorithm{


        public function bcrypt_hash_password($value, $options = []){

            $cost = isset($options['rounds']) ? $options['rounds'] : 10 ;

            $hash = password_hash($value, PASSWORD_BCRYPT , array('cost' => $cost));

            if($hash === false){
                throw new Exception("Bcryp hashing is not supported ");
                //Bcryp :   need of mcrypt extention being activated 
            }
    
            return $hash;
        }

        public function bcrypt_verify_password($value, $hashedValue){
            return password_verify($value , $hashedValue);
        }

       

    }


?>
