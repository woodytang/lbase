<!DOCTYPE html>
<html>
@include('front._layouts.partials.head')



<body class="horizontal-menu">



@include('front._layouts.partials.header')
<!-- BEGIN CONTAINER -->
<div class="page-container row-fluid">
    <!-- BEGIN PAGE CONTAINER-->
    <div class="page-content">

        @include('front._layouts.partials.menu')

        <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
        <div id="portlet-config" class="modal hide">
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button"></button>
                <h3>Widget Settings</h3>
            </div>
            <div class="modal-body"> Widget settings form goes here </div>
        </div>
        <div class="clearfix"></div>
        <div class="content m-b-40">

        @yield('content')
        </div>

    </div>
    <!-- END PAGE CONTAINER-->
    @include('front._layouts.partials.footer')

</div>
<!-- END CONTAINER -->



@include('front._layouts.partials.foot')
</body>
</html>

