@extends('user.index')

@section('title')
<title>Users</title>
@endsection

@section('content')

<style>
.btn {
    width: auto;
    height: auto;
    font-size: 20px;
    margin-left: 200px;

}
.notification {
   display: none;
    position: fixed;
    top: 100px;
    right: 20px;
    background-color: red;
    color: white;
    padding: 15px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    opacity: 1;
    transition: opacity 1s ease-out;
}

.notification.hide {
    opacity: 0;
}



</style>

<script>


function showNotification(message) {
    var notification = document.getElementById('notification');
    var messageElement = document.getElementById('message');
    messageElement.textContent = message;
    notification.style.display = 'block';
    // Tự động ẩn thông báo sau 3 giây
    setTimeout(function() {
        notification.classList.add('hide');
    }, 3000);

    // Loại bỏ thông báo khỏi DOM sau khi ẩn
    setTimeout(function() {
        notification.style.display = 'none';
    }, 4000);
}

// Ví dụ: Hiển thị thông báo



</script>

<section class="form-container">
<div id="notification" class="notification"> <p id="message">This is a notification message.</p> </div>
  
    @if (session('status')) 
            <script>
              var statusMessage = @json(session('status'));
              showNotification(statusMessage);
            </script>
            
            

    @endif

    <form action="{{route('user.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <h3>Update profile</h3>
        <p>update name</p>
        <input type="text" value="{{ auth()->user()->name}}" name="name" placeholder="shaikh anas" maxlength="50"
            class="box">
        <p>update email</p>
        <input type="email" value="{{ auth()->user()->email}}" name="email" placeholder="example@gmail.come"
            maxlength="50" class="box">
        <p>previous password</p>
        <input type="password"  value="" name="old_pass" placeholder="enter your old password" maxlength="20" class="box">
        <p>new password</p>
        <input type="password" name="new_pass" placeholder="enter your new  password" maxlength="20" class="box">
        <p>confirm password</p>
        <input type="password" name="c_pass" placeholder="confirm your new password" maxlength="20" class="box">
        <p>update pic</p>
        <input type="file" accept="image/*" class="box" name="file_path" value="{{auth()->user()->avatar_image_path}}">
        <img src="{{asset('auth()->user()->avatar_image_path')}}" alt="">
        <button type="submit"  name="submit" class="btn btn-success">Submit</button>
    </form>

</section>

@endsection