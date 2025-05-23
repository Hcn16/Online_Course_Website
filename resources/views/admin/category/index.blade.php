@extends('layouts.admin')

@section('title')
<title>Trang Chu</title>
@endsection

@section('content')


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content-header', ['name' => 'Category', 'key' => 'List'])

    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @can('category-add')
                        <a href="{{route('categories.create')}}" class="btn btn-success float-right m-2">Add</a>
                    @endcan
                </div>

                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Tên danh mục</th>
                                <th scope="col">Action</th>

                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($categories as $category)
                                <tr>
                                    <th scope="row">{{ $category->id }}</th>
                                    <td>{{ $category->name }}</td>
                                    <td>
                                        @can('category-update')
                                            <a href="{{ route('categories.edit', ['id' => $category->id])}}"
                                                class="btn btn-default">Edit</a>

                                        @endcan
                                        @can('category-delete')
                                            <a href="{{ route('categories.delete', ['id' => $category->id])}}"
                                                class="btn btn-danger">Delete</a>

                                        @endcan


                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>


                </div>
                <div>
                    {{ $categories->links() }}

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