<?php
namespace App\Traits;
use App\Http\Controllers\storage;
use App\Models\Course;
use Illuminate\Support\Str;
use Mail;

trait send_mail
{

    
public function send_mail(Course $param, $id_course)
{
   
    

    $test = new \App\Mail\send_mail($param, $id_course);

    Mail::to("nguyenquangninh1606@gmail.com")->send($test);



}

  
}



