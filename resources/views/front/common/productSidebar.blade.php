 <div class="col-md-3">
                <div class="filter-wrap">
                    <div class="filter-area2">
                        <ul class="filters">
                            <li><strong> Filter :</strong></li>
                            <li class="mr-5"><a href="#" class="cstm-btn">Clear All</a></li>
                            <li class="hidden-desktop visible-mobile"><a href="#"
                                                                         class="cstm-btn cancel-button">Cancel</a></li>
                        </ul>
                        <ul class="bottom-filter">
                            <li><h3>Category</h3>
                                <ul class="category">
                                <?php 
                                $categories = App\Helpers\CategoryHelper::CategoryWithSubcategory();
                                    foreach ($categories as $key1 => $catv) {
                                    //echo "<pre>";print_r($catv);die;
                                    if(count($catv->submenu)){ $i=1;?>
                                     @foreach($catv->submenu as $subkey => $subcat)

                                        <li>
                                                <span>
                                                    <div class="form-check-label">
                                                        <input type="checkbox" id="sub_cat_{{$subcat->id}}" name="subcat" value="{{$subcat->id}}" class="subcategory">
                                                        <label for="sub_cat_{{$subcat->id}}">{{$subcat->sub_category_name}}
                                                        </label>
                                                    </div>
                                                </span>
                                        </li>
                                        <?php $i++;?>
                                    @endforeach
                                   <?php } } ?>
                                </ul>
                            </li>

                            <li>
                                <h3>Price</h3>

                               <?php 
                                    $min_price = App\Helpers\DiscountRangeHelper::MinPrice();
                                    $max_price = App\Helpers\DiscountRangeHelper::MaxPrice();
                                ?>
                                <fieldset class="filter-price">
                                    <div class="price-field">
                                    
                                     <form id="search_price_form">
                                      <input type="range"  min="{{$min_price}}" max="{{$max_price}}" value="{{$min_price}}" id="lower">
                                      <input type="range" min="{{$min_price}}" max="{{$max_price}}" value="{{$max_price}}" id="upper">
                                      </form>
                                    </div>
                                     <div class="price-wrap">
                                       <a href="javascript:void(0);" class="price-title" id="search_go_btn">Go</a>
                                      
                                      <div class="price-wrap-1">
                                        <input id="one">
                                        <label for="one">$</label>
                                      </div>
                                      <div class="price-wrap_line">-</div>
                                      <div class="price-wrap-2">
                                        <input id="two">
                                        <label for="two">$</label>
                                      </div>
                                    </div>
                                  </fieldset> 
                            </li>


                            <li><h3>Brand</h3>

                                <ul class="category">
                                <?php 
                                $brnads = App\Helpers\BrandHelper::Brands();
                                    foreach ($brnads as $bkey => $brand) {?>
                                    <li>
                                            <span>
                                                <div class="form-check-label">
                                                    <input type="checkbox" id="brand_{{$bkey}}" name="brand" value="{{$brand->id}}" class="brands">
                                                    <label for="brand_{{$bkey}}">{{$brand->brand_name}}
                                                    </label>
                                                </div>
                                            </span>
                                    </li>
                                    <?php } ?>
                                   
                                </ul>
                            </li>


                            <li><h3>Discount %</h3>

                                <ul class="category">
                                <?php 
                                    $max_slot = App\Helpers\DiscountRangeHelper::MaxDiscount();
                                    foreach ($max_slot as $mkey => $val) {
                                        
                                ?>

                                    <li>
                                            <span>
                                                <div class="form-check-label">
                                                    <input type="checkbox" id="discount_slot_{{$mkey}}" name="discount" class="discountslot" value="{{$val['discount']}}">
                                                    <label for="discount_slot_{{$mkey}}">{{$val['discount']}}%
                                                    </label>
                                                </div>
                                            </span>
                                    </li>
                                    <?php } ?>
                                    
                                </ul>


                            </li>


                        </ul>
                    </div>
                </div>
            </div>
