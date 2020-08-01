 @if(count($datums)>0)
                        @foreach($datums as $data)
                            <div class="col-md-4">
                                <div class="gallery-item">
                                    <figure class="ngo-gal">
                                        <div class="image">
                                            @if($data->product_image!='')
                                                <img src="{{url($data->product_image)}}" alt="">
                                            @else
                                                <img src="{{url('/')}}/admin/img/No-Image.png" alt="">
                                            @endif
                                            <div class="icons">
                                                 <a href="javascript:void(0);"><i class="fas fa-shopping-cart add-cart" data-product-id="{{$data->id}}" data-uid="{{ $user_id }}" data-product-quantity="1" ></i></a>
                                                <a href="javascript:void(0);"> <i class="far fa-heart whish-list" data-product-id="{{$data->id}}" data-uid="{{ $user_id }}" data-product-quantity="1" ></i></a>
                                                <a href="{{url('product/'.$data->product_alias.'/'.$data->product_code)}}"> <i class="far fa-eye"></i></a>
                                            </div>
                                            <a href="javascript:void(0);" class="add-to-cart add-cart" data-product-id="{{$data->id}}" data-uid="{{ $user_id }}" data-product-quantity="1">Add to Cart</a>
                                        </div>
                                        <figcaption>
                                            <a href="{{url('product/'.$data->product_alias.'/'.$data->product_code)}}">  <h2>{{$data->product_name}}</h2></a>

                                            <div class="price" >

                                               {{-- <ul>
                                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                    <li><a href="#"><i class="far fa-star"></i></a></li>
                                                </ul>--}}

                                                <p>
                                                <?php
                                                    $discount = isset($data->discount)?$data->discount:'0';
                                                    $org_price = isset($data->price)?$data->price:'0';
                                                    $dis_amt = ($org_price*$discount)/100;
                                                    $dis_price = ($org_price-$dis_amt);
                                                ?>
                                                ${{isset($dis_price)?$dis_price:''}} <span class="line-through">${{isset($org_price)?$org_price:''}}</span>
                                                </p>
                                            </div>
                                        </figcaption>
                                    </figure>
                                </div>
                            </div>
                        @endforeach
                        @else
                            <div class="col-md-4">
                                <div class="gallery-item">
                                        <span>No Product here!</span>
                                </div>
                            </div>
                        @endif
                        <div class="my-pagination">
                        <ul class="pagination">
                            <li class="page-item">
                               {{ $datums->links() }}
                            </li>
                            <!-- <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">Next</a></li> -->
                        </ul>
                    </div>
