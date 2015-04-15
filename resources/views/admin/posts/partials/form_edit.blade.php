@section('custom_css')

<!-- include codemirror (codemirror.css, codemirror.js, xml.js, formatting.js) -->
<link href="/assets/assets/plugins/CodeMirror/lib/codemirror.css" rel="stylesheet" type="text/css" media="screen">
<link href="/assets/assets/plugins/CodeMirror/theme/paraiso-dark.css" rel="stylesheet" type="text/css" media="screen">
<link href="/assets/assets/plugins/CodeMirror/addon/scroll/simplescrollbars.css" rel="stylesheet" type="text/css" media="screen">

<link href="/assets/assets/plugins/summernote/css/summernote.css" rel="stylesheet" type="text/css" media="screen">

@stop

<div class="col-md-8">
    <!-- START PANEL -->
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">
                Create New Articles
            </div>
        </div>
        <div class="panel-body">
            <h5>
                编辑文章
            </h5>

            <form id="postform" role="form" method="POST" enctype="multipart/form-data"
                  action="{!! route('admin.posts.update',[$post->id]) !!}">

                <input name="_method" type="hidden" value="PUT">

                <div class="form-group">
                    <label>文章标题</label>
                    <span class="help">e.g. "输入文章标题"</span>
                    <input type="text" name="title" class="form-control" value="{{$post->title}}">
                </div>

                <div class="form-group">
                    <label class="form-label">分类</label>
                    <span class="help">选择文章的分类</span>
                    <select id="parent_id" class="full-width" data-init-plugin="select2" name="category_id">

                        <option value=null selected="selected">未分类</option>
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

                <div class=" form-group">
                    <label class="form-label">内容</label>
                    <span class="help">文章内容</span>

                    <div class="controls">
                        <div class="summernote-wrapper">
                            <textarea id="summernote" placeholder="输入文字" class="form-control" rows="10"
                                      name="content">{{$post->content}}</textarea>
                        </div>
                    </div>
                </div>
                <div class=" form-group">

                    <label class="form-label">设置特色图像</label>
                    <span class="help">添加一张特色图像</span>
                    <input name="feature" type="file" class="btn">
                </div>
                @include('admin.posts.partials.form_submit')
            </form>
        </div>
    </div>
    <!-- END PANEL -->
</div>
<div class="col-md-4">
    <div class="row">
        <!-- 区块1 -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title">
                    特色图像
                </div>
            </div>
            <div class="panel-body">

                @if(isset($post->feature_file_name))
                <img src="<?= $post->feature->url('thumb') ?>">


                <div class="row">

                    <div class="col-xs-12">
                        <a href="{!!url('/admin/api/removepostimg',['post'=>$post])!!}">
                            <button class="btn btn-default btn-cons m-t-10  pull-right"><i
                                    class="fa fa-trash-o"></i>&nbsp;&nbsp;删除
                            </button>
                        </a>
                    </div>
                </div>

                    @else

                    <h6>没有图像</h6>

                    @endif



            </div>
        </div>
        <!-- END 区块1 -->
    </div>
        <div class="row">
            <!-- 区块2 -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">标签
                    </div>
                </div>
                <div class="panel-body">
                    <p>你可以任意输入标签，然后按回车。</p>
                    <br>

                    <!--下面这个用来存放当前文章的ID -->
                    <input type="hidden" value="{{$post->id}}" id="post_id" />
                    <input id="tagsinput" type="text" value="{{$tag_string}}" />

                </div>
            </div>
            <!-- END 区块2 -->
        </div>
</div>
<!--传值给Javascript-->
<input type="hidden" id="2" value="<?php echo $category_id ?>" />

    @section('custom_js')

<script src="/assets/assets/plugins/CodeMirror/lib/codemirror.js" type="text/javascript"></script>
<script src="/assets/assets/plugins/CodeMirror/mode/javascript/javascript.js" type="text/javascript"></script>
<script src="/assets/assets/plugins/CodeMirror/addon/scroll/simplescrollbars.js" type="text/javascript"></script>
<script src="/assets/assets/plugins/CodeMirror/addon/selection/active-line.js" type="text/javascript"></script>





<script src="/assets/assets/plugins/summernote/js/summernote.min.js" type="text/javascript"></script>
<script src="/assets/assets/plugins/summernote/lang/summernote-zh-CN.js" type="text/javascript"></script>


    <script>
        $(document).ready(function () {



            $('#summernote').summernote({
                height: 200,
                lang: 'zh-CN',
                codemirror: { // codemirror options

                    theme: 'paraiso-dark',
                    htmlMode: true,
                    lineNumbers: true,
                    mode: 'javascript',
                    styleActiveLine: false,
                    scrollbarStyle: "simple",
                    lineWrapping:true

                }

            });


            $('#reset').on('click', function () {

                $('#summernote').code('');


            });

            var value2 = $('#2').val().trim();
            $("#parent_id").select2().select2('val',value2);
        });
    </script>
    @stop