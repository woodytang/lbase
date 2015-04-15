<?php namespace App\Models\Menu;

use Illuminate\Database\Eloquent\Model;

class Menuset extends Model {

    protected $table = 'menusets';
    protected $guarded =[];

    public function menus()
    {
        return $this->hasMany('App\Models\Menu\Menu');
    }

}

