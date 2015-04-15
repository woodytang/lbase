<?php


namespace App\CoreHack;


use Illuminate\Pagination\LengthAwarePaginator;
use Countable;
use ArrayAccess;
use IteratorAggregate;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Pagination\Presenter;
use Illuminate\Contracts\Pagination\LengthAwarePaginator as LengthAwarePaginatorContract;

class CustomLengthAwarePaginator extends LengthAwarePaginator{


    /**
     * The total number of items before slicing.
     *
     * @var int
     */
    protected $total;

    protected $querydata;

    /**
     * The last available page.
     *
     * @var int
     */
    protected $lastPage;

    /**
     * Create a new paginator instance.
     *
     * @param  mixed  $items
     * @param  int  $total
     * @param  int  $perPage
     * @param  int|null  $currentPage
     * @param  array  $options (path, query, fragment, pageName)
     * @return void
     */


    public function __construct($items, $total, $perPage, $currentPage = null, array $options = [],$query=null)
    {
        foreach ($options as $key => $value)
        {
            $this->{$key} = $value;
        }
        $this->querydata = $query;
        $this->total = $total;
        $this->perPage = $perPage;
        $this->lastPage = (int) ceil($total / $perPage);
        $this->currentPage = $this->setCurrentPage($currentPage, $this->lastPage);
        $this->path = $this->path != '/' ? rtrim($this->path, '/').'/' : $this->path;


        //dd($this->path);
        $this->items = $items instanceof Collection ? $items : Collection::make($items);
    }






    public function getUrlRange($start, $end)
    {
        $urls = [];

        for ($page = $start; $page <= $end; $page++)
        {
            $urls[$page] = $this->url($page);
        }

        return $urls;
    }




    public function previousPageUrl()
    {
        if ($this->currentPage() > 1)
        {
            return $this->url($this->currentPage() - 1,$this->querydata);
        }
    }



    public function nextPageUrl()
    {
        if ($this->lastPage() > $this->currentPage())
        {
            $page = $this->currentPage() + 1;
            return $this->url($page, $this->querydata);
        }
    }


    public function url($page,$query=null)
    {
        if ($page <= 0) $page = 1;

        // If we have any extra query string key / value pairs that need to be added
        // onto the URL, we will put them in query string form and then attach it
        // to the URL. This allows for extra information like sortings storage.
        $parameters = [$this->pageName => $page];

        if (count($this->query) > 0)
        {
            $parameters = array_merge($this->query, $parameters);
        }



        return $this->path.'?'
        .http_build_query($parameters, null, '&')
        .$this->buildFragment()
            .'&query='.$this->querydata;
    }

}


