@extends('admin.layouts.adminlayout')
@section('content')
    <section id="main-content">
        <section class="wrapper">
            <h3><i class="fa fa-angle-right"></i> Manage Order</h3>
            <div class="row mt">
                <div class="col-lg-12">
                    <div class="content-panel">
{{--                        <h4><i class="fa fa-angle-right"></i> Product List <a class="btn btn-xs btn btn-success ajax_fancybox fancybox.iframe" href="{{route('admin::add_product')}}"><i class="fa fa-plus"></i> Add New</a></h4>--}}
                        <section id="unseen">
                            <div class="table-responsive">
                            <table id="Datatable" class="table table-bordered table-condensed table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Sl No</th>
                                    <th>Customer</th>
                                    <th>Email</th>
                                    <th>Order Number</th>
                                    <th>Total Qty</th>
                                    <th>Total Cost</th>
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
                        url: '{{--{{route('admin::manage_product')}}--}}',
                        type: 'GET'
                    },
                    columns: [
                        {data: 'id', name: 'id', 'visible': false},
                        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                        {data: 'name'},
                        {data: 'email'},
                        {data: 'order_id'},
                        {data: 'qty'},
                        {data: 'total_amount'},
                        {data: 'action', name: 'action', orderable: false, searchable: true}
                    ],
                    order: [[0, 'desc']],
                    "pageLength": 10,
                    "fnDrawCallback": function () {

                    }
                });

            });

        </script>
    @endpush
@endsection
