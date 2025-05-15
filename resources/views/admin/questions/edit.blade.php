@extends('layouts.admin')

@section('title')
<title>Edit Question</title>
@endsection

@section('css')
<link href="{{asset('vendors/select2/select2.min.css')}}" rel="stylesheet">
</link>
<link href="{{asset('Addmin/Courses/add/add.css')}}">

</link>


<link href="{{asset('froala_editor/css/froala_editor.pkgd.min.css')}}" rel="stylesheet">
</link>
@endsection



@section('content')


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    @include('partials.content-header', ['name' => 'Question', 'key' => 'Edit'])

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-6">
                    <form action="{{route('questions.update', ['id' => $question->id])}}" method="post"
                        enctype="multipart/form-data" name="formName">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">Câu hỏi </label>
                            <input type="text" value="{{$question->content}} {{old('name')}}" class="form-control "
                                name="name" placeholder="Nhập câu hỏi  ">

                        </div>
                        <div class="form-group">
                            <label for="">Độ khó: {{$question->type_question}}</label>
                            <select  class="type_question js-select2 form-select" id="main-page-dokho" name="type_question"
                                style="width: 150px;" data-placeholder="Choose one..">


                                @if($question->type_question == 1)
                                <option  value="1" selected>1 đáp án </option>
                                <option value="2">nhiều đáp án</option>

                                
                                @elseif($question->type_question == 2)
                                <option value="1">1 đáp án </option>
                                <option  value="2" selected>nhiều đáp án</option>
  
                                @endif

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Độ khó: {{$question->level}}</label>
                            <select  class="js-select2 form-select" id="main-page-dokho" name="level"
                                style="width: 150px;" data-placeholder="Choose one..">


                                @if($question->level == 2)
                                    <option  value="1" >Cơ bản</option>
                                    <option  value="2" selected>Trung bình</option>
                                    <option  value="3" >Nâng cao</option>

                                
                                @elseif($question->level == 1)
                                    <option  value="1" selected>Cơ bản</option>
                                    <option  value="2" >Trung bình</option>
                                    <option  value="3">Nâng cao</option>

                               
                                @elseif($question->level == 3)
                                    <option  value="1">Cơ bản</option>
                                    <option  value="2">Trung bình</option>
                                    <option  value="3" selected>Nâng cao</option>

                                @endif

                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label" name="test" for="option-content">Thêm câu trả
                                lời</label></br>
                            <textarea name="" id="answer_input"></textarea>

                            <script>




                            </script>

                            <script>
                                var num = 0;

                                document.addEventListener('keydown', function (event) {

                                    if (event.key === 'Enter') {
                                        var textarea = document.getElementById('answer_input');

                                        // Lấy giá trị từ textarea
                                        var value = textarea.value;
                                        textarea.value = '';
                                        // Tạo một thẻ br
                                        var br = document.createElement('br');










                                        var answer = document.getElementById('answer');



                                        // Thêm thẻ br vào vị trí mong muốn trong tài liệu
                                        var answerItem = document.createElement('div');
                                        answerItem.id = 'answerItem';
                                        answerItem.className = 'answerItem';

                                        // Tạo một thẻ input checkbox
                                        var checkbox = document.createElement('input');
                                        checkbox.type = 'checkbox';
                                        checkbox.id = 'num';
                                        checkbox.class = 'answer';
                                        checkbox.name = 'is_answer1[]';
                                        checkbox.value = value;

                                        // Tạo một label cho checkbox
                                        var data1 = document.createElement('input');
                                        data1.htmlFor = 'myCheckbox';
                                        data1.name = 'answer1[]';
                                        data1.type = 'text';
                                        data1.value = value;
                                        data1.id = 'num';

                                        var btn = document.createElement('button');
                                        btn.id = 'delete_answer';
                                        btn.className = 'delete_answer';
                                        btn.type = 'button';
                                        btn.innerHTML = 'x';
                                        btn.onclick = function () {
                                            confirm('Bạn muốn xóa câu trả lời này') ? $(this).parents('.answerItem').remove() : '';
                                        }


                                        // Thêm checkbox và label vào tài liệu
                                        answer.appendChild(answerItem);



                                        answerItem.appendChild(checkbox);


                                        answerItem.appendChild(data1);
                                        answerItem.appendChild(btn);

                                        answerItem.appendChild(br);


                                    }
                                });
                            </script>



                            </br>
                            <label for=""> Chọn đáp án đúng</label>



                            <div id="answer">
                                @foreach ($answer as $item)

                                    <div id="answerItem" class="answerItem">
                                        @if($item->is_answer == 1)
                                            <input type="checkbox" checked id="num" class ="answer" name="is_answer1[]"
                                                value="{{$item->content_answer}}">
                                        
                                        @elseif($item->is_answer == 0)
                                            <input type="checkbox" id="num" class ="answer"name="is_answer1[]"
                                                value="{{$item->content_answer}}">

                                        @endif
                                        <input type="number" name="id_answer[]" value="{{$item->id}}" style="display: none;">

                                        <input type="text" id="num" name="answer1[]" value="{{$item->content_answer}}">
                                        <button id="delete_answer" class="delete_answer" type="button">x</button>

                                        </br>

                                    </div>


                                @endforeach








                            </div>

                            <script>

                                $('.delete_answer').on('click', function () {

                                    confirm('Bạn muốn xóa câu trả lời này') ? $(this).parents('.answerItem').remove() : '';

                                });


                            </script>




                        </div>

                        <div style="display: none;">
                            <input type="text" value="{{$id_course}}" name="id_course">

                        </div>





                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>



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

@section('js')
<script src="{{asset('vendors/select2/select2.min.js')}}"></script>
<script src="{{asset('Addmin/Courses/add/add.js')}}"></script>
<script src="{{asset('froala_editor/js/froala_editor.pkgd.min.js')}}"></script>

<script>
    new FroalaEditor('#textarea');
</script>


<script>
    $('.type_question').change(function() {
    var selectedValue = $('.type_question').val();
    if (selectedValue == 2) {
        $('.answer').attr('type', 'checkbox');


    }
    if (selectedValue == 1) {
        $('.answer').attr('type', 'radio');

    }

});
</script>


@endsection

@endsection