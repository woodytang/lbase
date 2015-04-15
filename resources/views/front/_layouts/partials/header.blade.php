<!-- BEGIN HEADER -->
<div class="header navbar navbar-inverse ">
    <!-- BEGIN TOP NAVIGATION BAR -->
    <div class="navbar-inner">
        <div class="header-seperation">
            <ul class="nav pull-left notifcation-center" id="main-menu-toggle-wrapper" style="display:none">
                <li class="dropdown">
                    <a id="horizontal-menu-toggle" href="#" class="">
                        <div class="iconset top-menu-toggle-white"></div>
                    </a>
                </li>
            </ul>
            <!-- BEGIN LOGO -->
            <a href="index.html"><img src="/front/assets/img/logo.png" class="logo" alt="" data-src="/front/assets/img/logo.png"
                                      data-src-retina="/front/assets/img/logo2x.png" width="106" height="21"/></a>
            <!-- END LOGO -->
            <ul class="nav pull-right notifcation-center">
                <li class="dropdown" id="header_task_bar"><a href="index.html" class="dropdown-toggle active"
                                                             data-toggle="">
                        <div class="iconset top-home"></div>
                    </a></li>
                <li class="dropdown" id="header_inbox_bar"><a href="email.html" class="dropdown-toggle">
                        <div class="iconset top-messages"></div>
                        <span class="badge" id="msgs-badge">2</span> </a></li>
                <li class="dropdown" id="portrait-chat-toggler" style="display:none"><a href="#sidr"
                                                                                        class="chat-menu-toggle">
                        <div class="iconset top-chat-white "></div>
                    </a></li>
            </ul>
        </div>
        <!-- END RESPONSIVE MENU TOGGLER -->
        <div class="header-quick-nav text-center row">
            <!-- BEGIN TOP NAVIGATION MENU -->
            <div class="pull-left" >
                <form  method="get" action="{!!url('api/search')!!}">
                <ul class="nav quick-section">
                    <li class="quicklinks">
                        <a href="#" class="" style="border-left: solid  29px #FA726D">
                         &nbsp;
                        </a>
                    </li>
                    <!-- <li class="quicklinks"><span class="h-seperate"></span></li>
                    <li class="quicklinks">
                        <a href="{!! url('/test')!!}" class="">
                            <div class="iconset top-reload"></div>
                        </a>
                    </li> -->
                    <li class="m-r-10 input-prepend inside search-form no-boarder">
                        <span class="add-on"> <span class="iconset top-search"></span></span>

                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input name="query" type="text" class="no-boarder" placeholder="搜索本站" style="width:250px;">

                    </li>
                </ul>
                </form>
            </div>

            <div class="relogo">

                <a href="{!!url('/')!!}" ><img src="/front/assets/img/logo-b2x.png" class="logo" alt=""
                                                                       data-src="/front/assets/img/logo-b2x.png"
                                                                       data-src-retina="/front/assets/img/logo-b2x.png" width="347"
                                                                       height="66"/></a>
            </div>
            <!-- END TOP NAVIGATION MENU -->
            <!-- BEGIN CHAT TOGGLER -->
            <div class="pull-right">

           

                <ul class="nav quick-section ">
                    <li class="quicklinks">
                        <a data-toggle="dropdown" class="dropdown-toggle  pull-right " href="#" id="user-options">
                            <i class="fa fa-keyboard-o"></i>
                        </a>
                        <ul class="dropdown-menu  pull-right" role="menu" aria-labelledby="user-options">
                            <li><a href="mailto:7272792@qq.com"> 投稿</a>
                            </li>

                        </ul>
                    </li>
                   <!-- <li class="quicklinks"><span class="h-seperate"></span></li>-->

                </ul>
                
            </div>
            <!-- END CHAT TOGGLER -->
        </div>
        <!-- END TOP NAVIGATION MENU -->

    </div>
    <!-- END TOP NAVIGATION BAR -->
</div>
<!-- END HEADER -->
