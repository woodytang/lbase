@extends('admin._layouts.default')

@section('content')

<div class="row">

    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4><span class="semi-bold">新建专辑</span></h4>
            </div>
            <div class="panel-body">

                <form role="form" method="POST" enctype="multipart/form-data"  action="{{route('admin.sections.store')}}">
                    <div class="form-group form-group-default">
                        <label class="label-lg">输入专辑名称</label>
                        <input type="text" placeholder="" class="form-control input-lg" name="name">
                    </div>

                    <div class="form-group form-group-default">
                        <label class="label-lg">输入专辑描述</label>
                        <textarea  placeholder="输入文字" class="form-control" rows="30"
                                  name="description"></textarea>
                    </div>



                    <div class=" form-group">

                        <label class="form-label">设置特色图像</label>
                        <span class="help">添加一张特色图像</span>
                        <input name="cover" type="file" class="btn" >
                    </div>

                    <div class="form-actions">
                        <div class="pull-right">
                            <button type="reset" id="reset" class="btn btn-white btn-cons">重置</button>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="submit" value="新建" class="btn btn-success btn-cons">
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>


    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4><span class="semi-bold">专辑管理</span></h4>
            </div>
            <div class="panel-body">

                <div class="table-responsive">
                    <div id="condensedTable_wrapper" class="dataTables_wrapper form-inline no-footer">
                        <table class="table table-hover table-condensed dataTable no-footer" id="condensedTable"
                               role="grid">
                            <thead>
                            <tr role="row">
                                <th style="width: 185px;" class="sorting_asc" tabindex="0"
                                    aria-controls="condensedTable" rowspan="1" colspan="1" aria-sort="ascending"
                                    aria-label="Title: activate to sort column ascending">名称
                                </th>
                                <th style="width: 172px;" class="sorting" tabindex="0" aria-controls="condensedTable"
                                    rowspan="1" colspan="1" aria-label="Key: activate to sort column ascending">操作
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sections as $section)
                            <tr role="row" class="odd">
                                <td class="v-align-middle semi-bold sorting_1">{{$section->name}}</td>
                                <td class="v-align-middle">

                                    <div class="row-fluid">

                                        <div class="col-xs-4">

                                            <form method="post"
                                                  action="{!! route('admin.sections.destroy',[$section->id]) !!}"
                                                  type="button">
                                                <input name="_method" type="hidden" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="submit" value="删除" class="btn btn-white btn-xs">

                                            </form>
                                        </div>
                                        <div class="col-xs-4">
                                            <a href="{!!route('admin.sections.edit',[$section->id])!!}">
                                                <button class="btn btn-white btn-xs">编辑</button>
                                            </a>
                                        </div>

                                        <div class="col-xs-4">
                                            <a href="{!!route('admin.section_contents.index',['set_id'=>$section->id])!!}">
                                                <button class="btn btn-white btn-xs">管理</button>
                                            </a>
                                        </div>
                                    </div>

                                </td>

                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@stop