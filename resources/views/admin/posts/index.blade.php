@extends('admin._layouts.default')

@section('content')

<div class="row">


 <!-- START PANEL -->
             <div class="panel panel-default">
                 @include('admin.posts.partials.generate_from_url_model')
               <div class="panel-heading">
                 <div class="panel-title"><h4><span class="semi-bold">文章列表</span></h4>
                 </div>
                 <div class="btn-group pull-right m-b-10">
                     <button class="btn btn-white btn-cons" data-toggle="modal" data-target="#myModal">URL 采集</button>
                   <button class="btn btn-white btn-cons "> <a  href="{{ route('admin.posts.create') }}">新建文章</a></button>



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
                         <th style="width:30%">标题</th>
                         <th style="width:5%">分类</th>
                         <th style="width:11%">创建时间</th>
                         <th style="width:12%">操作</th>
                       </tr>
                     </thead>
                     <tbody>
                     @foreach($posts as $post)
                       <tr>
                         <td class="v-align-middle">
                           <div class="checkbox ">
                             <input type="checkbox" value="3" id="checkbox1">
                             <label for="checkbox1"></label>
                           </div>
                         </td>
                         <td class="v-align-middle ">
                           <p>{{$post->id}}</p>
                         </td>
                         <td class="v-align-middle">
                           <p>{{$post->title}}</p>
                         </td>
                         <td class="v-align-middle">
                           <p>{!!isset($post->category->name)?$post->category->name:'未分类'!!}</p>
                         </td>
                         <td class="v-align-middle">
                           <p>{{$post->created_at}}</p>
                         </td>
                         <td class="v-align-middle">

                         <div class="row">
                            <div class="col-xs-6">

                            <button class="btn btn-white btn-xs" type="button">
                                                       <a href="{!!route('admin.posts.edit',[$post->id]) !!}">修改</a>

                                                       </button>

                            </div>
                            <div class="col-xs-6">

                            <form method="post" action="{!! route('admin.posts.destroy',[$post->id]) !!}" type="button">
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
                   {!! with(new App\Presenters\LaraBaseAdminPaginationPresenter($posts))->render() !!}
                 </div>
               </div>
             </div>
<!-- END PANEL -->



</div>

@stop