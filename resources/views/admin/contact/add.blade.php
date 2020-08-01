@extends('admin.layouts.fancybox')
@section('content')
    <style>
        .profile{
            text-align: center;
        }
    </style>
    <h4 class="mb"><b>Add Brand</b></h4>
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
                <form class="form-horizontal" action="{{route('admin::save_brand')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label class="col-md-3 control-label">Brand Name</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="brand_name" id="brand_name" placeholder="Enter Brand Name." />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Brand Alias</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="brand_alias" id="brand_alias" placeholder="Enter Brand Alias." />
                        </div>
                    </div>
                     <div class="form-group">
                        <label class="col-md-3 control-label">Brand Image</label>
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
