<?php
    $systemDefault = System::getInstance();


 ?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
      <meta charset="utf-8">
      <!-- Title of the website -->
      <title>  </title>
      <link rel="stylesheet" href="../office/templates/css/materialize.css">
      <link rel="stylesheet" href="../office/templates/css/font-awesome.css" />
      <style>
          body{
              margin:0;
              padding:0;
              -moz-user-select:none;
              -webkit-user-select:none;
              -o-user-select:none;
              -ms-user-select:none;
              user-select:none;
              font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif;
          }
          .cust{
                background-color:#292934;  
           }
          .cust_nav{
                background-color:#4c7fb8;  
           }
          .cust-text {
              color  :#292934;  
          }
          .customNav{
            position:fixed;    
            height: 100%;
            height: calc(100% + 60px);
            height: -moz-calc(100%);
           
            /* background-color: rgba(0,0,22,0.5); */
            overflow-y: auto;
            color:white;
          }
          .customRight{
            right:0px;
           
          }
          .customNav ul li:not(.divider){
           
            padding:4px;
            padding-left:40px;
            cursor:pointer;
            font-size:18px;
            font-weight:400;

          }

          .customNav ul li:hover,   .customNav ul li.active{
           background-color:#323232;
           
          }
          .customRight  ul li:not(.divider) {
            border:1px solid white;
            margin-bottom:15px;
            border-radius:10px;
          }
          .bordered-btn-cust{
              border:1px solid black;
              cursor:pointer;
              border-radius:10px;
              transition: color .3s linear;
          }
          .bordered-btn-cust:hover:not(.active_this){
             color:white;
             border-color:white
          }
          .active_this{
              color:white;
              background-color:#292934;
              border-color:#292934;
          }
          .bordered-btn-cust .active_this .fa {
              color:white;
          }
          #category,#slider{
              display:none;
          }
          
      </style>
      <style>
        .cust_tabs {
                  display: -webkit-box;
                  display: -moz-box;
                  display: -ms-flexbox;
                  display: -webkit-flex;
                  display: flex;
                  position: relative;
                  height: 48px;
                  background-color: #fff;
                  margin: 0 auto;
                  width: 100%;
                  white-space: nowrap; }
                  .cust_tabs .cust_tab  {
                    -webkit-box-flex: 1;
                    -webkit-flex-grow: 1;
                    -ms-flex-positive: 1;
                    flex-grow: 1;
                    display: block;
                    float: left;
                    text-align: center;
                    line-height: 48px;
                    height: 48px;
                    padding: 0 20px;
                    margin: 0;
                    text-transform: uppercase;
                    letter-spacing: .8px;
                    width: 15%; }
                    .cust_tabs .cust_tab a {
                      color: #222;
                      display: block;
                      width: 100%;
                      height: 100%;
                      transition:letter-spacing  .28s ease;
                    }
                    .cust_tabs .cust_tab a:hover {
                        letter-spacing: 3px;
                        color: #000; 
                        /* border-bottom:2px solid #4c7fb8; */
                    }

                    .cust_tabs .cust_tab .on_active {
                      border-bottom:2px solid #4c7fb8;
                    }

                    .cust_tabs .cust_tab {
                      padding: 0; }

                    .popUpSubCategories{
                     margin-top:20px;
                      width:40%;
                      height:60%;
                      float:right;
                      overflow-y: auto;
                      z-index: 999;
                      background:white;
                      border-radius:20px;
                  
                    }
                    .popUpSubCategories .li {
                      clear: both;
                      color: rgba(0, 0, 0, 0.87);
                      cursor: pointer;
                      line-height: 1.5rem;
                      width: 100%;
                      text-align: center;
                      text-transform: none;
                    }
                    
                    .popUpSubCategories .li:hover{
                    
                    }
                    .popUpSubCategoriest li > a {
                      font-size: 1.2rem;
                      color: #26a69a;
                      display: block;
                      padding: 1rem 1rem; 
                      }
                    
                    .cust_cat{
                      font-size: 1.2rem;
                      color: #000;
                      display: block;
                      padding: 1rem 1rem; 
                    }
                    .cust_cat:hover{
                      letter-spacing: 3px;
                    
                    }
                    .cust_validate{
                        border:1px solid white;
                    }
      </style>
      <style>
                    
            .material-tooltip {
            padding:0px;
            font-size: 1rem;
            z-index: 2000;
            background-color: transparent;
            border-radius: 2px;
            width:322px;
            height:314px;
            color: #fff;
            /* min-height: 36px; */
            line-height: 1rem;
            opacity: 0;
            display: none;
            position: absolute;
            /* text-align: center; */
            overflow: hidden;
            
            left: 0;
            top: 0;
            will-change: top, left; }

            .backdrop {
            padding:0px;
            position: absolute;
            opacity: 0;
            display: none;
            height: 7px;
            width: 14px;
            border-radius: 0 0 14px 14px;
            background-color: #323232;
            z-index: -1;
            -webkit-transform-origin: 50% 10%;
            -moz-transform-origin: 50% 10%;
            -ms-transform-origin: 50% 10%;
            -o-transform-origin: 50% 10%;
            transform-origin: 50% 10%;
            will-change: transform, opacity; }

            .cust_menu{
                background-color: #323232;
            }
            .cust_fieldset{
                border:none; border-top:1px solid #555; 
                margin-top:10px;
                margin-bottom:4px;
            }
            .cust_legend{
                width:280px;
                /* text-align:center; */
                border:1px solid #555;
                padding:0px 20px 0px 20px;
                margin-left:20px;
                border-radius:10px;
                
            }
            .cust_legend_small{
                width:80px;
                /* text-align:center; */
                border-left:1px solid #555;
                border-right:1px solid #555;
                padding:0px 10px 0px 10px;
                margin-left:10px;
                font-size:10px;
             
                
            }
          
            input[type=text], input[type=password], input[type=email], input[type=url], input[type=time], input[type=date], input[type=datetime-local],  input[type=number], input[type=search] {
               
                border: none;
                border: 1px solid grey;
                border-radius: 0;
                outline: none;
                height: 3rem; 
                width: 100%;
                font-size: 1rem;
                margin: 0 0 15px 0;
                padding-left:2px;
                box-shadow: none;
                -webkit-box-sizing: content-box;
                -moz-box-sizing: content-box;
                box-sizing: content-box;
                transition: all .3s;
             }
         
            input[type=text]:focus:not([readonly]), input[type=password]:focus:not([readonly]), input[type=email]:focus:not([readonly]), input[type=url]:focus:not([readonly]), input[type=time]:focus:not([readonly]), input[type=date]:focus:not([readonly]), input[type=datetime-local]:focus:not([readonly]), input[type=tel]:focus:not([readonly]), input[type=number]:focus:not([readonly]), input[type=search]:focus:not([readonly]), textarea.materialize-textarea:focus:not([readonly]) {
                border-bottom: 1px solid #fff;
                box-shadow: 0 0px 0 0 #fff; 
            }

      </style>

      <style>
         .menu_category:not(.active) , .menu_subcategory:not(.active){
             display :none ;
         }
         .attachImgOnBg{
                        
                width:100%; 
                height:200px; 
                margin:0 auto;
                background-repeat:repeat;
                background-size:contain; 
                background-position:center;
                background-color:grey;

         }
       
         .actions-hover > a{
            color:black;
           
         }
         /* Table view */
        
         .capture-hover > .capture-action >  .actions-hover{
             display:none;
             padding:10px;
             border:1px solid grey;
             
         }
         .unapproved-comment ,.banned_user{
            border-left:4px solid #F44336; 
            border-right:4px solid #F44336; 
         }
         .capture-hover:hover:not(.not) > .capture-action > .actions-hover {
             display:flex;
             justify-content:space-between;
         }
         /* Card view */
         .capture-card-hover > .card-action .actions-hover {
           opacity:0;
           transition: opacity .3s linear; 
         }
         .capture-card-hover:hover > .card-action .actions-hover {
           opacity:0.9;
        }

        .input-table-hover:hover > td > .cust_input:focus  {
            color:#222;
        
        }

          .tabs_cust {
            
            display: -webkit-box;
            display: -moz-box;
            display: -ms-flexbox;
            display: -webkit-flex;
            display: flex;
            position: relative;
            height: 48px;
            margin: 0 auto;
            width: 100%;
            white-space: nowrap; 

            }
            .tabs_cust .tab_cust {
                -webkit-box-flex: 1;
                -webkit-flex-grow: 1;
                -ms-flex-positive: 1;
                flex-grow: 1;
                display: block;
                float: left;
                text-align: center;
                line-height: 48px;
                height: 48px;
                padding: 0 20px;
                margin: 0;
                text-transform: none;
                letter-spacing: .8px;
                width: 15%;
                border-bottom:1px solid #555555
                
            }
            .tabs_cust .active {
                border:1px solid #555;   
                border-bottom:none;
            }
            .tab_cust:not(.active):hover > a {
               color:white;
               text-transform:uppercase;
            }
                
             
             
      </style>
  </head>
  <body  style="background-color:#292934;">
    
        <div class="row" style=" height:100%;">

            <div class="col s2 l2 m2" style="color:transparent;">n</div>
            <div class="col s2 l2 m2 customNav " style=' border-right:1px solid #323232; padding:0px;'>

                <a href="?<?= $systemDefault->cursor('admin.index')?>" class='white-text red' style=''>   
                    <h4   class='center-align ' style='width:auto;border-bottom:1px solid #323232; margin-top:14px;'>
                       C<i class="fa fa-cog">s </i> Seven
                     </h4>
                </a>
                <p class='center-align' style='margin-top:-15px; color:#555' >Back office | Beta v0.001</p>
               
                <br/>
                <div class="">

                    <ul class=''> 
                        
                        <a href="index.php" class='white-text'>
                            <li  class="" id="">                            
                                <i class=" fa fa-home"></i> 
                                 Site Web
                            </li>
                        </a>

                       <a href="?vl=<?= $systemDefault->cursor('office')['index']['out'] ?>" class='white-text'>
                            <li  class="" id="">                            
                                <i class=" fa fa-desktop"></i> 
                                 Cosdesk
                            </li>
                        </a>

                         <a href="?vl=<?= $systemDefault->cursor('studio')['index']['out'] ?>" class='white-text'>
                            <li  class="" id="">                            
                                <i class=" fa fa-paint-brush"></i> 
                                 Costudio
                            </li>
                        </a>
                       
                       <fieldset class='cust_fieldset' style='padding:0px;'>
                            <legend class='cust_legend_small'>
                                Posts
                            </legend>
                       </fieldset>


                        <a href="?vl=<?= $systemDefault->cursor('article')['index']['out'] ?>" class='white-text'>
                            <li  class="" id=""> <i class="fa fa-feed"></i> Articles</li>
                        </a>

    

                         <a href="?vl=<?= $systemDefault->cursor('comment')['index']['out'] ?>" class='white-text'>
                            <li  class="" id=""><i class="white-text fa fa-comment"></i> Comments</li>
                        </a>
                      
                    
                        <fieldset class='cust_fieldset' style='padding:0px'>
                            <legend class='cust_legend_small'>
                                <i class="white-text fa fa-tv "></i> Explorer
                            </legend>
                       </fieldset>

                        <a href="?vl=<?= $systemDefault->cursor('media')['index']['out'] ?>" class='white-text'>
                            <li  class="" id=""><i class="white-text fa fa-folder"></i> Cosexp </li>
                        </a>

                         <fieldset class='cust_fieldset' style='padding:0px'>
                            <legend class='cust_legend_small'>
                            <i class="white-text fa fa-user "></i> User
                            </legend>
                       </fieldset>
                        
                        <a href="?vl=<?= $systemDefault->cursor('user')['index']['out'] ?>" class='white-text'>
                             <li  class="" id=""><i class="white-text fa fa-user "></i> Users </li>
                        </a>
                        <a href="?vl=<?= $systemDefault->cursor('user.destroy') ?>" class='white-text'>
                            <li  class="" id=""><i class="white-text fa fa-share-alt "></i>	Log out </li>
                        </a>

                    </ul>

                </div>

            </div>

        <div class="col s10 l10 m10 white-text" style='padding:0px;'>
              <?= $layout;  ?>

        </div>



       </div>

   <!-- Javascript libraries -->
    <script src="../office/templates/js/jquery.js"></script>
    <script src="../office/templates/js/materialize.js"></script>
   
    <?php  if ($flash->verify('chadflash')): ?>
        <?php
             $flashes  = $flash->get(); 
             $time_out = 3000; 
         ?>
         <?php foreach($flashes as $flash ):  ?>
            <script type="text/javascript">
                Materialize.toast(' <?= $flash["message"] ?> ', <?= $time_out += 715  ?> , '<?=  $flash['type'] ?>' ) ;
            </script>
          <?php endforeach; ?>
      <?php endif; ?>
   
    <script>
      $(document).ready(function(){
          $(".parallax").parallax();
          $('.slider').slider({
              'indicators' : true,
              'transition' : 500,
              'interval'   : 80000
          });
          $('.slider').slider('pause');
       
          $('select').material_select();
          $(".button-collapse").sideNav();
          $('.modal-trigger').leanModal();
          $('.tooltipped').tooltip({delay: 50});
          $('.tooltipped').tooltip({html: true});
          $('.materialboxed').materialbox();
          $('.collapsible').collapsible();
          
          
      });
    </script>
   
   <script>
     $(document).ready(function(e){
        //e.stopPropagation();

         var menu     =$('#newMenu');
         var category =$('#categoryOnMenu');
         var slider   =$('#sliderOnMenu');

         
        var active  = function (el) {
            if($('.bordered-btn-cust').hasClass('active_this')){
                    $('.bordered-btn-cust').removeClass('active_this');
                    el.children().addClass('active_this');
            }
        }

        menu.click(function(){
           $('#category').css('display', 'none');
           $('#slider').css('display', 'none');
           active($(this));
           $('#menu').css('display', 'block');

        });
        category.click(function(){

           $('#slider').css('display', 'none');
           $('#menu').css('display', 'none');
           active($(this));
           $('#category').css('display', 'block');


        });
        slider.click(function(){
          
           $('#menu').css('display', 'none');
           $('#category').css('display', 'none');
           active($(this));
           $('#slider').css('display', 'block');

        });

     });
   </script>

   <script>

       $(document).ready(function(){
            
        function file_preview(input){

            if(input.files && input.files[0]){
                var affiche = new FileReader();

                affiche.onload = function(e){
                   
                    $('#disp').remove();
                    $('#form').prepend('<img src="'+e.target.result+'" id="disp"/>');
                   
                }
                affiche.readAsDataURL(input.files[0]);
              
            }
        }

        $('#attach').change(function(){
            file_preview(this);
        });


        });
   
   </script>
      
    
    <script>

        $(document).ready(function(){
                
            function file_preview(input){

                if(input.files && input.files[0]){
                        var affiche = new FileReader();

                        affiche.onload = function(e){
                            
                            $('#disp_slide').remove();
                            $('#slide_trigger').prepend('<img src="'+e.target.result+'" id="disp_slide" />');
                            
                        }
                        affiche.readAsDataURL(input.files[0]);
                    
                    }
                }

                $('#attach_trigger').change(function(){
                    file_preview(this);
                });


        });

    </script>

    <script>
        $(document).ready(function(){

            // Showing all categories of the clicked menu 
            
            $(".menu_trigger").click(function(e){
              e.stopPropagation();
              
              var catch_Id = $(this).attr('class');
              var extract_id = catch_Id.split("menu_trigger ")[1];

              var triggedElement = "category"+extract_id.toString();
              
              if( $('.menu_category').hasClass('active') ) {
                 
                  $('.menu_category').removeClass('active');
                  $('#'+triggedElement).addClass('active');

              }
              // Removing the active sub category
              if( $('.menu_subcategory').hasClass('active') ) {
                 $('.menu_subcategory').removeClass('active');
              }

              
           });
           
           $(".uncategorize").click(function(){
                // Removing the active sub category
                if( $('.menu_subcategory').hasClass('active') ) {
                    $('.menu_subcategory').removeClass('active');
                }
           });

           $(".category_trigger").click(function(e){
              e.stopPropagation();
              
              var catch_Id = $(this).attr('class');
              var extract_id = catch_Id.split("category_trigger ")[1];

              var triggedElement = "subcategory"+extract_id.toString();
              
              if( $('.menu_subcategory').hasClass('active') ) {
                 
                  $('.menu_subcategory').removeClass('active');
              }

              $('#'+triggedElement).addClass('active');
            
          });


        });

    </script>

    <script>
        $(document).ready(function(){
            $('.burn_all').click(function(){
               
                $('.burn_action').attr = checked;
            });
        });

        function checkAll(inputs, field) {
                for(var i = 0; i < inputs.elements.length; i++) {
                    if(inputs[i].type == "checkbox" && inputs[i].name==field) {
                        inputs[i].checked = !inputs[i].checked ;
                    }
                }
        }
    </script>
        <?=  "<p class='white-text green' 
                 style='position:fixed;bottom:0px;left:5px;;padding:10px;border-radius:5px;' > Script Execution time : ".round(microtime(true) - TIME, 3)."s
              </p>"; 
        ?>
  </body>
</html>