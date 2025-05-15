@extends('layouts.admin')

@section('title')
<title>Add Courses</title>
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


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    @include('partials.content-header', ['name' => 'Courses', 'key' => 'Add'])

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                
                    <form action="{{route('permissions.store')}}" method="post" enctype="multipart/form-data" name="formName">
                        @csrf
                        <div class="form-group">
                            <label for="disabledSelect" class="form-label ">Chọn Module </label><br>
                            <select 
                                class="form-control tag_select_choose  " name="module"
                                placeholder="Chon Module">Chọn Module
                                <option value="">Chọn Module</option>
                                @foreach (config('permissions.permission_parent') as $permission )
                                <option value="{{$permission}}">{{$permission}} </option>

                                @endforeach
                            </select>
                           
                        </div>


                        <div class="form-group">
                            <div class="row">
                            @foreach (config('permissions.permission_children') as $permission_children )
                                <div class="col-md-3">
                                    <label for="">
                                        <input type="checkbox" name="item_permission[]" class="input_item" value="{{$permission_children}}">
                                        {{$permission_children}}
                                    </label>
                                </div>
                            @endforeach
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
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