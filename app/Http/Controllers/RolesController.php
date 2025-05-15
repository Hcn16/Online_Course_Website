<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\SettingAddRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;



use App\Models\roles;
use App\Models\permission;
use App\Models\permission_role;

class RolesController extends Controller
{
    //
    private $_role;
    private $_permission;
    private $_permission_role ;



    public function __construct(roles $role, permission $permission,permission_role $_permission_role)
    {
        $this->_role = $role;
        $this->_permission = $permission;
        $this->_permission_role = $_permission_role;
    }
    public function index()
    {
        $roleList = $this->_role->paginate(10);
        return view('admin.roles.index', compact('roleList'));
    }
    public function create()
    {
       
        $permissions = $this->_permission->where('parent_id', 0)->get();
        return view('admin.roles.add', compact('permissions'));


    }



    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $dataSettingCreate = [
             
                'name' => $request->name,
                'description_name' => $request->description_name,
                
            ];

            //dd($dataSettingCreate);
            //dd($request->item_role);
           $role = $this->_role->create($dataSettingCreate);
           $role->permission_role()->attach($request->item_role);



           DB::commit();
            return redirect()->route('roles.index');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('message' . $e->getMessage() . 'Line' . $e->getLine());


        }


    }


    public function edit($id)
    {
        $permissions = $this->_permission->where('parent_id', 0)->get();
      
        $role = $this->_role->find($id);
        $permission_role = $this->_permission_role->where('role_id',$id)->get();       
        return view('admin.roles.edit', compact( 'role','permissions','permission_role'));



    }

    public function update($id, Request $request)
    {

        //dd($request->all());
        try {
           
            $dataSettingUpdate = [
              
                'name' => $request->name,
                'description_name' => $request->description_name,
                
            ];           
            $role = $this->_role->find($id);
             $this->_role->find($id)->update($dataSettingUpdate);
            $role->permission_role()->sync($request->item_role);
            DB::commit();
            return redirect()->route('roles.index');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('message' . $e->getMessage() . 'Line' . $e->getLine());
        }
    }


    public function delete($id)
    {
        try {
            $this->_role->find($id)->delete();

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
