@extends('layouts.admin')

@section('title')
<title>Sliders</title>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{asset('Addmin/Courses/index/list.js')}}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


@endsection
@yield('css')
@section('content')


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content-header', ['name' => 'Sliders', 'key' => 'List'])

    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{route('sliders.create')}}" class="btn btn-success float-right m-2">Add</a>
                </div>

                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Tên slider</th>
                                <th scope="col">Mô tả </th>
                                <th scope="col">Hình ảnh </th>
                                <th scope="col">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sliderList as $slider)


                            <tr>
                                <th scope="row">{{$slider->id}}</th>
                                <td>{{$slider->name}}</td>
                                <td>{{  $slider->description }}</td>
                                <td>
                                    <img class="slider_image"src="{{$slider->image_path}}" style="width:100px; " alt="">
                                </td>

                                <td>
                                    <a href="{{route('sliders.edit',['id'=> $slider->id])}}" class="btn btn-default">Edit</a>
                                    <a data-url="{{route('sliders.delete',['id'=> $slider->id])}}" class="btn btn-danger actiondelete">Delete</a>


                                </td>

                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                    {{$sliderList->links()}}


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