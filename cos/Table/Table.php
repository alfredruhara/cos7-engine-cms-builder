<?php
    namespace Cos\Table;
    
    use Cos\Database\__DatabaseManagement;
    
    class Table {

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
        # Insert query -Create
        public function create(array $fields)
        {
            $sq_parts   = [];
            $attributes = [];
        
            foreach ($fields as $k => $v) {
                 $sql_parts[] = "$k = ? ";
                 $attributes [] = $v;
            }
            $sql_part = implode(', ' ,$sql_parts);
        
            return $this->query('INSERT INTO '.$this->table.' SET '.$sql_part.' ', $attributes , true);
        }
        # Delete query
        public function delete(int $id)
        {
            return $this->query('DELETE FROM '.$this->table.' WHERE id = ?', [$id] , true);
        }
        # Update query 
        public function update($id, array $fields)
        {
            $sq_parts   = [];
            $attributes = [];
    
            foreach ($fields as $k => $v) {
                 $sql_parts[] = "$k = ? ";
                 $attributes [] = $v;
            }

            $attributes[] =  $id;
            $sql_part = implode(', ' ,$sql_parts);
    
            return $this->query('UPDATE '.$this->table.' SET '.$sql_part.'  WHERE id = ?', $attributes , true);
        }
        # Select - option - list */
        public function select_list(int $key, string $value ,array $record = [] )
        {
            $records = $record;
            $return = [];
    
            foreach ($records as $v) {
                $return[$v->$key] = $v->$value;
            }
          
            return $return ;
       }
        # Easy find 
        public function findAll($menu_id){
            return $this->query("SELECT menu_id FROM ".$this->table." WHERE menu_id = ? ", [$menu_id]);
        }

    }

?>