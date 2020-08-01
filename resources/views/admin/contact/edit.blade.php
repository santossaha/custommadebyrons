@extends('admin.layouts.fancybox')
@section('content')
    <style>
        .profile{
            text-align: center;
        }
    </style>
    <h4 class="mb"><b>Edit Contact us</b></h4>
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
    <div class="row mt">
        <div class="col-lg-12">
            <div class="form-panel">
                <form class="form-horizontal" action="#" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label class="col-md-3 control-label">Name</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" value="{{isset($view->name) ? $view->name : ''}}" id="name" name="name" readonly/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Email</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" value="{{isset($view->email) ? $view->email : ''}}" id="email" name="email" readonly />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Phone</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" value="{{isset($view->phone) ? $view->phone : ''}}" id="phone" name="phone" readonly />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Subject</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" value="{{isset($view->subject) ? $view->subject : ''}}" id="subject" name="subject" readonly />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Massage</label>
                        <div class="col-md-6">
                            <textarea name="massage" class="form-control" id="massage" cols="5" readonly rows="5">{{isset($view->message) ? $view->message : 'no Massage'}}</textarea>
                        </div>
                    </div>

                  {{--  <div class="form-group">
                        <div class="col-md-12" style="text-align: center">
                            <button type="submit" class="btn btn-sm btn-success">Submit</button>
                        </div>
                    </div>--}}
                </form>
            </div>
        </div>
        <!-- col-lg-12-->
    </div>
  
@endsection
