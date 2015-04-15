@extends('admin._layouts.default')

@section('content')

<!--传值给Javascript..注意要放到顶部，放到底部$category会被重新赋值-->
<input type="hidden" id="1" value="<?php echo $category->type ?>" />
<input type="hidden" id="2" value="<?php echo $category->parent_id ?>" />

<div class="row">

    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4><span class="semi-bold">编辑分类</span></h4>
            </div>
            <div class="panel-body">

                <form role="form" method="POST" action="{!! route('admin.categories.update',[$category->id])!!}">
                    <input name="_method" type="hidden" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">


                    <div class="form-group">
                        <label class="form-label">名称</label>
                        <span class="help">这将是它在站点上显示的名字"</span>

                        <div class="controls">
                            <input type="text" class="form-control" name="name" value="{{$category->name}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">别名</label>
                        <span class="help">别名”是在URL中使用的别称，它可以令URL更美观。通常使用小写，只能包含字母，数字和连字符（-）。</span>

                        <div class="controls">
                            <input type="text" class="form-control" name="alias" value="{{$category->alias}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">类型</label>
                        <span class="help">选择文章分类或是资源分类</span>

                        <div class="controls">
                            <select id="type" class="full-width" data-init-plugin="select2" name="type" >
                                <option value="文章" selected="selected">文章</option>
                                <option value="网站">网站</option>
                            </select>

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">父类</label>
                        <span class="help">分类目录和标签不同，它可以有层级关系。您可以有一个“音乐”分类目录，在这个目录下可以有叫做“流行”和“古典”的子目录。</span>
                        <select id="parent_id" class="full-width" data-init-plugin="select2" name="parent_id">

                            <option value=null>无</option>
                            @if(isset($categories))
                            @foreach($categories as $category)
                            @foreach($category->getDescendantsAndSelf(array('id','parent_id','name','depth'))->toHierarchy()
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
                        <label class="form-label">描述</label>
                        <span class="help">描述只会在一部分主题中显示。</span>

                        <div class="controls">
                            <textarea id="text-editor" placeholder="输入文字..." class="form-control"
                                      rows="10" name="description">{{$category->description}}</textarea>
                        </div>

                        <div class="submit pull-right m-t-10">
                            <button class="btn btn-white btn-primary"> <a  style="color: #fff" href="{{ route('admin.categories.index') }}">取消</a></button>
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
                <h4>分类 <span class="semi-bold">管理</span></h4>

                <div class="tools"><a href="javascript:;" class="collapse"></a> <a href="#grid-config"
                                                                                   data-toggle="modal"
                                                                                   class="config"></a> <a
                        href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a></div>
            </div>
            <div class="panel-body">
                <div class="row-fluid">
                    <div class="span8">

                        <table class="table table-bordered no-more-tables">
                            <thead>
                            <tr>

                                <th class="text-center" style="width:20%">名称</th>
                                <th class="text-center" style="width:5%">ID</th>
                                <th class="text-center" style="width:16%">别名</th>
                                <th class="text-center" style="width:16%">类型</th>
                                <th class="text-center" style="width:16%">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($categories))
                            @foreach($categories as $category)
                            @foreach($category->getDescendantsAndSelf()->toHierarchy() as $relation)
                            <tr>

                                @if($relation->depth==0)
                                <td class="text-center" >{{$relation->name}}</td>
                                <!-- End Check -->
                                @else
                                @for($i = 0; $i < $relation->depth; $i++)
                                @endfor
                                <td class="text-center" style="text-indent:{{$i+1}}em">--{{$relation->name}}</td>
                                @endif

                                <td class="text-center">{{$relation->id}}</td>
                                <td class="text-center">
                                    {{$relation->alias}}
                                </td>
                                <td class="text-center">
                                    {{$relation->type}}
                                </td>
                                <td class="text-center">

                                    <div class="row-fluid">

                                        <div class="col-xs-6">

                                            <form method="post"
                                                  action="{!! route('admin.categories.destroy',[$relation->id]) !!}"
                                                  type="button">
                                                <input name="_method" type="hidden" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="submit" value="删除" class="btn btn-white btn-xs">

                                            </form>
                                        </div>
                                        <div class="col-xs-6">
                                            <a href="{!!route('admin.categories.edit',[$relation->id])!!}">
                                                <button class="btn btn-white btn-xs">编辑</button>
                                            </a>
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

        /*select2 初始化默认选项，详见http://stackoverflow.com/questions/14957419/select2-doesnt-show-selected-value*/

        var value1 = $('#1').val().trim();
        $("#type").select2().select2('val',value1);

        var value2 = $('#2').val().trim();
        $("#parent_id").select2().select2('val',value2);




    });
</script>

@stop