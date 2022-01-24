@extends('layout')
@section('content')
<section id="cart_items">
    <div class="container" style="width: 100%;">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{'/Mistore'}}">Home</a></li>
                <li class="active">History Order</li>
            </ol>
        </div>
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead style="text-align: center;">
                    <tr class="cart_menu">
                        <td>STT</td>
                        <td class="description">Thanh Toán</td>
                        <td class="price">Giá</td>
                        <td class="quantity">Ngày Đặt Hàng</td>
                        <td >Ngày Giao Hàng</td>
                        <td>Trạng Thái</td>
                        <td >Hủy</td>
                        <td >Chi Tiết</td>
                    </tr>
                </thead>
                <tbody style="text-align: center;">
                    <?php $i=1 ?>
                    @foreach($all_order as $content_value)
                    <tr>
                        <td>{{$i++}}</td>
                        <td class="cart_description">
                        <?php
                            switch($content_value->payment) {
                                case '1':
                                    echo '<a style="color: #e92b3d; font-weight: 700;">COD</a>';
                                    break;
                                case '2':
                                    echo '<a style="color: #17a2b8; font-weight: 700;">Bank Transfer</a>';
                                    break;
                                case '2':
                                    echo '<a style="color: #17a2b8; font-weight: 700;">Đã Gửi Hàng</a>';
                                    break;
                            }
                        ?>
                        </td>
                        <td class="cart_price">
                            <p>{{number_format($content_value->order_total,0,',','.').'đ'}}</p>
                        </td>
                        <td class="cart_quantity">{{$content_value->day_order}}</td>
                        <td class="cart_total">{{$content_value->day_delivery}}</td>
                        <td>
                            <?php
                            switch($content_value->order_status) {
                                case '-1':
                                     echo '<a style="color: #e92b3d; font-weight: 700;">Chờ Hủy</a>';
                                    break;
                                case '0':
                                    echo '<a style="color: #e92b3d; font-weight: 700;">Chờ Duyệt</a>';
                                    break;
                                case '1':
                                    echo '<a style="color: #17a2b8; font-weight: 700;">Đã Duyệt</a>';
                                    break;
                                case '2':
                                    echo '<a style="color: #17a2b8; font-weight: 700;">Đã Gửi Hàng</a>';
                                    break;
                            }
                        ?>
                        </td>
                        <td class="cart_delete" style="line-height: 35px;">
                            <a href="{{'./history-del/'.$content_value->order_id}}"><i class="fa fa-times"></i></a>
                        </td>
                        <td class="cart_edit" style="line-height: 35px;">
                            <a href="{{'./history-details/'.$content_value->order_id}}"><i class="fa fa-edit"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section> 

@endsection