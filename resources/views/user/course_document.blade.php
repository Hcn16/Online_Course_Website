@extends('user.detail_Course')

@section('title')
<title>Document</title>
@endsection

@section('content')

<div class="parent">
<div class="box-container">
        <ul class="nav nav-underline">
           

            <li class="nav-item active">
                <a class=" nav-link file_course active" id="file" href="#">Tài liệu </a>
            </li>

        </ul>
    </div>

</div>





<!-- <video src="" controls poster="" id="video"></video> -->

</div>

<div class="File" style="display: block;">
<!-- <iframe src="{{asset('storage/Course/14/Phân tích thiết kế Hệ thống.docx')}}" width="600" height="400"></iframe>

<embed src="path/to/your/file.docx" type="application/vnd.openxmlformats-officedocument.wordprocessingml.document" width="600" height="400">
<embed src="path/to/your/file.docx" type="application/vnd.openxmlformats-officedocument.wordprocessingml.document" width="600" height="400">



<embed src="{{asset('storage/Course/14/Phân tích thiết kế Hệ thống.docx')}}"  type="application/vnd.openxmlformats-officedocument.wordprocessingml.document" width="600" height="400"> -->

@foreach ($file as $item1 )

<div class="child_file" style="    margin-left: 30px;
   
    width: 40%;
    font-size: 20px; margin-bottom: 10px;
    padding-left: 20px;
    display: flex;
    border-bottom: 1px solid black;

    position: relative;
    ">

<div type="file"class="file-input" id="file-input"   style="width:auto;background-color: #e9ecef; max-width:80%;padding: 10px;
    border-radius: 10px; margin-bottom: 5px;"> {{$item1['file_name']}}</div>   
<input style="display: none;"href="" class="file_path_" value="{{$item1['file_path']}}"></input>
<i class="download  fa-solid fa-download" style="position: absolute;
    right: 10px;
}"></i>
</div>



@endforeach

</div>
<script>
$(document).ready(function() {
    $('.download').on('click', function() {
        const fileUrl = $(this).parent().find('.file_path_').val(); // Đường dẫn tới file cần tải xuống
        const fileName = $(this).parent().find('.file-input').html(); // Tên file khi tải xuống

       
        
        const link = document.createElement('a');
        link.href = fileUrl;
        link.download = fileName;
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    });
});


</script>


<script>
    $('.content_course').click(function() {
    $(this).addClass('active');
    $('.main_content').css('display', 'block');
    $('.File').css('display', 'none');
    $('.file_course').removeClass('active');
})


$('.file_course').click(function() {
    $(this).addClass('active');
    $('.File').css('display', 'block')
    $('.main_content').css('display', 'none')
    $('.content_course').removeClass('active');
})



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
////

</script>
@endsection