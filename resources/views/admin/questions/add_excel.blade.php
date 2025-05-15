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

@if(session('error'))
   <script>
    alert('{{session('error')}}');
   </script>

@endif
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    @include('partials.content-header', ['name' => 'Question', 'key' => 'Add'])

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-6">
                    <form class="myForm" action="{{route('questions.store_excel' )}}" method="post"
                        enctype="multipart/form-data" name="formName">
                        @csrf
                        <div class="form-group">
                            <label for="">Chọn file excel :</label></br>
                            <input type="file" name="file">
                          
                        </div>
                   
                    
                        

                        <input class="form-control " name="id_course" value="{{$id_course}}" style="display: none;">

                        </input></br>


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





@endsection

@endsection