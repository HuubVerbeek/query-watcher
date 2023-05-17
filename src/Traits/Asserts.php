<?php

namespace HuubVerbeek\QueryWatcher\Traits;

use PHPUnit\Framework\Assert as PHPUnit;

trait Asserts
{
    /**
     * @return void
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
     * @return void
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
     * @return void
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
     * @return void
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
