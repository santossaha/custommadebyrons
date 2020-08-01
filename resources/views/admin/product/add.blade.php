@extends('admin.layouts.fancybox')
@section('content')
    <style>
        .profile{
            text-align: center;
        }
    </style>
    <h4 class="mb"><b>Add Product</b></h4>
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
    <div class="row">
        <div class="col-lg-12">
            <div class="form-panel custom-form">
                 <form class="form-horizontal" action="{{route('admin::save_product')}}" method="post" enctype="multipart/form-data">
                     {{csrf_field()}}
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="control-label">Product Title</label>
                                    <input type="text" class="form-control" name="product_title" id="product_title" placeholder="Enter Product Title" />
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                     <label class="control-label">Product Alias</label>
                                    <input type="text" class="form-control" name="product_alias" id="product_alias" placeholder="Enter Product Alias" />
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Product Category</label>
                                    {!! Form::select('category_id', $categories, '', array('placeholder' => 'Please select Category','id'=>'category_id','class' => 'form-control select2 dynamic','data-dependent'=>'sub_cat_id',)) !!}
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                     <label class="control-label">Product Sub Category</label>
                                    <select name="sub_cat_id" id="sub_cat_id" class="form-control select2 dynamictype" data-dependent="size">
                                        <option value="">Select category first</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Product Brand</label>
                                    {!! Form::select('brand_id', $brands, '', array('id'=>'brand_id','class' => 'form-control select2','placeholder' => 'Please select Brand')) !!}
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                     <label class="control-label">Product Price</label>
                                    <input type="text" class="form-control" name="price" placeholder="Enter Product Price" />
                                </div>
                            </div>
                        </div>
                        {{--<div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="control-label">Product Size</label>
                                     {!! Form::select('size[]', $sizes, '', array('id'=>'size','class' => 'form-control js-example-basic-multiple','multiple'=>'multiple')) !!}
                                </div>
                            </div>
                        </div>--}}
                         <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="control-label">Product Discount</label>
                                    <input type="text" class="form-control" name="discount" placeholder="Enter Product Discount" />
                                </div>
                            </div>
                        </div>
                         <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="control-label">Product Description</label>
                                     <textarea class="form-control summernote" rows="5" name="description" placeholder="Enter Product Description" ></textarea>
                                </div>
                            </div>
                        </div>
                          <div class="row">
                            <div class="col-sm-9 input_fields_wrap">
                                <div class="form-group">
                                    <label class="control-label">Product Highlight</label>
                                    <input type="text" name="highlight[]" id="highlight_0" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <button class="btn btn-primary add_field_button">Add More Fields</button>
                            </div>
                        </div>
                        <div class="row">
                            <div id="input_fields_wrap"></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="control-label">Product Image (Multiple or Single Image)</label>
                                    <input type="file" class="form-control" name="image[]" placeholder="Choose file" multiple />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="control-label">Product Warranty</label>
                                   <textarea class="form-control" rows="5" name="warranty" placeholder="Enter Product Warranty" ></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                   <label class="control-label">Best Selling</label><br>
                                   <input class="custom-control-input" id="customCheck2" type="checkbox" name="best_selling" value="1">
                                   <label class="custom-control-label" for="customCheck2">Best Selling</label>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                               <label class="control-label">Latest Collection</label><br>
                                <input class="custom-control-input" id="customCheck2" type="checkbox" name="latest_collection" value="1">
                                <label class="custom-control-label" for="customCheck2">Latest Collection</label>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                               <label class="control-label">New Arrival</label><br>
                                <input class="custom-control-input" id="customCheck2" type="checkbox" name="new_arrival" value="1">
                                <label class="custom-control-label" for="customCheck2">New Arrival</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12" style="text-align: center">
                                <button type="submit" class="btn btn-sm btn-success">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
