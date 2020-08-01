@extends('admin.layouts.fancybox') @section('content')
<style>
    .profile {
        text-align: center;
    }
</style>
<h4 class="mb"><b>Edit Product</b></h4> @if ($errors->any())
<div class="alert alert-danger">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
<br /> @endif @if(Session::has('success'))
<div class="alert alert-success profile">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    <strong>{{Session::get('success')}}</strong>
</div>
@endif
<div class="row">
    <div class="col-lg-12">
        <div class="form-panel custom-form">
            <form class="form-horizontal" action="{{route('admin::update_product',$info['id'])}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="control-label">Product Title</label>
                                <input type="text" class="form-control" name="product_title" value="{{$info['product_name']}}" id="product_title" placeholder="Enter Product Title" />
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="control-label">Product Alias</label>
                                <input type="text" class="form-control" name="product_alias" id="product_alias" placeholder="Enter Product Alias" value="{{$info['product_alias']}}" />
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Product Category</label>
                                <select class="form-control select2 dynamic" name="category_id" data-dependent="sub_cat_id" id="category_id">
                                    <option>Please Select Category</option>
                                    @foreach($categories as $category)
                                    <option value="{{$category->id}}" <?php if($category->id==$info['category_id']){ echo 'selected';}?>>{{$category->category_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Product Sub Category</label>
                                <select name="sub_cat_id" id="sub_cat_id" class="form-control select2">
                                    <option>Select category first</option>
                                    @foreach($subcategory as $sub)
                                    <option value="{{$sub->id}}" <?php if($sub->id==$info['sub_cat_id']){ echo 'selected';}?>>{{$sub->sub_category_name}}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Product Brand</label>
                                <select name="brand_id" id="brand_id" class="form-control select2">
                                    <option>Please Select Brand</option>
                                    @foreach($brands as $val)
                                    <option value="{{$val->id}}" <?php if($val->id==$info['brand_id']){ echo 'selected';}?>>{{$val->brand_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Product Price</label>
                                <input type="text" class="form-control" name="price" placeholder="Enter Product Price" value="{{$info['price']}}" />
                            </div>
                        </div>
                    </div>
                    {{--<div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="control-label">Product Size</label>
                                {!! Form::select('size[]',$allsizes,$productsizes, array('multiple' =>'multiple','id'=>'size', 'class' => 'form-control js-example-basic-multiple')) !!}
                            </div>
                        </div>
                    </div>--}}
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="control-label">Product Discount</label>
                                <input type="text" class="form-control" name="discount" placeholder="Enter Product Discount" value="{{$info['discount']}}" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="control-label">Product Description</label>
                                <textarea class="form-control summernote" rows="5" name="description" placeholder="Enter Product Description">{{$info['description']}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="control-label">Product Highlight</label>
                            </div>
                        </div>

                        <div id="input_fields_wrap">
                            <?php
                                    $addbtn =0;
                                    foreach ($highlight as $key => $value) {
                                ?>
                                <div class="col-sm-9 input_fields_wrap margin-bt" id="highlight_div_{{$key}}">
                                    <div class="form-group">
                                        <input type="text" name="highlight[]" id="highlight_<?php echo $key;?>" class="form-control" value="<?php echo $value->highlights;?>">
                                    </div>
                                </div>
                                @if($key==0)
                                <div class="col-sm-3 margin-bt">
                                    <button class="btn btn-primary add_field_button">Add More Fields</button>
                                </div>
                                @else
                                <div class="col-sm-3 margin-bt">
                                    <a href="#" class="btn btn-danger remove_field" data-no="{{$key}}">Remove</a>
                                </div>
                                @endif
                                <?php } ?>
                        </div>
                    </div>
                    <!--  <div class="row">
                            <div id="input_fields_wrap"></div>
                        </div> -->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="control-label">Product Image (Multiple or Single Image)</label>
                                <input type="file" class="form-control" name="image[]" placeholder="Choose file" multiple />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        @foreach($product_images as $pro_img)
                            <div class="col-sm-3">
                                <div class="product-img">
                                    <i class="fa fa-window-close close-icon" onClick="product_image_delete(<?php echo $pro_img['id'];?>)" aria-hidden="true"></i>
                                    <div>
                                        <img src="{{url($pro_img['product_image'])}}">
                                    </div>
                                    <div class="radio radio-primary">
                                        <input id="radio1<?php echo $pro_img['id'];?>" type="radio" name="img_default" <?php if($pro_img[ 'default_image']==1){echo 'checked';}?> onclick="img_default_function('<?php echo $pro_img['id'];?>','<?php echo $pro_img['product_id'];?>')">
                                                <label for="radio1<?php echo $pro_img['id'];?>">Default</label>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="control-label">Product Warranty</label>
                                <textarea class="form-control" rows="5" name="warranty" placeholder="Enter Product Warranty">{{$info['warranty']}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label">Best Selling</label>
                                <br>
                                <input class="custom-control-input" id="customCheck2" type="checkbox" name="best_selling" value="{{$info['best_selling']}}" <?php if($info[ 'best_selling']=='1' ){ echo 'checked';}?>>
                                <label class="custom-control-label" for="customCheck2">Best Selling</label>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label">Latest Collection</label>
                                <br>
                                <input class="custom-control-input" id="customCheck2" type="checkbox" name="latest_collection" value="{{$info['latest_collection']}}" <?php if($info[ 'latest_collection']=='1' ){ echo 'checked';}?>>
                                <label class="custom-control-label" for="customCheck2">Latest Collection</label>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label">New Arrival</label>
                                <br>
                                <input class="custom-control-input" id="customCheck2" type="checkbox" name="new_arrival" value="{{$info['new_arrival']}}" <?php if($info[ 'new_arrival']=='1' ){ echo 'checked';}?>>
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
