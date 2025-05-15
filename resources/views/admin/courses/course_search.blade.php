@extends('layouts.admin')

@section('title')
<title>Courses</title>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{asset('Addmin/Courses/index/list.js')}}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


@endsection

@section('content')


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
     
        @include('partials.content-header', ['name' => 'Courses', 'key' => 'Search'])


    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
              

                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Tên khóa học</th>
                                <th scope="col">Giáo viên quản lí</th>
                                <th scope="col">Số học viên</th>
                                <th scope="col">Chi phí khóa học</th>

                                <th scope="col">Danh Mục</th>
                                <th scope="col">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($courses as $course)

                            
                            <tr>
                                
                                <th scope="row">{{$course->id}}</th>
                                <td>{{$course->name}}</td>
                                <td>
                                    @foreach ($course->name_teacher as $teacher)
                                   {{$teacher->name }} <br/>
                                    
                                    @endforeach
                                       
                                        
                                   

                                </td>
                                <td>{{$course_intance->num_learner_of_course($course->id)}}</td>
                               <td>{{$course->cost}}</td>
                              
                                <td>{{($course->name_cate)}}</td>

                                <td>

                                @if(auth()->user()->roles->contains('id', 1) )
                                <a href="{{route('courses.edit',['id'=> $course->id])}}" class="btn btn-default">Edit</a>
                                <a href="{{route('courses.detail',['id'=> $course->id])}}" class="btn btn-info ">Detail</a>

                                @elseif(auth()->user()->roles->contains('id', 4) && auth()->user()->manage_course->contains('id', $course->id) )
                                <a href="{{route('courses.detail',['id'=> $course->id])}}" class="btn btn-info ">Detail</a>

                                <a href="{{route('courses.edit',['id'=> $course->id])}}" class="btn btn-default">Edit</a>

                                    @endif

                                   

                                    @if(auth()->user()->roles->contains('id', 1) )
                                    <a data-url="{{route('courses.delete',['id'=> $course->id])}}" class="btn btn-danger actiondelete">Delete</a>
                                    @elseif(auth()->user()->roles->contains('id', 4) && auth()->user()->manage_course->contains('id', $course->id) )
                                    <a data-url="{{route('courses.delete',['id'=> $course->id])}}" class="btn btn-danger actiondelete">Delete</a>

                                    @endif
                                  


                                </td>

                            </tr>
                           
                            @endforeach

                        </tbody>
                    </table>
                    
                   

                        {{$courses->links()}}
                    
                   


                </div>
                <div>


                </div>








            </div>
            <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection