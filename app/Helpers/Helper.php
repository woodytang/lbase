<?php


namespace App\Helpers;


class Helper {


    public function renderTree($parent){


        //这里一定要取 邻接 的nodes，否则会重复数据, 本来很简单，加URL比较复杂

        foreach($parent->getImmediateDescendants() as $descendant) {

            $url = action('SectionsController@section_post',['id'=>$descendant->section_id,'link'=>$descendant->link]);

            echo '<li id="'.$descendant->id.'"><a href="'.$url.'" target="_self">'.$descendant->name.'</a>';



            if($descendant->isLeaf() === false){

                //dd($descendant->name);

                echo '<ul>';
                $this->renderTree($descendant);
                echo '</ul>';

            }

            echo '</li>';



        }


    }



} 