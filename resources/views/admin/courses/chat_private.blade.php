@extends('layouts.admin')

@section('title')
<title>Chat</title>
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
    width: 50%;
    max-width: 1000px;
    margin: 50px 50px 50px 723px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    position: absolute;
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
    background-size: cover;
    /* Đảm bảo hình nền bao phủ toàn bộ trang */
    background-position: center;
    /* Căn giữa hình nền */
    background-repeat: no-repeat;
    /* Không lặp lại hình nền */
    margin: 0;
    padding: 0;


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

.box_chat {
    width: 20%;
    height: 650px;
    background-color: bisque;
    margin-left: 253px;
    overflow-y: scroll;
}

.Message {
    display: flex;

}

.text-sm{
    color:#6c757d;
}

.text-sm.active{
    color: black;
}

.main_media {
    border-bottom: 1px solid black;
    margin-top: 15px;
    color: #6c757d;
}

.body_{
    display:flex;
}
#linkSelect { max-height: 100px; /* Set the maximum height */ overflow-y: auto; /* Enable vertical scrolling */ }


</style>
@section('css')
 <link href="{{asset('vendors/select2/select2.min.css')}}" rel="stylesheet"></link> 
<link href="{{asset('Addmin/Courses/add/add.css')}}">

</link>
@endsection
<div class="Message">


    <div class="box_chat">


        <div class="form-group">
            <label for="disabledSelect" class="form-label ">Nhập tên cần tìm </label><br>
            <select   id="linkSelect" class="form-control selectParent" 
                name="id_teacher" title="ChonDanhMuc">
                <option value=""></option>

                {!! $htmlUser !!}

            </select>

        </div>
        <script>
            $(document).ready(function() {
    $('#linkSelect').on('change', function() {
        var url = this.value;
            console.log(url);
            if (url) {
                window.location.href = url;
            }
    });
});


        
        </script>
        <div class="box_parent" id="box-parent">


            @if(isset($userItem) && $userItem != '')

            <a class="main_media media" href="{{route('courses.detail_chat_for_user', ['id'=>$userItem[0]->id])}}" value="{{$userItem[0]->id}}">

                <form action="" class="body_" >
                    <img src="{{asset($user->get_user_send($userItem[0]->id)[0]->avatar_image_path)}}" alt="User Avatar"
                        class="img-size-50 img-circle mr-3">
                    <input type="hidden" name="id_user" class="id_user" value="{{$userItem[0]->id}}">
                    <div class="media-body">
                        <h3 class="dropdown-item-title">
                            {{$user->get_user_send($userItem[0]->id)[0]->name}}
                            <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                        </h3>
                        <p class="text-sm"></p>
                        @if (isset($user->getContent_created_at($userItem[0]->id)->created_at))
                         <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 
                        
                         {{$user->getContent_created_at($userItem[0]->id)->created_at}}
                         Hours Ago</p> 
                         @else
                         <p class="data-item" data-time="{{$user->getContent_created_at($userItem[0]->id)}}"><i class="far fa-clock mr-1"></i> 
                        
                        {{$user->getContent_created_at($userItem[0]->id)->diffForHumans()}}
                        </p> 
                         @endif
                      
                    </div>



                </form>
            </a>


            @endif

            @foreach ($user->getMessage() as $item_noti)

           
            
            <a class="main_media media" id="media" href="{{route('courses.detail_chat_for_user', ['id'=>$item_noti->id_other_user])}}" 
            value="{{$item_noti->id_other_user}}">

                <form action="" class="body_" >
                    <div>
                    <img src="{{asset(($user->get_user_send($item_noti->id_other_user))[0]-> avatar_image_path)}}"
                        alt="User Avatar" class="img-size-50 img-circle mr-3">
                      
                    <input type="hidden" name="id_user" class="id_user" value="{{$item_noti->id_other_user}}">
              

                    </div>
                    <div class="main_body media-body" >
                        <h3 class="dropdown-item-title">
                            {{auth()->user()->get_user_send($item_noti->id_other_user)[0]->name}}
                            
                        </h3>
                        @if ($user->getContent_created_at($item_noti->id_other_user) != [])
                        @if($user->is_check($item_noti->id_other_user) != [])
                        <p class="text-sm active" >
                         {{$user->getContent_created_at($item_noti->id_other_user)[0]->content}}
                        <script>
                            const activeChildren = $('.text-sm.active'); 
                            activeChildren.each(function() { 
                                const parent = $(this).parents('.main_body');
                                parent.css({'color':'black'});
                            });
                        </script>
                        </p>
                        @else
                        <p class="text-sm" >
                         {{$user->getContent_created_at($item_noti->id_other_user)[0]->content}}
                         
                        </p>

                        @endif
                         @endif
                      
                        @if ($user->getContent_created_at($item_noti->id_other_user) != [])
                         <p class="data-item" data-time="{{$user->getContent_created_at($item_noti->id_other_user)[0]->created_at}}">{{$user->getContent_created_at($item_noti->id_other_user)[0]->created_at->diffForHumans()}}
                         </p> 

                         @endif
                    </div>

                </form>
            </a>
            <?php 
               
            ?>


            @endforeach



        </div>
        <script>




        </script>

       

    </div>
    <div class="chat-container">
        <div class="chat-header">
            @if($id != auth()->id())
        {{$user->get_user_send($id)[0]->name}}

        @else
        {{$user->get_user_send($user->getMessage()[0]->id_other_user)[0]->name }} 
        @endif 

        </div>
        <div class="chat-messages " id="chat">
            @foreach ($chat_receive as $item )
            @if($item->id_send == auth()->id())
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


            <form class="chat_user " action="" style="display: flex;width: 100%;">
                @csrf
                <input type="text" placeholder="Type your message..." name="messages" class="content"
                    style="display: block">

                <button type="submit" data-url="{{route('courses.send_message_user',
                    ['id_receive'=>$id])}}" class="" id="send_message_user">Send</button>
            </form>


        </div>
    </div>
</div>

<script>
  

//   const activeItems = JSON.parse(localStorage.getItem('activeText-sm')); 
//   if (activeItems) { 
//     $('.media .text-sm').removeClass('active'); 
//     activeItems.forEach(function(index) 
//     { $('.media .text-sm').eq(index).addClass('active'); 


//     }); 
   
// }
// const activeItems = $('.media .text-sm').filter('.active'); 
// const activeCount = activeItems.length; $('.tbao').text( activeCount); 

</script>
<div class="id_user_now" value="{{auth()->id()}}" style="display:none;"></div>
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
var div = document.getElementById("chat");
div.scrollTop = div.scrollHeight;
</script>

@section('js')
<script src="{{asset('vendors/select2/select2.min.js')}}"></script>
<script src="{{asset('Addmin/Courses/add/add.js')}}"></script>

@endsection
@endsection