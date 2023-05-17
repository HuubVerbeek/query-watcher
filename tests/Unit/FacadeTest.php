<?php

namespace HuubVerbeek\QueryWatcher\Tests\Unit;

use HuubVerbeek\QueryWatcher\Facades\QueryWatcher as Facade;
use HuubVerbeek\QueryWatcher\QueryWatcher;
use HuubVerbeek\QueryWatcher\Tests\TestCase;

class FacadeTest extends TestCase
{
    public function test_facade_returns_query_watcher_instance()
    {
        $instance = Facade::watch();

        $this->assertInstanceOf(QueryWatcher::class, $instance);
    }
}
