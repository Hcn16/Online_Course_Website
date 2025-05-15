@extends('user.detail_Course')

@section('title')
<title>Do Exercise</title>
@endsection

@section('content')

<title>Bài tập trắc nghiệm</title>
<style>
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.quiz-container {
    width: 100%;
    max-width: 600px;
    margin: 50px auto;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    max-height: 500px;
    font-size: 15px;
}

.quiz-header {
    text-align: center;
    margin-bottom: 20px;
    font-size: 15px;
}

.quiz-question {
    margin-bottom: 15px;
    font-size: 20px;
}
.name_ques{
    font-size: 20px;

}

.quiz-options {
    list-style-type: none;
    padding: 0;
}

.quiz-options li {
    margin-bottom: 10px;
}

.quiz-button {
    display: block;
    width: 100%;
    padding: 10px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    text-align: center;
}

.quiz-button:hover {
    background-color: #0056b3;
}

/* .style_correct_answer{
        color: green;text-decoration: underline;

    } */


    .style_error_answer{
        color:red;

    }
</style>



<div class="quiz-container" style="overflow-y: scroll;">
    <div class="quiz-header">
        <h1 name="exercise">{{$exercise->name_exercise}}</h1>
    </div>
    <?php $stt = 0;?>
    <form method="post">
        @csrf
        @foreach ($question_list as $item)


        <div class="quiz-question{{$stt}}">
            <h2 class=" name_ques title_ques{{$stt+1}}">Câu hỏi {{$stt= $stt + 1;}}: {{$item->content}}</h2>
            <ul class="quiz-options {{$stt}}">
                @if($item->type == 1)

                @foreach($item->answer as $answer)
                @if($answer->is_answer_checked == 1 && $answer->is_answer == 1)
                <li class="answer_checked style_correct_answer"><input checked type="radio" class="question"
                        onclick="cache_click()" name="question{{$stt}}"
                        value="{{$answer->id}}{{old('question '.$stt.'')}}" disabled>
                    {{$answer->content_answer}}</li>
                @elseif($answer->is_answer_checked == 1 && $answer->is_answer == 0)
                <li class="answer_checked style_error_answer"><input checked type="radio" class="question"
                        onclick="cache_click()" name="question{{$stt}}"
                        value="{{$answer->id}}{{old('question '.$stt.'')}}" disabled>
                    {{$answer->content_answer}}</li>
                @else
                @if($answer->is_answer == 1)

                <style>
                .title_ques{{$stt}}
                    {
                    color: red;
                }
                </style>

                <li class="answer_checked style_correct_answer"><input type="radio" class="question"
                        onclick="cache_click()" name="question{{$stt}}"
                        value="{{$answer->id}}{{old('question '.$stt.'')}}" disabled>
                    {{$answer->content_answer}}</li>
                @else
                <li class="answer_checked" style=""><input type="radio" class="question" onclick="cache_click()"
                        name="question{{$stt}}" value="{{$answer->id}}{{old('question '.$stt.'')}}" disabled>
                    {{$answer->content_answer}}</li>
                @endif
                @endif
                @endforeach

                @else
                @foreach($item->answer as $answer)
                @if($answer->is_answer_checked == 1 && $answer->is_answer == 1)

                <li class="answer_checked style_correct_answer"><input checked type="checkbox" class="question"
                         name="question{{$stt}}" value="{{$answer->id}}" disabled>
                    {{$answer->content_answer}}</li>
                @elseif($answer->is_answer_checked == 1 && $answer->is_answer == 0)
                <li class="answer_checked style_error_answer"><input checked type="checkbox" class="question"
                        name="question{{$stt}}" value="{{$answer->id}}" disabled>
                    {{$answer->content_answer}}</li>
                @else
                @if($answer->is_answer == 1)
                <style>
                .title_ques{{$stt}}

                    {
                    color: red;
                }
                </style>
                <li class="answer_checked style_correct_answer"><input type="checkbox" class="question"
                         name="question{{$stt}}" value="{{$answer->id}}" disabled>
                    {{$answer->content_answer}}</li>

                @else
                <li class="answer_checked" style=""><input type="checkbox" class="question" 
                        name="question{{$stt}}" value="{{$answer->id}}" disabled> {{$answer->content_answer}}</li>


                @endif
                @endif
                @endforeach

                @endif

            </ul>
        </div>

        @endforeach


    </form>
    <div style="display: flex">
    <a style="width: auto;" data-url="" class="btn btn-info  show_hide_correct_answer " id="show_hide">Hiển thị đáp án </a>
    <a  class="btn btn-success back" style="    width: 20%;
   
    margin-left: auto;"> Back</a>


    </div>





</div>

<script>
// Sử dụng event delegation để bắt sự kiện click cho các phần tử mới 
// $('#show_hide').on('click', '.hide_correct', function() { 
//             //  $('.style_correct_answer').css();
//    $('.hide_correct').html('Hiển thị đáp án ');
//    $('.hide_correct').addClass('show_hide_correct_answer');
//    $('.hide_correct').removeClass('hide_correct');
// });
$(document).ready(function() { $('.back').click(function() {
    localStorage.setItem('back_answer', 'true');
    history.back(); }); });




$('.show_hide_correct_answer').click(function() {



    if ($('.show_hide_correct_answer').html() == 'Ẩn đáp án') {
        $('.style_correct_answer').removeAttr('style');
        $('.show_hide_correct_answer').html('Hiển thị đáp án ');
    } else {
        $('.style_correct_answer').css('color', 'green', 'text-decoration', 'underline');
        $('.style_correct_answer').css('text-decoration', 'underline');
        $('.show_hide_correct_answer').html('Ẩn đáp án');

    }


});
</script>



<script>
        //add active menu_homepage
var param2 = localStorage.getItem('_menu_homepage');
var matchingElements = $('.menu_homepage').filter(function() { 
    $(this).removeClass('active');
    return $(this).attr('value') == 3; 

});

matchingElements.each(function() { 
    
    $(this).addClass('active');

});


localStorage.removeItem('_menu_homepage');

///
</script>






@endsection