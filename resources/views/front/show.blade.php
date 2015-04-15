@extends('front._layouts.default')

@section('custom_css')
<link href="/assets/assets/plugins/CodeMirror/lib/codemirror.css" rel="stylesheet" type="text/css" media="screen">
<link href="/assets/assets/plugins/CodeMirror/theme/neo.css" rel="stylesheet" type="text/css" media="screen">
<link href="/assets/assets/plugins/CodeMirror/addon/scroll/simplescrollbars.css" rel="stylesheet" type="text/css" media="screen">

<style>

    .page-content{

        background-color: #EAEAEA;
    }

    body {
        font-size: 15px ! important;
    };

    

</style>

@stop

@section('content')





    @if($post->category->name == '页面')
        <div class="row add-border-bottom">
        <div class="col-md-10 col-md-offset-1 m-b-20">
            <h2 style="font-weight: bold">{{$post->title}}</h2>
        </div>

    </div>

    <div class="row">

    <div class="col-md-10 col-md-offset-1">

        <div class="text">

                    <p>{!!$post->content!!}</p>

                </div>
                </div>
                 </div>



    @else

        <div class="row add-border-bottom">
        <div class="col-md-12 m-b-20">
            <h2 style="font-weight: bold">{{$post->title}}</h2>
        </div>

    </div>

    <div class="row ">

        <div class="col-md-8 right-border">
            <div class="row m-t-20">
                <div class="col-md-12">
                    <ul class="ul-h-list clearfix">
                        <li><i class="fa fa-folder-open-o"></i>&nbsp;&nbsp;新手</li>
                        <li><i class="fa fa-calendar-o"></i>&nbsp;&nbsp;{!!date('Y-m-d',strtotime($post->created_at))!!}</li>
                        <li><i class="fa fa-hand-o-up"></i>&nbsp;&nbsp;{{$post->clicks}}</li>
                        <li><i class="fa fa-comment-o"></i>&nbsp;&nbsp; <span class="ds-thread-count" data-thread-key="{!! $post->id !!}" data-count-type="comments"></span></li>


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


</li>
                    </ul>

                </div>
            </div>

            <div class="col-md-2">
                @if(isset($tags))
                <h4><span class="semi-bold">标签</span></h4>

                <div class="tag-list">

                    @foreach($tags as $tag )
                    <a href="{!!route('tag_listing_path',$tag->id)!!}" title="{!!$tag->name!!}" class="hashtags transparent recolor tag-item"> #{!!$tag->name!!} </a>

                    @endforeach

                </div>
                @endif
                <div class="circle circle-border">
                    <div class="circle-inner">
                        <div class="score-text">
                           <span class="semi-bold">By</span>
                        </div>
                    </div>
                </div>


                <div class="row">
                <div class="becenter"><img width="69" height="69" data-src-retina="{!!$post->user->avatar->url('medium')!!}" data-src="{!!$post->user->avatar->url('medium')!!}" src="{!!$post->user->avatar->url('medium')!!}" alt="" class="img-circle "></div>

                <h5 class="becenter">{!!$post->user->name!!}</h5>

                </div>

            </div>
            <div class="col-md-10 m-b-40">
                @if(isset($post->feature_file_name))

                <div class="inpost_image">
                    <a href="" title="{{$post->title}}">

                        <img src='<?= $post->feature->url() ?>' width="600" alt='img' style="display: none;">

                    </a>
                </div>
                @endif
                <div class="text">

                    <p>{!!$post->content!!}</p>

                </div>

            </div>
        </div>
        <div class="col-md-4">
            @if(isset($tags))
            <h4>相关<span class="semi-bold color-red">文章</span></h4>

            <ul>
                @foreach($related as $related_post)
                <li><h5><a href="{!!route('post_path',$post->id)!!}">{!!$related_post->title !!}</a></h5> </li>

                @endforeach
            </ul>
            @endif

            <div class="m-t-20">
            
<!-- 多说评论框 start -->
    <div class="ds-thread" data-thread-key="{!! $post->id !!}" data-title="{!! $post->title !!}" data-url="{!! Request::url() !!}"></div>
<!-- 多说评论框 end -->
<!-- 多说公共JS代码 start (一个网页只需插入一次) -->
<script type="text/javascript">
var duoshuoQuery = {short_name:"larabase"};
    (function() {
        var ds = document.createElement('script');
        ds.type = 'text/javascript';ds.async = true;
        ds.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') + '//static.duoshuo.com/embed.unstable.js';
        ds.charset = 'UTF-8';
        (document.getElementsByTagName('head')[0] 
         || document.getElementsByTagName('body')[0]).appendChild(ds);
    })();
    </script>
<!-- 多说公共JS代码 end -->



            </div>
        </div>

    </div>


@endif


@stop

@section('custom_js')

<script src="/assets/assets/plugins/CodeMirror/lib/codemirror.js" type="text/javascript"></script>
<script src="/assets/assets/plugins/CodeMirror/mode/javascript/javascript.js" type="text/javascript"></script>
<script src="/assets/assets/plugins/CodeMirror/mode/clike/clike.js" type="text/javascript"></script>
<script src="/assets/assets/plugins/CodeMirror/mode/php/php.js" type="text/javascript"></script>
<script src="/assets/assets/plugins/CodeMirror/addon/selection/active-line.js" type="text/javascript"></script>
<script src="/assets/assets/plugins/CodeMirror/addon/scroll/simplescrollbars.js" type="text/javascript"></script>

<script>

    $(document).ready(function() {

        $('pre').each(function() {

            var $this = $(this),
                $code = $this.html(),
                $unescaped = $('<pre/>').html($code).text();

            $this.empty();

            var myCodeMirror = CodeMirror(this, {
                value: $unescaped,
                mode: 'text/x-php',
                lineNumbers: !$this.is('.inline'),
                readOnly: 'nocursor',
                theme: 'neo',
                styleActiveLine: false,
                scrollbarStyle: "simple",
                lineWrapping:true

            });

        });
    });
</script>




@stop