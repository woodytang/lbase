<div class="form-actions">
    <div class="pull-right">
	<button class="btn btn-white btn-cons"> <a  href="{{ route('admin.users.index') }}">取消</a></button>
	<button type="reset" id="reset" class="btn btn-white btn-cons">重置</button>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
	<input type="submit" value="保存" class="btn btn-success btn-cons">
    </div>
</div>