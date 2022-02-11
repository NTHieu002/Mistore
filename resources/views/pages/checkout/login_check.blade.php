<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Mi Store | Login </title>

    <!-- Bootstrap -->
    <link href="{{asset('public/backend/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('public/backend/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{asset('public/backend/vendors/nprogress/nprogress.css')}}" rel="stylesheet">
    <!-- Animate.css -->
    <link href="{{asset('public/backend/vendors/animate.css/animate.min.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{asset('public/backend/build/css/custom.min.css')}}" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>
    
      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form method="get" action="{{URL::to('index')}}">
              {{csrf_field()}}
              <h1>Đăng Nhập</h1>
              <?php
                use Illuminate\Support\Facades\Session;
                $message = Session::get('message');
                if($message) {
                  echo $message;
                  Session::put('message',null);
                }
              ?>
              <div>
                <input name="user_email" type="text" class="form-control" placeholder="Email" required="" />
              </div>
              <div>
                <input name="user_password" type="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <button class="btn btn-default submit" type="submit">Login</button>
                <a class="reset_pass" href="#">Lost your password?</a>
              </div>
            </form>
            <div class="" style="display: flex; justify-content: space-between; margin: 0 40px;" >
              <a style="font-size: 20px;" href="{{url::to('/login-social/facebook')}}"><i class="fa fa-facebook-square"> Facebook</i></a>
              <a style="font-size: 20px;" href="{{url::to('/login-social/google')}}"><i class="fa fa-google"> Google</i></a>
            </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">New to site?
                  <a href="#signup" class="to_register"> Đăng Ký </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> Mi Store!</h1>
                  <p>©2016 All Rights Reserved. Mi Store! Privacy and Terms</p>
                </div>
              </div>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form  method="post" action="{{('resister-account')}}">
                {{csrf_field()}}
              <h1>Đăng Ký</h1>
              <div>
                <input name="user_name" type="text" class="form-control" placeholder="Name" required="" />
              </div>
              <div>
                <input name="email" type="email" class="form-control" placeholder="Email" required="" />
              </div>
              <div>
                <input name="password" type="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <input name="phone" type="text " class="form-control" placeholder="Phone" required="" />
              </div>
              <div style="margin-top: 22px;">
                <input name="address" type="text" class="form-control" placeholder="Address" required="" />
              </div>
              <div>
                <button type="submit" class="btn btn-default submit" >Đăng Ký</button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="{{'login-checkout'}}" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> Mi Store!</h1>
                  <p>©2016 All Rights Reserved. Mi Store! Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
