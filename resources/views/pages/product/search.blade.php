@extends('layout')
@section('content')
<div class="features_items">
    <h2 class="title text-center">Sản phẩm tìm kiếm</h2>
    @foreach($search_product as $value)
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

@endsection