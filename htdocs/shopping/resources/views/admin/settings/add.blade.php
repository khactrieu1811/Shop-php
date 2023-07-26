<!-- Stored in resources/views/child.blade.php -->

@extends('layout.admin')

@section('title')
    <title>Add Seting</title>
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
        <form action="{{route('settings.store').'?type='. request()->type}}" method='post' enctype="multipart/form-data">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            @csrf
                            <div class="form-group">
                                <label>Config key</label>
                                <input type="text"
                                       class="form-control @error('config_key') is-invalid @enderror"
                                       name="config_key"
                                       placeholder="Nhập tên Config key">
                                @error('config_key')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror                            </div>

                            @if(request()->type ==='Text')
                            <div class="form-group">
                                <label>Config value</label>
                                <input type="text"
                                       class="form-control @error('config_value') is-invalid @enderror"
                                       name="config_value"
                                       placeholder="Nhập tên Config value">
                                @error('config_value')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                                @elseif(request()->type ==='Textarea')
                                <div class="form-group">
                                    <label>Config value</label>
                                    <textarea class="form-control @error('config_value') is-invalid @enderror"
                                              name="config_value" rows="5"
                                              placeholder="Nhập tên Config value"></textarea>
                                    @error('config_value')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            @endif
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
@endsection
