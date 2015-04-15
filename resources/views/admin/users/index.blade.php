@extends('admin._layouts.default')

@section('content')

<div class="row">


 <!-- START PANEL -->
             <div class="panel panel-default">
               <div class="panel-heading">
                 <div class="panel-title"><h4><span class="semi-bold">用户列表</span></h4>
                 </div>
                 <div class="btn-group pull-right m-b-10">
                   <div class="row"><button class="btn btn-white btn-cons "> <a  href="{{ route('admin.users.create') }}">新建用户</a></button></div>
                 </div>
                 <div class="clearfix"></div>
               </div>
               <div class="panel-body">
                 <div class="table-responsive">
                   <table class="table table-hover" id="basicTable">
                     <thead>
                       <tr>
                         <!-- NOTE * : Inline Style Width For Table Cell is Required as it may differ from user to user
                                         Comman Practice Followed
                                         -->

                           <th style="width:1%">ID</th>
                           <th style="width:5%">头像</th>
                           <th style="width:30%">用户名</th>

                           <th style="width:11%">创建时间</th>
                           <th style="width:12%">操作</th>
                       </tr>
                     </thead>
                     <tbody>
                     @foreach($users as $user)
                       <tr>
                         <td class="v-align-middle ">
                           <p>{{$user->id}}</p>
                         </td>
                           <td class="v-align-middle">
                               <p><img class="media-object img-circle avatar" src="<?= $user->avatar->url('thumb') ?>" ></p>
                           </td>
                         <td class="v-align-middle">
                           <p>{{$user->name}}</p>
                         </td>

                         <td class="v-align-middle">
                           <p>{{$user->created_at}}</p>
                         </td>
                         <td class="v-align-middle">

                         <div class="row">
                            <div class="col-xs-6">

                            <button class="btn btn-white btn-xs" type="button">
                                                       <a href="{!!route('admin.users.edit',[$user->id]) !!}">修改</a>

                                                       </button>

                            </div>
                            <div class="col-xs-6">

                            <form method="post" action="{!! route('admin.users.destroy',[$user->id]) !!}" type="button">
                            <input name="_method" type="hidden" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="submit" value="删除" class="btn btn-white btn-xs">

                            </form>

                            </div>


                         </div>



                         </td>
                       </tr>
                      @endforeach
                     </tbody>
                   </table>
                   {!! with(new App\Presenters\LaraBaseAdminPaginationPresenter($users))->render() !!}
                 </div>
               </div>
             </div>
<!-- END PANEL -->



</div>

@stop