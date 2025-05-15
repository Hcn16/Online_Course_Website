
function send_message_user(event) {
    // $('.chat_form').off('submit').on('submit', function(event) {
        
        event.preventDefault();  


   
    let urlRequest = $(this).data('url');
    let that = $(this);
  
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
            $.ajax({
                type: 'POST',
                url: urlRequest,
                data:{ 
                    content: $('.content').val(),
                    id_user_receive: $('.id_user').val()
                 
                    
                },
                success: function(data){
                      if (data.code == 200) {
                        location.reload() ;   
                        // $('.user').append('<div class="message">Thẻ div mới</div>'); 
                        // event.stopImmediatePropagation();

                        
                      
                    }


                },
                error: function(){
                    

                }
            })
    
        // });




};


function showMessage(event) {
    // $('.chat_form').off('submit').on('submit', function(event) {
        
        event.preventDefault();  


   
    let urlRequest = $(this).data('url');
    let that = $(this);
  
   
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
            $.ajax({
                type: 'get',
                url: urlRequest,
                data:{ 
                    id_user_receive: $('.id_user').val()
                 
                    
                },
                success: function(data){
                      if (data.code == 200) {
                        // $('.user').append('<div class="message">Thẻ div mới</div>'); 
                        // event.stopImmediatePropagation();

                        
                      
                    }


                },
                error: function(){
                    

                }
            })
    
        // });




};




$(function () {
   
    $(document). on('click', '#send_message_user', send_message_user);
});


$(function () {
   
    $(document). on('click', '#show_message', showMessage);
});
