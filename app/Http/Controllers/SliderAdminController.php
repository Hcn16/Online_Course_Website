<?php

namespace App\Http\Controllers;

use App\Models\Slider;

use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use App\Http\Requests\SliderAddRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SliderAdminController extends Controller
{
    //
    private $slider;
    use StorageImageTrait;
    public function __construct(Slider $slider)
    {
        $this->slider = $slider;
    }
    public function index()
    {
        $sliderList = $this->slider->paginate(10);
        return view('admin.sliders.index', compact('sliderList'));
    }
    public function create()
    {



        return view('admin.sliders.add');


    }



    public function store(SliderAddRequest $request)
    {

        try {
            DB::beginTransaction();
            $dataSliderCreate = [
                'name' => $request->name,
                'description' => $request->description,
            ];

            
            
                    $filename = $request->file_path;
                    
                    $dataFile = $this->storageTraitUpload($request, ('file_path'), 'Slider');
                    $dataSliderCreate['image_path'] = $dataFile['file_path'];
                    $dataSliderCreate['image_name'] = $dataFile['file_name'];
                
            



            $slider = $this->slider->create($dataSliderCreate);




            DB::commit();
            return redirect()->route('sliders.index');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('message' . $e->getMessage() . 'Line' . $e->getLine());


        }


    }


    public function edit($id)
    {
        $slider = $this->slider->find($id);
        
        return view('admin.sliders.edit', compact( 'slider'));



    }

    public function update($id, SliderAddRequest $request)
    {

        //dd($request->all());
        try {
            DB::beginTransaction();
            $dataSliderUpdate = [
                'name' => $request->name,
                'description' => $request->description,
            ];

            
            
                    $filename = $request->file_path;
                    
                    $dataFile = $this->storageTraitUpload($request, ('file_path'), 'Slider');
                    $dataSliderCreate['image_path'] = $dataFile['file_path'];
                    $dataSliderCreate['image_name'] = $dataFile['file_name'];
                
            



            $slider = $this->slider->find($id)->update($dataSliderUpdate);




            DB::commit();
            return redirect()->route('sliders.index');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('message' . $e->getMessage() . 'Line' . $e->getLine());


        }



    }


    public function delete($id)
    {
        try {
            $this->slider->find($id)->delete();

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

