@extends('front._layouts.default')

@section('custom_css')

<link href="/assets/assets/plugins/jquery-dynatree/skin/ui.dynatree.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="/assets/assets/plugins/CodeMirror/lib/codemirror.css" rel="stylesheet" type="text/css" media="screen">
<link href="/assets/assets/plugins/CodeMirror/theme/paraiso-dark.css" rel="stylesheet" type="text/css" media="screen">
<link href="/assets/assets/plugins/CodeMirror/addon/scroll/simplescrollbars.css" rel="stylesheet" type="text/css" media="screen">

<style>

    .page-content{

        background-color: #EAEAEA;
    }


    .page-content .content {
        padding-left: 0  !important;
        padding-right: 0  !important;

    }

    .horizontal-menu .page-content .content {
        padding-top: 102px;
    }

    p {
        font-size: 14px;
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


</style>

@stop

@section('content')

<div class="row" id="left_col">
    <div class="col-md-3 reset-padding-left-0">

        <div class="row">

            <div class="col-md-12 m-t-20 reset-padding-left-0">

                <a href="{!!route('section_path',[$section->id]) !!}"> <h4 class="semi-bold"><i class="fa fa-columns"></i> {{$section->name}}</h4></a>
                <hr>

                <div class="m-b-20" id="default-tree">
                    <ul id="treeData" style="display: none;">

                        @foreach ($roots as $root)



                        <li id="{{$root->id}}"><a href="{!! action('SectionsController@section_post',['id'=>$section->id,'link'=>$root->link])!!}" target="_self">{{$root->name}}</a>
                            <ul>{!!app('helper')->renderTree($root)!!}
                            </ul>
                        </li>



                        @endforeach
                    </ul>

                </div>



            </div>

        </div>
    </div>

    <div class="col-md-9 left-border" id="right_col" style="min-height:800px">


        <div class="row">

            <div class="col-md-10 p-t-30" style="text-align: center;margin:40px auto 0 auto;float: none;" >

                <img src="<?= $section->cover->url('medium') ?>" >

            </div>


        </div>

        <div class="row">

            <div class="col-md-9 m-t-40  reset-padding" style="text-align: center;margin:40px auto 0 auto;float: none;">

                <a href="{!! action('SectionsController@section_post',['id'=>$section->id,'link'=>$roots->first()->link])!!}" target="_self"><button class="btn btn-block btn-white" type="button" style="width:600px"> <h3>{!!$section->description!!}<i class="fa fa-hand-o-right"></i></h3></button></a>


            </div>

        </div>


    </div>









    @stop

    @section('custom_js')
    <script src="/assets/assets/plugins/CodeMirror/lib/codemirror.js" type="text/javascript"></script>
    <script src="/assets/assets/plugins/CodeMirror/mode/javascript/javascript.js" type="text/javascript"></script>
    <script src="/assets/assets/plugins/CodeMirror/addon/selection/active-line.js" type="text/javascript"></script>
    <script src="/assets/assets/plugins/CodeMirror/addon/scroll/simplescrollbars.js" type="text/javascript"></script>

    <script src="/assets/assets/plugins/jquery-dynatree/jquery.dynatree.min.js" type="text/javascript"></script>

    <script>

    //尼玛，Chrome下居然读取高度不准确，要延迟读取

           setTimeout(function() {
            var height =  $("#left_col").outerHeight(true)+100;
            
            $("#right_col").height(height);

           }, 500);
    

        $(document).ready(function() {
            $("#default-tree").dynatree({
                fx: { height: "toggle", duration: 200 },//Slide down animation
                persist: false,
                autoCollapse: true,
                minExpandLevel: 1,
                onActivate: function(node) {
                    // Use <a> href and target attributes to load the content:
                    if( node.data.href ){
                        // Open target
                        window.open(node.data.href, node.data.target);
                        // or open target in iframe
//                $("[name=contentFrame]").attr("src", node.data.href);
                    }

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


                $this.empty();

                var myCodeMirror = CodeMirror(this, {
                    value: $code,
                    mode: 'javascript',
                    lineNumbers: !$this.is('.inline'),
                    readOnly: true,
                    theme: 'default',
                    styleActiveLine: true,
                    scrollbarStyle: "simple"

                });

            });

        });
    </script>

    @stop