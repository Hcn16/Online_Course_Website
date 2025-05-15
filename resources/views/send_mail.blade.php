<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2> Bạn đã đăng kí thành công khóa học
    
    @foreach ($course as $item )
    {{$item->id}}

    @endforeach

    </h2>
</body>
</html>