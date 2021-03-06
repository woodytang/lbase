@extends('front._layouts.default')

@section('content')

<div class="row add-border-bottom">
    <div class="col-md-12 m-b-20">
        <h3>分类：<span class="semi-bold color-red">{{$category->name}}</span></h3>
    </div>

</div>

<div class="row m-t-20 ">

    @foreach($posts as $post)
    <div class="col-md-3 m-b-10 reset-padding">
        <div class="row">
            <!-- BEGIN BLOG POST SIMPLE -->
            <div class="col-md-12 m-b-10 reset-padding">
                <div class="widget-item ">

                    <div class="tiles purple " style="max-height:345px; min-height: 210px;">
                        <div class="tiles-body">

                           
                            <a href="{{route('post_path',[$post->id])}}">
                            <h3 class="text-white m-t-20 m-b-10 "> <span class="semi-bold">{{$post->title}} </h3></a>
                            <div class="overlayer bottom-right fullwidth">

                                <div class="user-comment-wrapper pull-left">
                                    <div class="post p-t-10 p-b-10">
                                        <ul class="action-bar no-margin p-b-20 ">
                                            <li><a href="#" class="muted bold"><i class="fa fa-comment  m-r-10"></i> <span class="ds-thread-count" data-thread-key="{{$post->id}}" data-count-type="comments"></span></a> </li>
                                            
                                            <li><a href="#" class="muted bold"><i class="fa fa-hand-o-up  m-r-10"></i>{{$post->clicks}}</a> </li>
                                        </ul>
                                        <div class="clearfix"></div>
                                    </div>

                                </div>
                                <div class="post p-t-10 p-b-10">
                                <div class="pull-right m-r-20 "> <span class="bold text-white small-text">{{date('Y-m-d',strtotime($post->created_at))}}</span> </div>
                                    </div>

                            </div>
                            <br>
                        </div>
                    </div>
                    <div class="tiles white ">
                        <div class="tiles-body" style="min-height: 130px;padding: 19px 10px 15px 10px">
                            <div class="row">


                                <div class="clearfix"></div>
                                <div class="p-l-15  p-r-20 text_gray">
                                     
                                     {!!$post->present()->getTrimedContent(80)!!}

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END BLOG POST SIMPLE -->
        </div>

    </div>

    @endforeach


</div>

<div class="row m-t-20">
    <div class="col-md-12">
        {!! with(new App\Presenters\LaraBaseFrontPaginationPresenter($posts))->render() !!}
    </div>
</div>

<!-- 多说js加载开始，一个页面只需要加载一次 -->
<script type="text/javascript">
var duoshuoQuery = {short_name:"larabase"};
(function() {
    var ds = document.createElement('script');
    ds.type = 'text/javascript';ds.async = true;
    ds.src = 'http://static.duoshuo.com/embed.js';
    ds.charset = 'UTF-8';
    (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(ds);
})();
</script>


@stop
