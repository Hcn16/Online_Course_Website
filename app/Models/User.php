<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use Carbon\Traits\Timestamp;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Type\Integer;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     * 
     * 
     * 
     * 
     */

    use SoftDeletes;
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar_image_path'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function roles()
    {
        return $this->belongsToMany(roles::class, 'role_user', 'user_id', 'role_id')->withTimestamps();
    }

    public function manage_course()
    {
        return $this->belongsToMany(Course::class, 'teacher_course', 'id_teacher', 'id_course')->withTimestamps();

        // return Db::select('select id_course from teacher_course where id_teacher = ?',[auth()->id()]);
    }

    public function register_course($a1,$a2,$a3){
        return DB::insert('INSERT INTO user_course (id_user, id_course,status) VALUES (('.$a1.'),('.$a2.'),('.$a3.'));');

    }
 

    public  function callProcedure($param1)
    {
        return DB::select('call Get_name_user2('.$param1.')');
    }

    public function get_submit_exercise($param1, $param2){
        return DB::scalar('select count (distinct (se.id_exercise)) from exercises as e inner join score_exercises as se 
        on e.id = se.id_exercise where e.id_course = ? and se.id_user_do = ? ', [$param1, $param2]);
    }
    public function getTeacher(){
        return DB::SELECT('select t.* from users as t inner join role_user ru on t.id = ru.user_id where ru.role_id = 4');
    }
    
    public function list_teacher($id_teacher){
        return DB::SELECT('select t.* from users as t inner join role_user ru on t.id = ru.user_id where ru.role_id = 4 and t.id != ?', [$id_teacher]);
    }

    public function get_user_send($param){
        $date = Carbon::createFromFormat('Y-m-d H:i:s', '2025-01-12 22:08:00');
        return (DB::SELECT('select * from users  where id = ?', [$param]) ) ;
    }

    public function totalCourse($param){
        return DB::scalar('select count(*)  from teacher_course where id_teacher = ?', [$param]);

    }

    public function get_New_Pass($email){
        $new_pass = "";

        //dd(db::select('select password from users where email = ?',[$email]));
        if(db::select('select password from users where email = ?',[$email])  == []){
            return $new_pass ="";

        }
        else{
            $new_pass = rand(10000,99999);
            $hash_pass = Hash::make($new_pass);

         db::update('update  users set password  = ? where email = ?',[$hash_pass, $email]);
         return $new_pass;

        }
        
    }

    public function learner_total_course_wait(){
        return DB::scalar('select count(*)  from user_course  where id_user = ? and status = 0 ', [auth()->id()]);

    }

    public function learner_total_course_registed (){
        return DB::scalar('select count(*)  from user_course  where id_user = ? and status = 1 ', [auth()->id()]);


    }

    public function learner_check_pass($inputPassword){
        $storedHash = auth()->user()->password;
        if (Hash::check($inputPassword, $storedHash)) 
        {return true; }     
        
        else { return false; }
    }

    public function learner_total_course_complete (){
        

    }


    public function getNotificate(){
        $notificate = db::select('select * from notificate where id_user_receive = ? order by created_at',[auth()->id()]);
        foreach($notificate as $noti){
            $noti->created_at = Carbon::parse($noti->created_at);
        }
        return $notificate;

    }

    public function check_noti(){
        return  db::select('select top 1 is_check from notificate where id_user_receive = ? order by is_check asc',[auth()->id()]);


    }

    public function getContent_created_at($id_receive){
        $content=[];
        $content =  db::select('
select top 1 SUBSTRING(content, 1,10 ) as content , created_at  from chat_privates where (id_send =? and id_receive = ?) or (id_send = ? and id_receive = ? ) order by created_at desc', [auth()->id(),$id_receive, $id_receive, auth()->id()]);
        if($content != []){
            foreach($content as $item){
                $dateString =  $item->created_at;
                $dateString = trim($dateString); // Loại bỏ khoảng trắng ở đầu và cuối chuỗi 
                $item->created_at = Carbon::createFromFormat('Y-m-d H:i:s.u', $dateString);
                $item->created_at->roundSecond();

                
            }
            return $content;

        }
        else{
            
            
            $dateString =  Carbon::now();
            $date = ($dateString->format('Y-m-d H:i:s'));
            $date = Carbon::createFromFormat('Y-m-d H:i:s', $date);
            //dd($date);
           
           
            return $date;
        }
    }

    public function is_check($id_receive){
        $is_check_=[];
        $is_check_ =  db::select('
        select id  from chat_privates where ( (id_send = ? and id_receive = ? )) and (is_check=0) order by created_at desc', [ $id_receive, auth()->id()]);
        return $is_check_;

    }

    

    public function sum_not_receive(){
        $sum=0;
        $sum =  db::scalar('
        select count(*)  from chat_privates where ( ( id_receive = ? )) and (is_check=0) ', [  auth()->id()]);
        return ( $sum);
    }

    public function sum_request(){
        $sum = 0;
        $sum = db::scalar('select count(*) from user_course where status = 0 and id_course in (select id_course from teacher_course where id_teacher = ?  )',[auth()->id()]);
        return $sum;
    }

    public function top3_message(){
        // $id = db::select('select distinct top 3 view1.id_send from (select  TOP 100 PERCENT id_send  from chat_privates
        // where  id_receive =? order by created_at desc) as view1 ',[auth()->id()]);
    
        
        $count =0;
        $id=[];
        foreach($this->getMessage() as $item){
            $id[] = $item->id_other_user;
            $count++;
            if($count == 3){
                break;
            }
        }
        return($id);
    }

    public function getMessage(){
        $list =  db::select('select distinct(id_other_user)  from 
((select  distinct(id_receive) as id_other_user from chat_privates where id_send = ? ) 
union
(select  distinct(id_send) as id_other_user from chat_privates where id_receive  = ? ) ) as t',[auth()->id(),auth()->id(),auth()->id()]);

        foreach($list as $item ){
            $get_content = $this->getContent_created_at($item->id_other_user);
            
            $item->content = $this->getContent_created_at($item->id_other_user)[0]->content;
            $item->created_at =  $this->getContent_created_at($item->id_other_user)[0]->created_at;

        }

        //dd($list[0]->created_at);
        usort($list, function ($a, $b) { 
            return  $b->created_at->timestamp - $a->created_at->timestamp;
        });

        return ($list);

    }

    

    public function checkPermissionAccess($permissionCheck)
    {


        $roles = auth()->user()->roles;



        foreach ($roles as $role) {
            $permissions = $role->permission_role;

            if ($permissions->contains('key_code', $permissionCheck)) {

                return true;
            }
        }
        return false;


    }
}