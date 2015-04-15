<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Menu\Menu;
use App\Models\Post\Post;
use App\Models\Tag\Tag;
use DB;

use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;

use Illuminate\Pagination\Paginator;
use Redirect;
use Input;

class ApiController extends Controller {


   /* public function getOrder(){

        $menu_id = Input::get('menu_id');

        $order = Menu::findOrFail($menu_id)->order;
        $depth = Menu::findOrFail($menu_id)->depth;

        $result =[$order, $depth];
        return $result;

    }*/

    public function getMoveup($id, $model){

        //dd($model);

        $node = $model::where('id',$id)->first();

        $node->moveLeft();

        return Redirect::back();

    }

    public function getMovedown($id, $model){



        $node = $model::where('id',$id)->first();

        $node->moveRight();

        return Redirect::back();

    }

    public function getMovetopof($id,$model){

       // dd($id);


        $target = Input::get('target');

        $node1 = $model::where('id',$id)->first();
        $node2 = $model::where('id',$target)->first();

        //dd($node2);

        $node1->moveToLeftOf($node2);


        return Redirect::back();

    }

    public function getMovebottomof($id, $model){



        $target = Input::get('target');

        $node1 = $model::where('id',$id)->first();
        $node2 = $model::where('id',$target)->first();

        $node1->moveToRightOf($node2);

        return Redirect::back();

    }

    public function getRemovepostimg($id){


        $post = Post::findOrFail($id);

        $post->feature = STAPLER_NULL;

        $post->save();

        return Redirect::back();
    }

    public function getRemoveuserimg($id){


        $post = Post::findOrFail($id);

        $post->user = STAPLER_NULL;

        $post->save();

        return Redirect::back();
    }

    public function getCreatetags()
    {
        $name  = Input::get('tagData');

        //dd($name);

        if($name){

                $check= DB::table('tags')->where('name', $name)->first();
                //如果数据库没有就新建

                if($check == null){

                    $tag = new Tag;
                    $tag->name = $name;
                    $tag->save();

                };

        };

    }

    public function getDeletetags(){

        $name  = Input::get('tagData');
        $post_id = Input::get('postID');

        if($name){

            $tag = DB::table('tags')->where('name', $name)->first();

            $tagid = $tag->id;

            $check = DB::table('post_tag')->where('tag_id','=', $tagid)->whereNotIn( 'post_id', [$post_id])->first();

            if($check==null){

                Tag::destroy($tagid);
            };
    }
    }


    public function getSearch(){



        $query = Input::get('query');

        //dd($query);

        $posts = Post::search($query)->get();

        $counts = count($posts);

        //dd($counts);

        $posts = Post::search($query)->search_paginate(8, $counts, $query);


        return view('front.search', compact('posts','query','counts'));


    }




}
