<?php
    $systemProfileUser = System::getinstance();
    $user_table   = $systemProfileUser->getTable('user');
    $editing_user = false;
    $errors_report = [];

    $user = new \Cos\Auth\DBAuth();

    if(isset($_GET['id'])){

        if(preg_match('/^[0-9]*$/',$_GET['id'])) {
            $passed_id = $_GET['id']; 
            $getRoleofTheActiveUser = $user_table->getRole($user->getUserId());
         }

    }

    if(isset($passed_id)) {

        #Only god root and administrator can edit a user profile 
        if($getRoleofTheActiveUser->role == 'god root' || $getRoleofTheActiveUser->role == 'administrator') {

            $infos = $user_table->infos($passed_id);
            $editing_user = true;
            $roles = ['visitor','contributor','author','editor','designer','manager','administrator','god_root'];


        }
       
    }
    
    if(!isset($infos)) {
        $infos = $user_table->infos($user->getUserId());
    }
    #Anyway redirect if an errror ocuured : rare case but may happen in case of data base connexion or when the user try to bypass values 
    $infos === false || $infos === [] ? $systemProfileUser->cos_redirect('admin.php?vl='.$systemProfileUser->cursor('user')['index']['out']) : '';

?>
<?php

    if (isset($_POST['infos_changes']) AND !isset($_POST['pass_changes']) ) {
        
        $fname = isset($_POST['fname']) ? $systemProfileUser->formatInput($_POST['fname']) : $infos->fname ;
        $lname = isset($_POST['lname']) ? $systemProfileUser->formatInput($_POST['lname']) : $infos->lname ;
        $email = isset($_POST['email']) ? $systemProfileUser->formatInput($_POST['email']): $infos->email ; 

        if($editing_user){
            $role = isset($_POST['role']) ? $systemProfileUser->formatInput($_POST['role']): $infos->level ; 
            $access = isset($_POST['access']) ? $_POST['access']: $infos->access ; 
        }
        
        if($fname != '' AND $lname != ''){
           
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                
                if($editing_user) {

                    $its_oky = $user_table->update($infos->id,[
                        'xfirst_name' => $fname,
                        'xlast_name'  => $lname,
                        'xemai'       => $email,
                        'level'       => in_array($role, $roles) ? $role : $infos->level,
                        'active'      => preg_match('/^[0-9]*$/',$access) ? $access : $infos->access
                    ]);


                }else{
                #Profile change information
                    $its_oky = $user_table->update($infos->id,[
                        'xfirst_name' => $fname,
                        'xlast_name'  => $lname,
                        'xemai'       => $email
                    ]);

                }
               

                if($its_oky){
                    if($editing_user) {
                        $systemProfileUser->cos_redirect('admin.php?vl='.$systemProfileUser->cursor('user')['profile']['out'].'&id='.$infos->id);
                    }else{
                        $systemProfileUser->cos_redirect('admin.php?vl='.$systemProfileUser->cursor('user')['profile']['out']);
                    }
                    $flash->set('success','success');
                }else{
                   $flash->set('fatal_error','danger');
                }

            }else{
                $flash->set('email_invalid','warning');
            }

        }else{
           $flash->set('required','warning');
        }

        $systemProfileUser->cos_redirect('admin.php?vl='.$systemProfileUser->cursor('user')['profile']['out']);
    }
?>
<?php

    if (isset($_POST['pass_changes']) AND !isset($_POST['infos_changes']) ) {
        
        $code = isset($_POST['pass']) ? $systemProfileUser->formatInput($_POST['pass']) : '';
        $cpass = isset($_POST['cpass']) ? $systemProfileUser->formatInput($_POST['cpass']) : '';

        if ($code != '' && strlen($code) >= 6 && $code === $cpass ){
              
            $new_pass = $user->enc()->bcrypt_hash_password($code);

            $its_oky = $user_table->update($infos->id,[
                'xpassword' => $new_pass 
            ]);

           if($its_oky){
               $systemProfileUser->cos_redirect('admin.php?vl='.$systemProfileUser->cursor('user')['profile']['out']);
           }

        }

        $systemProfileUser->cos_redirect('admin.php?vl='.$systemProfileUser->cursor('user')['profile']['out']);

    }


