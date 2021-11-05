@extends('layouts.dashboard')
@section('styles')
    <!-- the fileinput plugin styling CSS file -->
    <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.5/css/fileinput.min.css" media="all"
        rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6 heading-title-list">
                                {{ $model->DocType }}
                            </div>
                            <div class="col-md-6 ">
                                <a class="btn back-btn-grid" href="{{ route('invoice.index', ['type' => $type]) }}">Go
                                    Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('invoice.update', ['id' => $model->DocID]) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            {{ method_field('PUT') }}

                            <div class="form-group row">
                                <label for="DocID" class="col-sm-2 col-form-label">Doc
                                    ID</label>
                                <div class="col-sm-10">
                                    <input id="DocID" type="text"
                                        class="form-control{{ $errors->has('DocID') ? ' is-invalid' : '' }}" name="DocID"
                                        value="{{ $model->DocID }}" placeholder="Enter Title" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="DocDate" class="col-sm-2 col-form-label">Doc
                                    Date</label>
                                <div class="col-sm-10">
                                    <input id="DocDate" type="text"
                                        class="form-control{{ $errors->has('DocDate') ? ' is-invalid' : '' }}"
                                        name="DocDate" value="{{ $model->DocDate }}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Info1" class="col-sm-2 col-form-label">Info1</label>
                                <div class="col-sm-10">
                                    <input id="Info1" type="text"
                                        class="form-control{{ $errors->has('Info1') ? ' is-invalid' : '' }}" name="Info1"
                                        value="{{ $model->Info1 }}" placeholder="Enter Info1" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Info2" class="col-sm-2 col-form-label">Info2</label>
                                <div class="col-sm-10">
                                    <input id="Info2" type="text"
                                        class="form-control{{ $errors->has('Info2') ? ' is-invalid' : '' }}" name="Info2"
                                        value="{{ $model->Info2 }}" placeholder="Enter Info2" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Info3" class="col-sm-2 col-form-label">Info3</label>
                                <div class="col-sm-10">
                                    <input id="Info3" type="text"
                                        class="form-control{{ $errors->has('Info3') ? ' is-invalid' : '' }}" name="Info3"
                                        value="{{ $model->Info3 }}" placeholder="Enter Info3" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                                <div class="col-sm-10">
                                    <input id="Keterangan" type="text"
                                        class="form-control{{ $errors->has('Keterangan') ? ' is-invalid' : '' }}"
                                        name="Keterangan"
                                        value="{{ !empty($transData && $transData->Keterangan) ? $transData->Keterangan : '' }}"
                                        placeholder="Enter Keterangan" autofocus>
                                    @if ($errors->has('Keterangan'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('Keterangan') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <input id="image" name="image" type="file">
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary btn-block btn-flat">Save</button>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('invoice.index', ['type' => $type]) }}"
                                        class="btn btn-danger btn-block btn-flat">Cancel</a>
                                </div>
                            </div>
                    </div>
                </div>
                <br />
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </div>
@endsection

@section('scripts')
    <!-- the main fileinput plugin script JS file -->
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.5/js/fileinput.min.js"></script>
    <script>
        $(document).ready(function() {
            $.fn.fileinputBsVersion = "3.3.7"; // if not set, this will be auto-derived
            $.fn.fileinput.defaults.showUpload = false;
            $.fn.fileinput.defaults.showRemove = false;
            $("#image").fileinput({
                @if (!empty($lurl))
                    initialPreview: [@json($lurl)],
                @endif
                initialPreviewAsData: true,
                overwriteInitial: true,
                showRemove: false,
                fileActionSettings: {
                    showRemove: false,
                    showUpload: false,
                    showZoom: false,
                    showDrag: false,
                    showClose: false
                }
            });
            $('button[type="button"].kv-file-remove').remove();
        });
    </script>
@endsection
