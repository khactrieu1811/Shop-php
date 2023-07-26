<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $fillable=['name','price','feature_image_path','content','user_id','category_id','feature_image_name'];
    //1 nhiều
    public function images(){
        return $this->hasMany(ProductImage::class,'product_id');
    }
    //n-n
    public function tags(){
        return $this
            ->belongsToMany(Tag::class,'product_tags','product_id', 'tag_id')
            ->withTimestamps();
    }
    //product n-1 category
    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
    // sp1 - n img
    public function productImages(){
        return $this->hasMany(ProductImage::class,'product_id');
    }
}
