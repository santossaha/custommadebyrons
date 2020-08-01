@extends('admin.layouts.fancybox')
@section('content')
    <style>
        .profile{
            text-align: center;
        }
    </style>
    <h4 class="mb"><b>Add Page</b></h4>
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
                <form class="form-horizontal" action="{{route('admin::save_page')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label class="col-md-3 control-label">Page Name</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="page_name" id="page_name" placeholder="Enter Page Name" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Page Alias</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="page_alias" id="page_alias" placeholder="Enter Page Alias" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Page Title</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="page_title" id="page_title" placeholder="Enter Page Title" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Page Description</label>
                        <div class="col-md-6">
                            <textarea class="form-control summernote" rows="5" name="description" placeholder="Enter Page Description" ></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Image</label>
                        <div class="col-md-6">
                            <input type="file" class="form-control" name="image" placeholder="Choose file" />
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
    </div>
   
    
@endsection
