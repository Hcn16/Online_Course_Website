<?php

namespace App\Http\Controllers;

use App\Models\question_exercise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Models\Question;
use App\Models\Answer;

use App\Models\Course;
use App\Models\Exercise;


class ExerciseController extends Controller
{

    private $_question;
    private $_course;
    private $_answer;

    private $_exercise;
    private $auto_question_list = [];





    public function __construct(question $question, Course $course, Answer $answer, Exercise $exercise)
    {
        $this->_question = $question;
        $this->_course = $course;
        $this->_answer = $answer;
        $this->_exercise = $exercise;






    }

    public function index(Request $request)
    {

        $id_course = ($request->id_course);

        $exerciseList = $this->_exercise->where('id_course', $id_course)->paginate(10);
        $answer = $this->_answer->orderBy('content_answer')->get();


        return view("admin.exercises.index", compact("exerciseList", 'id_course', 'answer'));

    }




    public function create(Request $request)
    {

        $id_course = ($request->id_course);

        $questionList = $this->_question->where('id_course', $id_course)->paginate(10);


        return view("admin.exercises.add", compact('id_course', 'questionList'));
    }

    public function create_auto(Request $request)
    {

        $id_course = ($request->id_course);

        $num_easy=0;
        $num_medium=0;
        $num_hard=0;
        $questionList = $this->_question->where('id_course', $id_course)->get();
        foreach ($questionList as $item) {
            if ($item->level == 1) {
                $num_easy ++;
            }
            else if($item->level == 2){
                $num_medium ++;


            }
            else{
                $num_hard++;
            }

        }


        return view("admin.exercises.add_auto", compact('id_course','num_easy','num_medium','num_hard', 'questionList'));
    }

    public function store_auto(Request $request)
    {
        try {
            DB::beginTransaction();
            $questionList = $this->_question->where('id_course', $request->id_course)->get();
            $array = [];
            $randomKeys=[];

            ////
            foreach ($questionList as $item) {
                if ($item->level == 1) {
                    $array[] = $item->id;
                }

            }
            if($request->sum_easy == 1){
                $randomKeys = array_rand($array);
                $this->auto_question_list[] = $array[$randomKeys];

            }
            elseif($request->sum_easy == 0){}    
            else{
                $randomKeys = array_rand($array, $request->sum_easy);
                foreach ($randomKeys as $key) {
                
                    $this->auto_question_list[] = $array[$key];
                    // echo $array[$key];
                }

            }

            

            //////
            $array =[];
            foreach ($questionList as $item) {
                if ($item->level == 2) {
                    $array[] = $item->id;
                    
                }

            }
            if($request->sum_medium == 1){
                $randomKeys = array_rand($array);
                $this->auto_question_list[] = $array[$randomKeys];

            }
            elseif($request->sum_medium == 0){}
            
            else{
                $randomKeys = array_rand($array, $request->sum_medium);
                foreach ($randomKeys as $key) {
                
                    $this->auto_question_list[] = $array[$key];
                    echo $array[$key];
                }

            }
           
            /////
            $array =[];

            foreach($questionList as $item ){
                if($item ->level == 3){
                    $array[] = $item->id;              
                }         

            }
            if($request->sum_hard == 1){
                $randomKeys = array_rand($array);
                $this->auto_question_list[] = $array[$randomKeys];

            }
            elseif($request->sum_hard == 0){}
            
            else{
                $randomKeys = array_rand($array, $request->sum_hard);
                foreach ($randomKeys as $key) {
                
                    $this->auto_question_list[] = $array[$key];
                    echo $array[$key];
                }

            }

            $dataExerciseCreate = [
                'name_exercise' => $request->name_exercise,
                'time_do' => $request->time_do,
                'num_level_easy' => $request->sum_easy,
                'num_level_medium' => $request->sum_medium,
                'num_level_hard' => $request->sum_hard,
                'id_course' => $request->id_course,

            ];

            $exercise = $this->_exercise->create($dataExerciseCreate);
            

            $exercise->exercise_question()->attach($this->auto_question_list);



            DB::commit();

            $id_course = ($request->id_course);


            $sectionList = $this->_question->paginate(10);

            return redirect()->route('exercises.index', ['id_course' => $id_course]);
            //return view("admin.exercises.index", compact('sectionList','id_course'));


        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('message' . $e->getMessage() . 'Line' . $e->getLine());
            // return redirect()->back()->with('error', 'Lỗi khi import: ' . $e->getMessage()); 



        }

    }




    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $dataExerciseCreate = [
                'name_exercise' => $request->name_exercise,
                'time_do' => $request->time_do,
                'num_level_easy' => $request->sum_easy,
                'num_level_medium' => $request->sum_medium,
                'num_level_hard' => ($request->sum_hard),
                'id_course' => $request->id_course,

            ];

            $exercise = $this->_exercise->create($dataExerciseCreate);
            foreach ($request->question as $item) {
                $question_ex[] = $item;
            }

            $exercise->exercise_question()->attach($question_ex);



            DB::commit();

            $id_course = ($request->id_course);


            $sectionList = $this->_question->paginate(10);

            return redirect()->route('exercises.index', ['id_course' => $id_course]);
            //return view("admin.exercises.index", compact('sectionList','id_course'));


        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('message' . $e->getMessage() . 'Line' . $e->getLine());


        }

    }

    public function edit($id, Request $request)
    {
        $id_course = ($request->id_course);
        $questionList = $this->_question->where('id_course', $id_course)->get();
        $id_question_ex = question_exercise::where(('id_exercise'), $id)->get('id_question');



        $exercise = $this->_exercise->find($id);



        return view('admin.exercises.edit', compact('questionList', 'exercise', 'id_course', 'id_question_ex'));


    }

    public function update($id, Request $request)
    {




        $id_course = ($request->id_course);
        $exercise = $this->_exercise->find($id);


        try {
            DB::beginTransaction();
            $dataExerciseUpdate = [
                'name_exercise' => $request->name_exercise,
                'time_do' => $request->time_do,
                'num_level_easy' => $request->sum_easy,
                'num_level_medium' => $request->sum_medium,
                'num_level_hard' => $request->sum_hard,
                'id_course' => $request->id_course,

            ];
            $this->_exercise->find($id)->update($dataExerciseUpdate);
            foreach ($request->question as $item) {
                $question_ex[] = $item;
            }

            $exercise->exercise_question()->sync($question_ex);




            DB::commit();

            return redirect()->route('exercises.index', compact('id_course'));

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('message' . $e->getMessage() . 'Line' . $e->getLine());

        }

    }

    public function delete($id)
    {

        try {
            $this->_exercise->find($id)->delete();

            return response()->json([
                'message' => 'success',
                'code' => 200
            ], 200);

        } catch (\Exception $e) {
            Log::error('message' . $e->getMessage() . 'Line' . $e->getLine());
            return response()->json([
                'message' => 'fail',
                'code' => 500
            ], 500);
        }

    }

}
