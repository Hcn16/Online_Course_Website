@extends('layouts.admin')

@section('title')
<title>Edit Exercise</title>
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

    @include('partials.content-header', ['name' => 'Exercise', 'key' => 'Edit'])

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-6">
                    <form action="{{route('exercises.update',['id' => $exercise->id] )}}" method="post"
                        enctype="multipart/form-data" name="formName">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">Tên bài tập </label>
                            <input type="text" value="{{$exercise->name_exercise}}{{old('name_exercise')}}"
                                class="form-control " name="name_exercise" placeholder="Tên bài tập  ">

                        </div>

                        <div class="form-group">
                            <label class="form-label">Thời gian làm bài tập (phút) </label>
                            <input type="number" value="{{$exercise->time_do}}{{old('time_do')}}"
                                class="form-control time_do " name="time_do"
                                placeholder="Thời gian làm (không bắt buộc)   ">


                        </div>

                        <div class="form-group col-md-12">
                            <div class="col-md-5">
                                <label class="form-label">Số câu hỏi </label>
                                <input readonly type="number" value="" class="form-control sum_question" name="sum_question"
                                    placeholder="số câu hỏi">
                                </br>

                            </div>

                            <div class=" row">
                                <div class="col-md-4">
                                    <label class="form-label">Số câu dễ </label>
                                    <input readonly type="number" value="{{$exercise->num_level_easy}}" class="form-control sum_easy" name="sum_easy"
                                        placeholder="  ">

                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Số câu vừa</label>
                                    <input readonly  type="number" value="{{$exercise->num_level_medium}}{{old('name')}}" class="form-control sum_medium"
                                        name="sum_medium" placeholder="  ">

                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Số câu khó </label>
                                    <input readonly type="number" value="{{$exercise->num_level_hard}}{{old('name')}}" class="form-control sum_hard"
                                        name="sum_hard" placeholder="  ">

                                </div>


                            </div>

                            <div>
                                <div class="easy">
                                    <label for=""> Chọn câu hỏi loại dễ </label>
                                    </br>

                                    @foreach($questionList as $question)
                                    @if($question->level == 1)
                                    @if($id_question_ex->contains('id_question',$question->id))
                                    <input type="checkbox" value="{{$question->id}}" checked class="easy_question" id="easy"
                                    name="question[]" placeholder="check_cau_hoi ">


                                   
                                    @else

                                    <input type="checkbox" value="{{$question->id}}" class="easy_question" id="easy"
                                    name="question[]" placeholder="check_cau_hoi ">
                                    @endif


                                   
                                    <label class="form-label">{{$question->content}}</label>
                                    </br>
                                    @endif

                                    @endforeach


                                </div>
                                </br> </br>
                                <div class="medium">
                                    <label for=""> Chọn câu hỏi loại vừa </label>
                                    </br>



                                    @foreach($questionList as $question)

                                    @if($question->level == 2)
                                    @if($id_question_ex->contains('id_question',$question->id))
                                    <input type="checkbox" value="{{$question->id}}" checked id="medium_question"
                                        class="medium_question" name="question[]" placeholder="  ">


                                   
                                    @else

                                    <input type="checkbox" value="{{$question->id}}" id="medium_question"
                                        class="medium_question" name="question[]" placeholder="  ">
                                    @endif

                                   
                                    <label class="form-label">{{$question->content}}</label>
                                    </br>
                                    @endif

                                    @endforeach


                                </div>

                                </br> </br>

                                <div class="hard">
                                    <label for=""> Chọn câu hỏi loại khó </label>
                                    </br>

                                    @foreach($questionList as $question)

                                    @if($question->level == 3)
                                    @if($id_question_ex->contains('id_question',$question->id))
                                   
                                    <input type="checkbox" value="{{$question->id}}" checked id="hard_question"
                                        class="hard_question" name="question[]" placeholder="  ">


                                   
                                    @else

                                    <input type="checkbox" value="{{$question->id}}" id="hard_question"
                                        class="hard_question" name="question[]" placeholder="  ">
                                    @endif

                                    <label class="form-label">{{$question->content}}</label>
                                    </br>

                                    @endif
                                    @endforeach


                                </div>
                            </div>



                        </div>
                        <input class="form-control " name="id_course" value="{{$id_course}}" style="display: none;">

                        </input>


                        <button type="submit" class="btn btn-primary">Submit</button>


                </div>


                </form>







                <!-- /.col-md-6 -->
            </div>



        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
</div>


<!-- /.content-wrapper -->



<script>
document.addEventListener('keydown', function(event) {

    if (event.key === 'Enter') {
        // Đặt thời gian đếm ngược (ví dụ: 5 phút) 
        var countDownDate = new Date().getTime() + $('.time_do').attr('value') * 60 * 1000;
        // Cập nhật thời gian đếm ngược mỗi giây 
        var x = setInterval(function() {
            var now = new Date().getTime();
            var distance = countDownDate - now;
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            document.getElementById("countdown").innerHTML = minutes + ": " + seconds + " ";
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("countdown").innerHTML = "EXPIRED";
            }
        }, 1000);

    }
});
</script>


<script>

var input_easy = $('.easy_question').length;
var sum_easy = Number($('.sum_easy').attr('value')),
    sum_medium =Number($('.sum_medium').attr('value')),
    sum_hard = Number($('.sum_hard').attr('value'));
    $('.sum_question').attr('value', sum_hard + sum_easy + sum_medium);






$(document).ready(function() {
    $('.easy_question[type="checkbox"]').click(function() {
        if ($(this).is(":checked")) {
            sum_easy++;
            $('.sum_easy').attr('value', sum_easy);




        } else {
            sum_easy--;
            $('.sum_easy').attr('value', sum_easy);
        }
        $('.sum_question').attr('value', sum_hard + sum_easy + sum_medium);
    });

    $('.medium_question[type="checkbox"]').click(function() {
        if ($(this).is(":checked")) {
            sum_medium++;
            $('.sum_medium').attr('value', sum_medium);
            console.log('click' + sum_easy);


        } else {
            sum_medium--;
            $('.sum_medium').attr('value', sum_medium);
        }
        $('.sum_question').attr('value', sum_hard + sum_easy + sum_medium);
    });

    $('.hard_question[type="checkbox"]').click(function() {
        if ($(this).is(":checked")) {
            sum_hard++;
            $('.sum_hard').attr('value', sum_hard);
            console.log('click' + sum_hard);


        } else {
            sum_hard--;
            $('.sum_hard').attr('value', sum_hard);
        }
        $('.sum_question').attr('value', sum_hard + sum_easy + sum_medium);
    });




});
</script>
@section('js')
<script src="{{asset('vendors/select2/select2.min.js')}}"></script>
<script src="{{asset('Addmin/Courses/add/add.js')}}"></script>
<script src="{{asset('froala_editor/js/froala_editor.pkgd.min.js')}}"></script>

<script>
new FroalaEditor('#textarea');
</script>







@endsection

@endsection