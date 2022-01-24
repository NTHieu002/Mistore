@extends('layout')
@section('content')
    @foreach($product as $value)
    <div class="product-details"><!--product-details-->
        <div class="col-sm-5">
            <div class="view-product">
                <img src="{{asset('public/uploads/products/'.$value->img_name)}}" alt="" />
                <h3>ZOOM</h3>
            </div>

        </div>
        <form action="{{URL::to('save-cart/'.$value->product_id)}}" method="POST">
            {{csrf_field()}}
            <div class="col-sm-7">
                <!--/product-information-->
                <div class="product-information">
                    <img src="{{URL::to('public/frontend/images/new.jpg')}}" class="newarrival" alt="" />
                    <h2>{{$value->product_name}}</h2>
                    <p>Product ID: {{$value->product_id}}</p>
                    <img src="{{URL::to('./public/frontend/images/rating.png')}}" alt="" />
                    <br>    
                    <span>
                        <span>{{number_format($value->product_price,0,',','.').'đ'}}</span>
                    </span>
                    <span>
                        <label>Quantity:</label>
                        <input name="product_qnt" style="width: 80px;" type="number" value="1" max="{{$value->product_quantity}}" min="1"/>
                        <input type="hidden" name="product_name_hidden" value="{{$value->product_name}}">
                        <input type="hidden" name="product_price_hidden" value="{{$value->product_price}}">
                        <input type="hidden" name="product_img_hidden" value="{{$value->img_name}}">
                        <button type="summit" class="btn btn-fefault cart" name="btn_add_cart">
                            <i class="fa fa-shopping-cart"></i>
                            Add to cart
                        </button>
                    </span>
                    <p><b>Availability:</b> Còn Hàng</p>
                    <p><b>Condition:</b> New</p>
                    <p><b>Brand: </b>{{$value->brand_name}}</p>
                    <p><b>Category: </b>{{$value->category_name}}</p>
                    <a href=""><img src="{{asset('./public/frontend/images/share.png')}}" class="share img-responsive"  alt="" /></a>
                </div>
                <!--/product-information-->
            </div>
        </form>
    </div>
    

<!--/product-details-->
<!--category-tab-->
<div class="category-tab shop-details-tab">
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#details" data-toggle="tab">Details</a></li>
            <li><a href="#tag" data-toggle="tab">Tag</a></li>
            <li><a href="#reviews" data-toggle="tab">Reviews (5)</a></li>
        </ul>
    </div>
    <div class="tab-content">
        <div class="tab-pane fade  active in" id="details" >
            <h4 style="margin-left: 30px;">Chi Tiết Sản Phẩm</h4>
            <p style="margin-left: 50px;">{{ $value->product_desc}}</p>
            <!--recommended_items-->
            <div class="recommended_items">
                <h2 class="title text-center">recommended items</h2>
                <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="item active">
                            @foreach($relate_product as $relate_value)	
                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="{{asset('public/uploads/products/'.$relate_value->img_name)}}" alt="" />
                                            <h2>{{number_format($relate_value->product_price,0,',','.').'đ'}}</h2>
                                            <p>{{$relate_value->product_name}}</p>
                                            <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="item">
                            @foreach($relate_product as $relate_value)	
                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="{{asset('public/uploads/products/'.$relate_value->img_name)}}" alt="" />
                                            <h2>{{number_format($relate_value->product_price,0,',','.').'đ'}}</h2>
                                            <p>{{$relate_value->product_name}}</p>
                                            <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                        <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                        </a>
                        <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                        </a>			
                </div>
            </div>
            <!--/recommended_items-->
        </div>
        
        <div class="tab-pane fade" id="tag" >
            @foreach($tag_product as $value_tag)
            <div class="col-sm-3">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <img src="{{asset('public/uploads/products/'.$value_tag->img_name)}}" alt="" />
                            <h2>{{number_format($value_tag->product_price,0,',','.').'đ'}}</h2>
                            <p>{{$value_tag->product_name}}</p>
                            <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="tab-pane fade" id="reviews" >
            <div class="col-sm-12">
                <ul>
                    <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
                    <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                    <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
                </ul>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                <p><b>Write Your Review</b></p>
                
                <form action="#">
                    <span>
                        <input type="text" placeholder="Your Name"/>
                        <input type="email" placeholder="Email Address"/>
                    </span>
                    <textarea name="" ></textarea>
                    <b>Rating: </b> <img src="{{URL::to('public/frontend/images/rating.png')}}" alt="" />
                    <button type="button" class="btn btn-default pull-right">
                        Submit
                    </button>
                </form>
            </div>
        </div>
        
    </div>
</div>
<!--/category-tab-->
@endforeach
@endsection