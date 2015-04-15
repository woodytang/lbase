@extends('admin._layouts.default')

@section('content')

<div class="row">

    <form role="form" method="POST" action="{{url('admin/settings/options')}}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="col-md-9">

            <div class="row">

                <div class="col-md-10">
                    <div class="panel panel-default" style="min-height: 440px">
                        <div class="panel-heading separator">
                            <div class="panel-title">网站设置
                            </div>
                        </div>
                        <div class="panel-body m-t-10">
                            <div class="form-group form-group-default">
                                <label>网站标题</label>

                                <input value="{!! isset($options['site_name'])?$options['site_name']:'' !!}"
                                       name="site_name" type="text" class="form-control">
                            </div>


                            <div class="form-group form-group-default">
                                <label>SEO关键字</label>

                                <input value="{!! isset($options['key_words'])?$options['key_words']:'' !!}"
                                       name="key_words" type="text" class="form-control">
                            </div>
                            <div class="form-group form-group-default">
                                <label>SEO描述</label>

                                <input value="{!! isset($options['description'])?$options['description']:'' !!}"
                                       name="description" type="text" class="form-control">
                            </div>

                            <div class="form-group form-group-default">
                                <label>Copyright信息</label>
									<textarea rows="4" name="copyright" type="text" class="auto-height form-control ">{!! isset($options['copyright'])?$options['copyright']:'' !!}</textarea>
                            </div>
                            

                            <div class="form-group form-group-default">
                                <label>联系信息</label>

                                <input value="{!! isset($options['contact'])?$options['contact']:'' !!}"
                                       name="contact" type="text" class="form-control">
                            </div>

                            <div class="form-group form-group-default ">
                                <label>声明</label>

                                <textarea rows="4" name="claim" type="text" class=" auto-height form-control ">{!! isset($options['claim'])?$options['claim']:'' !!}</textarea>
                            </div>

                            <div class="form-group form-group-default ">
                                <label>链接</label>

                                <textarea rows="8" name="links" type="text" class=" auto-height form-control ">{!! isset($options['links'])?$options['links']:'' !!}</textarea>
                            </div>


                        </div>

                    </div>


                </div>
            </div>
        </div>


        <div class="col-md-3">
            <div class="form-group">

                <div class="submit ">
                    <input type="submit" value="保存" class="btn btn-primary btn-block">
                </div>
            </div>

        </div>

    </form>

</div>


@stop