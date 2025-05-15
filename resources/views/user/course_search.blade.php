@extends('user.index')

@section('title')
<title>Course</title>
@endsection
<style>
    .arrow {
    cursor: pointer;
    display: inline-block;
    transition: transform 0.3s;
}

.arrow.down {
    transform: rotate(90deg);
}

.content {
    display: none;
    margin-top: 10px;
}

</style>


@section('content')
<section class="courses">

<div class="box-container">


@foreach ($course as $item2 )

    <div class="box">
        <div class="tutor">
            <img src="{{asset($_course->user_name_teacher($item2->user_id)[0]->avatar_image_path) }}" alt="">
            <div class="info">
                <h3>{{($_course->user_name_teacher($item2->user_id)[0]->name)}}</h3>
                <span>{{$item2->created_at}}.</span>
            </div>
        </div>
        <div class="thumb">
            <img src="{{asset($item2->course_image_path)}}" alt="">
            @if($item2->cost == 0)
            <span>Miễn phí</span>

            @else
            <span>${{$item2->cost}}</span>

            @endif
        </div>
        <h3 class="title">{{$item2->name}}

            <div class="arrow1">
                <span id="arrow" class="arrow">&#9654;</span> <!-- Mũi tên -->
                <span>Mô tả khóa học</span>
            </div>
            <div id="content" class="content">
                <!-- Dữ liệu cần ẩn/hiện -->
                <p>{!!$item2->content!!}</p>
            </div>
        </h3>
        @if($item2->status == [])
            @if($item2->cost == 0)
            <form method="post">
                @csrf
                <a data-url="{{route('user.register_course', ['id_course' => $item2->id])}}"
                    class="inline-btn check register_course">Tham gia khóa học</a>
            </form>
            @else
            <form action="{{route('pay')}} "method="get">
                @csrf
                <input type="number" name="cost" value="{{$item2->cost}}" id="" style="display: none;">
                <input type="text" name="id_course" value="{{$item2->id}}" id="" style="display: none;">


                <button data-url="" 
                    class="inline-btn " type="submit">Tham gia khóa học</button>
            </form>
            @endif



        @else
            @if(($item2->status[0]->status) == 0)
            <a class="inline-btn check ">Đã gửi yêu cầu</a>
            @elseif(($item2->status[0]->status) == 1)       
            <a class="inline-btn" href="{{route('user.detail_course', ['id' => $item2->id])}}">Start</a>
            @endif

        @endif



    </div>
    @endforeach
</div>

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
///////
</script>
</section>



@endsection