@extends('admin.layouts.fancybox')
@section('content')
    <style>
        .profile{
            text-align: center;
        }
    </style>
    <h4 class="mb"><b>Edit Brand</b></h4>
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
                <form class="form-horizontal" action="{{route('admin::update_banner',$info['id'])}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label class="col-md-3 control-label">Banner Title</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" value="{{$info['title']}}" name="title" placeholder="Enter Banner Title" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Banner Previous Image</label>
                        <div class="col-md-6">
                            <img src="{{url($info['image'])}}" height="100px" width="100px" id="blah">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Banner Image</label>
                        <div class="col-md-6">
                            <input type="file" class="form-control" name="image" placeholder="Choose file" id="image" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12" style="text-align: center">
                            <button type="submit" class="btn btn-sm btn-success">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- col-lg-12-->
    </div>
  
@endsection
