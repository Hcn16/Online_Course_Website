<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body style="background-image: url({{asset('desgin/images/background_login.jpg')}}); 
background-size: cover; /* Để hình nền bao phủ toàn bộ phần tử */ background-position: center; 
 width: 100%; height: 100vh; /* Chiều cao của phần tử */">

    <style>
    .container {
        background-color: #e7d6d6;
        width: 30%;
        height: auto;
        margin-top: 5%;
        padding: 20px 10px 20px 55px;
        border-radius: 20px;
    }

    .container input {
        border-radius: 10px;
        border: none;
        width: 80%;
        height: 40px;
    }

    .container button {
        float: unset;
        margin-left: 60%;
        border-radius: 5px;
        border: none;
        padding: 10px;
        background-color: goldenrod;
        margin-top: 10px;
    }
    </style>
    <div class="container">
        <form action="{{route('post_register')}}" method="post" enctype="multipart/form-data" >
            @csrf
            <h3>Đăng kí tài khoản </h3>

            <div class="form-group">
                <label class="form-label">Tên </label>
                <input type="text" value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror"
                    name="name" placeholder="Nhập tên ">

            </div>
            @error('name')

            <div class="alert alert-danger">{{$message}}</div>
            @enderror

            <div class="form-group">
                <label class="form-label">Email </label>
                <input type="text" value="{{old('email')}}" class="form-control @error('email') is-invalid @enderror"
                    name="email" placeholder="Nhập email">

            </div>
            @error('email')

            <div class="alert alert-danger">{{$message}}</div>
            @enderror

            <div class="form-group">
                <label class="form-label">Password </label>
                <input type="password" value="{{old('password')}}" class="form-control @error('password') is-invalid @enderror"
                    name="password" placeholder="password">

            </div>
            @error('password')

            <div class="alert alert-danger">{{$message}}</div>
            @enderror

            <div class="form-group">
                <label class="form-label">Confirm Password </label>
                <input type="password" value="{{old('pass')}}" class="form-control @error('password') is-invalid @enderror"
                    name="c_pass" placeholder="password">

            </div>
            <div class="form-group" style="margin: 15px 5px 5px 5px ">
                <label for=""> Chọn vai trò:</label>
               <select name="role" id="">
                
                <option value="2">Người học</option>
                <option value="4">Giáo viên</option>

               </select>
                

            </div>


            <div class="form-group">
                <label class="form-label">Ảnh đại diện </label>
                <input type="file" accept="image/*"  class="form-control " name="file_path"
                    placeholder="Thêm ảnh">

            </div>


            <button type="submit"  class="btn-primary"> Đăng kí</button>
        </form>
    </div>

    <script>
    function check() {

        // Kiểm tra mã phím Enter (13) 
        if ($('.box1').val() != $('.box2').val()) {
            alert('xác nhận mật khẩu sai ');


        } else {

        }





    };
    </script>


</body>

</html>

<style>
body {
    background: #007bff;
    background: linear-gradient(to right, #0062E6, #33AEFF);
}

.btn-login {
    font-size: 0.9rem;
    letter-spacing: 0.05rem;
    padding: 0.75rem 1rem;
}

.btn-google {
    color: white !important;
    background-color: #ea4335;
}

.btn-facebook {
    color: white !important;
    background-color: #3b5998;
}
</style>