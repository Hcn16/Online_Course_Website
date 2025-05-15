

function actionDelete(event) {
    event.preventDefault();
    let urlRequest = $(this).data('url');
    let that = $(this);
   
    
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, You will delete all content of courses include file, tags..!"
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: 'GET',
                url: urlRequest,
                success: function(data){
                      if (data.code == 200) {
                        that.parent().parent().remove();
                          Swal.fire({
                            title: "Deleted!",
                            text: "Your file has been deleted.",
                            icon: "success"});
                    }

                },
                error: function(){

                }
            })
           
        }
    });





};

function send_message(event) {
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
                       
                      
                      
                    }


                },
                error: function(){

                }
            })
    





};

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



function accept(event) {
    event.preventDefault();
    let urlRequest = $(this).data('url');
    let that = $(this);
   
    
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, You want to add user to Course!"
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: 'GET',
                url: urlRequest,
                data: { _token: $('meta[name="csrf-token"]').attr('content'), // other form data 
                    },
                success: function(data){
                      if (data.code == 200) {
                        
                        that.parent().parent().remove();

                          Swal.fire({
                            title: "Deleted!",
                            text: "User added to Course.",
                            icon: "success"});
                            
                        

                    }
                    location.reload();


                },

                error: function(){

                }
            })
           
        }
    });





};

function register_course(event) {
    event.preventDefault();
    let urlRequest = $(this).data('url');
    let that = $(this);
    console.log()
    
   
    
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, You want to join to Course!"
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: 'POST',
                url: urlRequest,
                data: { _token: $('meta[name="csrf-token"]').attr('content'),  // CSRF token // Các dữ liệu khác nếu cần 
                    },
               
                success: function(data){
                      if (data.code == 200) {
                        that.html('Đã gửi yêu cầu');

                          Swal.fire({
                            title: "Deleted!",
                            text: "User added to Course.",
                            icon: "success"});
                            
                        

                    }
                  


                },

                error: function(){

                }
            })
           
        }
    });





};


function submit_exercise(event) {

   

    event.preventDefault();
    let urlRequest = $(this).data('url');
    let that = $(this);
   
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var test = $('input:checked');
    var array=[];
    test.each(function(){
        array.push($(this).val())
    })
    console.log(array);

   
        
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, ready submit "
        ///
        
        
        ///

    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: 'POST',
                url: urlRequest,
                data: { 
                     // other form data 
                      data_exercise: array
                },
                success: function(data){
                      if (data.code == 200) {
                          Swal.fire({
                            title: "Submit!",
                            text: "Your were submited.",
                            icon: "success"});
                            load(data.data_url);


                    }

                    console.log(data);
                    console.log(''  + data.id_course);
                    var id =data.id_course;
                    console.log(data.data_url);
                  
                    $('.check').attr('data-url', data.data_url);
                    $('.check').removeClass('submit_exercise');

                    $('.check').addClass(' load');
                   
                 


                },
                error: function(){

                }
            })
           
        }
    });





};


function load( test){
    console.log('test');
    $.ajax({
        type: 'get',
        url: test,
        success: function(data){
            window.location.href = test;


        } 

    });

}

$(function () {
   
    $(document).on('click', '.actiondelete', actionDelete);
});


$(function () {
   
    $(document).on('click', '.accept', accept);
});

$(function () {
   
    $(document).on('click', '.send_message', send_message);
});

$(function () {
   
    $(document). on('click', '#send_mess', send_message2);
});


   
    // $('#send_mess').click(function(){
    //     send_message2();
    // })


$(function () { 
    $(document).on('click', '.submit_exercise', submit_exercise);
});


$(function () { 
    $(document).on('click', '.register_course', register_course);
});





