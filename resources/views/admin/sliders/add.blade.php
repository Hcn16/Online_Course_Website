@extends('layouts.admin')

@section('title')
<title>Add Sliders</title>
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

    @include('partials.content-header', ['name' => 'Sliders', 'key' => 'Add'])
  
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-6">
                    <form action="{{route('sliders.store')}}" method="post" enctype="multipart/form-data"
                        name="formName">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">Tên slider </label>
                            <input type="text" value="{{old('name')}}"
                                class="form-control @error('name') is-invalid @enderror" name="name"
                                placeholder="Nhập tên Sliders">

                        </div>
                        @error('name')

                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror

                        <div class="form-group @error('description') is-invalid @enderror">
                            <label class="form-label">Mô tả  </label>
                            <input type="text" value="{{old('description')}}"
                                class="form-control @error('description') is-invalid @enderror" name="description"
                                placeholder="Mô tả slide">

                        </div>
                        @error('description')

                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror

                        <div class="form-group">
                            <label class="form-label">Thêm hình ảnh</label>
                            <input type="file" multiple class="form-control @error('file_path') is-invalid @enderror" name="file_path" id="file_path"
                                placeholder="">

                        </div>
                        @error('file_path')

                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror


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