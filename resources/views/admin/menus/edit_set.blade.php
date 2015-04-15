@extends('admin._layouts.default')

@section('content')

<div class="row">

    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4><span class="semi-bold">修改菜单</span></h4>
            </div>
            <div class="panel-body">

                <form role="form" method="POST" action="{{route('admin.menusets.update',[$menuset->id])}}">
                    <input name="_method" type="hidden" value="PUT">

                    <div class="form-group form-group-default">
                        <label class="label-lg">输入菜单名称</label>
                        <input type="text" placeholder="" class="form-control input-lg" name="name" value="{{$menuset->name}}">
                    </div>

                    <div class="form-actions">
                        <div class="pull-right">
                            <button type="reset" id="reset" class="btn btn-white btn-cons">重置</button>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="submit" value="保存" class="btn btn-success btn-cons">
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>


    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4><span class="semi-bold">菜单管理</span></h4>
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
                                <th style="width: 112px;" class="sorting" tabindex="0" aria-controls="condensedTable"
                                    rowspan="1" colspan="1" aria-label="Key: activate to sort column ascending">操作
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($menusets as $menuset)
                            <tr role="row" class="odd">
                                <td class="v-align-middle semi-bold sorting_1">{{$menuset->name}}</td>
                                <td class="v-align-middle">

                                    <div class="row-fluid">

                                        <div class="col-xs-6">

                                            <form method="post"
                                                  action="{!! route('admin.menusets.destroy',[$menuset->id]) !!}"
                                                  type="button">
                                                <input name="_method" type="hidden" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="submit" value="删除" class="btn btn-white btn-xs">

                                            </form>
                                        </div>
                                        <div class="col-xs-6">
                                            <a href="{!!route('admin.menusets.edit',[$menuset->id])!!}">
                                                <button class="btn btn-white btn-xs">编辑</button>
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