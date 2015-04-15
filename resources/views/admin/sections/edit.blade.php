@extends('admin._layouts.default')

@section('content')

<!--传个值给Jquery-->

<input type="hidden" id="2" value="<?php echo $section_content->parent_id ?>" />

<div class="row">
    <div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">选择菜单项
            </div>

        </div>
        <div class="panel-body">
            <div class="row" >
                <div class="col-md-10">

                    <form  method="get" action="{!!route('admin.section_contents.index')!!}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">


                        <div class="form-group">

                            <select  id="menu_set" style="width: 37%" data-init-plugin="select2"
                                    name="set_id">
                                @foreach($sections as $section)

                                <option value="{{$section->id}}">{{$section->name}}</option>


                                @endforeach
                            </select>
                            <div class="submit m-l-15" style="display: inline-block">
                                <input type="submit" value="选择" class="btn btn-white">
                            </div>
                        </div>







                    </form>
                </div>
                <div class="col-md-2 ">
                    <div class="cs-wrapper m-l-50">
                        <a href="{!!route('admin.section_contents.index')!!}">
                            <button class="btn btn-white">新建菜单项</button>
                        </a>
                    </div>

                </div>

            </div>
    </div>


</div>
    </div>
</div>

<div class="row">

    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4><span class="semi-bold">新增菜单</span></h4>
            </div>
            <div class="panel-body">

                <form role="form" method="post" action="{!! route('admin.section_contents.update',[$section_content->id])!!}">
                    <input name="_method" type="hidden" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input id="set_id" type="hidden" name="section_id" value="{{ $set_id }}">

                    <div class="form-group">
                        <label class="form-label">名称</label>
                        <span class="help">这将是它在站点上显示的名字"</span>

                        <div class="controls">
                            <input type="text" class="form-control" name="name" value="{{$section_content->name}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">链接</label>
                        <span class="help">链接到其他内容的URL，路由等</span>

                        <div class="controls">
                            <input type="text" class="form-control" name="link" value="{{$section_content->link}}">
                        </div>
                    </div>



                    <div class="form-group">
                        <label class="form-label">父类</label>
                        <span class="help">分类目录和标签不同，它可以有层级关系。您可以有一个“音乐”分类目录，在这个目录下可以有叫做“流行”和“古典”的子目录。</span>
                        <select id ='parent_id' class="full-width" data-init-plugin="select2" name="parent_id">

                            <option value="null" selected="selected">无</option>
                            @if(isset($section_contents))
                            @foreach($section_contents as $section_content)
                            @foreach($section_content->getDescendantsAndSelf(array('id','parent_id','name','depth'))->toHierarchy()
                            as $relation)


                            @if($relation->depth==0)
                            <option value="{{$relation->id}}">
                                {{$relation->name}}
                            </option>
                            <!-- End Check -->
                            @else

                            @for($i = 0; $i < $relation->depth; $i++)

                            @endfor
                            <option value="{{$relation->id}}">
                                {{str_repeat("&nbsp;&nbsp;",$i+1).'|_'.$relation->name}}
                            </option>
                            @endif

                            @endforeach
                            @endforeach
                            @endif


                        </select>
                    </div>




                    <div class="form-group">


                        <div class="submit pull-right m-t-10">
                            <input type="submit" value="保存" class="btn btn-primary">
                        </div>
                    </div>

                </form>


            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>菜单 <span class="semi-bold">管理</span></h4>

            </div>
            <div class="panel-body">
                <div class="row-fluid">
                    <div class="span8">

                        <table class="table table-bordered no-more-tables" id="menu_table">
                            <thead>
                            <tr>

                                <th class="text-center" style="width:5%">Id</th>
                                <th class="text-center" style="width:20%">名称</th>
                                <th class="text-center" style="width:16%">链接</th>
                                <th class="text-center" style="width:16%">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($section_contents))
                            @foreach($section_contents as $section_content)
                            @foreach($section_content->getDescendantsAndSelf()->toHierarchy() as $relation)
                            <tr>
                                <td class="text-center clickme">{{$relation->id}}</td>
                                @if($relation->depth==0)
                                <td class="" style="padding-left: 50px; font-weight:bold">{{$relation->name}}</td>
                                <!-- End Check -->
                                @else
                                @for($i = 0; $i < $relation->depth; $i++)
                                @endfor
                                <td class="" style="text-indent:{{$i+1}}em; padding-left: 50px;color: #3B3A48">--{{$relation->name}}</td>
                                @endif


                                <td class="text-center ">
                                    {{$relation->link}}
                                </td>

                                <td class="text-center ">

                                    <div class="row-fluid">

                                        <div class="col-xs-4">

                                            <form method="post"
                                                  action="{!! route('admin.section_contents.destroy',[$relation->id]) !!}"
                                                  type="button">
                                                <input name="_method" type="hidden" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="submit" value="删除" class="btn btn-white btn-xs">

                                            </form>
                                        </div>
                                        <div class="col-xs-4">


                                               <button class="btn btn-white btn-xs clickme">移动</button>



                                            </div>
                                        <div class="col-xs-4">
                                            <a href="{!!route('admin.section_contents.edit',[$relation->id,'set_id'=>$set_id])!!}">
                                                <button class="btn btn-white btn-xs">编辑</button>
                                            </a>
                                        </div>
                                    </div>

                                </td>
                            </tr>
                            <tr class="hideme">
                                <td colspan="4">
                                    <div class="row">
                                        <div class="col-xs-4">

                                            <div class="pull-right">
                                                <a href="{!!url('/admin/api/movedown',$parameters =['id'=>$relation->id, 'model'=>'App\Models\Section\Section_Content'])!!}">
                                                    <button class="btn btn-white btn-xs"><i class="fa fa-long-arrow-down"></i>&nbsp;&nbsp;&nbsp;向下移</button>
                                                </a>
                                            </div>
                                            <div class=" m-r-20 pull-right">
                                                <a href="{!!url('/admin/api/moveup',$parameters =['id'=>$relation->id, 'model'=>'App\Models\Section\Section_Content'])!!}">
                                                   <button class="btn btn-white btn-xs"> <i class="fa fa-long-arrow-up"></i>&nbsp;&nbsp;&nbsp;向上移</button>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="col-xs-4">

                                            <div class="pull-right">
                                            <form method="get"
                                                  action="{!!url('/admin/api/movetopof',$parameters =['id'=>$relation->id, 'model'=>'App\Models\Section\Section_Content'])!!}"
                                                  >
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <div class="form-group">
                                                    <label>移动到</label>
                                                    <input type="text" name="target" style="width: 30px">
                                                    <label>前面</label>
                                                <input type="submit" value="确定" class="btn btn-white btn-xs">

                                                </div>

                                            </form>
                                            </div>

                                        </div>
                                        <div class="col-xs-4">
                                            <div class="pull-right">
                                            <form method="get"
                                                  action="{!!url('/admin/api/movebottomof',$parameters =['id'=>$relation->id, 'model'=>'App\Models\Section\Section_Content'])!!}"
                                                >
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <div class="form-group">
                                                    <label>移动到</label>
                                                    <input type="text" name="target" style="width: 30px" >
                                                    <label>后面</label>
                                                    <input type="submit" value="确定" class="btn btn-white btn-xs">

                                                </div>

                                            </form>
                                            </div>
                                        </div>

                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @endforeach
                            @endif
                            </tbody>
                        </table>


                        <br>


                    </div>
                </div>
            </div>
        </div>
    </div>


