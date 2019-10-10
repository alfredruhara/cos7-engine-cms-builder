<?php

    namespace Office\System\Interfaces;

    class Session  implements \Cos\Interfaces\sessionInterface, \Countable , \ArrayAccess {

        private static $_instance;

       
        public function __construct(){
            session_start();
        }

        public static function getInstance() : Session
        {
            if(is_null(self::$_instance)) 
            {
                self::$_instance = new Session();
            }
            return  self::$_instance;
        }
        
        public function get(string $key) 
        {
            if ( isset($_SESSION[$key]) ) {
                return $_SESSION[$key];
            }else{
                return null;
            }
        }
        
        public function set(string $key, $value) : void 
        {
             $_SESSION[$key] = $value;
        }
        public function exist(string $key) : ? string 
        {
            return isset($_SESSION[$key]);

        }
        public function delete(string $key) : void 
        {
             unset($_SESSION[$key]);
        }

        /**
         * Deafult php Interface .
         *   custom by Chada
         * ---------------------
         * Count elements of an object
         * @return int the custom count as an integer
         * @info the return value ia cast to an integer
         * 
         */

        public function count(){
            return 6;
        }
        
        /**
         * Deafult php Interface .
         *   custom by Chada
         * ---------------------
         * Whether a offset exists
         * @param mixed $offset
         * An offset to check for.
         * @return boolean true on success or false on failure
         * 
         * @info The return value will be casted to boolean if non-boolean was returned
         * 
         * */
         public function offsetExists($offset){
            
            return isset($_SESSION[$offset]);

         }
                 
        /**
         * Deafult php Interface .
         *   custom by Chada
         * ---------------------
         * Offset to retrieve.
         * @param mixed $offset.
         * @info The offset to retrieve.
         * @return  mixed can return all avlue types.
         * 
         * */
        public function offsetGet($offset){

            return $this->get();

        }
         /**
         * Deafult php Interface .
         *   custom by Chada
         * ---------------------
         * Offset to set.
         * @param mixed $offset.
         * @info The offset to assign to the value to.
         * @param mixed $value.
         * @info The value to set 
         * 
         * @return  void
         * 
         * */
        public function offsetSet($offset, $value){

            return $this->set($offset, $value);

        }
         /**
         * Deafult php Interface .
         *   custom by Chada
         * ---------------------
         * Offset to unset.
         * @param mixed $offset.
         * @info The offset to unset 
         * 
         * @return  void
         * 
         * */
        public function offsetUnset($offset){

            return $this->delete($offset);

        }
    }

?>