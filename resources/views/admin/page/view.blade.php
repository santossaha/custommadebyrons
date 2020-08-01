@extends('admin.layouts.fancybox')
@section('content')
    <style>
        .profile{
            text-align: center;
        }
    </style>
    <h4 class="mb"><b>View Page</b></h4>
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
                
                    <div class="form-group">
                        <label class="col-md-3 control-label"><b>Page Name</b></label>
                        <div class="col-md-6">
                            {{isset($info['page_name'])?$info['page_name']:''}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"><b>Page Alias</b></label>
                        <div class="col-md-6">
                            {{isset($info['page_alias'])?$info['page_alias']:''}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"><b>Page Title</b></label>
                        <div class="col-md-6">
                            {{isset($info['page_title'])?$info['page_title']:''}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"><b>Page Description</b></label>
                        <div class="col-md-6">
                            {!! $info['description'] !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"><b>Image</b></label>
                        <div class="col-md-6">
                            @if($info['image']!='')
                                <img src="{{url($info['image'])}}" height="100px" width="100px">
                            @else
                                <img src="{{url('/')}}/admin/img/No-Image.png" height="100px" width="100px">
                            @endif
                        </div>
                    </div>
            </div>
        </div>
        <!-- col-lg-12-->
    </div>
  
@endsection
