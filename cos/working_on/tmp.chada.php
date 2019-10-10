
Layout : article/ index.php
<div class="col m3 s3 l3 cust pinned" style="top:20%;right:12%; height:80%;" >
            <h2 class="center-align white-text cust_title"> Categories  </h2>
            <h5 class='white-text'> 
                    <a  href="index.php?vl=<?=  $sys->hash('index') ?>" class='cust_cat'>
                       All :  <?=   $count_posts ?>  
                   </a> 
           </h5>

            <?php foreach( $categories  as $category) : ?>

                <h5 class='white-text'> 
                    <a href="<?= $category->url ?>" class='cust_cat'>
                       <?= $category->title ?>  : <?= $article->counted($category->id) ?>  
                   </a> 
                </h5>
            <?php endforeach ; ?>
</div>

#Tabs Navigation Structure

<div class="nav-content" style='border-bottom:1px solid #555555'>
    <ul class="tabs tabs-transparent cust ">
        <li class="tab"><a  class='white-text' href="#test1"> <i class="fa fa-upload"></i>  Update</a></li>
        <li class="tab"><a  class="active white-text"     href="#test2"> <i class="fa fa-magic"></i> Clear </a></li>
        <li class="tab"><a  class='white-text' href="#test4"><i class="fa fa-star"></i> Point </a></li>
        <li class="tab"><a  class='white-text' href="#test4"><i class="fa fa-archive"></i> Archive</a></li>
        <li class="tab"><a  class='red-text' href="#test4"> <i class="fa fa-trash"></i> Delete</a></li>
    </ul>
</div>
<div class="row cust" style='padding:10px;'>
     
    <div id="test1" class="col s12">Test 1</div>
    <div id="test2" class="col s12">Test 2</div>
    <div id="test4" class="col s12">Test 4</div>

</div>

# Too old to hide but the block still there case when u pinned (position fixed) a screen on left

<div class="col s2 l2 m2" style="color:transparent;">n</div>

# Too old : at begining the side at three side : left center and right screens : i removed the right one here the code    

<div class="col s2 l2 m2 customNav customRight"> 
    <h3> <i class="orange-text fa fa-clone"></i> New </h3>

        <br/>
        <div class="row">
            <div class="conatainer">
                <ul>
                    <li class="" id=""><i class="orange-text fa fa-edit "></i> 
                        <a href="?vl=<?= $systemDefault->hash('admin.add') ?>" class='white-text'> New Article</a>
                    </li>

                    <li class="" id=""><i class="orange-text fa fa-edit "></i> 
                        <a href="?p=admin.category.write" class='white-text'> New Category</a>
                    </li>

                    <li class="" id=""><i class="orange-text fa fa-at "></i> 
                        <a href="?vl=" class='white-text'> New Admin</a>
                    </li>

                </ul>
            </div>
        </div>

</div>

# ah ... new User in table ... old fashion way in user.php to add a new user : this were a quick

  <tr class='input_table_hover'>
                        <td>New user</td>
                        <td class='here'>  <input type="text" class='cust_input' name='username' placeholder=' * username' /> </td>
                        <td> <input type="password" class='cust_input' name='password' placeholder=' * password' /> </td>
                        <td> <input type="email" class='cust_input' name='email' placeholder=' * email' /> </td>
                        <td> 
                            <select name="role" >
                                    <option value="visitor">Visitor</option>
                                    <option value="contributor">Contributor</option>
                                    <option value="author">Author</option>
                                    <option value="editor">Editor</option>
                                    <option value="designer">Designer</option>
                                    <option value="manager">Manager</option>
                                    <option value="administrator">Administrator</option>
                                    <option value="god_root">God root</option>
                            </select>
                         </td>
                        <td class='right-align'>
                            <button class="btn z-depth-0 blue" type='submit' name='newuser' style='margin-top:-5px;'> New user </button>
                        </td>
                        
                    </tr>

