<?php

namespace HuubVerbeek\QueryWatcher\Facades;

use Illuminate\Support\Facades\Facade;

class QueryWatcher extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'querywatcher';
    }
}
