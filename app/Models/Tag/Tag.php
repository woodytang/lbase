<?php namespace App\Models\Tag;


use Illuminate\Database\Eloquent\Model;

class Tag extends Model {



    protected $guarded = [];

    public function posts() {
        return $this->belongsToMany('App\Models\Post\Post');
    }

}
