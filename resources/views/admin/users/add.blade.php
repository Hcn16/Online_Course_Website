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
                    <form action="{{route('users.store')}}" method="post" enctype="multipart/form-data"
                        name="formName">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">Tên </label>
                            <input type="text" value="{{old('name')}}"
                                class="form-control @error('name') is-invalid @enderror" name="name"
                                placeholder="Nhập tên ">

                        </div>
                        @error('name')

                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror

                        <div class="form-group">
                            <label class="form-label">Email </label>
                            <input type="text" value="{{old('email')}}"
                                class="form-control @error('email') is-invalid @enderror" name="email"
                                placeholder="Nhập email">

                        </div>
                        @error('email')

                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror

                        <div class="form-group">
                            <label class="form-label">Password </label>
                            <input type="password" value="{{old('pass')}}"
                                class="form-control @error('email') is-invalid @enderror" name="pass"
                                placeholder="password">

                        </div>
                        @error('pass')

                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror

                       
                        <div class="form-group">
                            <label class="form-label">Ảnh đại diện </label>
                            <input type="file" accept="image/*"  value=""
                                class="form-control " name="avatar_path"
                                placeholder="Thêm ảnh">

                        </div>


                       


                        <div class="form-group">
                            <label for="disabledSelect" class="form-label ">Chọn vai trò </label><br>
                            <select multiple="multiple" class="form-control tag_select_choose  @error('role') is-invalid @enderror  "
                                name="role_id[]" >
                                <option value="">Chọn vai trò</option>
                                @foreach ($roles as $role )
                                    <option value="{{$role->id}}">{{$role->name}}  </option>
                                
                                @endforeach
                            </select>
                            @error('role_id')

                            <div class="alert alert-danger">{{$message}}</div>
                            @enderror
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