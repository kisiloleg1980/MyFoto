
  
<div class="col-md-3 form-review">
    
    <div class="panel panel-default user">
      <div class="panel-body">
          <img src="/user_foto/<?=$Params->user->id_foto_user?>" class="user-foto" alt="not">
          <div class="text-right"><?=$Params->user->name?></div>
      </div>
    </div>

</div>




<div class="col-md-6 form-review">
<div>
  <?php if ($Params->access==true) :?>   
  <form action="/profile/insert/?id=<?=$Params->user->id_user?>" method="POST" enctype="multipart/form-data" class="center-block">
       <div class="panel panel-default ">
          <div class="panel-body">
              <div class="form-group">
              <label for="exampleInputFile">Вкласти файл</label>
              <input type="file" name="file_name" id="exampleInputFile">
              </div>
      
              <button type="submit" class="btn btn-primary btn-block">Отправить</button>
          </div>
      </div>
  </form>
  <?php else:?>
  <div class="status_follow pull-right">
    <ul class="btn btn-default" id="title_button" 
      <?php if ($Params->status_follow==true) :?>
        subs="follow">ВЫ подписаны
      <?php else:?>
        subs="not_follow">Вы не подписаны
      <?php endif?>
      <li class="btn btn-default" id="event_follow" >
        <a href="#">
          <?php if ($Params->status_follow==true) :?>
          Прекратить подписку
          <?php else:?>
          Подписаться
          <?php endif?>
        </a>
      </li>
    </ul>
  </div> 
  <?php endif?>

  <h2 class="center-title">Все фото</h2>
</div>
  
  <? foreach ($Params->name_file as $key=>$array_file_follow): ?>

  <div class="panel panel-default">
      <div class="panel-heading">
        <div>
          <img src="/user_foto/<?=$Params->user->id_foto_user?>" class="head-foto-user" alt="not">
        </div>  
        <div class="head-foto-name">
          <?=$Params->user->name?>
        </div>
        <div class="head-foto-date">
          <?=$array_file_follow['date_time']?>
        </div>
      </div>
      <div class="panel-body"> 
        <a href="#"> 
          <img src="/foto/<?=$array_file_follow['name_file']?>" class="foto" data-toggle="modal" data-target="#id<?=$key?>" alt="not"> 
        </a>
         
         <? foreach($array_file_follow['posts'] as $array_posts): ?>
         
        <div class="post-contener">
            <input type="hidden" name="id-post" value="<?=$array_posts['id_post']?>">
            <div class="img-foto-post">
              <img src="/user_foto/<?=$array_posts['id_foto_user']?>" class="post-foto-user" alt="not">
            </div>
            <div class="post-foto-name">
               <div class="ref">
                 <a href="#"><?=$array_posts['name']?></a>
               </div>
               <span><?=$array_posts['text_post']?></span>
               <div class="post-foto-date">
                   <?=$array_posts['date_time']?>
               </div>
            </div>
            <? if ($array_posts['id_users']==$_SESSION['user']['id_users']) : ?>
            <div class="pen">
               <a href="#" name="event">
                  <span class="glyphicon glyphicon-pencil"></span>
               </a>
               <ul class="drop-menu drop-menu-no-active">
                 <li><a href="#" name="edit-post-contener">Редактировать</a></li>
                 <li><a href="#" name="delete-post-contener">Удалить</a></li>
              </ul>
            </div>
            <?php endif?>
           
        </div>
        
         <? endforeach?>

        <?php if ($Params->access==true) :?>
        <div class="form-post form-inline">
          
            <div class="form-group">

              <input type="text" name="text_post" class="form-control" placeholder="написати коментар">
              <input type="hidden" name="file_foto" value="<?=$array_file_follow['name_file']?>">
            </div>
              
              
            
            <button type="button" name="review_send" class="btn btn-default pull-right">Напишить</button>
          
        </div>
        <?php endif?>  
      
      </div>
  </div>


  <div class="modal fade" id="id<?=$key?>" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <img src="/foto/<?=$array_file_follow['name_file']?>" class="foto" alt="not">

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">закрити</button>
        </div> 
      </div>
    </div>
  </div>

  <? endforeach?>

</div>
  






