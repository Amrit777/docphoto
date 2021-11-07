@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6 heading-title-list">
                                {{ $docType }}
                            </div>
                            <div class="col-md-6 ">
                                <a class="btn back-btn-grid" href="{{ route('home') }}">Back to Menu</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <table id="example1" class="table table-bordered table-striped data-table">
                    <thead>
                        <tr>
                            <th>Action</th>
                            <th>Doc Id</th>
                            <th>Doc Date</th>
                            <th>Info1</th>
                            <th>Info3</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
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
                pagingType: 'simple',
                ajax: "{{ url('/invoice/list', [$type]) }}",
                aaSorting: [[ 2, "desc" ]],
                columns: [{
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                    {
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

                ]
            });
        });
    </script>
@endsection
