$('[name=review_profile_send]').on('click', function(){
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

              alert(response)
              //console.dir(data);
              /*if (response.error=='transaction_true'){
              var after_cont=ref_button.parents('.form-post').prev();

               var post_contener = $("<div>", {
                  class: 'post-contener'
                  });
                    
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
            }*/

              



         }})

  
})








function menu_post(post_elm){
  var pen=$("<div>", {
    class: 'pen'
  });

  $("<ul>", {
    class:'drop-menu drop-menu-no-active'
  }).appendTo(pen);

  $("<span>", {
    class: 'glyphicon glyphicon-pencil',
    name: 'event'
    }).appendTo(pen.find('ul'));


  $("<li>", {
    }).appendTo(pen.find('ul'));

  $('<a>',{
    href: '#',
    text: 'Редактировать',
    name: 'edit-post-contener'
  }).appendTo(pen.find('ul li:first'));

  $("<li>", {
    }).appendTo(pen.find('ul'));

  $('<a>',{
    href: '#',
    text: 'Удалить',
    name: 'delete-post-contener'
  }).appendTo(pen.find('ul li:last'));


  pen.find('[name=event]').click(edit_post);
  // pen.find('[name=delete-post-contener]').click(delete_post_contener);
  // pen.find('[name=edit-post-contener]').click(edit_post_contener);

  pen.appendTo(post_elm);
}

function form_post(post_elm){
  var form=$('<div>',{
    class: 'form-post form-inline'
  });

  $('<div>',{
    class: 'form-group'
  }).appendTo(form);

  $('<input>',{
    type: 'text',
    name: 'text_post',
    class: 'form-control',
    id: 'input-text-post',
    placeholder: 'написати коментар'
  }).appendTo(form.find('.form-group'))

  $('<input>', {
    type:'hidden',
    name: 'file_foto'
  }).appendTo(form.find('.form-group'));

  $('<button>',{
    class: 'btn btn-default pull-right',
    name: 'review_profile_send',
    type: 'button',
    text: 'Напишить' 
  }).appendTo(form);

  form.find('[name=review_profile_send]').click(add_post_contener);


  form.appendTo(post_elm);
}