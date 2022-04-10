@extends('layout')
@section('content')
<section id="cart_items">
    <div class="container" style="width: 100%;">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{'/Mistore'}}">Home</a></li>
                <li class="active">History Details</li>
            </ol>
        </div>
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead style="text-align: center;">
                    <tr class="cart_menu">
                        <td class="image">Hình ảnh</td>
                        <td class="description">Sản Phẩm</td>
                        <td class="price">Giá</td>
                        <td class="quantity">Số Lượng</td>
                        <td class="total">Tổng</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order_details as $content_value)
                    <tr>
                        <td class="cart_product">
                            <a href=""><img src="{{URL::to('public/uploads/products/'.$content_value->img_name)}}" 
                            alt="" style="width: 75px; height: 75px;">
                            </a>
                        </td>
                        <td style="text-align: center;" class="cart_description">
                            <h4><a href="">{{$content_value->product_name}}</a></h4>
                        </td>
                        <td style="text-align: center;" class="cart_price">
                            <p>{{number_format($content_value->product_price,0,',','.').'đ'}}</p>
                        </td>
                        <td style="text-align: center;"  class="cart_quantity">{{$content_value->details_quantity}}</td>
                        <td class="cart_total">
                            <p class="cart_total_price">{{number_format($content_value->product_price*$content_value->details_quantity,0,',','.').'đ'}}</p>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <button class="btn btn-primary" onclick="window.location.href=`{{URL::to('./product-detail/'.$content_value->product_id)}}`" >Bình Luận</button>
    </div>
</section> 

@endsection