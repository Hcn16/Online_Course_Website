@extends('layouts.admin')

@section('title')
<title>Exercise</title>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{asset('Addmin/Courses/index/list.js')}}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


@endsection
@yield('css')
@section('content')


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content-header', ['name' => 'Exercise', 'key' => 'List'])


    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <a href="{{route('courses.detail', ['id' => $id_course])}}"
                        class="btn btn-success float-left m-2">Return Course</a>

                </div>

                <div class="col-md-12">

                    <a href="{{route('exercises.create', ['id_course' => $id_course])}}"
                        class="btn btn-success float-right m-2">Add</a>
                    <a href="{{route('exercises.create_auto', ['id_course' => $id_course])}}"
                        class="btn btn-success float-right m-2">Add_auto</a>

                </div>

                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Tên bài tập </th>
                                <th scope="col">Thời gian làm </th>

                                <th scope="col">Số câu </th>
                                <th scope="col">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($exerciseList as $exercises)

                            <tr>
                                <th scope="row">{{$exercises->id}} </th>
                                <td>{{$exercises->name_exercise}}</td>
                                <td>{{$exercises->time_do}}</td>

                                <td>
                                {{$exercises->num_level_easy +
                                $exercises->num_level_medium + $exercises->num_level_hard  }}

                                     <!-- <div class="parent_answer">
                                         <button class="show" id="show" >Hide</button> 

                                        <div id="list_answer" class="list_answer">
                                            @foreach ($answer as $item)
                                            @if($item->id_question == $exercises->id)
                                            @if($item->is_answer == 1)


                                            <span style="color:red;">

                                                {{$item->content_answer}}


                                            </span></br>
                                            @elseif($item->is_answer == 0)
                                            <span>

                                                {{$item->content_answer}}


                                            </span></br>

                                            @endif
                                            @endif

                                            @endforeach

                                        </div> 

                                    </div> -->







                                </td>

                                <td>
                                    <a href="{{route('exercises.edit', ['id' => $exercises->id , 'id_course' => $id_course])}}"
                                        class="btn btn-default">Edit</a>
                                    <a data-url="{{route('exercises.delete', ['id' => $exercises->id])}}"
                                        class="btn btn-danger actiondelete">Delete</a>
                                </td>

                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                    {{$exerciseList->links()}}


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
<script>
$('.show').on('click', function() {
    var show = $(this);

    var answer_show = $(this).parents('.parent_answer').find('.list_answer');
    if (answer_show.css('display') === 'none') {

        show.html('Hide') ;

        answer_show.css('display', 'block'); // Hiển thị thẻ div
    } else {
        show.html('show')  ;


        answer_show.css('display', 'none'); // Ẩn thẻ div
    }


});
</script>

@endsection