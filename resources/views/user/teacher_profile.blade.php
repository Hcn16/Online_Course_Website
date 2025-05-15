@extends('user.index')

@section('title')
<title>Course</title>
@endsection

@section('content')


<section class="teacher-profile">

   <h1 class="heading">profile details</h1>

   <div class="details">
      <div class="tutor">
         <img src="{{asset($teacher->avatar_image_path)}}" alt="">
         <h3>{{$teacher->name}}</h3>
         <span>Giáo viên</span>
      </div>
      <div class="flex">
         <p>total playlists : <span>{{$teacher->total}}</span></p>
        
      </div>
   </div>

</section>

<section class="courses">

   <h1 class="heading">Courses created</h1>

   <div class="box-container">
    @foreach ($course as $item )
    
    

      <div class="box">
         <div class="thumb">
            <img src="{{asset($item->course_image_path)}}" alt="">
            @if($item->cost == 0)
            <span>Miễn phí</span>

            @else
            <span>{{$item->cost}}</span>
            @endif
         </div>
         <h3 class="title">{{$item->id}}_{{$item->name}}</h3>
         @if(in_array(($item->id), $id_user_course) == true)
         <a href="playlist.html" class="inline-btn" style="background-color: #bebac0;">Đã tham gia </a>
         @elseif((in_array(($item->id), $id_user_course) == false))
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

         @endif
      </div>
      @endforeach

   </div>
   <script>



$('.menu_homepage0').removeClass('active'); 
var value = '4';
   $('.menu_homepage0').filter(function() { 
      
       return $(this).attr('value') === value; 
   }).addClass('active');

   


</script>
</section>

@endsection
