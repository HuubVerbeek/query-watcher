<?php

namespace HuubVerbeek\QueryWatcher\Facades;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Facade;

/**
 * Class QueryWatcher
 *
 * @mixin \HuubVerbeek\QueryWatcher\QueryWatcher
 *
 * @method static static watch()
 * @method static static setSlowThreshold()
 * @method static Collection queries()
 * @method static Collection slowQueries()
 * @method static Collection duplicateQueries()
 * @method static void assertHasDuplicateQueries()
 * @method static void assertNoDuplicateQueries()
 * @method static void assertHasSlowQueries()
 * @method static void assertNoSlowQueries()
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
