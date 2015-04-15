@section('custom_css')




@stop

<div class="col-md-8">
    <!-- START PANEL -->
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">
                Create New Sites
            </div>
        </div>
        <div class="panel-body">
            <h5>
                编辑网站
            </h5>

            <form id="postform" role="form" method="POST" enctype="multipart/form-data"
                  action="{!! route('admin.sites.update',[$site->id]) !!}">

                <input name="_method" type="hidden" value="PUT">


                <div class="form-group">
                    <label>网站标题</label>
                    <span class="help">e.g. "输入网站标题"</span>
                    <input type="text" name="name" class="form-control" value="{{$site->name}}">
                </div>

                <div class="form-group">
                    <label>网站链接</label>
                    <span class="help">e.g. "输入网站链接"</span>
                    <input type="text" name="url" class="form-control" value="{{$site->url}}">
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
                                      name="intro">{{$site->intro}}</textarea>
                        </div>
                    </div>
                </div>


                @include('admin.sites.partials.form_submit')
            </form>
        </div>
    </div>
    <!-- END PANEL -->
</div>
<div class="col-md-4">


</div>
<!--传值给Javascript-->
<input type="hidden" id="2" value="<?php echo $category_id ?>" />

    @section('custom_js')




    <script>
        $(document).ready(function () {


            var value2 = $('#2').val().trim();
            $("#parent_id").select2().select2('val',value2);
        });
    </script>
    @stop