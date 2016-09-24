$('[name=event]').on('click', edit_post )


function edit_post(event){
  var current_contener=$(this).parents('.pen'),
        div_pen=current_contener,
        div_ul_li=current_contener.find('li'),
        div_menu_drop=current_contener.find('.drop-menu');
    
    event.preventDefault();

    close_edit_post();


    div_ul_li.css('display','block');

    div_pen.addClass('pen-active'); 

    div_menu_drop.removeClass('drop-menu-no-active');
    div_menu_drop.addClass('drop-menu-active');

    current_contener.find('span').css('left','10px');

}    


function close_edit_post(){
$('div.pen').each(function(){
        $(this).find('li').css('display','none');
        $(this).find('span').css('left','0px');

        $(this).removeClass('pen pen-active');
        $(this).addClass('pen');

        $(this).find('.drop-menu').removeClass('drop-menu-active');
        $(this).find('.drop-menu').addClass('drop-menu-no-active');

     })
}

$('[name=text_post]').on('click', close_edit_post)

function menu_post(post_elm){
  var pen=$("<div>", {
    class: 'pen'
  });

  $("<a>",{
    name: 'event'
  }).appendTo(pen);

  $("<span>", {
    class: 'glyphicon glyphicon-pencil',
    }).appendTo(pen.find('a'));

  $("<ul>", {
    class:'drop-menu drop-menu-no-active'
  }).appendTo(pen);

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
   pen.find('[name=delete-post-contener]').click(delete_post_contener);
   pen.find('[name=edit-post-contener]').click(edit_post_contener);

  pen.appendTo(post_elm);
}

