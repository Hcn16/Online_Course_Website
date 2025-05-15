<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
    <link rel="stylesheet" href="{{asset('AdminLTE/plugins/fontawesome-free/css/all.min.css')}}">

    <link rel="stylesheet" href="{{asset('desgin/css/general.css')}}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



    <link rel="stylesheet" href="{{asset('user/image/logo.png')}}"  type="image/png">




</head>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
        height: 100vh;
        width: 100%;
        overflow: auto;
        /* Tạo thanh cuộn cho toàn bộ trang */
    }

    .section {
        margin: 0;
        padding: 0;
        width: 100%;
        height: auto;

    }

    #navbar {
        font-size: 25px;
    }

    #dropdown_menu {
        font-size: 20px;
    }

    .header_ {
        width: 100%;
        height: auto;
        background-color: darkslateblue;
        display: ruby;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
        padding: 10px;
    }


    .column {

        padding: 20px;
        box-sizing: border-box;
    }

    .login_ {
        float: right;
        margin-right: 11%;
        align-content: space-between;
        /* margin-top: 0; */
        /* display: ruby; */
        width: 81%;
        margin-left: 20px;
        display: flex;
    }

    .menu_ {
        display: grid;
        justify-content: center;
        align-items: center;
    }

    .login_ a {
        margin: 0px 5px 5px 10px;
        text-decoration: none;
    }

    .logo {
        margin-left: 25%;
        margin-top: 20px;
    }

    .search_course {
        width: 100%;


    }



    .search_course .search-form {
        width: 50rem;
        border-radius: .5rem;
        background-color: var(--light-bg);
        padding: 1.5rem 2rem;
        display: flex;
        gap: 2rem;

    }

    .search_course .search-form input {
        width: 100%;
        font-size: 1.8rem;
        color: var(--black);
        background: none;
    }

    .search_course .search-form {
        width: 50rem;
        background-color: var(--light-bg);
        padding: 1.5rem 2rem;
        display: flex;
        gap: 2rem;

    }

    .search_course .search-form input {
        width: 100%;
        font-size: 1.8rem;
        color: var(--black);
        background: none;
        border-radius: 25px;

    }

    .search_course .search-form button {
        background: none;
        font-size: 2rem;
        cursor: pointer;
        color: var(--black);
        border: none;
        margin-left: 29%;
        margin-top: 5px;

    }

    .search_course .search-form button:hover {
        color: var(--main-color);
    }

    .search_course .icons div {
        font-size: 2rem;
        color: var(--black);
        background-color: var(--light-bg);
        border-radius: .5rem;
        height: 4.5rem;
        width: 4.5rem;
        line-height: 4.5rem;
        cursor: pointer;
        text-align: center;
        margin-left: .7rem;
        border: none;
    }

    .search_course .icons div:hover {
        background-color: var(--black);
        color: var(--white);
    }

    .search-form button {
        background: none;
        font-size: 2rem;
        cursor: pointer;
        color: var(--black);
    }

    .search_course .search-form button:hover {
        color: var(--main-color);
    }

    .search_course .icons div {
        font-size: 2rem;
        color: var(--black);
        background-color: var(--light-bg);
        border-radius: .5rem;
        height: 4.5rem;
        width: 4.5rem;
        line-height: 4.5rem;
        cursor: pointer;
        text-align: center;
        margin-left: .7rem;
    }

    .search_course .icons div:hover {
        background-color: var(--black);
        color: var(--white);
    }
</style>

<style>
    /* styles.css */
body {
    margin: 0;
    font-family: Arial, sans-serif;
}

header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 20px;
    background-color: #333;
    color: white;
}

.logo {
    font-size: 24px;
    font-weight: bold;
}

.nav-links {
    list-style: none;
    display: flex;
    gap: 20px;
}

.nav-links li {
    display: inline;
}

.nav-links a {
    color: white;
    text-decoration: none;
}

.auth-buttons button {
    margin-left: 10px;
    padding: 5px 10px;
    background-color: #555;
    color: white;
    border: none;
    cursor: pointer;
}

.menu-toggle {
    display: none;
    flex-direction: column;
    cursor: pointer;
}

.menu-toggle span {
    height: 3px;
    width: 25px;
    background: white;
    margin: 4px 0;
}

@media (max-width: 768px) {
    .nav-links {
        display: none;
        flex-direction: column;
        width: 100%;
        text-align: center;
    }

    .nav-links li {
        margin: 10px 0;
    }

    .auth-buttons {
        display: none;
    }

    .menu-toggle {
        display: flex;
    }

    .menu-toggle.active + .nav-links {
        display: flex;
    }
}

</style>

<script>



</script>
<body>
    
    <div class="header_">
        <div class="column logo">
            <a href="{{route('general')}}" title="logo OLM" style="text-decoration: none;">
                <img src='{{asset('user/image/logo.png')}}' width='88' height='33' alt='Học trực tuyến'
                    class='img-logo lazyload' />
                <span style="font-size: 20px; ">EDUCATION</span>
            </a>
        </div>

        <div class="column search_course">
            <form action="{{route('courses.search_courses_index')}}" method="get" class="search-form">
                <input type="text" name="search_value" required placeholder="search courses..." maxlength="100">

                <button type="submit" class="fas fa-search"></button>
            </form>

        </div>

        <div class=" column login">
            <div class="login_">
                <a href="{{route('login')}}" class="btn btn-info " title="Đăng nhập "
                    style="background-color: #263b76; border:none">Đăng
                    nhập</a>
                <a href="{{route('register')}}" class="btn btn-warning" title="Đăng ký tài khoản "
                    style="background-color: #263b76; border:none">Đăng ký</a>
            </div>

        </div>


    </div>

    <section class="menu_">

        <nav class="navbar navbar-expand-lg bg-body-tertiary" id="navbar">
            <div class="container-fluid" style="background-color: #f4f4f4;">

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{route('general')}}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Khóa học</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Giáo viên</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Tài liệu
                            </a>
                            <ul class="dropdown-menu" id="dropdown_menu">
                                <li><a class="dropdown-item" href="#">Đề thi</a></li>
                                <li><a class="dropdown-item" href="#">Dự án </a></li>
                                <li><a class="dropdown-item" href="#">Tài liệu học tập</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

    </section>

    @yield('content');

</body>
<style>
    /* styles.css */
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
    }

    .slider {
        position: relative;
        margin: auto;
        overflow: hidden;
    }

    .slides {
        display: flex;
        transition: transform 0.5s ease-in-out;
    }

    .slide {
        min-width: 100%;
        box-sizing: border-box;
    }

    .slide img {
        width: 100%;
        display: block;
    }

    .prev,
    .next {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background-color: rgba(0, 0, 0, 0.5);
        color: white;
        border: none;
        padding: 10px;
        cursor: pointer;
    }

    .prev {
        left: 10px;
    }

    .next {
        right: 10px;
    }


    footer {
        background: darkslateblue;
        color: black;
        text-align: center;
        padding: 10px 0;
        margin-top: 20px;
    }
</style>

<script src="{{asset('desgin/js/show_course.js')}}"></script>


<footer>
    <p>&copy; 2024 Khóa Học Trực Tuyến. All rights reserved.</p>
    <p>Liên hệ: <a href="mailto:info@khoahoc.com">info@khoahoc.com</a></p>
</footer>

</html>