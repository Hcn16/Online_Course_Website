<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
    <title>Document</title>
</head>

<body style="background-image: url({{asset('desgin/images/background_login.jpg')}}); 
background-size: cover; /* Để hình nền bao phủ toàn bộ phần tử */ background-position: center; 
 width: 100%; height: 100vh; /* Chiều cao của phần tử */">

    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card border-0 shadow rounded-3 my-5">
                    <div class="card-body p-4 p-sm-5">
                        <h5 class="card-title text-center mb-5 fw-light fs-5">Quên mật khẩu</h5>
                        <form action="{{route('get_pass')}}" method="post">
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="floatingInput" name="email"
                                    placeholder="name@example.com">
                                <label for="floatingInput">Nhập email bạn đã đăng kí </label>
                            </div>
                            
                            @if(isset($status))
                            <label for="" class="notificate" style="color: red;"> {{$status['value'];}}

                            </label>
                            @else



                           

                            @endif
                            <div class="d-grid">
                                <button class="btn btn-primary btn-login text-uppercase fw-bold" type="submit">Gửi</button>
                            </div>

                            
                            <hr class="my-4">
                            <!-- <div class="d-grid mb-2">
                                <button class="btn btn-google btn-login text-uppercase fw-bold" type="submit">
                                    <i class="fab fa-google me-2"></i> Sign in with Google
                                </button>
                            </div>
                            <div class="d-grid">
                                <button class="btn btn-facebook btn-login text-uppercase fw-bold" type="submit">
                                    <i class="fab fa-facebook-f me-2"></i> Sign in with Facebook
                                </button>
                            </div> -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


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