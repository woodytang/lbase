<?php


namespace App\Models\Section;




class SectionRepository {

    public function createNode(Array $data)
    {

        $parent_id = $data['parent_id'];
        //dd($data);

        $node = Section_Content::create($data);

       
        if ($parent_id > 0) {

            //dd(123);

            $root = Section_Content::findOrFail($parent_id);
            //dd($node);
            $node->makeChildOf($root);

            //不知道为什么有个bug，新建的时候depth不对，所以只好强制重设；

            $node->depth = $root->depth+1;

            $node->save();


           
        }
    }


    public function updateNode(Array $data, $id)
    {

        
        $parent_id = isset($data['parent_id'])?$data['parent_id']:null;
        $node = Section_Content::findOrFail($id);
        $old_parent_id = $node->parent_id;
        Section_Content::findOrFail($id)->update($data);

        

        if ($parent_id == 0){

            $node->makeRoot();


        }elseif($parent_id > 0 and $parent_id !== $old_parent_id ) {

            //dd(123);

            $root = Section_Content::findOrFail($parent_id);
            $node->makeChildOf($root);

        }

    }

}