<?php

namespace Cos\HTML;


class Form {

    private $data = [];
    public $surround = 'p';
    
    public function __construct($data = []){
        $this->data = $data;
    }
  
    protected function surround($html){
      return "<{$this->surround}>{$html}</{$this->surround}>";
    }
  
    protected function getValue($index){
      
      if(is_object($this->data)){
         return $this->data->$index;
      }
       return isset($this->data[$index]) ? $this->data[$index] : '';
      
    
    }
  
    public function input($type,$name,$placehorder){
      return $this->surround('<input type="'.$type.'" name="'.$name.'" value="'.$this->getValue($name).'"/>');
    }
  
    public function submit($name,$placehorder){
      return $this->surround('<button type="submit" name="'.$name.'">'.$placehorder.'</button>');
    }
}

?>