<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
    <!-- custom css file link  -->
    <link rel="stylesheet" href="{{asset('desgin/css/style.css')}}">
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <link rel="stylesheet" href="{{asset('user/detail_course.css')}}">
    <link rel="stylesheet" href="{{asset('desgin/css/general.css')}}">

    <script src="{{asset('user/user.js')}}"></script>
    <script src="{{asset('desgin/js/show_course.js')}}"></script>



</head>

<body>

    <header class="header">

        <section class="flex">

            <a href="{{asset('')}}" class="logo">Education.</a>

            <form action="{{route('courses.search')}}" method="get" class="search-form">
                <input type="text" name="search_value" required placeholder="search courses..." maxlength="100">

                <button type="submit" class="fas fa-search"></button>
            </form>

            <div class="icons">
                <div id="menu-btn" class="fas fa-bars"></div>
                <div id="search-btn" class="fas fa-search"></div>
                <div id="user-btn" class="fas fa-user"></div>
                <div id="toggle-btn" class="fas fa-sun"></div>
                <div id="message-btn" class="fas fa-message"></div>
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


                <a class="media" href="">

                    <img src="{{asset($user->get_user_send($item_noti->id_send)[0]->avatar_image_path)}}"
                        alt="User Avatar" class="img-size-50 img-circle mr-3">
                    <div class="media-body">
                        <h3 class="dropdown-item-title">
                            {{$user->get_user_send($item_noti->id_send)[0]->name}}
                            <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                        </h3>
                        <p class="text-sm">{{$item_noti->content_notificate}}</p>
                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                    </div>
                </a>
                @endforeach




            </div>

        </section>

    </header>

    <div class="side-bar">

        <div id="close-btn">
            <i class="fas fa-times"></i>
        </div>

        <div class="profile">
            <img src="{{asset($course->course_image_path)}}" class="image" alt="">
            <h3 class="name">{{$course->name}}</h3>
           
            <!-- <a href="{{route('user.profile')}}" class="inline-btn">{{$course->name}}</a> -->


        </div>

        <nav class="navbar">
            <a class="menu_homepage active" value="1" href="{{route('user.detail_course',['id' => $course->id])}}"><i
                    class="fas fa-home"></i><span>Home</span></a>
            <a class="menu_homepage" value="2" href="{{route('user.course_document',['id' => $course->id])}}"><i
                    class="fas fa-file"></i><span>Document</span></a>
            <a class="menu_homepage" value="3" href="{{route('user.course_exercise',['id' => $course->id])}}"><i
                    class="fas fa-question"></i><span>Exercise</span></a>
            <a class="menu_homepage" value="4" href="{{route('user.chat_course',['id' => $course->id])}}"><i
                    class="fas fa-graduation-cap"></i><span>Chat Course</span></a>
            <a class="menu_homepage" value="5" href="{{route('homePage')}}"><i
                    class="fas fa-home"></i><span>Back</span></a>

        </nav>

    </div>

    <style>
    .menu_homepage.active {
        background-color: #d8dbdd;
    }
    </style>
    <script>
    $('.menu_homepage').click(function() {



        var link = $(this);
        var value = $(this).attr('value');

        localStorage.setItem('_menu_homepage', value);
        if (link.attr('value') == 5) {
            link.removeClass('active');
            localStorage.removeItem('_menu_homepage');

            
        }

    });
    </script>

    @yield('content')



    <!-- custom js file link  -->



</body>
<script src="{{asset('desgin/js/script.js')}}"></script>
<!-- jQuery -->
<script src="{{asset('AdminLTE/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('AdminLTE/dist/js/adminlte.min.js')}}"></script>
<script src="{{asset('desgin/js/show_course.js')}}"></script>


</html>