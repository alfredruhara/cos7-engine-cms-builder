<?php
  $systemUsers = System::getInstance();
  $user_table = $systemUsers->getTable('user');

  if(isset($_GET['role'])){
      $roles = ['visitor','contributor','author','editor','designer','manager','administrator'];
      in_array($_GET['role'],$roles) ? $role = $_GET['role'] : ''; 
  }else if (isset($_GET['access'])) {
       $_GET['access'] === 'banned' ? $access = 'banned' : '';
  }
  
  if(isset($role)) {
    $users = $user_table->users($role);
  }else if(isset($access)){
    $users = $user_table->users($access);
  }else{
    $users = $user_table->users();
  }
 

?>
<?php
  $admin_count      =0;
  $manager_count    =0;
  $designer_count   =0;
  $editor_count     =0;
  $author_count     =0;
  $contributr_count =0;
  $visitor_count    =0;
  $banned_count     =0;
  $granted_count    =0;

  if(isset($role) || isset($access) ){
      $stats = $user_table->getStats();
  }else{
      $stats = $users;
  }

  if($stats != []){
        foreach($stats as $user){
            
            $role = $user->level ;
            switch($role){

                case ($role == 'administrator'):
                $admin_count++;
                break;

                case ($role == 'manager'):
                    $manager_count++;
                break;

                case ($role == 'designer'):
                $designer_count++;
                break;

                case ($role == 'editor'):
                $editor_count++;
                break;

                case ($role == 'author'):
                $author_count++;
                break;

                case ($role == 'contributor'):
                $contributr_count++;
                break;

                case ($role == 'visitor'):
                $visitor_count++;
                break;

            }
            
            $access_count = $role != 'god root' ? $user->active : 'acha uyu' ;

            if($access_count === '1' ){
                $granted_count++; 
            }else if ($access_count === '0' ) {
                $banned_count++ ;
            }

        }
  }


?>

<form method='post' action='?vl=<?= $systemUsers->cursor('user')['firechange']['out'] ?>'>

<div class="row cust_menu">
    <div class="col s10 pinned cust_menu " style='z-index:99; border-bottom:1px solid #292934;padding-bottom:10px;'>
        <!-- Left  -->
         <div class="col s5 ">
            
            <h5>
                <i class="fa fa-user"></i> Users
            </h5>

             <a href="?vl=<?= $systemUsers->cursor('user')['profile']['out'] ?>" style='font-size:18px;' class='orange-text'>
                <i class="fa fa-edit"></i> My profile 
            </a> 
           
         </div>

         <div class="col s7" style='margin-top:10px;'> 
             <div class="nav-content" style='border-bottom:1px solid #555555'>
                    <ul class="tabs tabs-transparent cust white-text ">

                        <li class="tab"> <a  class='active white-text' href="#users"> <i class="fa fa-user"></i> Users </a>  </li>
                        <li class="tab"> <a  class='white-text' href="#newuser" > <i class="fa fa-edit"></i> New user</a>  </li>
                    
                    </ul>
              </div>
         </div>
    
    </div>
</div> 
<br/><br/><br/>


