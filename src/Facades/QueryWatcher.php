<?php

namespace HuubVerbeek\QueryWatcher\Facades;

use Illuminate\Support\Facades\Facade;

class QueryWatcher extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return 'querywatcher';
    }
}
