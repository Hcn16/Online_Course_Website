<?php

namespace App\Http\Controllers;

use App\Events\MessageDelivered;
use App\Models\Answer;
use App\Models\answer_checked;
use App\Models\Exercise;
use App\Models\Question;
use App\Models\score_exercise;
use App\Models\section;
use App\Models\Slider;
use App\Models\Menu;
use App\Models\User;
use App\Models\Course;
use App\Models\chat_group;

use Illuminate\Support\Facades\Hash;


use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use App\Http\Requests\SliderAddRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Models\category;
use Number;
use PhpParser\Node\Expr\Cast\Object_;

class UserController extends Controller
{
    use StorageImageTrait;
    private $slider;
    private $menu;
    private $_user, $exercise, $section, $chat_group,$question, $answer,$answer_checked, $score_exercise,$e_d;
    private $exercise_not;
    
    private $list;

    private $num_of_time;
     
    private $course;
    use StorageImageTrait;
    public function __construct(Slider $slider, Menu $menu, User $user, Course $course, score_exercise $score_exercise,answer_checked $answer_checked,Answer $answer, Exercise $exercise, Question $question ,section $section, chat_group $chat_group ) 
    {
        $this->course = $course;
        $this->slider = $slider;
        $this->_user = $user;
        $this->exercise = $exercise;
        $this->section = $section;
        $this->chat_group = $chat_group;
        $this->question = $question;
        $this->answer = $answer;
        $this->answer_checked = $answer_checked;
        $this->score_exercise = $score_exercise;
    }
    public function index()
    {

        $sliderList =Slider::all();
        $menu_list = Menu::all();
        $_course = $this->course;
        $course = $this->course->orderBy('created_at', 'desc')->get();
        
        return view('user.Home', compact('sliderList', 'menu_list','course','_course'));
    }

    public function notificate($id_notificate){
        try{
            DB::beginTransaction();
            DB::update('update notificate set is_check = 1 where id = ?', [$id_notificate]);
            $notificate = DB::select('select * from notificate where id = ?',[ $id_notificate]);
            DB::commit();
            return view ( 'user.notificate', compact('notificate'));


        }catch (\Exception $e) {
            DB::rollBack();
            Log::error('message' . $e->getMessage() . 'Line' . $e->getLine());


        }

 
    }

    public function homePage(){
        if(isset($_GET['status']) && $_GET['status']==00){
           DB::table('user_course')->insert([ 
                'id_user' => auth()->id(), 
                'id_course' => $_GET['code'], 
                'status' => 1, 
                'created_at' => now(), 
                'updated_at' => now(), 
            ]);

        } 
       
        $user_intance = $this->_user->find(auth()->id());
        $category = category::all();
        $course = Course::all();
        $_course = $this->course;
        $user_course = $this->course->user_course(auth()->id());
        $user_course_new = $this->course->user_course_new(auth()->id());
        $user_course_register = $this->course->user_course_register(auth()->id());

        
       

        return view('user.showCourse', compact('user_course_register','user_intance','category','course','user_course','_course','user_course_new'));


    }

    public function new_course(){
        $user_intance = $this->_user->find(auth()->id());
        $category = category::all();
        $course = Course::all();
        $_course = $this->course;
        $user_course = $this->course->user_course(auth()->id());
        $user_course_new = $this->course->user_course_new(auth()->id());
        $user_course_register = $this->course->user_course_register(auth()->id());

        
       

        return view('user.new_course', compact('user_course_register','user_intance','category','course','user_course','_course','user_course_new'));


    }
    
    public function profile(){
        return view('user.profile');
    }

    public function update_Profile(){
        return view('user.updateProfile');
    }

    public function store (Request $request){
        try {


            DB::beginTransaction();
                      //dd($request->all());
          if(auth()->user()->learner_check_pass($request->old_pass)== false){
           return redirect()->back()->with('status','Mật khẩu cũ không đúng');


          }
         
          if(($request->file_path ) == null){
            $data['file_path'] =  auth()->user()->avatar_image_path;
            

          }
          else{
            $data = $this->storageTraitUpload($request, "file_path", 'User');

          }
             
          if(($request->new_pass ) == null){
            $request->new_pass = auth()->user()->password;
            

          }
          else{
            $request->new_pass = Hash::make($request->new_pass);
          }


           
            $dataSettingUpdate = [            
                'name' => $request->name,
                'email' => $request->email,
                'password'=> ($request->new_pass),
                'avatar_image_path' => $data['file_path'],
            ];

         
            
            $user = $this->_user->find(auth()->user()->id)->update($dataSettingUpdate);


           DB::commit();
            return redirect()->route('homePage');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('message' . $e->getMessage() . 'Line' . $e->getLine());
            return redirect()->back()->with('status','Có lỗi xảy ra!');


        }

    }

