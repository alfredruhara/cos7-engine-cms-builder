<div class="container">
    <h1>Authenfication </h1>

<?php

use Cpu\HTML\MaterializeForm;

if(!empty($_POST)){

    $auth = new \Cpu\Auth\DbAuth($system->getDb());
    
    if($auth->login($_POST['username'], $_POST['password'])){
        
        header('location: admin.php');

    }else{

      ?>
        <div class="row">
            <h5 class="col s12  red-text" style="padding:10px; border-left:3px solid #f44336 ;">
                    Incorrect, try again !
            </h5>
        </div>

      <?php

    }

}

  $form = new MaterializeForm($_POST);

?>


    <br/>
    <form method="post">
        
        <?= $form->input('text','username','Username')?>
        <?= $form->input('password','password','Password')?>
        <?= $form->validate('login','Auth', 'btn blue')?>

    </form>

</div>
