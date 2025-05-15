<?php


namespace App\Components;

use App\Models\Menu;

class MenuRecusive
{
    private $html;
    public function __construct(){
        $this->html = "";


    }

    public function menuRecusiveAdd($parent_Id_Edit, $parent_Id = 0, $subMark ='' ){
        
        $data = Menu::where('parent_id', $parent_Id)->get();
        foreach($data as $value){

            if(!empty($parent_Id_Edit) && $parent_Id_Edit == $value['id'] ){
                $this->html .= "<option selected value=" . $value['id'] . ">" . $subMark . $value['name'] . "</option>";
            }
            if($parent_Id_Edit != $value['id']){
                $this->html .= "<option  value=" . $value['id'] . ">" . $subMark . $value['name'] . "</option>";

            }
           
              $this->menuRecusiveAdd($parent_Id_Edit,$value->id, $subMark . '--');      
        }
        
        return $this->html;



    }


}