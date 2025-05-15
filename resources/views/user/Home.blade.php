@extends('test')

@section('title')
<title>Home</title>
@endsection



@section('content')


<section class="slider_">
        <div class="slider">
            <div class="slides">
                @foreach($sliderList as $item)
                <div class="slide"><img src="{{$item->image_path}}" alt="Slide 1"></div>
                @endforeach
            </div>
            <button class="prev" onclick="showSlide(-1)">&#10094;</button>
            <button class="next" onclick="showSlide(1)">&#10095;</button>
        </div>

    </section>



    <section class="courses">

        <h1 class="heading">All courses</h1>
        <meta name="csrf-token" content="{{ csrf_token() }}">



        <div class="box-container" style="max-height: 800px; overflow-y: scroll;">
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
            @endif 
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

                <form method="post">
                    @csrf
                    <a href="{{route('login')}}" style="text-decoration: none;"
                        class="inline-btn check register_course">Tham gia khóa học</a>
                </form>


            </div>

            @endforeach
        </div>


        <div class="more-btn">
            
        </div>
    </section>
    <script src="{{asset('desgin/js/slide_move.js')}}"></script>



@endsection