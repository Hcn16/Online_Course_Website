@extends('layouts.admin')

@section('title')
<title>Settings</title>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{asset('Addmin/Courses/index/list.js')}}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
    crossorigin="anonymous"></script>
@endsection
@yield('css')
@section('content')


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content-header', ['name' => 'Settings', 'key' => 'List'])

    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                
                <div class="col-md-12">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle float-right m-2" type="button"
                            data-bs-toggle="dropdown">
                            Add
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{route('settings.create') . '?type=text'}}">Add text</a></li>
                            <li><a class="dropdown-item" href="{{route('settings.create') . '?type=textarea'}}">Add area</a></li>

                        </ul>
                    </div>

                </div>

                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Config key</th>
                                <th scope="col">Config value </th>

                                <th scope="col">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($settingList as $setting)


                                <tr>
                                    <th scope="row">{{$setting->id}}</th>
                                    <td>{{$setting->config_key}}</td>
                                    <td>{!!  $setting->config_value !!}</td>


                                    <td>
                                        <a href="{{route('settings.edit', ['id' => $setting->id])}}"
                                            class="btn btn-default">Edit</a>
                                        <a data-url="{{route('settings.delete', ['id' => $setting->id])}}"
                                            class="btn btn-danger actiondelete">Delete</a>


                                    </td>

                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    {{$settingList->links()}}


                </div>
                <div>


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

@endsection