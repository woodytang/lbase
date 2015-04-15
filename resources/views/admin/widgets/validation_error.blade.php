<div class="panel-body">
                              					@if (count($errors) > 0)
                              						<div class="alert alert-danger">
                              							<strong>抱歉！</strong> 您的输入有误。<br><br>
                              							<ul>
                              								@foreach ($errors->all() as $error)
                              									<li>{{ $error }}</li>
                              								@endforeach
                              							</ul>
                              						</div>
                              					@endif