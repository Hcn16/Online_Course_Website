@extends('layouts.admin')

@section('title')
<title>Edit sections</title>
@endsection

@section('css')
<link href="{{asset('vendors/select2/select2.min.css')}}" rel="stylesheet"></link>
<link href="{{asset('Addmin/Courses/add/add.css')}}">

</link>


<link href="{{asset('froala_editor/css/froala_editor.pkgd.min.css')}}" rel="stylesheet"  > </link>
@endsection



@section('content')


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    @include('partials.content-header', ['name' => 'sections', 'key' => 'Edit'])
  
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-6">
                    <form action="{{route('sections.update', ['id'=>$section->id, 'id_course' =>$section->id_course])}}" method="post" enctype="multipart/form-data"
                        name="formName">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">Tên section </label>
                            <input type="text" 
                                class="form-control @error('name') is-invalid @enderror" name="name"
                                placeholder="Nhập tên sections"
                                value="{{$section->name_section}}{{old('name')}}">

                        </div>
                        @error('name')

                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror

                        <div class="form-group ">
                            <label class="form-label">Nội dung </label>
                            <textarea type="text" value="{{old('content')}}" id="textarea"
                                class="form-control " name="content"
                                placeholder="Mô tả" style="    width: 1000px;height: 200px;">{{$section->content}}</textarea>

                        </div>

                        @error('description')

                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror

                        <div class="form-group">
                            <label class="form-label">Thêm, xóa video( nếu có )</label>

                            <input type="file" accept="video/*" multiple class=""
                                name="video_path[]" id="video_path" placeholder="" value="">
                            <br>
                          

                        </div>
                        <div class="form-group">
                        @foreach ($section->files as $file )
                                @if($file->type_file == 'video')
                                    <div    style="    width: auto;background-color: gainsboro; padding-left: 15px;display: flex;justify-content: space-between;">
                                    {{$file->file_name}}
                                    <input class="form-control " name="video_added[]" value="{{$file->id}}" style="display:none"
                                 title="file_video" accept="video/*"> 
                                 </input></br>

                                   <div class="delete_file" style="border: none; background-color: antiquewhite;
    width: 3%;
    padding-left: 5px;">x</div>

                                    
                                   
                                   
                                    </div>

                                    @endif
                                   
                                   
                                    @endforeach

                        </div>
                      

                        <div class="form-group">
                            <label class="form-label">Thêm, xóa File( nếu có )</label>
                            <input type="file" multiple class="form-control " accept=".doc,.pdf,.ppt"
                                name="file_path[]" id="file_path" placeholder="" value="">
                            <br>
                          
                        </div>

                        <div class="form-group">
                        @foreach ($section->files as $file )
                                @if($file->type_file == 'file')
                                    <div    style="    width: auto;background-color: gainsboro; padding-left: 15px;display: flex;justify-content: space-between;">
                                    {{$file->file_name}}
                                   <input class="form-control"  name="file_added[]" value="{{$file->id}}" style="display:none " >
                                 </input></br>

                                   <div type="menu"class="delete_file" style="border: none;background-color: antiquewhite;
    width: 3%;
    padding-left: 5px;">x</div>

                                    </div></br>
                                   

                                   
                                    @endif
                                   
                                   
                                    @endforeach

                        </div>

                      


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

<script>
    $('.delete_file').click(function (){
        if (confirm("Bạn có chắc chắn muốn xóa thẻ này không?")) { 
            $(this).parent().remove();
        }
       
    });
</script>




@endsection

@endsection