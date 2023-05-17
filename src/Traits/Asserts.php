<?php

namespace HuubVerbeek\QueryWatcher\Traits;

use PHPUnit\Framework\Assert as PHPUnit;

trait Asserts
{
    /**
     * Assert that duplicate queries were triggered
     */
    public function assertHasDuplicateQueries(): void
    {
        $hasNoDuplicates = $this->duplicateQueries()->isNotEmpty();

        PHPUnit::assertTrue($hasNoDuplicates, $hasNoDuplicates
            ? 'The test triggered duplicate queries'
            : 'No duplicate queries'
        );
    }

    /**
     * Assert that no duplicate queries were triggered
     */
    public function assertNoDuplicateQueries(): void
    {
        $hasDuplicates = $this->duplicateQueries()->isEmpty();

        PHPUnit::assertTrue($hasDuplicates, $hasDuplicates
            ? 'No duplicate queries'
            : 'The test triggered duplicate queries'
        );
    }

    /**
     * Assert that slow queries were triggered
     */
    public function assertHasSlowQueries(): void
    {
        $hasSlowQueries = $this->slowQueries()->isNotEmpty();

        PHPUnit::assertTrue($hasSlowQueries, $hasSlowQueries
            ? 'The test triggered slow queries'
            : 'No slow queries'
        );
    }

    /**
     * Assert that no slow queries were triggered
     */
    public function assertNoSlowQueries(): void
    {
        $hasDuplicates = $this->slowQueries()->isEmpty();

        PHPUnit::assertTrue($hasDuplicates, $hasDuplicates
            ? 'No slow queries'
            : 'The test triggered slow queries'
        );
    }
}
