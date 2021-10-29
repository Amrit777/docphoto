@extends('admin.layout.master')
@section('content')


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Brands</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Brands</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <div>
                            <h3> Brands </h3>
                            <a href="{{ route('admin.brand.index') }}" class="btn btn-primary set-button"
                                title="Back to Brand"> Back </a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('admin.brand.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-group mb-3">
                                                <input id="name" type="text"
                                                    class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                                    name="title" value="{{ old('title') }}" placeholder="Enter Title"
                                                    autofocus>
                                                @if ($errors->has('title'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('title') }}</strong>
                                                    </span> @endif
                                            </div>
                                            <div class="input-group mb-3">
                                                <textarea id="description" type="text"
                                                    class="form-control ckeditor {{ $errors->has('description') ? ' is-invalid' : '' }}"
                                                    name="description" value="{{ old('description') }}"
                                                    placeholder="Enter Description"></textarea>
                                                @if ($errors->has('description'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('description') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="input-group mb-3">
                                                <input id="link_to" type="text"
                                                    class="form-control {{ $errors->has('link_to') ? ' is-invalid' : '' }}"
                                                    name="link_to" value="{{ old('link_to') }}" placeholder="Enter URL">
                                                @if ($errors->has('link_to'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('link_to') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="input-group mb-3">
                                                <input id="link_title" type="text"
                                                    class="form-control {{ $errors->has('link_title') ? ' is-invalid' : '' }}"
                                                    name="link_title" value="{{ old('link_title') }}"
                                                    placeholder="Enter Link Title">
                                                @if ($errors->has('link_title'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('link_title') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="">
                                                <input id="image" type="file"
                                                    class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}"
                                                    name="image" value="{{ old('image') }}">
                                                @if ($errors->has('image'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('image') }}</strong>
                                                    </span>
                                                @endif
                                            </div>

                                            <div class="col-md-6">

                                                <div class="row">
                                                    <div class="col-6">
                                                        <button type="submit"
                                                            class="btn btn-primary btn-block btn-flat">Create</button>
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col-6">
                                                        <a href="{{ route('admin.brand.index') }}"
                                                            class="btn btn-danger btn-block btn-flat">Cancel</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </form>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
@section('scripts')
@endsection
