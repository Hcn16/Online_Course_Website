@extends('test')

@section('title')
<title>Course</title>
@endsection



@section('content')
<section class="courses">

<h1 class="heading">All courses</h1>
<meta name="csrf-token" content="{{ csrf_token() }}">



<div class="box-container">
    @foreach ($course as $item )


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
            @if($item->cost == 0)
            <span>Miễn phí</span>

            @else
            <span>${{$item->cost}}</span>
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

        @if($item->cost == 0)
            <form method="post">
                @csrf
                <a data-url="{{route('user.register_course', ['id_course' => $item->id])}}"
                    class="inline-btn check register_course">Tham gia khóa học</a>
            </form>
            @else
            <form action="{{route('pay')}} "method="get">
                @csrf
                <button data-url="" 
                    class="inline-btn " type="submit">Tham gia khóa học</button>
            </form>
            @endif

    </div>

    @endforeach
</div>

<script>
    $('.menu_homepage').removeClass('active'); 
        $('.menu_homepage').filter(function() { 
            return $(this).val() === 1; 
        }).addClass('active');
</script>
<div class="more-btn">
   
</div>
</section>


@endsection