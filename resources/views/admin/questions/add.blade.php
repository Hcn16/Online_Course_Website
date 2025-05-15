@extends('layouts.admin')

@section('title')
<title>Add Question</title>
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

<style>
.lable_x {
    margin-left: 10px;
    background-color: #a39090;
    /* padding: 5px; */
    width: 18px;
    height: 18px;
    padding-left: 5px;
    border-radius: 5px;
    padding-bottom: 24px;
}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    @include('partials.content-header', ['name' => 'Question', 'key' => 'Add'])

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-6">
                    <form class="myForm" action="{{route('questions.store' )}}" method="post"
                        enctype="multipart/form-data" name="formName">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">Câu hỏi </label>
                            <input required="true" type="text" value="{{old('name')}}" class="form-control " name="name"
                                placeholder="Nhập câu hỏi  ">

                        </div>
                        <div class="form-group">
                            <label for="">Loại câu hỏi:</label>
                            <select class="type_question js-select2 form-select" id="main-page-dokho"
                                name="type_question" style="width: 150px;" data-placeholder="Choose one..">


                                <option value="1">1 đáp án </option>
                                <option value="2">nhiều đáp án</option>

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="" class="te">Độ khó:</label>
                            <select class="js-select2 form-select" id="main-page-dokho" name="level"
                                style="width: 150px;" data-placeholder="Choose one..">

                                <option value="1">Cơ bản</option>
                                <option value="2">Trung bình</option>
                                <option value="3">Nâng cao</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label" name="test" for="option-content">Hãy nhập nội dung trả
                                lời</label></br>
                            <textarea name="" id="answer_input"></textarea>
                            <script>
                            var num = 0;
                            var num_x = 0;

                            document.addEventListener('keydown', function(event) {

                                if (event.key === 'Enter') {
                                    var textarea = document.getElementById('answer_input');

                                    // Lấy giá trị từ textarea
                                    var value = textarea.value;
                                    textarea.value = '';

                                    // Tạo một thẻ br
                                    var br = document.createElement('br');


                                    var answer2 = document.getElementById('answer2');
                                    var checkbox2 = document.createElement('input');
                                    checkbox2.type = 'text';
                                    checkbox2.id = 'num2';

                                    checkbox2.name = 'answer[]';
                                    checkbox2.value = value;

                                    // Thêm thẻ br vào vị trí mong muốn trong tài liệu
                                    var answer = document.getElementById('answer');

                                    var answer_parent =document.createElement('div');
                                    answer_parent.className = 'answer_parent';
                                    // Tạo một thẻ input checkbox
                                    var checkbox = document.createElement('input');
                                    checkbox.type = 'radio';
                                    checkbox.id = 'num';
                                    checkbox.classList.add('answer');
                                    checkbox.class = 'num';
                                    checkbox.class = 'answer';
                                    checkbox.name = 'is_answer[]';
                                    checkbox.value = value;


                                    // Tạo một label cho checkbox
                                    var label = document.createElement('label');
                                    label.htmlFor = 'myCheckbox';
                                    label.name = 'answer1[]';
                                    label.className = 'myAnswer'

                                    var label_x = document.createElement('label');
                                    label_x.className = 'lable_x';
                                    label_x.htmlFor = '';
                                    label_x.textContent = 'x';
                                    label_x.id = num_x;
                                    label_x.onclick = function() {
                                        if (confirm('Bạn có chắc chắn muốn xóa câu hỏi không?')) {
                                            var value = $(this).parent().find('.myAnswer').text();

                                            $(this).parent().remove();

                                            // console.log(value);
                                            // $('.answer_').filter(function() {

                                            //     return $(this).val() === value;
                                            // }).remove();
                                        }
                                    };
                                    num_x++;




                                    // // Thêm icon vào sau label label.appendChild(icon);

                                    label.appendChild(document.createTextNode(value));

                                    // Thêm checkbox và label vào tài liệu
                                    answer.appendChild(answer_parent);
                                    



                                    answer_parent.appendChild(checkbox);

                                    answer_parent.appendChild(label);
                                    answer_parent.appendChild(label_x);















                                    answer_parent.appendChild(br);
                                    answer2.appendChild(checkbox2);

                                }
                            });
                            </script>


                            </br>
                            <label for=""> Chọn đáp án đúng <i class="fa-solid fa-delete-left"></i>
                            </label>


                            <div id="answer">




                            </div>

                            <div id="answer2" style="display: none;">



                            </div>



                        </div>

                        <input class="form-control " name="id_course" value="{{$id_course}}" style="display: none;">

                        </input>


                        <button type="submit" class="btn btn-primary submit">Submit</button>
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
$('.submit').click(function() {
    console.log($('#num').is(':checked'));
    if ($('.answer').is(':checked')) {


    } else {
        event.preventDefault();
        alert('Bạn chưa chọn đáp án đúng');

    }


});



$('.type_question').change(function() {
    var selectedValue = $('.type_question').val();
    if (selectedValue == 2) {
        $('.answer').attr('type', 'checkbox');


    }
    if (selectedValue == 1) {
        $('.answer').attr('type', 'radio');

    }

});


function remove_answer() {
    if (confirm('Bạn có chắc chắn muốn xóa câu hỏi không?')) {
        var value = $(this).parent().find('.myAnswer').text();

        $(this).parent().find('.myAnswer').remove();

        console.log(value);
        $('.answer_').filter(function() {

            return $(this).val() === value;
        }).remove();






    }


};
</script>



@endsection

@endsection