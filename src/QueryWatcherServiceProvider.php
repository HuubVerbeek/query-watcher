<?php

namespace HuubVerbeek\QueryWatcher;

use Illuminate\Support\ServiceProvider;

class QueryWatcherServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        app()->singleton('querywatcher', fn () => new QueryWatcher());
    }
}
