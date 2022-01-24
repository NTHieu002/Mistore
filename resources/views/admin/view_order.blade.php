@extends('admin_layout')
@section('admin_content')
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Chi Tiết Đơn Hàng</h3>
      </div>

      <div class="title_right">
        <div class="col-md-5 col-sm-5   form-group pull-right top_search">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for...">
            <span class="input-group-btn">
              <button class="btn btn-secondary" type="button">Go!</button>
            </span>
          </div>
        </div>
      </div>
    </div>
    
    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Chi Tiết</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li>
                &nbsp;
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            @foreach($customer_info as $customer_value)
            <div class="customer_info">
                <h4>Thông tin khách hàng</h4>
                <table class="table_customer" style="color: #000; font-size: 16px; margin: 20px 20px;"> 
                    <tr>
                        <td>Họ tên: </td>
                        <td style="padding-left: 20px;">{{$customer_value->user_name}}</td>
                    </tr>
                    <tr>
                        <td>Email: </td>
                        <td style="padding-left: 20px;">{{$customer_value->user_email}}</td>
                    </tr>
                    <tr>
                        <td>Phone: </td>
                        <td style="padding-left: 20px;">{{$customer_value->user_phone}}</td>
                    </tr>
                    <tr>
                        <td>Địa chỉ: </td>
                        <td style="padding-left: 20px;">{{$customer_value->address}}</td>
                    </tr>
                </table>
            </div>
            @endforeach
            <!-- start project list -->
            <table class="table table-striped projects">
              <thead>
                <tr>
                  <th style="width: 1%">STT</th>
                  <th style="width: 20%">Tên Sản Phẩm</th>
                  <th>Hình Ảnh</th>
                  <th>Số Lượng</th>
                  <th>Giá</th>
                  <th style="width: 20%">#Edit</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1; ?>
                @foreach($order_details as $details_value)
                <tr>
                  <td>{{$i++}}</td>
                  <td>
                    <a>{{$details_value->product_name}}</a>
                    <br />
                    <small>Dung lượng: 8 - 128GB</small>
                  </td>
                  <td>
                    <ul class="list-inline">
                      <li>
                        <img src="{{asset('public/uploads/products/'.$details_value->img_name)}}" class="avatar" alt="Avatar">
                      </li>
                    </ul>
                  </td>
                  <td >{{$details_value->details_quantity}}</td>
                  <td>{{number_format($details_value->product_price,0,',','.').' đ'}}</td>
                  <td>
                    <a href="{{URL::to('/edit-product/'.$details_value->product_id)}}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                    <a href="{{URL::to('/delete-product/'.$details_value->product_id)}}" onclick="return confirm('Bạn muốn xóa sản phẩm')" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <div class="row">
                <h2 style="color: #000; margin-left: 20px;">Tổng Đơn Hàng: </h2>
                <h2 style="color: #dc3545; font-weight: 600; margin-left: 20px;">{{number_format($total,0,',','.').' đ'}}</h2>
            </div>
            @foreach($customer_info as $value)
            <form class="update_status" method="get" action="{{'../update-order/'.$value->order_id}}">
            <input type="date" name="day_delivery" min="{{$value->day_order}}" placeholder="Ngày Giao Hàng" required class="btn-xs btn switch-btn">
            @endforeach
                <select class="btn-xs btn switch-btn" name="order_status" id="order_status">
                  <option  value="1">Đã xử lý</option>
                  <option  value="2">Đã hoàn thành</option>
                </select>
                <button  class="btn btn-primary btn-xs" type="submit" name="update_btn" >Cập Nhật</button>
            </form>
           
            <!-- end project list -->
            <?php
                use Illuminate\Support\Facades\Session;
                $mess = Session::get('message');
                if($mess) {
                    echo $mess;
                    Session::put('message',null);
                }
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection