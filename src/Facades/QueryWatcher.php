<?php

namespace HuubVerbeek\QueryWatcher\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class QueryWatcher
 *
 * @mixin \HuubVerbeek\QueryWatcher\QueryWatcher
 */
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
