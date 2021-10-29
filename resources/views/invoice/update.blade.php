@php
// die("fff");
@endphp
@extends('layouts.dashboard')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $model->DocType }}</div>
                    <div class="card-body">
                        <section class="content">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <form action="{{ route('invoice.update', ['id' => $model->DocID]) }}"
                                                    method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    {{ method_field('PUT') }}

                                                    <div class="form-group row">
                                                        <label for="DocID" class="col-sm-2 col-form-label">Doc
                                                            ID</label>
                                                        <div class="col-sm-10">
                                                            <input id="DocID" type="text"
                                                                class="form-control{{ $errors->has('DocID') ? ' is-invalid' : '' }}"
                                                                name="DocID" value="{{ $model->DocID }}"
                                                                placeholder="Enter Title" autofocus>
                                                            @if ($errors->has('DocID'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('DocID') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="DocDate" class="col-sm-2 col-form-label">Doc
                                                            Date</label>
                                                        <div class="col-sm-10">
                                                            <input id="DocDate" type="text"
                                                                class="form-control{{ $errors->has('DocDate') ? ' is-invalid' : '' }}"
                                                                name="DocDate" value="{{ $model->DocDate }}">
                                                            @if ($errors->has('DocDate'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('DocDate') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="Info1" class="col-sm-2 col-form-label">Info1</label>
                                                        <div class="col-sm-10">
                                                            <input id="Info1" type="text"
                                                                class="form-control{{ $errors->has('Info1') ? ' is-invalid' : '' }}"
                                                                name="Info1" value="{{ $model->Info1 }}"
                                                                placeholder="Enter Info1">
                                                            @if ($errors->has('Info1'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('Info1') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="Info2" class="col-sm-2 col-form-label">Info2</label>
                                                        <div class="col-sm-10">
                                                            <input id="Info2" type="text"
                                                                class="form-control{{ $errors->has('Info2') ? ' is-invalid' : '' }}"
                                                                name="Info2" value="{{ $model->Info2 }}"
                                                                placeholder="Enter Info2">
                                                            @if ($errors->has('Info2'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('Info2') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="Info3" class="col-sm-2 col-form-label">Info3</label>
                                                        <div class="col-sm-10">
                                                            <input id="Info3" type="text"
                                                                class="form-control{{ $errors->has('Info3') ? ' is-invalid' : '' }}"
                                                                name="Info3" value="{{ $model->Info3 }}"
                                                                placeholder="Enter Info3">
                                                            @if ($errors->has('Info3'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('Info3') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="Keterangan"
                                                            class="col-sm-2 col-form-label">Keterangan</label>
                                                        <div class="col-sm-10">
                                                            <input id="Info4" type="text"
                                                                class="form-control{{ $errors->has('Info4') ? ' is-invalid' : '' }}"
                                                                name="Keterangan" value="{{ $model->Info4 }}"
                                                                placeholder="Enter Keterangan">
                                                            @if ($errors->has('Info4'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('Info4') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <input id="image" type="file"
                                                        {{-- data-src="{{ @$media ? $media->getUrl() : '' }}" --}}
                                                        class="form-control{{ $errors->has('Info4') ? ' is-invalid' : '' }}"
                                                        name="Info4" value="{{ old('Info4') }}">

                                                    @if ($errors->has('Info4'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('Info4') }}</strong>
                                                        </span>
                                                    @endif
                                            </div>

                                        </div>
                                        <br />

                                        <div class="row">
                                            <div class="col-md-6">
                                                <button type="submit"
                                                    class="btn btn-primary btn-block btn-flat">Save</button>
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-md-6">
                                                <a href="{{ route('invoice.index', ['type' => $type]) }}"
                                                    class="btn btn-danger btn-block btn-flat">Cancel</a>
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
                </div>
                <!-- /.container-fluid -->
                </section>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
@section('scripts')
@endsection
