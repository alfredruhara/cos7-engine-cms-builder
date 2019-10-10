
<div class="navbar-fixed">
    <nav class="nav-extended cust">
        <div class="container">
            <div class="nav-wrapper">
                <a href="?vl=<?php  #$system->hash('index') ?>" class="brand-logo " style='margin-left:10px'> Site Name</a>
                <!-- <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a> -->
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                <?php foreach($menu_list as $menu): ?>
                        <li class='<?= $menu->id == $active_menu ? 'z-depth-1' : ''; ?> '><a href="<?= $menu->url ?>" class=''> <?= $menu->menu.'-'.$menu->id ?>  </a></li>
                <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </nav>
</div>


<div class="parallax-container">
    <div class="parallax">
        <img src="<?= $post->media_url ?>"/>
    </div>
</div>
<div class="container">
    <h2 class='cust-text'> <?= $post->title ?> </h2>
    <!-- Article(post) published date,categories and Author --> 
    <p style="display:flex; justify-content:space-between;"> <?= $post->about ?> </p>
    <p class='col s12'>
         <?= nl2br($post->content) ?>
    </p>
</div>

<?php if($more_posts != []) : ?>
    <div class="row">
    <h5 style='margin-left:9px;'> See also </h5>
        <?php foreach ($more_posts as $post): ?>
            <div class="col m3 s3 l3">                    
                <div class="card">
                    <div class="" style='padding-left:10px;'>
                        <h5 ><a href="<?= $post->url ?>" class='cust-text cust_title' > <?= $post->title ?> </a></h5>
                    </div>
                    <div class="attachImgOnBg" style="background-image:url(<?= $post->media_url ?>) ;" >
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>


<?php if($coms != []) : ?>
    <div class="container">
        <h5> Comments </h5>
        <?php foreach($coms as $com): ?>
            <blockquote>
                <b> <h5> <?= $com->full_name ?> </h5> </b> <br/>
                <?= $com->comment ?>
            </blockquote>
        <?php endforeach ?>
    </div>
<?php endif; ?>

<div class="container">
    <h5> Leave a comment </h5>
    <?php  if(isset($errors)): ?>

         <?php  if($errors): ?>
                <div class="card red red">
                    <p> Something went wrong try again </p>
                </div>
         <?php else: ?>
                  <div class="card red green">
                    <p> Comment posted </p>
                </div>
        <?php endif; ?>

    <?php endif ?>
    <?php if($com_switch == "on") : ?>
            <form method="post">
                <div class='row'>
                    <div class='input-filed col s6'> 
                        <label> Full name </label>
                        <input type='text' name='fullname'  class="validate" required />
                    </div>

                    <div class='input-filed col s6'>   
                        <label >Email </label>
                        <input type='email' name='email'  class="validate" required />
                    </div>
                </div>
                <div class="row">
                    <div class='input-filed col s12 '> 
                        <label for=""> Coment something</label>
                        <textarea name="com" class="materialize-textarea" placeholder='write a comment...' required ></textarea>
                    </div>
                    <div class="col s12">
                        <button type='submit' name='login' class="btn blue"> Comment </button>
                    </div>
                </div>
        
            </form>
    <?php else: ?>
            <div class="row">
                <div class="card center-align z-depth-0 green-text" style='background:transparent; border-bottom:1px solid white;' >
                <p>Commenting switch off for this post ....!</p>
                </div>
            </div>
    <?php endif ?>
</div>