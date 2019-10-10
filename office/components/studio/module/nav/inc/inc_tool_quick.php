<div id="quicktips" class="col s12" style='padding:0px;'>  <br/>

        <div class="col s12">
            <ul class="collapsible white-text"  style='border:none;' data-collapsible="accordion">
                <li class=''>
                    <div class="collapsible-header active cust_menu" >
                          <i class="fa fa-cog"></i> Settings :   Sort and Order Menu items
                    </div>
                    <div class="collapsible-body " style='padding:10px;'> <br/>
                        <div class="row">
                          
                            <form method='post'>
                                <div class="col s6">
                                       <div class="col s12">
                                            <i class="orange-text fa fa-info-circle "></i> Sort menu by 
                                       </div>
                                        <?= $form->select('sortby', 'Sort by ', ['id' => 'Id', 'date' => 'Date' , 'name' => 'Name']) ?>
                                </div>
                                
                                <div class="col s6">
                                       <div class="col s12">
                                        <i class="orange-text fa fa-info-circle "></i> Use ....  order 
                                       </div>
                                        <?= $form->select('orderby', ' Order ', ['asc' => 'Ascendent', 'desc' => 'Descendent','random()' => 'Random']) ?>
                                </div>

                                
                                <div class="center-align">
                                    <?= $form->validate('settings','Save Changes', 'btn cust_nav center-align z-depth-0')?>
                                </div>
                            
                            </form>

                        </div>
                    </div>
                </li>   
            </ul>
        </div>

</div>
   