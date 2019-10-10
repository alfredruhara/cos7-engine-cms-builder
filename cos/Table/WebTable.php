<?php
    namespace Cos\Table;
    
    use Cos\Database\__DatabaseManagement;
    
    class WebTable {

        protected $table;
        protected $db;
        # Return Sql Table , Table class , connected on the database directly
        public function __construct(__DatabaseManagement $db)
        {
            $this->db = $db;
         
           if( $this->table === null )
           {
                $parts = explode('\\', get_class($this));
                $class_name = end($parts);
                $this->table = strtolower(str_replace('Table', '', $class_name));
           }

           return  $this->table;
        }
        # Magic Query | Constructor query according to parameters passed
        public function query(string $statement, array $attributes = null, bool $TryingToGetPropertyOfNonObject = false)
        {     
            if($attributes != null)
            {
                return $this->db->prepare(
                    $statement,
                    $attributes,
                    str_replace('Table', 'Entity', get_class($this)),
                    $TryingToGetPropertyOfNonObject
                );
            }else
            {
                return $this->db->query(
                    $statement,
                    str_replace('Table', 'Entity', get_class($this)),
                    $TryingToGetPropertyOfNonObject
                );
            }

        }
        # Select All
        public  function all()
        {
            return $this->query("SELECT *         
                FROM ".$this->table."
                ORDER BY date
                DESC
                ");
        }
        # Select query where id = ?  
        public  function find(int $id)
        {
            return $this->query("SELECT *         
            FROM ".$this->table."
            WHERE id = ? 
            ORDER BY date
            DESC
            ", [$id] , true );
        }
        # Easy find 
        public function findAll($menu_id){
            return $this->query("SELECT menu_id FROM ".$this->table." WHERE menu_id = ? ", [$menu_id]);
        }

    }

?>