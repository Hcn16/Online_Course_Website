@extends('user.index')

@section('title')
<title>Users</title>
@endsection

@section('content')

<section class="user-profile">

   <h1 class="heading">My profile</h1>

   <div class="info">

      <div class="user">
      <img src="{{asset(path: auth()->user()->avatar_image_path)}}" class="image" alt="">
      <h3 class="name">{{auth()->user()->name}}</h3>
         <p>student</p>
         <a href="{{route('update_Profile')}}" class="inline-btn">update profile</a>
      </div>
   
      <div class="box-container">
   
         <div class="box">
            <div class="flex">
               <i class="fas fa-hourglass-start"></i>
               <div>
                  <span>{{auth()->user()->learner_total_course_wait()}}</span>
                  <p>Khoá học chờ phản hồi</p>
               </div>
            </div>
            
         </div>
   
         <div class="box">
            <div class="flex">
               <i class="fas fa-diagram-successor "></i>
               <div>
                  <span>{{auth()->user()->learner_total_course_registed()}}</span>
                  <p>Khóa học đang tham gia</p>
               </div>
            </div>
         </div>
   
        
   
      </div>
   </div>

</section>

@endsection