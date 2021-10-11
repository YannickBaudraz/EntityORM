<?php

namespace YCliff\EntityORM;

use PDOException;
use YCliff\EntityORM\traits\Arrayable;
use YCliff\EntityORM\traits\Hydratable;
use YCliff\EntityORM\traits\HasAccessors;

abstract class AbstractEntity
{

    //region Using

    use Arrayable;
    use Hydratable;
    use HasAccessors;

    //endregion


    //region Fields

    protected const TABLE_NAME = '';

    protected int $id;

    //endregion


    //region Constructor

    /**
     * Instantiate an Entity class -- can only be used in child classes.
     *
     * @param string[] $fields
     */
    public function __construct(array $fields = [])
    {
        self::hydrate($fields);
    }

    //endregion


    //region Methods

    /**
     * Retrieve all models from database.
     *
     * @return AbstractEntity[] An array of all models.
     * @throws PDOException
     */
    public static function getAll(): array
    {
        $query = "SELECT * FROM " . static::TABLE_NAME;

        return self::createDatabase()->fetchRecords($query, static::class);
    }

    /**
     * Retrieve an entity from the database.
     *
     * @param int $id - The ID.
     *
     * @return AbstractEntity|null The entity
     * @throws PDOException
     */
    public static function get(int $id): ?AbstractEntity
    {
        $query = "SELECT * FROM " . static::TABLE_NAME . " WHERE id= :id";
        $queryArray = ["id" => $id];
        $entityFound = self::createDatabase()->fetchOne($query, static::class, $queryArray);

        return $entityFound ?: null;
    }

    /**
     * Create a new entity in the database.
     *
     * @throws PDOException
     */
    public function create(): void
    {
        $columns = [];
        $valueParams = [];
        foreach ($this->toArray() as $key => $value) {
            array_push($columns, $key);
            array_push($valueParams, ":$key");
        }
        $columns = implode(',', $columns);
        $valueParams = implode(',', $valueParams);
        $query = "INSERT INTO " . static::TABLE_NAME . " ($columns) VALUES ($valueParams)";

        $this->id = self::createDatabase()->insert($query, $this->toArray());
    }

    /**
     * Update the entity in the database.
     *
     * @return bool True on success, false if no row is updated.
     * @throws PDOException
     */
    public function update(): bool
    {
        $array = [];
        foreach ($this->toArray() as $key => $value) {
            if ($key != 'id') {
                array_push($array, "$key=:$key");
            }
        }
        $setLine = implode(',', $array);
        $query = "UPDATE " . static::TABLE_NAME . " SET $setLine WHERE id=:id";

        return self::createDatabase()->update($query, $this->toArray());
    }

    /**
     * Delete the entity from the database.
     *
     * @return bool The on success, false if no row is deleted.
     * @throws PDOException
     */
    public function delete(): bool
    {
        $query = "DELETE FROM " . static::TABLE_NAME . " WHERE id=:id";
        $queryArray = ["id" => $this->id];

        return self::createDatabase()->delete($query, $queryArray);
    }

    /**
     * @return \YCliff\EntityORM\DatabaseConnector
     * @throws PDOException
     */
    protected static function createDatabase(): DatabaseConnector
    {
        return new DatabaseConnector($_ENV['DB_DSN'], $_ENV['DB_USER_NAME'], $_ENV['DB_USER_PWD']);
    }

    //endregion
}
