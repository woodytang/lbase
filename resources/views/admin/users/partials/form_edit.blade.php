

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
                新建用户
            </h5>
            <!-- enctype="multipart/form-data" 非常重要，否则文件无法上传-->
            <form id="postform" role="form" method="POST" enctype="multipart/form-data" action="{{ route('admin.users.update',[$user->id])}}">

                <input name="_method" type="hidden" value="PUT">
                <div class="form-group form-group-default">
                    <label>用户名</label>

                    <input value="{{$user->name}}" type="text" name="name" class="form-control" placeholder="请输入您的用户名">
                </div>

                <div class="form-group form-group-default">
                    <label>电子邮箱</label>
                    <input value="{{$user->email}}" type="email" name="email" placeholder="请输入您的电子邮箱地址" class="form-control" required>
                </div>

                <div class="form-group form-group-default">
                    <label>密码</label>
                    <input value="{{$user->password}}" type="password" name="password" placeholder="最短6个字符" class="form-control" required>
                </div>

                <div class="form-group form-group-default">
                    <label>确认密码</label>
                    <input value="{{$user->password}}" type="password" name="password_confirmation" placeholder="请再输一遍您的密码" class="form-control" required>
                </div>


                <div class=" form-group">

                    <label class="form-label">设置特色图像</label>
                    <span class="help">添加一张特色图像</span>
                    <input name="avatar" type="file" class="btn">
                </div>
                @include('admin.users.partials.form_submit')
            </form>
        </div>
    </div>
    <!-- END PANEL -->
</div>
<div class="col-md-2">

    <div class="row">
        <!-- 区块1 -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title">
                    头像
                </div>
            </div>
            <div class="panel-body">

                @if(isset($user->avatar_file_name))
                <img class="media-object img-circle avatar" src="<?= $user->avatar->url('medium') ?>">


                <div class="row">

                    <div class="col-xs-12">
                        <a href="{!!url('/admin/api/removeuserimg',['user'=>$user])!!}">
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

</div>

