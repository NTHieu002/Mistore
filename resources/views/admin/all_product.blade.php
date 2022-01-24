@extends('admin_layout')
@section('admin_content')
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Liệt Kê Sản Phẩm</h3>
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
            <h2>Tất Cả Sản Phẩm</h2>
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
                  <th style="width: 20%">Tên Sản Phẩm</th>
                  <th>Hình Ảnh</th>
                  <th>Số Lượng</th>
                  <th>Trạng Thái</th>
                  <th style="width: 20%">#Edit</th>
                </tr>
              </thead>
              <tbody>
                @foreach($all_product as $product_value)
                <tr>
                  <td>{{$product_value->product_id}}</td>
                  <td>
                    <a>{{$product_value->product_name}}</a>
                    <br />
                    <small>New!!</small>
                  </td>
                  <td>
                    <ul class="list-inline">
                      <li>
                        <img src="{{'public/uploads/products/'.$product_value->img_name}}" class="avatar" alt="Avatar">
                      </li>
                    </ul>
                  </td>
                  <td class="project_progress">
                    <div class="progress progress_sm">
                      <div class="progress-bar bg-green" role="progressbar" aria-valuemax="1000"
                      data-transitiongoal="{{$product_value->product_quantity}}"></div>
                    </div>
                    <small>{{$product_value->product_quantity}} Sản Phẩm</small>
                  </td>
                  <td>
                    <?php
                      if($product_value->product_status==0){ ?>
                        <a href="{{URL::to('/unActive-product/'.$product_value->product_id)}}" type="button" class="btn btn-success btn-xs" style="background-color: #dc3545;padding-left: 31px;
                            padding-right: 32px;"><?="Ẩn"?></a>
                      <?php } else { ?>
                        <a href="{{URL::to('/active-product/'.$product_value->product_id)}}" type="button" class="btn btn-success btn-xs"><?="Hiển Thị"?></a>
                      <?php }
                    ?>
                  </td>
                  <td>
                    <a href="{{URL::to('/edit-product/'.$product_value->product_id)}}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                    <a href="{{URL::to('/delete-product/'.$product_value->product_id)}}" onclick="return confirm('Bạn muốn xóa sản phẩm')" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <?php
              use Illuminate\Support\Facades\Session;
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