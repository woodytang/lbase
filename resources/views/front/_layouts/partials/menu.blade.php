
<div class="bar">
    <div class="row">
    <div class="bar-inner">
        <ul>
            @foreach($menus  as $menu)

            @if( Request::url() == Config::get('app.url').$menu->link)
            <li class="horizontal active">
            @else
            <li class="horizontal">

            @endif

                @if($menu->getImmediateDescendants()->first())
                <a href="javascript:;">
                    {{$menu->name}} <span class="arrow"></span>
                </a>

                <ul class="horizontal">

                   <div class="row"> 

                    @foreach($menu->getImmediateDescendants() as $submenu)

                    <li> 
                        <a href="{!! Config::get('app.url').$submenu->link !!}}">{{$submenu->name}}</a>
                    </li>
                    @endforeach

                    </div>
  
                </ul>
                @else
                <a href="{{Config::get('app.url').$menu->link}}">
                    {{$menu->name}} <span class="arrow" style="color: #F4F5F7"></span>
                </a>
                @endif
            </li>
            @endforeach
            <li class="mega ">
                <a href="javascript:;">
                    <span class="semi-bold">关于</span><span class="arrow"></span>
                </a>
                <ul class="mega ">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-3 ">
                                <div class="sub-menu-heading bold"><h3>欢迎！Welcome！</h3></div>
                                <div style="padding:20px">
                                <img src="/front/assets/img/chimp.jpg" alt="" data-src="/front/assets/img/chimp.jpg" data-src-retina="/front/assets/img/chimp.jpg" height="135" width="130">
</div>
                            </div>
                            <div class="col-sm-3">
                                <div class="sub-menu-heading bold"> 关于</div>

                                <ul class="sub-menu">
                                    @foreach($mega1  as $menu)
                                    <li > <a href="{!! Config::get('app.url').$menu->link !!}}">{{$menu->name}}</a></li>
                                    @endforeach

                                </ul>
                            </div>
                            <div class="col-sm-3">
                                <div class="sub-menu-heading bold">官方资源</div>
                                <ul class="sub-menu">
                                    @foreach($mega2  as $menu)
                                    <li > <a href="{!! $menu->link !!}}">{{$menu->name}}</a></li>
                                    @endforeach
                                </ul>
                                <div class="sub-menu-heading bold"> 国内</div>
                                <ul class="sub-menu">
                                    @foreach($mega3  as $menu)
                                    <li > <a href="{!! $menu->link !!}}">{{$menu->name}}</a></li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="col-sm-3">
                                <div class="sub-menu-heading bold">重要扩展</div>
                                <ul class="sub-menu">
                                    @foreach($mega4  as $menu)
                                    <li > <a href="{!! $menu->link !!}}">{{$menu->name}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </ul>
            </li>
        </ul>

    </div>
    </div>

</div>

@section('custom_js')


<script type="text/javascript">
    $(document).ready(function(){

        


    });
</script>



@stop
