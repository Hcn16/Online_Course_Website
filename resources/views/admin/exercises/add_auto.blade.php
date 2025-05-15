@extends('layouts.admin')

@section('title')
<title>Add Exercise</title>
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

    @include('partials.content-header', ['name' => 'Exercise', 'key' => 'Add'])

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-6">
                    <form action="{{route('exercises.store_auto' )}}" method="post" enctype="multipart/form-data"
                        name="formName">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">Tên bài tập </label>
                            <input type="text"required="true"  value="{{old('name_exercise')}}" class="form-control "
                                name="name_exercise" placeholder="Tên bài tập  ">

                        </div>

                        <div class="form-group">
                            <label class="form-label">Thời gian làm bài tập (phút) </label>
                            <input type="number" value="{{old('time_do')}}" class="form-control time_do " name="time_do" 
                                placeholder="Thời gian làm (không bắt buộc)   ">
                          

                        </div>

                        <div class="form-group col-md-12">
                            <div class="col-md-5">
                                <label class="form-label">Số câu hỏi </label>
                                <input readonly type="number" value="0" class="form-control sum_question" name="sum_question"
                                    placeholder="số câu hỏi">
                                </br>

                            </div>

                            <div class=" row">
                                <div class="col-md-4">
                                    <label class="form-label">Số câu dễ (max = {{$num_easy }})</label>
                                    <input type="number" required="true"  value="0" class="form-control sum_easy" name="sum_easy"
                                        placeholder="  ">

                                </div>

                                <div class="col-md-4">
                                    <label class="form-label"> Số câu vừa (max = {{$num_medium }}) </label>
                                    <input type="number" required="true"  value="0" class="form-control sum_medium"
                                        name="sum_medium" placeholder="  ">

                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Số câu khó (max = {{$num_hard}})</label>
                                    <input type="number" required="true" value="0" class="form-control sum_hard"
                                        name="sum_hard" placeholder="  ">

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
var easy =parseInt($('.sum_easy').val()),
medium = parseInt($('.sum_medium').val()),
    hard = parseInt($('.sum_hard').val());


$(document).ready(function() {

    $('.sum_easy').on('change', function() 
    
    { 
    

         easy = parseInt($('.sum_easy').val());
         medium =  parseInt($('.sum_medium').val() );
         hard  =  parseInt($('.sum_hard').val() );
        if(easy > {{$num_easy}}){
            alert('số lượng câu hỏi mức dễ  k đủ ');
            $('.sum_easy').val(easy-1);
            easy =  $('.sum_easy').val();
        }
        if($('.sum_easy').val()>= 0){

           var sum =parseInt(easy) + parseInt(medium) + parseInt(hard); 

            $('.sum_question').attr('value',parseInt(sum ));


        }

        
        
  
       
        
    });
    
    $('.sum_medium').on('change', function() 
    
    { 
    

        var easy = parseInt($('.sum_easy').val());
        var medium =  parseInt($('.sum_medium').val() );
        var hard  =  parseInt($('.sum_hard').val() );
        
        
        if(medium  > {{$num_medium}}){
            alert('số lượng câu hỏi mức trung bình  k đủ ');
            $('.sum_medium').val(medium-1);
            medium =  $('.sum_medium').val();

        }

        if($('.sum_medium').val()>= 0){

var sum =parseInt(easy) + parseInt(medium) + parseInt(hard); 

 $('.sum_question').attr('value',parseInt(sum ));


}

      

      
       
        
    });
    

    $('.sum_hard').on('change', function() 
    
    { 
    

        var easy = parseInt($('.sum_easy').val());
        var medium =  parseInt($('.sum_medium').val() );
        var hard  =  parseInt($('.sum_hard').val() );
      
      

        console.log({{$num_hard}})
        if(hard  > {{$num_hard}}){
            alert('số lượng câu hỏi mức khó  k đủ ');
            $('.sum_hard').val(hard -1);
            hard =  $('.sum_hard').val();

        }

        if($('.sum_hard').val()>= 0){

var sum =parseInt(easy) + parseInt(medium) + parseInt(hard); 

 $('.sum_question').attr('value',parseInt(sum ));


}        
       
        
    });


         

    $('.sum_question').attr('value',parseInt(parseInt($('.sum_easy').val()) + medium + hard));


    
    
    // $('.sum_easy').click(function(){
    //     {
    //         sum_easy++;
    //         $('.sum_easy').attr('value', sum_easy);
    //         console.log(sum_easy);




    //     } else {
    //         sum_easy--;
    //         $('.sum_easy').attr('value', sum_easy);
    //     }
    //     $('.sum_question').attr('value', sum_hard + sum_easy + sum_medium);

    // })

    // $('.medium_question[type="checkbox"]').click(function() {
    //     if ($(this).is(":checked")) {
    //         sum_medium++;
    //         $('.sum_medium').attr('value', sum_medium);
    //         console.log('click' + sum_easy);


    //     } else {
    //         sum_medium--;
    //         $('.sum_medium').attr('value', sum_medium);
    //     }
    //     $('.sum_question').attr('value', sum_hard + sum_easy + sum_medium);
    // });

    // $('.hard_question[type="checkbox"]').click(function() {
    //     if ($(this).is(":checked")) {
    //         sum_hard++;
    //         $('.sum_hard').attr('value', sum_hard);
    //         console.log('click' + sum_hard);


    //     } else {
    //         sum_hard--;
    //         $('.sum_hard').attr('value', sum_hard);
    //     }
    //     $('.sum_question').attr('value', sum_hard + sum_easy + sum_medium);
    // });




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