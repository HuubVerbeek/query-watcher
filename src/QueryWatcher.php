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
     *
     * @var Collection
     */
    protected Collection $queries;

    /**
     * The value in seconds after which a query is considered to be slow
     *
     * @var float
     */
    protected float $slowAfter;

    public function __construct()
    {
        $this->queries = collect();
        $this->slowAfter = 1.0;
    }

    /**
     * Start watching
     *
     * @return static
     */
    public function watch(): static
    {
        $this->queries = collect();

        Event::listen(QueryExecuted::class, fn (QueryExecuted $query) => $this->queries->push($query));

        return $this;
    }

    /**
     * Set the value in seconds after which a query is considered to be slow
     *
     * @param  float  $slowAfter
     * @return static
     */
    public function isSlowAfter(float $slowAfter): static
    {
        $this->slowAfter = $slowAfter;

        return $this;
    }

    /**
     * Get all the queries
     *
     * @return Collection
     */
    public function queries(): Collection
    {
        return $this->queries;
    }

    /**
     * Get all the slow queries
     *
     * @return Collection
     */
    public function slowQueries(): Collection
    {
        return $this->queries->where('time', '>', $this->slowAfter);
    }

    /**
     * Get all the duplicate queries
     *
     * @return Collection
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
