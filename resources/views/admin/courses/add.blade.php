@extends('layouts.admin')

@section('title')
<title>Add Courses</title>
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

    @include('partials.content-header', ['name' => 'Courses', 'key' => 'Add'])
  
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-6">
                    <form action="{{route('courses.store')}}" method="post" enctype="multipart/form-data"
                        name="formName">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">Tên khóa học </label>
                            <input type="text" value="{{old('name')}}"
                                class="form-control @error('name') is-invalid @enderror" name="name"
                                placeholder="Nhập tên khóa học">

                        </div>
                        @error('name')

                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror

                        <div class="form-group">
                            <label class="form-label">Mô tả khóa học </label>
                            <textarea name="content" value="{{old('content')}}" id="textarea"
                                class="form-control @error('content') is-invalid @enderror " title="content"></textarea>

                        </div>
                        @error('content')

                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror

                        <div class="form-group">
                            <label class="form-label">Ảnh đại diện </label>
                            <input type="file" accept="image/*"  value=""
                                class="form-control " name="course_path"
                                placeholder="Thêm ảnh">

                        </div>

                       


                        <div class="form-group">
                            <label for="disabledSelect" class="form-label ">Thêm giáo viên cùng quản lí(nếu có) </label><br>
                            <select multiple class="form-control selectParent2  "
                                name="id_teacher[]" title="ChonDanhMuc">
                                <option value="">Chọn giáo viên </option>

                                {!! $htmlteacher !!}                              
                                
                            </select>
                           
                        </div>

                        <div class="form-group">
                            <label for="disabledSelect" class="form-label ">Chọn danh mục </label><br>
                            <select class="form-control selectParent @error('category_id') is-invalid @enderror  "
                                name="category_id" title="ChonDanhMuc">
                                <option value="">Chọn danh mục cha</option>
                                {!! $htmlOption !!}
                            </select>
                            @error('category_id')

                            <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Chi phí khóa học(nếu có )</label>
                            <input type="number" value="0"
                                class="form-control " name="cost"
                                placeholder="Nhập chi phí  khóa học">

                        </div>


                        <div class="form-group">
                            <label for="disabledSelect" class="form-label">Nhập từ khóa cho khóa học</label><br>
                            <select name="tags[]" class="form-control tag_select_choose" multiple="multiple">


                            </select>

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





@endsection

@endsection