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
        <h3>Liệt Kê Bình Luân</h3>
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
            <h2>Tất Cả Bình Luận</h2>
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
            <div id="notify_cmt"></div>
            <?php
              $mess = Session::get('message');
              if($mess) {
                  echo $mess;
                  Session::put('message',' ');
              }
            ?>
            <!-- start project list -->
            <table class="table table-striped projects">
              <thead>
                <tr>
                  <th style="width: 1%">STT</th>
                  <th style="width: 20%">Khách Hàng</th>
                  <th>Bình Luận</th>
                  <th>Sản Phẩm</th>
                  <th>Ngày Gửi</th>
                  <th>Trạng Thái</th>
                  <th style="width: 25%">#Edit</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1;?>
                @foreach($comment as $comment_value)
                <tr>
                   <td style="line-height: 34px;">{{$i++}}</td>
                   <td >
                    <a>{{$comment_value->comment_name_user}}</a>
                  </td>
                  <td style="line-height: 34px;">{{$comment_value->comment}}
                    <ol>
                      @foreach ($comment_rep as $rep_cmt )
                        @if ($rep_cmt->comment_parent == $comment_value->comment_id)
                            <li>{{$rep_cmt->comment}}</li>
                        @endif
                      @endforeach
                    </ol>

                    @if($comment_value->comment_status == 1)
                    <textarea class="form-control rep-comment_{{$comment_value->comment_id}}" rows="1"> </textarea>
                    @endif
                  </td>
                   <td style="line-height: 34px;">{{$comment_value->product->product_name}}</td>
                   <td style="line-height: 34px;">{{$comment_value->comment_date}}</td>
                   <td >
                    <?php
                        switch($comment_value->comment_status) {
                            case '0':
                                echo '<a style="color: #e92b3d; font-weight: 700;">Chờ Duyệt</a>';
                                break;
                            case '1':
                                echo '<a style="color: #17a2b8; font-weight: 700;">Đã Duyệt</a>';
                        }
                    ?>
                  </td>
                   <td style="line-height: 34px;">
                    <a href="{{'confirm-comment/'.$comment_value->comment_id}}" class="btn btn-info btn-xs" style="background-color: #37a911;"><i class="fa fa-pencil"></i> Duyệt</a>
                    @if($comment_value->comment_status == 1)
                    <button  class="btn btn-info btn-xs btn-rep-cmt" data-product_id="{{$comment_value->comment_id}}" id="{{$comment_value->comment_product_id}}" data-comment_id="{{$comment_value->comment_id}}"><i class="fa fa-pencil"></i> Rep </button>
                    @endif
                    <a href="{{'del-comment/'.$comment_value->comment_id}}" onclick="return confirm('Bạn Muốn Xóa Bình Luận')" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            
            <!-- end project list -->

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection