<?php


namespace App\CoreHack;


use Closure;
use Illuminate\Support\Collection;
use Illuminate\Database\ConnectionInterface;
use Illuminate\Database\Query\Grammars\Grammar;
use Illuminate\Database\Query\Processors\Processor;

use Illuminate\Database\Query\Builder;

class LaraQueryBuilder extends Builder{




    public function getCountForPagination()
    {



        $this->backupFieldsForCount();



        $total = $this->count();



        $this->restoreFieldsForCount();

        return $total;
    }



} 