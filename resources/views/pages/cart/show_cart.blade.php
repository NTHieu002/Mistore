@extends('layout')
@section('content')
<section id="cart_items">
    <div class="container" style="width: 100%;">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{'/Mistore'}}">Home</a></li>
                <li class="active">Shopping Cart</li>
            </ol>
        </div>
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <?php
                    use Gloudemans\Shoppingcart\Facades\Cart;

                    $content = Cart::getContent();
                    // echo '<pre>';
                    // print_r($content);
                    
                    // echo '</pre>';
                  
                    
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
        </div>
        <a class="btn btn-default delete" href="{{'delete-cart'}}">Xóa</a>
    </div>
</section> 
<section id="do_action">
    <div class="container" style="width: 100%;">
        <div class="heading">
            <h3>Bạn muốn làm gì tiếp theo?</h3>
            <p>Chọn xem bạn có mã giảm giá hoặc điểm thưởng muốn sử dụng hoặc muốn ước tính chi phí giao hàng của mình.</p>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="chose_area">
                    <ul class="user_option">
                        <li>
                            <input type="checkbox">
                            <label>Dùng mã mua hàng</label>
                        </li>
                        <li>
                            <input type="checkbox">
                            <label>Dùng phiếu quà tặng</label>
                        </li>
                    </ul>
                    <ul class="user_info">
                        <li class="single_field">
                            <label>Mã vận chuyển</label>
                            <select style="width: 150px;">
                                <option>FreeShip 20.000 đ</option>
                                <option>FreeShip 30.000 đ</option>
                                <option>FreeShip 15.000 đ</option>
                            </select>
                            
                        </li>
                    </ul>
                    <ul class="user_info" >
                        <li class="single_field zip-field" style="width: 150px;">
                            <label>Mã Giảm Giá:</label>
                            <input type="text">
                        </li>

                    </ul>
                    <a class="btn btn-default update" href="">Get Quotes</a>
                    <a class="btn btn-default check_out" href="">Continue</a>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="total_area">
                    <ul>
                        <li>Tổng <span>{{number_format(Cart::getTotal(),0,',','.').'đ'}}</span></li>
                        <li>Thuế <span>0 đ</span></li>
                        <li>Vận Chuyển <span>Free</span></li>
                        <li>Thành Tiền <span>{{number_format(Cart::getSubTotal(),0,',','.').'đ'}}</span></li>
                    </ul>
                        <a class="btn btn-default update" href="{{'login-checkout'}}">Thanh Toán</a>
                </div>
            </div>
        </div>
    </div>
</section><!--/#do_action-->


@endsection