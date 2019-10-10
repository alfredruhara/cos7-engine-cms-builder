<div id="displa" class="col s12" style='padding:0px;'>  </br>
    <form method='post'>    
        <div class="col s6">
            <div class="col s12">
                <ul class="collapsible white-text "  style='border:none;' data-collapsible="accordion">
                    <li class=''>
                        <div class="collapsible-header active cust_menu" >
                            <i class="fa fa-tv"></i>Category ( Sub menu )
                        </div>
                        <div class="collapsible-body " style='padding:10px;'> <br/>
                            <div class="row">
                                 <i class="white-text fa fa-tv"></i>  Choose how to display categories  (sub menu )
                                     <p>
                                        <input  name="category_display" type="radio" value='tab' value='tab' id="tabs_cat" <?= $displayConfig->category === 'tab' ? 'checked' : '' ?> />
                                        <label for="tabs_cat" class='white-text'>Tabs Dispaly</label>
                                     </p>
                                                
                                        <!-- Menu list  -->
                                            <nav class="nav-extended cust_menu z-depth-0">
                                                <div class="containers">
                                                    <div class="nav-wrapper">
                                                        <a href="" class="brand-logo " style='margin-left:10px'>  </a>
                                                    
                                                        <ul id="nav-mobile" class="right hide-on-med-and-down">
                                                                <li class=''><a href="#!" class=''> Menu 1  </a></li>
                                                                <li class=''><a href="#!" class=''> Menu 2  </a></li>
                                                               
                                                        </ul>

                                                    </div>
                                                </div>

                                            </nav>
                                            <!-- Category tabs -->
                                            <ul class="cust_tabs z-depth-0">
                                                <li class="cust_tab "> <a href="#!" class='category on_active'>Category 1</a></li>
                                                <li class="cust_tab "> <a href="#!" class='category '>Category 2</a></li>
                                               
                                            </ul>
                                            

                                            <!--_____________  -->
                                        <!--___ Drop down Category ___-->
                                        <!--______________ -->

                                            <p>
                                                <input  name="category_display" type="radio" value='dropdown' id="drop_down"  <?= $displayConfig->category === 'dropdown' ? 'checked' : '' ?>  />
                                                <label for="drop_down" class='white-text'>Drop down display</label>
                                            </p>
                                                    
                                            <!-- Menu list with drop down category items -->
                                            <nav>
                                                <div class="nav-wrapper cust_menu z-depth-0">
                                                    <div class="containers">
                                                        <a href="#!" class="left brand-logo"></a>
                                                        <ul class="right hide-on-med-and-down">
                                                            <!-- Dropdown Trigger -->
                                                                    <li class=''><a href="#!" class='dropdown-button' data-activates="dropdown1"> Menu 1  </a></li>
                                                                    <li class=''><a href="#!" class='dropdown-button' data-activates="dropdown2"> Menu 2  </a></li>
                                                                  
                                                        </ul>
                                                    </div>
                                                </div>
                                            </nav>

                                            <!-- Dropdown Structure -->
                                            <ul id="dropdown1" class="dropdown-content">
                                                    <li><a href="#!">Cat 1</a></li>
                                                    <li><a href="#!">Cat 2</a></li>
                                            </ul>
                                            <ul id="dropdown2" class="dropdown-content">
                                                    <li><a href="#!">Cat 11</a></li>
                                                    <li><a href="#!">Cat 22</a></li>
                                            </ul>
                            </div>
                        </div>
                    </li>   
                </ul>
            </div>
        </div>

         <div class="col s6">
            <div class="col s12">
                <ul class="collapsible white-text"   style='border:none;' data-collapsible="accordion">
                    <li class=''>
                        <div class="collapsible-header active cust_menu " >
                            <i class="fa fa-tv"></i> Sub Category
                        </div>
                        <div class="collapsible-body " style='padding:10px;'> <br/>
                               <i class="white-text fa fa-tv"></i> Choose how to display sub categories
                                <p>
                                    <input  name="subcategory_display" type="radio" id="dropdown_sub" value='dropdown' <?= $displayConfig->subcategory === 'dropdown' ? 'checked' : '' ?>  />
                                    <label for="dropdown_sub" class='white-text'> Drop down display </label>
                                </p>
                                <!-- Menu list -->
                                <nav class="nav-extended cust_menu z-depth-0">
                                    <div class="containers">
                                        <div class="nav-wrapper">
                                            <a href="" class="brand-logo " style='margin-left:10px'> </a>
                                        
                                            <ul id="nav-mobile" class="right hide-on-med-and-down">
                                                <li class=''><a href="#!" class=''> Menu 1  </a></li>
                                                <li class=''><a href="#!" class=''> Menu 2  </a></li>
                                               
                                            </ul>

                                        </div>
                                    </div>

                                </nav>
                                <!-- Category tabs with drop down sub categories -->
                                <ul class="cust_tabs z-depth-0">
                                    <li class="cust_tab " >
                                            <a href="#!" class='category on_active dropdown-button' data-activates="dropdown33">Category 1</a>
                                    </li>
                                    <li class="cust_tab ">
                                        <a href="#!" class='category dropdown-button' data-activates="dropdown44" >Category 2</a>
                                        </li>
                                    
                                    
                                </ul>
                                

                                <!-- Dropdown Structure -->
                                <ul id="dropdown33" class="dropdown-content">
                                        <li><a href="#!">Subcat 1</a></li>
                                        <li><a href="#!">Subcat  2</a></li>
                                        
                                </ul>
                                <ul id="dropdown44" class="dropdown-content">
                                        <li><a href="#!">Sub category 11</a></li>
                                        <li><a href="#!">Subcat 22</a></li>
                                </ul>
                                <!--_____________  -->
                                <!--___ Card down Sub Category ___-->
                                <!--______________ -->
                                <p>
                                    <input  name="subcategory_display" type="radio" id="card_sub" value='card'  <?= $displayConfig->subcategory === 'card' ? 'checked' : '' ?>  />
                                    <label for="card_sub" class='white-text'>Card display </label>
                                </p>
                                <!-- Menu -->
                                <nav class="nav-extended cust_menu z-depth-0">
                                    <div class="containers">
                                        <div class="nav-wrapper">
                                            <a href="" class="brand-logo " style='margin-left:10px'> </a>
                                        
                                            <ul id="nav-mobile" class="right hide-on-med-and-down">
                                                <li class=''><a href="#!" class=''> Menu 1  </a></li>
                                                <li class=''><a href="#!" class=''> Menu 2  </a></li>
                                               
                                                </ul>

                                        </div>
                                    </div>

                                </nav>
                                <!-- Category tabs -->
                                <ul class="cust_tabs z-depth-0">
                                    <li class="cust_tab "> <a href="#!" class='category on_active'>Category 1</a></li>
                                    <li class="cust_tab "> <a href="#!" class='category '>Category 2</a></li>
                                  
                                </ul>
                                
                                <!-- Sub categories of A category -->
                                <div  id='suitof' 
                                        class="sub_cat row active_category suitof">
                                        <div class="popUpSubCategories cust z-depth-1">

                                            <h5 class="center-align black-text  " style='cursor:pointer;'> Category 1   </h5>
                                                            
                                            <a href="#!" class='cust_cat  z-depth-1 '>  SubCat 1  </a>
                                            <a href="#!" class='cust_cat   '>  SubCat 2  </a>
                                        
                                        </div>
                                </div>
                        </div>
                    </li>   
                </ul>
            </div>
        </div>
        
        
        
         <div class="center-align cust col s12" style='border-top:1px solid #555555; padding:10px; margin-top:-20px;'>
                            <?= $form->validate('display','Save Changes', 'btn cust_nav center-align z-depth-0')?>
          </div>
        </form>
    


</div>
