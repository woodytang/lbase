<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    @if(Request::is('posts/*') or Request::is('sections/*/posts/*'))
    <title>{{$post->title}}</title>
    @else
    <title>{{$options['site_name']}}</title>
    @endif
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="default" />
    <meta name="keywords" content="{{$options['key_words']}}">
    <meta content="{{$options['description']}}" name="description" />
    <meta content="" name="author" />
    <link rel="shortcut icon"  href="/favicon.ico" />

    <link href="/front/assets/plugins/jquery-metrojs/MetroJs.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="/front/assets/plugins/shape-hover/css/demo.css" />
    <link rel="stylesheet" type="text/css" href="/front/assets/plugins/shape-hover/css/component.css" />
    <link rel="stylesheet" type="text/css" href="/front/assets/plugins/owl-carousel/owl.carousel.css" />
    <link rel="stylesheet" type="text/css" href="/front/assets/plugins/owl-carousel/owl.theme.css" />
    <link href="/front/assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="/front/assets/plugins/jquery-slider/css/jquery.sidr.light.css" rel="stylesheet" type="text/css" media="screen"/>

    <!-- BEGIN CORE CSS FRAMEWORK -->
    <link href="/front/assets/plugins/boostrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="/front/assets/plugins/boostrapv3/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
    <link href="/front/assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
    <link href="/front/assets/css/animate.min.css" rel="stylesheet" type="text/css"/>
    <link href="/front/assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css"/>
    <!-- END CORE CSS FRAMEWORK -->

    <!-- BEGIN CSS TEMPLATE -->
    <link href="/front/assets/css/style.css" rel="stylesheet" type="text/css"/>
    <link href="/front/assets/css/responsive.css" rel="stylesheet" type="text/css"/>
    <link href="/front/assets/css/custom-icon-set.css" rel="stylesheet" type="text/css"/>
    <link href="/front/assets/css/magic_space.css" rel="stylesheet" type="text/css"/>
    <!-- END CSS TEMPLATE -->

    <!-- 百度统计 -->



<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "//hm.baidu.com/hm.js?6b417905d1f59b0c2dc3e9a3d9bf29da";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>




    @yield('custom_css')

    <link href="/front/assets/css/reset.css" rel="stylesheet" type="text/css"/>
</head>