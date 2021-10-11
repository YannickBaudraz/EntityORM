<?php

namespace YCliff\EntityORM;

use PDO;
use PDOStatement;

/**
 * This class interact with the SQL database.
 */
class DatabaseConnector
{

    //region Fields

    private PDO|null     $connection;
    private PDOStatement $statement;

    //endregion


    //region Constructor

    /**
     * Instantiate a new database object.
     *
     * @param string $dsn      The Data Source Name, contains the information required to connect to the database.
     * @param string $username The username for the DSN string.
     * @param string $password The password for the DSN string.
     */
    public function __construct(string $dsn, string $username, string $password)
    {
        $this->connection = new PDO($dsn, $username, $password);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    //endregion


    //region Methods

    /**
     * Returns the result of an executed query.
     *
     * @param string     $query      The query, be correctly build for sql syntax.
     * @param string     $className  Name of the class type wanted in return.
     * @param array|null $queryArray An array of values with as many elements as there are bound parameters in the SQL
     *                               statement being executed.
     *
     * @return array|false An array containing all the remaining rows in the result set. An empty array is
     *                     returned if there are zero results to fetch, or false on failure.
     */
    public function fetchRecords(string $query, string $className, array $queryArray = null): array|false
    {
        $this->executeQuery($query, $queryArray);
        $this->statement->setFetchMode(PDO::FETCH_CLASS, $className);

        return $this->statement->fetchAll();
    }

    /**
     * Return a single row of an executed query.
     *
     * @param string     $query      The query, be correctly build for sql syntax.
     * @param string     $className  Name of the class type wanted in return.
     * @param array|null $queryArray An array of values with as many elements as there are bound parameters in the SQL
     *                               statement being executed.
     *
     * @return AbstractEntity|false An entity that represent the record, false on failure.
     */
    public function fetchOne(string $query, string $className, array $queryArray = null): AbstractEntity|false
    {
        $this->executeQuery($query, $queryArray);
        $this->statement->setFetchMode(PDO::FETCH_CLASS, $className);

        return $this->statement->fetch();
    }

    /**
     * Insert data of an executed query.
     *
     * @param string $query          The query, be correctly build for sql syntax.
     * @param array  $queryArray     An array of values with as many elements as there are bound parameters in the SQL
     *                               statement being executed.
     *
     * @return int The row ID of the new row inserted into the database.
     */
    public function insert(string $query, array $queryArray): int
    {
        $this->executeQuery($query, $queryArray);

        return intval($this->connection->lastInsertId());
    }

    /**
     * Update data of an executed query.
     *
     * @param string $query          The query, be correctly build for sql syntax.
     * @param array  $queryArray     An array of values with as many elements as there are bound parameters in the SQL
     *                               statement being executed.
     *
     * @return int The number of rows updated.
     */
    public function update(string $query, array $queryArray): int
    {
        $this->executeQuery($query, $queryArray);

        return $this->statement->rowCount();
    }

    /**
     * Update data of an executed query.
     *
     * @param string $query          The query, be correctly build for sql syntax.
     * @param array  $queryArray     An array of values with as many elements as there are bound parameters in the SQL
     *                               statement being executed.
     *
     * @return bool The number of rows deleted.
     */
    public function delete(string $query, array $queryArray): bool
    {
        $this->executeQuery($query, $queryArray);

        return $this->statement->rowCount();
    }

    private function executeQuery(string $query, array $queryArray = null): bool
    {
        $this->statement = $this->connection->prepare($query);

        return $this->statement->execute($queryArray);
    }

    //endregion
}
