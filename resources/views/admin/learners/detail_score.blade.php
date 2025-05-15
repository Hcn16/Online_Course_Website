@extends('layouts.admin')

@section('title')
<title> Detail Score</title>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{asset('Addmin/Courses/index/list.js')}}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


@endsection

@section('content')


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->


    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{ $coursesList->name }} ( {{$coursesList->id}} )</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">



                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->




    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <a href="{{route('learners.detail',['id'=> $coursesList->id])}}" class="btn btn-success float-left m-2">Return Course</a>

                </div>



                <div class="col-md-12">
                    <table class="table" title="Lí thuyết ">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>

                                <th scope="col">tài khoản học viên</th>
                                <th scope="col">Số bài tập đã nộp</th>
                                @foreach ($exercise_of_course as $item )
                                <th scope="col">{{$item->name_exercise}}</th>

                                @endforeach


                            </tr>
                        </thead>
                        <tbody>

                            @foreach( $user_list as $item)



                            <tr>
                                <th scope="row">{{$item->id}}</th>
                                <td>{{$item->name}} </td>
                                <td>{{auth()->user()->get_submit_exercise($id_course, $item->id)}}/{{$size_exercise}}
                                </td>
                                @foreach ($exercise_of_course as $item2 )
                                <td scope="col">

                                    <div class="list_course">
                                        @if($exercise_->get_score_exercise($item2->id, $item->id) != [])

                                        <select name="" class ="my-select" id="my-select">
                                                <option value="" disabled selected>Điểm </option>

                                            @foreach ($exercise_->get_score_exercise($item2->id, $item->id) as $ls )
                                            <option value="{{route('user.show_answer_checked',
                                                     ['id_exercise'=>$item2->id, 'id_course'=> $coursesList->id, 'id_score_exercise'=>$ls->id ])}}">
                                                <a
                                                    href="{{route('user.show_answer_checked',
                                                     ['id_exercise'=>$item->id, 'id_course'=> $coursesList->id, 'id_score_exercise'=>$item2->id ])}}">
                                                     Lần{{$ls->num_of_time}}:{{round($ls->score, 2)}}</a>
                                            </option></br>


                                            @endforeach


                                        </select>
                                        @else

                                        @endif



                                    </div>
                                </td>

                                @endforeach




                            </tr>
                            @endforeach


                        </tbody>
                    </table>






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

<script>
    $('.my-select').change(function() { 
        const url  = $(this).val(); 
        
        if (url) { window.location.href = url; } 
    
    });
    // document.getElementsByClassName('my-select').addEventListener('change', function() 
    // { 
    //     console.log("zo ");
    //     const url = this.value; 
    //     if (url) { window.location.href = url; } 
    
    // });
</script>
<!-- /.content-wrapper -->

@endsection