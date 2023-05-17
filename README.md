### QueryWatcher
QueryWatcher is a composer package for Laravel that allows you to monitor and analyze database queries executed during the runtime of your application. It provides methods to track slow queries and identify duplicate queries.

#### Installation
You can install the QueryWatcher package via Composer by running the following command:

`composer require huubverbeek/query-watcher`

#### Requirements
This package requires php 8.1 or higher.

#### Usage
To start watching queries, you can use the `watch` method provided by the `QueryWatcher` facade:

```php
use HuubVerbeek\QueryWatcher\Facades\QueryWatcher;

QueryWatcher::watch();
```
This will enable the query watcher and start collecting executed queries.

#### All Queries
To retrieve all the queries you can use the `queries` method:

```php
$allQueries = QueryWatcher::queries();
```

#### Slow Queries
To retrieve the slow queries (queries that exceed a certain execution time), you can use the `slowQueries` method:

```php
$slowQueries = QueryWatcher::slowQueries();
```

You can also set a custom threshold for slow queries by using the `setSlowThreshold` method:

```php
QueryWatcher::setSlowThreshold(2.0); // Set slow threshold to 2 seconds

```
#### Duplicate Queries
To identify duplicate queries (queries with the same SQL statement and bindings), you can use the `duplicateQueries` method:

```php
$duplicateQueries = QueryWatcher::duplicateQueries();
```

#### Assertions
The QueryWatcher package also provides assertion methods to facilitate testing. These methods allow you to assert whether certain conditions are met based on the executed queries.

- `assertHasDuplicateQueries`: Assert that duplicate queries were executed.
- `assertNoDuplicateQueries`: Assert that no duplicate queries were executed.
- `assertHasSlowQueries`: Assert that slow queries were executed.
- `assertNoSlowQueries`: Assert that no slow queries were executed.

Here's an example of using assertions in a test case:

```php
public function test_queries()
{
    QueryWatcher::watch();

    // Code that executes queries

    QueryWatcher::assertNoDuplicateQueries();
    
    QueryWatcher::assertNoSlowQueries();
}
```

#### Contributing
If you encounter any issues or have suggestions for improvements, please feel free to open an issue or submit a pull request on the GitHub repository.

#### License
The QueryWatcher package is open-source software licensed under the MIT license.