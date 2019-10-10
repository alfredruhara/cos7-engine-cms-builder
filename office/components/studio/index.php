<?php
    $systemBuilder = System::getInstance();
?>

<!-- Output the header  -->
<div class="row cust_menu">
    <div class="col s10 pinned cust_menu " style='z-index:99; border-bottom:2px solid #292934;'>
           <div class="col s8">
                  <h5 class''>My Studi<i class="fa fa-cog"></i>s</h5>    
                 <i class="fa fa-server"></i> Real Path :
                <div>
                    <a href="#!" class='orange-text'> Folder size  </a> 
                    <a href="#!" class='orange-text' style='margin-left:15px;'>  Contains : </a>      
                </div>
           </div>
          
           <div class="col s4 right-align orange-text" style='margin-top:10px;'> 
                Construct & Control pannel mode
           </div>


    </div>
</div>

<br/>
<br/>
<br/>
<br/>
<br/> <br/>

<div class="row">
  
    <div class="col s12">
        <fieldset class='cust_fieldset' >
            <legend class='cust_legend'>  <h5> <i class="orange-text fa fa-cog white-text"></i>  Site  Creator </h5> </legend>
        </fieldset>
    </div>

    <br/>
    <div class="col m4" >
       <a  href="?vl=<?= $systemBuilder->cursor('studio')['nav']['out'] ?>" 
           class='white-text tooltipped '
           data-position="right" 
           data-delay="50" 
           data-tooltip="
            <div class='' style='height:314px; padding-left:10px'>
                <h5 style='' ><i class='fa fa-list blue-text'> Build  Header </i>   </h5>
                <p class='left-align blue-text' > <i class='fa fa-list '></i>  Navigation Bar   </p> 

                <p  class='left-align'  style='margin-left:15px'>
                   <i class='fa fa-minus blue-text'></i> Create menus 
                </p>

                <p  class='left-align'  style='margin-left:30px'>
                   <i class='fa fa-minus blue-text'></i> Add categories(sub menus) on menus 
                </p>
                <p  class='left-align'  style='margin-left:50px'>
                   <i class='fa fa-minus blue-text'></i> Add Sub categories on Categories 
                </p>
                <p  class='left-align'  style='margin-left:15px'>
                   <i class='fa fa-tv blue-text'></i> Display Control
                </p>
                <p  class='left-align'  style='margin-left:15px'>
                   <i class='fa fa-server blue-text'></i> Local and Global actions , etc
                </p>

                
                <p  class='left-align blue-text'   style=''>
                   <i class='fa fa-image '></i> Slider Attach
                </p>
                <p  class='left-align'  style='margin-left:15px'>
                   <i class='fa fa-minus blue-text'></i> Create,delete,modify Slider show 
                </p>


            </div>
           "
           >
        <div class="card  center-align cust_menu" style='padding:15px; ' >
            <h5 style='' > <i class="blue-text fa fa-list"> Header </i>  </h5>
            <p>  Navigation Bar and Slider  </p>
        </div>
       </a>
    </div>

    <div class="col m4" >
       <a href="?vl=<?= $systemBuilder->cursor('builder.menu') ?>" class='black-text tooltipped'
           data-position="right" 
           data-delay="50" 
           data-tooltip="
            <div class='white black-text' style='height:324px; padding-left:10px; padding-top:10px; margin-top:-10px;'>

                <h5 style='' ><i class='fa fa-file  brown-text'> Manage  Content </i>   </h5>
                
                <p class='left-align brown-text' > <i class='fa fa-minus '></i> Site Web   </p> 

                  <p  class='left-align'  style='margin-left:15px'>
                    <i class='fa fa-minus brown-text'></i> Font
                  </p>
                  <p  class='left-align'  style='margin-left:15px'>
                    <i class='fa fa-minus brown-text'></i> Flow Text
                 </p>

               
                <p class='left-align brown-text' > <i class='fa fa-file '></i> Articles (Posts)   </p> 

                <p  class='left-align'  style='margin-left:15px'>
                   <i class='fa fa-tv brown-text'></i> display
                </p>

                <p  class='left-align'  style='margin-left:15px'>
                   <i class='fa fa-minus brown-text'></i> Flow 
                </p>

                <p  class='left-align'  style='margin-left:15px'>
                   <i class='fa fa-filter brown-text'></i> Sort and Filter
                </p>

               <p  class='left-align'  style='margin-left:15px'>
                   <i class='fa fa-minus brown-text'></i> Alignment , etc
                </p>

          

            

            </div>
           "
       >
        <div class="card  center-align white" style='padding:15px; ' >
            <h5 style='' > <i class="brown-text fa fa-file"> Content </i>  </h5>
            <p> Manage the display of content : articles,...</p>
        </div>
       </a>
    </div>

    <div class="col m4" >
       <a href="?vl=<?= $systemBuilder->cursor('builder.menu') ?>" class='white-text  tooltipped'
           data-position="left" 
           data-delay="50" 
           data-tooltip="
            <div class='cust_menu' style='height:314px; padding-left:10px'>

                <h5 style='' ><i class='fa fa-flag red-text'> Footer </i>   </h5>

                <br/>
                
                <p class='left-align red-text' > <i class='fa fa-flag '></i> Advance Footer  </p> 

                  <p  class='left-align'  style='margin-left:15px'>
                    <i class='fa fa-minus red-text'></i> Default
                  </p>
            
                <p  class='left-align'  style='margin-left:15px'>
                   <i class='fa fa-minus red-text'></i>  Footer Menu
                </p>

                <p  class='left-align'  style='margin-left:15px'>
                   <i class='fa fa-minus red-text'></i> About page
                </p>

                <p  class='left-align'  style='margin-left:15px'>
                   <i class='fa fa-minus red-text'></i> Contact page
                </p>

            

            </div>
           ">
        <div class="card  center-align cust_menu" style='padding:15px; ' >
            <h5 style='' > <i class="red-text fa fa-flag"> Footer </i>  </h5>
            <p> custome the footer of the website </p>
        </div>
       </a>
    </div>
    
    

    <div class="col s12">

       <fieldset class='cust_fieldset' >
            <legend class='cust_legend'>
                   <h5><i class="white-text fa fa-edit white-text"></i> Edit Site </h5>  
            </legend>
        </fieldset>
       
      
    </div>

    <div class="col m4" >
       <a href="?vl=<?= $systemBuilder->cursor('builder.menu') ?>" class='white-text  tooltipped'
           data-position="right" 
           data-delay="50" 
           data-tooltip="
            <div class='' style='height:314px; padding-left:10px'>

                <h5 style='' ><i class='fa fa-paint-brush blue-text'> Paint Your Website </i>  </h5>

                <br/>
                
                <p class='left-align blue-text' > <i class='fa fa-square '></i> Background  </p> 

                  <p  class='left-align'  style='margin-left:15px'>
                    <i class='fa fa-paint-brush blue-text'></i> Main Color (Header, Button , Footer)
                  </p>
            
                <p  class='left-align'  style='margin-left:15px'>
                   <i class='fa fa-paint-brush blue-text'></i>  Site Web Background Color
                </p>

                <p  class='left-align'  style='margin-left:15px'>
                   <i class='fa fa-paint-brush blue-text'></i> Custome Backgrouds, etc
                </p>

             <p class='left-align blue-text' > <i class='fa fa-text-width '></i> Color  </p> 
                  <p  class='left-align'  style='margin-left:15px'>
                    <i class='fa fa-paint-brush blue-text'></i> Website Main text color
                  </p>
                  <p  class='left-align'  style='margin-left:15px'>
                   <i class='fa fa-paint-brush blue-text'></i> Custome Colors , etc 
                </p>


            </div>
           ">
        <div class="card  center-align cust_menu" style='padding:15px; ' >
            <h5 style='' > <i class="blue-text fa fa-paint-brush"> Paint </i>  </h5>
            <p> Background , Text-color, Paint Buttons </p>
        </div>
       </a>
    </div>


   <div class="col m4" >
       <a href="?vl=<?= $systemBuilder->cursor('builder.menu') ?>" class='black-text  tooltipped'
           data-position="right" 
           data-delay="50" 
           data-tooltip="
            <div class='white black-text' style='height:324px; padding-left:10px; padding-top:10px; margin-top:-10px;'>

                <h5 style='' ><i class='fa fa-eye brown-text'> View </i>    </h5>

                <br/>
                
                <p class='left-align brown-text' > <i class='fa fa-eye '></i> Content  </p> 

                  <p  class='left-align'  style='margin-left:15px'>
                    <i class='fa fa-eye brown-text'></i> Hidding Content
                  </p>
                
               <p class='left-align brown-text' > <i class='fa fa-eye '></i> ViewPort  </p> 
            
                <p  class='left-align'  style='margin-left:15px'>
                   <i class='fa fa-tablet brown-text'></i>  Custome Mobile view
                </p>

                <p  class='left-align'  style='margin-left:15px'>
                   <i class='fa fa-tablet brown-text'></i> Custome Tablet View
                </p>

          
             


            </div>
           ">
        <div class="card  center-align white" style='padding:15px; ' >
            <h5 style='' > <i class="brown-text fa fa-eye"> View </i>  </h5>
            <p> Manage the view of the website </p>
        </div>
       </a>
    </div>


   <div class="col m4" >
       <a href="?vl=<?= $systemBuilder->cursor('builder.menu') ?>" class='white-text tooltipped'
           data-position="left" 
           data-delay="50" 
           data-tooltip="
            <div class='' style='height:314px; padding-left:10px'>

                <h5 style='' ><i class='fa fa-expand red-text'> Rulers </i>  </h5>

               
                
                <p class='left-align red-text' > <i class='fa fa-minus '></i> Website  </p> 

                  <p  class='left-align'  style='margin-left:15px'>
                    <i class='fa fa-minus red-text'></i> Padding
                  </p>

                  <p  class='left-align'  style='margin-left:15px'>
                    <i class='fa fa-search-plus red-text'></i> Zoom , etc
                  </p>

                <p class='left-align red-text' > <i class='fa fa-list '></i> Navigation Bar  </p> 

                <p  class='left-align'  style='margin-left:15px'>
                   <i class='fa fa-minus red-text'></i>  Padding
                </p>

                <p  class='left-align'  style='margin-left:15px'>
                   <i class='fa fa-minus red-text'></i>  Alignment (Float menus) , etc
                </p>

               <p class='left-align red-text' > <i class='fa fa-flag '></i> Footer  </p> 

                <p  class='left-align'  style='margin-left:15px'>
                <i class='fa fa-minus red-text'></i>  Padding
                </p>

                <p  class='left-align'  style='margin-left:15px'>
                <i class='fa fa-minus red-text'></i>  Alignment (Float footer menus) , etc
                </p>

          
             


            </div>
           ">
        <div class="card  center-align cust_menu" style='padding:15px; ' >
            <h5 style='' > <i class="red-text fa fa-expand"> Rulers </i>  </h5>
            <p> padding, margin, zoom </p>
        </div>
       </a>
    </div>


    
    <div class="col s12">
        <fieldset class='cust_fieldset' >
            <legend class='cust_legend'>
                  <h5><i class="white-text fa fa-flash white-text"></i> Quick  Set Up </h5>
            </legend>
        </fieldset>
      
    </div>

    <div class="col m4" >
       <a href="?vl=<?= $systemBuilder->cursor('builder.menu') ?>" class='white-text tooltipped'
           data-position="right" 
           data-delay="50" 
           data-tooltip="
            <div class='' style='height:314px; padding-left:10px'>

                <h5 style='' ><i class='fa fa-book blue-text'> Blog </i>  </h5>

               
                
                <p class='left-align blue-text' > <i class='fa fa-cog '></i> Easy Setup  </p> 

                  <p  class='left-align'  style='margin-left:15px'>
                    <i class='fa fa-minus blue-text'></i> Activate a blog page on the website
                  </p>

             

                <p class='left-align blue-text' > <i class='fa fa-minus '></i> Features   </p> 

                <p  class='left-align'  style='margin-left:15px'>
                   <i class='fa fa-minus blue-text'></i>  News , etc
                </p>

                <p class='left-align blue-text' > <i class='fa fa-minus '></i> Manage   </p> 

                <p  class='left-align'  style='margin-left:15px'>
                   <i class='fa fa-minus blue-text'></i> News Posts
                </p>

                <p  class='left-align'  style='margin-left:15px'>
                <i class='fa fa-minus blue-text'></i>  Design 
                </p>


                <p  class='left-align'  style='margin-left:15px'>
                <i class='fa fa-minus blue-text'></i>  Action ( truncate , reset )
                </p>

            

          
             


            </div>
           ">
        <div class="card  center-align cust_menu" style='padding:15px; ' >
            <h5 style='' > <i class="blue-text fa fa-book"> Blog </i>  </h5>
            <p> Set up a Blog system</p>
        </div>
       </a>
    </div>


   <div class="col m4" >
       <a href="?vl=<?= $systemBuilder->cursor('builder.menu') ?>" class='black-text tooltipped'
           data-position="right" 
           data-delay="50" 
           data-tooltip="
            <div class='white black-text' style='height:324px; padding-left:10px; padding-top:10px; margin-top:-10px;'>

                <h5 style='' ><i class='fa fa-eye brown-text'> Forum </i>    </h5>

              
                <p class='left-align brown-text' > <i class='fa fa-cog '></i> Easy Setup  </p> 

                  <p  class='left-align'  style='margin-left:15px'>
                    <i class='fa fa-eye brown-text'></i> Activate a forum page on the website
                  </p>
                
               <p class='left-align brown-text' > <i class='fa fa-minus '></i> Features  </p> 
            
                <p  class='left-align'  style='margin-left:15px'>
                   <i class='fa fa-tablet brown-text'></i>  Register - Login
                </p>

                <p  class='left-align'  style='margin-left:15px'>
                   <i class='fa fa-tablet brown-text'></i> Discussion, help ,..
                </p>

                <p class='left-align brown-text' > <i class='fa fa-minus '></i> Manage  </p> 

                <p  class='left-align'  style='margin-left:15px'>
                   <i class='fa fa-tablet brown-text'></i>  Users
                </p>
                <p  class='left-align'  style='margin-left:15px'>
                   <i class='fa fa-tablet brown-text'></i>  Content
                </p>
                <p  class='left-align'  style='margin-left:15px'>
                   <i class='fa fa-tablet brown-text'></i>  Action (truncate , reset,..) , etc
                </p>
             


            </div>
           ">
        <div class="card  center-align white" style='padding:15px; ' >
            <h5 style='' > <i class="brown-text fa fa-comments"> Forum </i>  </h5>
            <p> Setup a Forun</p>
        </div>
       </a>
    </div>


   <div class="col m4" >
       <a href="?vl=<?= $systemBuilder->cursor('builder.menu') ?>" class='white-text tooltipped'
           data-position="left" 
           data-delay="50" 
           data-tooltip="
            <div class='' style='height:314px; padding-left:10px'>

                <h5 style='' ><i class='fa fa-user red-text'> PortoFolio </i>  </h5>

               
                
                <p class='left-align red-text' > <i class='fa fa-cog '></i> Easy Setup  </p> 

                  <p  class='left-align'  style='margin-left:15px'>
                    <i class='fa fa-minus red-text'></i> Activate a portofolio page on the website
                  </p>

                
               <p class='left-align red-text' > <i class='fa fa-minus '></i> Manage  </p> 

                <p  class='left-align'  style='margin-left:15px'>
                <i class='fa fa-minus red-text'></i>  Projects
                </p>

                <p  class='left-align'  style='margin-left:15px'>
                <i class='fa fa-minus red-text'></i> Ideas
                </p>

          
             


            </div>
           ">
        <div class="card  center-align cust_menu" style='padding:15px; ' >
            <h5 style='' > <i class="red-text fa fa-user">  Portofolio </i> </h5>
            <p> Set up your Portofolio</p>
        </div>
       </a>
    </div>


     
     <div class="col s12">
       <fieldset class='cust_fieldset' >
            <legend class='cust_legend'>
                  <h5><i class="white-text fa fa-android "></i> Get App </h5>
            </legend>
        </fieldset>
    </div>

    <div class="col m4" >
       <a href="?vl=<?= $systemBuilder->cursor('builder.menu') ?>" class='white-text tooltipped'
           data-position="right" 
           data-delay="50" 
           data-tooltip="
            <div class='' style='height:314px; padding-left:10px'>

                <h5 style='' ><i class='fa fa-android blue-text'> Android App </i>  </h5>

               
                
                <p class='left-align blue-text' > <i class='fa fa-cog '></i> Build and get a dynamic app </p> 

                  <p  class='left-align'  style='margin-left:15px'>
                    <i class='fa fa-flash blue-text'></i> Quick build 
                  </p>

                  <p  class='left-align'  style='margin-left:15px'>
                    <i class='fa fa-minus blue-text'></i> Customize Build 
                  </p>

                   <p  class='left-align'  style='margin-left:15px'>
                    <i class='fa fa-upload blue-text'></i> Upload your build to our server
                  </p>

                <p class='left-align'  style='margin-left:15px' > <i class='fa fa-download  blue-text'></i> Download the Apk  </p> 

             

          
             


            </div>
           "> 
        <div class="card  center-align cust_menu" style='padding:15px; ' >
            <h5 style='' > <i class="blue-text fa fa-android"> Android </i>  </h5>
            <p> get the android Apk of your website </p>
        </div>
       </a>
    </div>

    


</div>