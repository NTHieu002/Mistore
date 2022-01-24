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
        <h3>Liệt Kê Nhân Viên</h3>
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
            <h2>Tất Cả Nhân Viên</h2>
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
                  <th style="width: 20%">Tên Nhân Viên</th>
                  <th>SDT</th>
                  <th>Email</th>
                  <th>Chức Vụ</th>
                  <th style="width: 20%">#Edit</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1;?>
                @foreach($all_staff as $staff_value)
                <tr>
                   <td style="line-height: 34px;">{{$i++}}</td>
                   <td style="line-height: 34px;" ><a>{{$staff_value->staff_name}}</a></td>
                    <td style="line-height: 34px;"> Phone: {{$staff_value->staff_phone}}</td>
                   <td style="line-height: 34px;">{{$staff_value->staff_email}}</td>
                   <td style="line-height: 34px;">
                    <form action="{{'update-staff/'.$staff_value->staff_id}}" method="get">
                        <select name="staff_position" id="">
                            <option value="1">{{$staff_value->staff_position}}</option>
                            @if($staff_value->staff_permission==1)
                            <option value="2">Nhân Viên</option>
                            @else
                            <option value="1">Quản lý</option>
                            @endif
                        </select>
                    </td>
                    <td style="line-height: 34px;">
                        <button type="summit" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Update </button>
                    </form>
                    <a href="{{'del-staff/'.$staff_value->staff_id}}" onclick="return confirm('Bạn muốn xóa nhân viên')" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
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