?>
<div class="row cust_menu">
    <div class="col s10 pinned cust_menu " style='z-index:99; border-bottom:10px solid #292934'>
        <!-- Left  -->
         <div class="col s8 ">
            
             <?php if($editing_user): ?>  
                
                <h5><i class="fa fa-user"></i> Editing <?= ucfirst($infos->fname) ?>'s Profile </h5>
                <a href="?vl=<?= $systemProfileUser->cursor('user')['index']['out'] ?>" style='font-size:18px;' class='orange-text'>
                        <i class="fa fa-arrow-left"></i> Users
                </a>

                 <?php else: ?>

                <h5><i class="fa fa-user"></i> <?= ucfirst($infos->fname) ?> </h5>
                   <a href="?vl=<?= $systemProfileUser->cursor('user')['index']['out'] ?>" style='font-size:18px;' class='orange-text'>
                        <i class="fa fa-arrow-left"></i> Users
                    </a>

             <?php endif;?>
           
            <!-- <div>
                <a href="#!"> All </a>  
                <a href="#!" style='margin-left:15px;'>  Published () </a>  
            
            </div> -->
         </div>
         <div class="col s4 right-align orange-text" style='margin-top:10px;'> 
              Role : <?= ucfirst($infos->level) ?> <br/>
              User name : <?= $infos->username ?> <br/>
              Joined : <?= $infos->joined ?> 
         </div>

    </div>
</div> 
<br/><br/><br/><br/>

<div class="col s12">
    
    
    <div class="col s6" >
        <i class="fa fa-info"></i> Account infos <br/>
        <div class="col s9" style='padding:0px; '>	
            <form  method='POST'>
                    <br/>
                
                 <div  style='padding:0px;' class="col s6">
                    <p> First Name</p>
                   <input type="text" class='cust_input white-text' name='fname' value=' <?= $infos->fname ?>' required /> 
                 </div>

                 <div  style='padding:0px;' class="col s6">
                   <p > Last Name </p>
                   <input type="text" class='cust_input white-text' name='lname' value=' <?= $infos->lname ?>' required /> 
                </div>

                 <div  style='padding:0px;' class="col s12">
                    <p> Email </p>
                    <input type="email" class='cust_input white-text' name='email' value=' <?= $infos->email ?>' required /> 
                 </div>

                <?php if($editing_user): ?>
                        <div style='padding:0px;' class="col s12">
                            <label>Access </label>

                            <select name="access" >
                                    <option value="1" <?= $infos->access == 1 ? 'selected' : '' ?> > Granted </option>                        
                                    <option value="0" <?= $infos->access == 0 ? 'selected' : '' ?> > Denied </option>                        
                            </select>
                        </div>

                        <div style='padding:0px;' class="col s12">
                            <label>Role </label>

                            <select name="role" >

                                <?php foreach($roles as $role): ?>
                                    <option value='<?= $role ?>' <?=  $role==$infos->level ? 'selected' : '' ?> > <?= $role === 'god_root' ? ucfirst(str_replace('_',' ', $role)) : ucfirst($role) ?> </option> 
                                <?php endforeach;?>
                                
                            </select>
                        </div>
                 <?php endif;?>

                 <button class="btn blue" type='submit' name='infos_changes'> Save Changes</button>
            </form>   
        </div>

    </div>

    <div class="col s6" >
       <i class="fa fa-lock"></i> Password

       <form action="#!" method='post'>
             <br/>
             <p> New Password </p>
             <input type="text" class='cust_input white-text' name='pass'  required /> 

             <p > Confirm Password  </p>
             <input type="password" class='cust_input white-text' name='cpass'  required /> 

             <button class="btn blue" type='submit' name='pass_changes'> Save Changes</button>

       </form>
       

    </div>

</div>
