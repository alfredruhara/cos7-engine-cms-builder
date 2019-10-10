<?php
    
    namespace Office\Test;
    class Connection{

        
    private $db_name;
    private $db_user;
    private $db_pass;
    private $db_host;
    private $uniqid;


        public function __construct($db_name='lol', $db_user= 'root',  $db_pass = '', $db_host = 'localhost')
        {
            $this->db_name = $db_name;
            $this->db_user = $db_user;
            $this->db_pass = $db_pass;
            $this->db_host = $db_host;
            $this->uniqid  = uniqid();
        }



    }

    class Model{

        private  $connection;
        private $uniqid;
        public function __construct(Connection $connection, $rgs = []){
            $this->connection  = $connection;
            $this->uniqid  = uniqid();
        }

    }
    

    $dic = new \Cos\Pattern\_Dic();

    require ROOT.'/cos/test/_dic.php';
    
    // $db = new Connection('newBase');
    // $dic->setInstance($db);
    
    
    // $dic->setFactory('Model', function() use ($dic) {
    //     return new Model($dic->get('Connection'));
    // });
    
    $systemAdmin->debug($dic->get('Office\Test\Model',false));
    $systemAdmin->debug($dic->get('Office\Test\Model',false));
    $systemAdmin->debug($dic->get('Office\Test\Model',false));
    
    
    die();

?>