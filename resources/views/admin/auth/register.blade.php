 @extends('admin._layouts.login_register')

 @section('content')

    <div class="register-container full-height sm-p-t-30">
      <div class="container-sm-height full-height">
        <div class="row row-sm-height">
          <div class="col-sm-12 col-sm-height col-middle">

            <h2>欢迎使用强大的LaraBase(尚未开放）</h2>
            <p>
              <small>
      创建一个新的LaraBase账号。 Sign in with <a href="#" class="text-info">Facebook</a> or <a href="#" class="text-info">Google</a>
    </small>
            </p>
            @include('admin.widgets.validation_error')
            <form id="form-register" class="p-t-15" method="POST" role="form" action="{{ url('/auth/register') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group form-group-default">
                    <label>用户名</label>
                    <input type="text" name="name" placeholder="请输入您的用户名" class="form-control" required>
                  </div>
                </div>

              </div>
             <div class="row">
                             <div class="col-sm-12">
                               <div class="form-group form-group-default">
                                 <label>电子邮箱</label>
                                 <input type="email" name="email" placeholder="请输入您的电子邮箱地址" class="form-control" required>
                               </div>
                             </div>
             </div>

              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group form-group-default">
                    <label>密码</label>
                    <input type="password" name="password" placeholder="最短6个字符" class="form-control" required>
                  </div>
                </div>

                <div class="col-sm-6">
                                  <div class="form-group form-group-default">
                                    <label>确认密码</label>
                                    <input type="password" name="password_confirmation" placeholder="请再输一遍您的密码" class="form-control" required>
                                  </div>
                                </div>
              </div>



              <div class="row m-t-10">
                <div class="col-md-6">
                  <p>我同意 <a href="#" class="text-info small">LaraBase使用条款</a> 及 <a href="#" class="text-info small">隐私条款</a>.</p>
                </div>
                <div class="col-md-6 text-right">
                  <a href="#" class="text-info small">需要帮助？请联系我们</a>
                </div>
              </div>
              <button class="btn btn-primary btn-cons m-t-10" type="submit">注册</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class=" full-width">
      <div class="register-container m-b-10 clearfix">
        <div class="inline pull-left">
          <img src="/assets/assets/img/demo/pages_icon.png" alt="" class="m-t-5 " data-src="/assets/assets/img/demo/pages_icon.png" data-src-retina="/assets/assets/img/demo/pages_icon_2x.png" width="60" height="60">
        </div>
        <div class="col-md-10 m-t-15">
          <p class="hinted-text small inline ">No part of this website or any of its contents may be reproduced, copied, modified or adapted, without the prior written consent of the author, unless otherwise indicated for stand-alone materials.</p>
        </div>
      </div>
    </div>
 @stop