@extends('layouts.admin')

@section('title')
<title>Courses detail</title>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{asset('Addmin/Courses/index/list.js')}}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


@endsection

@section('content')


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
     
      
  <!-- Content Header (Page header) -->
  <div class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1 class="m-0 text-dark">{{ $coursesList->name }} ( {{$coursesList->id}} )</h1>
                  </div><!-- /.col -->
                  <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                    
                     
                         
                      </ol>
                  </div><!-- /.col -->
              </div><!-- /.row -->
          </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->


    

    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
            <div class="col-md-12">
                    
                    <a href="{{route('learners.index')}}"
                        class="btn btn-success float-left m-2">Return Course</a>

                </div>

                <div class="col-md-12">
                    <a href="{{route('learners.detail_score',['id' => $coursesList->id])}}" 
                    class="btn btn-success float-right m-2">Quản lí điểm </a>

                </div>

                <div class="col-md-12">
                    <table class="table" title="Lí thuyết "  >
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                               
                                <th scope="col">Tài khoản học viên</th>   
                                <th scope="col">Email</th> 
                                <th scope="col">Trạng thái </th> 
       
                                <th scope="col">Action</th>   
                                
                                
                              
                            </tr>
                        </thead>
                        <tbody>

                        @foreach( $user_list as $item)
                            


                            <tr>
                                <th scope="row">{{$item->id}}</th>
                                <td>{{$item->name}} </td>
                                <td>{{$item->email}} </td>
                               @if($item->status == 1)

                                <td>Đã chấp nhận</td>
                                @else
                                <td>
                                <a data-url="{{route('scores.accept',['id'=> $item->id, 'id_course' =>$coursesList->id])}}"
                                class="btn btn-danger accept">Chấp nhận</a>
                                </td>

                                @endif
                                @if($item->status == 1)

                                <td>
                                <a data-url="{{route('learners.delete',['id'=> $item->id, 'id_course' =>$coursesList->id])}}"
                                class="btn btn-danger actiondelete">delete</a>

                                </td>
                                @else
                                <td></td>
                                @endif



                            </tr>
                            @endforeach
                           

                        </tbody>
                    </table>
                    
                       
                    
                   


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