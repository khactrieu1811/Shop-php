<!-- Stored in resources/views/child.blade.php -->

@extends('layout.admin')

@section('title')
    <title>Slider Add</title>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('admins/role/add/add.css')}}">
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('partials.content-header',['name'=>'Roles','key'=>'Edit'])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <form action="{{route('roles.update', ['id'=> $role->id])}}" method='post' enctype="multipart/form-data" style="width: 100%;">
                        <div class="col-md-12">
                            @csrf
                            <div class="form-group">
                                <label>Tên vai trò</label>
                                <input type="text"
                                       class="form-control "
                                       name="name"
                                       placeholder="Nhập tên vai trò" value ="{{$role->name}}">
                            </div>
                            <div class="form-group">
                                <label>Mô tả vai trò</label>
                                <textarea
                                    class="form-control "
                                    name="display_name" rows="4">{{$role->display_name}} </textarea>

                            </div>

                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>
                                        <input type="checkbox" class="ckeckall">
                                        ckeckall
                                    </label>
                                </div>
                                @foreach($permissionsParent as $permissionsParentItem)
                                    <div class="card border-primary mb-3 col-md-12">
                                        <div class="card-header">
                                            <label >
                                                <input type="checkbox" value="" class="checkbox_wrapper">
                                            </label>
                                            Module {{$permissionsParentItem->name}}
                                        </div>
                                        <div class="row">
                                            @foreach($permissionsParentItem->PermissionsChildrent as $permissionsChildrentItem)
                                                <div class="card-body text-primary col-md-3">
                                                    <h5 class="card-title">
                                                        <label>
                                                            <input type="checkbox" name="permission_id[]"
                                                                   {{$permissionsChecked->contains('id',$permissionsChildrentItem->id) ? 'checked' : ' '}}
                                                                   class="checkbox_childrent"
                                                                   value="{{$permissionsChildrentItem->id}}">
                                                        </label>
                                                        {{$permissionsChildrentItem->name}}
                                                    </h5>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
@section('js')
    <script src="{{asset('admins/role/add/add.js')}}"></script>
@endsection

