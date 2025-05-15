<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="{{asset('desgin/css/style.css')}}">

    <meta name="csrf-token" content="{{ csrf_token() }}">


    <link rel="stylesheet" href="{{asset('user/detail_course.css')}}">



    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset('AdminLTE/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('AdminLTE/dist/css/adminlte.min.css')}} ">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{asset('Addmin/Courses/index/list.js')}}"></script>
    <script src="{{asset('Addmin/Courses/index/send_message_1.js')}}"></script>
    <link href="{{asset('vendors/select2/select2.min.css')}}" rel="stylesheet">
    </link>
    <link href="{{asset('Addmin/Courses/add/add.css')}}">
    <script src="{{asset('vendors/select2/select2.min.js')}}"></script>
    <script src="{{asset('Addmin/Courses/add/add.js')}}"></script>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
    </script>



</head>



<body>
    <style>
    .notificate {

        display: none;

    }

    .notificate.active {
        position: absolute;
        display: block;
    }
    </style>
    @yield('css')


    <header class="header">

        <section class="flex">

            <a href="{{asset('homePage')}}" class="logo">Educa.</a>

            <form action="{{route('courses.search')}}" method="get" class="search-form">
                <input type="text" name="search_value" required placeholder="search courses..." maxlength="100">

                <button type="submit" class="fas fa-search"></button>
            </form>

            <div class="icons">
                <div id="menu-btn" class="fas fa-bars"></div>
                <div id="search-btn" class="fas fa-search"></div>
                <div id="user-btn" class="fas fa-user"></div>
                <div id="toggle-btn" class="fas fa-sun"></div>
                <div id="message-btn" class="far fa-message">
                </div>
                @if(isset(auth()->user()->check_noti()[0]) )
                @if( auth()->user()->check_noti()[0]->is_check == 1)
                @else
                <div class="red_point" id="red_point" style="    background-color: red;
            position: absolute;
            margin-right: 168px;
            margin-left: 200px;
    margin-top: -53px;
    border-radius: 25px;
    width: 20px;
    height: 20px;
    padding: 10px;">

                </div>


                @endif
                @endif









            </div>


            <div class="profile">
                <img src="{{asset(auth()->user()->avatar_image_path)}}" class="image" alt="">
                <h3 class="name">{{auth()->user()->name}}</h3>
                <p class="role">student</p>

                <form action="{{route('logout')}} " method="post">
                    @csrf
                    <button class="option-btn">logout</button>

                </form>


            </div>

            <div class="notificate">

                @foreach (auth()->user()->getNotificate() as $item_noti)

                <style>
                .media-body.active {
                    color: #8d8484;

                }

                .media-body {
                    color: black;
                }
                </style>
                @if($item_noti->is_check == 0)


                <a class="media" href="{{route('user.notificate', ['id_notificate'=> $item_noti->id])}}">

                    <img src="{{asset($user->get_user_send($item_noti->id_send)[0]->avatar_image_path)}}"
                        alt="User Avatar" class="img-size-50 img-circle mr-3">
                    <div class="media-body">
                        <h3 class="dropdown-item-title">
                            {{$user->get_user_send($item_noti->id_send)[0]->name}}
                            <span class="float-right text-sm text-warning"></i></span>
                        </h3>
                        <p class="text-sm">{{$item_noti->content_notificate}}</p>
                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>
                            {{$item_noti->created_at->diffForHumans()}}</p>
                    </div>
                </a>
                @else
                <a class="media" href="{{route('user.notificate', ['id_notificate'=> $item_noti->id])}}">

                    <img src="{{asset($user->get_user_send($item_noti->id_send)[0]->avatar_image_path)}}"
                        alt="User Avatar" class="img-size-50 img-circle mr-3">
                    <div class="media-body active">
                        <h3 class="dropdown-item-title">
                            {{$user->get_user_send($item_noti->id_send)[0]->name}}
                            <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                        </h3>
                        <p class="text-sm">{{$item_noti->content_notificate}}</p>
                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>
                            {{$item_noti->created_at->diffForHumans()}}</p>
                    </div>
                </a>

                @endif
                @endforeach

            </div>

        </section>

    </header>

    <div class="side-bar">

        <div id="close-btn">
            <i class="fas fa-times"></i>
        </div>

        <div class="profile">
            <img src="{{asset(auth()->user()->avatar_image_path)}}" class="image" alt="">
            <h3 class="name">{{auth()->user()->name}}</h3>
            <p class="role">student</p>
            <a href="{{route('user.profile')}}" class="inline-btn">view profile</a>
        </div>

        <nav class="navbar">
            <a class="menu_homepage0" value="1" href="{{route('homePage')}}"><i class="fas fa-home"></i><span>Home</span></a>
            <a class="menu_homepage0" value="2" href=""><i class="fas fa-question"></i><span>About</span></a>
            <a class="menu_homepage0" value="3" href="{{route('user.new_course')}}"><i class="fas fa-graduation-cap"></i><span>New courses</span></a>
            <a class="menu_homepage0" value="4" href="{{route('user.teacher')}}"><i class="fas fa-chalkboard-user"></i><span>Teachers</span></a>
            <a class="menu_homepage0" value="5" href="{{route('users.chat_private')}}"><i class="fas fa-message">
            
            <span class="tbao badge badge-danger"   style="    background-color: red;
    color: white;
    width: auto;
    height: auto ;
    border-radius: 10px;
    padding: 2px;
    margin-top: -11px;
    margin-left: -7px;
    position: absolute;
    font-size: 10px;">{{$user->sum_not_receive()}}</span>
            </i>
            <span>Chat</span></a>
        </nav>

    </div>
    <style>
    .menu_homepage0.active {
        background-color: #d8dbdd;
    }
    </style>
    <script>



     $('.menu_homepage0').removeClass('active'); 
     var value = '1';
        $('.menu_homepage0').filter(function() { 
           
            return $(this).attr('value') === value; 
        }).addClass('active');

        

    
    </script>

    @yield('content')

</body>
@yield('js')
<footer class="footer">



</footer>

<script src="{{asset('desgin/js/script.js')}}"></script>
<script src="{{asset('desgin/js/show_course.js')}}"></script>
<script>
try {
    $('.media-body').click(function() {

        $('.media-body').addClass('active');
    })

} catch (error) {
    console.error('An error occurred:', error.message)
}
</script>


</html>