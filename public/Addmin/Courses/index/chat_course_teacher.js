function send_message2(event) {
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
                    id_course: $('.id_course').val()
                    
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
   
    $(document). on('click', '#send_mess_teacher', send_message2);
});