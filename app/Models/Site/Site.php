<?php namespace App\Models\Site;



use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;



class Site extends Model {



    use PresentableTrait;

    protected $presenter = 'App\Presenters\PostPresenter';

    protected $guarded = [];


//////////////////////////////////////////////////////////////////////////////


    public function category()
    {
        return $this->belongsTo('App\Models\Category\Category');
    }


}
