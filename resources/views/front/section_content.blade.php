@extends('front._layouts.default')

@section('custom_css')

<link href="/assets/assets/plugins/jquery-dynatree/skin/ui.dynatree.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="/assets/assets/plugins/CodeMirror/lib/codemirror.css" rel="stylesheet" type="text/css" media="screen">
<link href="/assets/assets/plugins/CodeMirror/theme/neo.css" rel="stylesheet" type="text/css" media="screen">
<link href="/assets/assets/plugins/CodeMirror/addon/scroll/simplescrollbars.css" rel="stylesheet" type="text/css" media="screen">

<style>
    

    .page-content .content {
        padding-left: 0  !important;
        padding-right: 0  !important;


    }

    #right_col a{
        color: #FA726D;
 
    }

    .horizontal-menu .page-content .content {
        padding-top: 102px;
    }

    p {
        font-size: 14px;
    }


     .page-content{

         background-color: #EAEAEA;
     }

      .footer{
        background-color: #F4645F;
    }

    span.dynatree-node a {
font-size: 12pt;


}

ul.dynatree-container li {


padding: 6px 0 0 0;
}

    .btn_go {
        position: fixed;
        right: 20px;
        top: 100px;

        display: block;
        padding: 10px;

    }


</style>

@stop

@section('content')

<div class="row" id="left_right">
    <div class="col-sm-3 reset-padding-left-0" id="left_col">

        <div class="row" >

            <div class="col-sm-12 m-t-20 reset-padding-left-0" >

                <a href="{!!route('section_path',[$section->id]) !!}"> <h4 class="semi-bold"><i class="fa fa-columns"></i> {{$section->name}}</h4></a>
                <hr>

                <div class="m-b-20" id="default-tree">
                    <ul id="treeData" style="display: none;">

                        @foreach ($roots as $root)



                        <li id="{{$root->id}}"><a href="{!! $root->link?action('SectionsController@section_post',['id'=>$section->id,'link'=>$root->link]):null!!}" target="_self">{{$root->name}}</a>
                            <ul>{!!app('helper')->renderTree($root)!!}
                            </ul>
                        </li>



                        @endforeach
                    </ul>

                </div>



            </div>

        </div>
    </div>

    <div class="col-sm-8 left-border" id="right_col" style="min-height:800px">


        <div class="row">

            <div class="col-sm-12 m-t-40">

                <h3> </h3>

            </div>


        </div>

        <div class="row">

            <div class="col-sm-10 col-sm-offset-1">

                 <h2> {!!$post->title!!}</h2>
                 <hr>

                {!!$post->content!!}

            </div>

        </div>


    </div>
    <div class="col-sm-1" id="toggle_btn">

        <button class="btn btn-white m-t-10 btn_go"><i class="fa fa-hand-o-right"></i> 有问题？</button>

        <div class="m-t-50 m-l-10 btn_go">
       <h5 class="color-red"><span class="ds-thread-count" data-thread-key="{!! $post->id !!}" data-count-type="comments"></span></h5>
        </div>

        </div>

    <div class="col-sm-4" id="comment_panel">

        <button class="btn btn-white m-t-10" id="btn_back"><i class="fa fa-hand-o-left"></i> &nbsp;&nbsp;返回&nbsp;&nbsp;&nbsp;</button>

        <!-- 多说评论框 start -->
        <div class="ds-thread  m-t-30" data-thread-key="{!! $post->id !!}" data-title="{!! $post->title !!}" data-url="{!! Request::url() !!}"></div>
        <!-- 多说评论框 end -->
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
        <!-- 多说js加载结束，一个页面只需要加载一次 -->

    </div>









@stop

@section('custom_js')
    <script src="/assets/assets/plugins/CodeMirror/lib/codemirror.js" type="text/javascript"></script>
<script src="/assets/assets/plugins/CodeMirror/mode/javascript/javascript.js" type="text/javascript"></script>
<script src="/assets/assets/plugins/CodeMirror/mode/clike/clike.js" type="text/javascript"></script>
<script src="/assets/assets/plugins/CodeMirror/mode/php/php.js" type="text/javascript"></script>
<script src="/assets/assets/plugins/CodeMirror/addon/selection/active-line.js" type="text/javascript"></script>
<script src="/assets/assets/plugins/CodeMirror/addon/scroll/simplescrollbars.js" type="text/javascript"></script>

<script src="/assets/assets/plugins/jquery-dynatree/jquery.dynatree.min.js" type="text/javascript"></script>

<script>

 

    $(document).ready(function() {

        //尼玛，Chrome下居然读取高度不准确，要延迟读取

           setTimeout(function() {
            var height =  $("#left_right").outerHeight(true)+100;
            
            $("#right_col").height(height);

           }, 500);
    


        $("#default-tree").dynatree({
            fx: { height: "toggle", duration: 200 },//Slide down animation
            persist: false,
            autoCollapse: false,
            minExpandLevel: 1,
            onActivate: function(node) {
                // Use <a> href and target attributes to load the content:
                if( node.data.href ){
                    // Open target
                    window.open(node.data.href, node.data.target);
                    // or open target in iframe
//                $("[name=contentFrame]").attr("src", node.data.href);
                }
                  
            },
            onClick:function(node) {

                if (node.data.hasShiftSet) {
                            node.data.addClass = "dynatree-highlight";
                        }
            }


        });

        

        $("#default-tree").dynatree("getRoot").visit(function(dtnode){
            dtnode.expand(true);
        });

  

        $('pre').each(function() {

            var $this = $(this),
                $code = $this.html();
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


        $('#comment_panel').hide();

        $('#toggle_btn, #btn_back').click(function(e){

            $('#toggle_btn').fadeToggle('fast');

            $('#left_col').fadeToggle('fast');

            $('#comment_panel').slideToggle('slow');
            e.preventDefault();

        });



    });
</script>

@stop