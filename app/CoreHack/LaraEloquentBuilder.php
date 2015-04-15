<?php


namespace App\CoreHack;


use Illuminate\Database\Eloquent\Builder;

use Closure;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Query\Expression;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Relations\Relation;
use App\CoreHack\LaraQueryBuilder as QueryBuilder;


class LaraEloquentBuilder extends Builder{

    protected $query;


    public function __construct(LaraQueryBuilder $query)
    {

        $this->query = $query;
    }

    public function search_paginate($perPage = null, $counts, $query, $columns = ['*'])
    {
        //dd(123);

        $total =  $counts;

        //dd($total);

        $this->query->forPage(
            $page = Paginator::resolveCurrentPage(),
            $perPage = $perPage ?: $this->model->getPerPage()
        );

       // dd(Paginator::resolveCurrentPath());

        return new CustomLengthAwarePaginator($this->get($columns), $total, $perPage, $page, [
            'path' => Paginator::resolveCurrentPath()
        ],  $query);
    }

} 