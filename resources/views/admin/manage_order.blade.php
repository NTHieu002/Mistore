@extends('admin_layout')
@section('admin_content')
<?php use Illuminate\Support\Facades\Session;
  $staff_id = session::get('admin_id');
  $staff_name = session::get('admin_name');
  ?>
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Liệt Kê Đơn Hàng</h3>
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
            <h2>Tất Cả Đơn Hàng</h2>
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

            <p>Thông Tin</p>

            <!-- start project list -->
            <table class="table table-striped projects">
              <thead>
                <tr>
                  <th style="width: 1%">STT</th>
                  <th style="width: 20%">Khách Hàng</th>
                  <th>Tổng Đơn Hàng</th>
                  <th>Ngày Đặt Hàng</th>
                  <th>Thanh Toán</th>
                  <th>Trạng Thái</th>
                  <th style="width: 20%">#Edit</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1;?>
                @foreach($all_order as $order_value)
                <tr>
                   <td style="line-height: 34px;">{{$i++}}</td>
                   <td >
                    <a>{{$order_value->user_name}}</a>
                    <br />
                    <small>Phone: {{$order_value->user_phone}}</small>
                  </td>
                   <td style="line-height: 34px;">{{number_format($order_value->order_total,0,',','.').' đ'}}</td>
                   <td style="line-height: 34px;">{{$order_value->day_order}}</td>
                   <td style="line-height: 34px;"> 
                      <?php if($order_value->payment == 1) {
                          echo 'Thanh Toán COD';
                      } else {
                          echo 'Bank';
                      } ?>
                  </td>
                   <td >
                    <?php
                        switch($order_value->order_status) {
                            case '-1':
                              echo '<a style="color: #e92b3d; font-weight: 700;">Chờ Hủy</a>';
                              break;
                            case '0':
                                echo '<a style="color: #e92b3d; font-weight: 700;">Chờ Duyệt</a>';
                                break;
                            case '1':
                                echo '<a style="color: #17a2b8; font-weight: 700;">Đã Duyệt</a>';
                                echo '<br>';
                                foreach($confirm_staff as $staff) {
                                  if($order_value->order_id == $staff->order_id) {
                                    echo "<small>ID: {$staff->staff_id} / {$staff->staff_name}</small>";
                                  }
                                }
                                break;
                            case '2':
                              echo '<a style="color: #17a2b8; font-weight: 700;">Đã Gửi Hàng</a>';
                              echo '<br>';
                              foreach($confirm_staff as $staff) {
                                echo "<small>ID: {$staff->staff_id} / {$staff->staff_name}</small>";
                                break;
                              }
                              break;
                        }
                    ?>
                  </td>
                   <td style="line-height: 34px;">
                    <a href="{{'view-order/'.$order_value->order_id}}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                    <a href="{{'del-order/'.$order_value->order_id}}" onclick="return confirm('Bạn muốn xóa Đơn hàng')" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <?php
              $mess = Session::get('message');
              if($mess) {
                  echo $mess;
                  Session::put('message',null);
              }
            ?>
            <!-- end project list -->

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection