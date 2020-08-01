@extends('admin.layouts.fancybox')
@section('content')
    <style>
        .profile{
            text-align: center;
        }
    </style>
    <h4 class="mb"><b>Add Sub Category</b></h4>
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
                <form class="form-horizontal" action="{{route('admin::save_subcategory')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label class="col-md-3 control-label">Category Name</label>
                        <div class="col-md-3">
                            {!! Form::select('category_id', $categories, '', array('placeholder' => 'Please select Category', 'class' => 'form-control select2')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Sub Category Name</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="sub_category_name" id="sub_category_name" placeholder="Enter Sub Category Name" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Sub Category Alias</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="sub_category_alias" id="sub_category_alias" placeholder="Enter Sub Category Alias" />
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
