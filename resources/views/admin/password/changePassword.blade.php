@extends('admin.layouts.fancybox')
@section('content')
    <style>
        .profile{
            text-align: center;
        }
    </style>
    <h4 class="mb"><b>Change Password</b></h4>
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
    <!-- BASIC FORM ELELEMNTS -->
    <div class="row mt">
        <div class="col-lg-12">
            <div class="form-panel">
                <form class="form-horizontal style-form" action="{{route('admin::ChangePass')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Admin Email</label>
                        <div class="col-sm-10">
                            <input class="form-control profile" id="disabledInput" type="text" value="{{$email}}" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label profile">Old Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control profile" name="old_pass" placeholder="Enter Old Password" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">New Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control profile" name="new_pass" placeholder="Enter New Password" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Confirm Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control profile" name="confirm_pass" placeholder="Enter Confirm Password" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12" style="text-align: center">
                            <input type="submit" class="btn btn-theme" style="text-align: center" value="Update Password">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- col-lg-12-->
    </div>
@endsection