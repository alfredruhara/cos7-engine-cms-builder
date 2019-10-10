<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
      <meta charset="utf-8">
      <!-- Title of the website -->
      <title> <?php # $system->getTitle(); ?> </title>
      <link rel="stylesheet" href="materialize/css/materialize.css">
      <link rel="stylesheet" href="materialize/css/cust.css">

  </head>
  <body>
    <!-- layout output -->
    <?= $layout ?>
    <!-- Javascript libraries -->
    <footer class="page-footer blue" style='z-index:999'>
          <div class="container2">
            <div class="row">
              <div class="col l6 s12">
                <h5 class="white-text">Footer Content</h5>
                <p class="grey-text text-lighten-4">Last tweets </p>
              </div>
              <div class="col l4 offset-l2 s12">
                <h5 class="white-text">Links</h5>
                <ul>
                  <li><a class="grey-text text-lighten-3" href="#!">Link 1</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Link 2</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Link 3</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Link 4</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="footer-copyright">
            <div class="container">
            © 2018 Copyright | <?= "Execution time : about ".round(microtime(true) - TIME, 3)." seconds" ?>
            <a class="grey-text text-lighten-4 right" href="#!">More Links</a>
            </div>
          </div>
    </footer>


    <script src="_libraries/jquery.js"></script>
    <script src="materialize/js/materialize.js"></script>
    <script src="materialize/js/default.js"></script>
  </body>
</html>
