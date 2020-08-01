@extends('admin.layouts.adminlayout')
@section('content')
    <section id="main-content">
        <section class="wrapper">
            <h3><i class="fa fa-angle-right"></i> Opening Time</h3>

            <div class="row mt">
                <!--  DATE PICKERS -->
                <div class="col-lg-12">
                    <div class="form-panel">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div><br />
                        @endif
                        @if(Session::has('success'))
                            <div class="alert alert-success profile">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                <strong>{{Session::get('success')}}</strong>
                            </div>
                        @endif
                        @if(Session::has('error'))
                            <div class="alert alert-danger profile">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                <strong>{{Session::get('error')}}</strong>
                            </div>
                        @endif
                        <form action="{{route('admin::openingTimeSave')}}" method="post" enctype="multipart/form-data" class="form-horizontal style-form">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label class="control-label col-md-3">Mon – Fri</label>
                                <div class="col-md-4">
                                    <div class="input-group input-large" >
                                        <input type="time" class="form-control" name="mon_to_fri_opening" value="{{isset($view->mon_to_fri_opening)? $view->mon_to_fri_opening : ''}}">
                                        <span class="input-group-addon">To</span>
                                        <input type="time" class="form-control" name="mon_to_fri_closing" value="{{isset($view->mon_to_fri_closing)? $view->mon_to_fri_closing : ''}}">

                                    </div>
                                    <span class="help-block">Select time range</span>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-md-3">Sat</label>
                                <div class="col-md-4">
                                    <div class="input-group input-large" >
                                        <input type="time" class="form-control" name="opening_sat" value="{{isset($view->opening_sat)? $view->opening_sat : ''}}">
                                        <span class="input-group-addon">To</span>
                                        <input type="time" class="form-control" name="closing_sat" value="{{isset($view->closing_sat)? $view->closing_sat : ''}}">

                                    </div>
                                    <span class="help-block">Select time range</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Sun</label>
                                <div class="col-md-4">
                                    <div class="input-group input-large" >
                                        <input type="time" class="form-control" name="opening_sun" value="{{isset($view->opening_sun)? $view->opening_sun : ''}}">
                                        <span class="input-group-addon">To</span>
                                        <input type="time" class="form-control" name="closing_sun" value="{{isset($view->closing_sun)? $view->closing_sun : ''}}">

                                    </div>
                                    <span class="help-block">Select time range</span>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-sm btn-success">Submit</button>

                        </form>
                    </div>
                    <!-- /form-panel -->
                </div>
                <!-- /col-lg-12 -->
            </div>
            <!-- /row -->
        </section>
        <!-- /wrapper -->
    </section>
    @push('scripts')
    @endpush
@endsection
