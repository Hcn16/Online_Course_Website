<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Http\Requests\SettingAddRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;



use App\Models\permission;

class PermissionsController extends Controller
{





    private $_permission;
    private $_permission_role;



    public function __construct(permission $permission)
    {

        $this->_permission = $permission;

    }
    public function index()
    {
        $permissionList = $this->_permission->paginate(10);
        return view('admin.permissions.index', compact('permissionList'));
    }
    public function create()
    {
        return view('admin.permissions.add');
    }



    public function store(Request $request)
    {
        try {
            $check = false;$check2=false;

            $test = $this->_permission->All(['id', 'name', 'parent_id'])->where('parent_id', 0);
           
            foreach ($test as $key){
               
                if ($key->name == ($request->module) ){
                    $check = true;
                    $id_module = $key->id;

            } 
        }

       

        if($check == false) {
            $dataSettingCreate = [

                'name' => $request->module,
                'description_name' => $request->module,
                'parent_id' => 0

            ];
            $permission = $this->_permission->create($dataSettingCreate);

        }
        else{
            $permission = $this->_permission->find( $id_module);
            $childrens = $this->_permission->where('parent_id', $id_module)->get(columns: ['name']);
           
            foreach ($childrens as $children){
               
                foreach ($request->item_permission as $item_permission) {
                    if ($item_permission == ($children->name)  ){   
                        $check2 = true;                       
                } 
                }              

        }
    }

   
    
            
              //dd($dataSettingCreate);
            //dd($request->item_role);
            if ($check2 == false) {
            if(!empty($request->item_permission) ){
                foreach ($request->item_permission as $item_permission) {
                    $dataSettingItemCreate = [
    
                        'name' => $item_permission,
                        'description_name' => $request->module . '_' . $item_permission,
                        'parent_id' => $permission->id,
                        'key_code' => $request->module . '_' . $item_permission
    
    
                    ];
    
                    $this->_permission->create($dataSettingItemCreate);
                }

            }}

            

            
            DB::commit();
            return redirect()->route('permissions.index');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('message' . $e->getMessage() . 'Line' . $e->getLine());
        }


    }


    public function edit($id)
    {
        $permissions = $this->_permission->where('parent_id', 0)->get();

        $role = $this->_permission->find($id);

        return view('admin.permissions.edit', compact('role', 'permissions', 'permission_role'));



    }

    public function update($id, Request $request)
    {

        //dd($request->all());
        try {

            $dataSettingUpdate = [

                'name' => $request->name,
                'description_name' => $request->description_name,

            ];



            $this->_permission->find($id)->update($dataSettingUpdate);





            DB::commit();
            return redirect()->route('permissions.index');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('message' . $e->getMessage() . 'Line' . $e->getLine());


        }






    }


    public function delete($id)
    {
        try {
            $this->_permission->find($id)->delete();

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