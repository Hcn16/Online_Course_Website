@extends('layouts.admin')

@section('title')
<title>Add Sliders</title>
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

    @include('partials.content-header', ['name' => 'Sliders', 'key' => 'Add'])

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-6">

                    <form action="{{route('settings.update', ['id' => $setting->id])}}" method="post"
                        enctype="multipart/form-data" name="formName">
                        @csrf

                        @if($setting->type_settings === 'text')
                            <div class="form-group">
                                <label class="form-label">Config key </label>
                                <input type="text" class="form-control @error('config_key') is-invalid @enderror"
                                    name="config_key" placeholder="" value="{{$setting->config_key}}{{old('config_key')}}">

                            </div>
                            @error('config_key')

                                <div class="alert alert-danger">{{$message}}</div>
                            @enderror

                            <div class="form-group @error('description') is-invalid @enderror">
                                <label class="form-label">Config value </label>
                                <input type="text" class="form-control @error('config_value') is-invalid @enderror"
                                    name="config_value" placeholder=""
                                    value="{{$setting->config_value}} {{old('config_value')}}">

                            </div>
                            @error('config_value')

                                <div class="alert alert-danger">{{$message}}</div>
                            @enderror

                        @elseif($setting->type_settings === 'textarea')
                            <div class="form-group">
                                <label class="form-label">Config key </label>
                                <input type="text" class="form-control @error('config_key') is-invalid @enderror"
                                    name="config_key" placeholder="" value="{{$setting->config_key}}">

                            </div>
                            @error('config_key')

                                <div class="alert alert-danger">{{$message}}</div>
                            @enderror

                            <div class="form-group @error('description') is-invalid @enderror">
                                <label class="form-label">Config value </label>
                                <textarea type="text" id="textarea1"
                                    class="form-control  @error('config_value') is-invalid @enderror"
                                    name="config_value" placeholder="" value=" ">{{$setting->config_value}}</textarea>

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