<script>
    var lowerSlider = document.querySelector('#lower');
    var  upperSlider = document.querySelector('#upper');

    document.querySelector('#two').value=upperSlider.value;
    document.querySelector('#one').value=lowerSlider.value;

    var  lowerVal = parseInt(lowerSlider.value);
    var upperVal = parseInt(upperSlider.value);

    upperSlider.oninput = function () {
        lowerVal = parseInt(lowerSlider.value);
        upperVal = parseInt(upperSlider.value);

        if (upperVal < lowerVal + 4) {
            lowerSlider.value = upperVal - 4;
            if (lowerVal == lowerSlider.min) {
                upperSlider.value = 4;
            }
        }
        document.querySelector('#two').value=this.value
    };

    lowerSlider.oninput = function () {
        lowerVal = parseInt(lowerSlider.value);
        upperVal = parseInt(upperSlider.value);
        if (lowerVal > upperVal - 4) {
            upperSlider.value = lowerVal + 4;
            if (upperVal == upperSlider.max) {
                lowerSlider.value = parseInt(upperSlider.max) - 4;
            }
        }
        document.querySelector('#one').value=this.value
    };
</script>
<script>
    $(function () {
        $('.subcategory').click(function(){
           // alert('dk');
           ProductSubcategorySearch();
       });
    });
    function ProductSubcategorySearch(page=1){
        var sub_category = [];
            $('.subcategory').each(function(){
                if($(this).is(":checked")){
                    sub_category.push($(this).val());
                }
            });
            value  = sub_category.toString();
            var _token = '<?php echo csrf_token() ?>';
            $.ajax({
                type: "GET",
                url: "{{ route('product_subcategory_search') }}",
                data: {_token: _token,sub_cat_id: value,page:page},
                beforeSend: function() {
                    $('.loader').show();
                },
                success: function(result) {
                     //console.log(result);
                    $('.loader').hide();
                    //setTimeout(function() {
                    $("#search_result").html(result);
                   // }, 1000);                      
                }
            });
    }
    $(function () {
     $('.brands').click(function(){
           // alert('dk');
           ProductBandSearch();          
            
        });
    });
    function ProductBandSearch(page=1){
        var barnds = [];
        $('.brands').each(function(){
            if($(this).is(":checked")){
                barnds.push($(this).val());
            }
        });
        value  = barnds.toString();
        var _token = '<?php echo csrf_token() ?>';
        $.ajax({
                type: "GET",
                url: "{{ route('product_brand_search') }}",
                data: {_token: _token,brand_id: value,page:page},
                beforeSend: function() {
                    $('.loader').show();
                },
                success: function(result) {
                     //console.log(result);
                    $('.loader').hide();
                    //setTimeout(function() {
                    $("#search_result").html(result);
                   // }, 1000);                      
                }
        });
    }
    $(function () {
        $('.discountslot').click(function(){
           //alert('dk');
           ProductDiscountSearch();
       });
    });
    function ProductDiscountSearch(page=1){
        var discount = [];
        $('.discountslot').each(function(){
            if($(this).is(":checked")){
                discount.push($(this).val());
            }
        });
        value  = discount.toString();
        var _token = '<?php echo csrf_token() ?>';
        $.ajax({
                type: "GET",
                url: "{{ route('product_discount_search') }}",
                data: {_token: _token,discount: value,page:page},
                beforeSend: function() {
                    $('.loader').show();
                },
                success: function(result) {
                     //console.log(result);
                    $('.loader').hide();
                    //setTimeout(function() {
                    $("#search_result").html(result);
                   // }, 1000);                      
                }
        });
    }
    $(function () {
        $('#search_go_btn').click(function(){
           //alert('dk');
           ProductPriceSearch();
       });
    });
    function ProductPriceSearch(page=1){
          var _token = '<?php echo csrf_token() ?>';
          var min_price = $('#lower').val();
          var max_price = $('#upper').val();
            $.ajax({
                type: "GET",
                url: "{{route('product_price_search')}}",
                data: {min_price: min_price,max_price:max_price,_token:_token},
                beforeSend: function() {
                    $('#search_go_btn').html('Going.....');
                    $('#search_go_btn').prop('disable', true);
                     $('.loader').show();
                },
                success: function(result) {
                     $('#search_go_btn').html('<a href="javascript:void(0);" class="price-title" id="search_go_btn">Go</a>');
                    $('.loader').hide();
                    //setTimeout(function() {
                    $("#search_result").html(result);
                    //}, 2000);          
                }
            });
               
    }
</script>