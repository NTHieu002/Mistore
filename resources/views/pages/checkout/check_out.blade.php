@extends('layout')
@section('content')
<section id="cart_items">
    <div class="container" style="width: 100%;">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{'home'}}">Home</a></li>
                <li class="active">Check out</li>
            </ol>
        </div><!--/breadcrums-->

        

        <div class="register-req">
            <p>Đăng ký hoặc đăng nhập để thanh toán và xem lịch sử đặt hàng</p>
        </div><!--/register-req-->

        <div class="shopper-informations">
            <div class="row">
                <div class="col-sm-5 clearfix">
                    <div class="bill-to">
                        <p>Thông Tin Nhận Hàng</p>
                        <div class="form-one">
                            <form method="get" action="{{'save-order-user'}}">
                                <?php
                                    $first_login = session('check_first_login');
                                    $user_name = session('user_name');
                                    $user_mail = session('user_email');
                                ?>
                                
                                @if(!$first_login)
                                    @foreach($user_info as $value)
                                    Họ Tên:
                                    <input type="text" value="{{$value->user_name}}" require name="name" >
                                    Email:
                                    <input type="text" value="{{$value->user_email}}" require name="email">
                                    SDT:
                                    <input type="text" value="{{$value->user_phone}}" require name="phone" >
                                    Địa Chỉ:
                                    <input type="text" value="{{$value->address}}" require name="address">
                                    @endforeach
                                @else
                                    Họ Tên:
                                    <input type="text" value="{{$user_name}}" require name="name" >
                                    Email:
                                    <input type="text" value="{{$user_email}}" require name="email">
                                    SDT:
                                    <input type="text" value="" require name="phone" >
                                    Địa Chỉ:
                                    <input type="text" value="" require name="address">
                                    <button type="submit" class="btn btn-default delete">confirm</button>
                                @endif

                                
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4" style="width: 58%;">
                    <div class="order-message">
                        <p>Shipping Order</p>
                        <textarea name="message" style="height: 220px;" placeholder="Ghi chú cho người bán" rows="16"></textarea>
                        <label><input type="checkbox"> Shipping to bill address</label>
                    </div>	
                </div>					
            </div>
        </div>
        <div class="review-payment">
            <h2>Review & Payment</h2>
        </div>

        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <?php
                    use Gloudemans\Shoppingcart\Facades\Cart;
                    

                        $content = Cart::getContent();
                    
                ?>
                <thead>
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
                    @foreach($content as $content_value)
                    <tr>
                        <td class="cart_product">
                            <a href=""><img src="{{URL::to('public/uploads/products/'.$content_value->attributes->image)}}" 
                            alt="" style="width: 75px; height: 75px;">
                            </a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{$content_value->name}}</a></h4>
                            <p>Product ID: {{$content_value->id}}</p>
                        </td>
                        <td class="cart_price">
                            <p>{{number_format($content_value->price,0,',','.').'đ'}}</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <a class="cart_quantity_up" href="{{'update-qnt-sub/'.$content_value->id}}"> - </a>
                                <input readonly class="cart_quantity_input" type="text" name="quantity" value="{{$content_value->quantity}}" autocomplete="off" size="2">
                                <a class="cart_quantity_down" href="{{'update-qnt-plus/'.$content_value->id}}"> + </a>
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">{{number_format($content_value->price*$content_value->quantity,0,',','.').'đ'}}</p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href="{{'delete-to-cart/'.$content_value->id}}"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="col-sm-6" style="margin-left: -55px; ">
                <div class="total_area">
                    <ul>
                        @if(Session::get('coupon'))
                            @foreach(Session::get('coupon') as $cou)
                                <?php 
                                    $percent = $cou['coupon_value']/100;
                                    $subTotal = Cart::getTotal();
                                    $discount = $subTotal*$percent;
                                    $total = $subTotal - $discount;
                                ?>
                                <li>Giảm Giá <span>{{number_format($discount,0,',','.').'đ'}}</span></li>
                                <li>Thành Tiền <span>{{number_format($total,0,',','.').'đ'}}</span></li>
                            @endforeach
                        @else
                            <li>Thành Tiền <span>{{number_format(Cart::getTotal(),0,',','.').'đ'}}</span></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        <div class="payment-options col-sm-6" style="right: -75px; top: -20px;">
            <h4>Phương Thức Thanh Toán</h4>
            <form action="{{'save-order'}}" method="get">
                <span>
                    <label><input type="radio" name="payment_way" value="1" required > Thanh Toán COD</label>
                </span>
                <span>
                    <label><input type="radio" name="payment_way" value="2" required> Chuyển Khoản Ngân Hàng</label>
                </span>
                @if(Session::get('coupon'))
                    <input type="hidden" name="total" value="<?php echo $total?>">
                    <input type="hidden" name="percent" value="<?php echo $percent ?>">
                    <input type="hidden" name="discount" value="<?php echo $discount ?>">
                @endif
                <span>
                    <button class="btn btn-default delete" type="summit">ĐỒNG Ý ĐẶT HÀNG</button>
                </span>
            </form>
        </div>
   
    </div>
    
</section> <!--/#cart_items-->

@endsection