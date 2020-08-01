@extends('admin.layouts.adminlayout')
@section('content')
    <section id="main-content">
        <section class="wrapper">
            <h3><i class="fa fa-angle-right"></i> Manage Setting</h3>
            <div class="row mt">
                <div class="col-lg-12">
                    <div class="content-panel">
                       
                        <section id="unseen">
                            <div class="table-responsive">
                            <table id="Datatable" class="table table-bordered table-condensed table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Sl No</th>
                                    <th>Title</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            </div>
                        </section>
                    </div>
                    <!-- /content-panel -->
                </div>
                <!-- /col-lg-4 -->
            </div>
            <!-- /row -->
        </section>
        <!-- /wrapper -->
    </section>
    @push('scripts')
        <script>
            $(document).ready( function () {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $('#Datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '{{route('admin::manage_setting')}}',
                        type: 'GET'
                    },
                    columns: [
                        {data: 'id', name: 'id', 'visible': false},
                        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                        {data: 'title'},
                        {data: 'email'},
                        {data: 'action', name: 'action', orderable: false, searchable: true}
                    ],
                    order: [[0, 'desc']],
                    "pageLength": 10,
                    "fnDrawCallback": function () {
                        init();
                    }
                });

                function init() {
                    $(document).find('.ajax_fancybox').fancybox({
                        type: 'iframe',
                        width: 800,
                        height: 600,
                        fitToView: true,
                        iframe : {
                            preload : false
                        },
                        openEffect: 'elastic',
                        afterClose: function () {
                            var oTable = $('#Datatable').dataTable();
                            oTable.fnDraw(false);
                        }
                    });
                }
            });
            
        </script>
    @endpush
@endsection
