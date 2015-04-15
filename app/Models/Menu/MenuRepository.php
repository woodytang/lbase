<?php


namespace App\Models\Menu;




class MenuRepository {

    public function createNode(Array $data)
    {

        $parent_id = $data['parent_id'];
        //dd($data);

        $node = Menu::create($data);


        if ($parent_id > 0) {

            //dd(123);

            $root = Menu::find($data['parent_id']);
            $node->makeChildOf($root);

        }
    }


    public function updateNode(Array $data, $id)
    {

        $parent_id = isset($data['parent_id'])?$data['parent_id']:null;
        $node = Menu::findOrFail($id);
        $old_parent_id = $node->parent_id;

        Menu::findOrFail($id)->update($data);

        


        if ($parent_id == 0){

            $node->makeRoot();


        }elseif($parent_id > 0 and $parent_id !== $old_parent_id ) {

            //dd(123);

            $root = Menu::find($data['parent_id']);
            $node->makeChildOf($root);

        }
    }

}