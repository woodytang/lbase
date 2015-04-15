@extends('admin._layouts.default')

@section('content')

<div class="row">


 <!-- START PANEL -->
             <div class="panel panel-default">
               <div class="panel-heading">
                 <div class="panel-title"><h4><span class="semi-bold">网站列表</span></h4>
                 </div>
                 <div class="btn-group pull-right m-b-10">
                   <div class="row"><button class="btn btn-white btn-cons "> <a  href="{{ route('admin.sites.create') }}">新建网站</a></button></div>
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
                         <th style="width:1%">
                           <button class="btn"><i class="pg-trash"></i>
                           </button>
                         </th>
                         <th style="width:1%">ID</th>
                         <th style="width:10%">标题</th>
                         <th style="width:5%">分类</th>
                         <th style="width:11%">URL</th>
                         <th style="width:5%">操作</th>
                       </tr>
                     </thead>
                     <tbody>
                     @foreach($sites as $site)
                       <tr>
                         <td class="v-align-middle">
                           <div class="checkbox ">
                             <input type="checkbox" value="3" id="checkbox1">
                             <label for="checkbox1"></label>
                           </div>
                         </td>
                         <td class="v-align-middle ">
                           <p>{{$site->id}}</p>
                         </td>
                         <td class="v-align-middle">
                           <p>{{$site->name}}</p>
                         </td>
                         <td class="v-align-middle">
                           <p>{!!isset($site->category->name)?$site->category->name:'未分类'!!}</p>
                         </td>
                         <td class="v-align-middle">
                           <p>{{$site->url}}</p>
                         </td>
                         <td class="v-align-middle">

                         <div class="row">
                            <div class="col-xs-6">

                            <button class="btn btn-white btn-xs" type="button">
                                                       <a href="{!!route('admin.sites.edit',[$site->id]) !!}">修改</a>

                                                       </button>

                            </div>
                            <div class="col-xs-6">

                            <form method="post" action="{!! route('admin.sites.destroy',[$site->id]) !!}" type="button">
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
                   {!! with(new App\Presenters\LaraBaseAdminPaginationPresenter($sites))->render() !!}
                 </div>
               </div>
             </div>
<!-- END PANEL -->



</div>

@stop