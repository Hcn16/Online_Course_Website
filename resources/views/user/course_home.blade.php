@extends('user.detail_Course')

@section('title')
<title>Home</title>
@endsection

@section('content')




<style>
.chat-container {
    margin: 20px 0px 50px 50px;

}

.content_course {
    width: auto;
    height: auto;

}


.section_name {
    background-color: #eeeeee;
    border: none;
    color: black;
    text-align: left;
}

.section_content {
    margin-left: 25px;
    font-size: 20px;
}

.section_exercise {
    margin-left: 25px;
    margin-top: 20px;
    font-size: 20px;


}



.section_content_item {
    margin-left: 25px;
    font-size: 16px;
    border-bottom: 1px solid aliceblue;


}

.section_exercise_item {
    margin-left: 25px;
    font-size: 16px;

}

.descrip_section {
    margin-left: 25px;
    width: 90%;
    height: auto;

}

.file_section {
    margin-left: 25px;

}

.descrip_section_item {
    margin-left: 25px;
    width: 50%;

}

.file_section_item {
    margin-left: 10px;
    width: 40%;
    font-size: 16px;
    margin-bottom: 10px;
    padding-left: 20px;
    display: flex;
    border-bottom: 1px solid #e9ecef;

    position: relative;

}

.title {
    font-size: 20px;
}

.file-input {
    margin-left: 7px;
    width: auto;
    background-color: #e9ecef;
    max-width: 90%;
    padding: 10px;
    border-radius: 10px;
    margin-bottom: 5px;
}

.download {
    position: absolute;
    right: 10px;
}

.icon_file{
    padding-top: 11px;

}
</style>
@vite('resources/js/app.js')

<div class="chat-container">
    <div class="title">
        <div class="">{{$course->name}}</div>

    </div>

    <div class="content_course dropdown">

        <span> </span>
        <div class="section_content"><span class="arrow2 down">&#9654;</span> Nội dung khóa học


            @foreach ($section as $item )

            <div class="section_content_item child">
                <div class="section_name"><span class="arrow down"> &#62;</span> {{$item->name_section}}
                    <div class="descrip_section"><span class="arrow3 down">&raquo;</span> Nội dung chương
                        <div class="descrip_section_item child">
                            {!!$item->content!!}
                        </div>
                    </div>

                    <div class="file_section"><span class="arrow3  down">&raquo;</span> Tài liệu
                        @foreach ($item->files as $file )
                        <div class="file_section_item child">
                            <div style="display:flex;">

                            


                            <div style="display: block;">
                                <div style="display: flex;">
                                    @if($file->type_file == 'file')
                                    <i class="icon_file fa-solid fa-file"></i>
                                    @elseif($file->type_file == 'video')
                                    <i class="icon_file fa-solid fa-file-video"></i>
                                    @else
                                    <i class="icon_file fa-solid fa-file"></i>



                                    @endif

                                <div type="file" class="file-input" id="file-input" style=""> {{$file->file_name}}</div>


                                </div>

                                <input style="display: none;" href="" class="file_path_"  value="{{$file->file_path}}"></input>


                            </div>

                            
                                <i class="download  fa-solid fa-download"></i>
                                </div>

                            



                        </div>


                        @endforeach
                    </div>

                </div>




            </div>

            @endforeach

        </div>

        <div class="section_exercise"><span class="arrow2 down">&#9654;</span> Bài tập khóa học
            @foreach ($exercise as $item_exercise)
            
                <div class="section_exercise_item child">
                <a class="section_exercise_item child" href="{{route('user.do_exercise', ['id_exercise' => $item_exercise->id , 'id_course' => $course->id])}}">

                    {{$item_exercise->name_exercise}}</a>
                    

                </div>
            

          


            @endforeach

        </div>

    </div>

</div>
<div class="id_user" value="{{auth()->id()}}" style="display:none;"></div>


<script>
///tải file 
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

////


//add active menu_homepage
var Elements = $('.menu_homepage').filter(function() {
    $('.menu_homepage').removeClass('active');

    return $(this).attr('value') == 1;

});

Elements.each(function() {
    console.log($(this).attr('value'));
    $(this).addClass('active');

});

var param2 = localStorage.getItem('_menu_homepage');

console.log(param2);
if (param2 != null) {
    var matchingElements = $('.menu_homepage').filter(function() {
        $('.menu_homepage').removeClass('active');

        return $(this).attr('value') == param2;

    });

    matchingElements.each(function() {

        $(this).addClass('active');

    });

    localStorage.removeItem('_menu_homepage');
}

////////////


$('.arrow').click(function() {

    if ($(this).parent().find('.descrip_section').css('display') === 'block') {
        $(this).removeClass('down');

        $(this).parent().find('.descrip_section').css('display', 'none');
        $(this).parent().find('.file_section').css('display', 'none');


    } else {
        $(this).addClass('down');

        $(this).parent().find('.descrip_section').css('display', 'block');
        $(this).parent().find('.file_section').css('display', 'block');

    }

});

$('.arrow2').click(function() {

    if ($(this).parent().find('.child').css('display') === 'block') {
        $(this).removeClass('down');

        $(this).parent().find('.child').css('display', 'none');


    } else {
        $(this).addClass('down');

        $(this).parent().find('.child').css('display', 'block');

    }

});

$('.arrow3').click(function() {

    if ($(this).parent().find('.child').css('display') === 'block') {
        $(this).removeClass('down');

        $(this).parent().find('.child').css('display', 'none');

    } else {
        $(this).addClass('down');

        $(this).parent().find('.child').css('display', 'block');

    }

});
</script>

<style>
.arrow {
    cursor: pointer;
    display: inline-block;
    transition: transform 0.7s;
    font-size: 16px;



}

.arrow2 {
    cursor: pointer;
    display: inline-block;
    transition: transform 0.7s;



}

.arrow3 {
    cursor: pointer;
    display: inline-block;
    transition: transform 0.9s;
    font-size: 20px;

}

.arrow.down {
    transform: rotate(90deg);
}

.arrow2.down {
    transform: rotate(90deg);
}

.arrow3.down {
    transform: rotate(90deg);
}
</style>

@endsection