<?php namespace App\Http\Controllers;

use App\Commands\CreatePostCommand;
use App\Facades\Notification;
use App\Http\Requests;
use App\Http\Controllers\Controller;


use App\Http\Requests\PostRequest;
use App\Models\Category\Category;
use App\Models\Post\Post;
use App\Models\Post\PostRepository;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\App;
use Redirect;
use Amaran;


class PostsController extends Controller {


    /**
     * @var PostRepository
     */
    private $postRepository;

    public function __construct(PostRepository $postRepository){


        $this->postRepository = $postRepository;
    }
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

        $posts = $this->postRepository->getPaginatedPosts();


        return view('admin.posts.index',compact('posts'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $categories = Category::whereType('文章')->get();
        return view('admin.posts.create',compact('categories'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(PostRequest $request)
	{

        //dd($request->all());

        $post = $this->dispatch(

            new CreatePostCommand($request,Auth::id())

        );

        $id = $post->id;
    	

        app('flash')->message('文章已保存');

        return Redirect::back()->with('id',$id);



	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $post = Post::findOrFail($id);

        //dd($post);

        $category_id = null;

        if(count($post->category)){
            $category_id = $post->category->id;
        }


        $categories = Category::whereType('文章')->get();

        //dd(isset($post->feature_file_name));

        $tag_string =$this->postRepository->getTags($post);



        return view('admin.posts.edit',compact('post','category_id','categories', 'tag_string'));

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(PostRequest $request, $id)
	{

        $post = Post::findOrFail($id);



        $tags = $this->postRepository->prepareData($request,$post);

        //dd($tags);

        $request = $request->all();
        $post->update($request);

       // dd(count($tags));

        if($tags==!null){

            $this->postRepository->saveTags($post, $tags);
        }


        app('flash')->message('文章已更新');

        return redirect()->back();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        //先把相关的图片删了
        $post = Post::findOrFail($id);
        $post->feature = STAPLER_NULL;

        $post->save();
        $post->delete();


        app('flash')->message('文章已删除');

        return Redirect::back();

	}

}
