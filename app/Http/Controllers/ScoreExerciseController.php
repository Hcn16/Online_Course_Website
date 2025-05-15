<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use App\Traits\send_mail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Models\Category;
use App\Models\Course;
use App\Models\courseTag;
use App\Models\tags;
use App\Models\roles;
use App\Models\User;
use App\Models\courses_file;
use Number;


class ScoreExerciseController extends Controller
{

    use send_mail;
    
    private $courses;
    private $category;
    private $_file;
    private $tags;
    private $course_tag;
    private $_role;


    private $user;
    private $_exercise;




    public function __construct(Category $category, User $user,Exercise $exercise, Course $courses, tags $tags, courses_file $_files, courseTag $course_tag, roles $role)
    {
        $this->category = $category;
        $this->courses = $courses;
        $this->tags = $tags;
        $this->_file = $_files;
        $this->course_tag = $course_tag;
        $this->_role = $role;
        $this->user = $user;
        $this->_exercise = $exercise;
      
    }
    public function index()
    {
        $coursesList = $this->courses->paginate(10);
        
        foreach($coursesList as $cou){
            if(  (auth()->user()->roles->contains('id', 4) && auth()->user()->manage_course->contains('id', $cou->id) ) != 1

            ){

                
                $get_id[] = $cou->id;
                

            }
            else{
    
            }
           

        }

        $courses_collect = $coursesList->getCollection(); 
                $filteredUsers = $courses_collect->reject(function ($user) use ($get_id) {
                    return in_array($user->id, $get_id);
                    
                    });
                $coursesList->setCollection($filteredUsers);
        $_roles = auth()->user()->roles;

        foreach ($_roles as $role) {

            if (($role->id) == 4) {
                

               
                $course_manage = array();
                $course_manage_list = [];
                

                $done_exercise=0;
                $size_exercise=0;
                $user_course_not_accept=0;
                $user_course_accepted=0;
                foreach ($coursesList as $item) {
                    $user_course_accepted_list = DB::table('user_course')->where('id_course', $item->id)->where('status' , 1)->get();                
                    $user_course_not_accept_list = DB::table('user_course')->where('id_course', $item->id)->where('status' , 0)->get();
                    $exercise_of_course =  $this->_exercise->get_exercise_of_course($item->id);

                    $user_course_accepted = (sizeof($user_course_accepted_list));
                    $user_course_not_accept = (sizeof($user_course_not_accept_list));
                    $size_exercise = (sizeof($exercise_of_course));
                    
                    foreach($user_course_accepted_list as $accept){
                        $get_submit_exer =  $this->user->get_submit_exercise($item->id, $accept->id_user);
                        if($get_submit_exer == $size_exercise && $size_exercise !=0){
                            $done_exercise++;
                        }
                    }                

                    
                    $course_manage['id'] = $item->id;
                    $course_manage['user_course_accepted'] = $user_course_accepted;
                    $course_manage['user_course_not_accept'] = $user_course_not_accept;
                    $course_manage['exercise_size'] = $size_exercise;
                    $course_manage['done_exercise'] = $done_exercise;
                    $course_manage_list[] = $course_manage;
                    $done_exercise = 0;

                }

                $coursesList = $coursesList->toArray();
                $coursesList = ($coursesList['data']);
                $coursesList = array_values($coursesList);
                
                return view('admin.learners.index', compact('coursesList','size_exercise','user_course_accepted','user_course_not_accept', 'course_manage_list'));
            }
        }

    }

    public function detail($id)
    {

        $coursesList = $this->courses->find($id);

        $user = $this->user->all();
        $exercise_of_course =  $this->_exercise->get_exercise_of_course($id);
        $get_submit_exer =  $this->user->get_submit_exercise($id, 16);
        $user_list = DB::select(
        "     SELECT name, id, status, email FROM users 
            INNER JOIN user_course ON (users.id = user_course.id_user)
            where user_course.id_course = ?
             
            " ,[($id)]);

        $user_course = DB::table('user_course')->where('id_course', $id)->get();

        $user_course_size = (sizeof($user_course));


        $size_exercise = (sizeof($exercise_of_course));



        return view('admin.learners.detail', compact('coursesList', 'user_course','size_exercise', 'user_course_size','user_list'));

    }

    public function detail_score($id){
        $coursesList = $this->courses->find($id);
        $user_course = DB::table('user_course')->where('id_course', $id)->where('status', 1)->get();
        $user_ = $this->user->all();
        $exercise_of_course =  $this->_exercise->get_exercise_of_course($id);
         

        $exercise_ = new Exercise();

        $user_list = DB::select(
        "     SELECT name, id, status, email FROM users 
            INNER JOIN user_course ON (users.id = user_course.id_user)
            where user_course.status = 1 and user_course.id_course = ?
             
            " ,[($id)]);


        $course_ = $this->courses; 
        $user_course_size = (sizeof($user_course));
        $id_course = $id;

        $size_exercise = (sizeof($exercise_of_course));
        $user = $this->user;


        return view('admin.learners.detail_score', compact('coursesList','exercise_','id_course','user_','user','exercise_of_course','course_', 'size_exercise', 'user_course', 'user_course_size','user_list'));

    }


    public function accept($id,  $id_course)
    {

        //return redirect()->route('questions.index');

        try {
            $affected = DB::update(
                'update user_course set status = 1 where id_user = ? and id_course = ?',
                [$id , $id_course]
            );

           $name =  db::select('select distinct name from courses where id = ?', [$id_course]);
            

           //dd(Carbon::now()->toDate());
           $date = Carbon::now()->toDate();
           //dd($date);
            DB::insert('insert into notificate  (content_notificate, id_user_receive,id_send, type_notificate, created_at, updated_at) 
             values (?,?,?,?,?,?)'
             , ['Bạn đã được thêm vào khóa học:'. $name[0]->name ,$id,auth()->id(), 'course', $date, $date ]);
           
             $this->send_mail($this->courses, $id_course);
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


    public function delete($id,  $id_course)
    {

        //return redirect()->route('questions.index');

        try {

            $affected = DB::delete(
                'delete from user_course where id_user = ? and id_course = ?',
                [$id , $id_course]
            );
           

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
