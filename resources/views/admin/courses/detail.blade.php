@extends('layouts.admin')

@section('title')
<title>Courses detail</title>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{asset('Addmin/Courses/index/list.js')}}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


@endsection

@section('content')


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->


    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{ $coursesList->name }} ( {{$coursesList->id}} )</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">



                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->




    <!-- /.content-header -->
    <style>
                .chat-container {
                    width: 100%;
                    max-width: 1000px;
                    margin: 50px 50px 50px 120px;
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
                .chat-input content {
                    border:none;
                }

                </style>


    <!-- Main content -->
    <div class="_content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <a href="{{route('courses.index')}}" class="btn btn-success float-left m-2">Return Course</a>

                </div>

                <div class="col-md-12">
                    @if(auth()->user()->roles->contains('id', 1) )
                    <a href="{{route('sections.index',['id_course' => $coursesList->id])}}"
                        class="btn btn-success float-right m-2">Nội dung</a>
                    <a href="{{route('exercises.index',['id_course' => $coursesList->id])}}"
                        class="btn btn-success float-right m-2">Bài tập</a>
                    <a href="{{route('questions.index',['id_course' => $coursesList->id])}}"
                        class="btn btn-success float-right m-2">Câu hỏi</a>
                     

                        @elseif(auth()->user()->roles->contains('id', 4) && auth()->user()->manage_course->contains('id', $coursesList->id) )
                        <a href="{{route('sections.index',['id_course' => $coursesList->id])}}"
                        class="btn btn-success float-right m-2">Nội dung</a>
                    <a href="{{route('exercises.index',['id_course' => $coursesList->id])}}"
                        class="btn btn-success float-right m-2">Bài tập</a>
                    <a href="{{route('questions.index',['id_course' => $coursesList->id])}}"
                        class="btn btn-success float-right m-2">Câu hỏi</a>

                     

                    @endif


                </div>

               



                <div class="col-md-12">
                   
                    <div class="id_user" value="{{auth()->id()}}" style="display:none;"></div>
                    <div class="chat-container">
                        <div class="chat-header">
                            Chat Course
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

                           
                            <form class = 'chat_form'  style="display: flex;width: 100%;">
                            @csrf
                                <input type="text" placeholder="Type your message..." name=" " class="content"
                                    style="display: block">
                                <input title="id_course"type="text" class="id_course" value="{{$coursesList->id}}" style="display: none">

                                <button type="submit"
                                    data-url="{{route('courses.send_message_course',['id_course'=>$coursesList->id])}}"
                                    class="send send_message2" id="send_mess_teacher">Send</button>
                            </form> 

                            

                        </div>
                    </div>


                </div>

                <div>


                </div>








            </div>
            <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script>
    


var div = document.getElementById("chat");
div.scrollTop = div.scrollHeight;
</script>


@endsection