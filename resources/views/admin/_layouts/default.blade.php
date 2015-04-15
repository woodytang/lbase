<!DOCTYPE html>
<html>
@include('admin._layouts.partials.head')

<body class="fixed-header">

@include('admin._layouts.partials.sidebar')

<!-- START PAGE-CONTAINER -->
    <div class="page-container">
    @include('admin._layouts.partials.header')

    <!-- START PAGE CONTENT WRAPPER -->
          <div class="page-content-wrapper">
            <!-- START PAGE CONTENT -->
            <div class="content">
            @include('admin._layouts.partials.breadcrumb')

            <div class="container-fluid container-fixed-lg">

            @yield('content')

            </div>
            </div>
            <!-- END PAGE CONTENT -->
            @include('admin._layouts.partials.copyright')
           </div>
          <!-- END PAGE CONTENT WRAPPER -->

    </div>
<!-- END PAGE-CONTAINER -->


@include('admin._layouts.partials.overlay')

@include('admin._layouts.partials.footer')
@include('amaran::javascript')
</body>
</html>

