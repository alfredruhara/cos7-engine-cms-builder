<nav class="nav-extended cust_menu pinned " style='z-index:99' >
     <div class="nav-wrapper col s10"> 
        <a href="#!" class="brand-logo right " style='font-size:18px;'> 
            <span class='orange-text'>location : </span> 
            Menu 
        <a href="#!" class="brand-logo center" style=''>  <?= ucfirst($menu->menu) ?></a>
        <a href="?vl=<?= $systemSingleMenu->cursor('studio')['nav']['out'] ?>" class="brand-logo left " style=' margin-left:7px;'> 
            <i class="fa fa-arrow-left white-text" style='font-size:18px;' >  Navigations </i> 
         </a>
    </div>
</nav>
<br/> <br/> <br/> 