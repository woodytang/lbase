<?php


namespace App\Models\Category;




use App\Http\Requests\CategoryRequest;

class CategoryRepository {


    public function createNode(Array $data)
    {

        $parent_id = $data['parent_id'];

        $node = Category::create($data);


        if($parent_id>0){

            $root=Category::find($data['parent_id']);
            $node->makeChildOf($root);

        }

    }

    public function updateNode(Array $data, $id)
    {

        $parent_id = isset($data['parent_id'])?$data['parent_id']:null;
        Category::findOrFail($id)->update($data);

        $node = Category::findOrFail($id);

        if ($parent_id > 0) {

            //dd(123);

            $root = Category::find($data['parent_id']);
            $node->makeChildOf($root);

        }
    }

}