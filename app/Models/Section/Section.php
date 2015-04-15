<?php namespace App\Models\Section;

use Illuminate\Database\Eloquent\Model;
use Codesleeve\Stapler\ORM\StaplerableInterface;
use Codesleeve\Stapler\ORM\EloquentTrait;

class Section extends Model implements StaplerableInterface{

    use EloquentTrait;

    protected $table = 'sections';
    protected $guarded =[];

    public function section_contents()
    {
        return $this->hasMany('App\Models\Section\Section_Content');
    }

    public function __construct(array $attributes = array()) {
        $this->hasAttachedFile('cover', [
            'styles' => [
                'medium' => '600x480',
                'thumb' => '100x100'
            ]
        ]);

        parent::__construct($attributes);
    }

}

