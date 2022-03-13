<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="icon" href="{{asset('public/backend/build/images/favicon.ico')}}" type="image/ico" />

    <title>Admin | Mistore</title>

    <!-- Bootstrap -->
    <link href="{{asset('public/backend/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('public/backend/vendors/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{asset('public/backend/vendors/nprogress/nprogress.css')}}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{asset('public/backend/vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">
	
    <!-- bootstrap-progressbar -->
    <link href="{{asset('public/backend/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet">
    <!-- JQVMap -->
    <link href="{{asset('public/backend/vendors/jqvmap/dist/jqvmap.min.css')}}" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="{{asset('public/backend/vendors/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{asset('public/backend/build/css/custom.min.css')}}" rel="stylesheet">
    <meta name="csrf-token" content="{{csrf_token()}}">
  </head>

  <body class="nav-md">
    
  <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0">
              <a href="{{('/Mistore/')}}" class="site_title"
                ><i class="fa fa-home"></i> <span>Mistore</span></a
              >
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <a href="{{'dashboard'}}">
                <div class="profile_pic">
                  <img
                    src="{{asset('public/backend/build/images/Xiaomi 2021 New.png')}}"
                    alt="..."
                    class="img-circle profile_img"
                  />
                </div>

              </a>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2> 
                  <?php
                    use Illuminate\Support\Facades\Session;
                    $name = Session::get('admin_name');
                    if($name) {
                      echo $name;
                    }
                  ?>
                </h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div
              id="sidebar-menu"
              class="main_menu_side hidden-print main_menu"
            >
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li>
                    <a><i class="fa fa-home"></i> Home
                      <span class="fa fa-chevron-down"></span>
                    </a>
                    <ul class="nav child_menu">
                      <li><a href="{{URL::to('manage-order')}}">Quản Lý Đơn Hàng</a></li>
                      <li><a href="{{URL::to('manage-comment')}}">Quản Lý Bình Luận</a></li>
                    </ul>
                  </li>
                  <li>
                    <a><i class="fa fa-tags"></i> Quản Lý Coupon
                      <span class="fa fa-chevron-down"></span>
                    </a>
                    <ul class="nav child_menu">
                      <li><a href="{{URL::to('all-coupon')}}">Liệt Kê Mã Coupon</a></li>
                      <li><a href="{{URL::to('add-coupon')}}">Thêm Mã Coupon</a></li>
                    </ul>
                  </li>
                  <li>
                    <a><i class="fa fa-edit"></i> Quản Lý Thương Hiệu
                      <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{URL::to('all-brand')}}">Liệt Kê Thương Hiệu Sản Phẩm</a></li>
                      <li><a href="{{URL::to('add-brand')}}">Thêm Thương Hiệu Sản Phẩm</a></li>
                    </ul>
                  </li>
                  <li>
                    <a><i class="fa fa-indent"></i> &nbsp; 
                      Quản Lý Danh Mục 
                      <span class="fa fa-chevron-down"></span>
                    </a>
                    <ul class="nav child_menu">
                      <li><a href="{{URL::to('all-category')}}">Liệt Kê Danh Mục Sản Phẩm</a></li>
                      <li><a href="{{URL::to('add-category')}}">Thêm Danh Mục Sản Phẩm</a></li>
                    </ul>
                  </li>
                  <li>
                    <a><i class="fa fa-edit"></i> 
                      Quản Lý Sản Phẩm
                      <span class="fa fa-chevron-down"></span>
                    </a>
                    <ul class="nav child_menu">
                      <li><a href="{{URL::to('add-product')}}">Thêm Sản Phẩm</a></li>
                      <li><a href="{{URL::to('all-product')}}">Liệt Kê Sản Phẩm</a></li>
                    </ul>
                  </li>
                  <?php 
                    $permission = Session::get('admin_permission');
                    if($permission < 2) { ?>
                      <li>
                        <a><i class="fa fa-users"></i> &nbsp;
                            Quản Lý Nhân sự
                          <span class="fa fa-chevron-down"></span>
                        </a>
                        <ul class="nav child_menu">
                          <li><a href="{{URL::to('add-staff')}}">Thêm Tài Khoản Nhân Viên</a></li>
                          <li><a href="{{URL::to('all-staff')}}">Liệt Kê Nhân Viên</a></li>
                        </ul>
                      </li>
                    <?php } ?>
                  <li><a><i class="fa fa-bar-chart-o"></i> Báo Cáo <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="chartjs.html">Báo Cáo Bán Hàng</a></li>
                      <li><a href="chartjs2.html">Báo Cáo Khiếu Nại</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->
            
            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span
                  class="glyphicon glyphicon-fullscreen"
                  aria-hidden="true"
                ></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span
                  class="glyphicon glyphicon-eye-close"
                  aria-hidden="true"
                ></span>
              </a>
              <a
                data-toggle="tooltip"
                data-placement="top"
                title="Logout"
                href="login.html"
              >
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <div class="nav toggle">
              <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>
            <nav class="nav navbar-nav">
              <ul class="navbar-right">
                <li class="nav-item dropdown open" style="padding-left: 15px">
                  <a
                    href="javascript:;"
                    class="user-profile dropdown-toggle"
                    aria-haspopup="true"
                    id="navbarDropdown"
                    data-toggle="dropdown"
                    aria-expanded="false"
                  >
                    <img src="{{asset('public/backend/build/images/Xiaomi 2021 New.png')}}" alt="" />
                    <?php
                      $name = Session::get('admin_name');
                      if($name) {
                        echo $name;
                      }
                    ?>
                  </a>
                  <div
                    class="dropdown-menu dropdown-usermenu pull-right"
                    aria-labelledby="navbarDropdown"
                  >
                    <a class="dropdown-item" href="javascript:;"> Profile</a>
                    <a class="dropdown-item" href="javascript:;">
                      <span class="badge bg-red pull-right">50%</span>
                      <span>Settings</span>
                    </a>
                    <a class="dropdown-item" href="javascript:;">Help</a>
                    <a class="dropdown-item" href="{{URL::to('/logOut')}}"
                      ><i class="fa fa-sign-out pull-right"></i> Log Out</a
                    >
                  </div>
                </li>

                <li role="presentation" class="nav-item dropdown open">
                
                  <ul
                    class="dropdown-menu list-unstyled msg_list"
                    role="menu"
                    aria-labelledby="navbarDropdown1"
                  >
                    <li class="nav-item">
                      <a class="dropdown-item">
                        <span class="image"
                          ><img src="" alt="Profile Image"
                        /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie
                          makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="dropdown-item">
                        <span class="image"
                          ><img src="" alt="Profile Image"
                        /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie
                          makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="dropdown-item">
                        <span class="image"
                          ><img src="" alt="Profile Image"
                        /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie
                          makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="dropdown-item">
                        <span class="image"
                          ><img src="" alt="Profile Image"
                        /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie
                          makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <div class="text-center">
                        <a class="dropdown-item">
                          <strong>See All Alerts</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        @yield('admin_content')
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Mistore
            <a href="">Colorlib</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="{{asset('public/backend/vendors/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{asset('public/backend/vendors/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{asset('public/backend/vendors/fastclick/lib/fastclick.js')}}"></script>
    <!-- NProgress -->
    <script src="{{asset('public/backend/vendors/nprogress/nprogress.js')}}"></script>
    <!-- Chart.js -->
    <script src="{{asset('public/backend/vendors/Chart.js/dist/Chart.min.js')}}"></script>
    <!-- gauge.js -->
    <script src="{{asset('public/backend/vendors/gauge.js/dist/gauge.min.js')}}"></script>
    <!-- bootstrap-progressbar -->
    <script src="{{asset('public/backend/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js')}}"></script>
    <!-- iCheck -->
    <script src="{{asset('public/backend/vendors/iCheck/icheck.min.js')}}"></script>
    <!-- Skycons -->
    <script src="{{asset('public/backend/vendors/skycons/skycons.js')}}"></script>
    <!-- Flot -->
    <script src="{{asset('public/backend/vendors/Flot/jquery.flot.js')}}"></script>
    <script src="{{asset('public/backend/vendors/Flot/jquery.flot.pie.js')}}"></script>
    <script src="{{asset('public/backend/vendors/Flot/jquery.flot.time.js')}}"></script>
    <script src="{{asset('public/backend/vendors/Flot/jquery.flot.stack.js')}}"></script>
    <script src="{{asset('public/backend/vendors/Flot/jquery.flot.resize.js')}}"></script>
    <!-- Flot plugins -->
    <script src="{{asset('public/backend/vendors/flot.orderbars/js/jquery.flot.orderBars.js')}}"></script>
    <script src="{{asset('public/backend/vendors/flot-spline/js/jquery.flot.spline.min.js')}}"></script>
    <script src="{{asset('public/backend/vendors/flot.curvedlines/curvedLines.js')}}"></script>
    <!-- DateJS -->
    <script src="{{asset('public/backend/vendors/DateJS/build/date.js')}}"></script>
    <!-- JQVMap -->
    <script src="{{asset('public/backend/vendors/jqvmap/dist/jquery.vmap.js')}}"></script>
    <script src="{{asset('public/backend/vendors/jqvmap/dist/maps/jquery.vmap.world.js')}}"></script>
    <script src="{{asset('public/backend/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js')}}"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{asset('public/backend/vendors/moment/min/moment.min.js')}}"></script>
    <script src="{{asset('public/backend/vendors/bootstrap-daterangepicker/daterangepicker.js')}}"></script>

    <!-- Custom Theme Scripts -->
    <script src="{{asset('public/backend/build/js/custom.min.js')}}"></script>
    <script type="text/javascript">
      $('.btn-rep-cmt').click(function(){
        var comment_id = $(this).data('comment_id');
        var comment = $('.rep-comment_'+comment_id).val();
        var comment_product_id = $(this).data('product_id');

        $.ajax({
          url:"{{url('/reply-comment')}}",
          method:"POST",
          headers: {
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
          },
          data:{comment:comment, comment_id:comment_id, comment_product_id:comment_product_id},
          success:function(data) {
            var comment = $('.rep-comment_'+comment_id).val(' ');
            $('#notify_cmt').html('<span class="text text-alert">Trả lời thành công</span>');
          }
        });
      });
    </script>
	
  </body>
</html>
