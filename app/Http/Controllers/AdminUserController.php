<?php

namespace App\Http\Controllers;

use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\roles;

class AdminUserController extends Controller
{
    //

    use StorageImageTrait;
    private $user;
    private $role,$htmlUser;

    public function __construct(User $user, roles $roles)
    {
        $this->user = $user;
        $this->role = $roles;
    }
    public function index()
    {
        $userList = $this->user->paginate(10);
        return view('admin.users.index', compact('userList'));
    }
    public function create()
    {
        $roles = $this->role->all();

        return view('admin.users.add', compact('roles'));


    }



    public function store(UserRequest $request)
    {
      try {
            DB::beginTransaction();
            $data = $this->storageTraitUpload($request, "avatar_path", 'User');
            $dataSettingCreate = [
              
                'name' => $request->name,
                'email' => $request->email,
                'password'=> Hash::make($request->pass),
                'avatar_image_path' => $data['file_path'],
            ];
            
            $user = $this->user->create($dataSettingCreate);

            $user->roles()->attach($request->role_id);

           DB::commit();
            return redirect()->route('users.index');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('message' . $e->getMessage() . 'Line' . $e->getLine());


        }


    }

   

    public function edit($id)   
    {
        $user = $this->user->find($id);
        $roles = $this->role->all();
        
       
        
        
        return view('admin.users.edit', compact( 'user','roles'));



    }

    public function update($id, UserRequest $request)
    {
        //dd($request->all());
        
        try {
            $data = $this->storageTraitUpload($request, "avatar_path", 'User');
            if($request->avatar_path == null){
                $test  = $this->user->where('id',$id)->get('avatar_image_path');
                $data['file_path'] = $test[0]->avatar_image_path;         
    
            }          
            $dataSettingUpdate = [
              
                'name' => $request->name,
                'email' => $request->email,
                'password'=> Hash::make($request->pass),
                'avatar_image_path' => $data['file_path'],
            ];

            $user_ = $this->user->find($id);
            $this->user->find($id)->update($dataSettingUpdate);
            $user_->roles()->sync($request->role_id);
            DB::commit();
            return redirect()->route('users.index');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('message' . $e->getMessage() . 'Line' . $e->getLine());


        }



    }


    public function delete($id)
    {
        try {
            $this->user->find($id)->delete();

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

    public function detail_chat()
    {
        //dd($this->user->getMessage());
        $list_user = db::select('select * from users where id != ?',[auth()->id()]);

       $id=14;
       
       $id = db::select('select top 1 id_send, id_receive from chat_privates
        where (id_send = ? ) or (id_receive =?) order by created_at desc',[auth()->id(), auth()->id()]);
       
       // dd (auth()->user()->getMessage());
       $id = ($id[0]->id_send != auth()->id())?$id=$id[0]->id_send:$id=$id[0]->id_receive;
      
      //dd(auth()->user()->getMessage());
        foreach($list_user as $item){
            
            $link = "http://127.0.0.1:8000/admin/users/detail_chat_/";
            $this->htmlUser .= "<option  value=". $link . $item->id. ">". 
              " "
            
             . $item->name . " </a></option>";
        }
  
        $htmlUser = $this->htmlUser;
         $chat_receive = DB::select('select * from chat_privates where (id_send = ? and id_receive =?) or ((id_send = ? and id_receive =?))', [auth()->id(),$id,$id,auth()->id()]);
     
       
       $user = new User();


        return view('user.chat_user', compact('id','chat_receive','htmlUser','user'));



    }
    public function detail_chat_for_user($id)
    {
  
        $list_user = db::select('select * from users where id != ?',[auth()->id()]);

       
        foreach($list_user as $item){
            $link = "http://127.0.0.1:8000/admin/users/detail_chat_/";
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


        return view('user.chat_user', compact('chat_receive','id','userItem','htmlUser','user'));



    }


    
}
