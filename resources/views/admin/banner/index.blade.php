@extends('admin.layouts.adminlayout')
@section('content')
    <section id="main-content">
        <section class="wrapper">
            <h3><i class="fa fa-angle-right"></i> Manage Banner</h3>
            <div class="row mt">
                <div class="col-lg-12">
                    <div class="content-panel">
                        <h4><i class="fa fa-angle-right"></i> Banner List <a class="btn btn-xs btn btn-success ajax_fancybox fancybox.iframe" href="{{route('admin::add_banner')}}"><i class="fa fa-plus"></i> Add New</a></h4>
                        <section id="unseen">
                            <div class="table-responsive">
                            <table id="Datatable" class="table table-bordered table-condensed table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Sl No</th>
                                    <th>Image</th>
                                    <th>Title</th>
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
                        url: '{{route('admin::manage_banner')}}',
                        type: 'GET'
                    },
                    columns: [
                        {data: 'id', name: 'id', 'visible': false},
                        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                        {data: 'image'},
                        {data: 'title'},
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
            var Inactive='Inactive';
            var Active='Active';
            function banner_status(id,status){
                $.ajax({
                    type: "post",
                    url: '{{route('admin::banner_status')}}',
                    data: {
                        _token: '<?php echo csrf_token();?>',
                        id: id,
                        status:status
                    },
                    success: function (data) {
                        var resp=JSON.parse(data);
                        $('#status'+resp.id).html(resp.html);
                        $(document).find('.child #status'+resp.id).html(resp.html);
                    }

                });
            }
        </script>
    @endpush
@endsection