# OLD STRUCTURE OF on user.php tabs display : Script php for $_GET['role'] and Query still working if you bring back this code to live(in the code) : 

 <li class="tab"> <a  class='active white-text' href="?vl=<?= $systemUsers->hash('root.user') ?>&role=all"> All (<?= $granted_count ?>) </a>  </li>
        <li class="tab"> <a  class='white-text' href="?vl=<?= $systemUsers->hash('root.user') ?>&role=administrator" >  Administrator (<?= $admin_count ?>) </a>  </li>
        <li class="tab"> <a  class='white-text' href="?vl=<?= $systemUsers->hash('root.user') ?>&role=manager" >  Manager (<?= $manager_count ?>) </a>  </li>
        <li class="tab"> <a  class='white-text' href="?vl=<?= $systemUsers->hash('root.user') ?>&role=designer" >  Designer (<?= $designer_count ?>) </a>  </li>
        <li class="tab"> <a  class='white-text' href="?vl=<?= $systemUsers->hash('root.user') ?>&role=editor" >  Editor (<?= $editor_count ?>) </a>  </li>
        <li class="tab"> <a  class='white-text' href="?vl=<?= $systemUsers->hash('root.user') ?>&role=author" >  Author (<?= $author_count ?>) </a>  </li>
        <li class="tab"> <a  class='white-text' href="?vl=<?= $systemUsers->hash('root.user') ?>&role=contributor" >  Contributor (<?= $contributr_count ?>) </a>  </li>
        <li class="tab"> <a  class='white-text' href="?vl=<?= $systemUsers->hash('root.user') ?>&role=visitor" >  Visitor (<?= $visitor_count ?>) </a> </li>
        <li class="tab"> <a  class='green-text' href="?vl=<?= $systemUsers->hash('root.user') ?>&access=granted"  class='green-text'>  Granted (<?= $granted_count ?>) </a>   </li>
        <li class="tab"> <a  class='red-text' href="?vl=<?= $systemUsers->hash('root.user') ?>&access=banned"  class='red-text'>  Banned (<?= $banned_count ?>) </a>  </li>
        
        
#Event for selecting all checkbox on a form <- the script is global

onclick="checkAll(this.table, 'idUser[]')"

#Checking php versions : idea while installing 
 <?php
   echo $startTime.'<br/>'.$startMem;
    define('COSBUILDER_MINIMUM_PHP', '5.3.10');

    if (version_compare(PHP_VERSION, COSBUILDER_MINIMUM_PHP, '<'))
    {
        die('Your host needs to use PHP ' . COSBUILDER_MINIMUM_PHP . ' or higher to run this version of Joomla!');
    }else{
     
    }


?>
</div>

#Php functions use in dashboard 

memory_get_peak_usage(),
php_uname();
get_current_user(); : get the current machine user name

phpversion();
['HTTP_USER_AGENT']
['HTTP_HOST']
['SERVER_SOFTWARE'] : isset($_SERVER['SERVER_SOFTWARE']) ? $_SERVER['SERVER_SOFTWARE'] : getenv('SERVER_SOFTWARE')
['SERVER_NAME']
['SERVER_ADDR']
['SERVER_PORT']
['REMOTE_ADDR']
['REMOTE_PORT']


['SERVER_PROTOCOL']
['GATEWAY_INTERFACE']
['REMOTE_ADDR']
['REMOTE_ADDR']
['REMOTE_ADDR']


#Cust Tabs menu
<div class="row cust_menu">
    <div class="col s10 pinned cust_menu " style='z-index:99; border-bottom:10px solid #292934'>
        <!-- Left  -->
         <div class="col s12 ">
           
            <h5><i class="fa fa-comment"></i> Comments </h5>
           
         </div>
        
            <div class="nav-content" style=''>
                <ul class="tabs_cust  ">
                    <li class="tab_cust">

                        <a  class='white-text' href=""> 
                           
                        </a>

                    </li>
                </ul>
            </div>
    </div>
</div> 
<br/><br/><br/>

#collapsible  structure 

