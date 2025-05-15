@extends('user.index')

@section('title')
<title>New Course</title>
@endsection

@section('content')
<style>
.notificate {
    display: none;
}


.media-body.active {
    color: #8d8484;

}

.media-body {
    color: black;
}

.notificate_index {
    background-color: aliceblue;
    max-height: 300px;
    overflow-y: auto;
    margin-left: 10px;
    border-radius: 5px;
}

.notificate_content {
    background-color: white;
    margin-left: 20px;
    color: black;
}
</style>
<div style="display: flex; margin-top: 50px;">

    <div class="notificate_index">

        @foreach (auth()->user()->getNotificate() as $item_noti)


        @if($item_noti->is_check == 0)
        <a class="media" href="{{route('user.notificate', ['id_notificate'=> $item_noti->id])}}">

            <img src="{{asset($user->get_user_send($item_noti->id_send)[0]->avatar_image_path)}}" alt="User Avatar"
                class="img-size-50 img-circle mr-3">
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

            <img src="{{asset($user->get_user_send($item_noti->id_send)[0]->avatar_image_path)}}" alt="User Avatar"
                class="img-size-50 img-circle mr-3">
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

    <div class="notificate_content">


        <style>
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin-left: 250px;
        }   

        .container h1 {
            color: #4CAF50;
        }

        .container p {
            font-size: 18px;
            color: #333;
        }

        .container a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }

        .container a:hover {
            background-color: #45a049;
        }
        </style>

        <div class="container">
            <h1>Đăng Ký Thành Công!</h1>
            <p>{{$notificate[0]->content_notificate}}</p>
            <a href="{{route('homePage')}}">Di chuyển tới khóa học</a>
        </div>


    </div>

</div>




@endsection