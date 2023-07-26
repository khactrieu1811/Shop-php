<?php

namespace App\Http\Controllers;

use App\Category;
use App\components\Recusive;
use App\Product;
use App\ProductImage;
use App\ProductTag;
use App\Tag;
use App\Traits\DeleteModelTrait;
use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Storage;
use DB;
use App\Http\Requests\ProductAddRequest;
class AdminProductController extends Controller
{
    use StorageImageTrait, DeleteModelTrait;
    private $product;
    private $category;
    private $productTag;
    private $tag;
    private $productImage;
    public function __construct(Category $category, Product $product, ProductImage  $productImage,
    Tag $tag, ProductTag $productTag)
    {
        $this->product = $product;
        $this->category = $category;
        $this->productImage = $productImage;
        $this->productTag = $productTag;
        $this->tag = $tag;
    }

    public function index(){
        $products = $this->product->latest()->paginate(5);
        return view('admin.products.index', compact('products'));
    }
    public function getProduct(){
        $data = $this->product->all();

    }
    public function getCategory($parentId){
        $data = $this->category->all();
        $recusive = new Recusive($data);
        $htmlOption = $recusive->categoryRecusive($parentId);
        return $htmlOption;
    }
    public function create(){
        $htmlOption = $this->getCategory($parentId='');
        return view('admin.products.add', compact('htmlOption'));
    }
    public function store(ProductAddRequest $request){
        //bắt lổi toàn vẹn dữ liệu
        DB::beginTransaction();
        try{
            $dataProductCreate = [
                'name' => $request->name,
                'price' => $request->price,
                'content' => $request->contents,
                'user_id' => auth()->id(),
                'category_id' => $request->category_id,
            ];
            $dataUploadFeatureImage = $this->storageTraitUpload($request, 'feature_image_path','products');
            if(!empty($dataUploadFeatureImage)){
                $dataProductCreate['feature_image_name'] = $dataUploadFeatureImage['file_name'];
                $dataProductCreate['feature_image_path'] = $dataUploadFeatureImage['file_path'];
            }
            $product = $this->product->create($dataProductCreate);
            //Insert data to product_images
            if($request->hasFile('image_path')){
                foreach ($request->image_path as $fileItem){
                    $dataProductImageDetail = $this->storageTraitUploadMutiple($fileItem,'products');
                    //1-n
                    $product->images()->create([
                        'image_path' => $dataProductImageDetail['file_path'],
                        'image_name' => $dataProductImageDetail['file_name']
                    ]);
                }
            }
            //Insert tags for product
            if(!empty($request->tags)){
                foreach($request->tags as $tagItem){
                    //insert to tags firsOrcreate dùng để lưu tags không trùng nhau
                    $tagInstance = $this->tag->firstOrCreate(['name' => $tagItem]);
                    $tagIds[] = $tagInstance->id;
                }
            }
            //n-n
            $product->tags()->attach($tagIds);
            DB::commit();
            return redirect()->route('products.index');
        }catch (\Exception $exception){
            DB::rollBack();
            Log::error('Message: '.$exception->getMessage().'line : '. $exception->getLine());
        }
    }
    public function edit($id){
        $product = $this->product->find($id);
        $htmlOption = $this->getCategory($product->category_id);
        return view('admin.products.edit',compact('htmlOption', 'product'));
    }
    public function update(Request $request,$id){
        DB::beginTransaction();
        try{
            $dataProductUpdate = [
                'name' => $request->name,
                'price' => $request->price,
                'content' => $request->contents,
                'user_id' => auth()->id(),
                'category_id' => $request->category_id,
            ];
            $dataUploadFeatureImage = $this->storageTraitUpload($request, 'feature_image_path','products');
            if(!empty($dataUploadFeatureImage)){
                $dataProductUpdate['feature_image_name'] = $dataUploadFeatureImage['file_name'];
                $dataProductUpdate['feature_image_path'] = $dataUploadFeatureImage['file_path'];
            }
            $this->product->find($id)->update($dataProductUpdate);
            $product = $this->product->find($id);
            //Insert data to product_images
            if($request->hasFile('image_path')){
                $this->productImage->where('product_id', $id)->delete(); // xóa bảng củ r thêm lại
                foreach ($request->image_path as $fileItem){
                    $dataProductImageDetail = $this->storageTraitUploadMutiple($fileItem,'products');
                    //1-n
                    $product->images()->create([
                        'image_path' => $dataProductImageDetail['file_path'],
                        'image_name' => $dataProductImageDetail['file_name']
                    ]);
                }
            }
            //Insert tags for product
            if(!empty($request->tags)){
                foreach($request->tags as $tagItem){
                    //insert to tags firsOrcreate dùng để lưu tags không trùng nhau
                    $tagInstance = $this->tag->firstOrCreate(['name' => $tagItem]);
                    $tagIds[] = $tagInstance->id;
                }
            }
            //n-n
            $product->tags()->sync($tagIds); // syn để nhận bết k trùng thì thêm
            DB::commit();
            return redirect()->route('products.index');
        }catch (\Exception $exception){
            DB::rollBack();
            Log::error('Message: '.$exception->getMessage().'line : '. $exception->getLine());
        }
    }
    public function delete($id){
        return $this->deleteModelTrait($id, $this->product);
    }
}
