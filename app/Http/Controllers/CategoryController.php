<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Components\Recusive;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    //
    private $category;
    public function __construct(Category $category){
        $this->category = $category;
    }

    public function getCategory($parentId){
        $data = $this->category->all();
        $recusive = new Recusive($data);
        $htmlOption = $recusive->categoryRecusive($parentId); 
        return $htmlOption;

    }

    public function create(){
       

        $htmlOption = $this->getCategory($parentId = '' );
        return view('admin.category.add', compact('htmlOption'));
        

    }

    

    public function store(Request $request){
        $this->category->create([
            'name' => $request->name,
            'parent_id'=> $request->parent_id,
            'slug' =>str::slug($request->name)
            


        ]);
       return redirect()->route('categories.index');
        

    }

    public function index(){
        $categories = $this->category->latest()->paginate(5);
        return view('admin.category.index', compact('categories'));
        

    }

    public function edit($id){
        $category = $this->category->find($id);
        $htmlOption = $this->getCategory($category->parent_id);
        
        return view('admin.category.edit', compact('category', 'htmlOption'));
        


    }

    public function update($id, Request $request){
        $this->category->update([
            'name' => $request->name,
            'parent_id'=> $request->parent_id,
            'slug' =>str::slug($request->name)
            


        ]);
       return redirect()->route('categories.index');
        

    }


    
    public function delete($id){
        $this->category->find((int)$id)->delete();
        return redirect()->route('categories.index');

    }







}
