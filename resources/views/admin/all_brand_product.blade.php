@extends('admin_layout')
@section('admin_content')
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Liệt Kê Thương Hiệu Sản Phẩm </h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5   form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Tìm kiếm sản phẩm....">
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
                    <h2>Tất cả Thương Hiệu</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li>&nbsp;</li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <table class="table table-striped projects">
                        <thead>
                            <tr>
                                <th style="width: 1%">STT</th>
                                <th style="width: 20%">Tên Thương Hiệu</th>
                                <th>Mô Tả</th>
                                <th>Ngày Thêm</th>
                                <th style="width: 20%">Hiển Thị</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach($all_brand as $key )
                          <tr>
                          <td style="line-height: 34px;">{{$key->brand_id}}</td>
                          <td style="line-height: 34px;">
                              <a>{{$key->brand_name}}</a>
                          </td>
                          <td style="line-height: 34px;">
                              {{$key->brand_desc}}
                          </td>
                          <td style="line-height: 34px;">{{$key->created_at}}</td>
                          <td style="line-height: 34px;">
                              <?php
                                if($key->brand_status==0){ ?>
                                  <a href="{{URL::to('/unActive-brand/'.$key->brand_id)}}" type="button" class="btn btn-success btn-xs" style="background-color: #dc3545;padding-left: 31px;
                                      padding-right: 32px;"><?="Ẩn"?></a>
                                <?php } else { ?>
                                  <a href="{{URL::to('/active-brand/'.$key->brand_id)}}" type="button" class="btn btn-success btn-xs"><?="Hiển Thị"?></a>
                                <?php }
                              ?>
                          </td>
                          <td style="line-height: 34px;">
                              <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a>
                              <a href="{{URL::to('/edit-brand/'.$key->brand_id)}}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                              <a href="{{URL::to('/delete-brand/'.$key->brand_id)}}" onclick="return confirm('Bạn muốn xóa thương hiệu')" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
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
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
@endsection