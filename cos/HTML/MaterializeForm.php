<?php

namespace Cos\HTML;


class MaterializeForm extends Form {

    protected function suraround($html,$column = null ){
        return "
           <div class='row'>
                <div class='input-filed col s12'>
                    {$html}
                </div>
           </div>
                ";
    
        }
    
        
        public function input($type,$name,$placehorder){
    
            $label = '<label for="'.$placehorder.'">'.$placehorder.'</label>' ;
            $input =  '<input type="'.$type.'" name="'.$name.'" value="'.$this->getValue($name).'" class="validate">';
            
            return $this->suraround($label.$input);
       
    
        }
    
     
        public function submit($name,$placehorder){
            return '
                   <div class="row">
                        <button type="submit" name="'.$name.'" class="btn red white-text">
                            '.$placehorder.'
                        </button>
                   </div>
                   ';
        }
        // New Custome
        public function textarea($name,$placeholder){
    
            $label = '<label for="'.$placeholder.'">'.$placeholder.'</label>' ;
            $textarea = '<textarea name="'.$name.'"  id="'.$placeholder.'" class="materialize-textarea" required>'.$this->getValue($name).'</textarea>';
    
            return $this->suraround($label.$textarea);
        }
    
        private function row($html){
            return "<div class='row'>{$html}</div>";
        }
    
        public function validate($name,$placeholder,$css_class = true){
    
            if($css_class){
               $submit = '<button type="submit" name="'.$name.'" class="'.$css_class.'">'.$placeholder.' </button>';
            }else{
               $submit = '<button type="submit" name="'.$name.'" >'.$placeholder.' </button>';
            }
    
            return $this->row($submit);
        }
        public function select($name, $label, $options = [] ){
            $label = '<label>'. $label .'</label>';
            $input = '<select class="" name="'.$name.'">';
    
            foreach($options as $k => $v){
                $attributes = '';
    
                if($k == $this->getValue($name) ){
                    $attributes = ' selected';
                }
    
                $input .="<option value='{$k}'  $attributes >{$v}</option>"; 
            }
    
            $input .= '</select>';
    
            return $this->suraround($label.$input);
        }
    
    
}

?>