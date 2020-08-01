@extends('admin.layouts.fancybox')
@section('content')
    <style>
        .profile{
            text-align: center;
        }
    </style>
    <h4 class="mb"><b>Edit Sub Category</b></h4>
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
                <form class="form-horizontal" action="{{route('admin::update_subcategory',$info['id'])}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label class="col-md-3 control-label">Category Name</label>
                        <div class="col-md-6">
                          <select class="form-control select2" name="category_id">
                              <option>Please Select Category</option>
                              <?php
                                    foreach ($categories as $key => $val) {
                              ?>
                               <option value="{{ $val->id }}" <?php if($info['category_id']==$val->id){ echo 'selected';}?>>{{$val->category_name}}</option>
                           <?php } ?>
                          </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Sub Category Name</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" value="{{$info['sub_category_name']}}" id="sub_category_name" name="sub_category_name" placeholder="Enter Sub Category Name" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Category Alias</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" value="{{$info['sub_category_alias']}}" id="sub_category_alias" name="sub_category_alias" placeholder="Enter sub Category Alias" />
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
