<?php

namespace App\Http\Controllers;

use App\Http\Requests\SliderAddRequest;
use App\Slider;
use App\Traits\DeleteModelTrait;
use Illuminate\Http\Request;
use App\Http\Request\SlierAddRequest;
use App\Traits\StorageImageTrait;
use SebastianBergmann\Diff\Exception;

class SliderAdminController extends Controller
{
    use StorageImageTrait, DeleteModelTrait;
    private $slider;
    public function __construct(Slider $slider){
        $this->slider = $slider;
    }
    public function index(){
        $sliders = $this->slider->latest()->paginate(5);
        return view('admin.sliders.index', compact('sliders'));
    }
    public function create(){
        return view('admin.sliders.add');
    }
    public function store(SliderAddRequest $request){
        try{
            $dataInsert = [
                'name' => $request->name,
                'description' => $request->description
            ];
            $dataImageSlider = $this->storageTraitUpload($request, 'image_path', 'sliders');
            if(!empty($dataImageSlider)){
                $dataInsert['image_name'] = $dataImageSlider['file_name'];
                $dataInsert['image_path'] = $dataImageSlider['file_path'];
            }
            //dd($dataInsert);
            $this->slider->create($dataInsert);
            return redirect()->route('sliders.index');
        }catch (Exception $exception){
            Log::error('lỗi :'.$exception->getMessage().'--line' . $exception->getLine());
        }
    }
    public function edit($id){
        $sliders = $this->slider->find($id);
        return view('admin.sliders.edit', compact('sliders'));
    }
    public function update($id, Request $request){
        try{
            $dataUpdate = [
                'name' => $request->name,
                'description' => $request->description
            ];
            $dataImageSlider = $this->storageTraitUpload($request, 'image_path', 'sliders');
            if(!empty($dataImageSlider)){
                $dataUpdate['image_name'] = $dataImageSlider['file_name'];
                $dataUpdate['image_path'] = $dataImageSlider['file_path'];
            }
            //dd($dataInsert);
            $this->slider->find($id)->update($dataUpdate);
            return redirect()->route('sliders.index');
        }catch (Exception $exception){
            Log::error('lỗi :'.$exception->getMessage().'--line' . $exception->getLine());
        }
    }
    public function delete($id){
        return $this->deleteModelTrait($id, $this->slider);
    }
}
