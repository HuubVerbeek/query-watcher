<?php

namespace HuubVerbeek\QueryWatcher\Tests;

use HuubVerbeek\QueryWatcher\QueryWatcherServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            QueryWatcherServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        // perform environment setup
    }
}
