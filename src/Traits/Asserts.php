<?php

namespace HuubVerbeek\QueryWatcher\Traits;

use PHPUnit\Framework\Assert as PHPUnit;

trait Asserts
{
    /**
     * Assert that duplicate queries were executed
     */
    public function assertHasDuplicateQueries(): void
    {
        $hasNoDuplicates = $this->duplicateQueries()->isNotEmpty();

        PHPUnit::assertTrue($hasNoDuplicates, $hasNoDuplicates
            ? 'The test executed duplicate queries'
            : 'No duplicate queries executed'
        );
    }

    /**
     * Assert that no duplicate queries were executed
     */
    public function assertNoDuplicateQueries(): void
    {
        $hasDuplicates = $this->duplicateQueries()->isEmpty();

        PHPUnit::assertTrue($hasDuplicates, $hasDuplicates
            ? 'No duplicate queries executed'
            : 'The test executed duplicate queries'
        );
    }

    /**
     * Assert that slow queries were executed
     */
    public function assertHasSlowQueries(): void
    {
        $hasSlowQueries = $this->slowQueries()->isNotEmpty();

        PHPUnit::assertTrue($hasSlowQueries, $hasSlowQueries
            ? 'The test executed slow queries'
            : 'No slow queries executed'
        );
    }

    /**
     * Assert that no slow queries were executed
     */
    public function assertNoSlowQueries(): void
    {
        $hasDuplicates = $this->slowQueries()->isEmpty();

        PHPUnit::assertTrue($hasDuplicates, $hasDuplicates
            ? 'No slow queries executed'
            : 'The test executed slow queries'
        );
    }
}
