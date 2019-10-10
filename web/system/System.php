

<?php
    
    use Cos\Config;
    use Cos\Database\MysqlDatabase;

    class System {

        private  $title = 'COS';
        private static $_instance;
        private  $db_instance;
        
        #-----------------------------------#
        #      CORE OF THE WEB SYSTEM       #
        #-----------------------------------#

        # Partials Method 
        public function getTitle() : string
        {
            return $this->title;
        }
    
        public function setTitle(string $title) : void
        {
             $this->title = $title.' - '.$this->title; 
        }
        # System Instance - Singleton - Uniq Constructor 
        public static function getInstance(){
            if(is_null(self::$_instance)){
                self::$_instance = new System();
            }
            return self::$_instance;
        }
        # Run the web application 
        public static function run() : void
        { 
            $uri = $_SERVER['REQUEST_URI'];

            if(!empty ($uri) AND $uri[-1] === '/')
            {
                # $this->move_permentaly(substr($uri, 0 ,-1));
            }

            require ROOT.'/web/Autoload.php';
            Web\Autoload::register();
            
            require ROOT.'/cos/Autoload.php';
            Cos\Autoload::register();
        }
        # Get table
        public function getTable(string $name)
        {
           $class_name = '\\Web\\System\\Table\\'.ucfirst($name).'Table';
           return new $class_name($this->getDb());
        }
        # Database Connexion
        public function getDb() : MysqlDatabase 
        {
            $config = Config::getInstance(ROOT.'/config/database_credentials.php');
   
            if(is_null($this->db_instance))
            {
                $this->db_instance = new MysqlDatabase(
                 $config->get('db_name'),
                 $config->get('db_user'), 
                 $config->get('db_pass'), 
                 $config->get('db_host')
                 ) ; 
            }
            return $this->db_instance;
        }

        #-----------------------------------#
        #       HTTTP REDIRECTIONS          #
        #-----------------------------------#

        # Standard redirection Move between page 
        public function cos_redirect(string $to_page)
        {
            header('location:'.$to_page);
            exit();
        } 
        # Redirect with status code 404 : Not found
        public function e404()
        {
            header("HTTP/1.0  404 Not Found");
            header('Location: index.php?vl='.$this->hash('404'));
            exit();
        }
        # Redirect with status code 403 : Forbidden
        public function forbidden()
        {
            header("HTTP/1.0  403 foridden");
            header('Location: index.php?vl='.$this->hash('403'));
            exit();
        }
        # Redirect with status code 301 : Move permentaly
        public function move_permentaly($to_page)
        {
            header('location:'.$to_page);
            header('HTTP/1.1 301 Moved Permentaly');
            exit();
        }

        #-----------------------------------#
        #       Hash , Crypt, Token         #
        #-----------------------------------#

        # Cryting 
        public function sys_hash(string $value) : string
        {
           return sha1(md5(strtolower($value)));
        }
        # Hash by crypting  a value using sys_hash
        public function cursor(string $key) : string
        {
          $value = \Web\System\Hash::getInstance(ROOT.'/web/config/hash.php');
          return $this->sys_hash($value->get($key));
        }
        # Hash by crypting  a value using sys_hash
        public function hash(string $key) : string
        {
            $value = \Web\System\Hash::getInstance(ROOT.'/web/config/hash.php');
            return $value->get($key);
        }
        # Hash the unhash value then compare two hashes
        public function two_hashes(string $unhashed_value, string $hashed_value)
        {
            $just_hashed =  $this->sys_hash($unhashed_value);
            if(strpos($hashed_value ,(string)$just_hashed) === 0 )
            {
                $extracted_id = (float)str_replace($just_hashed, '',$hashed_value);
                return  $this->decrypt_algorithm($extracted_id);
            }else
            {
                return false ;
            }       
        }
        # Easy decrypt ids o
        public function decrypt_algorithm(int $id) : ? int
        {
            if($id < 1 || $id > 99999999999  ) return null;
            # Easy Decrypting process
            $final  = $id -56 ; $middle = $final / 4 ;  $init  = $middle / 47 ;
            
            if($init < 1 )  return null;
            return (int)$init;              
        }
        # Decrypting an id 
        public function id_decrypt(string $hash = '', int $id, bool $decrypt_only_id = false) : ? int
        {
           if($decrypt_only_id)
           {
                if ( $this->decrypt_algorithm($id) === null ) return null;
                return $this->decrypt_algorithm($id) ;
           }

           if(strpos($id ,(string)$hash) == 0 )
           {
                $extracted = (float)str_replace($hash, '',$id);
                return $this->decrypt_algorithm($extracted);
           }
        
            return null ;     
        }
        # Extract int from  string : Specific for menu | category | sub category
        public function extract_end(string $string) : ? int
        {
            $formatted_string = $this->formatInput($string);
            $exp =  explode('-',$formatted_string);
            $end_int = end($exp);

            if ( !preg_match('/^[0-9]*$/', $end_int) ) return null ;
            if ( $this->decrypt_algorithm((int)$end_int) === null ) return null;

            return $this->decrypt_algorithm((int)$end_int);
        }

        #-----------------------------------#
        #       String Manipulation         #
        #-----------------------------------#

        # Token generator
        public function token(string $length) : string
        {
            $chars = "azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN0123456789";
            return substr(str_shuffle(str_repeat($chars,$length)),0,$length);
        }
        # String input formatting
        public function formatInput($data) {
            $trim = trim($data);
            $stripslashes = stripslashes($trim);
            $clear_input = htmlspecialchars($stripslashes);
            return strtolower($clear_input);
        }
        public function sub_string($content,$length){

            if(strlen($content) > $length ){
                return substr($content, 0, $length).'<span class="orange-text"> ... </span>';
            }else{
                return $content;
            }
           
        }
        #-----------------------------------#
        #          Mode Devlpmnt           #
        #-----------------------------------#
        
        # Add on 18 August 2018  8H00 PM
        public function debug($to_debug, $trace = true, $dump = false){
            
            if ($trace){
                $trace = debug_backtrace();

                echo '<p style="color:green;">Cos Trace  : <a href="!#"  style="color:black; text-decoration:underline" onclick="$(this).parent().next(\'ol\').slideToggle(); return false;"> 
                             Location  <b>'.$trace[0]['file'].'</b>
                            On line <b>'.$trace[0]['line'].'</b>
                          </a> 
                      </p>';
    
                echo '<ol style="display:none">';
                      foreach($trace as $key => $val ){
                          if( $key > 0 ) {
                              echo '<li>
                                        location:  <b>'.$val['file'].'</b>
                                        On line <b>'.$val['line'].'</b>
                                    </li>'; 
                          }
                      }
                echo  '</ol>';
            }
            
            if($dump){
                return var_dump('<pre>',$to_debug,'</pre>');
            }
            echo '<pre>'.print_r($to_debug, true).'</pre>';
            return true;
        }
      

}

?>