<?php

namespace App\Http\Controllers;


use App\Events\chat_user;
use App\Events\MessageDelivered;
use App\Models\chat_group;
use App\Models\chat_private;
use App\Models\Menu;
use App\Models\Slider;
use App\Models\User;
use App\Traits\StorageImageTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\storage;
use App\Http\Requests\CoursesAddRequest;

use App\Models\Category;
use App\Models\Course;
use App\Models\courseTag;
use App\Models\tags;
use App\Models\roles;
use App\Models\courses_file;

use App\Components\Recusive;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class AdminCoursesController extends Controller
{
    //
    use StorageImageTrait;
    private $courses;
    private $category;
    private $_file;
    private $tags;
    private $course_tag;
    private $_role, $chat,$chat_private;

    private $htmlSelect, $htmlUser, $user;
    

    private $id = [];

    public function __construct(Category $category, Course $courses,User $user,chat_private $chat_private, tags $tags,chat_group $chat_group, courses_file $_files, courseTag $course_tag, roles $role)
    {
        $this->category = $category;
        $this->courses = $courses;
        $this->tags = $tags;
        $this->_file = $_files;
        $this->course_tag = $course_tag;
        $this->_role = $role;
        $this->chat = $chat_group;
        $this->chat_private = $chat_private;
        $this->user = $user;


    }



    public function index()
    {
        $course_ = $this->courses;
        $coursesList = $this->courses->paginate(5);
        // Chuyển đổi dữ liệu phân trang thành Collection 
      // Xóa phần tử có ID là 5 
      //dd($coursesList);
      $get_id =[];
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
        $is_detail = 0;

     

        return view('admin.courses.index', compact('coursesList', 'course_', 'is_detail'));
    }

    public function showCourse()
    {
        //dd(auth()->user()->roles);
        //dd(auth()->user()->manage_course);

        $course_ = $this->courses;
        $coursesList = $this->courses->paginate(5);
        return view('admin.courses.index', compact('coursesList', 'course_'));

    }


    public function detail($id)
    {


        $coursesList = $this->courses->find($id);
        $section = DB::table('sections')->where('id_course', $id)->get();
        $section_size = (sizeof($section));
        $course = $this->courses->find($id);
        $chat = $this->chat->where('id_course_receive', $id)->get();
        \Log::info($chat);
       $user = new User();


        return view('admin.courses.detail', compact('coursesList','chat','user', 'section', 'section_size'));



    }

    public function detail_chat()
    {
        $list_user = db::select('select * from users where id != ?',[auth()->id()]);

       $id=14;

       $id = db::select('select top 1 id_send, id_receive from chat_privates
        where (id_send = ? ) or (id_receive =?) order by created_at desc',[auth()->id(), auth()->id()]);
       
       // dd (auth()->user()->getMessage());
       $id = ($id[0]->id_send != auth()->id())?$id=$id[0]->id_send:$id=$id[0]->id_receive;
        foreach($list_user as $item){
            
            $link = "http://127.0.0.1:8000/admin/courses/detail_chat_/";
            $this->htmlUser .= "<option  value=". $link . $item->id. ">". 
              " "         
             . $item->name . " </a></option>";
        }
  
        $htmlUser = $this->htmlUser;
         $chat_receive = DB::select('select * from chat_privates where (id_send = ? and id_receive =?) or ((id_send = ? and id_receive =?))', [auth()->id(),$id,$id,auth()->id()]);
        // dd($chat_receive);

        //  $chat_send = DB::select('select * from chat_privates where id_send = ? and id_receive = ?', [auth()->id(),3]);


         // \Log::info($chat);
       
       $user = $this->user;
       //dd(auth()->user()->getMessage());
    //    foreach (auth()->user()->getMessage() as $item_noti){
    //     // echo '<pre>';
    //     // print_r(auth()->user()->get_user_send($item_noti->id_other_user));
    //     // echo '<pre>';
    //    }

      // dd($user->get_user_send(14));



        return view('admin.courses.chat_private', compact('id','chat_receive','htmlUser','user'));



    }
    public function detail_chat_for_user($id)
    {
  
    
        $list_user = db::select('select * from users where id != ?',[auth()->id()]);

       
        foreach($list_user as $item){
            $link = "http://127.0.0.1:8000/admin/courses/detail_chat_/";
            $this->htmlUser .= "<option  value=".$link . $item->id . ">   
                                  
            
            " . $item->name . "</option>";
        }
        $htmlUser = $this->htmlUser;


         $chat_receive = DB::select('select * from chat_privates where (id_send = ? and id_receive =?) or ((id_send = ? and id_receive =?))', [auth()->id(),$id,$id,auth()->id()]);
        db::update('update chat_privates set is_check = 1 where (id_send = ? and id_receive =?) ', [$id,auth()->id()]);
        if($chat_receive == []){
            $userItem = db::select('select * from users where id = ?',[$id]);    
            
        }
        else{
            $userItem='';
        }

        //  $chat_send = DB::select('select * from chat_privates where id_send = ? and id_receive = ?', [auth()->id(),3]);


         // \Log::info($chat);
       
       $user = new User();


        return view('admin.courses.chat_private', compact('chat_receive','id','userItem','htmlUser','user'));



    }

    public function send_message_course($id_course){
        
        try {
            //dd($message);

            $user = db::select('select * from users where id = ?',[auth()->id()]);
            if ($_SERVER['REQUEST_METHOD'] === 'POST') 
            { 
               
                $name = $_POST['content'];}
                // Xử lý dữ liệu (ví dụ: lưu vào cơ sở dữ liệu, gửi email, v.v.) // ... 
                // Trả về phản hồi echo "Name: " . htmlspecialchars($name) . "<br>Email: " . htmlspecialchars($email); }
        //    $this->chat_group->where('id_send', auth()->id())->get();
        $date = Carbon::now()->toDate();  
        $dataCreate = [
            'id_send' => auth()->id(),
            'id_course_receive' => $id_course,
            'content' => $_POST['content'],
            'created_at' => $date,
            'updated_at' => $date,

           ];
           $message = $this->chat->create($dataCreate);
           MessageDelivered::dispatch($message, $user);

           //(new MessageDelivered($message));
        //   $test = chat_group::all();
       
            
            return response()->json([
                'message' => 'success',
                'code' => 200,
                
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

    public function send_message_user($id_receive){
        
        DB::beginTransaction();
        try {
          
            
           
            $user = db::select('select * from users where id = ?',[auth()->id()]);
            if ($_SERVER['REQUEST_METHOD'] === 'POST') 
            { 
               
                $name = $_POST['content'];}
                // Xử lý dữ liệu (ví dụ: lưu vào cơ sở dữ liệu, gửi email, v.v.) // ... 
                // Trả về phản hồi echo "Name: " . htmlspecialchars($name) . "<br>Email: " . htmlspecialchars($email); }
        //    $this->chat_group->where('id_send', auth()->id())->get();
        $date = Carbon::now()->toDate();   
        $dataCreate = [
            'id_send' => auth()->id(),
            'id_receive' => $id_receive,
            'content' => $_POST['content'],
            'is_check' => 0,
            'created_at'=> $date,
            'updated_at' => $date
           ];
          
           $message = $this->chat_private->create($dataCreate);
           chat_user::dispatch($message,$user);

           //(new MessageDelivered($message));
        //   $test = chat_group::all();
       
        DB::commit();
            return response()->json([
                'message' => 'success',
                'code' => 200,
                
                'name' => json_encode($name),
                'user' => $user,
                'id_receive' => $id_receive,
                'created_at' => $date
            ], 200);
            

        }
        catch (\Exception $e) {
            DB::rollBack();
            Log::error('message' . $e->getMessage() . 'Line' . $e->getLine());
            return response()->json([
                'message' => 'fail',
                'code' => 500
            ], 500);
        }
       

    }


    public function getCategory($parentId)
    {
        $data = $this->category->all();
        $recusive = new Recusive($data);
        $htmlOption = $recusive->categoryRecusive($parentId, 0);
        return $htmlOption;

    }

    public function create()
    {
        $htmlOption = $this->getCategory($parentId = '');
        $teacher = auth()->user()->list_teacher(auth()->id());
       
        foreach($teacher as $item){
            $this->htmlSelect .= "<option  value=" . $item->id . ">" . $item->name . "</option>";
        }

        $htmlteacher = $this->htmlSelect;
        return view('admin.courses.add', compact('htmlOption', 'htmlteacher'));
    }



    public function store(CoursesAddRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = $this->storageTraitUpload($request, "course_path", 'Course');
            if ($request->course_path == null) {
                $data['file_path'] = "/storage/User/3/5DtH2dgc6z0hKMs7dzRQ.jpg";

            }
          
            $dataCoursesCreate = [
                'name' => $request->name,
                'content' => $request->content,
                'user_id' => auth()->id(),
                'category_id' => $request->category_id,
                'course_image_path' => $data['file_path'],
                'cost' => $request->cost

            ];

            $courses = $this->courses->create($dataCoursesCreate);


            // $data = $this->storageTraitUpload($request, "file_path", 'Courses');
            // dd ($data);

            $courses->course_teacher()->attach(auth()->id());

            if($request->id_teacher != []){
                foreach ($request->id_teacher as $id_tea) {
                    $id[] = $id_tea;
                    }
             $courses->course_teacher()->attach($id);

            }


            if ($request->hasFile('file_path')) {
                foreach ($request->file_path as $file) {
                    $dataFile = $this->storageTraitUploadMultiple($file, 'Courses');
                    $courses->files()->create([

                        'file_path' => $dataFile['file_path'],
                        'file_name' => $dataFile['file_name']
                    ]);
                }
            }

            //insert tag

            foreach ($request->tags as $tagItem) {
                $tagInstance = $this->tags->firstOrCreate(['name' => $tagItem]);
                $tagId[] = $tagInstance->id;
            }


            $courses->course_tag()->attach($tagId);
            DB::commit();
            return redirect()->route('courses.index');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('message' . $e->getMessage() . 'Line' . $e->getLine());


        }


    }


    public function edit($id)
    {
        $courses = $this->courses->find($id);
        $htmlOption = $this->getCategory($courses->category->id);
        

        $id_teacher= [];
        foreach($courses->course_teacher as $teacher){
            $id_teacher[] = $teacher->id;
        }

        $teacher = auth()->user()->list_teacher(auth()->id());
        foreach($teacher as $item){
            if(in_array($item->id, $id_teacher)){
                $this->htmlSelect .= "<option  selected value=" . $item->id . ">" . $item->name . "</option>";
            }
            else{
                $this->htmlSelect .= "<option  value=" . $item->id . ">" . $item->name . "</option>";

            }

        }
        $htmlSelect = $this->htmlSelect;

        return view('admin.courses.edit', compact('htmlOption', 'courses', 'htmlSelect'));

    }

    public function update($id, Request $request)
    {

        try {
            DB::beginTransaction();
            $data = $this->storageTraitUpload($request, "course_path", 'User');
            if ($request->course_path == null) {
                $test = $this->courses->where('id', $id)->get('course_image_path');
                $data['file_path'] = $test[0]->course_image_path;

            }
            $dataCoursesUpdate = [
                'name' => $request->name,
                'content' => $request->content,
                'user_id' => auth()->id(),
                'category_id' => $request->category_id,
                'course_image_path' => $data['file_path'],
                'cost' => $request->cost

            ];

            $this->courses->find($id)->update($dataCoursesUpdate);
            $courses = $this->courses->find($id);




            if ($request->hasFile('file_path')) {
                $this->_file::where('courses_id', $id)->delete();
                foreach ($request->file_path as $file) {
                    $dataFile = $this->storageTraitUploadMultiple($file, 'Courses');
                    $courses->files()->create([

                        'file_path' => $dataFile['file_path'],
                        'file_name' => $dataFile['file_name']
                    ]);
                }
            }

            //dd($request->id_teacher);

            $list= db::select('select id_teacher from teacher_course where id_course = ?', [$id]);

            foreach($list as $sublist){
                $list_[] = $sublist->id_teacher;
            }
            $id_=[];
            
            if(($list != null) || ($list != [])){
                if(in_array(auth()->id(),$list_) == true  ){
                    $id_[]=auth()->id();
                   
                }
            }
            
       
            
            if($request->id_teacher != [] ){
                foreach ($request->id_teacher as $id_tea) {
                    
                    $id_[] = $id_tea;
                    }
             $courses->course_teacher()->sync($id_);

            }else{
                
                $courses->course_teacher()->sync($id_);

            }

            
            //insert tag

            foreach ($request->tags as $tagItem) {
                $tagInstance = $this->tags->firstOrCreate(['name' => $tagItem]);
                $tagId[] = $tagInstance->id;

            }


            $courses->course_tag()->sync($tagId);
            DB::commit();
            return redirect()->route('courses.index');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('message' . $e->getMessage() . 'Line' . $e->getLine());


        }



    }


    public function delete($id)
    {
        try {
            $this->courses->find($id)->delete();

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

    function search(request $request)
    {

        $_course = $this->courses;
        $user_course = $this->courses->user_course(auth()->id());
        $user_course_new = $this->courses->user_course_new(auth()->id());
        $user_course_register = $this->courses->user_course_register(auth()->id());
        $course = DB::select("select * from courses 
        inner join (SELECT  distinct c.id FROM courses as c 
                    inner join categories as cate on c.category_id = cate.id 
                    left outer join course_tags on course_tags.courses_id = c.id
                    left outer join tags on course_tags.tags_id = tags.id

                    where c.name like N'%$request->search_value%' or cate.name like  N'%$request->search_value%' or tags.name like N'%$request->search_value%' or c.content like N'%$request->search_value%'
        ) as test 
                   
        on courses.id = test.id
        ");

        for ($i = 0; $i < count($course); $i++){
            $course[$i]->status =  DB::select('select status from user_course where id_course = ? and id_user = ?', [$course[$i]->id, auth()->id()]);
        }

        return view('user.course_search',compact('user_course_register','course','user_course','_course','user_course_new'));

    }


    function search_courses_index(Request $request){
        $course = DB::select("select * from courses 
        inner join (SELECT  distinct c.id FROM courses as c 
                    inner join categories as cate on c.category_id = cate.id 
                    left outer join course_tags on course_tags.courses_id = c.id
                    left outer join tags on course_tags.tags_id = tags.id

                    where c.name like '%$request->search_value%' or cate.name like  '%$request->search_value%' or tags.name like '%$request->search_value%' or c.content like '%$request->search_value%'
        ) as test 
                   
        on courses.id = test.id
        ");
        $sliderList =Slider::all();
        $menu_list = Menu::all();
        $_course = $this->courses;
        
        return view('user.show_course_index', compact('sliderList', 'menu_list','course','_course'));

    }

    public function search_course_manage_page(Request $request){
        $courses = DB::select("select * from courses 
        inner join (SELECT  distinct c.id FROM courses as c 
                    inner join categories as cate on c.category_id = cate.id 
                    left outer join course_tags on course_tags.courses_id = c.id
                    left outer join tags on course_tags.tags_id = tags.id

                    where c.name like N'%$request->search_value%' or cate.name like  N'%$request->search_value%' or tags.name like N'%$request->search_value%' or c.content like N'%$request->search_value%'
        ) as test 
                   
        on courses.id = test.id
        ");

     

        //dd($courses_[0]);

      //  dd(db::scalar('select name from users inner join teacher_course  on users.id = teacher_course.id_teacher where id_course = ?', [1]));
        foreach($courses as $item){
           $item->name_teacher =  db::select('select name from users inner join teacher_course on users.id = teacher_course.id_teacher where id_course = ?', [$item->id]);
            $item->name_cate =  db::scalar('select name from categories where id = ?', [$item->category_id]);
          

        }

         //  Chuyển đổi mảng thành Collection 
        $collection = collect($courses); 
        // Số phần tử trên mỗi trang 
        $perPage = 5; 
        // Trang hiện tại (lấy từ request hoặc mặc định là 1) 
        $currentPage = LengthAwarePaginator::resolveCurrentPage(); 
        // Tạo đối tượng phân trang 
        $paginatedData = new LengthAwarePaginator( $collection->forPage($currentPage, $perPage), 
        $collection->count(), $perPage, $currentPage, 
        ['path' => LengthAwarePaginator::resolveCurrentPath()] );

        $courses = $paginatedData;
        
        $course_intance = new Course();


        return view ('admin.courses.course_search', compact('courses','course_intance'));
    }






}