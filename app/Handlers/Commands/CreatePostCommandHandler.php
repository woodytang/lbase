<?php namespace App\Handlers\Commands;

use App\Commands\CreatePostCommand;

use App\Models\Post\Post;

use App\Models\Post\PostRepository;
use App\Models\Tag\Tag;
use Illuminate\Queue\InteractsWithQueue;

class CreatePostCommandHandler {
    /**
     * @var PostRepository
     */
    /**
     * @var PostRepository
     */
    private $postRepository;


    /**
	 * Create the command handler.
	 *
	 * @return void
	 */
	public function __construct(PostRepository $postRepository)
	{

        //dd($postRepository);
        $this->postRepository = $postRepository;
    }

	/**
	 * Handle the command.
	 *
	 * @param  CreatePostCommand  $command
	 * @return void
	 */
	public function handle(CreatePostCommand $command)
	{
        $data = $command->request->all();


        //获得Post实例
        //$postObj = Post::pack($command->title, $command->content);
        $post = Post::create($data);
        //dd($postObj);

         //User数据关系存储，以参数形式，松耦合

        $post = $this->postRepository->saveUser($post, $command->userId);

        if(isset($data['tags'])){


            $tags = explode(',', $data['tags']);

            //绑定Tags

            $post= $this->postRepository->saveTags($post, $tags);

            return $post;

        }





        return $post;



	}

}
