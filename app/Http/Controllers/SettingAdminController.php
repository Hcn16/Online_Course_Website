<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SettingAddRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Http\trait\StorageImageTrait;

use App\Models\settings;

class SettingAdminController extends Controller
{
    
    private $_setting;

    public function __construct(settings $setting)
    {
        $this->_setting = $setting;
    }
    public function index()
    {
        $settingList = $this->_setting->paginate(10);
        return view('admin.settings.index', compact('settingList'));
    }
    public function create()
    {



        return view('admin.settings.add');


    }



    public function store(SettingAddRequest $request)
    {

       

        try {
            DB::beginTransaction();
            $dataSettingCreate = [
              
                'config_key' => $request->config_key,
                'config_value' => $request->config_value,
                'type_settings'=> $request->type
            ];

            $this->_setting->create($dataSettingCreate);

           DB::commit();
            return redirect()->route('settings.index');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('message' . $e->getMessage() . 'Line' . $e->getLine());


        }


    }


    public function edit($id)
    {
        $setting = $this->_setting->find($id);
        
        return view('admin.settings.edit', compact( 'setting'));



    }

    public function update($id, SettingAddRequest $request)
    {

        //dd($request->all());
        try {
           
            DB::beginTransaction();
            $dataSettingUpdate = [
              
                'config_key' => $request->config_key,
                'config_value' => $request->config_value,
            ];
 
            



            $setting = $this->_setting->find($id)->update($dataSettingUpdate);




            DB::commit();
            return redirect()->route('settings.index');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('message' . $e->getMessage() . 'Line' . $e->getLine());


        }



    }


    public function delete($id)
    {
        try {
            $this->_setting->find($id)->delete();

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
