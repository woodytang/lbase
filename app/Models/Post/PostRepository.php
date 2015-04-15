<?php


namespace App\Models\Post;


use App\Models\Tag\Tag;
use App\Models\User\User;

class PostRepository {

public function saveUser(Post $post, $userId){




return User::findOrFail($userId)->posts()->save($post);

}

    public function getPaginatedPosts($howMany=9)
    {
        return Post::orderBy('created_at','desc')->paginate($howMany);
    }

    public function getTags($post)
    {
        if (count($post->tags) !== 0) {

            $tags = $post->tags;



            foreach ($tags as $tag) {

                $tag_array[] = $tag->name;
            };

            $tag_string = implode(",", $tag_array);
            //dd($tag_string);

            return $tag_string;

        }
    }

    public function saveTags($post, Array $tags)

    {
        $post->tags()->detach();

     //dd(empty($tags[0]));

        //$tags[0] !== "" 这个很奇怪，有时删除标签后会出现这样一个数组；
       if(isset($tags) and $tags[0] !== ""){

           //dd($tags);
        foreach ($tags as $tag) {

                $tagobj = Tag::where('name', '=', $tag)->first();

                //dd($tagobj);

                $post->tags()->save($tagobj);

            };
       }

        return $post;

    }

    public function prepareData($request, $post)
    {



            //获取2个数组

            $requestArray = $request->all();
//dd($requestArray);

        if(isset($requestArray['tags'])){


//获取tag数组
            $requestTagString = $requestArray['tags'];

            $requestTagArray = explode(',', $requestTagString); //字符串变数组


            //dd($requestTagArray);

//取得原有tags数组
  /*          if(count($post->tags)>0){

                $postTagCollection = $post->tags;

                foreach ($postTagCollection as $tag){

                    //取得原有tag数组
                    $postTagArray[] = $tag->name;

                }

                //dd($requestTagArray);

                $tags = array_diff($requestTagArray, $postTagArray);//比较前后数组的差值

                //dd($tags);

                return $tags;

            }*/


            return $requestTagArray;

        }





    }


}