@extends('layouts.admin')

@section('title')
<title>Questions</title>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{asset('Addmin/Courses/index/list.js')}}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


@endsection
@yield('css')
@section('content')

@if(session('success'))
   <script>
    alert('{{session('success')}}');
   </script>

@endif
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content-header', ['name' => 'Question', 'key' => 'List'])


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
                    

                    <a href="{{route('questions.create', ['id_course' => $id_course])}}"
                        class="btn btn-success float-right m-2">Add</a>

                        <a href="{{route('questions.create_excel', ['id_course' => $id_course])}}"
                        class="btn btn-success float-right m-2"> Import from Excel</a>
                        <a href="{{route('questions.export', ['id_course' => $id_course])}}"
                        class="btn btn-success float-right m-2"> Export to Excel</a>

                        <a href="" id="downloadExcel"
                        class="btn btn-success float-right m-2"> Download fomat file Excel</a>


                </div>

                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Câu hỏi </th>
                                <th scope="col">Mức độ </th>
                                <th scope="col"> Loại câu hỏi </th>

                                <th scope="col">Câu trả lời </th>
                                <th scope="col">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($questionList as $questions)

                            <tr>
                                <th scope="row">{{$questions->id}} </th>
                                <td>{{$questions->content}}</td>
                                <td>{{$questions->level}}</td>
                                <td>{{$questions->type_question}}</td>

                                <td>
                                    <div class="parent_answer">
                                        <button class="show" id="show" >Hide</button>

                                        <div id="list_answer" class="list_answer">
                                            @foreach ($answer as $item)
                                            @if($item->id_question == $questions->id)
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

                                    </div>







                                </td>

                                <td>
                                    <a href="{{route('questions.edit', ['id' => $questions->id , 'id_course' => $id_course])}}"
                                        class="btn btn-default">Edit</a>
                                    <a data-url="{{route('questions.delete', ['id' => $questions->id])}}"
                                        class="btn btn-danger actiondelete">Delete</a>
                                </td>

                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                    {{$questionList->links()}}


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


document.getElementById('downloadExcel').addEventListener('click', function() { 
var link = document.createElement('a'); 
link.href = 'http://127.0.0.1:8000/storage/courses/test_importExcel.xlsx'; 
link.download = 'file_question.xlsx'; 
// // Tên tệp khi tải xuống 
document.body.appendChild(link); 
link.click(); document.body.removeChild(link); });
</script>

@endsection