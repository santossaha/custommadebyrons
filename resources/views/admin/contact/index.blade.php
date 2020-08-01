@extends('admin.layouts.adminlayout')
@section('content')
    <section id="main-content">
        <section class="wrapper">
            <h3><i class="fa fa-angle-right"></i> Manage Brand</h3>
            <div class="row mt">
                <div class="col-lg-12">
                    <div class="content-panel">
{{--                        <h4><i class="fa fa-angle-right"></i> Brand List <a class="btn btn-xs btn btn-success ajax_fancybox fancybox.iframe" href="{{route('admin::add_brand')}}"><i class="fa fa-plus"></i> Add New</a></h4>--}}
                        <section id="unseen">
                            <div class="table-responsive">
                            <table id="Datatable" class="table table-bordered table-condensed table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Sl No</th>
                                    <th>Name</th>
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
                        url: '{{route('admin::manageContact')}}',
                        type: 'GET'
                    },
                    columns: [
                        {data: 'id', name: 'id', 'visible': false},
                        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                        {data: 'name'},
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
