<?php

    namespace Office\System\Interfaces;

    class Flash  {

        private $session;
        const KEY = "chadflash";
        private static $_instance;
        #recently added - 5 August 2018
        private $multi_flash = [];
        # 6 August 2018
        //private $flags = ['green','orange','red'];
        private $msg_flash = [
            'success' => [
                'update'             => 'Changes saved.' ,
                'success'            => 'Action perfomed successfully!',      
                'comment_delete'     => 'Comment deleted',
                'mark_spam'          => 'Comment mark as Spam',
                'restore_from_spam'  => 'Comment restored from Spam',
                'move_to_trash'      => 'Comment moved to the Trash',
                'restore_from_trash' => 'Comment restored from to the Trash'
            ],
            'warning' => [
                'not'                => 'Warning : Action not perfomed !',
                'required'           => 'Warning : Make sure required fields are not empty ',
                'email_invalid'      => 'Warning : Email invalid ',
                'password_length'    => 'Warning : Password lenght must be greater or equal to 6 caracters '
            ],
            'danger' => [
                'fatal_error'        => 'Fatal Error : An error occured while saving data to the database. Try again !',
                'unexcepted'         => 'Unexcepted : the form sent unexcepted datas or check if everything are Oky. !',
                'upload_error'       => 'Upload Failed : An error occured while uploading the image. Try again !',
                'id_error'           => 'Incorrect ID(s) or check if everything are Oky. Try again !',
                'dir_error'          => 'Failed to create a directory',
                'com_ref_broken'     => 'it seems that this comment has broken ids references or does not exist !you can delete it' 
            ]
                 
        ];
        
        public function __construct(Session $session){
            $this->session = $session;
        }

        public static function getInstance(Session $session) : Flash 
        {
            if(self::$_instance === null){
                self::$_instance = new Flash($session);
            }
            return self::$_instance;
        }
        # 6 August 2018
        private function alert(string $type, string $msg_key) : ? string
        {
            if(isset($this->msg_flash[$type])) {

                if(isset($this->msg_flash[$type][$msg_key])) {

                    if($type === 'success') {
                        $flag = 'green';
                    }else if ($type === 'warning'){
                        $flag = 'orange';
                    }else{
                        $flag = 'red';
                    }

                    return $this->msg_flash[$type][$msg_key].','.$flag;
                }
            }
            return null;
        }

        public function set(string $msg_key = 'success' , string $type = 'success' ) : void
        {
           $alert = $this->alert($type,$msg_key);

           if( $alert !== null )
           {
               $parts = explode(',', $alert);
               $message = $parts[0];
               $flag    = $parts[1];
           }else
           {
               $message = $msg_key;
               $flag    = $type ;
           }
           $this->multi_flash []  = [
            'message' => $message,
            'type'    => $flag
           ];
           
           $this->session->set(self::KEY , $this->multi_flash );
        }
      
        public function get()
        {
            $flash = $this->session->get(self::KEY);
            $this->session->delete(self::KEY);
            return $flash;
        }
        
       

        public function verify(string $key = 'chadflash')  {
            $key = self::KEY;
            return $this->session->get($key);
        }
    }

?>