$('#event_follow').on('click', function(){

 var id_profile = window.location.search.substr(1).split('=')[1],
          el=document.getElementById('title_button'),
          subs=el.getAttribute('subs');

$.ajax({
         type: "POST",
         url: "/action/add_follow_action.php",
          data: "subs="+subs+"&"+"id_profile="+id_profile,
          success: function(data){

              var response=JSON.parse(data);
                
              if (response.error=='transaction_true') {
                

                if (response.subs=='not_follow') {
                  
                  

                  el.firstChild.data='Вы не подписаны';
                  el.children.event_follow.children[0].firstChild.data='Подписаться';
                  el.setAttribute('subs','not_follow');
                } else {

                  
                  el.firstChild.data='Вы подписаны';
                  el.children.event_follow.children[0].firstChild.data='Прекратить подписку';
                  el.setAttribute('subs','follow');
                }


          }


         }})

})