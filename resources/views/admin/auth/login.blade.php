 @extends('admin._layouts.login_register')

 @section('content')
 <div class="login-wrapper ">
      <!-- START Login Background Pic Wrapper-->
      <div class="bg-pic">
        <!-- START Background Pic-->
        <img src="/assets/assets/img/demo/new-york-city-buildings-sunrise-morning-hd-wallpaper.jpg" data-src="/assets/assets/img/demo/new-york-city-buildings-sunrise-morning-hd-wallpaper.jpg" data-src-retina="/assets/assets/img/demo/new-york-city-buildings-sunrise-morning-hd-wallpaper.jpg" alt="" class="lazy">
        <!-- END Background Pic-->
        <!-- START Background Caption-->
        <div class="bg-caption pull-bottom sm-pull-bottom text-white p-l-20 m-b-20">
          <h2 class="semi-bold text-white">
					LaraBase</h2>
          <p class="small">
            PHP工匠之家
          </p>
        </div>
        <!-- END Background Caption-->
      </div>
      <!-- END Login Background Pic Wrapper-->
      <!-- START Login Right Container-->
      <div class="login-container bg-white">
        <div class="p-l-50 m-l-20 p-r-50 m-r-20 p-t-50 m-t-30 sm-p-l-15 sm-p-r-15 sm-p-t-40">
          <img src="/front/assets/img/logo-b2x.png" alt="logo" data-src="/front/assets/img/logo-b2x.png" data-src-retina="/front/assets/img/logo-b2x.png" width="320" >
          <p class="p-t-35 p-l-15">登录LaraBase后台</p>

          @include('admin.widgets.validation_error')
          <!-- START Login Form -->
          <form id="form-login" method="POST" class="p-t-15" role="form" action="{{ url('/auth/login') }}">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <!-- START Form Control-->
            <div class="form-group form-group-default">
              <label>邮箱</label>
              <div class="controls">
                <input type="email" name="email" placeholder="请输入Email" class="form-control">
              </div>
            </div>
            <!-- END Form Control-->
            <!-- START Form Control-->
            <div class="form-group form-group-default">
              <label>密码</label>
              <div class="controls">
                <input type="password" class="form-control" name="password" placeholder="请输入密码">
              </div>
            </div>
            <!-- START Form Control-->
            <div class="row">
              <div class="col-md-6 no-padding">
                <div class="checkbox ">
                  <input type="checkbox" value="1" id="checkbox1" name="remember">
                  <label for="checkbox1">记住登录</label>
                </div>
              </div>
              <div class="col-md-6 text-right">
                <a href="#" class="text-info small">需要帮助？请联系我们</a>
              </div>
            </div>
            <!-- END Form Control-->
            <input class="btn btn-primary btn-cons m-t-10" type="submit" value="登录">
              <a href="{{action('Auth\AuthController@getRegister')}}" class="btn btn-success btn-cons m-t-10">注册</a>
          </form>

          <!--END Login Form-->

        </div>
      </div>
      <!-- END Login Right Container-->
    </div>
 </div>
@stop