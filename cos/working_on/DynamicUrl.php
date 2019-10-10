<?php
namespace Cos {
    # Class still in construction started 16 August 2018 , not yet included in the system but tested !
    class DynamicUrl{

        private $protocol = 'http://,https://';
        private $domain ;
        private $get_variables ;

        private $_url ;
        private $_file ;
        private $_params = [];

        public function __construct(string $url,string $file = ''){
            $this->_url  = $url;
            if($file != '' ) {
                $this->_file = $file;
            }
        }
        public function setFile(string $file = '') : void {
            if(is_string($file)) {
                $this->_file = $file ;
            }
        }
        public function getFile() : string {
            return $this->_file;
        }
        public function __param(array $parts = []) : void
        {
            $this->_params = $parts ;
        }
        public function render() : string {
            $url_evolution = '';
            $baseUrl = $this->_url;
            $url_evolution .= $baseUrl;

            if($this->_file != ''){
                $url_evolution .= '/'.$this->getFile();
            }
            $get_params  =  $this->_params;

            if(count($get_params) > 0 ) {
                $url_evolution .= '?';

                $format_params = [] ;

                foreach ($get_params as $k => $v) {
                    $format_params[] = "$k="."$v";
                }

                $string_params = implode('&', $format_params);

                $url_evolution .= $string_params;
            }

            return $url_evolution;
        }

        public function debug($to_debug, bool $dump = false) : void {

            if ($dump) {
                var_dump('<pre>',$to_debug,'</pre>');
            }else{
                echo '<pre>'.print_r($debug_this, true).'</pre>';
            }
            die();
        }

    }

}?>