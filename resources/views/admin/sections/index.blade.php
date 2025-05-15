@extends('layouts.admin')

@section('title')
<title>Section</title>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{asset('Addmin/Courses/index/list.js')}}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


@endsection
@yield('css')
@section('content')


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content-header', ['name' => 'Section', 'key' => 'List'])

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
                    <a href="{{route('sections.create',['id_course'=> $id_course])}}"
                        class="btn btn-success float-right m-2">Add</a>

                </div>

                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Tên Chương</th>
                                <th scope="col">Nội dung </th>
                                <th scope="col">File </th>
                                <th scope="col">Video </th>



                                <th scope="col">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sectionList as $section)

                            <tr>
                                <th scope="row">{{$section->id}}</th>
                                <td>{{$section->name_section}}</td>
                                <td>

                                    <div class="title">

                                        <div class="arrow1">
                                            <span id="arrow" class="arrow">&#9654;</span> <!-- Mũi tên -->
                                            <span>Mô tả khóa học</span>
                                        </div>
                                        <div id="content1" class="content1" style="width:700px; height: auto; overflow-y: scroll">
                                            <!-- Dữ liệu cần ẩn/hiện -->
                                            <p>{!! $section->content !!}</p>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                @foreach ($section->files as $file )
                                @if($file->type_file == 'file')
                                    <div>
                                    {{$file->file_name}}

                                    </div></br>
                                    @endif
                                   
                                   
                                    @endforeach

                                </td>
                                <td>
                                
                                @foreach ($section->files as $file )
                                @if($file->type_file == 'video')
                                    <div>
                                    {{$file->file_name}}

                                    </div></br>
                                    @endif
                                   
                                    @endforeach

                                    

                                </td>


                                <td>
                                    <a href="{{route('sections.edit',['id'=> $section->id])}}"
                                        class="btn btn-default">Edit</a>
                                    <a data-url="{{route('sections.delete',['id'=> $section->id])}}"
                                        class="btn btn-danger actiondelete">Delete</a>
                                </td>

                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                    {{$sectionList->links()}}


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
$('.arrow1').on('click', function toggleContent() {
    var arrow = $(this);

    var content = arrow.parents('.title').find('.content1');
    console.log(arrow.attr('class'));
    if (content.css('display') === 'none') {
        content.css('display', 'block');
        arrow.parents('.title').find('.arrow').addClass('down');
    } else {
        content.css('display', 'none');
        arrow.parents('.title').find('.arrow').removeClass('down');
    }
});
</script>
<style>
.arrow {
    cursor: pointer;
    display: inline-block;
    transition: transform 0.3s;
}

.arrow.down {
    transform: rotate(90deg);
}

.content1 {
    display: none;
    margin-top: 10px;
}
</style>
@endsection