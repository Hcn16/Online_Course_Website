<?php
namespace App\Traits;
use App\Http\Controllers\storage;
use App\Models\Course;
use App\Models\User;
use Illuminate\Support\Str;
use Mail;

trait mail_reset_pass
{

    
public function mail_reset_pass(User $user,  $email)
{
   
    

    $password = new \App\Mail\mail_reset_pass($user, $email);

    Mail::to("nguyenquangninh1606@gmail.com")->send($password);



}

  
}



