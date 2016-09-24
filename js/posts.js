$('[name=review_send]').on('click', function() {
	 var ref_button=$(this),
      text_post=$(ref_button).siblings('.form-group').find('[name=text_post]')[0].value,
      file_foto=$(ref_button).siblings('.form-group').find('[name=file_foto]')[0].value;

  
//alert($(ref_button).parent('.panel-body'));
  

  //console.dir();

  $.ajax({
         type: "POST",
         url: "/action/add_post_action.php",
          data: "text_post="+text_post+"&"+"file_foto="+file_foto,
          success: function(data){

              var response=JSON.parse(data);

              
              
              if (response.error=='transaction_true'){
              var after_cont=ref_button.parents('.form-post').prev();

               var post_contener = $("<div>", {
                  class: 'post-contener'
                  });
              
              $("<input>",{
              	type: 'hidden',
              	name: 'id-post',
              	value: response.id_post
              }).appendTo(post_contener);

              $("<div>", {
                  class: 'img-foto-post'
                }).appendTo(post_contener);

              $("<div>", {
                  class: 'post-foto-name'
                }).appendTo(post_contener);


              $("<img>", {
                  class: 'head-foto-user',
                  src: '/user_foto/'+response.foto
                }).appendTo($(post_contener).children('.img-foto-post'));

              $("<div>",{
                class: 'ref'
              }).appendTo($(post_contener).children('.post-foto-name'));

              $("<a>", {
              text:response.name
              }).appendTo($(post_contener).find('.ref'));

              $("<span>", {
                  text: response.text_post 
                }).appendTo($(post_contener).children('.post-foto-name'));

              $("<div>", {
                  class: 'post-foto-date',
                  text: 'только что'
                }).appendTo($(post_contener).children('.post-foto-name'));

              menu_post(post_contener);

              post_contener.insertAfter(after_cont);
              


              ref_button.siblings('.form-group').find('[name=text_post]')[0].value='';
            }

           }})
})

$('[name=delete-post-contener]').on('click', delete_post_contener);


function delete_post_contener(event){
var ref_button=$(this),	
  	input_id_post=ref_button.parents('.post-contener').find('[name=id-post]')[0].value;

event.preventDefault();

$.ajax({
         type: "POST",
         url: "/action/delete_post_action.php",
          data: "id_post="+input_id_post,
          success: function(data){

              var response=JSON.parse(data);

              //console.dir(response)
              if (response.error=='transaction_true'){
              	
              	ref_button.parents('.post-contener').remove();
              	//window.scrollTo(0,scroll_y)
              }
              
          }
               
            

           })

  

}

$('[name=edit-post-contener]').on('click',edit_post_contener);

function edit_post_contener(event){
  var text_post=$(this).parents('.post-contener').find('.post-foto-name span').text(),
  post_contener=$(this).parents('.post-contener'),
  ref_body=$(this).parents('.panel-body');

  close_text_area();  


  post_contener.find('.pen').css('display','none'); 
  ref_body.find('.form-post').css('display','none');
  post_contener.find('.post-foto-name').css('display','none');

  event.preventDefault();

  $('<div>',{
    class: 'text-update-contener'
  }).appendTo(post_contener);

  $('<textarea>',{
    class: 'text-update-area',
    text: text_post.replace(/\s{2,}/g, ' '),
    name: 'comment',
    rows: 8
  }).appendTo(post_contener.find('.text-update-contener'));

  
  post_contener.find('[name=comment]').keydown(textarea_keydown);
}

$('[name=comment]').on('keydown',textarea_keydown);

function textarea_keydown(event){
  if (event.which==13){
    var ref_post_contener=$(this).parents('.post-contener'),

      text_post=ref_post_contener.find('[name=comment]').val(),
      input_id_post=ref_post_contener.find('[name=id-post]')[0].value;
      ref_body=$(this).parents('.panel-body'),
      ref_post_contener.find('.text-update-contener').remove();

      //ref_post_contener.find('.post-foto-name span').text(text_post);
  
      $.ajax({
         type: "POST",
         url: "/action/update_post_action.php",
          data: "id_post="+input_id_post+"&"+"text_post="+text_post,
          success: function(data){

              var response=JSON.parse(data);

              alert(response)
              if (response.error=='transaction_true'){
              	
              //	ref_button.parents('.post-contener').remove();
				 ref_post_contener.find('.pen').css('display','block'); 
				 ref_body.find('.form-post').css('display','block');
				 ref_post_contener.find('.post-foto-name').css('display','inline-block');
              	//window.scrollTo(0,scroll_y)
                 ref_post_contener.find('.post-foto-name span').text(response.text_post);
              	 ref_post_contener.find('.post-foto-date').text('только что');	
              }
              
          }
               
            

           })

      close_text_area();
      close_edit_post();
      }

}

function close_text_area(){
$('.pen').each(function(){
	$(this).css('display','block');
});
$('.form-post').each(function(){
	$(this).css('display','block');
});
$('.post-foto-name').each(function(){
	$(this).css('display','inline-block');
});
$('[name=comment]').remove();
}