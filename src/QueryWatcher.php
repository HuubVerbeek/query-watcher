<?php

namespace HuubVerbeek\QueryWatcher;

use HuubVerbeek\QueryWatcher\Traits\Asserts;
use HuubVerbeek\QueryWatcher\Traits\HigherOrderFunctions;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Event;

class QueryWatcher
{
    use HigherOrderFunctions;
    use Asserts;

    /**
     * Collection of the watched queries
     */
    protected Collection $queries;

    /**
     * The value in seconds after which a query is considered to be slow
     */
    protected float $slowAfter;

    public function __construct()
    {
        $this->queries = collect();
        $this->slowAfter = 1.0;
    }

    /**
     * Start watching
     */
    public function watch(): static
    {
        $this->queries = collect();

        Event::listen(QueryExecuted::class, fn (QueryExecuted $query) => $this->queries->push($query));

        return $this;
    }

    /**
     * Set the value in seconds after which a query is considered to be slow
     */
    public function isSlowAfter(float $slowAfter): static
    {
        $this->slowAfter = $slowAfter;

        return $this;
    }

    /**
     * Get all the queries
     */
    public function queries(): Collection
    {
        return $this->queries;
    }

    /**
     * Get all the slow queries
     */
    public function slowQueries(): Collection
    {
        return $this->queries->where('time', '>', $this->slowAfter);
    }

    /**
     * Get all the duplicate queries
     */
    public function duplicateQueries(): Collection
    {
        return $this->queries
            ->map($this->mapEmptyBindingsToEnum())
            ->groupBy('sql')
            ->transform($this->groupByDuplicateColumn())
            ->reject(fn (Collection $group) => $group->isEmpty())
            ->flatten();
    }
}
