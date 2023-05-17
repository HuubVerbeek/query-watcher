<?php

namespace HuubVerbeek\QueryWatcher\Traits;

use Closure;
use HuubVerbeek\QueryWatcher\Enums\Bindings;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Collection;

trait HigherOrderFunctions
{
    /**
     * Map empty bindings to enum
     *
     * @return Closure
     */
    private function mapEmptyBindingsToEnum(): Closure
    {
        return fn (QueryExecuted $query) => tap($query,
            fn (QueryExecuted $query) => $query->bindings = $query->bindings ?: Bindings::EMPTY->value
        );
    }

    /**
     * Group by duplicate bindings closure
     *
     * @return Closure
     */
    private function groupByDuplicateColumn(): Closure
    {
        return fn (Collection $group) => $group->groupBy('bindings')->filter(
            fn (Collection $group) => $group->count() >= 2
        );
    }
}