    public function showTeacher(){
        $teacher =  $this->_user->getTeacher();
        foreach($teacher as $item ){
            $item->total = $this->_user->totalCourse($item->id);


        }


        
        
        
        return view('user.teacher',compact('teacher'));

    }


    public function showTeacher_profile($id){
        $teacher =  $this->_user->find($id);
        $teacher->total = $this->_user->totalCourse($teacher->id);
        $course = DB::select('select c.* from courses as c inner join teacher_course as tc on c.id = tc.id_course where tc.id_teacher = ? ', [$id]);      
        $user_course = $this->course->user_course(auth()->id());
        //dd($user_course );
        $id_user_course=[];

        foreach($user_course as $item){
            $id_user_course[] = $item->id;
        }
        
        return view('user.teacher_profile',compact('teacher', 'course', 'user_course','id_user_course'));

    }


    public function detail_course ($id){
        $course = $this->course->find($id);
        $section = $this->section->where('id_course',$id)->get();
        $course = $this->course->find($id);
        $file_ =  [];
        $file =[];
        $exercise = $this->exercise->where('id_course',$id)->get();

        
       
       $user = $this->_user;
        return view('user.course_home', compact('course', 'user','section','exercise', 'file'));

    }

    public function chat_course ($id){
        $course = $this->course->find($id);
        $chat = $this->chat_group->where('id_course_receive', $id)->get();
        \Log::info($chat);
       $user = $this->_user;
        return view('user.course_chat', compact('course','chat', 'user'));

    }



    public function course_exercise($id){

     

        $exercise = $this->exercise->where('id_course',$id)->get();
        $course = $this->course->find($id);
        $exercise_done = $this->score_exercise->where('id_user_do', auth()->id())->get();
        $exercise_submit =  DB::select ('select distinct  se.id_exercise,e.name_exercise,e.updated_at from score_exercises as se inner join exercises as e on se.id_exercise = e.id  where e.id_course = ? and id_user_do = ? ORDER BY id_exercise ASC', [$id, auth()->id()]);
        
        
        $exercise_num_of = DB::select ('select id, num_of_time , score, id_exercise from score_exercises where id_user_do =? ORDER BY id_exercise ASC', [auth()->id()]);
        for($i = 0; $i < sizeof($exercise_submit) ; $i++){
           foreach($exercise_num_of as $ex_num){

                if($ex_num->id_exercise == $exercise_submit[$i]->id_exercise){
                    $exercise_submit[$i]->list_score[] = $ex_num;                   
                }
               
                
           }
          
            
        }
        foreach($exercise_done as $item){
            if($exercise->contains('id', $item->id_exercise) ){
                $this->e_d[] = $item;
                $id_[] = $item->id_exercise;

            } 
        }
            
        foreach($exercise as $item){
            $test = 0;
           if($this->e_d != []){
        
            for($i = 0; $i < count($this->e_d); $i++){
                if($item->id == $this->e_d[$i]->id_exercise){
                    $test =1;
                    $this->e_d[$i]->name = $item->name_exercise;
                    
                }                                           

            }
        }

           if($test == 0){           
            $this->exercise_not[] = $item;
           }
        }
        $exercise_not = $this->exercise_not;
        $e_d = $exercise_submit;


        return view('user.course_exercise', compact('exercise_not','e_d', 'course'));
    }

