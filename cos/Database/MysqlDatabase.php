<?php
  namespace Cos\Database;
  use \PDO;

    class MysqlDatabase extends __DatabaseManagement{

        private $db_name;
        private $db_user;
        private $db_pass;
        private $db_host;
        
        private $pdo;

        public function __construct($db_name, $db_user= 'root',  $db_pass = '', $db_host = 'localhost')
        {
            $this->db_name = $db_name;
            $this->db_user = $db_user;
            $this->db_pass = $db_pass;
            $this->db_host = $db_host;
        }
        # Mysql PDO connection and Maethids 
        private function getPDO()
        { 
            if($this->pdo === null )
            {
                $pdo = new PDO("mysql:dbname=$this->db_name;dbhost=$this->db_host", $this->db_user, $this->db_pass);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->pdo = $pdo;
            }

            return $this->pdo;
        }
        # Unprepared Query
        public function query(string $statement, $class_name = null ,bool $TryingToGetPropertyOfNonObject = false)
        {             
            $req = $this->getPDO()->query($statement);
                
            if ( strpos($statement, 'UPDATE') === 0 || strpos($statement, 'INSERT') === 0 || strpos($statement, 'DELETE') === 0 )
            {
            return $req;
            }
            # If the class name is not defined else : use STD CLASS
            if  ( $class_name === null )
            {
                $req->setFetchMode(PDO::FETCH_OBJ);  
            }else
            {
                $req->setFetchMode(PDO::FETCH_CLASS, $class_name);  
            }
            # True : excepting One result (No object) , else : false  excepting many result (Object)
            if  ( $TryingToGetPropertyOfNonObject === true )
            {
                $datas = $req->fetch();
            }else
            {
                $datas = $req->fetchAll();
            }

            return $datas;
        }
        # Prepared Query
        public function prepare(string $statement,array $attributes , $class_name = null, bool $TryingToGetPropertyOfNonObject = false  )
        {
            $req = $this->getPDO()->prepare($statement);
            $res = $req->execute($attributes);

            if  (
                strpos($statement, 'UPDATE') === 0 ||
                strpos($statement, 'INSERT') === 0 ||
                strpos($statement, 'DELETE') === 0 
            )
            {
               return $res;
            }

            if  ( $class_name === null )
            {
                $req->setFetchMode(PDO::FETCH_OBJ);  
            }else
            {
                $req->setFetchMode(PDO::FETCH_CLASS, $class_name);  
            }
            
            if  ( $TryingToGetPropertyOfNonObject === true )
            {
                $datas = $req->fetch();
            }else
            {
                $datas = $req->fetchAll();
            }

            return $datas;
        }
        # Coutn Query
        public function counted(string $statement,array $attributes = null )
        {
            $req = $this->getPDO()->prepare($statement);
            
            if  ($attributes)
            {
                $req->execute($attributes);
            }else
            {
                $req->execute();
            }

            $count = $req->rowCount();
            $req->closeCursor();

            return $count;
        }
        # Last insert record id
        public function lastInsertId() : int
        {
            return $this->getPDO()->lastInsertId();
        }

        
    }



 ?>
