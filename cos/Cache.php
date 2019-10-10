<?php
# debut du system  d cash l6 August 2018 - 23h13h  : not yet included in the system but tested !
namespace Cos {


// if(!$var = $cache->read('var')) {
//   sleep(1);
//   $var = 'Sleep test';
//   $cache->write('var', $var);
// }

// // echo $var; 
// if( ! $cache->start('DarkJusticeLeage') ){

//     sleep(1);
//     $var = 'Sleep 1';
//     echo $var.'<br/>';
//     $var = 'Sleep 2';
//     echo $var.'<br/>';
//     $var = 'Sleep 3';
//     echo $var.'<br/>';
//     $var = 'Sleep 4';
//     echo $var.'<br/>';
//     $var = 'Sleep 5';
//     echo $var.'<br/>';
// }
// $cache->end();


    class Cache{

        private $dirname;
        private $duration; # Chache life in Minutes
        private $buffer;
        private $serialize;

        public function __construct(string $dirname,int $duration){
            $this->dirname = $dirname;
            $this->duration= $duration;
        }
        # Writing a file with a name and content text (html allowed)
        public function write(string $filename, string $content = ''){
            #$contenu = serialize($content);
            #$content = str_replace(['','\'',"0"], ['\\','\'',"0"], $content);
            return file_put_contents($this->dirname.'/'.$filename, $content);
        }
        # reading a file
        public function read(string $filename){

            $cache = $this->dirname.'/'.$filename;

            if(!file_exists($cache)) {
                return false;
            }
            # calculating how old the file is t then comparing to it specidied duration in the cache
            $lifecache = (time() - filemtime($cache) ) / 60;

            if($lifecache > $this->duration){
                return false;
            }

            return file_get_contents($cache);
        }
        # deleting a cache file if nedeed
        public function delete(string $filename) : void {
            $cache = $this->dirname.'/'.$filename;
            if(file_exists($cache)){
                unlike($cache);
            }
        }
        # clear all caches file !attention - but no risk , the system will generate others as they a tmp files
        public function clear() : void {
            $caches = glob($this->dirname.'/*');
            foreach($caches as $cache){
                if(file_exists($cache)){
                    unlike($cache);
                }
            }
        }
        # include file caches results - only output file ... @buffer way
        public function inc(string $file, $cachename = null) : bool {
            if(!$cachename){
                $cachename = basename($file);
            }
            if($content = $this->read($file)){
                echo $content;
                return true;
            }

            ob_start();
            require $file;
            $content = ob_get_clean();

            $this->write($cachename, $content);
            echo $content;
            return true;
        }
        # multi cache -- trying buffering of cache at once

        #execution
        public function start($cachename){
            if($content = $this->read($cachename)){
                echo $content;
                $this->buffer = false;
                return true;
            }
            ob_start();
            $this->buffer = $cachename;
        }
        #end execution
        public function end(){
            if(!$this->buffer){
                return false;
            }
            $content =  ob_get_clean();
            echo $content;
            $this->write($this->buffer, $content);
        }

    }

}?>