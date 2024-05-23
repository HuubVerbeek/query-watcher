<?php

namespace HuubVerbeek\QueryWatcher;

use HuubVerbeek\QueryWatcher\Traits\HasAsserts;
use HuubVerbeek\QueryWatcher\Traits\HasHigherOrderFunctionHelpers;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Event;

class QueryWatcher
{
    use HasHigherOrderFunctionHelpers;
    use HasAsserts;

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

        /**
         * Because QueryWatcher is a singleton the listener will only be registered once.
         */
        $this->registerListener();
    }

    /**
     * Register listener that listens to executed queries
     */
    private function registerListener(): void
    {
        Event::listen(QueryExecuted::class,
            fn (QueryExecuted $query): Collection => $this->queries->push($query)
        );
    }

    /**
     * Start watching
     */
    public function watch(): static
    {
        $this->queries = collect();

        return $this;
    }

    /**
     * Set the value in seconds after which a query is considered to be slow
     */
    public function setSlowThreshold(float $slowAfter): static
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
            ->reject(fn (Collection $group): bool => $group->count() <= 1)
            ->transform($this->groupByDuplicateBindings())
            ->flatten();
    }
}
