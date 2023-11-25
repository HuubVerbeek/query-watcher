<?php

namespace HuubVerbeek\QueryWatcher;

use Illuminate\Support\ServiceProvider;

class QueryWatcherServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        app()->singleton('querywatcher', fn () => new QueryWatcher());
    }
}
