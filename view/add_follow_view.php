<div class="container">
	<h2 class="center-block add-follow-h">Список на кого підписатися</h2>
	
	<? foreach ($Params->new_follow as $value): ?>
    <div class="add-follow-panels center-block">
	<div class="panel panel-default ">
	  <div class="panel-body ">
	  	<div class="row">
	  		<div class="col-md-3">
	  			<img src="user_foto/<?=$value['id_foto_user']?>" class="add-follow-foto img-rounded">
	  		</div>
	  		<div class="col-md-4 col-md-offset-1 add-follow-name ">
	  		   <?=$value['name']?>
	  		 </div>
	       <div class="col-md-2 pull-right">
	  		<form action="action/add_follow_action.php" method="POST">
	  			<input type="hidden" name="id_users" value="<?=$value['id_users']?>">	
  			    <button type="submit" class="btn btn-default">Додати</button>
  		    </form>
	      </div>
	   </div>
	  </div>
	</div>
</div>

	<? endforeach?>

</div>