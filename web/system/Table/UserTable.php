<?php
    namespace Web\System\Table;
    use Cos\Table\WebTable;

    class UserTable extends WebTable {
        
        protected $table = 'user';

      
        public function users(string $filter = null){

          if($filter != null){
            
            $filter !== 'banned' ?  $where = " level = '$filter' and " : $where = " active = '0'";
            
            return $this->query("SELECT xid as id,xusername as username, xpassword as code,xfirst_name as fname, xlast_name as lname,
                        xemai as email,user.level,created_at as joined , active  
                FROM user  WHERE $where  ORDER BY created_at DESC ");

          }else{

             return $this->query('SELECT xid as id,xusername as username, xpassword as code,xfirst_name as fname, xlast_name as lname,
                    xemai as email,user.level,created_at as joined , active  
             FROM user WHERE user.level != "god root" ORDER BY created_at DESC ');

          }


        }

        public function infos(int $user_id){
            return $this->query('SELECT xid as id,xusername as username,xfirst_name as fname, xlast_name as lname,
                                        xemai as email,user.level,created_at as joined,active as access
                                 FROM user WHERE xid = ? ', [$user_id], true);
        }
        // PArtials query | short query
        public function getRole(int $user_id){
            return $this->query('SELECT xid as id,user.level as role FROM user WHERE xid = ? ', [$user_id], true);
        }

        public function getStats(){
            return $this->query('SELECT user.level,user.active FROM user ');
        }

          /** Update */
          public function update($id, array $fields){
            $sq_parts   = [];
            $attributes = [];
    
            foreach ($fields as $k => $v) {
                 $sql_parts[] = "$k = ? ";
                 $attributes [] = $v;
            }
    
            $attributes[] =  $id;
    
            $sql_part = implode(', ' ,$sql_parts);
    
            return $this->query('UPDATE '.$this->table.' SET '.$sql_part.'  WHERE xid = ?', $attributes , true);
        }
        public function delete(int $id){

            return $this->query('DELETE FROM '.$this->table.' WHERE xid = ?', [$id] , true);
        
        }
    }


?>