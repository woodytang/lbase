@extends('admin._layouts.default')

@section('content')

<div class="row">

    <form role="form" method="POST" action="{{url('admin/settings/features')}}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <div class="col-md-9">

        <div class="row">

            <div class="col-md-6">
                <div class="panel panel-default" style="min-height: 440px">
                    <div class="panel-heading separator">
                        <div class="panel-title">模块一
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label>模块1 ID</label>

                            <input value="{{$ids['id1']}}" name="id1" type="text" class="form-control">
                        </div>

                    </div>
                </div>

            </div>

            <div class="col-md-6">

                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading separator">
                                <div class="panel-title">模块二
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label>模块2 ID</label>

                                    <input value="{{$ids['id2-1']}}" name="id2-1" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>模块2 ID</label>

                                    <input value="{{$ids['id2-2']}}" name="id2-2" type="text" class="form-control">
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading separator">
                                <div class="panel-title">模块三
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label>模块3 ID</label>

                                    <input value="{{$ids['id3-1']}}" name="id3-1" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>模块3 ID</label>

                                    <input value="{{$ids['id3-2']}}" name="id3-2" type="text" class="form-control">
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading separator">
                                <div class="panel-title">模块四
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label>模块4 ID</label>

                                    <input value="{{$ids['id4-1']}}" name="id4-1" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>模块4 ID</label>

                                    <input value="{{$ids['id4-2']}}" name="id4-2" type="text" class="form-control">
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading separator">
                                <div class="panel-title">模块五
                                </div>
                            </div>
                            <div class="panel-body">

                                <div class="form-group">
                                    <label>模块5 ID</label>

                                    <input value="{{$ids['id5-1']}}" name="id5-1" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>模块5 ID</label>

                                    <input value="{{$ids['id5-2']}}" name="id5-2" type="text" class="form-control">
                                </div>
                            </div>
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