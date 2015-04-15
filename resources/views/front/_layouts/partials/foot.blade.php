<!-- BEGIN CORE JS FRAMEWORK-->

<script src="/front/assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script>
<script src="/front/assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
<script src="/front/assets/plugins/boostrapv3/js/bootstrap.min.js" type="text/javascript"></script>
<!--窗口缩放时的事件插件-->
<script src="/front/assets/plugins/breakpoints.js" type="text/javascript"></script>
<!--lazy load images-->
<script src="/front/assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script>
<script src="/front/assets/plugins/jquery-block-ui/jqueryblockui.js" type="text/javascript"></script>
<script src="/front/assets/plugins/jquery-lazyload/jquery.lazyload.min.js" type="text/javascript"></script>
<script src="/front/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js" type="text/javascript"></script>
<!-- END CORE JS FRAMEWORK -->
<!-- BEGIN PAGE LEVEL JS -->

<script src="/front/assets/plugins/pace/pace.min.js" type="text/javascript"></script>
<script src="/front/assets/plugins/jquery-numberAnimate/jquery.animateNumbers.js" type="text/javascript"></script>


<script src="/front/assets/plugins/owl-carousel/owl.carousel.min.js" type="text/javascript"></script>

<script src="/front/assets/plugins/shape-hover/js/snap.svg-min.js"></script>

<script src="/front/assets/plugins/jquery-metrojs/MetroJs.min.js" type="text/javascript" ></script>
<script src="/front/assets/plugins/jquery-jvectormap/js/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
<script src="/front/assets/plugins/jquery-jvectormap/js/jquery-jvectormap-us-lcc-en.js" type="text/javascript"></script>

<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN CORE TEMPLATE JS -->
<script src="/front/assets/js/core.js" type="text/javascript"></script>
<script src="/front/assets/js/demo.js" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $(".live-tile,.flip-list").liveTile();
    });

</script>
<!-- END CORE TEMPLATE JS -->




@yield('custom_js')