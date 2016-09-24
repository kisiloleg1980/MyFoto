<div id="navbar" class="collapse navbar-collapse navbar-right">
          <ul class="nav navbar-nav">
            <? foreach ($Params->menu_model as $value) : ?>
               <li><a href="<?=$value['url']?>"><?=$value['name']?></a></li>
            <? endforeach; ?>
          </ul>
</div>          