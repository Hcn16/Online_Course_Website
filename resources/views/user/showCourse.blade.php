@extends('user.index')

@section('title')
<title>Course</title>
@endsection

@section('content')

<section class="courses">

    <h1 class="heading">My courses</h1>
    <meta name="csrf-token" content="{{ csrf_token() }}">
   


    <div class="box-container">
        @foreach ($user_course as $item )


        <div class="box">
            <div class="tutor">
                <img src="{{asset($_course->user_name_teacher($item->user_id)[0]->avatar_image_path) }}" alt="">
                <div class="info">
                    <h3>{{($_course->user_name_teacher($item->user_id)[0]->name)}}</h3>
                    <span>{{$item->created_at}}</span>
                </div>
            </div>
            <div class="thumb">
                <img src="{{asset($item->course_image_path)}}" alt="">
                
            </div>
            <h3 class="title">{{$item->name}}

                <div class="arrow1">
                    <span id="arrow" class="arrow">&#9654;</span> <!-- Mũi tên -->
                    <span>Mô tả khóa học</span>
                </div>
                <div id="content" class="content">
                    <!-- Dữ liệu cần ẩn/hiện -->
                    <p>{!!$item->content!!}</p>
                </div>
            </h3>

            <a class="inline-btn" href="{{route('user.detail_course', ['id' => $item->id])}}">Start</a>


        </div>

        @endforeach
    </div>


    <div class="more-btn">
    </div>

</section>








</head>





@endsection