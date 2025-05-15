<script>
$(document).ready(function() {})
</script>
<style>
li.checked {
    background-color: brown;
}
</style>
<!-- css('background-color', 'currentcolor'); -->
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{asset('AdminLTE/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{auth()->user()->roles->contains('id',4)?'Giáo viên':'Quản trị'}}</span>
    </a>

   
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset(auth()->user()->avatar_image_path)}}" class="img-circle elevation-2"
                    alt="User Image" >
            </div>
            <div class="info">
                <a href="#" class="d-block">{{auth()->user()->name }}</a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @can('category-list')
                <li class="nav-item" value="1">
                    <a href="{{route('categories.index')}}" class="nav-link option">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Danh Mục
                        </p>
                    </a>
                </li>
                @endcan
                @can('menu-list')
                <li class="nav-item" value="2">
                    <a href="{{route('menus.index')}}" class="nav-link option">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Menus
                            <!-- <span class="right badge badge-danger">New</span> -->
                        </p>
                    </a>
                </li>
                @endcan

                @can('course-list')
                <li class="nav-item" value="3">
                    <a href="{{route('courses.showCourse')}}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Courses
                            <!-- <span class="right badge badge-danger">New</span> -->
                        </p>
                    </a>
                </li>
                @endcan

                @if(auth()->user()->roles->contains('id', 4))
                <li class="nav-item" value="4">
                    <a href="{{route('courses.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Courses_Created_Detail
                            <!-- <span class="right badge badge-danger">New</span> -->
                        </p>
                    </a>
                </li>
                @endif

                <!-- @can('course_update') -->
                 @if(auth()->user()->roles->contains('id', 4))
                <li class="nav-item" value="5">
                    <a href="{{route('learners.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Manager_Learner_Course
                            <!-- <span class="right badge badge-danger">New</span> -->
                        </p>
                    </a>
                </li>
                @endif 
                <!-- @endcan -->
                @can('slider-list')
                <li class="nav-item" value="6">
                    <a href="{{route('sliders.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Sliders
                            <!-- <span class="right badge badge-danger">New</span> -->
                        </p>
                    </a>
                </li>
                @endcan
                @can('setting-list')
                <li class="nav-item" value="7">
                    <a href="{{route('settings.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Settings
                            <!-- <span class="right badge badge-danger">New</span> -->
                        </p>
                    </a>
                </li>
                @endcan

                @can('user-list')
                <li class="nav-item" value="8">
                    <a href="{{route('users.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Users
                            <!-- <span class="right badge badge-danger">New</span> -->
                        </p>
                    </a>
                </li>
                @endcan

                @can('role-list')
                <li class="nav-item" value="9">
                    <a href="{{route('roles.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Roles List
                            <!-- <span class="right badge badge-danger">New</span> -->
                        </p>
                    </a>
                </li>
                @endcan
                @can('permission-list')
                <li class="nav-item" value="10">
                    <a href="{{route('permissions.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Permissions
                            <!-- <span class="right badge badge-danger">New</span> -->
                        </p>
                    </a>
                </li>
                @endcan

                <li class="nav-item" value="11">
                    <a href="{{route('courses.chat_private')}}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Chat
                            <!-- <span class="right badge badge-danger">New</span> -->
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    
    
    <!-- /.sidebar -->
</aside>