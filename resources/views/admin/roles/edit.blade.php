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


@section('js')

<script>

$('.all_permission').on('click', function() {
   
    
    $('.card').find('.input_item').prop('checked', $(this).prop('checked'));
    $('.card').find('.input_role').prop('checked', $(this).prop('checked'));
});

var num_item;
var test = 0;
$('.btn').on('click', function() {
    if ($('.input_role').parents('.card').find('.input_item').is(':checked') == false) {
        $('.input_item').parents('.card').find('.input_role').attr('disabled', !this.checked);
    }

});

$('.input_role').on('click', function() {
    num_item = ($(this).parents('.card').find('.input_item').length);
    $(this).parents('.card').find('.input_item').prop('checked', $(this).prop('checked'));
});


$('.input_item').on('click', function() {



    console.log(($(this).parents('.card').find('.input_item').length));
    console.log('class ' + ($('.input_item').parents('.card').find('.input_role').val()));
    if (($(this).parents('.card').find('.input_item').is(':checked')) == true) {
        test = test + 1;
        console.log('test' + test);

    }




    if (test == num_item) {
        $(this).parents('.card').find('.input_role').attr('disabled', !this.checked);

    }

});
</script>
@endsection


@section('content')


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    @include('partials.content-header', ['name' => 'Sliders', 'key' => 'Add'])

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <form action="{{route('roles.update', ['id' => $role->id])}}" method="post"
                    enctype="multipart/form-data" name="formName" class="submit">

                    <div class="col-md-6">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">Tên vai trò </label>
                            <input type="text" value=" {{$role->name}}{{old('name')}}"
                                class="form-control @error('name') is-invalid @enderror" name="name"
                                placeholder="Nhập tên ">

                        </div>
                        @error('name')

                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror

                        <div class="form-group">
                            <label class="form-label">Mô tả vai trò </label>
                            <textarea type="text" value=" {{old('description_name')}}"
                                class="form-control  @error('email') is-invalid @enderror" name="description_name"
                                placeholder="Nhập description_name"> {{$role->description_name}}</textarea>

                        </div>
                        @error('description_name')

                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror

                    </div>


                    <label for="">Danh sách quyền </label>
                    <div>
                        <input type="checkbox" class="all_permission" style=" margin: 5px 5px ">All Permission
                    </div>

                    @foreach ($permissions as $item)
                    <div class="card border-primary col-md-12">
                        <div class="card-header" style="align-items: 20px;">


                            <input type="checkbox" name="item_role[]" class="input_role"
                                {{$permission_role->contains('permission_id',$item->id)?'checked' :''}}
                                value="{{$item->id}}">

                            {{$item->name}}

                        </div>

                        <div>
                            <div style="margin-left: 20px; align-items: center;">
                                <ul class="list-group list-group-flush ">
                                    @foreach ($item->permission_Item as $children)
                                    <li class="list-group-item">
                                        <input type="checkbox" name="item_role[]" class="input_item"
                                            {{$permission_role->contains('permission_id',$children->id)?'checked' :''}}
                                            value="{{$children->id}}"> {{$children->name}}
                                    </li>


                                    @endforeach




                                </ul>
                            </div>

                        </div>

                    </div>
                    @endforeach











                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

                <div class="col-md-6">









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