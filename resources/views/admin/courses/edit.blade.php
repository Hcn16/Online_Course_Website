@extends('layouts.admin')

@section('title')
<title>Add Courses</title>
@endsection

@section('css')
<link href="{{asset('vendors/select2/select2.min.css')}}" rel="stylesheet" />
<link href="{{asset('Addmin/Courses/add/add.css')}}">
</link>
<link href="{{asset('froala_editor/css/froala_editor.pkgd.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    @include('partials.content-header', ['name' => 'Courses', 'key' => 'Add'])
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
                <div class="col-md-6">
                    <form action="{{route('courses.update', ['id' => $courses->id])}}" method="post"
                        enctype="multipart/form-data" name="formName">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">Tên khóa học </label>
                            <input type="text" class="form-control" name="name" value="{{$courses->name}}"
                                placeholder="Nhập tên khóa học">

                        </div>

                        <div class="form-group">
                            <label class="form-label">Mô tả khóa học </label>
                            <textarea name="content" id="textarea" class="form-control  "
                                title="content">{{$courses->content}}</textarea>

                        </div>

                        

                        <div class="form-group">
                            <label class="form-label">Ảnh đại diện </label>
                            <input type="file" accept="image/*" value="" class="form-control " name="course_path"
                                placeholder="Thêm ảnh">

                        </div>

                        <div class="form-group">
                            <label for="disabledSelect" class="form-label ">Các giáo viên cùng quản lí(nếu có)
                            </label><br>
                            <select multiple class="form-control selectParent2  " name="id_teacher[]"
                                title="ChonDanhMuc">
                                {!! $htmlSelect !!}

                              

                            </select>
                        </div>

                     

                        <div class="form-group">
                            <label for="disabledSelect" class="form-label">Chọn danh mục </label><br>
                            <select class="form-control selectParent" name="category_id" title="ChonDanhMuc">
                                <option value="0" id="category">Chọn danh mục cha</option>
                                {!! $htmlOption !!}
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Chi phí khóa học</label>
                            <input type="number" value="{{$courses->cost}}"
                                class="form-control "name="cost"
                                placeholder="Nhập chi phí  khóa học">

                        </div>

                        <div class="form-group">
                            <label for="disabledSelect" class="form-label">Nhập từ khóa cho khóa học</label><br>
                            <select name="tags[]" class="form-control tag_select_choose" multiple="multiple" id="tag"
                                style="color:black">
                                @foreach ($courses->course_tag as $tag )

                                <option style="color: black" value="{{$tag->name}}" selected>{{$tag->name}}</option>
                                @endforeach

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
new FroalaEditor('#textarea')
</script>







@endsection

@endsection