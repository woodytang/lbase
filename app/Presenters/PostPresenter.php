<?php namespace App\Presenters;

use App\Models\Section\Section_Content;
use Laracasts\Presenter\Presenter;
use Jenssegers\Date\Date;

class PostPresenter extends Presenter {


    public function conditionTitle(){

        if($this->category->name == 'L5 笔记'){


            return '文档笔记 - '.$this->title;


        };

      return $this->title;

    }


    public function conditionURL(){

        if($this->category->name == 'L5 笔记'){


            $section_content = Section_Content::whereLink($this->id)->first();
            $section_id = $section_content->section->id;

            $post_id = $this->id;

            return route('section_post_path',[$section_id,$post_id]);


        };

        return route('post_path',$this->id);

    }



    public function getTrimedContent($num=200)
    {

        $text = $this->cutstr(strip_tags($this->content), $num, ' ...');
         

        return $text;
    }

    public function sillyDate()
    {
        Date::setLocale('zh');
        $date = new Date($this->created_at);

        return $date->ago();
    }

    public function standardDate(){

        return date('Y-m-d',strtotime($this->created_at));

    }

    public function getTags(){

        return $this->tags->all();

    }



public function cutstr($str,$len,$dot = '...')
{
    for($i=0;$i<$len;$i++)
    {
        $temp_str=substr($str,0,1);
        if(ord($temp_str) > 127)
            {
            $i++;
            if($i<$len)
            {
            $new_str[]=substr($str,0,3);
            $str=substr($str,3);
            }
    }
    else
    {
        $new_str[]=substr($str,0,1);
        $str=substr($str,1);
}
}
return join($new_str).$dot;
}

}