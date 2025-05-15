@extends('layouts.admin')

@section('title')
<title>Trang Chu</title>
@endsection

@section('content')


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  
@include('partials.content-header', ['name' => 'Category', 'key' => 'Edit'])
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <form action="{{route('categories.update', ['id' => $category->id ])}}" method="post">
                          @csrf
                        <div class="form-group">
                            <label class="form-label">Tên danh mục</label>
                            <input type="text" 
                            class="form-control"
                            name ="name" 
                            value = "{{ $category->name }}"
                          placeholder="Nhập tên danh mục">
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>

                        <div class="form-group">
                            <label for="disabledSelect" class="form-label">Chọn danh mục cha</label><br>
                            <select class="form-control" name="parent_id">
                                <option value="0">Chọn danh mục cha</option>
                                {!! $htmlOption !!}
                            </select>
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

@endsection