@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ $docType }}</div>

                    <div class="card-body">
                        <section class="content">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <table id="example1" class="table table-bordered table-striped data-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Doc Id</th>
                                                            <th>Doc Date</th>
                                                            <th>Info1</th>
                                                            <th>Info3</th>
                                                            <th width="100px">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                        <!-- /.card -->
                                    </div>
                                    <!-- /.row -->
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
    <script type="text/javascript">
        var urlParams = new URLSearchParams(window.location.search);
        console.log(urlParams.get('type'));
        $(function() {
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 10,
                ajax: "{{ url('/invoice/list', [$type]) }}",
                columns: [{
                        data: 'DocID',
                        name: 'DocID'
                    },
                    {
                        data: 'DocDate',
                        name: 'DocDate'
                    },
                    {
                        data: 'Info1',
                        name: 'Info1'
                    },
                    {
                        data: 'Info3',
                        name: 'Info3'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });
    </script>
@endsection
