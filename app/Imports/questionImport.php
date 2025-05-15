<?php

namespace App\Imports;

use App\Models\Answer;
use App\Models\Question;
use DB;
use Hash;
use Illuminate\Support\Collection;
use Log;
use Maatwebsite\Excel\Concerns\ToCollection;

class questionImport implements ToCollection
{
    /**
    * @param Collection $collection
    */

    private $id_course;

    public function __construct($id_course){
        $this->id_course = $id_course;

    }
    public function collection(Collection $rows)
    {
        
            DB::beginTransaction();
            foreach ($rows as $row) {
                $dataCreate =[
                    'content'    => $row[0],
                    'level' => $row[1],
                    'id_course' => $this->id_course,
                    'type_question' =>  $row[3],
    
                ];

                
               

                $question = new Question();
                $ques = $question->create($dataCreate);
                $check = "(đáp án đúng)";
                for($i = 4 ; $i< sizeof($row) ; $i++){
                    if($row[$i] != null){
                        if (strpos($row[$i], $check) == true) 
                        {
                            $row[$i] = str_replace($check, "", $row[$i]);
                            $dataAnswerCreate= [
    
                                'id_question' => $ques->id,
                                'content_answer' => $row[$i],
                                'is_answer' => 1
                            ];
    
                         } 
                        else 
                        { 

                            $dataAnswerCreate= [
                                'id_question' => $ques->id,
                                'content_answer' => $row[$i],
                                'is_answer' => 0
                            ];
                         }
    
                    
                   
    
                        $answer= new Answer();
                        $answer->create($dataAnswerCreate);
    

                    }

    
    

                }
             
            }

          
            DB::commit();


        
        // catch (\Exception $e) {
        //    
        //     Log::error('message' . $e->getMessage() . 'Line' . $e->getLine());
        //         return response()->json([ 'error' => true, 'message' => $e->getMessage() ], 500);
            // return redirect()->back()->with('failed', $e->getMessage());
//return redirect()->route('questions.index', ['id_course' => $this->id_course]);


        
        
        


     
    }
    
}
