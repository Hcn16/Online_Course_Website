<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Course extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [ 'your_attribute' => 'string', ];

    public function user_name_teacher($param1) {
        $name =   DB::select('select avatar_image_path, name from users where users.id = ('.$param1.')');
        return $name;
    }

    public function user_course($param2 ) {
        $name =   DB::select('select c.* from courses as c inner join user_course as uc
        on c.id = uc.id_course where uc.id_user = ('.$param2.') and uc.status =1');
        return $name;
    }

    public function user_course_new($param1) {
        return   DB::select('select c.* from courses as c  where c.id NOT IN (select id_course from user_course where id_user = ('.$param1.') )');
       
    }

    public function user_course_register($param1) {
        return   DB::select('select c.* from courses as c  where c.id IN (select id_course from user_course where id_user = ('.$param1.') and status =0)');
       
    }

    
    public function files(){
        return $this->hasMany(courses_file::class, 'courses_id');
    }

    public function course_tag(){
        return $this->belongsToMany(tags::class,'course_tags', 'courses_id', 'tags_id')->withTimestamps();
    }


    public function num_learner_of_course($param){
        return DB::scalar('select count(id_user) from user_course where id_course =? and status = 1', [$param]);
    }

    public function course_of_teacher($param){
        return DB::select ('select c.* from courses as c inner join teacher_course as tc 
        on c.id = tc.id_course where tc.id_teacher = ?', [$param]);
    }
    public function course_teacher(){
        return $this->belongsToMany(User::class,'teacher_course', 'id_course', 'id_teacher')->withTimestamps();
    }



    public function category(){
        return $this->belongsTo(category::class,'category_id');
    }

    public function fileshow(){
        return $this->belongsTo(courses_file::class,'courses_id');
    }

    public function fileshow2(){
        return $this->hasMany(Courses_file::class,'courses_id');
        
        
        // $course_file[] = courses_file::where('courses_id', $id)->get();
        // foreach ($course_file as $user) {
        //     echo $user->file_path;
        // }
        // //return $this->hasMany(courses_file::class,'courses_id');
        

    }

}
