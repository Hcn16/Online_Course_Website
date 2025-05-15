<?php

namespace App\Http\Controllers;

use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\section;
use App\Models\Course;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SectionController extends Controller
{

    use StorageImageTrait;
    private $_section;
    private $_course;

    public $test;

    public function __construct(section $section, Course $course)
    {
        $this->_section = $section;
        $this->_course = $course;




    }
    public function index(Request $request)
    {

        $id_course = ($request->id_course);



        $sectionList = $this->_section->orderBy('name_section')->where('id_course', $id_course)->paginate(10);


        return view("admin.sections.index", compact('sectionList', 'id_course'));
    }


    public function create(Request $request)
    {

        $id_course = ($request->id_course);

        return view("admin.sections.add", compact('id_course'));
    }

    public function store(Request $request)
    {

        try {
            DB::beginTransaction();


            $dataSettingCreate = [
                'name_section' => $request->name,
                'content' => $request->content,
                'id_course' => $request->id_course,
            ];


            $section = $this->_section->create($dataSettingCreate);

            if ($request->hasFile('file_path')) {
                foreach ($request->file_path as $file) {
                    $dataFile = $this->storageTraitUploadMultiple($file, 'Courses');
                    $section->files()->create([

                        'file_path' => $dataFile['file_path'],
                        'file_name' => $dataFile['file_name'],
                        'type_file' => 'file'
                    ]);
                }
            }

            if ($request->hasFile('video_path')) {
                foreach ($request->video_path as $video) {
                    $dataFile = $this->storageTraitUploadMultiple($video, 'Courses');
                    $section->files()->create([

                        'file_path' => $dataFile['file_path'],
                        'file_name' => $dataFile['file_name'],
                        'type_file' => 'video'
                    ]);
                }
            }


            DB::commit();

            $id_course = ($request->id_course);

            $sectionList = $this->_section->paginate(10);

            return redirect()->route('sections.index', ['id_course' => $id_course]);
            //return view("admin.sections.index", compact('sectionList','id_course'));


        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('message' . $e->getMessage() . 'Line' . $e->getLine());


        }

    }

    public function edit($id, Request $request)
    {
        $section = $this->_section->find($id);


        return view('admin.sections.edit', compact('section'));


    }

    public function update($id, $id_course, Request $request)
    {


        try {


            DB::beginTransaction();

            // dd($request->all());
            $file_id = db::select("select id from courses_files where id_section = ? and type_file='file' ", [$id]);
            $video_id = DB::select("select id from courses_files where id_section = ? and type_file='video' ", [$id]);
            //  dd($file_id[0]->id);
            $file = [];
            $video =[];
            for ($i = 0; $i < sizeof($file_id); $i++) {
                $file[] = $file_id[$i]->id;
            }

            for ($i = 0; $i < sizeof($video_id); $i++) {
                $video[] = $video_id[$i]->id;
            }
            //  dd($file);

            if ($request->video_added != []) {
                $result_video_delete = array_diff($video, $request->video_added);
            } else {
                $result_video_delete = $video;
            }

            if ($request->file_added != []) {
                $result_file_delete = array_diff($file, $request->file_added);
            } else {
                $result_file_delete = $file;
            }
            $result_video_delete = array_values($result_video_delete);
            $result_file_delete = array_values($result_file_delete);

       

            //  dd($result_video_delete);

            $this->_section->find($id)->update([
                'name_section' => $request->name,
                'id_course' => $id_course,
                'content' => $request->content

            ]);

            $section = $this->_section->find($id);
           
            if ($result_file_delete != []) {
                for ($i = 0; $i < sizeof($result_file_delete); $i++) {
                    db::delete("delete  from courses_files where id = ?  ", [$result_file_delete[$i]]);



                }
            }

            if ($result_video_delete != []) {
                for ($j = 0; $j < sizeof($result_video_delete); $j++) {
                   db::delete("delete from courses_files where id = ?  ", [$result_video_delete[$j]]);

                


                }

            }

            if ($request->hasFile('file_path')) {
                foreach ($request->file_path as $file) {
                    $dataFile = $this->storageTraitUploadMultiple($file, 'Courses');
                    $section->files()->create([

                        'file_path' => $dataFile['file_path'],
                        'file_name' => $dataFile['file_name'],
                        'type_file' => 'file'
                    ]);
                }
            }

            if ($request->hasFile('video_path')) {
                foreach ($request->video_path as $video) {
                    $dataFile = $this->storageTraitUploadMultiple($video, 'Courses');
                    $section->files()->create([

                        'file_path' => $dataFile['file_path'],
                        'file_name' => $dataFile['file_name'],
                        'type_file' => 'video'
                    ]);
                }
            }




            DB::commit();
            return redirect()->route('sections.index', compact('id_course'));

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('message' . $e->getMessage() . 'Line' . $e->getLine());


        }


    }

    public function delete($id)
    {

        //return redirect()->route('sections.index');

        try {
            $this->_section->find($id)->delete();

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
