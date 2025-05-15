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
    }

    .quiz-header {
        text-align: center;
        margin-bottom: 20px;
    }

    .quiz-question {
        margin-bottom: 15px;
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
    </style>

    <div class="quiz-container">
        <div class="quiz-header">
            <h1 name="exercise" >{{$exercise->name_exercise}}</h1>
        </div>
        <?php $stt = 0;?>
        <form  method="post">
            @csrf
            @foreach ($question_list as $item)


            <div class="quiz-question{{$stt}}">
                <h2 class="title_ques">Câu hỏi {{$stt= $stt + 1;}}: {{$item->content}}</h2>
                <ul class="quiz-options {{$stt}}">
                    @if($item->type == 1)

                    @foreach($item->answer as $answer)
                    <li class="answer_checked"><input type="radio" class="question" onclick="cache_click()"
                            name="question{{$stt}}" value="{{$answer->id}}{{old('question '.$stt.'')}}">
                        {{$answer->content_answer}}</li>
                    @endforeach

                    @else
                    @foreach($item->answer as $answer)
                    <li class="answer_checked"><input type="checkbox" class="question" onclick="cache_click()"
                            name="question{{$stt}}" value="{{$answer->id}}"> {{$answer->content_answer}}</li>
                    @endforeach

                    @endif

                </ul>
            </div>

            @endforeach
            

           
            
        </form>
        <a data-url="{{route('user.submit_exercise',['id_exercise' => $exercise->id, 'id_course' => $course->id])}}"
        class="btn btn-info  check " >Nộp bài</a>

        

    </div>

    <script>
      
      $('.check').click(function() {              
        var test = <?php  echo $stt-1 ?>;
        var check = 0;
       
        
        for(var i =0; i< test; i++){
            var title = '.' + 'quiz-question' + i;
           
            if($(title).find('input:checked').length == 0){
                alert('bạn chưa hoàn thành hết các câu hỏi')
                var check = 1;
                return false;
            }
            

            
        }   
        
        
        if(check == 0){
            $('.check'). addClass('submit_exercise')
        }

    }); 
            
            
            
    </script>


    <script>
    function cache_click() {
        $(document).ready(function() {
            var checkedInputs = $('input:checked');
            var array = [];

            checkedInputs.each(function() {
              //  console.log($(this).val());
                array.push($(this).val());
            });

            localStorage.setItem('myData{{$exercise->id}}', JSON.stringify(array));

           // console.log('');



        });

    }

    $(document).ready(function() {
        var check = $('input:checked');
        var id_exercise= {{$exercise->id}};
       
        localStorage.removeItem('myData13');

        if (check.val() == null) {

            var data = JSON.parse(localStorage.getItem('myData{{$exercise->id}}'));

            if (data) {
                // console.log('Dữ liệu từ localStorage: ' + data);
                // console.log((data.length));
                var check_answer = $('input:not(:checked)');

                for (var i = 0; i < data.length; i++) {


                    check_answer.each(function() {

                        if ($(this).val() == data[i]) {
                            $(this).prop('checked', true);
                            return false;
                        }
                        

                    })


                };

            } else {
                // alert('Không có dữ liệu trong localStorage');
            }

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

/////
</script>






@endsection