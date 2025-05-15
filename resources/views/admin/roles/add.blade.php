@extends('layouts.admin')

@section('title')
<title>Add Roles</title>
@endsection

@section('css')
<link href="{{asset('vendors/select2/select2.min.css')}}" rel="stylesheet">
</link>
<link href="{{asset('Addmin/Courses/add/add.css')}}">







</link>
<style>
    .list-group {
        display: -webkit-box;
    }

    .input_role{
        margin-right: 5px;
    }
</style>

<link href="{{asset('froala_editor/css/froala_editor.pkgd.min.css')}}" rel="stylesheet">
</link>
@endsection

@section('js')

    <script>
    $('.input_role').on('click', function(){               
        $(this).parents('.card').find('.input_item').prop('checked', $(this).prop('checked'));
    });
    </script>
@endsection



@section('content')


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    @include('partials.content-header', ['name' => 'Roles', 'key' => 'Add'])

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <form action="{{route('roles.store')}}" method="post" enctype="multipart/form-data" name="formName">

                    <div class="col-md-6">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">Tên vai trò </label>
                            <input type="text" value="{{old('name')}}"
                                class="form-control @error('name') is-invalid @enderror" name="name"
                                placeholder="Nhập tên ">

                        </div>
                        @error('name')

                            <div class="alert alert-danger">{{$message}}</div>
                        @enderror

                        <div class="form-group">
                            <label class="form-label">Mô tả vai trò </label>
                            <textarea type="text" value="{{old('description_name')}}"
                                class="form-control  @error('email') is-invalid @enderror" name="description_name"
                                placeholder="Nhập description_name"></textarea>

                        </div>
                        @error('description_name')

                            <div class="alert alert-danger">{{$message}}</div>
                        @enderror

                    </div>


                    <label for="">Danh sách quyền </label>

                    @foreach ($permissions as $item)
                        <div class="card border-primary col-md-12">
                            <div class="card-header" style="align-items: 20px;">
                                <input type="checkbox" name="item_role[]" class="input_role" value="{{$item->id}}">
                                  {{$item->name}}
                            </div>

                            <div class="test1">
                                <div style="margin-left: 20px; align-items: center;">
                                    <ul class="list-group list-group-flush ">
                                        @foreach ($item->permission_Item as $children)
                                            <li class="list-group-item">
                                                <input type="checkbox" name="item_role[]" class="input_item" value="{{$children->id}}">  {{$children->name}}
                                            </li>


                                        @endforeach



                                    </ul>
                                </div>

                            </div>

                        </div>
                    @endforeach











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