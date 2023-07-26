<!-- Stored in resources/views/child.blade.php -->

@extends('layout.admin')

@section('title')
    <title>Settings</title>
@endsection
@section('css')
    <link href="{{asset('admins/settings/index/list.css')}}" rel="stylesheet"/>
@endsection


@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('partials.content-header',['name'=>'sttings','key'=>'List'])
        <!-- /.content-header -->
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="btn-group float-right">
                            <button type="button" class="btn btn-primary">Add Settings</button>
                            <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{route('settings.create') . '?type=Text'}}">Text</a>
                                <a class="dropdown-item" href="{{route('settings.create') . '?type=Textarea'}}">Textarea</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Config key</th>
                                <th scope="col">Config value</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($settings as $settingItem)
                                <tr>
                                    <th scope="row">{{$settingItem->id}}</th>
                                    <td>{{$settingItem->config_key}}</td>
                                    <td>{{$settingItem->config_value}}</td>
                                    <td>
                                        <a href="{{route('settings.edit',['id'=>$settingItem->id]).'?type='.$settingItem->type}}" class="btn btn-default">Edit</a>
                                        <a href=""
                                           data-url="{{route('settings.delete',['id'=>$settingItem->id])}}"
                                           class="btn btn-danger action_delete">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class='col-md-12'>
                        {{$settings->links()}}
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
    <script src="{{asset('vendors/sweetalert2/sweetalert2@11.js')}}"></script>
    <script src="{{asset('admins/main.js')}}"></script>
@endsection
