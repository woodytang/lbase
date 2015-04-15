<?php namespace App\Models\Post;


use App\CoreHack\LaraModel;
use Codesleeve\Stapler\ORM\StaplerableInterface;
use Codesleeve\Stapler\ORM\EloquentTrait;
use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use Nicolaslopezj\Searchable\SearchableTrait;


class Post extends LaraModel implements StaplerableInterface{

    use EloquentTrait;

    use PresentableTrait;

    use SearchableTrait;

    protected $presenter = 'App\Presenters\PostPresenter';

    protected $fillable = ['title','content','category_id','feature'];

    protected $searchable = [
        'columns' => [
            'title' => 10,
            'content' => 10

        ]
    ];

    public static function pack($title, $content)
    {
        $postObj = new static (compact('title','content'));

        return $postObj;
    }


    //////////////////////////////////////////////////////////////////////////////
    //图片处理

    public function __construct(array $attributes = array()) {
        $this->hasAttachedFile('feature', [
            'styles' => [
                'medium' => '630x440',
                'thumb' => '300x300'
            ]
        ]);

        parent::__construct($attributes);
    }


    //////////////////////////////////////////////////////////////////////////////

    public function user(){

        return $this->belongsTo( 'App\Models\User\User');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category\Category');
    }

    public function tags() {
        return $this->belongsToMany('App\Models\Tag\Tag');

    }

}
