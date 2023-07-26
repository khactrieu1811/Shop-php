<!-- Stored in resources/views/child.blade.php -->

@extends('layout.admin')

@section('title')
    <title>Add Product</title>
@endsection
@section('css')
    <link href="{{asset('vendors/select2/select2.min.css') }} " rel="stylesheet" />
    <link href="{{asset('admins/products/add/add.css')}} " rel="stylesheet" />
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('partials.content-header',['name'=>'Product','key'=>'Add'])
        <!-- /.content-header -->

        <!-- Main content -->
        <form action="{{route('products.update',['id'=>$product->id])}}" method='post' enctype="multipart/form-data">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            @csrf
                            <div class="form-group">
                                <label>Tên danh mục</label>
                                <input type="text"
                                       class="form-control"
                                       name="name"
                                       value="{{$product->name}}"
                                       placeholder="Nhập tên danh mục">
                            </div>
                            <div class="form-group">
                                <label>Gía</label>
                                <input type="text" class="form-control" value="{{$product->price}}"
                                       name="price" placeholder="nhập giá sản phẩm">
                            </div>
                            <div class="form-group">
                                <label>Ảnh đại diện</label>
                                <input type="file" class="form-control-file"
                                       name="feature_image_path">
                            </div>
                            <div class="col-md-12 feature_image_container">
                                <div class="row">
                                    <img class="feature_image" src="{{$product->feature_image_path}}" alt=""/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Ảnh chi tiết</label>
                                <input type="file" multiple
                                       class="form-control-file"
                                       name="image_path[]">
                            </div>
                            <div class="col-md-12 container_image_detail">
                                <div class="row">
                                    @foreach($product->productImages as $productImageItems)
                                    <div class="col-md-3">
                                        <img class="image_detail_product" src="{{$productImageItems->image_path}}" alt="">
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Chọn danh mục</label>
                                <select class="form-control select2_init" name="category_id">
                                    <option value="">Chọn danh mục</option>
                                    {!! $htmlOption !!}
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Nhập tags cho sản phẩm</label>
                                <select name="tags[]" class="form-control tags_select_choose" multiple="multiple">
                                @foreach($product->tags as $tagitem)
                                    <option value="{{$tagitem->name}}" selected>{{$tagitem->name}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nhập nội dung</label>
                                <textarea name="contents" id="editor_init"
                                          class="form-control" rows="5">{{$product->content}}</textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
        </form>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
@section('js')
    <script src="{{asset('vendors/select2/select2.min.js')}}"></script>
    <script src="{{asset('admins/tinymce/tinymce.min.js')}}" referrerpolicy="origin"></script>
    <script src="{{asset('admins/products/add/add.js')}}"></script>
@endsection
