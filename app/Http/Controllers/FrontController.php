<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Category\Category;
use App\Models\Menu\Menu;
use App\Models\Menu\Menuset;
use App\Models\Post\Post;
use App\Models\Site\Site;
use App\Models\Tag\Tag;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Offline\Settings\Facades\Settings;

class FrontController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        //$posts = Post::orderBy('created_at','desc')->with('category')->simplePaginate(7);


        $categories = ['新手','实例','插件','进阶','L5 笔记'];


        $posts = Post::with('category')->whereHas('category', function($q) use ($categories) { $q->whereIn('name', $categories); })->orderBy('created_at', 'desc')->simplePaginate(7);



        $tags = Tag::all();
        //阅读最多
        $most_read = Post::orderBy('clicks', 'desc')
            ->with('category')
            ->take(5)
            ->get();
        //获取features 文章
        $feature_ids = Settings::get('features');
        //dd($feature_ids);

        foreach ($feature_ids as $key=>$val){



            $feature_posts[$key]=Post::findOrFail($val);

        }
        //dd($feature_posts);
       // dd($feature_posts['id1']->present()->getTrimedContent());

        return view('front.index', compact('posts','tags','most_read','feature_posts'));
    }



	public function show($id)
	{
        $post = Post::findOrFail($id);

        $tags = $post->tags;

        //获取相关文章 http://stackoverflow.com/questions/20889374/laravel-eloquent-get-related-articles-based-on-a-tag

        $tag_ids = $tags->lists('id');



        $related =   Post::whereNotIn('id',[$post->id])->whereHas('tags', function($q) use($tag_ids)
        {
            $q->whereIn('tags.id', $tag_ids);

        })
            ->orderBy('created_at','desc')
            ->take(6)
            ->get();
        //dd($related);
        //获取点击数

        $clicks=$post->clicks=$post->clicks + 1;

        $post->save();

        return view('front.show',compact('post','clicks','tags','related'));
	}



    public function categoryListing($id){

        $category = Category::findOrFail($id);

        $posts = $category->posts()->orderBy('created_at','desc')
            ->paginate(8);

        //dd($posts);


        return view('front.category',compact('category','posts'));

    }

    public function tagListing($id){

        $tag = Tag::findOrFail($id);

        $posts = $tag->posts()->orderBy('created_at','desc')
            ->paginate(8);

        return view('front.tag',compact('tag','posts'));

    }

    public function SiteListing(){

        $categories = Category::whereType('网站')->get();


        return view('front.site',compact('categories'));

    }

        public function cheatsheet(){

         return view('front.cheatsheet');

    }



}
