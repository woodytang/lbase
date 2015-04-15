<form method="post" action="{!! url('/crawler/generate-from-url') !!}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">


<div class="modal fade stick-up" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header clearfix text-left">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
                </button>
                <h5>URL <span class="semi-bold">采集</span></h5>
                <p>输入URL及采集规则来采集文章</p>
            </div>
            <div class="modal-body">
                <form role="form">
                    <div class="form-group-attached">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group form-group-default">
                                    <label>URL</label>
                                    <input type="text" class="form-control" name="url" value="{!!session('url')?session('url'):null!!}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group form-group-default">
                                    <label>标题选择器</label>
                                    <input type="text" class="form-control" name="rule1" value="{!!session('rule1')?session('rule1'):null!!}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group form-group-default">
                                    <label>内容选择器</label>
                                    <input type="text" class="form-control" name="rule2" value="{!!session('rule2')?session('rule2'):null!!}">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-sm-8">
                        <div class="p-t-20 clearfix p-l-10 p-r-10">

                        </div>
                    </div>
                    <div class="col-sm-4 m-t-10 sm-m-t-10">
                        <input type="submit" value="采集" class="btn btn-primary btn-block m-t-5">

                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
</form>