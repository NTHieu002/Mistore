@extends('layout')
@section('content')
<!--features_items-->
<div class="features_items">
    <h2 class="title text-center">Features Items</h2>
    @foreach($future_product as $value)
    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <div class="single-products">
                    <div class="productinfo text-center">
                        <img src="{{'public/uploads/products/'.$value->img_name}}" alt="" />
                        <h2>{{number_format($value->product_price,0,',','.').'đ' }}</h2>
                        <p>{{$value->product_name}}</p>
                        <a href="{{'add-cart/'.$value->product_id}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                    </div>
                    <div class="product-overlay">
                        <div class="overlay-content">
                            <h2>{{number_format($value->product_price,0,',','.').'đ' }}</h2>
                            <p>{{$value->product_name}}</p>
                            <a href="{{'add-cart/'.$value->product_id}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                        </div>
                    </div>
            </div>
            <div class="choose">
                <ul class="nav nav-pills nav-justified">
                    <li><a href="#"><i class="fa fa-plus-square"></i>Wishlist</a></li>
                    <li><a href="{{URL::to('product-detail/'.$value->product_id)}}"><i class="fa fa-plus-square"></i>Chi Tiết</a></li>
                </ul>
            </div>
        </div>
    </div>
    @endforeach
    
</div>
<!--features_items-->



<!--recommended_items-->
<div class="recommended_items">
    <h2 class="title text-center">recommended items</h2>
    
    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="item active">	
                @foreach($rec_product as $recommend_value)	
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{asset('public/uploads/products/'.$recommend_value->img_name)}}" alt="" />
                                <h2>{{number_format($recommend_value->product_price,0,',','.').'đ'}}</h2>
                                <p>{{$recommend_value->product_name}}</p>
                                <a href="{{'add-cart/'.$recommend_value->product_id}}" type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="item">	
                @foreach($rec_product as $recommend_value)	
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{asset('public/uploads/products/'.$recommend_value->img_name)}}" alt="" />
                                <h2>{{number_format($recommend_value->product_price,0,',','.').'đ'}}</h2>
                                <p>{{$recommend_value->product_name}}</p>
                                <a href="{{'add-cart/'.$recommend_value->product_id}}" type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
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
@endsection