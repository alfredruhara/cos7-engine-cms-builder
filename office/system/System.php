<?php
    declare(strict_types = 1);

    use Cos\Config;
    use Cos\CursoTo;
    use Cos\Hash;
    use Cos\Database\MysqlDatabase;

    class System {

     
        private  $title = 'COS';
        
        /** Partials Method */
        public function getTitle(){
            return $this->title;
        }
  
        public function setTitle($title) : void {
              $this->title = $title.' - '.$this->title; 
        }

        /**
         * Requested Url Not Found 
         * Redirect with an error 404
         * @return Header 404
         */
        public function e404(){

            header("HTTP/1.0  404 Not Found");
            header('Location: index.php?vl='.$this->hash('404'));
        
        }
        public function a404(){

            header("HTTP/1.0  404 Not Found");
            header('Location: admin.php?vl='.$this->hash('404'));
        
        }
        public function cos_redirect($to_page){
            header('location:'.$to_page);
            die();
        } 
        /**
         * Access denied - Forbidden
         * Redirect with an header 403
         * @return Header 403
         */
        public function forbidden(){

            header("HTTP/1.0  403 foridden");
            header('Location: index.php?vl='.$this->hash('403'));
        
        }
        public function sub_string(string $content, int $length) : string {

            if(strlen($content) > $length ){
                return substr($content, 0, $length).'<span class="orange-text"> ... </span>';
            }else{
                return $content;
            }
           
        }
        /** End of Partails Method */

        private static $_instance;
        private  $db_instance;
        
        public static function run() : void {
            /** autoload classes from system folder when  called */

            $uri = $_SERVER['REQUEST_URI'];
            #checking if the link end with / at the end .
            if(!empty ($uri) AND $uri[-1] === '/'){
                #remove the slashe at the end and redirect
              //  header('location:'.substr($uri, 0 ,-1));
                //header('HTTP/1.1 301 Moved Permentaly');
                //exit();
            }
            require ROOT.'/office/system/Autoload.php';
            Office\System\Autoload::register();
            
            /** autoload classes from Cpu folder when called */
            require ROOT.'/cos/Autoload.php';
            Cos\Autoload::register();
        }

        
       public static function getInstance() : System 
       {
            if(is_null(self::$_instance)){
                self::$_instance = new System();
            }
            return self::$_instance;
       }
       public function getTable(string $name)
       {
           $class_name = '\\Office\\System\\Table\\'.ucfirst($name).'Table';
           return new $class_name($this->getDb());
       }
       public function getDb()
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
       public function __session() : \Office\System\Interfaces\Session
       { 
            return \Office\System\Interfaces\Session::getInstance();
       }
       public function __flash($session) : \Office\System\Interfaces\Flash
       {
            return \Office\System\Interfaces\Flash::getInstance($session);
       }

       /** hasing sysyem */
       public function sys_hash($value){
           return sha1(md5(strtolower($value)));
       }

       public function cursor($location) : ?array
       {
            $pointer = CursoTo::getInstance(ROOT.'/office/config/pointers.php');
            return $pointer->get($location);
       }


        /**
         * Token Generator
         * @param _$length : length of the token to be generated
         * @return String of Alpha _ numeric
         */
        public function token($length){
            $chars = "azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN0123456789";
            return substr(str_shuffle(str_repeat($chars,$length)),0,$length);
        }

         
        # FILE , FOLDER ,etc MANUPILATION
        # creating files, folders, upload files, get size , scan folders, etc

        /**
         * Make a directory 
         * @param _$path : where to create a folder
         * @return created_folder_name
         */

        public function makeDir($path) {

            //  $dirname = $this->token(8);
            $dirname = 'exist';

            if(is_dir($path.$dirname)) {

                $inc = 1 ;

                while (is_dir($path.$dirname)  ) {

                    $inc++; 
                    $dirname = $this->token(8+$inc);

                }

                mkdir($path.$dirname);
               
            }

            if ( is_dir ($path.$dirname) ){
                return $dirname;
            }else{
                return false;
            }

    
        }
        
        /**  
        * Image File upload 
        * @param _$image : $_FILES['name']['']             eg : $_FILES['myImage']
        * @param _$path  : pathe where to uplaod the file  eg : '../chadanet/'
        * @return boolean false if an error occured otherwise i
        * @return Generated_file_name.file_extension if there is no error  eg : gdvhegh23979hbvdf.jpg
        */


        public function doUpload($image,$path){
             /** Getting the image file name */
            $file = $this->formatInput($image['name']);

            /** Force Check */
            if(!empty( $file )){
                    
                    $allowed_extension = ['.png','.jpg','.jpeg'];
                    /** Extracting the file extension from the file name */
                    $extension = strrchr($file,'.');

                    /** check if the extension extracted from the file name exists in [] of allowed extensions*/
                    if(!in_array(strtolower($extension),$allowed_extension)){
                        return false;
                        /** Expected error */
                        return "extension not supported" ;
                    }else{
                        /** Generating  a new file name  with a token of 12 alpha numeric caracters*/
                        $token_file_name = $this->token(12) ; 
                        /** Ready  to upload the file  */
                        $build_file = $path.$token_file_name.$extension;

                        /** If the file exist  */
                        if(file_exists($build_file)) {

                            /** Continue looping into the path whole generating new file name and incrementing the token size of generation*/
                            while( file_exists($build_file) ){
                                /** New token generated */
                                $token_file_name = $this->token(14+2)."new";
                                /** Once agian ready to upload the file  */
                                $build_file  = $path.$token_file_name.$extension;

                            }
                          
                        }

                       /** File does not exist so ... j'upload le fichier  */
                       if( move_uploaded_file($image['tmp_name'] ,$build_file ) ){
                            return $token_file_name.$extension;
                             /** File uploaded */
                            return true;
                       }else{
                           return false;
                           /** Expected error */
                           return 'failed to download the image ...';
                       }
                      
                    }
             }else{
                 return false;
                 /** Expected error */
                 return "empty";
             }


           
        }
        /**
         * Return the total size of the folder + all it sub folders files and so on ... this scan the entire path given
         * @param _$path : path to scan 
         * @return folder size int and count files 
         */
        public function folderSize($path) {
            $total_size = 0;
            $total_items = 0;
            
            if ( !is_dir($path) ) return 0;
            $files = scandir($path);
          
            foreach($files as $t) {
              if (is_dir(rtrim($path, '/') . '/' . $t)) {
                if ($t<>"." && $t<>"..") {
                    $size = $this->folderSize(rtrim($path, '/') . '/' . $t);
          
                    $total_size += $size;
                    $total_items++;
                }
              } else {
                $size = filesize(rtrim($path, '/') . '/' . $t);
                $total_size += $size;
                $total_items++;
              }
            }
            return $total_size.",".$total_items;
        }
        /**
         * File counter : can also count folders
         */
        public function countFile( string $path) : string 
        {
            $total_items = 0;
            $total_folder = 0;
            $file_threes = scandir($path); 
            $allowed_extensions = ['.png','.jpg','.jpeg','.jfif'];
        
            foreach($file_threes as $file_or_folder)
            {
                if (is_dir(rtrim($path, '/') . '/' . $file_or_folder)) 
                {
                    if ($file_or_folder<>"." && $file_or_folder<>"..") 
                    {
                       $new_file_three = scandir($path.$file_or_folder.'/');
                       foreach( $new_file_three as $new_file)
                       {
                            $extension_new = strrchr($new_file,'.');
                            if(in_array(strtolower($extension_new),$allowed_extensions)){
                                $total_items++;
                            }
                       }
                       $total_folder++;
                    }
                }else
                {
                    $extension = strrchr($file_or_folder,'.');
                    if(in_array(strtolower($extension),$allowed_extensions)){
                        $total_items++;
                    }
                } 
            }

            return  $total_items.",".$total_folder;
        }
         /**
          * THIS EXTENDS folderSize METHOD 
         * Return the total size of the folder + all it sub folders files and so on ... this scan the entire path given
         * @param _$path : path to scan 
         * @return folder size int 
         * 
         * Sloves problems with differents host Os . works on Linux and Win
         */

        function getTotalSize(string $dir) : int 
        {
            $dir = rtrim(str_replace('\\', '/', $dir), '/');
        
            if (is_dir($dir) === true) {
                $totalSize = 0;
                $os        = strtoupper(substr(PHP_OS, 0, 3));
                // If on a Unix Host (Linux, Mac OS)
                if ($os !== 'WIN') {
                    $io = popen('/usr/bin/du -sb ' . $dir, 'r');
                    if ($io !== false) {
                        $totalSize = intval(fgets($io, 80));
                        pclose($io);
                        return $totalSize;
                    }
                }
                // If on a Windows Host (WIN32, Windows)
                if ($os === 'WIN' && extension_loaded('com_dotnet')) {
                    $obj = new \COM('scripting.filesystemobject');
                    if (is_object($obj)) {
                        $ref       = $obj->getfolder($dir);
                        $totalSize = $ref->size;
                        $obj       = null;
                        return $totalSize;
                    }
                }
                // If System calls did't work, i use a slower PHP 5 way
                $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($dir));
                foreach ($files as $file) {
                    $totalSize += $file->getSize();
                }
                return $totalSize;

            } else if (is_file($dir) === true) {

                  return filesize($dir);

            }

        }
        /**
         * Get a file size after giving it path
         * return file size || file size plus iamge dimensions
         */
        public function fileSize(string $file_path, bool $dimensions = false){
            
            if(!file_exists($file_path)) return false;
            
            if($dimensions)
            {
                $filesize = filesize($file_path);
                list($width, $height) = getimagesize($file_path);

                return $filesize.",".$width.",".$height;
            }else
            {
                $filesize = filesize($file_path);
                return $filesize;
            }
            
        }
        /**
         * Super Converter 
         * @param size int value
         * @return real size.
         * 
         * Support all Units when returning the value
         */
        public function formatSize( int $size) : ? string {
        
            $mod = 1024;
            $units = explode(' ','B KB MB GB TB PB');
            for ($i = 0; $size > $mod; $i++) {
                $size /= $mod;
            }
            
            return round($size, 2) . ' ' . $units[$i];
        }

        /**
         * Get all for a specific directory
         * Return files of a given folder as parameter ($path_folder)
         * @return [] of files
         */
        public function getFiles(string $path) : ?array
        {    
            if(!is_dir($path)) return null ;

            $folders_or_files = scandir($path);
            $files_found = [];
            $allowed_extensions = ['.png','.jpg','.jpeg','.jfif'];

            if  ( count($folders_or_files) > 0 )
            {
                foreach ($folders_or_files as $folder_or_file)
                {    
                    $file_extension = strrchr($folder_or_file,'.');
                    if(in_array(strtolower((string)$file_extension),$allowed_extensions))
                    {
                        $files_found []  = $folder_or_file;
                    }
                }

                return  $files_found;
            }
        }
        /**
         * Delete a file
         * @param path of the file
         * @return boolean true if success false : something happen 
         */
        public function unlikeFile($path_to_file){
            $path = $path_to_file;

            if(file_exists($path)){

                if(@unlink($path)){
                    return true;
                }else{  
                    return false;
                }

            }
            return false;
        }
        /**
         * Get the width and Heigh of an image
         * @param path of the file
         * @return width and height in px 
         */
        public function fileDimensions($path_to_file){
            $path = $path_to_file;

            if(file_exists($path)){
                list($width, $height) = getimagesize($path);
                return $width.",".$height; 
            }
            return false;
        }

        public function delete_directory($dirname) {
            if (is_dir($dirname))
              $dir_handle = opendir($dirname);
        if (!$dir_handle)
             return false;
        while($file = readdir($dir_handle)) {
              if ($file != "." && $file != "..") {
                   if (!is_dir($dirname."/".$file))
                        unlink($dirname."/".$file);
                   else
                        delete_directory($dirname.'/'.$file);
              }
        }
        closedir($dir_handle);
        rmdir($dirname);
        return true;
       }

      public function delete_files($target) {
        if(is_dir($target)){
            $files = glob( $target . '*', GLOB_MARK ); //GLOB_MARK adds a slash to directories returned
    
            foreach( $files as $file ){
                delete_files( $file );      
            }
    
            rmdir( $target );
        } elseif(is_file($target)) {
            unlink( $target );  
        }
    }


       /**
        *  Input Validation 
        */
        public function formatInput($data) {
            $trim = trim($data);
            $stripslashes = stripslashes($trim);
            $clear_input = htmlspecialchars($stripslashes);
            return strtolower($clear_input);
        }
          
    # MISc
    public function connexionStatus(){
        switch (connection_status())
            {
            case CONNECTION_NORMAL:
                 $txt = 'Connection is in a normal state';
                 break;
            case CONNECTION_ABORTED:
                 $txt = 'Connection aborted';
                 break;
            case CONNECTION_TIMEOUT:
                 $txt = 'Connection timed out';
                  break;
            case (CONNECTION_ABORTED & CONNECTION_TIMEOUT):
                 $txt = 'Connection aborted and timed out';
                  break;
            default:
                 $txt = 'Unknown';
                 break;
            }

            return  $txt;

      }

    public function fileColored($path){
        if(file_exists($path)) {
           return highlight_file($path);
        }
    }
    
    #----------------------------------#
    #          Mode Devlpmnt           #
    #----------------------------------#
        
    # Add on 21 August 2018  8H00 PM
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