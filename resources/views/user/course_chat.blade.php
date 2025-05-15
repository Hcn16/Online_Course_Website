@extends('user.detail_Course')

@section('title')
<title>Home</title>
@endsection

@section('content')




<style>
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.chat-container {
    width: 100%;
    max-width: 1000px;
    margin: 50px 50px 50px 400px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.chat-header {
    background-color: #007bff;
    color: #fff;
    padding: 15px;
    text-align: center;
}

.chat-messages {
    padding: 20px;
    height: 400px;
    overflow-y: scroll;
}

.chat-message {
    margin-bottom: 15px;
}

.chat-message .message {
    padding: 10px;
    border-radius: 5px;
    display: block;
}

.chat-message.user {
    width: 100%;
    display: block;
    float: right;

}



.chat-message.user .message {
    background-color: #007bff;
    color: #fff;
    float: right;

    display: block;
}



.chat-message.bot {
    display: flex;
    width: 100%;
}

.chat-message.bot .message {
    background-color: #f1f1f1;
    color: #333;
    float: left;
}

.chat-message.bot .avatar {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background-color: red;
    margin: 8px 9px 7px 0px;
    background-size: cover; /* Đảm bảo hình nền bao phủ toàn bộ trang */ 
            background-position: center; /* Căn giữa hình nền */ 
            background-repeat: no-repeat; /* Không lặp lại hình nền */ 
            margin: 0; padding: 0;


}

.chat-input {
    padding: 15px;
    border-top: 1px solid #ddd;
    display: flex;
}

.chat-input input {
    flex: 1;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    margin-right: 10px;
}

.chat-input button {
    padding: 10px 20px;
    border: none;
    background-color: #007bff;
    color: #fff;
    border-radius: 5px;
    cursor: pointer;
}
</style>
@vite('resources/js/app.js')

<div class="chat-container">
    <div class="chat-header">
        {{$course->name}}
    </div>
    <div class="chat-messages " id="chat">
        @foreach ($chat as $item )
        @if($item->id_send ==auth()->id())
        <div class="chat-message user" id="chat_user" value="{{auth()->id()}}">
            <div class="message">{{$item->content}}</div>
        </div>
        @else
        <div class="chat-message bot">
            <div class="avatar" style="background-image: 
            
            url('{{asset($user->get_user_send($item->id_send)[0]->avatar_image_path)}} '); "></div>
            <div>
                <div class="name">{{$user->get_user_send($item->id_send)[0]->name}}</div>
                <div class="message">{{$item->content}}</div>



            </div>

        </div>

        @endif
        <div class="time" style="text-align: center;">{{$item->created_at}}</div>




        @endforeach


    </div>
    <div class="chat-input">

        @csrf
        <form action="" style="display: flex;width: 100%;">
        <input type="text" placeholder="Type your message..." name="message" class="content" style="display: block">
        <input type="text" class="id_course" value="{{$course->id}}" style="display: none">

        <button type="submit" data-url="{{route('user.send_message_course',['message'=>$course->id])}}"
            class="send_message">Send</button>
            </form>


    </div>
</div>
<div class="id_user" value="{{auth()->id()}}" style="display:none;"></div>
<!-- <script>
$(document).ready(function() {
    function scrollToBottom() {
        var chatContainer = $('.chat-message');
        chatContainer.scrollTop(chatContainer.prop("scrollHeight"));
    }
    // Gọi hàm scrollToBottom khi trang được tải scrollToBottom(); 
    // Gọi hàm scrollToBottom khi thêm tin nhắn mới 
    $('.send_message').click(function() {
        $('.chat-message').append('<div class="chat-message user">Tin nhắn mới</div>');
        scrollToBottom();
    });

});
</script> -->


<script>
// console.log($('#chat_user').val())
</script>

<script>
    //add active menu_homepage
var param2 = localStorage.getItem('_menu_homepage');
var matchingElements = $('.menu_homepage').filter(function() { 
    $('.menu_homepage').removeClass('active');
    return $(this).attr('value') == param2; 

});

matchingElements.each(function() { 
    
    $(this).addClass('active');

});
localStorage.removeItem('_menu_homepage');
   //////


var div = document.getElementById("chat");
div.scrollTop = div.scrollHeight;
</script>


@endsection