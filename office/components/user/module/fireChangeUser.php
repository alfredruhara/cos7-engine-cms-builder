<?php
  
  $systemFireChange = System::getInstance();
  $excepted_selected_values = ['delete','granted','denied','visitor','contributor','author','editor','designer','manager','administrator','god_root'];
  $report_errors = [];
  $back = '?vl='.$systemFireChange->cursor('user')['index']['out'];

  if( ( isset($_POST['fire']) || isset($_POST['change']) )  AND ( !isset($_POST['newuser']) ) ){

        $users_id  = isset($_POST['idUser']) ? $_POST['idUser'] : '';  
       
        if(isset($_POST['fire']) AND !isset($_POST['change']) ){
            $fired = isset($_POST['fireactions']) ? $systemFireChange->formatInput($_POST['fireactions']) : 'not';
        }
        if(isset($_POST['change']) AND !isset($_POST['fire'])  ){
            $changeto =  isset($_POST['changeto']) ? $systemFireChange->formatInput($_POST['changeto']) : '';
        }
        
        #check the selected fire action 
        if( in_array( isset($fired) ? $fired : $changeto  , $excepted_selected_values) ) {
           
            #Making sure we have received users ids
            if ($users_id!= '' AND $users_id!= [] ) {
                 #use 
                 $user_table = $systemFireChange->getTable('user');

                 foreach($users_id as $user_id){
                     if(preg_match('/^[0-9]*$/',$user_id)){

                        if(isset($fired)){
                                switch($fired){
  
                                    case ($fired == 'delete'):
                                        $oky = $user_table->delete($user_id);
                                    break;

                                    case ($fired == 'granted'):
                                        $oky = $user_table->update($user_id,['active' => 1]);
                                    break;
    
                                    case ($fired == 'denied'):
                                        $oky = $user_table->update($user_id,['active' => 0]);
                                    break;

                                    default: 
                                        $flash->set('unexcepted','danger');
                                        break;    
                                
                                }
                         }#end of fire action

                         if(isset($changeto)){
                                switch($changeto){
                                    case ($changeto == 'visitor'):
                                        $oky = $user_table->update($user_id,['level' => $changeto]) ;
                                    break;
                                 
                                    case ($changeto == 'contributor'):
                                        $oky = $user_table->update($user_id,['level' => $changeto]) ;
                                    break;

                                    case ($changeto == 'author'):
                                        $oky = $user_table->update($user_id,['level' => $changeto]) ;
                                    break;

                                    case ($changeto == 'editor'):
                                        $oky = $user_table->update($user_id,['level' => $changeto]) ;
                                    break;

                                    case ($changeto == 'designer'):
                                        $oky = $user_table->update($user_id,['level' => $changeto]) ;
                                    break;

                                    case ($changeto == 'manager'):
                                        $oky = $user_table->update($user_id,['level' => $changeto]) ;
                                    break;

                                    case ($changeto == 'administrator'):
                                        $oky = $user_table->update($user_id,['level' => $changeto]) ;
                                    break;

                                    case ($changeto == 'god_root'):
                                        $oky = $user_table->update($user_id,['level' => 'god root']) ;
                                    break;

                                    default: 
                                       $flash->set('unexcepted','danger');
                                    break;    
                                
                                }

                         }#end of change to action
                       
                     }else{
                            $flash->set('id_error','danger');
                     }

                 } #end of foreach loop

                 $systemFireChange->cos_redirect($back);


            }else{
                $flash->set('required','warning');
            }
    

        }else{
            $flash->set('unexcepted','danger');
        }

      $systemFireChange->cos_redirect($back);

 }



 
 if( isset($_POST['newuser'])  AND !isset($_POST['fire']) AND !isset($_POST['change']) ){

        $username = isset($_POST['username']) ? $systemFireChange->formatInput($_POST['username']) : '';
        $code = isset($_POST['password']) ? $systemFireChange->formatInput($_POST['password']) : '';
        $email = isset($_POST['email']) ? $systemFireChange->formatInput($_POST['email']) : '';
        $role = isset($_POST['role']) ? $systemFireChange->formatInput($_POST['role']) : 'visitor';

        if($username != '' AND $code != ''){

            if(strlen($code) >=  6) {
            
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    
                    if(!in_array($role, $excepted_selected_values)) {
                      $role = 'visitor';
                    }

                    $user_table = $systemFireChange->getTable('user');
                    $crypt = new Cpu\Algorithm\Crypt();

                    $oky = $user_table->create([
                        'xusername'   => $username,
                        'xpassword'   => $crypt->bcrypt_hash_password($passord),
                        'xfirst_name' => $role,
                        'xlast_name'  => 'agent',
                        'xemai'       => $email,
                        'level'       => $role,
                        'active'      => 1
                    ]);

                    $oky === true ?  $flash->set('success','success') : $flash->set('fatal_error','danger') ;
                
                }else{
                    $flash->set('email_invalid','warning');
                }

            }else{
                $flash->set('password_length','warning');
            }


        }else{
            $flash->set('required', 'warning');
        }
 }

 #Anyway never stay on this page
 $systemFireChange->cos_redirect($back);
  
?>