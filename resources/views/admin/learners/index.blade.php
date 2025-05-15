@extends('layouts.admin')

@section('title')
<title>Courses detail</title>
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







    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('partials.content-header', ['name' => 'Courses_Manage', 'key' => 'List'])



                </div>


                <div class="col-md-12">
                    <table class="table" title="Lí thuyết ">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Tên khóa học</th>

                                <th scope="col">Đang tham gia </th>
                                <th scope="col">Chờ chấp nhận </th>
                                <th scope="col">Đã hoàn thành </th>

                                <th scope="col">Action </th>





                            </tr>
                        </thead>
                        <tbody>


                        @for($i = 0; $i < sizeof($coursesList);$i++ )
                        
                            <tr>
                               
                                <th scope="row">{{$coursesList[$i]['id']}}</th>


                                <td>{{$coursesList[$i]['name']}}</td>

                              
                                <td>{{$course_manage_list[$i]['user_course_accepted']}}</td>
                                <td>{{$course_manage_list[$i]['user_course_not_accept']}}</td>
                                <td>{{$course_manage_list[$i]['done_exercise']}}</td>







                              

                                <td>
                                    <a href="{{route('courses.edit',['id'=> $coursesList[$i]['id']])}}"
                                        class="btn btn-default">Edit</a>
                                    <a data-url="{{route('courses.delete',['id'=> $coursesList[$i]['id']])}}"
                                        class="btn btn-danger actiondelete">Delete</a>

                                    <a href="{{route('learners.detail',['id'=> $coursesList[$i]['id']])}}"
                                        class="btn btn-info ">Detail</a>
                                </td>
                                
                                









                            </tr>
                            @endfor


                        </tbody>
                    </table>








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