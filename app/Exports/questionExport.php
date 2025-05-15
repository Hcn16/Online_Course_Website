<?php

namespace App\Exports;

use App\Models\Answer;
use App\Models\Question;
use DB;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;

class questionExport implements FromArray
{
    /**
    * @return \Illuminate\Support\Collection
    */

    private $id_course;

    public function __construct($id_course){
        $this->id_course = $id_course;

    }
    public function array(): array    {

        $question = new Question();
        $answer = new Answer();
        $question =  DB::select('select *  from questions where id_course = ?', [$this->id_course]);

        foreach($question as $item){
            $answer = DB::select('select content_answer, is_answer from answers where id_question = ?', [$item->id]);
            $stt=0;
            for($i= 0; $i < sizeof($answer) ;$i ++){
                if($answer[$i]->is_answer == 1){

                    $item->$i  = $answer[$i]->content_answer.'(đáp án đúng)';

                }
                else{
                    $item->$i = $answer[$i]->content_answer;

                }
                $stt++;
            }

        }
        return $question;
    }
}
