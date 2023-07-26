<?php

namespace App\components;
Use App\Menu;
class MenuRecusive{
    private $html;
    public function __construct(){
        $this->html = '';
    }
    public function menuRecusiveAdd($parentId = 0, $subMark=''){
        $data = Menu::where('parent_id', $parentId)->get();
        foreach ($data as $dataItems){
            $this->html .= '<option value="'.$dataItems->id.'">'.$subMark.$dataItems->name.'</option>';
            $this->menuRecusiveAdd($dataItems->id,$subMark.'--');
        }
        return $this->html;
    }
    public function menuRecusiveEdit($MenuParentId, $parentId = 0, $subMark=''){
        $data = Menu::where('parent_id', $parentId)->get();
        foreach ($data as $dataItems){
            if($MenuParentId == $dataItems->id){
                $this->html .= '<option selected value="'.$dataItems->id.'">'.$subMark.$dataItems->name.'</option>';
            }else{
                $this->html .= '<option value="'.$dataItems->id.'">'.$subMark.$dataItems->name.'</option>';
            }
            $this->menuRecusiveEdit($MenuParentId, $dataItems->id,$subMark.'--');
        }
        return $this->html;
    }
}
