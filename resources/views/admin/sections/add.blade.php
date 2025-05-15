@extends('layouts.admin')

@section('title')
<title>Add Sections</title>
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
<script>$(document).ready(function() { $('.back').click(function() { history.back(); }); });
</script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="col-md-12">

        <a  class="btn btn-success float-left m-2 back">Return
            Section</a>

    </div>
    </br>
    </br>



    @include('partials.content-header', ['name' => 'Sections', 'key' => 'Add'])

    <!-- Main content -->
    <div class="content">


        <div class="container-fluid">
            <div class="row">


                <div class="col-md-6">
                    <form action="{{route('sections.store')}}" method="post" enctype="multipart/form-data"
                        name="formName">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">Tên chương </label>
                            <input type="text" value="{{old('name')}}" class="form-control " name="name"
                                placeholder="Nhập tên ">

                        </div>


                        <div class="form-group ">
                            <label class="form-label">Nội dung </label>
                            <textarea type="text" value="{{old('content')}}" id="textarea" class="form-control "
                                name="content" placeholder="Mô tả" style="    width: 1000px;height: 200px;"></textarea>

                        </div>

                        <div class="form-group">
                            <label class="form-label">Thêm video( nếu có )</label>
                            <input type="file" accept="video/*" multiple class="form-control "
                                name="video_path[]" id="video_path" placeholder="" value="">
                            <br>

                        </div>
                      

                        <div class="form-group">
                            <label class="form-label">Thêm File( nếu có )</label>
                            <input type="file" multiple class="form-control " accept=".doc,.pdf,.ppt"
                                name="file_path[]" id="file_path" placeholder="" value="">
                            <br>

                        </div>
                     


                        <input class="form-control " name="id_course" value="{{$id_course}}" style="display: none;">

                        </input>






                        <button type="submit" class="btn btn-primary">Submit</button>
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