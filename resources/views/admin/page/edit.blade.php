@extends('admin.layouts.fancybox')
@section('content')
    <style>
        .profile{
            text-align: center;
        }
    </style>
    <h4 class="mb"><b>Edit Page</b></h4>
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
                <form class="form-horizontal" action="{{route('admin::update_page',$info['id'])}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label class="col-md-3 control-label">Page Name</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" value="{{$info['page_name']}}" name="page_name" placeholder="Enter Page Name" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Page Alias</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" value="{{$info['page_alias']}}" name="page_alias" placeholder="Enter Page Alias" readonly />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Page Title</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" value="{{isset($info['page_title'])?$info['page_title']:''}}" id="page_title" name="page_title" placeholder="Enter Page Title"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Page Description</label>
                        <div class="col-md-6">
                            <textarea class="form-control summernote" rows="5" name="description" placeholder="Enter Page Description" >{{$info['description']}}</textarea>
                        </div>
                    </div>
                     <div class="form-group">
                        <label class="col-md-3 control-label">Previous Image</label>
                        <div class="col-md-6">
                            @if($info['image']!='')
                                <img src="{{url($info['image'])}}" height="100px" width="100px" id="blah">
                            @else
                                <img src="{{url('/')}}/admin/img/No-Image.png" height="100px" width="100px" id="blah">
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Image</label>
                        <div class="col-md-6">
                            <input type="file" class="form-control" name="image" placeholder="Choose file" id="image" />
                        </div>
                    </div>
                    @if($info->page_alias  == 'about-us')
                    <div class="form-group">
                        <label class="col-md-3 control-label">Previous Image</label>
                        <div class="col-md-6">
                            @if($info['background_image']!='')
                                <img src="{{url($info['background_image'])}}" height="100px" width="100px" id="blah">
                            @else
                                <img src="{{url('/')}}/admin/img/No-Image.png" height="100px" width="100px" id="blah">
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Background Image</label>
                        <div class="col-md-6">
                            <input type="file" class="form-control" name="background_image" placeholder="Choose file" id="background_image" />
                        </div>
                    </div>
                    @endif


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
