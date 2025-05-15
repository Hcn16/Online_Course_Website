@extends('user.index')

@section('title')
<title>Teacher</title>
@endsection

@section('content')



<section class="teachers">

   <h1 class="heading">expert teachers</h1>

   <form action="{{route('user.search')}}" method="get" class="search-tutor">
      <input type="text" name="search_teacher" placeholder="search tutors..." required maxlength="100">
      <button type="submit" class="fas fa-search" name="search_tutor"></button>
   </form>

   <div class="box-container">

   @foreach ($teacher as $item )
   
  
      <div class="box">
         <div class="tutor">
            <img src="{{$item->avatar_image_path}}" alt="">
            <div>
               <h3>{{$item->name}}</h3>
               <span>Giáo viên</span>
            </div>
         </div>
         <p>Tổng khóa học : <span>{{$item->total}}</span></p>
        
         <a href="{{route('user.teacher_profile',['id'=> $item->id])}}" class="inline-btn">view profile</a>
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