<div class="row cust" style='padding:0px;'>
     
     <div id="users" class="col s12" style='padding:0px;'> 

        <div class="nav-content" style='border-bottom:1px solid #555555'>
            <ul class="tabs tabs-transparent cust_menu ">

                <li class="tab"> <a  class='active white-text' href="#alluser"> All (<?= $granted_count ?>) </a>  </li>
                <li class="tab"> <a  class='white-text' href="#administratorusers" >  Administrator (<?= $admin_count ?>) </a>  </li>
                <li class="tab"> <a  class='white-text' href="#managerusers" >  Manager (<?= $manager_count ?>) </a>  </li>
                <li class="tab"> <a  class='white-text' href="#designerusers" >  Designer (<?= $designer_count ?>) </a>  </li>
                <li class="tab"> <a  class='white-text' href="#editorusers" >  Editor (<?= $editor_count ?>) </a>  </li>
                <li class="tab"> <a  class='white-text' href="#authorusers" >  Author (<?= $author_count ?>) </a>  </li>
                <li class="tab"> <a  class='white-text' href="#contributorusers" >  Contributor (<?= $contributr_count ?>) </a>  </li>
                <li class="tab"> <a  class='white-text' href="#visitorusers" >  Visitor (<?= $visitor_count ?>) </a> </li>
                <li class="tab"> <a  class='green-text' href="#grantedusers"  class='green-text'>  Granted (<?= $granted_count ?>) </a>   </li>
                <li class="tab"> <a  class='red-text' href="#bannedusers"  class='red-text'>  Banned (<?= $banned_count ?>) </a>  </li>

            
            </ul>
        </div>

        <div class="col s12">
        <div class="col s12">

            <div id="alluser">
                    
                  <div class="col s5 green-text"> <br/>
                        <h4> <i class="fa fa-user"></i> Users</h4>
                  </div>
                  
                   
                  <div class="col s7">
                  <br/>
                        <div class="col s6" style='padding:0px;'>
                            <div class="col s8">	
                                <label>Fire actions</label>
                                <select name="fireactions" id="">
                                        <option value="delete">Delete</option>
                                        <option value="granted">Granted access</option>
                                        <option value="denied">Denied access</option>
                                </select>
                            </div>
                            <div class="col s4" style='margin-top:32px;'> 
                                    <button class="btn z-depth-0 orange" type='submit' name='fire'>Fire</button>
                            </div>
                        </div>

                        <div class="col s6 " style='padding:0px;'>
                                <div class="col s7">
                                        <label>Change role to :</label>
                                    <select name="changeto" >
                                            <option value="visitor">Visitor</option>
                                            <option value="contributor">Contributor</option>
                                            <option value="author">Author</option>
                                            <option value="editor">Editor</option>
                                            <option value="designer">Designer</option>
                                            <option value="manager">Manager</option>
                                            <option value="administrator">Administrator</option>
                                            <option value="god_root">God root</option>
                                    </select>
                                </div>
                                <div class="col s5 right-align " style='margin-top:32px;' > 
                                        <button class="btn z-depth-0 blue" type='submit' name='change'>Change</button>
                                </div>
                        </div>

                    </div>




                    <table class="striped highlight  responsive-table">
                        <thead class='' style=''>
                            <tr >
                                <th  class="left-align"> 
                                    <p class="burn_all">
                                    <input type="checkbox"  class=''  id='burn_all' onclick="checkAll(this.form, 'idUser[]')"/>
                                    <label for="burn_all"></label> 
                                    </p>
                                </th>
                                <th  class="left-align">Username</th>
                                <th  class="left-align">Name</th>
                                <th  class="left-align" >Email</th>
                                <th  class="left-align" >Role</th>
                                <th  class="right-align" >Access</th>
                            </tr>

                        </thead>
                        <tbody>
                            <?php if ($users != []): ?>
                                    <?php foreach($users as $user): ?>
                                            <tr class='capture-hover <?=  $user->active === '0' ? 'banned_user' : ''?>'>
                                                    <td> 
                                                        <input type="checkbox" name="idUser[]" id="user<?= $user->id ?>"  value='<?= $user->id ?>' />
                                                        <label for="user<?= $user->id ?>" class='burn_action'></label>
                                                
                                                    </td>
                                                    <td  class="left-align capture-action"> 
                                                    <?= $user->username ?>
                                                    <div class="actions-hover">
                                                            <a href="?vl=<?= $systemUsers->cursor('user')['profile']['out'].'&id='.$user->id ?>">
                                                                <i class="fa fa-edit"> Edit User</i>
                                                            </a>
                                                            <a href="">
                                                                <i class="fa fa-trash red-text"> Delete</i>
                                                            </a>
                                                    </div>
                                                    </td>
                                                    <td  class="left-align"><?= $user->fname.' '.$user->fname ?></td>
                                                    <td  class="left-align" ><?= $user->email ?></td>
                                                    <td  class="left-align" ><?= ucfirst($user->level)  ?></td>
                                                    <td  class="right-align" ><?= $user->active ?></td>
                                            </tr>
                                    <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr >
                                            <td colspan='6' class='red-text'> No users found !</td>
                                        </tr>
                                <?php endif; ?>
                        </tbody>
                    </table>
            </div>
        
            <div id="administratorusers">
                    <h5> <i class="fa fa-user"></i> Administrator</h5>
                    <table class="striped highlight  responsive-table">
                        <thead class='' style=''>
                            <tr >
                            
                                <th  class="left-align">Username</th>
                                <th  class="left-align">Name</th>
                                <th  class="left-align" >Email</th>
                                <th  class="left-align" >Role</th>
                                <th  class="right-align" >Access</th>
                            </tr>

                        </thead>
                        <tbody>
                            <?php if ($users != []): ?>
                                    <?php foreach($users as $user): ?>
                                        <?php if($user->level == 'administrator' ): ?>
                                            <tr class='capture-hover <?=  $user->active === '0' ? 'banned_user' : ''?>'>
                                                
                                                    <td  class="left-align capture-action"> 
                                                    <?= $user->username ?>
                                                    <div class="actions-hover">
                                                            <a href="?vl=<?= $systemUsers->cursor('user')['profile']['out'].'&id='.$user->id ?>">
                                                                <i class="fa fa-edit"> Edit User</i>
                                                            </a>
                                                            <a href="">
                                                                <i class="fa fa-trash red-text"> Delete</i>
                                                            </a>
                                                    </div>
                                                    </td>
                                                    <td  class="left-align"><?= $user->fname.' '.$user->fname ?></td>
                                                    <td  class="left-align" ><?= $user->email ?></td>
                                                    <td  class="left-align" ><?= ucfirst($user->level)  ?></td>
                                                    <td  class="right-align" ><?= $user->active ?></td>
                                            </tr>
                                        <?php endif ?>
                                    <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr >
                                            <td colspan='6' class='red-text'> No users found !</td>
                                        </tr>
                                <?php endif; ?>
                        </tbody>
                    </table>
            </div>

            <div id="managerusers">
                    <h5> <i class="fa fa-user"></i> Manager</h5>
                    <table class="striped highlight  responsive-table">
                        <thead class='' style=''>
                            <tr >

                                <th  class="left-align">Username</th>
                                <th  class="left-align">Name</th>
                                <th  class="left-align" >Email</th>
                                <th  class="left-align" >Role</th>
                                <th  class="right-align" >Access</th>
                            </tr>

                        </thead>
                        <tbody>
                            <?php if ($users != []): ?>
                                    <?php foreach($users as $user): ?>
                                        <?php if($user->level == 'manager' ): ?>
                                            <tr class='capture-hover <?=  $user->active === '0' ? 'banned_user' : ''?>'>
                                                
                                                    <td  class="left-align capture-action"> 
                                                    <?= $user->username ?>
                                                    <div class="actions-hover">
                                                            <a href="?vl=<?= $systemUsers->cursor('user')['profile']['out'].'&id='.$user->id ?>">
                                                                <i class="fa fa-edit"> Edit User</i>
                                                            </a>
                                                            <a href="">
                                                                <i class="fa fa-trash red-text"> Delete</i>
                                                            </a>
                                                    </div>
                                                    </td>
                                                    <td  class="left-align"><?= $user->fname.' '.$user->fname ?></td>
                                                    <td  class="left-align" ><?= $user->email ?></td>
                                                    <td  class="left-align" ><?= ucfirst($user->level)  ?></td>
                                                    <td  class="right-align" ><?= $user->active ?></td>
                                            </tr>
                                        <?php endif ?>
                                    <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr >
                                            <td colspan='6' class='red-text'> No users found !</td>
                                        </tr>
                                <?php endif; ?>
                        </tbody>
                    </table>
            </div>

            <div id="designerusers">
                    <h5> <i class="fa fa-user"></i> Designer</h5>
                    <table class="striped highlight  responsive-table">
                        <thead class='' style=''>
                            <tr >
                            
                                <th  class="left-align">Username</th>
                                <th  class="left-align">Name</th>
                                <th  class="left-align" >Email</th>
                                <th  class="left-align" >Role</th>
                                <th  class="right-align" >Access</th>
                            </tr>

                        </thead>
                        <tbody>
                            <?php if ($users != []): ?>
                                    <?php foreach($users as $user): ?>
                                        <?php if($user->level == 'designer' ): ?>
                                            <tr class='capture-hover <?=  $user->active === '0' ? 'banned_user' : ''?>'>

                                                    <td  class="left-align capture-action"> 
                                                    <?= $user->username ?>
                                                    <div class="actions-hover">
                                                            <a href="?vl=<?= $systemUsers->cursor('user')['profile']['out'].'&id='.$user->id ?>">
                                                                <i class="fa fa-edit"> Edit User</i>
                                                            </a>
                                                            <a href="">
                                                                <i class="fa fa-trash red-text"> Delete</i>
                                                            </a>
                                                    </div>
                                                    </td>
                                                    <td  class="left-align"><?= $user->fname.' '.$user->fname ?></td>
                                                    <td  class="left-align" ><?= $user->email ?></td>
                                                    <td  class="left-align" ><?= ucfirst($user->level)  ?></td>
                                                    <td  class="right-align" ><?= $user->active ?></td>
                                            </tr>
                                        <?php endif ?>
                                    <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr >
                                            <td colspan='6' class='red-text'> No users found !</td>
                                        </tr>
                                <?php endif; ?>
                        </tbody>
                    </table>
            </div>

            <div id="editorusers">
                    <h5> <i class="fa fa-user"></i> Editor</h5>
                    <table class="striped highlight  responsive-table">
                        <thead class='' style=''>
                            <tr >

                                <th  class="left-align">Username</th>
                                <th  class="left-align">Name</th>
                                <th  class="left-align" >Email</th>
                                <th  class="left-align" >Role</th>
                                <th  class="right-align" >Access</th>
                            </tr>

                        </thead>
                        <tbody>
                            <?php if ($users != []): ?>
                                    <?php foreach($users as $user): ?>
                                        <?php if($user->level == 'editor' ): ?>
                                            <tr class='capture-hover <?=  $user->active === '0' ? 'banned_user' : ''?>'>
                                                
                                                    <td  class="left-align capture-action"> 
                                                    <?= $user->username ?>
                                                    <div class="actions-hover">
                                                            <a href="?vl=<?= $systemUsers->cursor('user')['profile']['out'].'&id='.$user->id ?>">
                                                                <i class="fa fa-edit"> Edit User</i>
                                                            </a>
                                                            <a href="">
                                                                <i class="fa fa-trash red-text"> Delete</i>
                                                            </a>
                                                    </div>
                                                    </td>
                                                    <td  class="left-align"><?= $user->fname.' '.$user->fname ?></td>
                                                    <td  class="left-align" ><?= $user->email ?></td>
                                                    <td  class="left-align" ><?= ucfirst($user->level)  ?></td>
                                                    <td  class="right-align" ><?= $user->active ?></td>
                                            </tr>
                                        <?php endif ?>
                                    <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr >
                                            <td colspan='6' class='red-text'> No users found !</td>
                                        </tr>
                                <?php endif; ?>
                        </tbody>
                    </table>
            </div>

            <div id="authorusers">
                    <h5> <i class="fa fa-user"></i> Author </h5>
                    <table class="striped highlight  responsive-table">
                        <thead class='' style=''>
                            <tr >
                            
                                <th  class="left-align">Username</th>
                                <th  class="left-align">Name</th>
                                <th  class="left-align" >Email</th>
                                <th  class="left-align" >Role</th>
                                <th  class="right-align" >Access</th>
                            </tr>

                        </thead>
                        <tbody>
                            <?php if ($users != []): ?>
                                    <?php foreach($users as $user): ?>
                                        <?php if($user->level == 'author' ): ?>
                                            <tr class='capture-hover <?=  $user->active === '0' ? 'banned_user' : ''?>'>
                                                
                                                    <td  class="left-align capture-action"> 
                                                    <?= $user->username ?>
                                                    <div class="actions-hover">
                                                            <a href="?vl=<?= $systemUsers->cursor('user')['profile']['out'].'&id='.$user->id ?>">
                                                                <i class="fa fa-edit"> Edit User</i>
                                                            </a>
                                                            <a href="">
                                                                <i class="fa fa-trash red-text"> Delete</i>
                                                            </a>
                                                    </div>
                                                    </td>
                                                    <td  class="left-align"><?= $user->fname.' '.$user->fname ?></td>
                                                    <td  class="left-align" ><?= $user->email ?></td>
                                                    <td  class="left-align" ><?= ucfirst($user->level)  ?></td>
                                                    <td  class="right-align" ><?= $user->active ?></td>
                                            </tr>
                                        <?php endif ?>
                                    <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr >
                                            <td colspan='6' class='red-text'> No users found !</td>
                                        </tr>
                                <?php endif; ?>
                        </tbody>
                    </table>
            </div>

            <div id="contributorusers">
                    <h5> <i class="fa fa-user"></i> Contributor</h5>
                    <table class="striped highlight  responsive-table">
                        <thead class='' style=''>
                            <tr >
                               
                                <th  class="left-align">Username</th>
                                <th  class="left-align">Name</th>
                                <th  class="left-align" >Email</th>
                                <th  class="left-align" >Role</th>
                                <th  class="right-align" >Access</th>
                            </tr>

                        </thead>
                        <tbody>
                            <?php if ($users != []): ?>
                                    <?php foreach($users as $user): ?>
                                        <?php if($user->level == 'contributor' ): ?>
                                            <tr class='capture-hover <?=  $user->active === '0' ? 'banned_user' : ''?>'>
                                                 
                                                    <td  class="left-align capture-action"> 
                                                    <?= $user->username ?>
                                                    <div class="actions-hover">
                                                            <a href="?vl=<?= $systemUsers->cursor('user')['profile']['out'].'&id='.$user->id ?>">
                                                                <i class="fa fa-edit"> Edit User</i>
                                                            </a>
                                                            <a href="">
                                                                <i class="fa fa-trash red-text"> Delete</i>
                                                            </a>
                                                    </div>
                                                    </td>
                                                    <td  class="left-align"><?= $user->fname.' '.$user->fname ?></td>
                                                    <td  class="left-align" ><?= $user->email ?></td>
                                                    <td  class="left-align" ><?= ucfirst($user->level)  ?></td>
                                                    <td  class="right-align" ><?= $user->active ?></td>
                                            </tr>
                                        <?php endif ?>
                                    <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr >
                                            <td colspan='6' class='red-text'> No users found !</td>
                                        </tr>
                                <?php endif; ?>
                        </tbody>
                    </table>
            </div>

            <div id="visitorusers">
                    <h5> <i class="fa fa-user"></i> Visitor</h5>
                    <table class="striped highlight  responsive-table">
                        <thead class='' style=''>
                            <tr >
                              
                                <th  class="left-align">Username</th>
                                <th  class="left-align">Name</th>
                                <th  class="left-align" >Email</th>
                                <th  class="left-align" >Role</th>
                                <th  class="right-align" >Access</th>
                            </tr>

                        </thead>
                        <tbody>
                            <?php if ($users != []): ?>
                                    <?php foreach($users as $user): ?>
                                        <?php if($user->level == 'visitor' ): ?>
                                            <tr class='capture-hover <?=  $user->active === '0' ? 'banned_user' : ''?>'>
                                                   
                                                    <td  class="left-align capture-action"> 
                                                    <?= $user->username ?>
                                                    <div class="actions-hover">
                                                            <a href="?vl=<?= $systemUsers->cursor('user')['profile']['out'].'&id='.$user->id ?>">
                                                                <i class="fa fa-edit"> Edit User</i>
                                                            </a>
                                                            <a href="">
                                                                <i class="fa fa-trash red-text"> Delete</i>
                                                            </a>
                                                    </div>
                                                    </td>
                                                    <td  class="left-align"><?= $user->fname.' '.$user->fname ?></td>
                                                    <td  class="left-align" ><?= $user->email ?></td>
                                                    <td  class="left-align" ><?= ucfirst($user->level)  ?></td>
                                                    <td  class="right-align" ><?= $user->active ?></td>
                                            </tr>
                                        <?php endif ?>
                                    <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr >
                                            <td colspan='6' class='red-text'> No users found !</td>
                                        </tr>
                                <?php endif; ?>
                        </tbody>
                    </table>
            </div>

            <div id="grantedusers">
                  <h5> <i class="fa fa-user green-text"> Granted users </i> </h5>
                    <table class="striped highlight  responsive-table">
                        <thead class='' style=''>
                            <tr >
                                
                                <th  class="left-align">Username</th>
                                <th  class="left-align">Name</th>
                                <th  class="left-align" >Email</th>
                                <th  class="left-align" >Role</th>
                                <th  class="right-align" >Access</th>
                            </tr>

                        </thead>
                        <tbody>
                            <?php if ($users != []): ?>
                                    <?php foreach($users as $user): ?>
                                        <?php if($user->level != 'god root'  AND $user->active == '1'): ?>
                                            <tr class='capture-hover <?=  $user->active === '0' ? 'banned_user' : ''?>'>
                                                
                                                    <td  class="left-align capture-action"> 
                                                    <?= $user->username ?>
                                                    <div class="actions-hover">
                                                            <a href="?vl=<?= $systemUsers->cursor('user')['profile']['out'].'&id='.$user->id ?>">
                                                                <i class="fa fa-edit"> Edit User</i>
                                                            </a>
                                                            <a href="">
                                                                <i class="fa fa-trash red-text"> Delete</i>
                                                            </a>
                                                    </div>
                                                    </td>
                                                    <td  class="left-align"><?= $user->fname.' '.$user->fname ?></td>
                                                    <td  class="left-align" ><?= $user->email ?></td>
                                                    <td  class="left-align" ><?= ucfirst($user->level)  ?></td>
                                                    <td  class="right-align" ><?= $user->active ?></td>
                                            </tr>
                                        <?php endif ?>
                                    <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr >
                                            <td colspan='6' class='red-text'> No users found !</td>
                                        </tr>
                                <?php endif; ?>
                        </tbody>
                    </table>
            </div>

            <div id="bannedusers">
                <h5> <i class="fa fa-user red-text"> Denied Users </i> </h5>
                    <table class="striped highlight  responsive-table">
                        <thead class='' style=''>
                            <tr >
                            
                                <th  class="left-align">Username</th>
                                <th  class="left-align">Name</th>
                                <th  class="left-align" >Email</th>
                                <th  class="left-align" >Role</th>
                                <th  class="right-align" >Access</th>
                            </tr>

                        </thead>
                        <tbody>
                            <?php if ($users != []): ?>
                                    <?php foreach($users as $user): ?>
                                        <?php if($user->level != 'god root'  AND $user->active == '0' ): ?>
                                            <tr class='capture-hover <?=  $user->active === '0' ? 'banned_user' : ''?>'>
                                                
                                                    <td  class="left-align capture-action"> 
                                                    <?= $user->username ?>
                                                    <div class="actions-hover">
                                                            <a href="?vl=<?= $systemUsers->cursor('user')['profile']['out'].'&id='.$user->id ?>">
                                                                <i class="fa fa-edit"> Edit User</i>
                                                            </a>
                                                            <a href="">
                                                                <i class="fa fa-trash red-text"> Delete</i>
                                                            </a>
                                                    </div>
                                                    </td>
                                                    <td  class="left-align"><?= $user->fname.' '.$user->fname ?></td>
                                                    <td  class="left-align" ><?= $user->email ?></td>
                                                    <td  class="left-align" ><?= ucfirst($user->level)  ?></td>
                                                    <td  class="right-align" ><?= $user->active ?></td>
                                            </tr>
                                        <?php endif ?>
                                    <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr >
                                            <td colspan='6' class='red-text'> No users found !</td>
                                        </tr>
                                <?php endif; ?>
                        </tbody>
                    </table>
            </div>

        </div>
        </div>

     </div>

     <div id="newuser" class="col s12">
     
     
     
     
     
     
     </div>
 
 </div>
</form>