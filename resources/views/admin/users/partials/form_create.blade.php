

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
            <form id="postform" role="form" method="POST" enctype="multipart/form-data" action="{{ route('admin.users.store') }}">
                <div class="form-group form-group-default">
                    <label>用户名</label>

                    <input type="text" name="name" class="form-control" placeholder="请输入您的用户名">
                </div>

                <div class="form-group form-group-default">
                    <label>电子邮箱</label>
                    <input type="email" name="email" placeholder="请输入您的电子邮箱地址" class="form-control" required>
                </div>

                <div class="form-group form-group-default">
                    <label>密码</label>
                    <input type="password" name="password" placeholder="最短6个字符" class="form-control" required>
                </div>

                <div class="form-group form-group-default">
                    <label>确认密码</label>
                    <input type="password" name="password_confirmation" placeholder="请再输一遍您的密码" class="form-control" required>
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
<div class="col-md-4">

</div>