</div>



@stop

@section('custom_js')

<script type="text/javascript">
    $(document).ready(function(){

        var set_id = $('#set_id').val();

        /*select2 初始化默认选项，详见http://stackoverflow.com/questions/14957419/select2-doesnt-show-selected-value*/
        /*alert(set_id);*/

        $("#menu_set").select2().select2('val',set_id);

        var parent_id = $('#2').val().trim();
        $("#parent_id").select2().select2('val',parent_id);


        $('.hideme').children().css({padding:"0","border-bottom-width":"0"}).find('div').hide();
        $('.clickme').click(function() {

            $('.hideme').not(this).children().css({padding:"0"}).find('div').hide();

            $(this).parent().parent().parent().parent().next('.hideme').children().css({padding:"10","background-color":"#FAFAFA"}).find('div').slideToggle(100,function(){

            } );
            return false;
        });



        /* $('#parent_id').select2()
             .on("change", function(e) {

                 var order = getOrder($(this).val());

                *//* alert(order);*//*


            });

        function getOrder(menu_id){

           *//* alert(menu_id);*//*
            //ajax获得对应的 排序号
            url = '/admin/api/order';

            $.ajax({

                type: "get",

                url: url,

                data:'menu_id='+menu_id,

                cache:false,

                async:false,

                dataType: 'json',

                success: function(array){

                    var order = Number(array[0]);
                    var depth = Number(array[1])+1;
                    var final = order+(order+1/Math.pow(10, depth));

                   *//* alert(typeof Number(array[0]));*//*




                    $('#order').val(final);


                }

            });



        }*/

    });
</script>

@stop
