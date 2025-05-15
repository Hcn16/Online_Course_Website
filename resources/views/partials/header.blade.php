  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3" action="{{route('courses.search_course_manage_page')}}" method="GET">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" name="search_value" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

   
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="tbao badge badge-danger navbar-badge">{{$user->sum_not_receive()}}</span>
        </a>
       
        <div class="tbao_body dropdown-menu dropdown-menu-lg dropdown-menu-right">
        @foreach ($user->top3_message() as $sub )
        <a href="{{route('courses.detail_chat_for_user', ['id'=>$sub])}}"  class="dropdown-item">
            <!-- Message Start -->
             
            <div class="media">
              <img src="{{asset(($user->get_user_send($sub))[0]-> avatar_image_path)}}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="sub_media media-body" style="color: #6c757d;">
                <h3 class="dropdown-item-title">
                {{auth()->user()->get_user_send($sub)[0]->name}}
                  <span class="float-right text-sm text-danger"></i></span>
                </h3>
                @if($user->is_check($sub) != [])
                        <p class="text-sm active" >
                         {{$user->getContent_created_at($sub)[0]->content}}
                         
                        </p>
                        <script>
                            const activeChildren2 = $('.text-sm.active'); 
                            activeChildren2.each(function() { 
                                const parent2 = $(this).parents('.sub_media');
                                parent2.css({'color':'black !important'});
                            });
                        </script>
                        @else
                        <p class="text-sm" >
                         {{$user->getContent_created_at($sub)[0]->content}}
                         
                        </p>
                        @endif
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>{{$user->getContent_created_at($sub)[0]->created_at->diffForHumans()}}</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>

        @endforeach
          
        

          
         
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">{{$user->sum_request()}}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-header">{{$user->sum_request()}}  Notifications</span>
          <div class="dropdown-divider"></div>
          
          <a href="{{route('learners.index')}}" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> {{$user->sum_request()}}  await accept
            <!-- <span class="float-right text-muted text-sm">12 hours</span> -->
          </a>
          <div class="dropdown-divider"></div>
         
       
        </div>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"><i
            class="fas fa-th-large"></i></a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
