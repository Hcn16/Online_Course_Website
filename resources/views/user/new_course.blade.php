@extends('user.index')

@section('title')
<title>New Course</title>
@endsection

@section('content')




<section class="courses">


    <div class="box-container">
        <h1 class="heading new_courses">New courses </h1>
        <div class=" float-right m-2">
            <label for="disabledSelect" class=" ">Chọn từ khóa </label><br>
            <select class=" selectParent @error('category_id') is-invalid @enderror  " name="category_id"
                title="ChonDanhMuc">
                @foreach($category as $item)
                <option value="">{{$item->name}}</option>
                @endforeach

            </select>

        </div>

    </div>



    <div class="box-container">


        @foreach ($user_course_new as $item )

        <div class="box">
            <div class="tutor">
                <img src="{{asset($_course->user_name_teacher($item->user_id)[0]->avatar_image_path) }}" alt="">
                <div class="info">
                    <h3>{{($_course->user_name_teacher($item->user_id)[0]->name)}}</h3>
                    <span>{{$item->created_at}}.</span>
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
            @if($item->cost == 0)
            <form method="post">
                @csrf
                <a data-url="{{route('user.register_course', ['id_course' => $item->id])}}"
                    class="inline-btn check register_course">Tham gia khóa học</a>
            </form>
            @else
            <form action="{{route('pay')}} "method="get">
                @csrf
                <input type="number" name="cost" value="{{$item->cost}}" id="" style="display: none;">
                <input type="text" name="id_course" value="{{$item->id}}" id="" style="display: none;">

                <button data-url="" 
                    class="inline-btn " type="submit">Tham gia khóa học</button>
            </form>
            @endif


        </div>

        @endforeach

        @foreach ($user_course_register as $item2 )

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

            <a class="inline-btn check ">Đã gửi yêu cầu</a>



        </div>

        @endforeach


    </div>

    <script>



$('.menu_homepage0').removeClass('active'); 
var value = '3';
   $('.menu_homepage0').filter(function() { 
      
       return $(this).attr('value') === value; 
   }).addClass('active');

   


</script>

</section>

@endsection