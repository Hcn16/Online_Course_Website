<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exercise extends Model
{
    use HasFactory;
    protected $guarded =[];
    use SoftDeletes;

    public function exercise_question(){
        return $this->belongsToMany(Question::class,'question_exercises', 'id_exercise', 'id_question')->withTimestamps();
    }

    public function get_exercise_of_course($param){
        return Exercise::where('id_course', $param)->get();
    }

    public function get_score_exercise($id_exercise, $id_user_do){
        return DB::select('select * from score_exercises where id_exercise = ? and id_user_do =?', [$id_exercise, $id_user_do]);
    }
}
