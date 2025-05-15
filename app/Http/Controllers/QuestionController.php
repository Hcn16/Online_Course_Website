<?php

namespace App\Http\Controllers;

use App\Exports\name_question;
use App\Exports\questionExport;
use App\Imports\QuestionExcel;
use App\Imports\questionImport;
use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Models\Question;
use App\Models\Answer;

use App\Models\Course;
use Maatwebsite\Excel\Facades\Excel;




class QuestionController extends Controller
{
    //


    use StorageImageTrait;

    private $_question;
    private $_course;
    private $_answer;





    public function __construct(question $question, Course $course, Answer $answer)
    {
        $this->_question = $question;
        $this->_course = $course;
        $this->_answer = $answer;





    }

    public function index(Request $request)
    {

        $id_course = ($request->id_course);

        $questionList = $this->_question->where('id_course', $id_course)->paginate(10);
        $answer  = $this->_answer->orderBy('content_answer')->get();


        return view("admin.questions.index", compact("questionList", 'id_course','answer'));

    }




    public function create(Request $request)
    {

        $id_course = ($request->id_course);

        return view("admin.questions.add", compact('id_course'));
    }

    public function create_excel(Request $request)
    {
        $id_course = ($request->id_course);
       

        return view("admin.questions.add_excel", compact('id_course'));
    }

    public function store(Request $request)
    {


        $result = array_diff($request->answer, $request->is_answer);

        //dd($request->all());
        try {
            DB::beginTransaction();


            $dataQuestionCreate = [
                'content' => $request->name,
                'level' => $request->level,
                'type_question' => $request->type_question,
                'id_course' => $request->id_course,

            ];

            $question = $this->_question->create($dataQuestionCreate);

            foreach ($result as $answer) {


                $dataAnswerCreate = [
                    'id_question' => $question->id,
                    'content_answer' => $answer,
                    'is_answer' => 0,


                ];
                $this->_answer->create($dataAnswerCreate);

            }
            foreach ($request->is_answer as $is_answer) {

                $dataIsAnswerCreate = [
                    'id_question' => $question->id,
                    'content_answer' => $is_answer,
                    'is_answer' => 1,


                ];
                $this->_answer->create($dataIsAnswerCreate);


            }

            DB::commit();

            $id_course = ($request->id_course);
          

            $sectionList = $this->_question->paginate(10);

            return redirect()->route('questions.index', ['id_course' => $id_course]);
            //return view("admin.questions.index", compact('sectionList','id_course'));


        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('message' . $e->getMessage() . 'Line' . $e->getLine());


        }

    }

    public function export($id_course){
         //Excel::download(new name_question(), 'question.xlsx');

        return Excel::download(new questionExport($id_course), 'question.xlsx');
    }

    public function store_excel(Request $request){
        // dd($request->file);
        $data = $this->storageTraitUpload($request, 'file', 'question');
        // dd($data);
        // dd($request->file('file'));
        $id_course = $request->id_course;
        $excel_file = $request->file('file');
        try{     
            Excel::import(new questionImport($id_course), $excel_file);
            return redirect()->route('questions.index', ['id_course' => $id_course])
            ->with('success', 'Import thành công ' );


        }
        catch (\Exception $e) {
          
           return redirect()->back()->with('error', 'Lỗi khi import: ' . $e->getMessage()); 
            // dd($result);
            // return redirect()->route('questions.index', ['id_course' => $id_course]);

        }

        //return view('admin.questions.index', compact('id_course'))->with('success', 'Excel imported successfully');
        

    }

    public function edit($id, Request $request)
    {
        $question = $this->_question->find($id);
        $id_course = ($request->id_course);
        

       

        $answer = $this->_answer->orderBy('content_answer')->where('id_question' , $id)->get();
       


        return view('admin.questions.edit', compact('question','answer','id_course'));


    }

    public function update($id, Request $request)
    {
        $not_is_answer=[];

       
       
        if(!empty($request->answer1) && !empty($request->is_answer1)){
            $not_is_answer = array_diff($request->answer1, $request->is_answer1);


        }


        $id_course = ($request->id_course);
        //dd($request->all());
       
        $list=[];
        $i =0;
        foreach ($request->answer1 as $sub) { 
            $subObj = new \stdClass(); 
            // Tạo một đối tượng mới 
            $subObj->answer = $sub; 
             $subObj->id_answer = $request->id_answer[$i];
             if(in_array($sub, $request->is_answer1)) {
                $subObj->is_answer = 1;
             }else{
                $subObj->is_answer = 0;
             }
             $i++;
          
             $list[] = $subObj;  }

        

        
        try {
            DB::beginTransaction();


            $dataQuestionUpdate = [
                'content' => $request->name,
                'level' => $request->level,
                'type_question' => $request->type_question,
                'id_course' => $request->id_course,

            ];

            $question = $this->_question->find($id)->update($dataQuestionUpdate);
           
            
           //$test =  Answer::where('id_question', $id)->delete();
           
          

           foreach($list as $sublist){
            $dataAnswerCreate = [
                'id_question' => $id,
                'content_answer' => $sublist->answer,
                'is_answer' => $sublist->is_answer,


            ];
            $question = $this->_answer->find($sublist->id_answer)->update($dataAnswerCreate);



           }
            
            // foreach ($not_is_answer as $answer) {


            //     $dataAnswerCreate = [
            //         'id_question' => $id,
            //         'content_answer' => $answer,
            //         'is_answer' => 0,


            //     ];
            //     $this->_answer->create($dataAnswerCreate);

            // }
            // foreach ($request->is_answer1 as $is_answer) {

            //     $dataIsAnswerCreate = [
            //         'id_question' => $id,
            //         'content_answer' => $is_answer,
            //         'is_answer' => 1,


            //     ];
            //     $this->_answer->create($dataIsAnswerCreate);


            // }


            DB::commit();

            return redirect()->route('questions.index', compact('id_course'));

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('message' . $e->getMessage() . 'Line' . $e->getLine());


        }


    }

    public function delete($id)
    {

        //return redirect()->route('questions.index');

        try {
            $this->_question->find($id)->delete();

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