<div class="col s12">
        <ul class="collapsible white-text"  style='border:none;' data-collapsible="accordion">
            <li class=''>
                <div class="collapsible-header active cust_menu" >
                    <i class="fa fa-flag"></i>F irst
                </div>
                <div class="collapsible-body " style='padding:10px;'>
                    <span>Lorem ipsum dolor sit amet.</span>
                </div>
            </li>   
        </ul>
</div>



<div class="col s8 " >
    <form action="#!" method='post'>
                <select name="filter_menu" id="" class='col s4'>
                    <option value="none"> All menu </option>
                    <?php if ($menus != []) : ?>  
                        <?php foreach($menus as $menu): ?>
                            <option value="<?= $menu->id ?>" 
                                    <?php 
                                        if(isset($_GET['filter'])){
                                            if (  $_GET['filter'] === $menu->id ) {
                                                echo 'selected';
                                            }
                                        }
                                    
                                    ?> > <?= ucfirst($menu->menu) ?> </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
                <div class="col s4 left-align"> 
                        <button type='submit' name='filter' class="btn blue z-depth-0" style='margin-top:10px;'> Filter </button>
                </div>
        </form>
</div>
bingo 


// if($vl === $sys->hash('index')) {

//     require ROOT.'/layout/posts/index.php';

// }else if($vl === $sys->hash('category') ) {

//     require ROOT.'/layout/posts/category.php';

// }else if($vl === $sys->hash('single')){

//     require ROOT.'/layout/posts/single.php';

// }else if ($vl === $sys->hash('login')) {
//     $active_menu = null;
//     require ROOT.'/layout/users/login.php';

// }else if ( $vl === $sys->hash('404') ) {
//      $active_menu = null;
//      require ROOT.'/layout/errors/e404.php';

// }else if ( $vl === $sys->hash('403') ) {
//     $active_menu = null;
//     require ROOT.'/layout/errors/e403.php';

// }else{
   
//     require ROOT.'/layout/posts/index.php';

// }
<?php
    
		/*
		 * Specify the formatting allowed in a placeholder. The following are allowed:
		 *
		 * - Sign specifier. eg, $+d
		 * - Numbered placeholders. eg, %1$s
		 * - Padding specifier, including custom padding characters. eg, %05s, %'#5s
		 * - Alignment specifier. eg, %05-s
		 * - Precision specifier. eg, %.2f
		 */
		$allowed_format = '(?:[1-9][0-9]*[$])?[-+0-9]*(?: |0|\'.)?[-+0-9]*(?:\.[0-9]+)?';

		/*
		 * If a %s placeholder already has quotes around it, removing the existing quotes and re-inserting them
		 * ensures the quotes are consistent.
		 *
		 * For backwards compatibility, this is only applied to %s, and not to placeholders like %1$s, which are frequently
		 * used in the middle of longer strings, or as table name placeholders.
		 */
		$query = str_replace( "'%s'", '%s', $query ); // Strip any existing single quotes.
		$query = str_replace( '"%s"', '%s', $query ); // Strip any existing double quotes.
		$query = preg_replace( '/(?<!%)%s/', "'%s'", $query ); // Quote the strings, avoiding escaped strings like %%s.

		$query = preg_replace( "/(?<!%)(%($allowed_format)?f)/" , '%\\2F', $query ); // Force floats to be locale unaware.

		$query = preg_replace( "/%(?:%|$|(?!($allowed_format)?[sdF]))/", '%%\\1', $query ); // Escape any unescaped percents.
?>
<?php
    

#echo $_GET['url'];

//$router = new Router($_GET['url']);
//
//
//$router->get('/posts', function(){
//    echo 'Tous les articles';
//});
//
//$router->get('/posts', function(){
//    echo 'Tous les articles';
//});
//
//$router->get('/posts/:id', function($id){
//    echo 'Tous les articles';
//});
//
//$router->post('/posts/:id', function($id){
//    echo 'Tous les articles';
//});

#$router->run();

# $cache = new \Cos\Cache(ROOT.'/web/tmp',1);


?>