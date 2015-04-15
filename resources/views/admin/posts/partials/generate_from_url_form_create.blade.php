@section('custom_css')

<link href="/assets/assets/plugins/summernote/css/summernote.css" rel="stylesheet" type="text/css" media="screen">
<!-- include codemirror (codemirror.css, codemirror.js, xml.js, formatting.js) -->
<link href="/assets/assets/plugins/CodeMirror/lib/codemirror.css" rel="stylesheet" type="text/css" media="screen">
<link href="/assets/assets/plugins/CodeMirror/theme/paraiso-dark.css" rel="stylesheet" type="text/css" media="screen">
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
                新建文章
            </h5>
           <!-- enctype="multipart/form-data" 非常重要，否则文件无法上传-->
            <form id="postform" role="form" method="POST" enctype="multipart/form-data" action="{{route('admin.posts.store')}}">
                <div class="form-group">
                    <label>文章标题</label>
                    <span class="help">e.g. "输入文章标题"</span>
                    <input type="text" name="title" class="form-control" value="{{$grabbed['title']}}">
                </div>

                <div class="form-group">
                    <label class="form-label">分类</label>
                    <span class="help">选择文章的分类</span>
                    <select class="full-width" data-init-plugin="select2" name="category_id">

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
                                      name="content">{{$grabbed['content']}}</textarea>
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
    <!-- START PANEL -->
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">标签
            </div>
        </div>
        <div class="panel-body">
            <p>你可以任意输入标签，然后按回车。</p>
            <br>
            <input id="tagsinput" type="text" value=""/>

        </div>
    </div>
    <!-- END PANEL -->
</div>

@section('custom_js')
<script src="/assets/assets/plugins/CodeMirror/lib/codemirror.js" type="text/javascript"></script>
<script src="/assets/assets/plugins/CodeMirror/mode/javascript/javascript.js" type="text/javascript"></script>

<script src="/assets/assets/plugins/summernote/js/summernote.min.js" type="text/javascript"></script>
<script src="/assets/assets/plugins/summernote/lang/summernote-zh-CN.js" type="text/javascript"></script>



<script>
    $(document).ready(function() {

        $('#summernote').summernote({
            height: 200,
            lang: 'zh-CN',
            codemirror: { // codemirror options
                theme: 'paraiso-dark',
                htmlMode: false,
                lineNumbers: true,
                mode: 'javascript'
            }
        });

        $('#reset').on('click',function(){

            $('#summernote').code('');


        });
    });
</script>
@stop