    public function do_exercise($id, $id_course){
            $course = $this->course->find($id_course);
            $exercise = $this->exercise->find($id);


          


            $question_list = DB::select('select q.* from questions as q 
            inner join question_exercises as qe on q.id  = qe.id_question  where qe.id_exercise = ?', [$id]);
            $type_answer =0;
            foreach($question_list as $question){
                $answer = $this->answer->where('id_question' , $question->id)->get();
                foreach($answer as $item){
                    if($item->is_answer == 1){
                        $type_answer ++;
                    }
                }
                
                $question->answer = $answer;
                $question->type = $type_answer;
                $type_answer = 0;
            }        
           
            return view('user.do_exercise', compact(  'course','question_list','exercise'));

        }

        public function show_answer_checked($id_exercise, $id_course,$id_score_exercise){
            $course = $this->course->find($id_course);
            $exercise = $this->exercise->find($id_exercise);
        
            $question_list = DB::select('select q.* from questions as q 
            inner join question_exercises as qe on q.id  = qe.id_question  where qe.id_exercise = ?', [$id_exercise]);
            $type_answer =0;
            $check_answer = DB::select('select id_answer_checked from answer_checkeds where id_score_exercise = ? ',[$id_score_exercise]);
            foreach($check_answer as $check){
                $list_check[] = $check->id_answer_checked;
            }

            foreach($question_list as $question){
                $answer = $this->answer->where('id_question' , $question->id)->get();
                foreach($answer as $item){
                    if(in_array($item->id,$list_check)){
                        $item->is_answer_checked =  1;
                    }
                    else{
                        $item->is_answer_checked = 0;
                    }
                    if($item->is_answer == 1){
                        $type_answer ++;
                    }
                }
                
                $question->answer = $answer;
                $question->type = $type_answer;
                $type_answer = 0;
            } 

            if(auth()->user()->roles->contains('id', 4)){
                return view('admin.learners.show_answer_checked', compact(  'course','question_list','exercise'));

            }
            
            
           
            return view('user.show_answer_checked', compact(  'course','question_list','exercise'));
        }


    public function submit_exercise($id_exercise, $id_course){
        try {
            DB::beginTransaction();
            
            
            
            $num_do =  DB::select ('select top 1  num_of_time from score_exercises where id_user_do=?  and  id_exercise=? order by num_of_time desc', [auth()->id(),$id_exercise]);
            
            
            
            if($num_do == []){
                $this->num_of_time = 0;
               
            }
            else{
                $this->num_of_time = $num_do[0]->num_of_time;

            }
           
            $question_list = DB::select('select q.* from questions as q 
            inner join question_exercises as qe on q.id  = qe.id_question  where qe.id_exercise = ?', [$id_exercise]);
            $total = (sizeof($question_list));

            for($i =0; $i < count($question_list);$i++){
                $question_list_answer[] = DB::select('select a.id_question, q.type_question,  a.id  from questions as q 
                inner join answers as a on q.id  = a.id_question  where q.id = ? and a.is_answer = 1', [$question_list[$i]->id]);
                
            }
    
    
            $t=0;
            for($i = 0; $i < count($question_list_answer); $i++){
                for($j = 0; $j < count($question_list_answer[$i]); $j++){
                    
                    $question_list[$t]->list_answer[] = $question_list_answer[$i][$j]->id;
                    $question_list[$t]->id_question = $question_list_answer[$i][$j]->id_question;
  
                }

                $t++;
                if($t >= count($question_list) )break ;

    
                 

            }     
            $score =0;
            $list_mistake=[];
            for ( $i = 0; $i< sizeof($_POST['data_exercise'])  ; $i++) {
                $is_answer =  DB::select('select   id_question from answers where
                 id = ? and is_answer = 0', [$_POST['data_exercise'][$i]]); 
                //  $is_answer =  DB::select('select   id_question from answers where
                //  id = ? and is_answer = 0', [$_POST['data_exercise'][$i]]); 
                  if($is_answer != []){
                    $list_mistake[] = $is_answer[0]->id_question;
                  }
            }
            $question_correct_list=[];
            for($j = 0; $j < count($question_list); $j++){
                if($list_mistake != []){
                    if( in_array($question_list[$j]->id_question, $list_mistake) == false ){
                        $question_correct_list[] = $question_list[$j];
                    
                   

                    }
                   
                
                    
                }
                else{
                    $question_correct_list = $question_list;
                    break;
                    
                }

               
            }

            

            for($j = 0; $j < count($question_correct_list); $j++){
                             
                if(array_diff($question_correct_list[$j]->list_answer, $_POST['data_exercise']) == []){
                    $score ++;
                }
            }
           

            

            // for ( $i = 0; $i< sizeof($_POST['data_exercise'])  ; $i++) {
               
            //         $is_answer =  DB::select('select id, is_answer, id_question from answers where id = ?', [$_POST['data_exercise'][$i]]); 
            //         for($j = 0; $j < count($question_list); $j++){
            //             if($question_list[$i]->type_question == 1 && in_array($_POST['data_exercise'][$i],$question_list[$i]->list_answer)){
            //                 $score ++;

            //             }
            //             if($question_list[$i]->type_question == 2 && array_diff($question_list[$i]->list_answer, $_POST['data_exercise']) == []){
            //                 $score ++;
            //             }


            //         // foreach($is_answer as $item) {
            //         //     if($item->is_answer == 1 && $item->id_question ==$question_list[$i]->id_question && $question_list[$i]->type_question == 1 ){
            //         //         $score ++;
            //         //     }
            //         //     if($question_list[$i]->type_question == 2){

            //         //     }
    
            //         // }
            //     }
                
            // }



            $data2Create = [
                           
                'id_exercise' => (int)$id_exercise,
                'score' =>(float)($score/$total)*10,
                'id_user_do' => (int)auth()->id(),
                'num_of_time' =>$this->num_of_time+1,
                
            ];
    
            $score_exer = $this->score_exercise->create($data2Create);
            for ( $i = 0; $i< sizeof($_POST['data_exercise'])  ; $i++) {   

                
                    $id_question =  DB::select('select id_question from answers where id = ?', [$_POST['data_exercise'][$i]]); 
                    foreach($id_question as $item1) {
                        $dataCreate = [
                            'id_question' => (int)$item1->id_question,
                            //'id_exercise' => (int)$id_exercise,
                            'id_answer_checked' =>(int)$_POST['data_exercise'][$i],
                            // 'id_user' => (int)auth()->id(),
                            // 'num_do' => $this->num_of_time+1,
                            'id_score_exercise' =>$score_exer->id
                            
                        ];
                        $this->answer_checked->create($dataCreate);        
                       
                    } 
              
            }
       
            DB::commit();                      

            return response()->json([
                'message' => 'success',
                'code' => 200,
                'id_course' => $id_course,
                'data_url' => route('user.course_exercise', ['id' => $id_course])
            ], 200);

        } catch (\Exception $e) {
            Log::error('message' . $e->getMessage() . 'Line' . $e->getLine());
            DB::rollback();
            return response()->json([
                'message' => 'fail',
                'code' => 500
            ], 500);
        }

       
       
      

        //id_question, id_answer_checked, sll++, id_exercise
    }
    public function course_document($id){
        $section = $this->section->where('id_course',$id)->get();
        $course = $this->course->find($id);
        $file_ =  [];
        $file =[];
        foreach($section as $item ){
            foreach($item->files as $item2){
                $file_ ['file_name'] = $item2->file_name;
                $file_['file_path'] = $item2->file_path;
                $file[] = $file_;

                if($item2->type_file == 'video'){
                    $item->video = $item2->file_path;
                }
            }
        }

        //dd($section[3]->files);
        //dd($file);
        


        return view('user.course_document', compact('section','course', 'file'));

    }

    public function send_message_course($message){
        
        try {
            //dd($message);

            $user = db::select('select * from users where id = ?',[auth()->id()]);
            if ($_SERVER['REQUEST_METHOD'] === 'POST') 
            { 
               
                $name = $_POST['content'];}
                // Xử lý dữ liệu (ví dụ: lưu vào cơ sở dữ liệu, gửi email, v.v.) // ... 
                // Trả về phản hồi echo "Name: " . htmlspecialchars($name) . "<br>Email: " . htmlspecialchars($email); }
           $this->chat_group->where('id_send', auth()->id())->get();
           $dataCreate = [
            'id_send' => auth()->id(),
            'id_course_receive' => $message,
            'content' => $_POST['content'],
           ];
           $message = $this->chat_group->create($dataCreate);
           MessageDelivered::dispatch($message, $user);

           //(new MessageDelivered($message));
        //   $test = chat_group::all();
       
            
            return response()->json([
                'message' => 'success',
                'code' => 200,
                'test'=> json_encode($message) ,
                'name' => json_encode($name),
                'user' => $user,
            ], 200);

        }
        catch (\Exception $e) {
            Log::error('message' . $e->getMessage() . 'Line' . $e->getLine());
            return response()->json([
                'message' => 'fail',
                'code' => 500
            ], 500);
        }

    }

    function register_course($id_course){
        try {

                      
          $this->_user->register_course(auth()->id(),$id_course,0);
          
               
            
            return response()->json([
                'message' => 'success',
                'code' => 200,
             
               
            ], 200);

        }
        catch (\Exception $e) {
            Log::error('message' . $e->getMessage() . 'Line' . $e->getLine());
            return response()->json([
                'message' => 'fail',
                'code' => 500
            ], 500);
        }

    }

    function search(Request $request){
       
        $teacher= DB::select("select users.* from users  inner join role_user on users.id =role_user.user_id 
        where role_user.role_id = 4 and users.name like '%$request->search_teacher%'");
        foreach($teacher as $item ){
            $item->total = $this->_user->totalCourse($item->id);


        }
       


        
        return view('user.teacher',compact('teacher'));

    }




    
}