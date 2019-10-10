<div class="nav-content cust_menu pinned col s10"  style='z-index:99'>
    <ul class="tabs_cust ">
        <?php if ($menu_list != []): ?>
            <?php foreach($menu_list as $menu): ?>
                    <li class='tab_cust'><a href="?vl=<?= $systemMenu->cursor('studio')['menu']['out'] ?>&id=<?=  $menu->id ?>" 
                        class='<?= $colors[array_rand($colors)] ?>-text'> <?= ucfirst( $menu->menu) ?>  </a></li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
</div>
<br/><br/>