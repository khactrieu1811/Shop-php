<!-- Stored in resources/views/child.blade.php -->

@extends('layout.admin')

@section('title')
    <title>Menu</title>
@endsection
@section('css')
    <link href="{{asset('admins/sliders/index/list.css')}}" rel="stylesheet"/>
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('partials.content-header',['name'=>'menus','key'=>'List'])

        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <a href="{{route('sliders.create')}}" class="btn btn-success float-right m-2">Add</a>
                    </div>
                    <div class="col-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên menu</th>
                                <th scope="col">description</th>
                                <th scope="col">hình ảnh</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sliders as $sliderItem)
                                <tr>
                                    <th scope="row">{{$sliderItem->id}}</th>
                                    <td>{{$sliderItem->name}}</td>
                                    <td>{{$sliderItem->description}}</td>
                                    <td>
                                        <img class="slider_image_150_200" src="{{$sliderItem->image_path}}"alt="">
                                    </td>
                                    <td>
                                        <a href="{{route('sliders.edit',['id'=>$sliderItem->id])}}" class="btn btn-default">Edit</a>
                                        <a href=""
                                           data-url="{{route('sliders.delete',['id'=>$sliderItem->id])}}"
                                           class="btn btn-danger action_delete">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class='col-md-12'>
                        {{$sliders->links()}}
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{asset('admins/main.js')}}"></script>
@endsection
