@extends('layouts.admin')

@section('title')
<title>Add settings</title>
@endsection

@section('css')
<link href="{{asset('vendors/select2/select2.min.css')}}" rel="stylesheet">
</link>
<link href="{{asset('Addmin/Courses/add/add.css')}}">
<link href="{{asset('froala_editor/css/froala_editor.pkgd.min.css')}}" rel="stylesheet"  > </link>

</link>


<link href="{{asset('froala_editor/css/froala_editor.pkgd.min.css')}}" rel="stylesheet">
</link>
@endsection



@section('content')


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    @include('partials.content-header', ['name' => 'settings', 'key' => 'Add'])

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-6">

                    <form action="{{route('settings.store') .'?type=' .  request()->type  }}" method="post" enctype="multipart/form-data"
                        name="formName">
                        @csrf

                        @if(request()->type === 'text')
                            <div class="form-group">
                                <label class="form-label">Config key </label>
                                <input type="text" value="{{old('config_key')}}"
                                    class="form-control @error('config_key') is-invalid @enderror" name="config_key"
                                    placeholder="">

                            </div>
                            @error('config_key')

                                <div class="alert alert-danger">{{$message}}</div>
                            @enderror

                            <div class="form-group @error('description') is-invalid @enderror">
                                <label class="form-label">Config value </label>
                                <input type="text" value="{{old('config_value')}}"
                                    class="form-control @error('config_value') is-invalid @enderror" name="config_value"
                                    placeholder="">

                            </div>
                            @error('config_value')

                                <div class="alert alert-danger">{{$message}}</div>
                            @enderror

                        @elseif(request()->type === 'textarea')
                            <div class="form-group">
                                <label class="form-label">Config key </label>
                                <input type="text" value="{{old('config_key')}}"
                                    class="form-control @error('config_key') is-invalid @enderror" name="config_key"
                                    placeholder="">
                                    <p name="type"value="text"></p>

                            </div>
                            @error('config_key')

                                <div class="alert alert-danger">{{$message}}</div>
                            @enderror

                            <div class="form-group @error('description') is-invalid @enderror">
                                <label class="form-label">Config value </label>
                                <textarea type="text" value="{{old('config_value')}} " id="textarea1"
                                    class="form-control  @error('config_value') is-invalid @enderror" name="config_value"
                                    placeholder=""></textarea>

                                <p name="type" value="textarea"></p>

                            </div>
                            @error('config_value')

                                <div class="alert alert-danger">{{$message}}</div>
                            @enderror



                        @endif



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
new FroalaEditor('#textarea1');
</script>






@endsection

@endsection