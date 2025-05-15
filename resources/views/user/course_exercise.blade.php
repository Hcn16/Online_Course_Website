@extends('user.detail_Course')

@section('title')
<title>Exercise</title>
@endsection



@section('content')

<div class="parent">
    <div class="box-container" style="overflow-y: scroll;">
        <ul class="nav nav-underline">
            <li class="nav-item">
                <a class="  nav-link active" id="exercise" aria-current="page" >Bài tập</a>
            </li>

            <li class="nav-item">
                <a class=" nav-link " id="exercise_done" >Bài tập đã hoàn thành</a>
            </li>

        </ul>
    </div>


    <div class="exercise">
        @if ($exercise_not != [] )
        @foreach($exercise_not as $item1)
        <div class="cise ">
            <a href="{{route('user.do_exercise', ['id_exercise' => $item1->id , 'id_course' => $course->id])}}">
                <div class="content_">
                    <p>{{$item1->name_exercise}}</p>
                    <p>{{$item1->updated_at}}</p>

                </div>
            </a>
            <div class="status">
                Hoàn thành ngay nhé!!!

            </div>


        </div>
        @endforeach
        @else
        <div class = "no_exercise"style="    height: 300px;
    width: 300px;margin: 100px 100px 100px 400px;">
            <img src="{{asset('desgin/images/exercise_image.png')}}" alt="" style="max-width: 100%">
            
        Chưa có bài tập nào được thêm </div>
        @endif

    </div>

    @if ($e_d != [] )
    <div class="exercise_done">

        @foreach($e_d as $item)

        <div class="cise">
            <a href="{{route('user.do_exercise', ['id_exercise' => $item->id_exercise , 'id_course' => $course->id])}}">
                <div class="content_">
                    <p>{{$item->name_exercise}}</p>
                    <p>{{$item->updated_at}}</p>

                </div>
            </a>

            <div class="status">
                Đã nộp </br>

                <div class="list_course">
                    <select name="" id="show_answer_check" class="show_answer_check">
                        <option value="">Điểm</option>
                        @foreach ($item->list_score as $ls )
                        <option value="{{route('user.show_answer_checked'
                        , ['id_exercise' => $item->id_exercise , 'id_course' => $course->id, 
                        'id_score_exercise' => $ls->id])}}" 
                        
                        class="show_answer_check_item">
                            
                           Lần{{$ls->num_of_time}}:{{round($ls->score, 2)}}
                        
                           
                        
                        </option> </br>


                        @endforeach
                    </select>



                </div>

            </div>

        </div>
        @endforeach

    </div>

    @endif





</div>

<script>
$('#exercise').click(function() {
    $(this).addClass('active');
    $('.exercise').css('display', 'block');
    $('.exercise_done').css('display', 'none');
    $('#exercise_done').removeClass('active');
})


$('#exercise_done').click(function() {
    $(this).addClass('active');
    $('.exercise_done').css('display', 'block')
    $('.exercise').css('display', 'none')
    $('#exercise').removeClass('active');
})


$('.show_answer_check').change(function(){
   
    var url = $(this).val();
    
    if (url) { window.location.href = url; }
})


window.onload = function() {
    var param2 = localStorage.getItem('back_answer');
    if(param2 == 'true'){
        console.log(param2);
        $('#show_answer_check')[0].selectedIndex = 0;
        $('.show_answer_check').each(function() { this.selectedIndex = 0; });

    }
   

    // Xóa dữ liệu sau khi sử dụng nếu cần
    localStorage.removeItem('back_answer');
};

//add active menu_homepage
var param2 = localStorage.getItem('_menu_homepage');
var matchingElements = $('.menu_homepage').filter(function() { 
    $('.menu_homepage').removeClass('active');

    return $(this).attr('value') == param2; 

});

matchingElements.each(function() { 
    
    $(this).addClass('active');

});
localStorage.removeItem('_menu_homepage');
////////

</script>

<style>
.status {
    margin-left: 65%;
}
</style>

@endsection